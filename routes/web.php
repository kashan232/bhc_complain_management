<?php

use App\Http\Controllers\ComplainRemarkController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Exports\TypeExcel;
use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/home', [ComplaintController::class, 'home'])->middleware('auth')->name('home');
Route::get('/home-chart', [ComplaintController::class, 'homechart'])->name('home-chart');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/all-complaints', [ComplaintController::class, 'all_complaints'])->name('all-complaints');
    Route::get('/not-process-complaints', [ComplaintController::class, 'not_process_complaints'])->name('not-process-complaints');
    Route::get('/in-process-complaints', [ComplaintController::class, 'in_process_complaints'])->name('in-process-complaints');
    Route::get('/closed-complaints', [ComplaintController::class, 'closed_complaints'])->name('closed-complaints');
    Route::get('/Incomplete-complaints', [ComplaintController::class, 'Incomplete_complaints'])->name('Incomplete-complaints');
    Route::get('/view-complaints/{id}/{cnic}', [ComplaintController::class, 'view_complaints'])->name('view-complaints');
    
    Route::get('/all-District', [ComplaintController::class, 'all_District'])->name('all-District');
    Route::get('/all-Talukas', [ComplaintController::class, 'all_Talukas'])->name('all-Talukas');

    Route::post('/action-on-complaint', [ComplainRemarkController::class, 'action_on_complaint'])->name('action-on-complaint');
    
    Route::get('/Reporting-by-date', [ComplaintController::class, 'Reporting_by_date'])->name('Reporting-by-date');
    Route::get('/Reporting-by-filters', [ComplaintController::class, 'Reporting_by_filters'])->name('Reporting-by-filters');
    Route::get('/Reporting-by-districts', [ComplaintController::class, 'Reporting_by_districts'])->name('Reporting-by-districts');
    Route::get('/Reporting-by-search', [ComplaintController::class, 'Reporting_by_search'])->name('Reporting-by-search');
    Route::get('/search-complaints-by-cnic', [ComplaintController::class, 'search_complaints_by_cnic'])->name('search-complaints-by-cnic');
    Route::get('/search-complaints-by-date', [ComplaintController::class, 'search_complaints_by_date'])->name('search-complaints-by-date');
    Route::get('/get-talukas-report', [ComplaintController::class, 'get_talukas_report'])->name('get-talukas-report');
    Route::get('/search-complaints-by-filters', [ComplaintController::class, 'search_complaints_by_filters'])->name('search-complaints-by-filters');
    Route::get('/search-complaints-by-districts', [ComplaintController::class, 'search_complaints_by_districts'])->name('search-complaints-by-districts');
    
    Route::get('/Reporting-by-type', [ComplaintController::class, 'Reporting_by_type'])->name('Reporting-by-type');
    Route::get('/search-complaints-by-type', [ComplaintController::class, 'search_complaints_by_type'])->name('search-complaints-by-type');
    
     Route::get('/type-export-excel', function (Request $request) {

        $nature_of_complaint = $request->input('nature_of_complaint');
        $district = $request->input('district');
        
        return Excel::download(new TypeExcel($nature_of_complaint,  $district), 'reports.xlsx');
        

    })->middleware(['auth', 'verified'])->name('type-export-excel');


    
    Route::get('/form', [ComplaintController::class, 'form'])->name('form');
    Route::get('/complain/form', [ComplaintController::class, 'complain_form'])->name('complain-form');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
