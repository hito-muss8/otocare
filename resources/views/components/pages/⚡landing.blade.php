
<?php

use Livewire\Component;

new class extends Component
{
    public array $advantages = [
        [
            'title' => 'Bebas Antre',
            'description' => 'Reservasi slot bay secara online, tiba di outlet langsung dikerjakan teknisi tanpa menunggu lama.',
            'icon' => 'icon',
        ],
        [
            'title' => 'Jemput / Antar',
            'description' => 'Layanan valet amanah siap menjemput dan mengantarkan kendaraan Anda sampai ke teras rumah.',
            'icon' => 'icon',
        ],
        [
            'title' => 'Pantau Real-Time',
            'description' => 'Cek linimasa tahap cuci, foto dokumentasi, serta live GPS valet driver langsung dari ponsel.',
            'icon' => 'icon',
        ],
    ];

    public array $services = [
        [
            'name' => 'Cuci Komplit + Hydrophobic Wax',
            'price' => 50000,
            'duration' => '45 mnt',
            'description' => 'Pembersihan menyeluruh dengan perlindungan hydrophobic wax.',
            'icon' => 'icon',
        ],
        [
            'name' => 'Signature Full Detailing',
            'price' => 250000,
            'duration' => '120 mnt',
            'description' => 'Perawatan detail untuk tampilan kendaraan lebih maksimal.',
            'icon' => 'icon',
        ],
        [
            'name' => 'Deep Interior Cleansing & Fogging',
            'price' => 120000,
            'duration' => '60 mnt',
            'description' => 'Pembersihan interior dan fogging untuk kabin kendaraan.',
            'icon' => 'icon',
        ],
        [
            'name' => 'Cuci Cepat Eksterior Reguler',
            'price' => 30000,
            'duration' => '25 mnt',
            'description' => 'Pembersihan eksterior praktis untuk aktivitas harian.',
            'icon' => 'icon',
        ],
    ];

    public array $steps = [
        [
            'title' => 'Pilih Layanan & Jadwal',
            'description' => 'Tentukan paket perawatan dan waktu reservasi sesuai kebutuhan.',
            'icon' => 'icon',
        ],
        [
            'title' => 'Antar Sendiri atau Valet',
            'description' => 'Datang langsung ke outlet atau gunakan layanan jemput kendaraan.',
            'icon' => 'icon',
        ],
        [
            'title' => 'Terima Bersih Berkilau',
            'description' => 'Nikmati kendaraan yang bersih dan siap digunakan kembali.',
            'icon' => 'icon',
        ],
    ];

    public array $testimonials = [
        [
            'message' => 'Teknisinya sangat teliti. Motor Vario saya kinclong sampai ke sela mesin.',
            'name' => 'Andi Pratama',
            'initial' => 'A',
        ],
        [
            'message' => 'Biasanya malas antre 2 jam tiap weekend. Di OtoCare tinggal booking jam 10.',
            'name' => 'Rina Wijaya',
            'initial' => 'R',
        ],
        [
            'message' => 'Transparansi dengan foto progres langsung di aplikasi.',
            'name' => 'Hendra Kusuma',
            'initial' => 'H',
        ],
    ];

    public array $faqs = [
        [
            'question' => 'Apakah saya harus memesan jauh-jauh hari?',
            'answer' => 'Tidak, slot instan harian tersedia. Namun, reservasi lebih awal disarankan agar Anda mendapatkan jadwal yang diinginkan.',
        ],
        [
            'question' => 'Bagaimana jika turun hujan setelah dicuci?',
            'answer' => 'OtoCare menyediakan garansi cuci ulang 1x24 jam sesuai ketentuan layanan.',
        ],
        [
            'question' => 'Apakah aman menyerahkan kunci ke driver valet?',
            'answer' => 'Driver valet merupakan petugas terlatih dan layanan dilengkapi perlindungan sesuai ketentuan operasional.',
        ],
        [
            'question' => 'Metode pembayaran apa saja yang didukung?',
            'answer' => 'Pembayaran dapat dilakukan melalui QRIS, transfer Virtual Account, dan pembayaran di tempat.',
        ],
    ];

    public function rupiah(int $price): string
    {
        return 'Rp' . number_format($price, 0, ',', '.');
    }
};
?>

<div class="min-h-screen bg-white text-slate-900">

    {{-- NAVIGATION --}}
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-100">

        <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="{{ route('landing') }}"
                class="text-2xl font-extrabold tracking-tight text-blue-950">
                Oto<span class="text-blue-600">Care.</span>
            </a>

            <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">

                <a href="{{ route('booking') }}"
                    class="hover:text-blue-700 transition">
                    Layanan
                </a>

                <a href="#keunggulan"
                    class="hover:text-blue-700 transition">
                    Keunggulan
                </a>

                <a href="#cara-kerja"
                    class="hover:text-blue-700 transition">
                    Cara Kerja
                </a>

                <a href="#faq"
                    class="hover:text-blue-700 transition">
                    FAQ
                </a>

            </div>

            <div class="flex items-center gap-3">

                <a href="{{ route('booking') }}"
                    class="hidden sm:inline-flex bg-blue-950 hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition">
                    Booking Sekarang
                </a>

                <a href="/masuk"
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 hover:bg-slate-200 text-blue-950 transition"
                    aria-label="Masuk">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M20 21a8 8 0 0 0-16 0"/>
                        <circle cx="12" cy="8" r="4"/>
                    </svg>
                </a>

            </div>

        </nav>

    </header>


    <main>

        {{-- HERO SECTION --}}
        <section class="bg-slate-50 overflow-hidden">

            <div class="max-w-7xl mx-auto px-6 py-20 lg:py-28">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

                    <div>

                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-900 text-xs sm:text-sm font-bold mb-6">
                            <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                            Reservasi Online #1 di Jabodetabek
                        </span>

                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight text-blue-950">
                            Cuci Kendaraan
                            <span class="text-blue-600">
                                Tanpa Antre,
                            </span>
                            Bisa Diantar ke Rumah
                        </h1>

                        <p class="mt-6 text-slate-600 leading-relaxed text-base sm:text-lg max-w-xl">
                            Layanan cuci dan perawatan presisi mobil & motor berbasis reservasi online.
                            Teknisi bersertifikat, pantau progres real-time, dan antar-jemput valet terpercaya.
                        </p>

                        <div class="flex flex-wrap gap-4 mt-8">

                            <a href="{{ route('booking') }}"
                                class="inline-flex items-center gap-2 bg-blue-950 hover:bg-blue-800 text-white px-7 py-4 rounded-xl font-bold transition shadow-lg shadow-blue-950/15">
                                Booking Sekarang
                                <span>→</span>
                            </a>

                            <a href="#layanan"
                                class="inline-flex items-center border border-slate-300 hover:border-blue-700 hover:text-blue-700 px-7 py-4 rounded-xl font-bold transition">
                                Lihat Paket Layanan
                            </a>

                        </div>

                        <div class="flex flex-wrap gap-8 mt-10">

                            <div>
                                <h3 class="text-2xl font-extrabold text-blue-950">
                                    500+
                                </h3>
                                <p class="text-sm text-slate-500 mt-1">
                                    Pelanggan
                                </p>
                            </div>

                            <div>
                                <h3 class="text-2xl font-extrabold text-blue-950">
                                    4.9/5
                                </h3>
                                <p class="text-sm text-slate-500 mt-1">
                                    Kepuasan Pelanggan
                                </p>
                            </div>

                            <div>
                                <h3 class="text-2xl font-extrabold text-blue-950">
                                    24/7
                                </h3>
                                <p class="text-sm text-slate-500 mt-1">
                                    Reservasi Online
                                </p>
                            </div>

                        </div>

                    </div>


                    {{-- HERO VISUAL --}}
                    <div class="relative">

                        <div class="absolute -top-8 -right-8 w-40 h-40 bg-blue-200 rounded-full blur-3xl opacity-60"></div>

                        <div class="absolute -bottom-8 -left-8 w-40 h-40 bg-cyan-200 rounded-full blur-3xl opacity-60"></div>

                        <div class="relative min-h-[350px] sm:min-h-[450px] rounded-[2rem] overflow-hidden bg-gradient-to-br from-blue-950 via-blue-900 to-slate-800 flex flex-col justify-between p-8 sm:p-10 shadow-2xl">

                            <div class="absolute inset-0 opacity-10"
                                style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;">
                            </div>
                            
                            {{-- banner gambar --}}
                            <div class="relative z-10">

                                <span class="text-blue-200 text-sm font-semibold tracking-widest uppercase">
                                    OtoCare Premium Service
                                </span>

                                <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-4 max-w-sm">
                                    Perawatan Terbaik untuk Kendaraan Anda
                                </h2>

                            </div>

                            <div class="relative z-10 flex justify-center py-8">

                                <div class="text-[110px] sm:text-[150px] drop-shadow-2xl">
                                    Gambar
                                </div>

                            </div>

                            <div class="relative z-10 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-5 flex items-center justify-between gap-4">

                                {{-- informasi gambar --}}
                                <div>
                                    <p class="text-blue-200 text-xs font-semibold">
                                        STANDAR LAYANAN
                                    </p>

                                    <h3 class="text-white font-bold mt-1">
                                        Teknisi Standar Detailing
                                    </h3>
                                </div>

                                {{-- logo --}}
                                <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-2xl">
                                    icon
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ADVANTAGES --}}
        <section id="keunggulan" class="py-20">

            <div class="max-w-7xl mx-auto px-6">

                <div class="text-center max-w-2xl mx-auto mb-12">

                    <p class="text-sm font-bold tracking-widest text-blue-700 mb-3">
                        STANDAR KEUNGGULAN
                    </p>

                    <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-950">
                        Kenapa Memilih Layanan OtoCare?
                    </h2>

                    <p class="text-slate-500 mt-4">
                        Kami memberikan pengalaman perawatan kendaraan yang praktis, transparan, dan terpercaya.
                    </p>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    @foreach ($advantages as $advantage)

                        <div class="group bg-white border border-slate-200 hover:border-blue-300 hover:shadow-xl hover:shadow-blue-950/5 rounded-2xl p-7 transition">

                            <div class="w-14 h-14 bg-blue-50 group-hover:bg-blue-100 rounded-2xl flex items-center justify-center text-3xl transition">
                                {{ $advantage['icon'] }}
                            </div>

                            <h3 class="text-xl font-bold text-blue-950 mt-6">
                                {{ $advantage['title'] }}
                            </h3>

                            <p class="text-slate-500 text-sm leading-relaxed mt-3">
                                {{ $advantage['description'] }}
                            </p>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>


        {{-- SERVICES --}}
        <section id="layanan" class="py-20 bg-slate-50">

            <div class="max-w-7xl mx-auto px-6">

                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-12">

                    <div>
                        <p class="text-sm font-bold tracking-widest text-blue-700 mb-3">
                            PILIHAN PERAWATAN
                        </p>

                        <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-950">
                            Katalog Paket Layanan Populer
                        </h2>

                        <p class="text-slate-500 mt-3">
                            Temukan paket perawatan sesuai kebutuhan kendaraan Anda.
                        </p>
                    </div>

                    <a href="{{ route('booking') }}"
                        class="text-blue-800 font-bold text-sm hover:text-blue-600 transition">
                        Semua Layanan →
                    </a>

                </div>


                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    @foreach ($services as $service)

                        <div class="bg-white border border-slate-200 hover:border-blue-300 hover:shadow-xl rounded-2xl p-6 flex flex-col transition">

                            <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center text-3xl mb-5">
                                {{ $service['icon'] }}
                            </div>

                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-3">
                                <span>◷</span>
                                {{ $service['duration'] }}
                            </div>

                            <h3 class="text-lg font-bold text-blue-950 leading-snug">
                                {{ $service['name'] }}
                            </h3>

                            <p class="text-sm text-slate-500 leading-relaxed mt-3">
                                {{ $service['description'] }}
                            </p>

                            <div class="mt-auto pt-7">

                                <p class="text-xs text-slate-400">
                                    Mulai dari
                                </p>

                                <h2 class="text-2xl font-extrabold text-blue-950 mt-1">
                                    {{ $this->rupiah($service['price']) }}
                                </h2>

                                <a href="{{ route('booking') }}"
                                    class="block text-center w-full mt-5 px-4 py-3 border border-blue-950 text-blue-950 hover:bg-blue-950 hover:text-white rounded-xl font-bold text-sm transition">
                                    Pilih Layanan
                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>


        {{-- HOW IT WORKS --}}
        <section id="cara-kerja" class="py-20">

            <div class="max-w-7xl mx-auto px-6">

                <div class="text-center mb-12">

                    <p class="text-sm font-bold tracking-widest text-blue-700 mb-3">
                        PROSES RESERVASI
                    </p>

                    <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-950">
                        Cara Kerja OtoCare
                    </h2>

                    <p class="text-slate-500 mt-4">
                        Tiga langkah mudah untuk mendapatkan layanan perawatan kendaraan.
                    </p>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    @foreach ($steps as $index => $step)

                        <div class="relative bg-white border border-slate-200 rounded-2xl p-8">

                            <div class="flex items-center justify-between">

                                <span class="text-5xl font-extrabold text-blue-100">
                                    0{{ $index + 1 }}
                                </span>

                                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-3xl">
                                    {{ $step['icon'] }}
                                </div>

                            </div>

                            <h3 class="text-xl font-bold text-blue-950 mt-7">
                                {{ $step['title'] }}
                            </h3>

                            <p class="text-sm text-slate-500 leading-relaxed mt-3">
                                {{ $step['description'] }}
                            </p>

                        </div>

                    @endforeach

                </div>

                <div class="text-center mt-10">

                    <a href="{{ route('booking') }}"
                        class="inline-flex items-center gap-2 bg-blue-950 hover:bg-blue-800 text-white px-7 py-4 rounded-xl font-bold transition">
                        Mulai Booking Sekarang →
                    </a>

                </div>

            </div>

        </section>


        {{-- TESTIMONIALS --}}
        <section class="py-20 bg-slate-50">

            <div class="max-w-7xl mx-auto px-6">

                <div class="text-center mb-12">

                    <p class="text-sm font-bold tracking-widest text-blue-700 mb-3">
                        TESTIMONI PELANGGAN
                    </p>

                    <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-950">
                        Apa Kata Mereka yang Sudah Mencoba?
                    </h2>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    @foreach ($testimonials as $testimonial)

                        <div class="bg-white border border-slate-200 rounded-2xl p-7">

                            <div class="text-amber-500 tracking-widest text-xl">
                                ★★★★★
                            </div>

                            <p class="text-slate-600 text-sm leading-relaxed mt-5">
                                “{{ $testimonial['message'] }}”
                            </p>

                            <div class="flex items-center gap-3 mt-7">

                                <div class="w-11 h-11 rounded-full bg-blue-100 text-blue-950 flex items-center justify-center font-bold">
                                    {{ $testimonial['initial'] }}
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold text-blue-950">
                                        {{ $testimonial['name'] }}
                                    </h3>

                                    <p class="text-xs text-slate-400 mt-1">
                                        Pelanggan OtoCare
                                    </p>
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>


        {{-- FAQ --}}
        <section id="faq" class="py-20">

            <div class="max-w-3xl mx-auto px-6">

                <div class="text-center mb-12">

                    <p class="text-sm font-bold tracking-widest text-blue-700 mb-3">
                        PUSAT INFORMASI
                    </p>

                    <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-950">
                        Pertanyaan yang Sering Diajukan
                    </h2>

                </div>

                <div class="space-y-4">

                    @foreach ($faqs as $faq)

                        <details class="group bg-white border border-slate-200 rounded-xl p-5">

                            <summary class="cursor-pointer list-none flex items-center justify-between gap-4 font-bold text-blue-950">

                                {{ $faq['question'] }}

                                <span class="text-blue-700 text-xl transition-transform group-open:rotate-45">
                                    +
                                </span>

                            </summary>

                            <p class="text-sm text-slate-500 leading-relaxed mt-4 pr-8">
                                {{ $faq['answer'] }}
                            </p>

                        </details>

                    @endforeach

                </div>

            </div>

        </section>


        {{-- CALL TO ACTION --}}
        <section class="py-16">

            <div class="max-w-7xl mx-auto px-6">

                <div class="relative overflow-hidden bg-blue-950 rounded-3xl p-8 sm:p-12 flex flex-col lg:flex-row items-center justify-between gap-8">

                    <div class="absolute -right-20 -top-24 w-72 h-72 bg-blue-700 rounded-full opacity-30 blur-3xl"></div>

                    <div class="relative z-10">

                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white max-w-2xl">
                            Siap Nikmati Kendaraan Bersih Berkilau?
                        </h2>

                        <p class="text-blue-200 text-sm sm:text-base mt-4 max-w-xl leading-relaxed">
                            Dapatkan +500 Poin Loyalitas & Kupon Diskon untuk reservasi perdana Anda.
                        </p>

                    </div>

                    <div class="relative z-10 shrink-0">

                        <a href="{{ route('booking') }}"
                            class="inline-flex items-center gap-2 bg-white hover:bg-blue-50 text-blue-950 px-7 py-4 rounded-xl font-bold transition">
                            Booking Servis Sekarang →
                        </a>

                    </div>

                </div>

            </div>

        </section>

    </main>


    {{-- FOOTER --}}
    <footer class="bg-slate-950 text-white">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                <div>

                    <a href="{{ route('landing') }}"
                        class="text-2xl font-extrabold">
                        Oto<span class="text-blue-400">Care.</span>
                    </a>

                    <p class="text-slate-400 text-sm leading-relaxed mt-4 max-w-sm">
                        Solusi modern untuk perawatan kendaraan yang praktis, nyaman, dan terpercaya.
                    </p>

                </div>

                <div>

                    <h3 class="font-bold mb-4">
                        Navigasi
                    </h3>

                    <div class="flex flex-col gap-3 text-sm text-slate-400">

                        <a href="{{ route('landing') }}" class="hover:text-white transition">
                            Beranda
                        </a>

                        <a href="#keunggulan" class="hover:text-white transition">
                            Keunggulan
                        </a>

                        <a href="#layanan" class="hover:text-white transition">
                            Layanan
                        </a>

                        <a href="#faq" class="hover:text-white transition">
                            FAQ
                        </a>

                    </div>

                </div>

                <div>

                    <h3 class="font-bold mb-4">
                        Layanan
                    </h3>

                    <div class="flex flex-col gap-3 text-sm text-slate-400">

                        <a href="{{ route('booking') }}" class="hover:text-white transition">
                            Booking Online
                        </a>

                        <a href="{{ route('booking') }}" class="hover:text-white transition">
                            Cuci Kendaraan
                        </a>

                        <a href="{{ route('booking') }}" class="hover:text-white transition">
                            Valet Service
                        </a>

                    </div>

                </div>

            </div>

            <div class="border-t border-slate-800 mt-10 pt-6 text-center text-xs text-slate-500">

                © {{ date('Y') }} OtoCare. All rights reserved.

            </div>

        </div>

    </footer>

</div>
