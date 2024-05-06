<?php

use App\Http\Controllers\WebAnalysisController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[WebAnalysisController::class,'analyze']);
