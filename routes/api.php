<?php

use App\Http\Controllers\API\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/mahasiswa', MahasiswaController::class);