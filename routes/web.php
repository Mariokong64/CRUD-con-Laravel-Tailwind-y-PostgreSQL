<?php

use App\Http\Controllers\Controlador;
use Illuminate\Support\Facades\Route;

Route::get('/',[Controlador::class, 'index'])->name('vista.index');
Route::post('/store',[Controlador::class, 'store'])->name('controlador.store');
Route::post('/destroy', [Controlador::class, 'destroy'])->name('controlador.destroy');






