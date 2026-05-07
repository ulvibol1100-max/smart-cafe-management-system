<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Smart Cafe Management System' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen bg-[#f6f1ea] text-stone-900 antialiased">
    <div class="flex min-h-screen">
        @auth
            <aside class="hidden w-72 shrink-0 bg-stone-950 p-5 text-white lg:block">
                <div class="mb-8 rounded-lg border border-white/10 bg-white/5 p-4">
                    <p class="text-xs font-semibold uppercase tracking-widest text-amber-300">Smart Cafe</p>
                    <h1 class="mt-1 text-2xl font-bold leading-tight">Management System</h1>
                    <p class="mt-3 text-xs leading-5 text-stone-300">{{ auth()->user()->is_admin ? 'Full control for cafe management.' : 'Fast order handling for staff.' }}</p>
                </div>
                <nav class="space-y-1">
                    @php
                        $links = auth()->user()->is_admin
                            ? [
                                ['Dashboard', 'dashboard'],
                                ['Products', 'products.index'],
                                ['Customers', 'customers.index'],
                                ['Orders', 'orders.index'],
                                ['Staff', 'staff.index'],
                            ]
                            : [
                                ['New Order', 'orders.create'],
                                ['Order History', 'orders.index'],
                            ];
                    @endphp
                    @foreach ($links as [$label, $route])
                        <a href="{{ route($route) }}" class="block rounded-md px-4 py-3 text-sm font-semibold transition {{ request()->routeIs($route) || request()->routeIs(Str::before($route, '.') . '.*') ? 'bg-amber-400 text-stone-950 shadow-sm' : 'text-stone-300 hover:bg-white/10 hover:text-white' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </nav>
            </aside>
        @endauth

        <main class="flex-1">
            @auth
                <header class="sticky top-0 z-20 border-b border-stone-200/80 bg-white/90 backdrop-blur">
                    <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-4 sm:px-6 lg:px-8">
                        <div>
                            <p class="text-sm text-stone-500">Welcome, {{ auth()->user()->name }}</p>
                            <p class="font-semibold text-stone-950">{{ auth()->user()->is_admin ? 'Admin access' : 'Staff order mode' }}</p>
                        </div>
                        <div class="flex flex-wrap gap-2 lg:hidden">
                            <a href="{{ route('orders.index') }}" class="rounded-md bg-stone-100 px-3 py-2 text-sm font-semibold">Orders</a>
                            <a href="{{ route('orders.create') }}" class="rounded-md bg-amber-100 px-3 py-2 text-sm font-semibold text-amber-900">New Order</a>
                            @if (auth()->user()->is_admin)
                                <a href="{{ route('dashboard') }}" class="rounded-md bg-stone-100 px-3 py-2 text-sm font-semibold">Dashboard</a>
                                <a href="{{ route('products.index') }}" class="rounded-md bg-stone-100 px-3 py-2 text-sm font-semibold">Menu</a>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="rounded-md border border-stone-300 bg-white px-4 py-2 text-sm font-semibold text-stone-700 transition hover:border-stone-400 hover:bg-stone-100">Logout</button>
                        </form>
                    </div>
                </header>
            @endauth

            <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 shadow-sm">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800 shadow-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{ $slot }}
            </section>
        </main>
    </div>
</body>
</html>
