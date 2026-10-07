<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlatMusik;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Produk
        $totalProducts = AlatMusik::count();

        // Total Transaksi
        $totalTransactions = Transaction::count();

        // Total Customer (user dengan role customer)
        $totalCustomers = User::where('role', 'customer')->count();

        // Total Revenue (hanya transaksi yang confirmed/completed)
        $totalRevenue = Transaction::whereIn('status', ['confirmed', 'completed'])
            ->sum('total_amount');

        // Transaksi Terbaru (5 terakhir)
        $recentTransactions = Transaction::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Produk dengan Stok Rendah (≤ 5)
        $lowStockProducts = AlatMusik::with('daerah')
            ->where('stok', '<=', 5)
            ->orderBy('stok', 'asc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalTransactions',
            'totalCustomers',
            'totalRevenue',
            'recentTransactions',
            'lowStockProducts'
        ));
    }
}