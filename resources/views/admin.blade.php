@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Новости</h1>

{{--            <a style="margin-bottom: 10px" class="btn btn-success" href="{{route('admin::news::createNews')}}">Создать</a>--}}


            <div class="list-group">
                @forelse ($news as $item)

                    <div class="list-group-item">
                        <h2>{{$item->title}}</h2>
                        <p>{{$item->text}}</p>
                        <p>Категория новостей: {{\App\Models\NewsCategories::find($item->category_id)->title}}</p>
                        <p>Источник: {{\App\Models\Source::find($item->source_id)->title ?? ''}}</p>
                        <a style="margin-bottom: 10px" class="btn btn-primary" href="{{route('admin::updateNews', ['id' => $item->id])}}">Изменить</a>
                        <a style="margin-bottom: 10px" class="btn btn-danger" href="{{route('admin::deleteNews', ['id' => $item->id])}}">Удалить</a>

                    </div>

                @empty
                    Новостей нет!
                @endforelse
            </div>
            <hr>
            <div class="row justify-content-center">
                {{$news->links()}}
            </div>
        </div>
    </div>
@endsection
