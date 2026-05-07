<x-layouts.app title="Login">
    <div class="flex flex-1 items-center justify-center px-4 py-16">
        <div class="w-full max-w-md rounded-lg border border-stone-200 bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-bold">Login</h1>
            <p class="mt-1 text-sm text-stone-500">Access the cafe dashboard.</p>
            <div class="mt-4 rounded-md bg-stone-100 p-3 text-sm text-stone-700">
                <p><strong>Admin:</strong> admin@smartcafe.test / password</p>
                <p><strong>Staff:</strong> staff@smartcafe.test / password</p>
            </div>
            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label for="email" class="text-sm font-medium">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-200">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="text-sm font-medium">Password</label>
                    <input id="password" type="password" name="password" autocomplete="current-password" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-200">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full rounded-md bg-amber-700 px-4 py-2 font-semibold text-white transition-colors hover:bg-amber-800 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">Login</button>
            </form>
            <p class="mt-4 text-sm text-stone-600">No account? <a class="font-semibold text-amber-700 hover:text-amber-800" href="{{ route('register') }}">Register</a></p>
        </div>
    </div>
</x-layouts.app>