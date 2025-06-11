<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Purchase_Order_Controller;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    // users view

    Route::get('/accounts', [AccountController::class, 'employess'])->name('employe-Accounts');
    Route::post('/account/save-user', [AccountController::class, 'adminRegister']);
    Route::put('/role-update/{id}', [AccountController::class, 'updateUser']);
    Route::get('/delete-user/{id}', [AccountController::class, 'deleteUser']);


    // home 
    Route::get('/', [BooksController::class, 'library'])->name('home');

    // book -----------------------------------------
    Route::get('/', [BooksController::class, 'library'])->name('library');
    Route::get('/addBook', [BooksController::class, 'newBook'])->name('addBook');
    Route::post('/saveBook', [BooksController::class, 'saveBook']);


    // View a single book
    Route::get('/book/{id}', [BooksController::class, 'show'])->name('book.show');
    // (Optional: for legacy links)
    Route::get('/view-book/{id}', [BooksController::class, 'show']);

    Route::get('/editbook/{id}', [InventoryController::class, 'editbook']);
    Route::get('/deletebook/{id}', [InventoryController::class, 'deletebook']);
    Route::put('/update-book/{id}', [BooksController::class, 'updateBook']);



    // CART ------------------
    Route::get('/viewCart', [CartController::class, 'viewCart'])->name('viewCart');
    Route::post('/add-to-cart', [CartController::class, 'addtoCart'])->name('addCart');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

    // invoice
    Route::get('/cancel-order', [CartController::class, 'cancelorder'])->name('cancelorder');
    Route::get('/invoice/download/{id}', [InvoiceController::class, 'downloadinvoice'])->name('invoice.download');

    // inventory
    Route::get('/inventory', [InventoryController::class, 'inventory'])->name('inventory');


    // purchase 
    Route::get('/purchase', [Purchase_Order_Controller::class, 'purchase'])->name('purchase');
    Route::get('/orders-list', [Purchase_Order_Controller::class, 'orderslist'])->name('orderslist');
    Route::post('/Save_purchase', [Purchase_Order_Controller::class, 'Save_purchase'])->name('save_purchase');
    Route::put('/orders-update/{id}', [Purchase_Order_Controller::class, 'update_purchase'])->name('orders.update');


    // suppliers

    Route::post('/saveSupplier', [SupplierController::class, 'newSupplier']);
    Route::get('/Supplier', [SupplierController::class, 'SuppliersList'])->name('suppliers');
    Route::get('/supplier/edit/{id}', [SupplierController::class, 'editSupplier'])->name('supplier.edit');
    Route::put('/supplier/update/{id}', [SupplierController::class, 'updateSupplier'])->name('supplier.update');
    Route::delete('/supplier/delete/{id}', [SupplierController::class, 'deleteSupplier'])->name('supplier.delete');

    // sales report
    Route::get('/sales-reports', [SalesReportController::class, 'index'])->name('sales_report.index');
    Route::post('/sales-reports/generate', [SalesReportController::class, 'generate'])->name('sales_report.generate');
    Route::get('/sales-reports/{id}', [SalesReportController::class, 'show'])->name('sales_report.show');
    Route::get('/sales-reports/download/{id}', [SalesReportController::class, 'download'])->name('sales_report.download');
});


// Route::middleware(['auth', 'role:Admin'])->group(function () {


// });



Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/login', [AccountController::class, 'login'])->name("login");
Route::get('/register', [AccountController::class, 'register']);

Route::post('/register/RegValidate', [AccountController::class, 'validateRegister']);
Route::post('/login/loginValidate', [AccountController::class, 'loginValidate']);
