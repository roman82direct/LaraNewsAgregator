@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('news::categories')}}">Все категории</a></li>
                </ol>
            </nav>
        <ul class="categoryNews">
            @foreach($categories as $item)
                <li><a href="category_{{$item->id}}">{{$item->description}}</a></li>
            @endforeach
        </ul>
{{--    <a class="btn btn-primary" href="/public/admin/addcategory">Добавить категорию новостей</a>--}}
        </div>
    </div>
@endsection
