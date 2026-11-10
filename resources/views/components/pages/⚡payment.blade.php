<?php

use Livewire\Component;

new class extends Component
{
    // Form Input Properties
    public string $name = '';
    public string $phone = '';
    public string $vehicle_type = 'mobil'; // mobil / motor
    public string $vehicle_name = '';     // misal: Honda Vario 160 / Toyota Avanza
    public string $license_plate = '';     // misal: AB 1234 XX
    public string $service_id = '';        // ID / Nama Paket Layanan
    public string $booking_type = 'datang'; // datang / valet
    public string $booking_date = '';
    public string $booking_time = '';
    public string $address = '';           // Alamat jemput jika memilih Valet

    // Data Paket Layanan
    public array $services = [
        ['id' => '1', 'name' => 'Cuci Cepat Eksterior Reguler', 'price' => 30000, 'duration' => '25 mnt'],
        ['id' => '2', 'name' => 'Cuci Komplit + Hydrophobic Wax', 'price' => 50000, 'duration' => '45 mnt'],
        ['id' => '3', 'name' => 'Deep Interior Cleansing & Fogging', 'price' => 120000, 'duration' => '60 mnt'],
        ['id' => '4', 'name' => 'Signature Full Detailing', 'price' => 250000, 'duration' => '120 mnt'],
    ];

    public function createBooking()
    {
        // 1. Validasi Input Form
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'vehicle_name' => 'required',
            'license_plate' => 'required',
            'service_id' => 'required',
            'booking_date' => 'required',
            'booking_time' => 'required',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'vehicle_name.required' => 'Jenis/Merk kendaraan wajib diisi.',
            'license_plate.required' => 'Plat nomor wajib diisi.',
            'service_id.required' => 'Silakan pilih paket layanan.',
            'booking_date.required' => 'Tanggal booking wajib dipilih.',
            'booking_time.required' => 'Jam reservasi wajib dipilih.',
        ]);

        // 2. Simpan Notifikasi Sementara
        session()->flash('success', 'Reservasi berhasil dibuat! Silakan selesaikan pembayaran.');

        // 3. DIRECT KE HALAMAN PAYMENT (Bukan ke orders langsung)
        return redirect()->route('payment');
    }

    public function rupiah(int $price): string
    {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }
};
?>

<div class="min-h-screen bg-slate-50 text-slate-800 font-sans antialiased pb-20">

    {{-- HEADER --}}
    <header class="bg-white/95 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="text-2xl font-extrabold tracking-tight text-slate-900">
                Oto<span class="text-blue-800">Care.</span>
            </a>
            <a href="{{ route('orders') }}" class="text-sm font-bold text-slate-600 hover:text-blue-800 transition">
                Pesanan Saya →
            </a>
        </div>
    </header>

    {{-- MAIN CONTAINER FORM --}}
    <main class="max-w-3xl mx-auto px-6 py-10">

        <div class="mb-8">
            <span class="text-xs font-bold tracking-widest text-blue-800 uppercase bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
                Reservasi Online
            </span>
            <h1 class="text-3xl font-extrabold text-slate-900 mt-3">Form Reservasi OtoCare</h1>
            <p class="text-slate-500 text-sm mt-1">Isi data reservasi di bawah ini untuk booking jadwal tanpa antre.</p>
        </div>

        @if (session()->has('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit="createBooking" class="space-y-6">

            {{-- SECTION 1: DATA PEMESAN --}}
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-xs">
                <h3 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100">1. Informasi Pemesan</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                        <input type="text" wire:model="name" placeholder="Contoh: Hito Mustaqim" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-blue-800 focus:ring-1 focus:ring-blue-800 transition">
                        @error('name') <span class="text-xs text-red-500 mt-1 block font-semibold">{{ $message }}</span> @error
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">No. WhatsApp</label>
                        <input type="text" wire:model="phone" placeholder="Contoh: 08123456789" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-blue-800 focus:ring-1 focus:ring-blue-800 transition">
                        @error('phone') <span class="text-xs text-red-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- SECTION 2: DATA KENDARAAN --}}
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-xs">
                <h3 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100">2. Detail Kendaraan</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jenis Kendaraan</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center justify-center gap-2 p-3.5 rounded-xl border border-slate-200 cursor-pointer font-bold text-sm text-slate-700 hover:bg-slate-50 transition">
                                <input type="radio" wire:model.live="vehicle_type" value="mobil" class="accent-blue-900"> Mobil
                            </label>
                            <label class="flex items-center justify-center gap-2 p-3.5 rounded-xl border border-slate-200 cursor-pointer font-bold text-sm text-slate-700 hover:bg-slate-50 transition">
                                <input type="radio" wire:model.live="vehicle_type" value="motor" class="accent-blue-900"> Motor
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Merk & Tipe Kendaraan</label>
                            <input type="text" wire:model="vehicle_name" placeholder="Contoh: Honda Vario 160 / Avanza" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-blue-800 focus:ring-1 focus:ring-blue-800 transition">
                            @error('vehicle_name') <span class="text-xs text-red-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Plat Nomor Kendaraan</label>
                            <input type="text" wire:model="license_plate" placeholder="Contoh: AB 1234 XX" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-blue-800 focus:ring-1 focus:ring-blue-800 uppercase transition">
                            @error('license_plate') <span class="text-xs text-red-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 3: PILIH LAYANAN & METODE --}}
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-xs">
                <h3 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100">3. Paket & Metode Layanan</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pilih Paket Perawatan</label>
                        <select wire:model="service_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-blue-800 focus:ring-1 focus:ring-blue-800 bg-white transition">
                            <option value="">-- Pilih Paket Layanan --</option>
                            @foreach ($services as$srv)
                                <option value="{{ $srv['id'] }}">{{ $srv['name'] }} - {{$this->rupiah($srv['price']) }} ({{$srv['duration'] }})</option>
                            @endforeach
                        </select>
                        @error('service_id') <span class="text-xs text-red-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tipe Layanan</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-slate-200 cursor-pointer text-center hover:bg-slate-50 transition">
                                <input type="radio" wire:model.live="booking_type" value="datang" class="accent-blue-900 mb-1">
                                <span class="font-bold text-sm text-slate-900">Datang Langsung</span>
                                <span class="text-[11px] text-slate-500">Antar ke outlet OtoCare</span>
                            </label>
                            <label class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-slate-200 cursor-pointer text-center hover:bg-slate-50 transition">
                                <input type="radio" wire:model.live="booking_type" value="valet" class="accent-blue-900 mb-1">
                                <span class="font-bold text-sm text-slate-900">Valet (Antar-Jemput)</span>
                                <span class="text-[11px] text-slate-500">Jemput di lokasi Anda</span>
                            </label>
                        </div>
                    </div>

                    @if ($booking_type === 'valet')
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Penjemputan</label>
                            <textarea wire:model="address" rows="3" placeholder="Masukkan alamat lengkap rumah/lokasi penjemputan..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-blue-800 focus:ring-1 focus:ring-blue-800 transition"></textarea>
                        </div>
                    @endif
                </div>
            </div>

            {{-- SECTION 4: JADWAL RESERVASI --}}
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-xs">
                <h3 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100">4. Pilih Tanggal & Waktu</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal</label>
                        <input type="date" wire:model="booking_date" min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-blue-800 focus:ring-1 focus:ring-blue-800 transition">
                        @error('booking_date') <span class="text-xs text-red-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jam Reservasi</label>
                        <select wire:model="booking_time" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-blue-800 focus:ring-1 focus:ring-blue-800 bg-white transition">
                            <option value="">-- Pilih Jam --</option>
                            <option value="08:00">08:00 WIB</option>
                            <option value="10:00">10:00 WIB</option>
                            <option value="13:00">13:00 WIB</option>
                            <option value="15:00">15:00 WIB</option>
                            <option value="17:00">17:00 WIB</option>
                        </select>
                        @error('booking_time') <span class="text-xs text-red-500 mt-1 block font-semibold">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- SUBMIT BUTTON --}}
            <button type="submit" class="w-full bg-blue-950 hover:bg-blue-900 text-white font-bold py-4 rounded-xl shadow-md transition text-center text-sm cursor-pointer">
                Lanjut ke Pembayaran →
            </button>

        </form>

    </main>

</div>