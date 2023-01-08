<?php

use App\Http\Controllers\CvsController;
use App\Http\Controllers\EmployersController;
use App\Http\Controllers\JobadvertisementsController;
use App\Http\Controllers\JobapplicationsController;
use App\Http\Controllers\JobseekersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Models\Jobadvertisement;
use Illuminate\Support\Facades\Route;

/*
|------------------------|
| A kezdőoldal útvonala. |
|------------------------|
*/

Route::get('/', function () {
    $jobadvertisements = Jobadvertisement::with(['user'])
        ->orderBy('created_at', 'desc')
        ->filter(request(['search']))
        ->paginate(10);
    return view('pages.home', compact('jobadvertisements'));
});
/*
|------------------------------|
| A Kapcsolat oldal útvonalai. |
|------------------------------|
*/
Route::get('contact', [PagesController::class, 'contact'])
    ->name('contact');
Route::post('contact', [PagesController::class, 'email'])
    ->name('email');
/*
|---------------------------------|
| Az Információk oldal útvonalai. |
|---------------------------------|
*/
Route::get('informations', [PagesController::class, 'informations'])
    ->name('informations');
/*
|---------------------|
| MUNKAADÓK ÚTVONALAI |
|---------------------|
*/
// Új munkaadó létrehozására szolgáló űrlap megjelenítése.
Route::get('employers/create', [EmployersController::class, 'create'])
    ->name('employers.create');
// Új munkaadó létrehozása az adatbázisban.
Route::post('employers', [EmployersController::class, 'store'])
    ->name('employers.store');
// Létező munkaadó módosítására szolgáló űrlap megjelenítése.
Route::get('employers/{employer}/edit', [EmployersController::class, 'edit'])
    ->name('employers.edit')
    ->middleware('auth');
// Létező munkaadó módosítása az adatbázisban.
Route::put('employers/{employer}', [EmployersController::class, 'update'])
    ->name('employers.update')
    ->middleware('auth');
// Létező munkaadó törlése az adatbázisból.
Route::delete('employers/{employer}', [EmployersController::class, 'destroy'])
    ->name('employers.destroy')
    ->middleware('auth');
// Az összes létező munkaadó lekérdezése az adatbázisból.
Route::get('employers', [EmployersController::class, 'index'])
    ->name('employers.index')
    ->middleware('auth');
// Létező munkaadó összes álláshirdetésének lekérdezése az adatbázisból.
Route::get('employers/jobadvertisements', [EmployersController::class, 'jobadvertisements'])
    ->name('employers.jobadvertisements')
    ->middleware('auth');
/*
|---------------------------|
| ÁLLÁSHIRDETÉSEK ÚTVONALAI |
|---------------------------|
*/
// Új álláshirdetés létrehozására szolgáló űrlap megjelenítése.
Route::get('jobadvertisements/create', [JobadvertisementsController::class, 'create'])
    ->name('jobadvertisements.create')
    ->middleware('auth');
// Új álláshirdetés létrehozása az adatbázisban.
Route::post('jobadvertisements', [JobadvertisementsController::class, 'store'])
    ->name('jobadvertisements.store')
    ->middleware('auth');
// Létező álláshirdetés módosítására szolgáló űrlap megjelenítése.
Route::get('jobadvertisements/{jobadvertisement}/edit', [JobadvertisementsController::class, 'edit'])
    ->name('jobadvertisements.edit')
    ->middleware('auth');
// Létező álláshirdetés módosítása az adatbázisban.
Route::put('jobadvertisements/{jobadvertisement}', [JobadvertisementsController::class, 'update'])
    ->name('jobadvertisements.update')
    ->middleware('auth');
// Létező álláshirdetés törlése az adatbázisból.
Route::delete('jobadvertisements/{jobadvertisement}', [JobadvertisementsController::class, 'destroy'])
    ->name('jobadvertisements.destroy')
    ->middleware('auth');
// Az összes létező álláshirdetés lekérdezése az adatbázisból.
Route::get('jobadvertisements', [JobadvertisementsController::class, 'index'])
    ->name('jobadvertisements.index');
// Létező álláshirdetés lekérdezése az adatbázisból.
Route::get('jobadvertisements/{jobadvertisement}', [JobadvertisementsController::class, 'show'])
    ->name('jobadvertisements.show');
/*
|------------------------|
| ÁLLÁSKERESŐK ÚTVONALAI |
|------------------------|
*/
// Új álláskereső létrehozására szolgáló űrlap megjelenítése.
Route::get('jobseekers/create', [JobseekersController::class, 'create'])
    ->name('jobseekers.create');
// Új álláskereső létrehozása az adatbázisban.
Route::post('jobseekers', [JobseekersController::class, 'store'])
    ->name('jobseekers.store');
// Létező álláskereső módosítására szolgáló űrlap megjelenítése.
Route::get('jobseekers/{jobseeker}/edit', [JobseekersController::class, 'edit'])
    ->name('jobseekers.edit')
    ->middleware('auth');
// Létező álláskereső módosítása az adatbázisban.
Route::put('jobseekers/{jobseeker}', [JobseekersController::class, 'update'])
    ->name('jobseekers.update')
    ->middleware('auth');
// Létező álláskereső törlése az adatbázisból.
Route::delete('jobseekers/{jobseeker}', [JobseekersController::class, 'destroy'])
    ->name('jobseekers.destroy')
    ->middleware('auth');
// Az összes létező álláskereső lekérdezése az adatbázisból.
Route::get('jobseekers', [JobseekersController::class, 'index'])
    ->name('jobseekers.index')
    ->middleware('auth');
// Az álláskereső összes jelentkezésének lekérdezése az adatbázisból.
Route::get('jobseekers/jobapplications', [JobseekersController::class, 'jobapplications'])
    ->name('jobseekers.jobapplications')
    ->middleware('auth');
/*
|------------------------|
| ÖNÉLETRAJZOK ÚTVONALAI |
|------------------------|
*/
// Új önéletrajz létrehozása az adatbázisban.
Route::post('cvs', [CvsController::class, 'store'])
    ->name('cvs.store');
// Létező önéletrajz letöltése a szerverről.
Route::get('cvs/{cv}', [CvsController::class, 'show'])
    ->name('cvs.show')
    ->middleware('auth');
// Létező önéletrajz törlése az adatbázisból és a szerverről.
Route::delete('cvs/{cv}', [CvsController::class, 'destroy'])
    ->name('cvs.destroy')
    ->middleware('auth');
/*
|-------------------------|
| JELENTKEZÉSEK ÚTVONALAI |
|-------------------------|
*/
// Új jelentkezés létrehozására szolgáló űrlap megjelenítése.
Route::get('jobadvertisements/{jobadvertisement}/jobapplications/create', [JobapplicationsController::class, 'create'])
    ->name('jobapplications.create')
    ->middleware('auth');
// Új jelentkezés létrehozása az adatbázisban.
Route::post('jobapplications', [JobapplicationsController::class, 'store'])
    ->name('jobapplications.store')
    ->middleware('auth');
// Létező jelentkezés törlése az adatbázisból.
Route::delete('jobapplications/{jobapplication}', [JobapplicationsController::class, 'destroy'])
    ->name('jobapplications.destroy')
    ->middleware('auth');
// Jelentkezés állapotának módosítása az adatbázisban.
Route::patch('jobapplications/{jobapplication}/status', [JobapplicationsController::class, 'status'])
    ->name('jobapplications.status')
    ->middleware('auth');
/*
|-------------------------|
| AUTENTIKÁCIÓS ÚTVONALAK |
|-------------------------|
*/
// A felhasználó bejelentkeztetési űrlapjának megjelenítése.
Route::get('login', [UsersController::class, 'login'])
    ->name('login');
// A felhasználó bejelentkeztetése a szerverre.
Route::post('authenticate', [UsersController::class, 'authenticate'])
    ->name('authenticate');
// A felhasználó kijelentkeztetése a szerverről.
Route::get('logout', [UsersController::class, 'logout'])
    ->middleware('auth');
