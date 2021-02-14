<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ImprintController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\PrivacyPolicyController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('imprint', [ImprintController::class, 'show'])->name('imprint');
Route::get('privacy-policy', [PrivacyPolicyController::class, 'show'])->name('privacy-policy');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'organisations' => \App\Models\Organisation::query()->notPending()->get(),
        'columns' => ['#', 'name', 'datacenter', 'legal', 'type', 'solution'],
        'headings' => ['Logo', 'Name', 'RZ', 'Legal', 'Type', 'Solution']
    ]);
})->name('welcome');

Route::get('organisations/{organisation:slug}/show', function (\App\Models\Organisation $organisation) {
    return Inertia::render('Organisation/Show', [
        'organisation' => $organisation,
    ]);
})->name('organisation.show');

/** Authenticated routes */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    /** Dashboard */
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            "registredCount" => \App\Models\User::count(),
            "databaseEntryCount" => \App\Models\Organisation::count(),
            "ownOrganisationCount" => auth()->user()->organisations()->count(),
        ]);
    })->name('dashboard');

    Route::get('organization/create', [OrganisationController::class, 'show'])->name('organisation.create');
    Route::post('organization/store', [OrganisationController::class, 'store'])->name('organisation.store');
    Route::delete('organization/{organisation}/destroy', [OrganisationController::class, 'destroy'])->name('organisation.destroy');

    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'show'])->middleware('role:super-admin')->name('admin.index');
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->middleware('permission:user.read')->name('admin.user.index');
            Route::prefix('{user}')->group(function () {
                Route::get('/show', [UserController::class, 'show'])->middleware('permission:user.read')->name('admin.user.show');
                Route::put('/update', [UserController::class, 'update'])->middleware('permission:user.update')->name('admin.user.update');
            });
        });

        Route::prefix('organizations')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\OrganisationController::class, 'index'])->middleware('permission:organisation.read')->name('admin.organisation.index');
            Route::prefix('{organisation}')->group(function () {
                Route::get('/show', [\App\Http\Controllers\Admin\OrganisationController::class, 'show'])->middleware('permission:organisation.read')->name('admin.organisation.show');
                Route::put('/update', [\App\Http\Controllers\Admin\OrganisationController::class, 'update'])->middleware('permission:organisation.update')->name('admin.organisation.update');
            });
        });
    });
});
