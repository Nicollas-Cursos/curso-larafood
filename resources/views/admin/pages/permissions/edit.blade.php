@extends('adminlte::page')

@section('title', "Editar Permissão: {$permission->name}")

@section('content_header')
    <h1 class="mb-2">Editando a permissão: <b>{{ $permission->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" class="form" method="POST">
                @method('PUT')
                @include('admin.pages.permissions._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection