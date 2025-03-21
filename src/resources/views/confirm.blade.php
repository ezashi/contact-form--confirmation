@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="container">
  <h2>Confirm</h2>
  <!-- フォームの送信先をサンクスページに設定し、POSTメソッドを使用 -->
  <form class="confirm-form" action="/thanks" method="post">
    @csrf
    <div class="confirm-form__group">
      <label>お名前</label>
      <p>{{ $data['last_name'] }} {{ $data['first_name'] }}</p>
    </div>
    <div class="confirm-form__group">
      <label>性別</label>
      <p>{{ ($data['gender'] ?? 'male') == 'male' ? '男性' : (($data['gender'] ?? '') == 'female' ? '女性' : 'その他') }}</p>
    </div>
    <div class="confirm-form__group">
      <label>メールアドレス</label>
      <p>{{ $data['email'] }}</p>
    </div>
    <div class="confirm-form__group">
      <label>電話番号</label>
      <p>{{ $data['tel1'] }}-{{ $data['tel2'] }}-{{ $data['tel3'] }}</p>
    </div>
    <div class="confirm-form__group">
      <label>住所</label>
      <p>{{ $data['address'] }}</p>
    </div>
    <div class="confirm-form__group">
      <label>建物名</label>
      <p>{{ $data['building'] }}</p>
    </div>
    <div class="confirm-form__group">
      <label>お問い合わせの種類</label>
      <span>{{ $categories[$data['category_id']] }}</span>
    </div>
    <div class="confirm-form__group">
      <label>お問い合わせ内容</label>
      <p>{{ $data['detail'] }}</p>
    </div>
    <div class="confirm-form__button">
      <button class="confirm-form__button-submit" type="submit">送信</button>
    </div>
  </form>
  <div class="confirm-form__link">
    <!-- 修正リンクを編集画面に設定し、GETメソッドを使用 -->
    <a href="{{ url('/confirm/edit') }}?{{ http_build_query($data) }}" class="confirm-form__button-back">修正</a>
  </div>
</div>
@endsection