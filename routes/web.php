<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EpicorInvoiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// Route::get('/', function () {
//     return view('welcome');
// });

// User Interface Route
Route::get('/logRecord', function () {
    return view('logRecord', ['title' => 'Log History Record']);
});

// Protect the following routes using session checks
Route::middleware('web')->group(function () {

    Route::get('/sendInvoice', function () {
        if (!Session::has('user')) {
            return redirect()->route('login')->withErrors(['You must log in to access this page.']);
        }
        return view('sendInvoice', ['title' => 'Send A/R Invoice']);
    })->name('sendInvoice');

    Route::get('/receiveInvoice', function () {
        if (!Session::has('user')) {
            return redirect()->route('login')->withErrors(['You must log in to access this page.']);
        }
        return view('receiveInvoice', ['title' => 'Receive A/P Invoice']);
    })->name('receiveInvoice');

    Route::get('/sendPO', function () {
        if (!Session::has('user')) {
            return redirect()->route('login')->withErrors(['You must log in to access this page.']);
        }
        return view('sendPO', ['title' => 'Send Purchase Order']);
    })->name('sendPO');

    Route::get('/receivePO', function () {
        if (!Session::has('user')) {
            return redirect()->route('login')->withErrors(['You must log in to access this page.']);
        }
        return view('receivePO', ['title' => 'Receive Purchase Order']);
    })->name('receivePO');

    Route::get('/sendInvoiceResponse', function () {
        if (!Session::has('user')) {
            return redirect()->route('login')->withErrors(['You must log in to access this page.']);
        }
        return view('sendInvoiceResponse', ['title' => 'Send Invoice Response']);
    })->name('sendInvoiceResponse');

    Route::get('/receiveInvoiceResponse', function () {
        if (!Session::has('user')) {
            return redirect()->route('login')->withErrors(['You must log in to access this page.']);
        }
        return view('receiveInvoiceResponse', ['title' => 'Receive Invoice Response']);
    })->name('receiveInvoiceResponse');

});



// External API Call Route
Route::post('/getHeaderAR', [EpicorInvoiceController::class, 'getHeaderAR'])->name('api.get');

Route::get('/get-api', [EpicorInvoiceController::class, 'getApiData'])->name('get-api'); // for testing



//Authentication
// Route for showing the login form
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Route for handling login submissions
Route::post('/', [AuthController::class, 'login'])->name('login.submit');

// Route for logging out
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


