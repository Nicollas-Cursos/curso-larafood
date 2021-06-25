@extends('adminlte::page')

@section('title', 'Cadastrar novo Cargo')

@section('content_header')
    <h1 class="mb-2">Novo Cargo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.store') }}" class="form" method="POST">
                @include('admin.pages.roles._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection