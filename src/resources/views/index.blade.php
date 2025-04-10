@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
  <h2>Contact</h2>
  <!-- フォームの送信先を確認画面に設定し、POSTメソッドを使用 -->
  <form class="form" action="/confirm" method="post" novalidate>
    @csrf
    <div class="form__group">
      <div class="form__group-title">
        <label class="form__label--item" for="last_name">お名前 ※</label>
      </div>
      <div class="form__group-content">
        <!-- oldヘルパーを使用して、以前の入力値を保持 -->
        <input class="form__last_name" type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name', $data['last_name'] ?? '') }}">
        @error('last_name')
        <div class="form__error">{{ $message }}</div>
        @enderror
        <input class="form__first_name" type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name', $data['first_name'] ?? '') }}">
        @error('first_name')
        <div class="form__error">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <label class="form__label--item" for="gender">性別 ※</label>
      </div>
      <div class="form__group-content">
        <input type="radio" id="male" name="gender" value="male" {{ old('gender', $data['gender'] ?? 'male') == 'male' ? 'checked' : '' }}>
        <label for="male">男性</label>
        <input type="radio" id="female" name="gender" value="female" {{ old('gender', $data['gender'] ?? '') == 'female' ? 'checked' : '' }}>
        <label for="female">女性</label>
        <input type="radio" id="other" name="gender" value="other" {{ old('gender', $data['gender'] ?? '') == 'other' ? 'checked' : '' }}>
        <label for="other">その他</label>
        @error('gender')
        <div class="form__error">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <label class="form__label--item" for="email">メールアドレス ※</label>
      </div>
      <div class="form__group-content">
        <input class="email" type="email" name="email" placeholder="例: test@example.com" value="{{ old('email', $data['email'] ?? '') }}">
        @error('email')
        <div class="form__error">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <label class="form__label--item" for="tel">電話番号 ※</label>
      </div>
      <div class="form__group-content">
        <input type="text" id="tel1" name="tel1" placeholder="080" value="{{ old('tel1', $data['tel1'] ?? '') }}">
        -
        <input type="text" id="tel2" name="tel2" placeholder="1234" value="{{ old('tel2', $data['tel2'] ?? '') }}">
        -
        <input type="text" id="tel3" name="tel3" placeholder="5678" value="{{ old('tel3', $data['tel3'] ?? '') }}">
        @error('tel')
        <div class="form__error">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <label class="form__label--item" for="address">住所 ※</label>
      </div>
      <div class="form__group-content">
        <input class="form__address" type="text" name="address" placeholder="例: 東京都渋谷区千駄ケ谷1-2-3" value="{{ old('address', $data['address'] ?? '') }}">
        @error('address')
        <div class="form__error">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <label class="form__label--item" for="building">建物名</label>
      </div>
      <div class="form__group-content">
        <input class="form__building" type="text" name="building" placeholder="例: 千駄ケ谷マンション101" value="{{ old('building', $data['building'] ?? '') }}">
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <label class="form__label--item" for="category_id">お問い合わせの種類 ※</label>
      </div>
      <div class="form__group-content">
        <select id="category_id" name="category_id">
          <option value="">選択してください</option>
          @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id', $data['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
          @endforeach
        </select>
        @error('category_id')
        <div class="form__error">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <label class="form__label--item" for="detail">お問い合わせ内容 ※</label>
      </div>
      <div class="form__group-content">
        <textarea class="form__detail" type="text" placeholder="お問い合わせ内容をご記載ください" name="detail">{{ old('detail', $data['detail'] ?? '') }}</textarea>
        @error('detail')
        <div class="form__error">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="form__button">
      <button class="form__button-submit" type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection