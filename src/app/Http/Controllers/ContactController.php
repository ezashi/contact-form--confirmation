<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // トップページの表示
    public function index()
    {
        // カテゴリーを全て取得
        $categories = Category::all();
        // トップページのビューを表示し、カテゴリーを渡す
        return view('index', compact('categories'));
    }

    // 確認画面の表示（POSTリクエストを受け付ける）
    public function confirm(ContactRequest $request)
    {
        // リクエストデータを全て取得
        $data = $request->all();
        // カテゴリー名をIDで取得
        $categories = Category::pluck('name', 'id');
        // 確認画面のビューを表示し、データとカテゴリーを渡す
        return view('confirm', compact('data', 'categories'));
    }

    // 編集画面の表示（GETリクエストを受け付ける）
    public function edit(Request $request)
    {
        // リクエストデータを全て取得
        $data = $request->all();
        // カテゴリーを全て取得
        $categories = Category::all();
        // 編集画面のビューを表示し、データとカテゴリーを渡す
        return view('index', compact('data', 'categories'));
    }

    // データの保存（POSTリクエストを受け付ける）
    public function thanks(ContactRequest $request)
    {
        // リクエストデータをバリデーションして保存
        Contact::create($request->validated());
        // サンクスページのビューを表示
        return view('thanks');
    }
}