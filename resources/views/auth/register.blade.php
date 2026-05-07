<x-layouts.app title="Register">
    <div class="flex flex-1 items-center justify-center px-4 py-16">
        <div class="w-full max-w-md rounded-lg border border-stone-200 bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-bold">Register</h1>
            <p class="mt-1 text-sm text-stone-500">The first user becomes admin. Later users become staff and only handle orders.</p>
            <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label for="name" class="text-sm font-medium">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-200">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="text-sm font-medium">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-200">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="text-sm font-medium">Password</label>
                    <input id="password" type="password" name="password" autocomplete="new-password" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-200">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="text-sm font-medium">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-200">
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full rounded-md bg-amber-700 px-4 py-2 font-semibold text-white transition-colors hover:bg-amber-800 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">Create Account</button>
            </form>
            <p class="mt-4 text-sm text-stone-600">Already registered? <a class="font-semibold text-amber-700 hover:text-amber-800" href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
</x-layouts.app>
