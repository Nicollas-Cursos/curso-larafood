@extends('adminlte::page')

@section('title', "Editar Usuário: {$user->name}")

@section('content_header')
    <h1 class="mb-2">Editando o usuário: <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" class="form" method="POST">
                @method('PUT')
                @include('admin.pages.users._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection