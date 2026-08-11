<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Cart;
use App\Livewire\Pages\CartSuccess;
use App\Livewire\Pages\Checkout;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Login;
use App\Livewire\Pages\Register;
use App\Livewire\Pages\Shop;
use App\Livewire\Pages\SingleProductPage;
use App\Livewire\User\AccountProfile;
use App\Livewire\User\ChangePassword;
use App\Livewire\User\Dashboard;
use App\Livewire\User\OrderDetails;
use App\Livewire\User\OrderLadger;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix("page")->group(function(){
    Route::get('/home', Home::class)->name("home");
    Route::get('/shop', Shop::class)->name("shop");
    Route::get('/contact', Contact::class)->name("contact");
    Route::get('/about', About::class)->name("about");
    Route::get('/cart', Cart::class)->name("cart");
    Route::get('/checkout', Checkout::class)->name("checkout");
    Route::get('/cart-success', CartSuccess::class)->name("cart-success");
    Route::get('/single-product', SingleProductPage::class)->name("single-product");
});


Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


Route::prefix("auth")->group(function(){
    Route::get('/login', Login::class)->name("login");
    Route::get('/register', Register::class)->name("register");
    // Route::get('/forgot-password', ForgotPassword::class)->name("forgot-password");
    // Route::get('/reset-password', ResetPassword::class)->name("reset-password");
});


Route::prefix("user")->group(function(){
    Route::get('/dashboard', Dashboard::class)->name("dashboard");
    Route::get('/order-ladger', OrderLadger::class)->name("order-ladger");
    Route::get('/orders-details', OrderDetails::class)->name("orders-details");
    Route::get('/profile', AccountProfile::class)->name("profile");
    Route::get('/change-password', ChangePassword::class)->name("change-password");
    
});