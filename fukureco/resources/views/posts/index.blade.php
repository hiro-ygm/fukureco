@extends('layouts.app')

@section('content')
<div class="container">
    <h1><a href="{{ route('posts.index') }}">投稿一覧</a></h1>
    <hr>
    <a href="{{ route('posts.index') }}" class="float-right">全件表示</a>
    <!--↓↓ 検索フォーム ↓↓-->
    <div class="col-sm-4" style="padding:20px 0; padding-left:0px;">
        <form class="form-inline" action="{{url('/posts')}}">
            <div class="form-group">
                <select name="keyword" class="form-control">
                    <option value="" selected="selected">選択してください</option>
                    <option value="1">日曜日</option>
                    <option value="2">月曜日</option>
                    <option value="3">火曜日</option>
                    <option value="4">水曜日</option>
                    <option value="5">木曜日</option>
                    <option value="6">金曜日</option>
                    <option value="0">土曜日</option>
                </select>
            </div>
            <input type="submit" value="検索" class="btn btn-info">
        </form>
    </div>
    <!--↑↑ 検索フォーム ↑↑-->
    <h2>新規投稿</h2>
    @if(Auth::check())
    @if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error )
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{Form::open(['url' => '/posts', 'files' => true],['class'=>'form-group'])}}
    {{Form::file('image')}}
    {{Form::text('hash_tags', '',['class'=>'form-control','placeholder' => 'ハッシュタグを入力 ※複数の場合は半角スペース区切り'])}}
    {{Form::submit('送信', ['class'=>'submit'])}}
    {{Form::close()}}
    @endif
    <div id="accordion" role="tablist">
        <div class="card">
            <div class="card-header" role="tab" id="headingOne">
                <p>タグ一覧</p>
                @foreach($posts as $post)
                @foreach($post->hashTags as $hash_tag)
                <a href="{{ route('hash_tags.posts', ['id' => $hash_tag->id]) }}" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <span class="btn btn-sm mt-1 btn-info">
                        <i class=" fas fa-tags" aria-hidden="true"></i>{{ $hash_tag->name }}
                    </span>
                </a>
                @endforeach
                @endforeach

            </div>
        </div>
    </div>
    <br>
    @if(Session::has('flash_message'))
    <div class="alert-success">
        {{ Session::get('flash_message') }}
    </div>
    @endif
    <table class="table table-responsive">
        <tr class="">
            <th class="">登録日</th>
            <th class="">投稿者</th>
            <th class="">画像</th>
            <th class="d-none d-lg-block">タグ</th>
            <th class=""></th>
        </tr>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->updated_at->format("Y/m/d (D) H:i:s") }}</td>
            <td>{{ $post->user->name }}</td>
            <td>
                <img src="/storage/{{ $post->image }}" alt="画像" class="w-100">
            </td>
            <td>
                @if(count($post->hashTags) > 0)
                <ul class="list-inline">
                    @foreach($post->hashTags as $hash_tag)
                    <li>
                        <a href="{{ route('hash_tags.posts', ['id' => $hash_tag->id]) }}">
                            <span class="btn btn-sm mt-1 btn-info d-none d-lg-block">
                                <i class=" fas fa-tags" aria-hidden="true"></i>{{ $hash_tag->name }}
                            </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </td>
            <td>
                <a href="/posts/{{ $post->id }}"><button type="button" class="btn btn-success">詳細</button></a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection