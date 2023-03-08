@extends('layouts.admin')
@section('title', '登録済みニュースの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ニュース一覧</h2>
            <h2>{{ $hoge }}</h2>
            <h2> 1 + 1 </h2>
            <h2>{{ 1 + 1 }}</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.news.add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('admin.news.index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="50%">本文</th>
                                <tn width="10%">操作</tn>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($huga as $news)
                                <tr>
                                    <th>{{ $news->id }}</th>
                                    <td>{{ Str::limit($news->title, 100) }}</td>
                                    <td>{{ Str::limit($news->body, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.news.edit', ['id' => $news->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.news.delete', ['id' => $news->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection