<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';

Route::get('/', [JobController::class, 'index'])->name('jobs.index');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{externalId}', [CompanyController::class, 'show'])->name('companies.show');
Route::get('/companies/{companyExternalId}/jobs/{jobExternalId}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');

Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

Route::get('/terms', [LegalController::class, 'terms'])->name('legal.terms');
Route::get('/privacy', [LegalController::class, 'privacy'])->name('legal.privacy');
