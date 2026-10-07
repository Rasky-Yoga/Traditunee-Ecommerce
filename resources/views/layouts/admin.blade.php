<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h2 class="text-2xl font-bold">Admin Panel</h2>
            </div>
            <nav class="mt-8">
    <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 hover:bg-gray-700">
        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
    </a>
    <a href="{{ route('admin.daerah.index') }}" class="block py-2.5 px-4 hover:bg-gray-700">
        <i class="fas fa-map-marker-alt mr-3"></i> Daerah
    </a>
    <a href="{{ route('admin.kategori.index') }}" class="block py-2.5 px-4 hover:bg-gray-700">
        <i class="fas fa-tags mr-3"></i> Kategori
    </a>
    <a href="{{ route('admin.alat-musik.index') }}" class="block py-2.5 px-4 hover:bg-gray-700">
        <i class="fas fa-guitar mr-3"></i> Alat Musik
    </a>
    <a href="{{ route('admin.transactions.index') }}" class="block py-2.5 px-4 hover:bg-gray-700">
        <i class="fas fa-receipt mr-3"></i> Transaksi
    </a>

    {{-- ✅ Tambahan Menu Payment Methods --}}
    <a href="{{ route('admin.payment-methods.index') }}" class="block py-2.5 px-4 hover:bg-gray-700">
        <i class="fas fa-credit-card mr-3"></i> Payment Methods
    </a>

    <hr class="my-4 border-gray-700">
    <a href="{{ route('home') }}" class="block py-2.5 px-4 hover:bg-gray-700">
        <i class="fas fa-home mr-3"></i> Ke Halaman Utama
    </a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left py-2.5 px-4 hover:bg-gray-700">
            <i class="fas fa-sign-out-alt mr-3"></i> Logout
        </button>
    </form>
</nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow-sm">
                <div class="px-8 py-4">
                    <h1 class="text-2xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>
                </div>
            </header>

            <main class="p-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>