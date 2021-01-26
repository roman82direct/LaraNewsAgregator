@extends('layouts.base')

@section('title', 'Добавить новость')

@section('header')
    @parent

@endsection

@section('content')
    <p>Редактор новости: id={{$newsId}}</p>
    <form class="" action="{{route('admin::news::editNews')}}" method="POST">
        @csrf
        <div class="form-group">
            <input type="hidden" name="id" value="{{$newsId}}">
            <label for="title">Название новости</label>
            <input type="text" class="form-control" value="{{$title}}" name="title" id="" placeholder="">
        </div>
        <div class="form-group">
            <label for="text">Полный текст новости</label>
            <textarea class="form-control" name="text" id="" rows="10">{{$text}}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
