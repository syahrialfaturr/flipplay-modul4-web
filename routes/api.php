<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\MemberCollectionController;

// CRUD Media
Route::apiResource('media', MediaController::class)
    ->parameters(['media' => 'media']);

// CRUD Member
Route::apiResource('members', MemberController::class);

// Pengelolaan koleksi Member
Route::get(
    '/members/{member}/collection',
    [MemberCollectionController::class, 'index']
);

Route::post(
    '/members/{member}/collection/{media}',
    [MemberCollectionController::class, 'store']
);

Route::delete(
    '/members/{member}/collection/{media}',
    [MemberCollectionController::class, 'destroy']
);
