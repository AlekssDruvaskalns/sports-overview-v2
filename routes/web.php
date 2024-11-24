<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('organization', OrganizationController::class);
Route::post('organization/{organization}/addevent',[OrganizationController::class, 'addEvent'])->name('organization.addevent');
Route::post('organization/{organization}/removeevent',[OrganizationController::class, 'removeEvent'])->name('organization.removeevent');
Route::resource('event', EventController::class);

Route::post('event/{event}/addorganization',[EventController::class, 'addOrganization'])->name('event.addorganization');
Route::post('event/{event}/removeorganization',[EventController::class, 'removeOrganization'])->name('event.removeorganization');


require __DIR__.'/auth.php';
