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
            <ul class="categoryNews">
                @foreach($news as $item)
                    <li><a href="{{ route('news::newsId', ['id'=>$item->id]) }}">{{$item->title}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
