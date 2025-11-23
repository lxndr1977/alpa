<?php

use Livewire\Volt\Volt;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SegmentController;


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});


Route::get('/',[HomeController::class, 'show'])->name('home');

Route::get('produtos',[ProductController::class, 'index'])->name('products.index');
Route::get('produtos/{product:slug}',[ProductController::class, 'show'])->name('products.show');

Route::get('categorias', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categorias/{slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('segmentos', [SegmentController::class, 'index'])->name('segments.index');
Route::get('segmentos/{slug}', [SegmentController::class, 'show'])->name('segments.show');

Route::view('politica-de-privacidade', 'site.privacy-policy.index')->name('privacy-policy');
Route::view('sobre', 'site.about.index')->name('about');
Route::view('suporte', 'site.support.index')->name('support');
Route::view('fale-conosco', 'site.contact.index')->name('contact');

require __DIR__.'/auth.php';
