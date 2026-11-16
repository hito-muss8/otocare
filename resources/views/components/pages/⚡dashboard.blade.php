<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="text-2xl font-extrabold tracking-tight text-slate-900">
                Oto<span class="text-blue-800">Care.</span>
            </a>

            <span class="text-sm font-semibold text-slate-500">Dashboard</span>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="mb-8">
            <p class="text-xs font-bold tracking-widest uppercase text-blue-800">Ringkasan</p>
            <h1 class="text-3xl font-extrabold text-slate-900 mt-2">Dashboard OtoCare</h1>
            <p class="text-sm text-slate-500 mt-2">
                Ringkasan informasi dan aktivitas layanan OtoCare.
            </p>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
            <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-10 text-center">
                <p class="text-sm font-semibold text-slate-700">Konten dashboard belum tersedia.</p>
                <p class="text-xs text-slate-500 mt-2">
                    Komponen ringkasan dan data dashboard dapat ditambahkan setelah kebutuhan fiturnya ditentukan.
                </p>
            </div>
        </div>
    </main>
</div>