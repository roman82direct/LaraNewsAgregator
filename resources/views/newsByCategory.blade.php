@extends('layouts.app')

@section('title', 'News')


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('news::categories')}}">Все категории: </a></li>
                    @if($id)
                        <li class="breadcrumb-item">
                            <a href="category_{{ $id ?? ''}}">{{\App\Models\NewsCategories::find($id)->title}}</a>
                        </li>
                    @endif
                </ol>
            </nav>

            <div class="list-group">
                    <div class="col-md-12 list-group-item">
                        <h4>{{ \App\Models\NewsCategories::find($id)->title }}</h4>

                        <div class="list-group">
                            @forelse($news as $item)
                                    <div class="col-md-12 list-group-item">
                                        <div class="d-flex justify-content-between newsItem">
                                            <div>
                                                <a href="{{ route('news::newsId', ['id'=>$item->id]) }}">{{$item->title}}</a>
                                                <p>Категория новостей: {{\App\Models\NewsCategories::find($item->category_id)->title}}</p>
                                                <p>Источник: {{\App\Models\Source::find($item->source_id)->title ?? ''}}</p>
                                                <i>Дата публикации: {{$item->created_at ?? 'Нет данных'}}</i>
                                            </div>
                                            <div>
                                                <img style="width: 50px" id="img" class="itemImg" src="{{ $item->img_source }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                <hr>
                            @empty
                                Новостей нет!
                            @endforelse
                                <div class="row justify-content-center">
                                    {{$news->links()}}
                                </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
@endsection
