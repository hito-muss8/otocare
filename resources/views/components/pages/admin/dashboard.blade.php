<?php

use Livewire\Component;
use Illuminate\Support\Facades\DB;

new class extends Component
{
    public $totalBookings = 0;
    public $pendingBookings = 0;
    public $totalCustomers = 0;
    public $totalServices = 0;
    public $latestBookings = [];

    public function mount(): void
    {
        $this->totalBookings = DB::table('bookings')->count();

        $this->pendingBookings = DB::table('bookings')
            ->where('status', 'Menunggu')
            ->count();

        $this->totalCustomers = DB::table('customers')->count();

        $this->totalServices = DB::table('services')->count();

        $this->latestBookings = DB::table('bookings')
            ->join('customers', 'bookings.customer_id', '=', 'customers.id')
            ->join('vehicles', 'bookings.vehicle_id', '=', 'vehicles.id')
            ->join('services', 'bookings.service_id', '=', 'services.id')
            ->select(
                'bookings.id',
                'customers.name as customer_name',
                'vehicles.plate_number',
                'services.name as service_name',
                'bookings.booking_date',
                'bookings.booking_time',
                'bookings.status'
            )
            ->orderByDesc('bookings.id')
            ->limit(5)
            ->get()
            ->map(fn ($booking) => (array) $booking)
            ->all();
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
                    <p class="text-xs text-slate-500">Administrator</p>
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
            <p class="text-sm text-blue-700 font-bold">ADMIN PANEL</p>

            <h1 class="text-3xl font-extrabold text-slate-900 mt-2">
                Dashboard
            </h1>

            <p class="text-sm text-slate-500 mt-2">
                Selamat datang di halaman pengelolaan OtoCare.
            </p>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                <p class="text-sm text-slate-500">Total Booking</p>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-3">
                    {{ $totalBookings }}
                </h2>
                <p class="text-xs text-slate-400 mt-2">Seluruh pemesanan</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                <p class="text-sm text-slate-500">Booking Menunggu</p>
                <h2 class="text-3xl font-extrabold text-amber-600 mt-3">
                    {{ $pendingBookings }}
                </h2>
                <p class="text-xs text-slate-400 mt-2">Perlu ditindaklanjuti</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                <p class="text-sm text-slate-500">Total Pelanggan</p>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-3">
                    {{ $totalCustomers }}
                </h2>
                <p class="text-xs text-slate-400 mt-2">Pelanggan terdaftar</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                <p class="text-sm text-slate-500">Total Layanan</p>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-3">
                    {{ $totalServices }}
                </h2>
                <p class="text-xs text-slate-400 mt-2">Data layanan tersedia</p>
            </div>

        </div>

        <!-- Latest Bookings -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm mt-8 overflow-hidden">

            <div class="p-6 border-b border-slate-200">
                <h2 class="text-lg font-extrabold text-slate-900">
                    Booking Terbaru
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Lima data pemesanan terbaru dari pelanggan.
                </p>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Pelanggan</th>
                            <th class="px-6 py-4 font-semibold">Kendaraan</th>
                            <th class="px-6 py-4 font-semibold">Layanan</th>
                            <th class="px-6 py-4 font-semibold">Tanggal</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($latestBookings as $booking)

                            <tr class="hover:bg-slate-50">

                                <td class="px-6 py-4 font-semibold text-slate-800">
                                    {{ $booking['customer_name'] }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $booking['plate_number'] }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $booking['service_name'] }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $booking['booking_date'] }}
                                    <br>
                                    <span class="text-xs text-slate-400">
                                        {{ substr($booking['booking_time'], 0, 5) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @if ($booking['status'] === 'Menunggu')
                                        <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold">
                                            Menunggu
                                        </span>
                                    @elseif ($booking['status'] === 'Diproses')
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                            Diproses
                                        </span>
                                    @elseif ($booking['status'] === 'Selesai')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                                            Dibatalkan
                                        </span>
                                    @endif
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5"
                                    class="px-6 py-10 text-center text-slate-400">
                                    Belum ada data booking.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>

        <p class="text-xs text-slate-400 text-center mt-8">
            OtoCare Admin Panel
        </p>

    </main>
</div>