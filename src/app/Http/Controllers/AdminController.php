<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // クエリビルダーを使用して検索条件を追加
        $query = Contact::query();

        // 名前またはメールアドレスでの検索
        if ($request->filled('query')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->query . '%')
                ->orWhere('last_name', 'like', '%' . $request->query . '%')
                ->orWhere('email', 'like', '%' . $request->query . '%');
            });
        }

        // 性別での検索
        if ($request->filled('gender') && $request->gender != 'all') {
            $query->where('gender', $request->gender);
        }

        // お問い合わせ種類での検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付での検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // ページネーションを使用して7件ごとにデータを表示
        $contacts = $query->paginate(7);
        $categories = Category::all();

        // ユーザーオブジェクトを取得
        $user = Auth::user();

        // ビューにユーザーオブジェクトとカテゴリを渡す
        return view('admin', compact('contacts', 'categories', 'user'));
    }

    public function export(Request $request)
    {
        // クエリビルダーを使用して検索条件を追加
        $query = Contact::query();

        // 名前またはメールアドレスでの検索
        if ($request->filled('query')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->query . '%')
                ->orWhere('last_name', 'like', '%' . $request->query . '%')
                ->orWhere('email', 'like', '%' . $request->query . '%');
            });
        }

        // 性別での検索
        if ($request->filled('gender') && $request->gender != 'all') {
            $query->where('gender', $request->gender);
        }

        // お問い合わせ種類での検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付での検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();
        $categories = Category::pluck('name', 'id')->toArray();  // カテゴリを連想配列に変換

        // CSVデータを生成
        $csvData = "お名前,性別,メールアドレス,お問い合わせの種類,日付\n";
        foreach ($contacts as $contact) {
            $csvData .= "{$contact->first_name} {$contact->last_name},";
            $csvData .= ($contact->gender == 'male' ? '男性' : ($contact->gender == 'female' ? '女性' : 'その他')) . ",";
            $csvData .= "{$contact->email},";
            $csvData .= "{$categories[$contact->category_id]},";
            $csvData .= "{$contact->created_at->format('Y-m-d')}\n";
        }

        // CSVファイルをレスポンスとして返す
        $response = Response::make($csvData, 200);
        $response->header('Content-Type', 'text/csv');
        $response->header('Content-Disposition', 'attachment; filename="contacts.csv"');

        return $response;
    }

    public function show($id)
    {
        // 指定されたIDのコンタクトを取得
        $contact = Contact::find($id);
        $categories = Category::pluck('name', 'id');
        return view('admin', compact('contact', 'categories'));
    }

    public function destroy($id)
    {
        // 指定されたIDのコンタクトを削除
        Contact::destroy($id);
        return redirect()->route('admin');
    }
}