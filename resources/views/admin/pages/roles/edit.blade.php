@extends('adminlte::page')

@section('title', "Editar Cargo: {$role->name}")

@section('content_header')
    <h1 class="mb-2">Editando o cargo: <b>{{ $role->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" class="form" method="POST">
                @method('PUT')
                @include('admin.pages.roles._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection