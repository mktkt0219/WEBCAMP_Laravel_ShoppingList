@extends('layout')

@section('title')(購入済み「買うもの」一覧画面)@endsection

@section('contents')
<h1>購入済み「買うもの」一覧</h1>

<a href="/shopping_list/list">「買うもの」一覧へ戻る</a><br>
<table border="1">
        <th>買うもの名</th>
        <th>購入日</th>
@foreach ($list as $shoppinglist)
        <tr>
            <td>{{ $shoppinglist->name }}</td>
            <td>{{ ($shoppinglist->created_at)->format('Y/m/d') }}</td>
@endforeach
</table>
        {{-- {{ $list->links() }} --}}
        現在 {{ $list->currentPage() }} ページ目<br>
        @if ($list->onFirstPage() === false)
        <a href="/completed_shopping_list/list">最初のページ</a>
        @else
        最初のページ
        @endif
        /
        @if ($list->previousPageUrl() !== null)
            <a href="{{ $list->previousPageUrl() }}">前に戻る</a>
        @else
            前に戻る
        @endif
        /
        @if ($list->nextPageUrl() !== null)
            <a href="{{ $list->nextPageUrl() }}">次に進む</a>
        @else
            次に進む
        @endif
        <br>
<hr>
<a href = "/logout">ログアウト</a>
@endsection