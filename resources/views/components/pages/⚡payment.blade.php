
<?php

use Livewire\Component;
use Illuminate\Support\Facades\DB;

new class extends Component
{
    public ?object $booking = null;
    public string $method = 'Cash';

    public function mount()
    {
        $bookingId = session('current_booking_id');
        $customerId = session('current_customer_id');

        if (!$bookingId || !$customerId) {
            return redirect()->route('booking');
        }

        $this->loadBooking($bookingId, $customerId);

        if (!$this->booking) {
            return redirect()->route('booking');
        }
    }

    private function loadBooking($bookingId, $customerId): void
    {
        $this->booking = DB::table('bookings')
            ->join('customers', 'bookings.customer_id', '=', 'customers.id')
            ->join('vehicles', 'bookings.vehicle_id', '=', 'vehicles.id')
            ->join('services', 'bookings.service_id', '=', 'services.id')
            ->leftJoin('payments', 'bookings.id', '=', 'payments.booking_id')
            ->where('bookings.id', $bookingId)
            ->where('bookings.customer_id', $customerId)
            ->select(
                'bookings.id',
                'bookings.booking_date',
                'bookings.booking_time',
                'bookings.status as booking_status',
                'customers.name',
                'customers.phone',
                'vehicles.vehicle_type',
                'vehicles.vehicle_model',
                'vehicles.plate_number',
                'services.name as service_name',
                'services.price',
                'services.duration_minutes',
                'payments.method as payment_method',
                'payments.status as payment_status'
            )
            ->first();
    }

    public function confirmPayment()
    {
        $this->validate([
            'method' => 'required|in:Cash,QRIS',
        ]);

        if (!$this->booking) {
            return redirect()->route('booking');
        }

        $status = $this->method === 'QRIS'
            ? 'Menunggu Verifikasi'
            : 'Belum Dibayar';

        DB::table('payments')->updateOrInsert(
            ['booking_id' => $this->booking->id],
            [
                'amount' => $this->booking->price,
                'method' => $this->method,
                'status' => $status,
                'paid_at' => null,
            ]
        );

        session()->flash(
            'success',
            'Metode pembayaran berhasil dicatat.'
        );

        return redirect()->route('orders');
    }

    public function rupiah($price): string
    {
        return 'Rp ' . number_format((float) $price, 0, ',', '.');
    }
};
?>

<div class="min-h-screen bg-slate-50 text-slate-800">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-4xl mx-auto px-5 py-4 flex justify-between items-center">
            <a href="{{ route('landing') }}" class="text-2xl font-extrabold text-slate-900">
                Oto<span class="text-blue-800">Care.</span>
            </a>
            <a href="{{ route('booking') }}" class="text-sm text-slate-600 font-semibold">
                Kembali ke Booking
            </a>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-5 py-10">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-800">Checkout</p>
        <h1 class="text-3xl font-extrabold mt-2">Pembayaran</h1>
        <p class="text-slate-500 text-sm mt-2 mb-8">
            Periksa kembali detail reservasi sebelum memilih metode pembayaran.
        </p>

        @if ($booking)
            <section class="bg-white border border-slate-200 rounded-2xl p-6 mb-6">
                <h2 class="font-bold text-lg border-b pb-4">Ringkasan Reservasi</h2>

                <div class="space-y-4 mt-5 text-sm">
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Nomor Booking</span>
                        <strong>#{{ $booking->id }}</strong>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Nama Pemesan</span>
                        <strong>{{ $booking->name }}</strong>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Nomor WhatsApp</span>
                        <strong>{{ $booking->phone }}</strong>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Kendaraan</span>
                        <strong class="text-right">
                            {{ $booking->vehicle_model }} ({{ $booking->vehicle_type }})
                        </strong>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Plat Nomor</span>
                        <strong>{{ $booking->plate_number }}</strong>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Layanan</span>
                        <strong class="text-right">{{ $booking->service_name }}</strong>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Tanggal</span>
                        <strong>{{ $booking->booking_date }}</strong>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Jam</span>
                        <strong>{{ substr($booking->booking_time, 0, 5) }} WIB</strong>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Durasi</span>
                        <strong>{{ $booking->duration_minutes }} menit</strong>
                    </div>
                </div>

                <div class="border-t mt-5 pt-5 flex justify-between items-center">
                    <span class="font-bold">Total Pembayaran</span>
                    <strong class="text-2xl text-blue-900">
                        {{ $this->rupiah($booking->price) }}
                    </strong>
                </div>
            </section>

            <form wire:submit="confirmPayment" class="bg-white border border-slate-200 rounded-2xl p-6">
                <h2 class="font-bold text-lg mb-4">Pilih Metode Pembayaran</h2>

                <div class="space-y-3">
                    <label class="flex items-center gap-3 border rounded-xl p-4 cursor-pointer">
                        <input type="radio" wire:model="method" value="Cash">
                        <div>
                            <p class="font-bold">Cash / Tunai</p>
                            <p class="text-xs text-slate-500">Pembayaran langsung di outlet.</p>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 border rounded-xl p-4 cursor-pointer">
                        <input type="radio" wire:model="method" value="QRIS">
                        <div>
                            <p class="font-bold">QRIS</p>
                            <p class="text-xs text-slate-500">Metode dicatat untuk verifikasi petugas.</p>
                        </div>
                    </label>
                </div>

                @error('method')
                    <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                @enderror

                <div class="bg-amber-50 border border-amber-200 text-amber-800 rounded-xl p-4 mt-5 text-sm">
                    <strong>Informasi:</strong>
                    Pilihan QRIS pada versi ini belum terhubung ke payment gateway atau kode QR asli.
                    Pembayaran masih memerlukan verifikasi petugas.
                </div>

                <button type="submit" wire:loading.attr="disabled"
                    class="w-full mt-6 bg-blue-950 hover:bg-blue-900 disabled:opacity-50 text-white font-bold p-4 rounded-xl">
                    <span wire:loading.remove>Konfirmasi Pembayaran</span>
                    <span wire:loading>Menyimpan...</span>
                </button>
            </form>
        @endif
    </main>
</div>
