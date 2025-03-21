<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;

// トップページのルート
Route::get('/', [ContactController::class, 'index']);

// 確認画面へのルート（POSTメソッド）
Route::post('/confirm', [ContactController::class, 'confirm']);

// 編集画面へのルート（GETメソッド）
Route::get('/confirm/edit', [ContactController::class, 'edit']);

// 送信後のサンクスページへのルート（POSTメソッド）
Route::post('/thanks', [ContactController::class, 'thanks'])->name('thanks');

// ユーザー登録関連のルート
Route::get('/register', [RegisterController::class, 'register']);
Route::post('/register', [RegisterController::class, 'store']);

// ログイン関連のルート
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

// 管理者ページ関連のルート
Route::get('/admin', [AdminController::class, 'index'])->middleware('auth')->name('admin');
Route::get('/admin/{id}', [AdminController::class, 'show'])->middleware('auth');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->middleware('auth')->name('admin.destroy');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');