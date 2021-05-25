@extends('layouts.default')

@section('content')
    <div class="container">
        <h1>投稿の編集</h1>
        {{Form::open(['url' => '/posts', 'files' => true])}}
        {{Form::file('image')}}
        {{Form::submit('送信', ['class'=>'submit'])}}
        {{Form::close()}}
        <a href="/posts">投稿一覧に戻る</a>
    </div>
@endsection

</html>
