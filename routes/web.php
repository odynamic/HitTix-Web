<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LandingController,
    EventController,
    ContactController,
    AboutController,
    EoRegisterController,
    EoLoginController,
    DashboardController,
    ProfileController,
    OrderController,
    EoPaymentController,
    PaymentController,
    MidtransController
};

/*
|--------------------------------------------------------------------------
| PUBLIC AREA
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/tentang-kami', [AboutController::class, 'tentang'])->name('about');
Route::get('/hubungi-kami', [ContactController::class, 'kontak'])->name('kontak');
Route::get('/jelajah', [EventController::class, 'index'])->name('jelajah');
Route::get('/event/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/gabung-jadi-eo', fn() => view('auth.gabung-eo'))->name('gabung.eo');
Route::get('/login', fn() => redirect()->route('eo.login.form'))->name('login');

/*
|--------------------------------------------------------------------------
| EO AUTH
|--------------------------------------------------------------------------
*/
Route::prefix('eo')->name('eo.')->group(function () {
    Route::get('/register', [EoRegisterController::class, 'showForm'])->name('register.form');
    Route::post('/register', [EoRegisterController::class, 'store'])->name('register.submit');
    Route::get('/login', [EoLoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [EoLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [EoLoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| EO AREA (Logged in EO only)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard EO
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.eo');
    Route::get('/dashboard/tickets', [DashboardController::class, 'tickets'])->name('dashboard.eo.tickets');
    Route::get('/dashboard/tickets/{event}', [DashboardController::class, 'ticketDetail'])->name('eo.tickets.detail');
    Route::get('/dashboard/payments', [DashboardController::class, 'payments'])->name('dashboard.eo.payments');

    // EVENT CRUD EO
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [EventController::class, 'eoIndex'])->name('index');
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/', [EventController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [EventController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EventController::class, 'update'])->name('update');
        Route::delete('/{id}', [EventController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/publish', [EventController::class, 'publish'])->name('publish');
    });

    // PEMBAYARAN EO (Paket Event via Midtrans)
    Route::prefix('eo/payment')->name('eo.payment.')->group(function () {
        Route::get('/options', [EoPaymentController::class, 'showOptions'])->name('options');
        Route::get('/{event}/choose-package', [EoPaymentController::class, 'index'])->name('choose');
        Route::post('/checkout', [EoPaymentController::class, 'redirecttomidtrans'])->name('checkout');
        Route::get('/{event}/success', [EoPaymentController::class, 'paymentSuccess'])->name('success');
        Route::get('/failed', [EoPaymentController::class, 'paymentFailed'])->name('failed');
    });

    // PROFILE EO
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // MIDTRANS Integration
    Route::prefix('midtrans')->name('midtrans.')->group(function () {
        Route::post('/token', [MidtransController::class, 'getSnapToken'])->name('token');
        Route::post('/checkout', [MidtransController::class, 'checkout'])->name('checkout');
        Route::get('/status/{order_id}', [MidtransController::class, 'checkStatus'])->name('checkStatus');
    });

    Route::post('/midtrans/callback', [PaymentController::class, 'handleMidtransCallback']);
});

/*
|--------------------------------------------------------------------------
| PEMBAYARAN TIKET EVENT (Guest/Publik)
|--------------------------------------------------------------------------
*/
// Pembayaran langsung oleh pengunjung umum (tanpa login)
Route::get('/event/payment/{ticket}', [PaymentController::class, 'showEventPayment'])->name('event.payment');
Route::post('/event/payment/{ticket}', [PaymentController::class, 'processEventPayment'])->name('event.payment.process');

// Pembelian tiket event oleh siapa pun (guest atau login)
Route::get('/events/{event}/orders/create', [OrderController::class, 'showBuyForm'])->name('orders.create');
Route::post('/events/{event}/buy', [OrderController::class, 'store'])->name('order.store');
