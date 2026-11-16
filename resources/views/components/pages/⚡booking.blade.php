
<?php

use Livewire\Component;
use Illuminate\Support\Facades\DB;

new class extends Component
{
    public string $name = '';
    public string $phone = '';
    public string $vehicle_type = 'Mobil';
    public string $vehicle_name = '';
    public string $license_plate = '';
    public string $service_id = '';
    public string $booking_date = '';
    public string $booking_time = '';

    public array $services = [];

    public function mount(): void
    {
        $this->loadServices();
    }

    public function updatedVehicleType(): void
    {
        $this->service_id = '';
        $this->loadServices();
    }

    private function loadServices(): void
    {
        $this->services = DB::table('services')
            ->where('vehicle_type', $this->vehicle_type)
            ->where('is_active', 1)
            ->orderBy('id')
            ->get()
            ->map(fn ($service) => [
                'id' => $service->id,
                'name' => $service->name,
                'price' => $service->price,
                'duration' => $service->duration_minutes,
            ])
            ->toArray();
    }

    public function createBooking()
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:25',
            'vehicle_type' => 'required|in:Mobil,Motor',
            'vehicle_name' => 'required|string|max:100',
            'license_plate' => 'required|string|max:20',
            'service_id' => 'required|integer',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|in:08:00,10:00,13:00,15:00,17:00',
        ]);

        $service = DB::table('services')
            ->where('id', $this->service_id)
            ->where('vehicle_type', $this->vehicle_type)
            ->where('is_active', 1)
            ->first();

        if (!$service) {
            $this->addError('service_id', 'Paket layanan tidak tersedia.');
            return;
        }

        $result = DB::transaction(function () use ($service) {

            $customer = DB::table('customers')
                ->where('phone', $this->phone)
                ->first();

            if ($customer) {
                $customerId = $customer->id;

                DB::table('customers')
                    ->where('id', $customerId)
                    ->update([
                        'name' => $this->name,
                    ]);
            } else {
                $customerId = DB::table('customers')->insertGetId([
                    'name' => $this->name,
                    'phone' => $this->phone,
                    'created_at' => now(),
                ]);
            }

            $vehicleId = DB::table('vehicles')->insertGetId([
                'customer_id' => $customerId,
                'vehicle_type' => $this->vehicle_type,
                'plate_number' => strtoupper($this->license_plate),
                'vehicle_model' => $this->vehicle_name,
            ]);

            $bookingId = DB::table('bookings')->insertGetId([
                'customer_id' => $customerId,
                'vehicle_id' => $vehicleId,
                'service_id' => $service->id,
                'booking_date' => $this->booking_date,
                'booking_time' => $this->booking_time,
                'status' => 'Menunggu',
                'created_at' => now(),
            ]);

            return [
                'booking_id' => $bookingId,
                'customer_id' => $customerId,
            ];
        });

        session()->put('current_booking_id', $result['booking_id']);
        session()->put('current_customer_id', $result['customer_id']);

        return redirect()->route('payment');
    }

    public function rupiah($price): string
    {
        return 'Rp ' . number_format((float) $price, 0, ',', '.');
    }
};
?>

<div class="min-h-screen bg-slate-50 text-slate-800">
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-5 py-4 flex justify-between items-center">
            <a href="{{ route('landing') }}" class="text-2xl font-extrabold text-slate-900">
                Oto<span class="text-blue-800">Care.</span>
            </a>
            <a href="{{ route('orders') }}" class="text-sm font-semibold text-slate-600">
                Pesanan Saya →
            </a>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-5 py-10">
        <div class="mb-8">
            <p class="text-xs font-bold uppercase tracking-widest text-blue-800">Reservasi Online</p>
            <h1 class="text-3xl font-extrabold mt-2">Form Booking</h1>
            <p class="text-sm text-slate-500 mt-2">
                Lengkapi data diri, kendaraan, layanan, dan jadwal reservasi.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6 text-sm">
                Terdapat data yang belum benar. Silakan periksa kembali formulir.
            </div>
        @endif

        <form wire:submit="createBooking" class="space-y-6">

            <section class="bg-white border border-slate-200 rounded-2xl p-6 space-y-4">
                <h2 class="font-bold text-lg border-b pb-3">1. Informasi Pemesan</h2>

                <div>
                    <label class="block text-sm font-semibold mb-2">Nama Lengkap</label>
                    <input type="text" wire:model="name"
                        class="w-full border rounded-xl p-3" placeholder="Masukkan nama lengkap">
                    @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Nomor WhatsApp</label>
                    <input type="text" wire:model="phone"
                        class="w-full border rounded-xl p-3" placeholder="Contoh: 08123456789">
                    @error('phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </section>

            <section class="bg-white border border-slate-200 rounded-2xl p-6 space-y-4">
                <h2 class="font-bold text-lg border-b pb-3">2. Informasi Kendaraan</h2>

                <div>
                    <label class="block text-sm font-semibold mb-2">Jenis Kendaraan</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="border rounded-xl p-3 flex gap-2 items-center cursor-pointer">
                            <input type="radio" wire:model.live="vehicle_type" value="Mobil">
                            Mobil
                        </label>
                        <label class="border rounded-xl p-3 flex gap-2 items-center cursor-pointer">
                            <input type="radio" wire:model.live="vehicle_type" value="Motor">
                            Motor
                        </label>
                    </div>
                    @error('vehicle_type') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Merk dan Tipe Kendaraan</label>
                    <input type="text" wire:model="vehicle_name"
                        class="w-full border rounded-xl p-3" placeholder="Contoh: Honda Vario 160">
                    @error('vehicle_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Plat Nomor</label>
                    <input type="text" wire:model="license_plate"
                        class="w-full border rounded-xl p-3 uppercase" placeholder="AB 1234 XX">
                    @error('license_plate') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </section>

            <section class="bg-white border border-slate-200 rounded-2xl p-6 space-y-4">
                <h2 class="font-bold text-lg border-b pb-3">3. Pilihan Layanan</h2>

                <div>
                    <label class="block text-sm font-semibold mb-2">Paket Perawatan</label>
                    <select wire:model="service_id" class="w-full border rounded-xl p-3 bg-white">
                        <option value="">-- Pilih Layanan --</option>
                        @foreach ($services as $service)
                            <option value="{{ $service['id'] }}">
                                {{ $service['name'] }} -
                                {{ $this->rupiah($service['price']) }}
                                ({{ $service['duration'] }} menit)
                            </option>
                        @endforeach
                    </select>
                    @error('service_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </section>

            <section class="bg-white border border-slate-200 rounded-2xl p-6 space-y-4">
                <h2 class="font-bold text-lg border-b pb-3">4. Jadwal Reservasi</h2>

                <div>
                    <label class="block text-sm font-semibold mb-2">Tanggal Booking</label>
                    <input type="date" wire:model="booking_date"
                        min="{{ date('Y-m-d') }}" class="w-full border rounded-xl p-3">
                    @error('booking_date') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Jam Reservasi</label>
                    <select wire:model="booking_time" class="w-full border rounded-xl p-3 bg-white">
                        <option value="">-- Pilih Jam --</option>
                        <option value="08:00">08:00 WIB</option>
                        <option value="10:00">10:00 WIB</option>
                        <option value="13:00">13:00 WIB</option>
                        <option value="15:00">15:00 WIB</option>
                        <option value="17:00">17:00 WIB</option>
                    </select>
                    @error('booking_time') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </section>

            <button type="submit" wire:loading.attr="disabled"
                class="w-full bg-blue-950 hover:bg-blue-900 disabled:opacity-50 text-white font-bold p-4 rounded-xl">
                <span wire:loading.remove>Lanjut ke Pembayaran →</span>
                <span wire:loading>Memproses Booking...</span>
            </button>
        </form>
    </main>
</div>
