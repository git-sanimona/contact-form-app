<?php

use Illuminate\Support\Facades\Route;

//ContactController実装後ルート作成
Route::get('/', function () {
    return view('welcome');
});

//仮ルート
Route::middleware('auth')->group(function () {
    Route::get('/admin', fn() => '管理者画面一覧（準備中）')->name('admin.index');
    Route::get('/admin/contacts/{contact}', fn() => 'お問い合わせ詳細（準備中）')->name('admin.contacts.show');
    Route::get('/admin/tags/{tag}/edit', fn() => 'タグ編集ページ（準備中）')->name('admin.tags.edit');
});
