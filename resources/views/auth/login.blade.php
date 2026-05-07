<x-layouts.app title="Login">
    <div class="mx-auto mt-16 max-w-md rounded-lg border border-stone-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-bold">Login</h1>
        <p class="mt-1 text-sm text-stone-500">Access the cafe dashboard.</p>
        <div class="mt-4 rounded-md bg-stone-100 p-3 text-sm text-stone-700">
            <p><strong>Admin:</strong> admin@smartcafe.test / password</p>
            <p><strong>Staff:</strong> staff@smartcafe.test / password</p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
            </div>
            <div>
                <label class="text-sm font-medium">Password</label>
                <input type="password" name="password" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
            </div>
            <button class="w-full rounded-md bg-amber-700 px-4 py-2 font-semibold text-white hover:bg-amber-800">Login</button>
        </form>
        <p class="mt-4 text-sm text-stone-600">No account? <a class="font-semibold text-amber-700" href="{{ route('register') }}">Register</a></p>
    </div>
</x-layouts.app>
