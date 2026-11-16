
<?php

use Livewire\Component;
use Illuminate\Support\Facades\DB;

new class extends Component
{
    public $orders = [];

    public function mount(): void
    {
        $customerId = session('current_customer_id');

        if (!$customerId) {
            $this->orders = [];
            return;
        }

        $this->orders = DB::table('bookings')
            ->join('customers', 'bookings.customer_id', '=', 'customers.id')
            ->join('vehicles', 'bookings.vehicle_id', '=', 'vehicles.id')
            ->join('services', 'bookings.service_id', '=', 'services.id')
            ->leftJoin('payments', 'bookings.id', '=', 'payments.booking_id')
            ->where('bookings.customer_id', $customerId)
            ->select(
                'bookings.id',
                'bookings.booking_date',
                'bookings.booking_time',
                'bookings.status as booking_status',
                'services.name as service_name',
                'services.price',
                'vehicles.vehicle_type',
                'vehicles.vehicle_model',
                'vehicles.plate_number',
                'payments.method as payment_method',
                'payments.status as payment_status'
            )
            ->orderByDesc('bookings.id')
            ->get();
    }

    public function rupiah($price): string
    {
        return 'Rp ' . number_format((float) $price, 0, ',', '.');
    }
};
?>

<div class="min-h-screen bg-slate-50 text-slate-800">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-5xl mx-auto px-5 py-4 flex justify-between items-center">
            <a href="{{ route('landing') }}" class="text-2xl font-extrabold text-slate-900">
                Oto<span class="text-blue-800">Care.</span>
            </a>
            <a href="{{ route('booking') }}"
            class="bg-blue-900 !text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-blue-700">
                + Booking Baru
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-5 py-10">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-800">Riwayat Reservasi</p>
        <h1 class="text-3xl font-extrabold mt-2">Pesanan Saya</h1>
        <p class="text-slate-500 text-sm mt-2 mb-8">
            Daftar reservasi yang telah kamu buat.
        </p>

        @if (session()->has('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl p-4 mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-5">
            @forelse ($orders as $order)
                <article class="bg-white border border-slate-200 rounded-2xl p-6">
                    <div class="flex flex-col sm:flex-row justify-between gap-3 border-b pb-4">
                        <div>
                            <p class="text-xs text-slate-400 font-semibold">NOMOR BOOKING</p>
                            <h2 class="text-xl font-extrabold mt-1">#{{ $order->id }}</h2>
                        </div>

                        <span class="text-sm font-bold text-amber-700 bg-amber-50 border border-amber-200 rounded-full px-4 py-2 h-fit">
                            {{ $order->booking_status }}
                        </span>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-5 py-5">
                        <div>
                            <p class="text-xs text-slate-400">Layanan</p>
                            <p class="font-bold mt-1">{{ $order->service_name }}</p>

                            <p class="text-xs text-slate-400 mt-4">Kendaraan</p>
                            <p class="font-semibold mt-1">
                                {{ $order->vehicle_model }} ({{ $order->vehicle_type }})
                            </p>
                            <p class="text-sm text-slate-500">{{ $order->plate_number }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-400">Jadwal Reservasi</p>
                            <p class="font-semibold mt-1">{{ $order->booking_date }}</p>
                            <p class="text-sm text-slate-500">
                                {{ substr($order->booking_time, 0, 5) }} WIB
                            </p>

                            <p class="text-xs text-slate-400 mt-4">Metode Pembayaran</p>
                            <p class="font-semibold mt-1">
                                {{ $order->payment_method ?? 'Belum Dipilih' }}
                            </p>
                        </div>
                    </div>

                    <div class="border-t pt-4 flex flex-col sm:flex-row justify-between gap-3">
                        <div>
                            <p class="text-xs text-slate-400">Total Pembayaran</p>
                            <p class="text-xl font-extrabold text-blue-900 mt-1">
                                {{ $this->rupiah($order->price) }}
                            </p>
                        </div>

                        <div class="text-sm sm:text-right">
                            <p class="text-xs text-slate-400">Status Pembayaran</p>
                            <p class="font-bold mt-1">
                                {{ $order->payment_status ?? 'Belum Ada Pembayaran' }}
                            </p>
                        </div>
                    </div>
                </article>
            @empty
                <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center">
                    <div class="text-4xl mb-4">📋</div>
                    <h2 class="font-bold text-lg">Belum Ada Pesanan</h2>
                    <p class="text-sm text-slate-500 mt-2">
                        Pesanan yang kamu buat akan muncul di halaman ini.
                    </p>
                    <a href="{{ route('booking') }}"
                        class="inline-block mt-5 bg-blue-800 text-white px-5 py-3 rounded-xl text-sm font-bold">
                        Buat Booking
                    </a>
                </div>
            @endforelse
        </div>
    </main>
</div>
