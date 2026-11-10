<div>
    <div id="st" aria-label="Rating">
        @for ($i = 0; $i < 5; $i++)
            <span
                wire:key="rating-{{ $i }}"
                style="opacity: {{ $i < $rating ? '1' : '.3' }}"
            >★</span>
        @endfor
    </div>

    @if ($resolvedRoute === '/bayar')
        <main>
            <h1>Pembayaran</h1>
            <p>Halaman pembayaran.</p>

            <button type="button" wire:click="st(-1)">
                Kembali
            </button>
        </main>
    @else
        <main>
            <h1>Langkah {{ $step }}</h1>

            <h2>Pilih iklan</h2>
            @foreach ([0, 1, 2] as $i)
                <button
                    type="button"
                    wire:key="ad-{{ $i }}"
                    wire:click="ad({{ $i }})"
                    aria-pressed="{{ in_array($i, $selectedAds, true) ? 'true' : 'false' }}"
                >
                    Iklan {{ $i + 1 }}
                    @if (in_array($i, $selectedAds, true))
                        ✓
                    @endif
                </button>
            @endforeach

            <p>
                Iklan terpilih:
                {{ $selectedAds === [] ? 'Tidak ada' : implode(', ', $selectedAds) }}
            </p>

            <button
                type="button"
                wire:click="st(-1)"
                @disabled($step <= 1)
            >
                Sebelumnya
            </button>

            <button type="button" wire:click="st(1)">
                Berikutnya
            </button>
        </main>
    @endif
</div>

@script
<script>
    $wire.on('navigate-hash', (event) => {
        window.location.hash = `#${event.route}`;
    });

    $wire.on('scroll-to-top', () => {
        window.scrollTo(0, 0);
    });

    const syncRouteFromHash = () => {
        const route = window.location.hash.slice(1) || '/';

        $wire.routeChanged(route);
        window.scrollTo(0, 0);
    };

    window.addEventListener('hashchange', syncRouteFromHash);

    // Match the component to the URL hash when it first loads.
    syncRouteFromHash();
</script>
@endscript
