<x-layouts.app title="Register">
    <div class="mx-auto mt-16 max-w-md rounded-lg border border-stone-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-bold">Register</h1>
        <p class="mt-1 text-sm text-stone-500">The first user becomes admin. Later users become staff and only handle orders.</p>
        <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="text-sm font-medium">Name</label>
                <input name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
            </div>
            <div>
                <label class="text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
            </div>
            <div>
                <label class="text-sm font-medium">Password</label>
                <input type="password" name="password" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
            </div>
            <div>
                <label class="text-sm font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
            </div>
            <button class="w-full rounded-md bg-amber-700 px-4 py-2 font-semibold text-white hover:bg-amber-800">Create Account</button>
        </form>
        <p class="mt-4 text-sm text-stone-600">Already registered? <a class="font-semibold text-amber-700" href="{{ route('login') }}">Login</a></p>
    </div>
</x-layouts.app>
