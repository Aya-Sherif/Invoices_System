<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Product;
use Illuminate\Support\Facades\Route;







// Route::get('/', function () {
//     return view('welcome');
// });


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    Route::resource('admin/users', AdminController::class);
    Route::resource('user', UserController::class);
});
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name(name: 'dashboard');
// Sales Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('invoice', InvoiceController::class);
    Route::post('invoice/show', [InvoiceController::class, 'display'])->name('invoice.display');
    Route::get('/fetch-sizes', [ProductController::class, 'fetchSizes'])->name('fetch.sizes');
});

Route::middleware(['auth', 'verified', 'is_admin_or_sales_or_accounts'])->group(function () {
    Route::resource('productdetails', ProductSizeController::class);
    Route::get('/product/filter', [ProductController::class, 'filter'])->name('product.filter');
});
Route::middleware(['auth', 'verified', 'is_admin_or_accounts'])->group(function () {
    Route::resource('client', ClientController::class);
    Route::get('editQuantity/{id}', [ProductSizeController::class, 'editQuantity'])->name('productdetails.editQuantity');
    Route::put('updatequantity/{id}', [ProductSizeController::class, 'updatequantity'])->name('productdetails.updateQuantity');
    Route::Post('invoice/Approved/{id}', [InvoiceController::class, 'changeStateToApproved'])->name('invoice.changeStateToApproved');
    Route::get('/prnpriview/{id}', [PrintController::class, 'prnpriview']);
// Payment routes
Route::get('/payments/{invoiceId}/create', [PaymentController::class, 'createPaymentForm'])->name('payments.create');
Route::post('/payments/{invoiceId}/process', [PaymentController::class, 'processPayment'])->name('payments.process');
Route::get('/clients/{clientId}/balance/edit', [PaymentController::class, 'editClientBalance'])->name('clients.balance.edit');
Route::post('/clients/{clientId}/balance/update', [PaymentController::class, 'processBalanceUpdate'])->name('clients.balance.update');

    Route::resource('product', ProductController::class);
});
Route::middleware(['auth', 'verified', 'is_admin_or_stock'])->group(function () {
    Route::get('invoice/display/{id}', [InvoiceController::class, 'stockDisplay'])->name('invoice.displayForStock');
    Route::Post('invoice/Complete/{id}', [InvoiceController::class, 'changeStateToShipped'])->name('invoice.changeState');
});

Route::get('/', [FrontController::class, 'index'])->name('home');


// // Accounts Routes
// Route::middleware('role:accounts,admin')->group(function () {
//     Route::resource('accounts/invoices', AccountsController::class)->except(['show', 'update', 'destroy']);
//     // Add custom routes separately
//     Route::post('accounts/invoices/{id}/approve', [AccountsController::class, 'approveInvoice'])->name('accounts.approveInvoice');
//     Route::post('accounts/clients', [AccountsController::class, 'addClient'])->name('accounts.addClient');
//     Route::get('accounts/clients/{id}/statement', [AccountsController::class, 'viewClientStatement'])->name('accounts.viewClientStatement');
//     Route::get('accounts/invoices/old', [AccountsController::class, 'listOldInvoices'])->name('accounts.listOldInvoices');
//     Route::post('accounts/products', [AccountsController::class, 'addProduct'])->name('accounts.addProduct');
// });


// // Stock Routes
// Route::middleware('role:stock,admin')->group(function () {
//     Route::resource('stock/products', StockController::class)->only(['index']);
//     // Add custom routes separately
//     Route::post('stock/invoices/{id}/receive', [StockController::class, 'receiveInvoice'])->name('stock.receiveInvoice');
// });

// Admin Routes


require __DIR__ . '/auth.php';
