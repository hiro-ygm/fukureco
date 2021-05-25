@extends('layouts.app')

@section('content')
<div class="container">
    <h1>投稿の更新</h1>
    <hr>
    {{ Form::open([ 'route' => ['posts.update', $post->id ], 'files' => true]) }}
    {{ Form::hidden('_method','PUT') }}
    {{ Form::file('image') }}
    {{ Form::text('hash_tags', '' ,['class' => 'form-control']) }}
    {{ Form::submit('アップロード', ['class'=>'submit']) }}
    {{ Form::close() }}

    @if(count($post->hashTags) > 0)
    @foreach($post->hashTags as $hash_tag)
    <span class="btn btn-sm mt-1 btn-info">
        <i class=" fas fa-tags" aria-hidden="true"></i>{{ $hash_tag->name }}
    </span>
    @endforeach
    </ul>
    @endif

    <br>
    <img src="/storage/{{$post->image}}" alt="画像">
    <br>

    <a href="/posts">投稿一覧に戻る</a>
</div>
@endsection