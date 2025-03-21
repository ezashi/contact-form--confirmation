@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="thanks-message">お問い合わせありがとうございました。</h1>
    <a class="thanks-button" href="/">HOME</a>
</div>
@endsection