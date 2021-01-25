@extends('layouts.app')

@section('title', 'News')


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Все категории</a></li>
        </ol>
    </nav>
    <ul class="categoryNews">
        @foreach($news as $item)
            <li><a href="category_{{$item->category_id}}/item_{{$item->id}}">{{$item->text}}</a></li>
        @endforeach
    </ul>

    <a class="btn btn-primary"  href="#">Добавить новость</a>
@endsection
