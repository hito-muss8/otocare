<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <a href="{{ route('landing') }}" class="text-2xl font-extrabold tracking-tight text-slate-900">
                Oto<span class="text-blue-800">Care.</span>
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-10">
        <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">
            <p class="text-xs font-bold tracking-widest uppercase text-blue-800">Akun Saya</p>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Profil Akun</h1>
            <p class="text-sm text-slate-500 mt-2">
                Halaman informasi akun OtoCare.
            </p>

            <div class="mt-8 rounded-xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center">
                <p class="text-sm font-semibold text-slate-700">Konten akun belum tersedia.</p>
                <p class="text-xs text-slate-500 mt-2">
                    Bagian ini dapat diisi setelah fitur pengelolaan akun dibuat.
                </p>
            </div>
        </div>
    </main>
</div>