@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-gray-700 text-sm">Ingat Saya</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 font-semibold">
                Login
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-600">Belum punya akun? 
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-semibold">Daftar Sekarang</a>
            </p>
        </div>

        <div class="mt-8 p-4 bg-gray-100 rounded">
            <p class="text-sm font-semibold text-gray-700 mb-2">Demo Accounts:</p>
            <p class="text-sm text-gray-600">Admin: admin@alatmusik.com / admin123</p>
            <p class="text-sm text-gray-600">Customer: budi@gmail.com / customer123</p>
        </div>
    </div>
</div>
@endsection