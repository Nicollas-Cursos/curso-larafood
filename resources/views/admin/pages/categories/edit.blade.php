@extends('adminlte::page')

@section('title', "Editar Categoria: {$category->name}")

@section('content_header')
    <h1 class="mb-2">Editando a categoria: <b>{{ $category->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" class="form" method="POST">
                @method('PUT')
                @include('admin.pages.categories._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection