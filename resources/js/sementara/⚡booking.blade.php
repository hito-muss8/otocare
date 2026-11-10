<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Booking extends Component
{
    public int $step = 1;

    public string $selectedVehicle = '';
    public string $selectedService = '';
    public string $bookingDate = '';
    public string $bookingTime = '';
    public string $pickupMethod = '';
    public string $pickupAddress = '';

    public bool $confirmed = false;
    public string $bookingCode = '';

    public array $vehicles = [
        'motor' => [
            'name' => 'Motor',
            'description' => 'Layanan untuk kendaraan roda dua.',
        ],
        'mobil' => [
            'name' => 'Mobil',
            'description' => 'Layanan untuk kendaraan roda empat.',
        ],
    ];

    public array $services = [
        'servis_ringan' => [
            'name' => 'Servis Ringan',
            'description' => 'Pemeriksaan dan perawatan rutin kendaraan.',
            'price' => 150000,
        ],
        'servis_lengkap' => [
            'name' => 'Servis Lengkap',
            'description' => 'Pemeriksaan menyeluruh dan perawatan kendaraan.',
            'price' => 350000,
        ],
        'ganti_oli' => [
            'name' => 'Ganti Oli',
            'description' => 'Penggantian oli dan pemeriksaan dasar.',
            'price' => 100000,
        ],
    ];

    public array $timeSlots = [
        '09:00' => '09.00',
        '11:00' => '11.00',
        '13:00' => '13.00',
        '15:00' => '15.00',
    ];

    private const PICKUP_FEE = 25000;

    public function next(): void
    {
        if ($this->step >= 5) {
            $this->confirmBooking();

            return;
        }

        $this->validateCurrentStep();

        $this->step++;
    }

    public function previous(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function confirmBooking(): void
    {
        $this->validate([
            'selectedVehicle' => ['required', Rule::in(array_keys($this->vehicles))],
            'selectedService' => ['required', Rule::in(array_keys($this->services))],
            'bookingDate' => ['required', 'date', 'after_or_equal:today'],
            'bookingTime' => ['required', Rule::in(array_keys($this->timeSlots))],
            'pickupMethod' => ['required', Rule::in(['antar_sendiri', 'jemput'])],
            'pickupAddress' => [
                Rule::requiredIf($this->pickupMethod === 'jemput'),
                'nullable',
                'string',
                'max:500',
            ],
        ], [
            'selectedVehicle.required' => 'Silakan pilih kendaraan.',
            'selectedService.required' => 'Silakan pilih layanan.',
            'bookingDate.required' => 'Silakan pilih tanggal.',
            'bookingDate.after_or_equal' => 'Tanggal booking tidak boleh sebelum hari ini.',
            'bookingTime.required' => 'Silakan pilih waktu.',
            'pickupMethod.required' => 'Silakan pilih metode pengambilan.',
            'pickupAddress.required' => 'Silakan masukkan alamat penjemputan.',
        ]);

        $this->bookingCode = Str::upper(Str::random(8));
        $this->confirmed = true;
    }

    public function total(): int
    {
        $servicePrice = $this->services[$this->selectedService]['price'] ?? 0;
        $pickupFee = $this->pickupMethod === 'jemput' ? self::PICKUP_FEE : 0;

        return $servicePrice + $pickupFee;
    }

    public function rupiah(int $amount): string
    {
        return 'Rp' . number_format($amount, 0, ',', '.');
    }

    public function render()
    {
        return view('livewire.booking', [
            'total' => $this->total(),
        ]);
    }

    private function validateCurrentStep(): void
    {
        if ($this->step === 1) {
            $this->validate([
                'selectedVehicle' => ['required', Rule::in(array_keys($this->vehicles))],
            ], [
                'selectedVehicle.required' => 'Silakan pilih kendaraan.',
            ]);

            return;
        }

        if ($this->step === 2) {
            $this->validate([
                'selectedService' => ['required', Rule::in(array_keys($this->services))],
            ], [
                'selectedService.required' => 'Silakan pilih layanan.',
            ]);

            return;
        }

        if ($this->step === 3) {
            $this->validate([
                'bookingDate' => ['required', 'date', 'after_or_equal:today'],
                'bookingTime' => ['required', Rule::in(array_keys($this->timeSlots))],
            ], [
                'bookingDate.required' => 'Silakan pilih tanggal.',
                'bookingDate.after_or_equal' => 'Tanggal booking tidak boleh sebelum hari ini.',
                'bookingTime.required' => 'Silakan pilih waktu.',
            ]);

            return;
        }

        if ($this->step === 4) {
            $this->validate([
                'pickupMethod' => ['required', Rule::in(['antar_sendiri', 'jemput'])],
                'pickupAddress' => [
                    Rule::requiredIf($this->pickupMethod === 'jemput'),
                    'nullable',
                    'string',
                    'max:500',
                ],
            ], [
                'pickupMethod.required' => 'Silakan pilih metode pengambilan.',
                'pickupAddress.required' => 'Silakan masukkan alamat penjemputan.',
            ]);
        }
    }
}
