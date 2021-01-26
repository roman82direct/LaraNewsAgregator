@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('news::categories')}}">Все категории</a></li>
                    @if($id)
                        <li class="breadcrumb-item"><a href="category_{{ $newsItem->category_id ?? ''}}">
                                {{\App\Models\NewsCategories::find($id)->title}}
                            </a>
                        </li>
                        <li class="breadcrumb-item">{{ $newsItem->title }}</li>
                    @endif
                </ol>
            </nav>

            <div class="col-md-4">
                <H3>{{ $newsItem->title }}</H3>
                <p>{{ $newsItem->text }}</p><hr>
                <p>Источник: {{\App\Models\Source::find($newsItem->source_id)->title ?? 'Нет данных'}}</p>

            </div>

{{--    <a class="btn btn-primary" href="/public/admin/addcategory">Добавить категорию новостей</a>--}}
        </div>
    </div>
@endsection

