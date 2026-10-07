<?php
// routes/web.php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AlatMusikController as AdminAlatMusikController;
use App\Http\Controllers\Admin\DaerahController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Tidak perlu login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $featuredProducts = \App\Models\AlatMusik::with(['daerah', 'kategori'])
        ->latest()
        ->take(6)
        ->get();
    
    return view('home', compact('featuredProducts'));
})->name('home');

// Catalog Routes (Public)
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{alatMusik}', [CatalogController::class, 'show'])->name('catalog.show');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze/Fortify)
|--------------------------------------------------------------------------
*/

// Jika menggunakan Laravel Breeze, uncomment baris ini:
// require __DIR__.'/auth.php';

// Atau jika manual, gunakan ini:
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    
    Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
    
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    
    Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| Customer Routes (Hanya untuk role customer)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'customer'])->group(function () {
    
    // Cart Routes
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{alatMusik}', [CartController::class, 'add'])->name('add');
        Route::put('/{cart}', [CartController::class, 'update'])->name('update');
        Route::delete('/{cart}', [CartController::class, 'destroy'])->name('destroy');
    });

    // Checkout Routes
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/', [CheckoutController::class, 'store'])->name('store');
        Route::get('/payment/{transaction}', [CheckoutController::class, 'payment'])->name('payment');
    });

    // Payment Routes (Upload Bukti Transfer)
    Route::post('/payment/{transaction}/upload', [CheckoutController::class, 'uploadPaymentProof'])
        ->name('payment.upload');

    // Transaction Routes (Customer)
    Route::prefix('transactions')->name('transactions.')->group(function () {
        Route::get('/', function () {
            $transactions = \App\Models\Transaction::with(['transactionDetails.alatMusik'])
                ->where('user_id', auth()->id())
                ->latest()
                ->paginate(10);
            
            return view('transactions.index', compact('transactions'));
        })->name('index');
        
        Route::get('/{transaction}', function (\App\Models\Transaction $transaction) {
            // Check ownership
            if ($transaction->user_id !== auth()->id()) {
                abort(403);
            }
            
            $transaction->load(['transactionDetails.alatMusik.daerah', 'user']);
            return view('transactions.show', compact('transaction'));
        })->name('show');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Hanya untuk role admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Daerah Management
    Route::resource('daerah', DaerahController::class);

    // Kategori Management
    Route::resource('kategori', KategoriController::class);

    // Alat Musik Management
    Route::resource('alat-musik', AdminAlatMusikController::class)->parameters([
        'alat-musik' => 'alatMusik'
    ]);

    // Transaction Management
    Route::prefix('transactions')->name('transactions.')->group(function () {
        Route::get('/', [AdminTransactionController::class, 'index'])->name('index');
        Route::get('/{transaction}', [AdminTransactionController::class, 'show'])->name('show');
        Route::put('/{transaction}/status', [AdminTransactionController::class, 'updateStatus'])->name('updateStatus');
    });

    // ✅ Payment Methods Management
    Route::resource('payment-methods', \App\Http\Controllers\Admin\PaymentMethodController::class);
});

/*
|--------------------------------------------------------------------------
| Profile Routes (Semua user yang login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =============================================
// ROUTES SUMMARY / DOKUMENTASI
// =============================================

/*
PUBLIC ROUTES:
- GET  /                          → home
- GET  /catalog                   → catalog.index
- GET  /catalog/{alatMusik}       → catalog.show
- GET  /login                     → login
- POST /login                     → (auth)
- GET  /register                  → register
- POST /register                  → (auth)

CUSTOMER ROUTES (auth + customer middleware):
- GET    /cart                    → cart.index
- POST   /cart/add/{alatMusik}    → cart.add
- PUT    /cart/{cart}             → cart.update
- DELETE /cart/{cart}             → cart.destroy
- GET    /checkout                → checkout.index
- POST   /checkout                → checkout.store
- GET    /transactions            → transactions.index
- GET    /transactions/{id}       → transactions.show

ADMIN ROUTES (auth + admin middleware):
- GET    /admin/dashboard         → admin.dashboard

- GET    /admin/daerah            → admin.daerah.index
- GET    /admin/daerah/create     → admin.daerah.create
- POST   /admin/daerah            → admin.daerah.store
- GET    /admin/daerah/{id}/edit  → admin.daerah.edit
- PUT    /admin/daerah/{id}       → admin.daerah.update
- DELETE /admin/daerah/{id}       → admin.daerah.destroy

- GET    /admin/kategori          → admin.kategori.index
- GET    /admin/kategori/create   → admin.kategori.create
- POST   /admin/kategori          → admin.kategori.store
- GET    /admin/kategori/{id}/edit→ admin.kategori.edit
- PUT    /admin/kategori/{id}     → admin.kategori.update
- DELETE /admin/kategori/{id}     → admin.kategori.destroy

- GET    /admin/alat-musik        → admin.alat-musik.index
- GET    /admin/alat-musik/create → admin.alat-musik.create
- POST   /admin/alat-musik        → admin.alat-musik.store
- GET    /admin/alat-musik/{id}/edit → admin.alat-musik.edit
- PUT    /admin/alat-musik/{id}   → admin.alat-musik.update
- DELETE /admin/alat-musik/{id}   → admin.alat-musik.destroy

- GET    /admin/transactions      → admin.transactions.index
- GET    /admin/transactions/{id} → admin.transactions.show
- PUT    /admin/transactions/{id}/status → admin.transactions.updateStatus

AUTH ROUTES (all authenticated users):
- POST   /logout                  → logout
- GET    /profile                 → profile.edit
- PATCH  /profile                 → profile.update
- DELETE /profile                 → profile.destroy
*/