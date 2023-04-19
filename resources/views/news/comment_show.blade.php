@extends('layouts.front')

@section('title', 'comment_show')
@section('content')
<div class="container">
    <div class="row">
        <p class="h2">コメント一覧</p>
        <div class="col">
            @foreach($comments as $comment)
                <ul clsass="list-group">
                    <li class="list-group-item">{{ $comment->id }}</li>
                    <li class="list-group-item">投稿者: {{ $comment->name }}</li>
                    <li class="list-group-item">コメント内容: {{ $comment->body }}</li>
                    <li class="list-group-item">投稿日時: {{ $comment->created_at}}</li>
                </ul>
            @endforeach
        </div>
    </div>
</div>
@endsection