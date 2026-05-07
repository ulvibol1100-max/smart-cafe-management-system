<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Smart Cafe Management System' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 text-stone-900">
    <div class="flex min-h-screen">
        @auth
            <aside class="hidden w-64 shrink-0 border-r border-stone-200 bg-white p-5 lg:block">
                <div class="mb-8">
                    <p class="text-xs font-semibold uppercase tracking-widest text-amber-700">Smart Cafe</p>
                    <h1 class="mt-1 text-xl font-bold">Management System</h1>
                </div>
                <nav class="space-y-1">
                    @foreach ([
                        ['Dashboard', 'dashboard'],
                        ['Products', 'products.index'],
                        ['Customers', 'customers.index'],
                        ['Orders', 'orders.index'],
                        ['Staff', 'staff.index'],
                    ] as [$label, $route])
                        <a href="{{ route($route) }}" class="block rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs($route) || request()->routeIs(Str::before($route, '.') . '.*') ? 'bg-amber-100 text-amber-950' : 'text-stone-600 hover:bg-stone-100' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </nav>
            </aside>
        @endauth

        <main class="flex-1">
            @auth
                <header class="border-b border-stone-200 bg-white">
                    <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-4 sm:px-6 lg:px-8">
                        <div>
                            <p class="text-sm text-stone-500">Welcome, {{ auth()->user()->name }}</p>
                            <p class="font-semibold">{{ auth()->user()->is_admin ? 'Admin access' : 'Staff access' }}</p>
                        </div>
                        <div class="flex flex-wrap gap-2 lg:hidden">
                            <a href="{{ route('dashboard') }}" class="rounded-md bg-stone-100 px-3 py-2 text-sm">Dashboard</a>
                            <a href="{{ route('orders.index') }}" class="rounded-md bg-stone-100 px-3 py-2 text-sm">Orders</a>
                            <a href="{{ route('products.index') }}" class="rounded-md bg-stone-100 px-3 py-2 text-sm">Menu</a>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="rounded-md bg-stone-900 px-4 py-2 text-sm font-semibold text-white hover:bg-stone-700">Logout</button>
                        </form>
                    </div>
                </header>
            @endauth

            <section class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-4 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{ $slot }}
            </section>
        </main>
    </div>
</body>
</html>
