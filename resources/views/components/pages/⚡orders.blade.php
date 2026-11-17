<?php

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public $orders = [];

    public function mount(): void
    {
        $this->loadOrders();
    }

    public function loadOrders(): void
    {
        // Mengambil ID customer dari akun yang sedang login
        $customerId = auth::user()?->customer_id;
    
        if (!$customerId) {
            $this->orders = [];
            return;
        }

        // Mengambil seluruh riwayat booking milik customer
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

<div class="min-h-screen bg-slate-50 text-slate-800"
     wire:poll.10s="loadOrders">

    {{-- HEADER --}}
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-5xl mx-auto px-5 py-4 flex flex-wrap justify-between items-center gap-4">

            <a href="{{ route('landing') }}"
                class="text-2xl font-extrabold text-slate-900">
                Oto<span class="text-blue-800">Care.</span>
            </a>

            <div class="flex items-center gap-3">

                <a href="{{ route('landing') }}"
                    class="text-sm font-semibold text-slate-600 hover:text-blue-700 transition">
                    Beranda
                </a>

                <a href="{{ route('account') }}"
                    class="hidden sm:inline-flex text-sm font-semibold text-slate-600 hover:text-blue-700 transition">
                    Akun Saya
                </a>

                <a href="{{ route('booking') }}"
                    class="bg-blue-900 !text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-blue-700 transition">
                    + Booking Baru
                </a>

            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="max-w-4xl mx-auto px-5 py-10">

        <p class="text-xs font-bold uppercase tracking-widest text-blue-800">
            Riwayat Reservasi
        </p>

        <h1 class="text-3xl font-extrabold mt-2">
            Pesanan Saya
        </h1>

        <p class="text-slate-500 text-sm mt-2 mb-8">
            Pantau seluruh riwayat dan perkembangan pesananmu.
        </p>

        @if (session()->has('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl p-4 mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-5">

            @forelse ($orders as $order)

                <article class="bg-white border border-slate-200 rounded-2xl p-6">

                    {{-- BOOKING HEADER --}}
                    <div class="flex flex-col sm:flex-row justify-between gap-3 border-b border-slate-200 pb-4">

                        <div>
                            <p class="text-xs text-slate-400 font-semibold">
                                NOMOR BOOKING
                            </p>

                            <h2 class="text-xl font-extrabold mt-1">
                                #{{ $order->id }}
                            </h2>
                        </div>

                        @php
                            $bookingColor = match ($order->booking_status) {
                                'Menunggu' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'Diproses' => 'bg-blue-50 text-blue-700 border-blue-200',
                                'Selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'Dibatalkan' => 'bg-red-50 text-red-700 border-red-200',
                                default => 'bg-slate-50 text-slate-600 border-slate-200',
                            };
                        @endphp

                        <span class="text-sm font-bold border rounded-full px-4 py-2 h-fit {{ $bookingColor }}">
                            {{ $order->booking_status }}
                        </span>

                    </div>

                    {{-- ORDER DETAILS --}}
                    <div class="grid sm:grid-cols-2 gap-5 py-5">

                        <div>
                            <p class="text-xs text-slate-400">Layanan</p>

                            <p class="font-bold mt-1">
                                {{ $order->service_name }}
                            </p>

                            <p class="text-xs text-slate-400 mt-4">
                                Kendaraan
                            </p>

                            <p class="font-semibold mt-1">
                                {{ $order->vehicle_model }} ({{ $order->vehicle_type }})
                            </p>

                            <p class="text-sm text-slate-500">
                                {{ $order->plate_number }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-400">
                                Jadwal Reservasi
                            </p>

                            <p class="font-semibold mt-1">
                                {{ $order->booking_date }}
                            </p>

                            <p class="text-sm text-slate-500">
                                {{ substr($order->booking_time, 0, 5) }} WIB
                            </p>

                            <p class="text-xs text-slate-400 mt-4">
                                Metode Pembayaran
                            </p>

                            <p class="font-semibold mt-1">
                                {{ $order->payment_method ?? 'Belum Dipilih' }}
                            </p>
                        </div>

                    </div>

                    {{-- PAYMENT DETAILS --}}
                    <div class="border-t border-slate-200 pt-4 flex flex-col sm:flex-row justify-between gap-3">

                        <div>
                            <p class="text-xs text-slate-400">
                                Total Pembayaran
                            </p>

                            <p class="text-xl font-extrabold text-blue-900 mt-1">
                                {{ $this->rupiah($order->price) }}
                            </p>
                        </div>

                        <div class="text-sm sm:text-right">

                            <p class="text-xs text-slate-400">
                                Status Pembayaran
                            </p>

                            @php
                                $paymentColor = match ($order->payment_status) {
                                    'Lunas' => 'text-emerald-700',
                                    'Menunggu Verifikasi' => 'text-blue-700',
                                    'Belum Dibayar' => 'text-amber-700',
                                    default => 'text-slate-500',
                                };
                            @endphp

                            <p class="font-bold mt-1 {{ $paymentColor }}">
                                {{ $order->payment_status ?? 'Belum Ada Pembayaran' }}
                            </p>

                        </div>

                    </div>

                </article>

            @empty

                <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center">

                    <div class="text-4xl mb-4">📋</div>

                    <h2 class="font-bold text-lg">
                        Belum Ada Pesanan
                    </h2>

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