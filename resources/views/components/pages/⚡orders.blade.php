<?php

use Livewire\Component;

new class extends Component
{
    // Dummy Data Orders (Frontend Only)
    public array $orders = [
        [
            'id' => 'OTC-8821',
            'service_name' => 'Cuci Komplit + Hydrophobic Wax',
            'vehicle' => 'Honda Vario 160 (AB 1234 XX)',
            'date' => '10 Nov 2026 - 14:00 WIB',
            'type' => 'Valet (Jemput-Antar)',
            'price' => 50000,
            'status' => 'Proses Cuci',
            'badge' => 'bg-amber-50 text-amber-800 border-amber-200',
        ],
        [
            'id' => 'OTC-8790',
            'service_name' => 'Signature Full Detailing',
            'vehicle' => 'Toyota Avanza (AB 5678 YY)',
            'date' => '05 Nov 2026 - 09:00 WIB',
            'type' => 'Datang Langsung',
            'price' => 250000,
            'status' => 'Selesai',
            'badge' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        ],
        [
            'id' => 'OTC-8512',
            'service_name' => 'Deep Interior Cleansing',
            'vehicle' => 'Honda Vario 160 (AB 1234 XX)',
            'date' => '28 Okt 2026 - 11:00 WIB',
            'type' => 'Datang Langsung',
            'price' => 120000,
            'status' => 'Selesai',
            'badge' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        ]
    ];

    public function rupiah(int $price): string
    {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }
};
?>

<div class="min-h-screen bg-slate-50/50 text-slate-800 font-sans antialiased pb-20">

    {{-- HEADER --}}
    <header class="bg-white/95 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="text-2xl font-extrabold tracking-tight text-slate-900">
                Oto<span class="text-blue-800">Care.</span>
            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('booking') }}" class="text-sm font-bold text-blue-800 hover:text-slate-900 transition">
                    + Booking Baru
                </a>
                <a href="{{ route('account') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200/60 flex items-center justify-center text-slate-800 font-bold transition">
                    👤
                </a>
            </div>
        </div>
    </header>

    {{-- KONTEN UTAMA ORDERS --}}
    <main class="max-w-4xl mx-auto px-6 py-10">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold tracking-widest text-blue-800 uppercase bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
                    Riwayat Reservasi
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 mt-3">Pesanan Saya</h1>
                <p class="text-slate-500 text-sm mt-1">Pantau status pengerjaan cuci dan riwayat reservasi Anda.</p>
            </div>
        </div>

        {{-- DAFTAR KARTU PESANAN --}}
        <div class="space-y-6">
            @forelse ($orders as $order)
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-xs hover:shadow-md transition">
                    
                    {{-- TOP CARD INFO --}}
                    <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-slate-100">
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 tracking-wider uppercase">NO. RESERVASI</span>
                            <h3 class="text-base font-extrabold text-slate-900">{{ $order['id'] }}</h3>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $order['badge'] }}">
                                ● {{ $order['status'] }}
                            </span>
                        </div>
                    </div>

                    {{-- DETAIL ORDERS --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 py-5">
                        <div>
                            <p class="text-xs font-semibold text-slate-400">Paket Layanan</p>
                            <p class="text-sm font-bold text-slate-900 mt-1">{{ $order['service_name'] }}</p>
                            <span class="inline-block mt-2 px-2.5 py-0.5 rounded-md bg-slate-100 text-slate-700 text-xs font-semibold">
                                {{ $order['type'] }}
                            </span>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-slate-400">Kendaraan & Waktu</p>
                            <p class="text-sm font-bold text-slate-700 mt-1">{{ $order['vehicle'] }}</p>
                            <p class="text-xs text-slate-500 mt-1">🕒 {{ $order['date'] }}</p>
                        </div>

                        <div class="sm:text-right">
                            <p class="text-xs font-semibold text-slate-400">Total Pembayaran</p>
                            <p class="text-lg font-extrabold text-blue-800 mt-1">{{ $this->rupiah($order['price']) }}</p>
                        </div>
                    </div>

                    {{-- FOOTER CARD --}}
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs text-slate-400">Diperbarui secara real-time oleh teknisi</span>
                        <a href="{{ route('payment') }}" class="px-4 py-2 border border-slate-200 hover:border-blue-800 hover:text-blue-800 rounded-xl text-xs font-bold text-slate-700 transition">
                            Detail Pengerjaan →
                        </a>
                    </div>

                </div>
            @empty
                <div class="bg-white border border-slate-200/80 rounded-2xl p-12 text-center">
                    <p class="text-slate-500 font-semibold text-sm">Belum ada riwayat pesanan.</p>
                </div>
            @endforelse
        </div>

    </main>

</div>