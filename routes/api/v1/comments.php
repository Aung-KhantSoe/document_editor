<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::middleware(['auth'])
    ->name('comments.')
    ->group(function () {
    Route::get("/comments", [CommentController::class, 'index'])->name('index');
    Route::get("/comments/{comment}", [CommentController::class, 'show'])->name('show')->whereNumber('comment');
    Route::post("/comments/{comment}", [CommentController::class, 'store'])->name('store');
    Route::patch("/comments/{comment}", [CommentController::class, 'update'])->name('update');
    Route::delete("/comments/{comment}", [CommentController::class, 'destroy'])->name('destroy');
});
