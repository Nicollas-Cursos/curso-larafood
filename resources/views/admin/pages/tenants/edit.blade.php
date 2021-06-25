@extends('adminlte::page')

@section('title', "Editar Empresa: {$tenant->name}")

@section('content_header')
    <h1 class="mb-2">Editando a empresa: <b>{{ $tenant->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenants.update', $tenant->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.pages.tenants._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection