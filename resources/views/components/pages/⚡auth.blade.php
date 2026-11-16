
<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Customer;

new class extends Component
{
    public $mode = 'login';

    public $name = '';
    public $email = '';
    public $phone = '';
    public $password = '';
    public $password_confirmation = '';

    public function switchMode($mode)
    {
        $this->resetValidation();
        $this->reset([
            'name',
            'email',
            'phone',
            'password',
            'password_confirmation',
        ]);

        $this->mode = $mode;
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {
            $this->addError('email', 'Email atau password salah.');
            return;
        }

        request()->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return $this->redirectRoute('admin.dashboard');
        }

        return $this->redirectRoute('orders');
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:25',
            'password' => 'required|min:8|confirmed',
        ]);

        DB::transaction(function () {
            $customer = Customer::create([
                'name' => $this->name,
                'phone' => $this->phone,
            ]);

            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'role' => 'customer',
                'customer_id' => $customer->id,
            ]);

            Auth::login($user);
        });

        request()->session()->regenerate();

        return $this->redirectRoute('booking');
    }
};
?>

<div class="min-h-screen bg-slate-50 text-slate-800 antialiased flex items-center justify-center px-6 py-10">
    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <a href="{{ route('landing') }}"
                class="text-3xl font-extrabold tracking-tight text-slate-900">
                Oto<span class="text-blue-800">Care.</span>
            </a>

            <p class="text-sm text-slate-500 mt-3">
                Layanan perawatan kendaraan yang praktis dan terpercaya.
            </p>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">

            <h1 class="text-2xl font-extrabold text-slate-900">
                {{ $mode === 'login' ? 'Selamat Datang!' : 'Buat Akun Baru' }}
            </h1>

            <p class="text-sm text-slate-500 mt-2">
                {{ $mode === 'login'
                    ? 'Masuk ke akun OtoCare kamu.'
                    : 'Daftarkan akun untuk mulai menggunakan OtoCare.' }}
            </p>

            <div class="flex mt-6 p-1 bg-slate-100 rounded-xl">
                <button type="button"
                    wire:click="switchMode('login')"
                    class="flex-1 py-2 rounded-lg text-sm font-bold transition
                    {{ $mode === 'login' ? 'bg-white text-blue-800 shadow-sm' : 'text-slate-500' }}">
                    Login
                </button>

                <button type="button"
                    wire:click="switchMode('register')"
                    class="flex-1 py-2 rounded-lg text-sm font-bold transition
                    {{ $mode === 'register' ? 'bg-white text-blue-800 shadow-sm' : 'text-slate-500' }}">
                    Register
                </button>
            </div>

            @if ($mode === 'login')

                <form wire:submit="login" class="mt-6 space-y-4">

                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Email
                        </label>

                        <input type="email"
                            wire:model="email"
                            placeholder="nama@email.com"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        @error('email')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Password
                        </label>

                        <input type="password"
                            wire:model="password"
                            placeholder="Masukkan password"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        @error('password')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        wire:loading.attr="disabled"
                        class="w-full bg-blue-700 !text-white py-3 rounded-xl text-sm font-bold hover:bg-blue-800 transition disabled:opacity-50">
                        <span wire:loading.remove wire:target="login">Masuk</span>
                        <span wire:loading wire:target="login">Memproses...</span>
                    </button>

                </form>

            @else


            <form wire:submit="register" class="mt-6 space-y-4">

                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Nama Lengkap
                    </label>
                    <input
                        type="text"
                        wire:model="name"
                        wire:key="register-name"
                        autocomplete="name"
                        placeholder="Masukkan nama lengkap"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    >
                    @error('name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Email
                    </label>
                    <input
                        type="email"
                        wire:model="email"
                        wire:key="register-email"
                        autocomplete="email"
                        placeholder="Masukkan alamat email"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    >
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Nomor Telepon
                    </label>
                    <input
                        type="tel"
                        wire:model="phone"
                        wire:key="register-phone"
                        autocomplete="tel"
                        placeholder="Masukkan nomor telepon"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    >
                    @error('phone')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Password
                    </label>
                    <input
                        type="password"
                        wire:model="password"
                        wire:key="register-password"
                        autocomplete="new-password"
                        placeholder="Buat password"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    >
                    @error('password')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Konfirmasi Password
                    </label>
                    <input
                        type="password"
                        wire:model="password_confirmation"
                        wire:key="register-password-confirmation"
                        autocomplete="new-password"
                        placeholder="Ulangi password"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    >
                </div>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="w-full bg-blue-700 !text-white py-3 rounded-xl text-sm font-bold hover:bg-blue-800 transition disabled:opacity-50"
                >
                    <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
                    <span wire:loading wire:target="register">Memproses...</span>
                </button>

            </form>


            @endif

            <a href="{{ route('landing') }}"
                class="block text-center mt-6 text-sm font-bold text-blue-800 hover:text-blue-600 transition">
                ← Kembali ke Beranda
            </a>

        </div>
    </div>
</div>