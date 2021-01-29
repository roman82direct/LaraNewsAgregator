@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Пользователи</h1>
            <a style="margin-bottom: 10px" class="btn btn-success" href="{{route('admin::createUser')}}">Создать пользователя</a>
            <div class="list-group">
                @forelse ($users as $item)
                    <div class="list-group-item">
                        <div class="row justify-content-between">
                            <div>
                                <h2>{{$item->name}}</h2>
                                <p>Роль: {{$item->role}}</p>
                                <p>email: {{$item->email}}</p>
                                <p>Дата регистрации: {{$item->created_at ?? ''}}</p>
                                <img src="{{$item->avatar }}" alt="">
                            </div>
                        </div>
                        <a style="margin-bottom: 10px" class="btn btn-primary" href="{{route('admin::updateUser', ['id' => $item->id])}}">Изменить</a>
                        <a style="margin-bottom: 10px" class="btn btn-danger" href="{{route('admin::deleteUser', ['id' => $item->id])}}">Удалить</a>

                    </div>

                @empty
                    Новостей нет!
                @endforelse
            </div>
            <hr>
            <div class="row justify-content-center">
                {{$users->links()}}
            </div>
        </div>
    </div>
@endsection
