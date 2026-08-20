<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Cart;
use App\Livewire\Pages\CartSuccess;
use App\Livewire\Pages\Checkout;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\DeliveryMethod;
use App\Livewire\Pages\ForgotPassword;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Login;
use App\Livewire\Pages\Register;
use App\Livewire\Pages\ResetPassword;
use App\Livewire\Pages\ShippingCourier;
use App\Livewire\Pages\ShippingDetails;
use App\Livewire\Pages\Shop;
use App\Livewire\Pages\SingleProductPage;
use App\Livewire\User\AccountProfile;
use App\Livewire\User\ChangePassword;
use App\Livewire\User\Dashboard;
use App\Livewire\User\MyReview;
use App\Livewire\User\OrderDetails;
use App\Livewire\User\OrderLadger;
use App\Livewire\User\WriteReview;
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
    Route::get('/shipping-details', ShippingDetails::class)->name("shipping-details");
    // Route::get('/checkout', Checkout::class)->name("checkout");
    Route::get('/shipping-courier', ShippingCourier::class)->name("shipping-courier");
    Route::get('/cart-success', CartSuccess::class)->name("cart-success");
    Route::get('/single-product', SingleProductPage::class)->name("single-product");
    Route::get('/delivery-method', DeliveryMethod::class)->name("delivery-method");
});


Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


Route::prefix("auth")->group(function(){
    Route::get('/login', Login::class)->name("login");
    Route::get('/register', Register::class)->name("register");
    Route::get('/forgot-password', ForgotPassword::class)->name("forgot-password");
    Route::get('/reset-password', ResetPassword::class)->name("reset-password");
});


Route::middleware(['api.session'])->prefix("user")->group(function(){
    Route::get('/dashboard', Dashboard::class)->name("dashboard");
    Route::get('/order-ladger', OrderLadger::class)->name("order-ladger");
    Route::get('/orders-details', OrderDetails::class)->name("orders-details");
    Route::get('/profile', AccountProfile::class)->name("profile");
    Route::get('/my-review', MyReview::class)->name("my-review");
    Route::get('/write-review', WriteReview::class)->name("write-review");
    Route::get('/change-password', ChangePassword::class)->name("change-password");
    
});








