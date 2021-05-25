@extends('layouts.app')

@section('content')

<body>
    <div class="container">
        <h1>投稿詳細</h1>
        <table class="table">
            <tr>
                <th>日付</th>
                <th>投稿者</th>
                <th>画像</th>
                <th>タグ</th>
                <th></th>
            </tr>
            <tr>
                <td>{{ $post->updated_at }}</td>
                <td>young</td>
                <td>
                    <img src="/storage/{{$post->image}}" alt="画像">
                </td>
                <td>
                    @if(count($post->hashTags) > 0)
                    <ul class="list-inline">
                        @foreach($post->hashTags as $hash_tag)
                        <li>
                            <a href="">
                                <span class="btn btn-sm mt-1 btn-info">
                                    <i class=" fas fa-tags" aria-hidden="true"></i>{{ $hash_tag->name }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </td>
                <td>
                    @if(Auth::check())
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"><button type="button" class="btn btn-info">変更</button></a>
                    {{Form::open([ route('posts.destroy', ['post' => $post->id ]) , 'files' => true])}}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('削除', ['class'=>'submit btn btn-danger'])}}
                    {{Form::close()}}
                    @endif
                </td>
            </tr>
        </table>
        <a href="/posts">投稿一覧に戻る</a>
    </div>
    @endsection