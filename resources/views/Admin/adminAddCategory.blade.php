@extends('layouts.app')

@section('title', 'Добавить новость')

{{--@section('header')--}}
{{--    @parent--}}

{{--@endsection--}}

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="" action="{{route('admin::saveCategory')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$model->id ?? ''}}">
                <div class="form-group">
                    <label for="title">Название категории</label>
                    <input type="text" class="form-control" name="title" value="{{$model->title ?? old('title')}}">
                </div>
                <div class="form-group">
                    <label for="discr">Описание категории</label>
                    <input type="text" class="form-control" name="discr" value="{{$model->description ?? old('discr')}}">
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>
        </div>
    </div>
    @endsection
