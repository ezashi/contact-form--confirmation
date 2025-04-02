@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Admin</h2>

  <!-- 検索フォーム -->
  <form class="admin-form" action="/admin" method="get">
    <div class="admin-form__group">
      <!-- 名前やメールアドレスを入力するためのテキスト入力フィールド -->
      <input class="admin-form__input" type="text" id="query" name="query" placeholder="名前やメールアドレスを入力してください" value="{{ request('query') }}">
    </div>
    <div class="admin-form__group">
      <!-- 性別を選択するためのドロップダウンメニュー -->
      <label class="admin-form__label" for="gender">性別</label>
      <select class="admin-form__input" id="gender" name="gender">
        <option value="">性別</option>
        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>男性</option>
        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>女性</option>
        <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>その他</option>
      </select>
    </div>
    <div class="admin-form__group">
      <!-- お問い合わせの種類を選択するためのドロップダウンメニュー -->
      <label class="admin-form__label" for="category_id">お問い合わせの種類</label>
      <select class="admin-form__input" id="category_id" name="category_id">
        <option value="">お問い合わせの種類</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="admin-form__group">
      <!-- 日付を入力するためのテキスト入力フィールド -->
      <label class="admin-form__label" for="date">年月日</label>
      <input class="admin-form__input" type="date" id="date" name="date" value="{{ request('date') }}">
    </div>
    <div class="admin-form__button">
      <!-- 検索ボタン -->
      <button type="submit" class="admin-form__button-submit">検索</button>
    </div>
  </form>
  <form class="admin-form" action="/admin" method="get">
    <div class="admin-form__button">
      <!-- リセットボタン -->
      <button type="submit" class="admin-form__button-submit">リセット</button>
    </div>
  </form>
  <form class="admin-form" action="{{ route('admin.export') }}" method="get">
    <div class="admin-form__button">
      <!-- エクスポートボタン -->
      <button type="submit" class="admin-form__button-submit">エクスポート</button>
    </div>
  </form>

  <!-- 検索結果表示 -->
  <table class="admin-table">
    <thead>
      <tr>
        <th>お名前</th>
        <th>性別</th>
        <th>メールアドレス</th>
        <th>お問い合わせの種類</th>
        <th>日付</th>
      </tr>
    </thead>
    <tbody>
      @foreach($contacts as $contact)
      <tr>
        <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
        <td>{{ $contact->gender == 'male' ? '男性' : ($contact->gender == 'female' ? '女性' : 'その他') }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $categories->find($contact->category_id)->name }}</td>
        <td>{{ $contact->created_at->format('Y-m-d') }}</td>
        <td><button class="admin-table__button" wire:click="$emit('showContactDetail', {{ $contact->id }})">詳細</button></td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <!-- ページネーション -->
  {{ $contacts->links() }}
</div>

@endsection