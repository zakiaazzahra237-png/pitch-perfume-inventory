<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-sm text-green-600" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Username / Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-[#3a2e2b] mb-1">Username / Email</label>
            <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus 
                class="w-full px-4 py-3 rounded-xl border border-[#d3c5b4] bg-white text-[#3a2e2b] focus:outline-none focus:ring-2 focus:ring-[#8c5a47]">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-[#3a2e2b] mb-1">Password</label>
            <input id="password" type="password" name="password" required 
                class="w-full px-4 py-3 rounded-xl border border-[#d3c5b4] bg-white text-[#3a2e2b] focus:outline-none focus:ring-2 focus:ring-[#8c5a47]">
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center text-[#736356]">
                <input type="checkbox" name="remember" class="rounded border-[#d3c5b4] text-[#8c5a47] focus:ring-[#8c5a47]">
                <span class="ml-2">Ingat Saya</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-3.5 px-4 bg-[#8c5a47] hover:bg-[#6e4435] text-white font-bold rounded-xl shadow-md transition duration-200">
            Masuk Sekarang
        </button>
    </form>
</x-guest-layout>