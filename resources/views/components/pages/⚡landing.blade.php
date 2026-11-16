
<?php

use Livewire\Component;

new class extends Component
{
    public array $advantages = [
        [
            'title' => 'Bebas Antre',
            'description' => 'Reservasi slot bay secara online. Datang sesuai jadwal dan kendaraan langsung ditangani teknisi.',
        ],
        [
            'title' => 'Jemput / Antar',
            'description' => 'Nikmati kemudahan layanan jemput dan antar kendaraan sesuai ketentuan operasional.',
        ],
        [
            'title' => 'Pantau Proses',
            'description' => 'Dapatkan informasi mengenai tahapan pengerjaan kendaraan melalui layanan OtoCare.',
        ],
    ];

    public array $services = [
        [
            'name' => 'Cuci Komplit + Hydrophobic Wax',
            'price' => 30000,
            'duration' => '45 menit',
            'description' => 'Pembersihan menyeluruh dengan perlindungan hydrophobic wax.',
        ],
        [
            'name' => 'Signature Full Detailing',
            'price' => 100000,
            'duration' => '120 menit',
            'description' => 'Perawatan detail untuk tampilan kendaraan lebih maksimal.',
        ],
        [
            'name' => 'Deep Interior Cleansing & Fogging',
            'price' => 50000,
            'duration' => '60 menit',
            'description' => 'Pembersihan interior dan fogging untuk kabin kendaraan.',
        ],
        [
            'name' => 'Cuci Cepat Eksterior Reguler',
            'price' => 25000,
            'duration' => '25 menit',
            'description' => 'Pembersihan eksterior praktis untuk aktivitas harian.',
        ],
    ];

    public array $steps = [
        [
            'title' => 'Pilih Layanan & Jadwal',
            'description' => 'Tentukan paket perawatan dan waktu reservasi sesuai kebutuhan.',
        ],
        [
            'title' => 'Antar Sendiri atau Valet',
            'description' => 'Datang langsung ke outlet atau gunakan layanan jemput kendaraan.',
        ],
        [
            'title' => 'Terima Kendaraan',
            'description' => 'Nikmati kendaraan yang bersih dan siap digunakan kembali.',
        ],
    ];

    public array $testimonials = [
        [
            'message' => 'Teknisinya sangat teliti. Motor saya terlihat bersih dan terawat.',
            'name' => 'Ariana',
            'initial' => 'A',
        ],
        [
            'message' => 'Booking online memudahkan saya memilih jadwal tanpa harus antre.',
            'name' => 'Rizky',
            'initial' => 'R',
        ],
        [
            'message' => 'Proses pelayanan cukup praktis dan informasi layanan mudah dipahami.',
            'name' => 'Habibie',
            'initial' => 'H',
        ],
    ];

    public array $faqs = [
        [
            'question' => 'Apakah saya harus memesan jauh-jauh hari?',
            'answer' => 'Tidak selalu. Ketersediaan jadwal bergantung pada slot layanan yang tersedia. Reservasi lebih awal disarankan agar mendapatkan jadwal yang diinginkan.',
        ],
        [
            'question' => 'Bagaimana jika turun hujan setelah kendaraan dicuci?',
            'answer' => 'Silakan hubungi petugas OtoCare untuk memperoleh informasi mengenai ketentuan garansi dan layanan cuci ulang.',
        ],
        [
            'question' => 'Apakah tersedia layanan jemput kendaraan?',
            'answer' => 'OtoCare menyediakan informasi layanan jemput dan antar kendaraan sesuai ketersediaan dan ketentuan operasional.',
        ],
        [
            'question' => 'Metode pembayaran apa saja yang didukung?',
            'answer' => 'Metode pembayaran yang tersedia dapat dilihat pada halaman pembayaran setelah pelanggan melakukan pemesanan.',
        ],
    ];

    public function rupiah(int $price): string
    {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }
};
?>

<div class="landing-page bg-white text-slate-800">

    {{-- NAVBAR --}}
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-xl border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-5 sm:px-8">
            <div class="flex items-center justify-between min-h-[82px] gap-5">

                {{-- LOGO --}}
                <a href="{{ route('landing') }}" class="inline-flex items-center gap-3 shrink-0 group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-700 flex items-center justify-center shadow-md shadow-blue-200 group-hover:bg-blue-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="27" height="27" viewBox="0 0 24 24"
                            fill="none" stroke="white" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 13h18l-2-5H5l-2 5Z"/>
                            <path d="M5 13v4h14v-4"/>
                            <circle cx="7" cy="17" r="1.5"/>
                            <circle cx="17" cy="17" r="1.5"/>
                            <path d="M7 8l1-3h8l1 3"/>
                        </svg>
                    </div>

                    <div class="leading-none">
                        <span class="text-[27px] sm:text-[30px] font-black tracking-tight text-slate-900">
                            Oto<span class="text-blue-700">Care.</span>
                        </span>
                        <p class="text-[9px] sm:text-[10px] font-bold tracking-[2.5px] text-slate-400 mt-1.5">
                            VEHICLE CARE SERVICE
                        </p>
                    </div>
                </a>

                {{-- NAVIGATION --}}
                <nav class="hidden md:flex items-center gap-1">
                    <a href="#layanan"
                        class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition">
                        Layanan
                    </a>

                    <a href="#keunggulan"
                        class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition">
                        Keunggulan
                    </a>

                    <a href="#cara-kerja"
                        class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition">
                        Cara Kerja
                    </a>

                    <a href="#faq"
                        class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition">
                        FAQ
                    </a>
                </nav>

                {{-- NAVBAR ACTION --}}
                <div class="flex items-center gap-3 shrink-0">

                    <a href="{{ route('booking') }}"
                        class="hidden sm:inline-flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 text-white px-5 py-3 rounded-xl text-sm font-bold shadow-sm shadow-blue-200 hover:shadow-md transition">
                        Booking Sekarang
                        <span>→</span>
                    </a>

                    <a href="{{ route('auth') }}"
                        aria-label="Masuk ke akun"
                        class="w-11 h-11 rounded-xl border border-slate-200 bg-white hover:bg-blue-50 hover:border-blue-200 text-slate-600 hover:text-blue-700 flex items-center justify-center transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="21" height="21" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M5 21a7 7 0 0 1 14 0"/>
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </header>


    <main>

        {{-- HERO --}}
        <section class="bg-[#F5F8FF] overflow-hidden">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 py-14 lg:py-20">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                    {{-- HERO CONTENT --}}
                    <div>

                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-xs font-bold mb-6">
                            <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                            SOLUSI PERAWATAN KENDARAAN
                        </span>

                        <h1 class="text-4xl sm:text-5xl lg:text-[58px] font-black leading-[1.12] tracking-tight text-slate-900">
                            Kendaraan Bersih,
                            <span class="text-blue-700">Tanpa Ribet.</span>
                        </h1>

                        <p class="mt-6 text-slate-500 leading-relaxed text-base max-w-lg">
                            Nikmati layanan cuci dan perawatan mobil maupun motor dengan sistem reservasi online. Pilih layanan, tentukan jadwal, dan datang tanpa perlu mengantre lama.
                        </p>

                        {{-- HERO BUTTONS --}}
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-8">

                            <a href="{{ route('booking') }}"
                                class="inline-flex items-center justify-center gap-3 bg-blue-700 hover:bg-blue-800 text-white px-7 py-4 rounded-xl font-bold text-sm shadow-lg shadow-blue-200 hover:-translate-y-0.5 hover:shadow-xl transition">
                                Booking Sekarang
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="19" height="19" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"/>
                                    <path d="m12 5 7 7-7 7"/>
                                </svg>
                            </a>

                            <a href="#layanan"
                                class="inline-flex items-center justify-center gap-2 bg-white border border-slate-200 hover:border-blue-300 hover:bg-blue-50 text-slate-700 hover:text-blue-700 px-7 py-4 rounded-xl font-bold text-sm transition">
                                Lihat Layanan
                            </a>

                        </div>

                        {{-- HERO STATISTICS --}}
                        <div class="grid grid-cols-3 gap-5 mt-11 pt-7 border-t border-slate-200">

                            <div>
                                <h3 class="text-2xl sm:text-3xl font-black text-slate-900">Mudah</h3>
                                <p class="text-xs text-slate-500 mt-1">Reservasi Online</p>
                            </div>

                            <div>
                                <h3 class="text-2xl sm:text-3xl font-black text-slate-900">Praktis</h3>
                                <p class="text-xs text-slate-500 mt-1">Pilih Jadwal</p>
                            </div>

                            <div>
                                <h3 class="text-2xl sm:text-3xl font-black text-slate-900">Nyaman</h3>
                                <p class="text-xs text-slate-500 mt-1">Layanan Terarah</p>
                            </div>

                        </div>
                    </div>


                    {{-- HERO VISUAL --}}
                    <div class="relative">

                        <div class="absolute -top-10 -right-10 w-52 h-52 bg-blue-200/60 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-10 -left-10 w-52 h-52 bg-sky-200/60 rounded-full blur-3xl"></div>

                        <div class="relative bg-gradient-to-br from-blue-100 via-sky-50 to-white border border-blue-100 rounded-[30px] p-6 sm:p-9 shadow-xl shadow-blue-100/60">

                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-xs font-black tracking-[2px] text-blue-700 uppercase">
                                        OTOCARE SERVICE
                                    </p>
                                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-3 leading-snug">
                                        Perawatan Terbaik untuk Kendaraan Anda
                                    </h2>
                                </div>

                                <div class="w-12 h-12 shrink-0 rounded-2xl bg-white border border-blue-100 flex items-center justify-center text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="25" height="25" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 13h18l-2-5H5l-2 5Z"/>
                                        <path d="M5 13v4h14v-4"/>
                                        <circle cx="7" cy="17" r="1.5"/>
                                        <circle cx="17" cy="17" r="1.5"/>
                                    </svg>
                                </div>
                            </div>

                            {{-- VEHICLE ILLUSTRATION --}}
                            <div class="my-10 bg-white/70 border border-white rounded-3xl p-5 sm:p-8">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 320 180"
                                    class="w-full max-w-sm mx-auto"
                                    fill="none">

                                    <ellipse cx="160" cy="150" rx="120" ry="12" fill="#DBEAFE"/>

                                    <path d="M48 112h224l-12-35c-4-12-13-19-27-19h-29l-25-30h-75L79 58H68c-12 0-20 7-24 19l-9 35h13Z"
                                        fill="#BFDBFE" stroke="#2563EB" stroke-width="4" stroke-linejoin="round"/>

                                    <path d="M96 58h79l-23-27h-37L96 58Z"
                                        fill="#EFF6FF" stroke="#2563EB" stroke-width="3"/>

                                    <path d="M183 58h30c8 0 13 4 17 12l7 15h-54V58Z"
                                        fill="#EFF6FF" stroke="#2563EB" stroke-width="3"/>

                                    <path d="M38 112h244v13H38z" fill="#60A5FA"/>

                                    <circle cx="88" cy="125" r="20" fill="#1E293B"/>
                                    <circle cx="88" cy="125" r="9" fill="#E2E8F0"/>

                                    <circle cx="232" cy="125" r="20" fill="#1E293B"/>
                                    <circle cx="232" cy="125" r="9" fill="#E2E8F0"/>

                                    <path d="M43 94h15m204 0h15" stroke="white" stroke-width="5" stroke-linecap="round"/>

                                    <path d="M67 22l5-8m-5 8-8-5m8 5 8 5"
                                        stroke="#60A5FA" stroke-width="3" stroke-linecap="round"/>
                                    <path d="M253 34l5-8m-5 8-8-5m8 5 8 5"
                                        stroke="#60A5FA" stroke-width="3" stroke-linecap="round"/>
                                </svg>

                                <p class="text-center text-xs font-bold tracking-widest text-blue-700 mt-4">
                                    CLEAN • CARE • COMFORT
                                </p>
                            </div>

                            {{-- SERVICE INFO --}}
                            <div class="bg-white rounded-2xl border border-blue-100 p-4 flex items-center justify-between gap-4 shadow-sm">
                                <div>
                                    <p class="text-[10px] font-black tracking-widest text-blue-600">
                                        KUALITAS PELAYANAN
                                    </p>
                                    <h3 class="text-sm font-bold text-slate-800 mt-1">
                                        Praktis dan Terjadwal
                                    </h3>
                                </div>

                                <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="23" height="23" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m12 3 2.2 5.1L20 10l-5.8 1.9L12 17l-2.2-5.1L4 10l5.8-1.9L12 3Z"/>
                                    </svg>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>


        {{-- ADVANTAGES --}}
        <section id="keunggulan" class="py-16 sm:py-20">
            <div class="max-w-7xl mx-auto px-5 sm:px-8">

                <div class="text-center max-w-2xl mx-auto mb-11">
                    <p class="text-xs font-black tracking-[2px] text-blue-700 mb-3">
                        KEUNGGULAN KAMI
                    </p>

                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight text-slate-900">
                        Kenapa Memilih OtoCare?
                    </h2>

                    <p class="text-sm sm:text-base text-slate-500 mt-4 leading-relaxed">
                        Pengalaman perawatan kendaraan yang dirancang agar lebih praktis, nyaman, dan mudah diakses.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    @foreach ($advantages as $advantage)
                        <div class="bg-white border border-slate-200 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-50 rounded-2xl p-7 transition duration-300">

                            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-700">
                                @if ($loop->index === 0)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="9"/>
                                        <path d="m8 12 2.5 2.5L16 9"/>
                                    </svg>
                                @elseif ($loop->index === 1)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 12h13m-5-5 5 5-5 5"/>
                                        <path d="M19 5v14"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                @endif
                            </div>

                            <h3 class="text-lg font-extrabold text-slate-900 mt-6">
                                {{ $advantage['title'] }}
                            </h3>

                            <p class="text-sm text-slate-500 leading-relaxed mt-3">
                                {{ $advantage['description'] }}
                            </p>

                        </div>
                    @endforeach

                </div>
            </div>
        </section>


        {{-- SERVICES --}}
        <section id="layanan" class="py-16 sm:py-20 bg-[#F5F8FF]">
            <div class="max-w-7xl mx-auto px-5 sm:px-8">

                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-10">

                    <div>
                        <p class="text-xs font-black tracking-[2px] text-blue-700 mb-3">
                            PILIHAN PERAWATAN
                        </p>

                        <h2 class="text-3xl sm:text-4xl font-black tracking-tight text-slate-900">
                            Paket Layanan OtoCare
                        </h2>

                        <p class="text-sm text-slate-500 mt-3">
                            Pilih layanan sesuai kebutuhan kendaraan Anda.
                        </p>
                    </div>

                    <a href="{{ route('booking') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-blue-700 hover:text-blue-900 transition">
                        Lihat Semua Layanan
                        <span>→</span>
                    </a>

                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    @foreach ($services as $service)
                        <div class="bg-white border border-slate-200 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-100/60 rounded-2xl p-6 flex flex-col transition duration-300">

                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center mb-5">
                                @if ($loop->index === 0)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 12h18M5 12l2-6h10l2 6M5 12l-1 6h16l-1-6"/>
                                        <circle cx="7" cy="16" r="1"/>
                                        <circle cx="17" cy="16" r="1"/>
                                    </svg>
                                @elseif ($loop->index === 1)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m12 3 2.2 5.1L20 10l-5.8 1.9L12 17l-2.2-5.1L4 10l5.8-1.9L12 3Z"/>
                                    </svg>
                                @elseif ($loop->index === 2)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 3v2m0 14v2M4.2 4.2l1.4 1.4m12.8 12.8 1.4 1.4M3 12h2m14 0h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4"/>
                                        <circle cx="12" cy="12" r="5"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14M12 5v14"/>
                                        <circle cx="12" cy="12" r="9"/>
                                    </svg>
                                @endif
                            </div>

                            <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-3">
                                <span>◷</span>
                                {{ $service['duration'] }}
                            </div>

                            <h3 class="text-base font-extrabold text-slate-900 leading-snug min-h-[48px]">
                                {{ $service['name'] }}
                            </h3>

                            <p class="text-sm text-slate-500 leading-relaxed mt-3">
                                {{ $service['description'] }}
                            </p>

                            <div class="mt-auto pt-7">
                                <p class="text-xs text-slate-400 font-medium">
                                    Harga layanan
                                </p>

                                <h2 class="text-2xl font-black text-blue-700 mt-1">
                                    {{ $this->rupiah($service['price']) }}
                                </h2>

                                <a href="{{ route('booking') }}"
                                    class="mt-5 w-full inline-flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 text-white rounded-xl px-4 py-3.5 text-sm font-bold transition shadow-sm hover:shadow-md">
                                    Pilih Layanan
                                    <span>→</span>
                                </a>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </section>


        {{-- HOW IT WORKS --}}
        <section id="cara-kerja" class="py-16 sm:py-20">
            <div class="max-w-7xl mx-auto px-5 sm:px-8">

                <div class="text-center mb-11">
                    <p class="text-xs font-black tracking-[2px] text-blue-700 mb-3">
                        PROSES RESERVASI
                    </p>

                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight text-slate-900">
                        Cara Kerja OtoCare
                    </h2>

                    <p class="text-sm text-slate-500 mt-4">
                        Tiga langkah mudah untuk mendapatkan layanan perawatan kendaraan.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    @foreach ($steps as $index => $step)
                        <div class="relative bg-white border border-slate-200 rounded-2xl p-7 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-50 transition">

                            <div class="flex items-center justify-between">
                                <span class="text-5xl font-black text-blue-100">
                                    0{{ $index + 1 }}
                                </span>

                                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center">
                                    @if ($loop->index === 0)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="17" rx="2"/>
                                            <path d="M16 2v4M8 2v4M3 10h18"/>
                                        </svg>
                                    @elseif ($loop->index === 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 12h18m-6-6 6 6-6 6"/>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m5 12 4 4L19 6"/>
                                        </svg>
                                    @endif
                                </div>
                            </div>

                            <h3 class="text-lg font-extrabold text-slate-900 mt-6">
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
                        class="inline-flex items-center justify-center gap-3 bg-blue-700 hover:bg-blue-800 text-white px-8 py-4 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 hover:-translate-y-0.5 transition">
                        Mulai Booking
                        <span>→</span>
                    </a>
                </div>

            </div>
        </section>


        {{-- TESTIMONIALS --}}
        <section class="py-16 sm:py-20 bg-[#F5F8FF]">
            <div class="max-w-7xl mx-auto px-5 sm:px-8">

                <div class="text-center mb-11">
                    <p class="text-xs font-black tracking-[2px] text-blue-700 mb-3">
                        TESTIMONI PELANGGAN
                    </p>

                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight text-slate-900">
                        Pengalaman Pelanggan
                    </h2>

                    <p class="text-sm text-slate-500 mt-4">
                        Kenali pengalaman menggunakan layanan OtoCare.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    @foreach ($testimonials as $testimonial)
                        <div class="bg-white border border-slate-200 rounded-2xl p-7 hover:shadow-lg hover:shadow-blue-50 transition">

                            <div class="text-amber-400 tracking-widest text-lg">
                                ★★★★★
                            </div>

                            <p class="text-sm text-slate-600 leading-relaxed mt-5 min-h-[75px]">
                                “{{ $testimonial['message'] }}”
                            </p>

                            <div class="flex items-center gap-3 mt-6 pt-5 border-t border-slate-100">

                                <div class="w-11 h-11 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-black text-sm">
                                    {{ $testimonial['initial'] }}
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold text-slate-900">
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
        <section id="faq" class="py-16 sm:py-20">
            <div class="max-w-3xl mx-auto px-5 sm:px-8">

                <div class="text-center mb-11">
                    <p class="text-xs font-black tracking-[2px] text-blue-700 mb-3">
                        PUSAT INFORMASI
                    </p>

                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight text-slate-900">
                        Pertanyaan Umum
                    </h2>

                    <p class="text-sm text-slate-500 mt-4">
                        Informasi yang mungkin Anda butuhkan sebelum melakukan reservasi.
                    </p>
                </div>

                <div class="space-y-3">

                    @foreach ($faqs as $faq)
                        <details class="group bg-white border border-slate-200 hover:border-blue-200 rounded-2xl p-5 sm:p-6 transition">

                            <summary class="cursor-pointer list-none flex items-center justify-between gap-4 text-sm font-bold text-slate-800">
                                {{ $faq['question'] }}

                                <span class="shrink-0 w-8 h-8 rounded-full bg-blue-50 text-blue-700 flex items-center justify-center text-xl transition-transform group-open:rotate-45">
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
        <section class="px-5 sm:px-8 pb-16">
            <div class="max-w-7xl mx-auto">

                <div class="relative overflow-hidden bg-blue-700 rounded-3xl px-7 py-10 sm:px-12 sm:py-12 flex flex-col md:flex-row items-center justify-between gap-7">

                    <div class="absolute -right-10 -top-16 w-56 h-56 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute -left-10 -bottom-20 w-56 h-56 bg-blue-500/50 rounded-full blur-2xl"></div>

                    <div class="relative z-10 text-center md:text-left">
                        <h2 class="text-2xl sm:text-3xl font-black text-white leading-tight">
                            Kendaraan Anda Siap Dirawat?
                        </h2>

                        <p class="text-sm text-blue-100 mt-3 max-w-xl leading-relaxed">
                            Pilih layanan dan jadwal yang sesuai. Nikmati pengalaman reservasi kendaraan yang lebih praktis bersama OtoCare.
                        </p>
                    </div>

                    <div class="relative z-10 shrink-0">
                        <a href="{{ route('booking') }}"
                            class="inline-flex items-center justify-center gap-3 bg-white hover:bg-blue-50 text-blue-800 px-7 py-4 rounded-xl text-sm font-black shadow-lg transition">
                            Booking Sekarang
                            <span>→</span>
                        </a>
                    </div>

                </div>
            </div>
        </section>

    </main>


    {{-- FOOTER --}}
    <footer class="bg-slate-950 text-white">

        <div class="max-w-7xl mx-auto px-5 sm:px-8 py-12">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">

                {{-- FOOTER BRAND --}}
                <div>
                    <a href="{{ route('landing') }}" class="inline-flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-blue-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="white" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 13h18l-2-5H5l-2 5Z"/>
                                <path d="M5 13v4h14v-4"/>
                                <circle cx="7" cy="17" r="1.5"/>
                                <circle cx="17" cy="17" r="1.5"/>
                            </svg>
                        </div>

                        <span class="text-3xl font-black tracking-tight">
                            Oto<span class="text-blue-400">Care.</span>
                        </span>
                    </a>

                    <p class="text-sm text-slate-400 leading-relaxed mt-5 max-w-sm">
                        Solusi modern untuk perawatan kendaraan yang praktis, nyaman, dan terpercaya.
                    </p>
                </div>


                {{-- FOOTER NAVIGATION --}}
                <div>
                    <h3 class="text-sm font-bold text-white mb-5">
                        Navigasi
                    </h3>

                    <div class="flex flex-col gap-3 text-sm text-slate-400">
                        <a href="{{ route('landing') }}" class="hover:text-blue-400 transition">Beranda</a>
                        <a href="#keunggulan" class="hover:text-blue-400 transition">Keunggulan</a>
                        <a href="#layanan" class="hover:text-blue-400 transition">Layanan</a>
                        <a href="#faq" class="hover:text-blue-400 transition">FAQ</a>
                    </div>
                </div>


                {{-- FOOTER SERVICES --}}
                <div>
                    <h3 class="text-sm font-bold text-white mb-5">
                        Layanan
                    </h3>

                    <div class="flex flex-col gap-3 text-sm text-slate-400">
                        <a href="{{ route('booking') }}" class="hover:text-blue-400 transition">Booking Online</a>
                        <a href="#layanan" class="hover:text-blue-400 transition">Cuci Kendaraan</a>
                        <a href="#layanan" class="hover:text-blue-400 transition">Perawatan Kendaraan</a>
                        <a href="{{ route('auth') }}" class="hover:text-blue-400 transition">Masuk Akun</a>
                    </div>
                </div>

            </div>

            <div class="border-t border-slate-800 mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
                <p>© {{ date('Y') }} OtoCare. All rights reserved.</p>
                <p>Vehicle Care Service</p>
            </div>

        </div>
    </footer>

</div>