
<?php

use Livewire\Component;
use Illuminate\Support\Facades\DB;

new class extends Component
{
    public $totalBookings = 0;
    public $pendingBookings = 0;
    public $totalCustomers = 0;
    public $totalServices = 0;

    public array $latestBookings = [];
    public array $bookingStatus = [];
    public array $paymentStatus = [];

    // Pagination
    public int $currentPage = 1;
    public int $perPage = 10;
    public int $totalPages = 1;

    public function mount(): void
    {
        $this->totalBookings = DB::table('bookings')->count();

        $this->pendingBookings = DB::table('bookings')
            ->where('status', 'Menunggu')
            ->count();

        $this->totalCustomers = DB::table('customers')->count();

        $this->totalServices = DB::table('services')->count();

        $this->loadLatestBookings();
    }

    // Mengambil data booking sesuai halaman
    public function loadLatestBookings(): void
    {
        $totalData = DB::table('bookings')->count();

        $this->totalBookings = $totalData;

        $this->totalPages = max(
            1,
            (int) ceil($totalData / $this->perPage)
        );

        $this->currentPage = min(
            $this->currentPage,
            $this->totalPages
        );

        $offset = ($this->currentPage - 1) * $this->perPage;

        $bookings = DB::table('bookings')
            ->join('customers', 'bookings.customer_id', '=', 'customers.id')
            ->join('vehicles', 'bookings.vehicle_id', '=', 'vehicles.id')
            ->join('services', 'bookings.service_id', '=', 'services.id')
            ->leftJoin('payments', 'bookings.id', '=', 'payments.booking_id')
            ->select(
                'bookings.id',
                'customers.name as customer_name',
                'vehicles.plate_number',
                'services.name as service_name',
                'bookings.booking_date',
                'bookings.booking_time',
                'bookings.status',
                'payments.id as payment_id',
                'payments.method as payment_method',
                'payments.status as payment_status'
            )
            ->orderByDesc('bookings.id')
            ->offset($offset)
            ->limit($this->perPage)
            ->get();

        $this->latestBookings = [];
        $this->bookingStatus = [];
        $this->paymentStatus = [];

        foreach ($bookings as $booking) {
            $data = (array) $booking;

            $this->latestBookings[] = $data;

            $this->bookingStatus[$data['id']] =
                $data['status'] ?? 'Menunggu';

            $this->paymentStatus[$data['id']] =
                $data['payment_status'] ?? 'Belum Dibayar';
        }
    }

    // Navigasi pagination
    public function goToPage(int $page): void
    {
        if ($page < 1 || $page > $this->totalPages) {
            return;
        }

        $this->currentPage = $page;

        $this->loadLatestBookings();
    }

    public function previousPage(): void
    {
        $this->goToPage($this->currentPage - 1);
    }

    public function nextPage(): void
    {
        $this->goToPage($this->currentPage + 1);
    }

    // Update status pengerjaan dan pembayaran sekaligus
    public function updateStatuses(int $bookingId): void
    {
        $booking = DB::table('bookings')
            ->where('id', $bookingId)
            ->first();

        if (!$booking) {
            session()->flash('error', 'Data booking tidak ditemukan.');
            return;
        }

        $workStatus = $this->bookingStatus[$bookingId] ?? '';

        $allowedWorkStatuses = [
            'Menunggu',
            'Diproses',
            'Selesai',
            'Dibatalkan',
        ];

        if (!in_array($workStatus, $allowedWorkStatuses, true)) {
            session()->flash('error', 'Status pengerjaan tidak valid.');
            return;
        }

        $payment = DB::table('payments')
            ->where('booking_id', $bookingId)
            ->first();

        $paymentStatus = $this->paymentStatus[$bookingId] ?? '';

        $allowedPaymentStatuses = [
            'Belum Dibayar',
            'Menunggu Verifikasi',
            'Lunas',
        ];

        if (
            $payment &&
            !in_array($paymentStatus, $allowedPaymentStatuses, true)
        ) {
            session()->flash('error', 'Status pembayaran tidak valid.');
            return;
        }

        DB::transaction(function () use (
            $bookingId,
            $workStatus,
            $payment,
            $paymentStatus
        ) {
            DB::table('bookings')
                ->where('id', $bookingId)
                ->update([
                    'status' => $workStatus,
                ]);

            if ($payment) {
                DB::table('payments')
                    ->where('booking_id', $bookingId)
                    ->update([
                        'status' => $paymentStatus,
                        'paid_at' => $paymentStatus === 'Lunas'
                            ? (
                                $payment->status === 'Lunas' && $payment->paid_at
                                    ? $payment->paid_at
                                    : now()
                            )
                            : null,
                    ]);
            }
        });

        // Perbarui jumlah booking menunggu
        $this->pendingBookings = DB::table('bookings')
            ->where('status', 'Menunggu')
            ->count();

        // Muat ulang data tabel
        $this->loadLatestBookings();

        session()->flash('success', 'Perubahan pesanan berhasil disimpan.');
    }
};

?>

<div class="min-h-screen bg-slate-50 text-slate-800">

    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="{{ route('admin.dashboard') }}"
                class="text-2xl font-extrabold text-slate-900">
                Oto<span class="text-blue-800">Care.</span>
            </a>

            <div class="flex items-center gap-4">

                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-slate-500">
                        Administrator
                    </p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="bg-red-50 text-red-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-red-100 transition">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">

        <!-- Header -->
        <div class="mb-8">

            <p class="text-sm text-blue-700 font-bold">
                ADMIN PANEL
            </p>

            <h1 class="text-3xl font-extrabold text-slate-900 mt-2">
                Dashboard
            </h1>

            <p class="text-sm text-slate-500 mt-2">
                Selamat datang di halaman pengelolaan OtoCare.
            </p>

        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <!-- Total Booking -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

                <p class="text-sm text-slate-500">
                    Total Booking
                </p>

                <h2 class="text-3xl font-extrabold text-slate-900 mt-3">
                    {{ $totalBookings }}
                </h2>

                <p class="text-xs text-slate-400 mt-2">
                    Seluruh pemesanan
                </p>

            </div>

            <!-- Booking Menunggu -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

                <p class="text-sm text-slate-500">
                    Booking Menunggu
                </p>

                <h2 class="text-3xl font-extrabold text-amber-600 mt-3">
                    {{ $pendingBookings }}
                </h2>

                <p class="text-xs text-slate-400 mt-2">
                    Perlu ditindaklanjuti
                </p>

            </div>

            <!-- Total Pelanggan -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

                <p class="text-sm text-slate-500">
                    Total Pelanggan
                </p>

                <h2 class="text-3xl font-extrabold text-slate-900 mt-3">
                    {{ $totalCustomers }}
                </h2>

                <p class="text-xs text-slate-400 mt-2">
                    Pelanggan terdaftar
                </p>

            </div>

            <!-- Total Layanan -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

                <p class="text-sm text-slate-500">
                    Total Layanan
                </p>

                <h2 class="text-3xl font-extrabold text-slate-900 mt-3">
                    {{ $totalServices }}
                </h2>

                <p class="text-xs text-slate-400 mt-2">
                    Data layanan tersedia
                </p>

            </div>

        </div>

        <!-- Daftar dan Kelola Pesanan -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm mt-8 overflow-hidden">

            <!-- Header Daftar Pesanan -->
            <div class="p-6 border-b border-slate-200">

                <div class="flex flex-wrap items-center justify-between gap-3">

                    <div>
                        <h2 class="text-lg font-extrabold text-slate-900">
                            Daftar Pesanan
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Lihat dan kelola seluruh pesanan pelanggan.
                        </p>
                    </div>

                    <span class="bg-blue-50 text-blue-700 px-3 py-2 rounded-lg text-xs font-bold">
                        {{ $totalBookings }} Total Pesanan
                    </span>

                </div>

            </div>

            <!-- Notifikasi Berhasil -->
            @if (session()->has('success'))
                <div class="mx-6 mt-5 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Notifikasi Error -->
            @if (session()->has('error'))
                <div class="mx-6 mt-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tabel Pesanan -->
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1100px] text-sm text-left">

                    <thead class="bg-slate-50 text-slate-500">

                        <tr>
                            <th class="px-5 py-4 font-semibold">
                                Booking
                            </th>

                            <th class="px-5 py-4 font-semibold">
                                Pelanggan
                            </th>

                            <th class="px-5 py-4 font-semibold">
                                Kendaraan
                            </th>

                            <th class="px-5 py-4 font-semibold">
                                Layanan
                            </th>

                            <th class="px-5 py-4 font-semibold">
                                Jadwal
                            </th>

                            <th class="px-5 py-4 font-semibold">
                                Pengerjaan
                            </th>

                            <th class="px-5 py-4 font-semibold">
                                Pembayaran
                            </th>

                            <th class="px-5 py-4 font-semibold">
                                Aksi
                            </th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($latestBookings as $booking)

                            <tr wire:key="booking-{{ $booking['id'] }}"
                                class="hover:bg-slate-50 transition">

                                <!-- ID Booking -->
                                <td class="px-5 py-4 font-bold text-slate-700">
                                    #{{ $booking['id'] }}
                                </td>

                                <!-- Pelanggan -->
                                <td class="px-5 py-4">
                                    <p class="font-bold text-slate-800">
                                        {{ $booking['customer_name'] }}
                                    </p>
                                </td>

                                <!-- Kendaraan -->
                                <td class="px-5 py-4 text-slate-600">
                                    {{ $booking['plate_number'] }}
                                </td>

                                <!-- Layanan -->
                                <td class="px-5 py-4 text-slate-600">
                                    {{ $booking['service_name'] }}
                                </td>

                                <!-- Jadwal -->
                                <td class="px-5 py-4 text-slate-600 whitespace-nowrap">

                                    {{ $booking['booking_date'] }}

                                    <p class="text-xs text-slate-400 mt-1">
                                        {{ substr($booking['booking_time'], 0, 5) }}
                                    </p>

                                </td>

                                <!-- Status Pengerjaan -->
                                <td class="px-5 py-4">

                                    <select
                                        wire:model="bookingStatus.{{ $booking['id'] }}"
                                        class="w-36 border border-slate-300 rounded-lg px-3 py-2 text-xs font-semibold bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                                        <option value="Menunggu">
                                            Menunggu
                                        </option>

                                        <option value="Diproses">
                                            Diproses
                                        </option>

                                        <option value="Selesai">
                                            Selesai
                                        </option>

                                        <option value="Dibatalkan">
                                            Dibatalkan
                                        </option>

                                    </select>

                                </td>

                                <!-- Status Pembayaran -->
                                <td class="px-5 py-4">

                                    @if ($booking['payment_id'])

                                        <select
                                            wire:model="paymentStatus.{{ $booking['id'] }}"
                                            class="w-40 border border-slate-300 rounded-lg px-3 py-2 text-xs font-semibold bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                                            <option value="Belum Dibayar">
                                                Belum Dibayar
                                            </option>

                                            <option value="Menunggu Verifikasi">
                                                Menunggu Verifikasi
                                            </option>

                                            <option value="Lunas">
                                                Lunas
                                            </option>

                                        </select>

                                        <p class="text-xs text-slate-400 mt-1">
                                            {{ $booking['payment_method'] }}
                                        </p>

                                    @else

                                        <span class="text-xs text-slate-400">
                                            Belum tersedia
                                        </span>

                                    @endif

                                </td>

                                <!-- Tombol Simpan -->
                                <td class="px-5 py-4">

                                    <button
                                        type="button"
                                        wire:click="updateStatuses({{ $booking['id'] }})"
                                        wire:loading.attr="disabled"
                                        wire:target="updateStatuses({{ $booking['id'] }})"
                                        class="bg-blue-700 hover:bg-blue-800 disabled:opacity-50 text-white px-4 py-2 rounded-lg text-xs font-bold transition whitespace-nowrap">

                                        <span wire:loading.remove
                                            wire:target="updateStatuses({{ $booking['id'] }})">
                                            Simpan
                                        </span>

                                        <span wire:loading
                                            wire:target="updateStatuses({{ $booking['id'] }})">
                                            Menyimpan...
                                        </span>

                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8"
                                    class="px-6 py-12 text-center text-slate-400">

                                    Belum ada data booking.

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            <div class="px-6 py-5 border-t border-slate-200 flex flex-wrap items-center justify-between gap-4">

                <!-- Informasi Jumlah Data -->
                <p class="text-xs text-slate-500">

                    Menampilkan

                    <span class="font-bold text-slate-700">
                        {{ $totalBookings === 0 ? 0 : (($currentPage - 1) * $perPage) + 1 }}
                    </span>

                    -

                    <span class="font-bold text-slate-700">
                        {{ min($currentPage * $perPage, $totalBookings) }}
                    </span>

                    dari

                    <span class="font-bold text-slate-700">
                        {{ $totalBookings }}
                    </span>

                    pesanan

                </p>

                <!-- Tombol Pagination -->
                <div class="flex items-center gap-2">

                    <button
                        type="button"
                        wire:click="previousPage"
                        @disabled($currentPage <= 1)
                        class="px-3 py-2 rounded-lg border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50 disabled:opacity-40 disabled:cursor-not-allowed">

                        ←

                    </button>

                    <span class="text-xs font-semibold text-slate-600 px-2">
                        Halaman {{ $currentPage }} dari {{ $totalPages }}
                    </span>

                    <button
                        type="button"
                        wire:click="nextPage"
                        @disabled($currentPage >= $totalPages)
                        class="px-3 py-2 rounded-lg border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50 disabled:opacity-40 disabled:cursor-not-allowed">

                        →

                    </button>

                </div>

            </div>

        </div>

        <!-- Footer -->
        <p class="text-xs text-slate-400 text-center mt-8">
            OtoCare Admin Panel
        </p>

    </main>

</div>