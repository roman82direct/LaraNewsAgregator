@extends('layouts.app')

@section('title', 'Добавить новость')


@section('title')
    Админка новости
@endsection


@section('content')
    <div class="row justify-content-center">

        <div class="col-md-6">
            {{--        @if ($errors->any())--}}
            {{--            <div class="alert alert-danger">--}}
            {{--                <ul>--}}
            {{--                    @foreach ($errors->all() as $error)--}}
            {{--                        <li>{{ $error }}</li>--}}
            {{--                    @endforeach--}}
            {{--                </ul>--}}
            {{--            </div>--}}
            {{--        @endif--}}
        @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1>Новость</h1>

            <form class="" action="{{route('admin::saveNews')}}" method="POST">
                @csrf
                    <input type="hidden" name="id" value="{{$model->id ?? ''}}">
                <div class="form-group">
                    <label for="title">Название новости</label>
                    <input type="text" class="form-control" name="title" value="{{$model->title ?? old('title')}}">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Выберите категорию новостей</label>
                    <select class="form-control" name="category" aria-label="category">
                        <option selected>{{\App\Models\NewsCategories::find($model->category_id)->title ?? 'Нажмите для выбора'}}</option>
                        @foreach($categories as $id=>$value)
                            <option> {{$value}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="text">Полный текст новости</label>
                    <textarea class="form-control" name="text" id="" rows="10">{{$model->text ?? ''}}</textarea>
                    @error('text')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Источник новости</label>
                    <input type="text" class="form-control" name="source" value="{{\App\Models\Source::find($model->source_id)->title ?? ''}}" placeholder="">
                </div>

                <button type="submit" class="btn btn-primary">Опубликовать</button>
            </form>

        </div>
    </div>
@endsection

