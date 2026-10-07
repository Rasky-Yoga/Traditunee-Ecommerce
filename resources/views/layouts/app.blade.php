<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Alat Musik Nusantara')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }
        
        .dropdown-menu {
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .alert-slide {
            animation: slideInRight 0.5s ease;
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }
        
        .footer-wave {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }
        
        .icon-bounce:hover {
            animation: bounce 0.5s;
        }
        
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }

        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('userDropdown');
            const button = document.getElementById('dropdownButton');
            if (dropdown && button && !button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
        
        // Auto hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert-auto-hide');
            alerts.forEach(alert => {
                alert.style.animation = 'slideInRight 0.5s ease reverse';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    {{-- Navbar --}}
    <nav class="glass-effect sticky top-0 z-50 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                            <i class="fas fa-music text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            Alat Musik Nusantara
                        </span>
                    </a>
                </div>

                <div class="flex items-center space-x-8">
                    <a href="{{ route('catalog.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium">
                        <i class="fas fa-th-large mr-2"></i>Katalog
                    </a>
                    
                    @auth
                        @if(auth()->user()->isCustomer())
                            <a href="{{ route('cart.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium relative">
                                <i class="fas fa-shopping-cart text-lg icon-bounce"></i>
                                @php
                                    $cartCount = auth()->user()->carts()->sum('quantity');
                                @endphp
                                @if($cartCount > 0)
                                    <span class="cart-badge text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
                                        {{ $cartCount > 99 ? '99+' : $cartCount }}
                                    </span>
                                @endif
                            </a>
                            <a href="{{ route('transactions.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium">
                                <i class="fas fa-receipt mr-2"></i>Transaksi Saya
                            </a>
                        @endif

                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard Admin
                            </a>
                        @endif

                        <div class="relative">
                            <button id="dropdownButton" onclick="toggleDropdown()" type="button" class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600 focus:outline-none group">
                                <div class="w-10 h-10 gradient-bg rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <span class="font-medium">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs group-hover:rotate-180 transition-transform duration-300"></i>
                            </button>
                            <div id="userDropdown" class="hidden dropdown-menu absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl py-2 border border-gray-100">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ auth()->user()->email }}</p>
                                </div>
                                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-300 rounded-xl mx-2 flex items-center space-x-3">
                                        <i class="fas fa-sign-out-alt text-indigo-600"></i>
                                        <span class="font-medium">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="btn-gradient text-white px-6 py-3 rounded-xl font-medium">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="fixed top-24 right-4 z-50 alert-slide alert-auto-hide">
            <div class="bg-white rounded-2xl shadow-2xl px-6 py-4 flex items-center space-x-4 border-l-4 border-green-500 max-w-md">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900">Berhasil!</p>
                    <p class="text-sm text-gray-600 mt-1">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-24 right-4 z-50 alert-slide alert-auto-hide">
            <div class="bg-white rounded-2xl shadow-2xl px-6 py-4 flex items-center space-x-4 border-l-4 border-red-500 max-w-md">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900">Oops!</p>
                    <p class="text-sm text-gray-600 mt-1">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    {{-- Content --}}
    <main class="py-12">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer-wave text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center">
                            <i class="fas fa-music text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold">Alat Musik Nusantara</h3>
                    </div>
                    <p class="text-gray-400 text-sm">Toko alat musik terpercaya dengan koleksi instrumen tradisional dan modern berkualitas.</p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Link Cepat</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors"><i class="fas fa-chevron-right mr-2 text-xs"></i>Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition-colors"><i class="fas fa-chevron-right mr-2 text-xs"></i>Katalog Produk</a></li>
                        <li><a href="#" class="hover:text-white transition-colors"><i class="fas fa-chevron-right mr-2 text-xs"></i>Cara Pemesanan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors"><i class="fas fa-chevron-right mr-2 text-xs"></i>Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li class="flex items-center"><i class="fas fa-map-marker-alt mr-3 text-indigo-400"></i>Jakarta, Indonesia</li>
                        <li class="flex items-center"><i class="fas fa-phone mr-3 text-indigo-400"></i>+62 123 456 789</li>
                        <li class="flex items-center"><i class="fas fa-envelope mr-3 text-indigo-400"></i>info@alatmusik.com</li>
                    </ul>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 transition-all duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 transition-all duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 transition-all duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 pt-8 text-center">
                <p class="text-gray-400 text-sm">&copy; 2024 Toko Alat Musik Nusantara. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>