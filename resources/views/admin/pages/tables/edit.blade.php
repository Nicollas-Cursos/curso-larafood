@extends('adminlte::page')

@section('title', "Editar Mesa: {$table->name}")

@section('content_header')
    <h1 class="mb-2">Editando a mesa: <b>{{ $table->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id) }}" class="form" method="POST">
                @method('PUT')
                @include('admin.pages.tables._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection