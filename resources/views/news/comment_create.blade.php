@extends('layouts.front')

@section('title', 'comment_create')
@section('content')
<div class="container">
    <div class="row">
        <h2>コメント新規作成</h2>
        <div class="col">
            <form action="{{ route('news.comment.create') }}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group row">
                    <label class="col">名前</label>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="your name" name="name" value="{{ old('name')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col">本文</label>
                    <div class="col">
                        <textarea class="form-control" placeholder="comment" name="body">
                            {{ old('body')}}
                        </textarea>
                    </div>
                </div>
                <input type="hidden" name="news_id" value="{{ $news_id }}">
                @csrf
                <input type="submit" class="btn btn-primary" value="コメントする">
            </form>
        </div>
    </div>
</div>
@endsection