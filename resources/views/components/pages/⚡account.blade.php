<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="min-h-screen bg-slate-50 text-slate-800 antialiased">

    {{-- HEADER --}}
    <header class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-4">

            {{-- LOGO --}}
            <a href="{{ route('landing') }}"
                class="text-2xl font-extrabold tracking-tight text-slate-900">
                Oto<span class="text-blue-800">Care.</span>
            </a>

            {{-- BACK TO LANDING --}}
            <a href="{{ route('landing') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-blue-700 transition">
                <span>←</span>
                Kembali ke Beranda
            </a>

        </div>
    </header>


    {{-- MAIN CONTENT --}}
    <main class="max-w-4xl mx-auto px-6 py-10">

        <div class="mb-7">
            <p class="text-xs font-bold tracking-widest uppercase text-blue-800">
                AKUN PENGGUNA
            </p>

            <h1 class="text-3xl font-extrabold text-slate-900 mt-2">
                Akun Saya
            </h1>

            <p class="text-sm text-slate-500 mt-2">
                Kelola dan lihat informasi akun OtoCare Anda.
            </p>
        </div>


        {{-- PROFILE CARD --}}
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

            {{-- PROFILE HEADER --}}
            <div class="bg-gradient-to-r from-blue-800 to-blue-900 px-6 py-8 sm:px-8">

                <div class="flex items-center gap-5">

                    <div class="w-16 h-16 rounded-2xl bg-white/15 border border-white/20 flex items-center justify-center text-white text-2xl font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <p class="text-blue-100 text-xs font-medium">
                            Selamat datang,
                        </p>

                        <h2 class="text-xl sm:text-2xl font-extrabold text-white mt-1">
                            {{ auth()->user()->name }}
                        </h2>

                        <p class="text-xs text-blue-100 mt-1">
                            Pelanggan OtoCare
                        </p>
                    </div>

                </div>

            </div>


            {{-- PROFILE INFORMATION --}}
            <div class="p-6 sm:p-8">

                <h3 class="text-lg font-bold text-slate-900">
                    Informasi Pribadi
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Informasi akun yang digunakan untuk layanan OtoCare.
                </p>


                <div class="mt-7 space-y-5">

                    {{-- NAME --}}
                    <div>
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Nama Lengkap
                        </label>

                        <div class="mt-2 px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl">
                            <p class="text-sm font-semibold text-slate-800">
                                {{ auth()->user()->name }}
                            </p>
                        </div>
                    </div>


                    {{-- EMAIL --}}
                    <div>
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Alamat Email
                        </label>

                        <div class="mt-2 px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl">
                            <p class="text-sm font-semibold text-slate-800">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                    </div>


                    {{-- PHONE --}}
                    <div>
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Nomor Telepon
                        </label>

                        <div class="mt-2 px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl">
                            <p class="text-sm font-semibold text-slate-800">
                                {{ auth()->user()->customer?->phone ?? 'Belum diisi' }}
                            </p>
                        </div>
                    </div>

                </div>


                {{-- NAVIGATION --}}
                <div class="border-t border-slate-100 mt-8 pt-6">

                    <h3 class="text-sm font-bold text-slate-900 mb-4">
                        Menu Akun
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                        <a href="{{ route('orders') }}"
                            class="flex items-center justify-between gap-3 p-4 border border-slate-200 rounded-xl hover:border-blue-300 hover:bg-blue-50 transition">

                            <div>
                                <p class="text-sm font-bold text-slate-800">
                                    Pesanan Saya
                                </p>

                                <p class="text-xs text-slate-500 mt-1">
                                    Lihat riwayat pemesanan
                                </p>
                            </div>

                            <span class="text-blue-700 text-lg">→</span>
                        </a>


                        <a href="{{ route('landing') }}"
                            class="flex items-center justify-between gap-3 p-4 border border-slate-200 rounded-xl hover:border-blue-300 hover:bg-blue-50 transition">

                            <div>
                                <p class="text-sm font-bold text-slate-800">
                                    Beranda
                                </p>

                                <p class="text-xs text-slate-500 mt-1">
                                    Kembali ke halaman utama
                                </p>
                            </div>

                            <span class="text-blue-700 text-lg">→</span>
                        </a>

                    </div>

                </div>

            </div>
        </div>

    </main>

</div>