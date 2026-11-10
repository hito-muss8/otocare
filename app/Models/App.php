<?php

namespace App\Livewire;

use Livewire\Component;

class CheckoutWizard extends Component
{
    public int $step = 1;

    /** @var array<int, int|string> */
    public array $selectedAds = [];

    public string $currentRoute = '/';

    public int $rating = 5;

    public function st(int $d): void
    {
        if ($this->step === 5 && $d > 0) {
            $this->dispatch('navigate-hash', route: '/bayar');

            return;
        }

        $this->step = max(1, min(5, $this->step + $d));
        $this->rating = 5;

        $this->dispatch('scroll-to-top');
    }

    public function ad(int|string $i): void
    {
        $index = array_search($i, $this->selectedAds, true);

        if ($index === false) {
            $this->selectedAds[] = $i;
        } else {
            array_splice($this->selectedAds, $index, 1);
        }

        $this->rating = 5;
    }

    public function rate(int $n): void
    {
        $this->rating = $n;
    }

    public function routeChanged(string $route): void
    {
        $this->currentRoute = $route !== '' ? $route : '/';
        $this->rating = 5;
    }

    public function render()
    {
        $resolvedRoute = in_array($this->currentRoute, ['/', '/bayar'], true)
            ? $this->currentRoute
            : '/';

        return view('livewire.checkout-wizard', [
            'resolvedRoute' => $resolvedRoute,
        ]);
    }
}
