@extends('admin.layout')

@section('contents')
        <h1>管理画面ログイン</h1>
         @if ($errors->any())
            <div>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            </div>
        @endif
        <form action="/admin/login" method="post">
            @csrf
            ログインID：<input name="login_id" value="{{ old('login_id') }}"><br>
            パスワード：<input  name="password" type="password"><br>
            <button>ログインする</button>
        </form>
@endsection