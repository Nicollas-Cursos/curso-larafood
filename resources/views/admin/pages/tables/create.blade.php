@extends('adminlte::page')

@section('title', 'Cadastrar nova Mesa')

@section('content_header')
    <h1 class="mb-2">Nova Mesa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.store') }}" class="form" method="POST">
                @include('admin.pages.tables._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection