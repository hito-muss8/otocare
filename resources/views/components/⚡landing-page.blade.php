<?php

use Livewire\Component;

new class extends Component
{
    public array $advantages = [
        [
            'title' => 'Bebas Antre',
            'description' => 'Reservasi slot bay secara online, tiba di outlet langsung dikerjakan teknisi tanpa menunggu lama.',
        ],
        [
            'title' => 'Jemput / Antar',
            'description' => 'Layanan valet amanah siap menjemput dan mengantarkan kendaraan Anda sampai ke teras rumah.',
        ],
        [
            'title' => 'Pantau Real-Time',
            'description' => 'Cek linimasa tahap cuci, foto dokumentasi, serta live GPS valet driver langsung dari ponsel.',
        ],
    ];

    public array $services = [
        [
            'name' => 'Cuci Komplit + Hydrophobic Wax',
            'price' => 'Rp 50.000',
            'duration' => '45 mnt',
        ],
        [
            'name' => 'Signature Full Detailing',
            'price' => 'Rp 250.000',
            'duration' => '120 mnt',
        ],
        [
            'name' => 'Deep Interior Cleansing & Fogging',
            'price' => 'Rp 120.000',
            'duration' => '60 mnt',
        ],
        [
            'name' => 'Cuci Cepat Eksterior Reguler',
            'price' => 'Rp 30.000',
            'duration' => '25 mnt',
        ],
    ];

    public array $steps = [
        'Pilih Layanan & Jadwal',
        'Antar Sendiri atau Valet',
        'Terima Bersih Berkilau',
    ];

    public array $testimonials = [
        [
            'message' => 'Teknisinya sangat teliti. Motor Vario saya kinclong sampai ke sela mesin.',
            'name' => 'Andi Pratama',
        ],
        [
            'message' => 'Biasanya malas antre 2 jam tiap weekend. Di OtoCare tinggal booking jam 10.',
            'name' => 'Rina Wijaya',
        ],
        [
            'message' => 'Transparansi dengan foto progres langsung di aplikasi.',
            'name' => 'Hendra Kusuma',
        ],
    ];

    public array $faqs = [
        [
            'question' => 'Apakah saya harus memesan jauh-jauh hari?',
            'answer' => 'Tidak, slot instan harian tersedia.',
        ],
        [
            'question' => 'Bagaimana jika turun hujan setelah dicuci?',
            'answer' => 'Garansi cuci ulang 1x24 jam.',
        ],
        [
            'question' => 'Apakah aman menyerahkan kunci ke driver valet?',
            'answer' => 'Valet terlatih dan terasuransi.',
        ],
        [
            'question' => 'Metode pembayaran apa saja yang didukung?',
            'answer' => 'QRIS, transfer VA, dan bayar di tempat.',
        ],
    ];
};
?>

<div>
    <nav>
        <a href="#/" class="brand">OtoCare</a>

        <a href="#/booking">Layanan</a>
        <a href="#/">Keunggulan</a>
        <a href="#/">Cara Kerja</a>
        <a href="#/">FAQ</a>

        <a class="btn us" style="margin-left:auto;color:#fff" href="#/booking">
            Booking Sekarang
        </a>

        <a href="#/masuk" class="us" style="margin-left:0">
            <i>{{-- Ikon user --}}</i>
        </a>
    </nav>

    <div class="w">

        {{-- HERO SECTION --}}
        <div class="hero">
            <div>
                <span class="pill n">
                    Reservasi Online #1 di Jabodetabek
                </span>

                <h1 class="sp">
                    Cuci Kendaraan Tanpa Antre, Bisa Diantar ke Rumah
                </h1>

                <p class="mu sp">
                    Layanan cuci dan perawatan presisi mobil & motor berbasis reservasi online.
                    Teknisi bersertifikat, pantau progres real-time, dan antar-jemput valet terpercaya.
                </p>

                <div class="fl sp">
                    <a class="btn" href="#/booking">
                        Booking Sekarang →
                    </a>

                    <a class="btn l" href="#/booking">
                        Lihat Paket Layanan
                    </a>
                </div>
            </div>

            <div class="img">
                Teknisi Standar Detailing
            </div>
        </div>

        {{-- KEUNGGULAN --}}
        <div class="sec c">
            <p class="sm mu b">
                STANDAR KEUNGGULAN
            </p>

            <h2 class="mb">
                Kenapa Memilih Layanan OtoCare?
            </h2>

            <div class="g3" style="text-align:left">
                @foreach ($advantages as $advantage)
                    <div class="cd">
                        <h3>{{ $advantage['title'] }}</h3>

                        <p class="mu sm">
                            {{ $advantage['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- KATALOG LAYANAN --}}
        <h2 class="sp">
            Katalog Paket Layanan Populer
        </h2>

        <div class="g4 sp">
            @foreach ($services as $service)
                <div class="cd cat">
                    <span class="sm mu">
                        ⏱ {{ $service['duration'] }}
                    </span>

                    <h3>
                        {{ $service['name'] }}
                    </h3>

                    <p class="sm mu">
                        Mulai dari
                    </p>

                    <h2>
                        {{ $service['price'] }}
                    </h2>

                    <a
                        class="btn l f"
                        href="#/booking"
                    >
                        Pilih Layanan
                    </a>
                </div>
            @endforeach
        </div>

        {{-- CARA KERJA --}}
        <div class="sec c sp">
            <h2 class="mb">
                Cara Kerja OtoCare
            </h2>

            <div class="g3" style="text-align:left">
                @foreach ($steps as $index => $step)
                    <div class="cd">
                        <span class="pill n">
                            {{ $index + 1 }}
                        </span>

                        <h3 class="sp">
                            {{ $step }}
                        </h3>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- TESTIMONI --}}
        <h2 class="c mb">
            Apa Kata Mereka yang Sudah Mencoba?
        </h2>

        <div class="g3">
            @foreach ($testimonials as $testimonial)
                <div class="cd">
                    <span style="color:#d6a73a">
                        ★★★★★
                    </span>

                    <p class="sm mu">
                        “{{ $testimonial['message'] }}”
                    </p>

                    <b class="sm">
                        {{ $testimonial['name'] }}
                    </b>
                </div>
            @endforeach
        </div>

        {{-- FAQ --}}
        <h2 class="c sp mb">
            Pertanyaan yang Sering Diajukan
        </h2>

        @foreach ($faqs as $faq)
            <details>
                <summary>
                    {{ $faq['question'] }}
                </summary>

                <p>
                    {{ $faq['answer'] }}
                </p>
            </details>
        @endforeach

        {{-- CALL TO ACTION --}}
        <div
            class="cd sp fl"
            style="background:var(--nv);color:#fff;justify-content:space-between"
        >
            <div>
                <h2>
                    Siap Nikmati Kendaraan Bersih Berkilau?
                </h2>

                <p class="sm">
                    Dapatkan +500 Poin Loyalitas & Kupon Diskon untuk reservasi perdana Anda.
                </p>
            </div>

            <a
                class="btn"
                style="background:#fff;color:#000C33"
                href="#/booking"
            >
                Booking Servis Sekarang
            </a>
        </div>

    </div>

    {{-- FOOTER --}}
</div>