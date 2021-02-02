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
            <a style="margin-bottom: 10px" class="btn btn-success" href="{{route('admin::createNews')}}">Создать новость</a>
            <a style="margin-bottom: 10px" class="btn btn-primary" href="{{ route('admin::createCategory') }}">Создать категорию новостей</a>
            <a style="margin-bottom: 10px" class="btn btn-success" href="{{ route('admin::deleteAllNews') }}">Удалить все новости</a>
            <a style="margin-bottom: 10px" class="btn btn-primary" href="{{ route('admin::loadYandexNews') }}">Загрузить с Yandex</a>

            <div class="list-group">
                @forelse ($news as $item)
                    <div class="col-md-12 list-group-item">
                        <div class="d-flex justify-content-between newsItem">
                            <div>
                                <h2>{{$item->title}}</h2>
                                <p>{{$item->text}}</p>
                                <p>Категория новостей: {{\App\Models\NewsCategories::find($item->category_id)->title}}</p>
                                <p>Источник: {{\App\Models\Source::find($item->source_id)->title ?? ''}}</p>
                                <i>Дата публикации: {{$item->created_at ?? 'Нет данных'}}</i>
                                <p>Происхождение: {{ $item->build }}</p>
                            </div>
                            <div>
                                <img id="img" class="itemImg" src="{{ $item->img_source }}" alt="">
                            </div>
                        </div>
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
