@extends('adminlte::page')

@section('title', 'Cadastrar nova Empresa')

@section('content_header')
    <h1 class="mb-2">Nova Empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenants.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @include('admin.pages.tenants._partials.form')
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection