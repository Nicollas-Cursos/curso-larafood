@extends('adminlte::page')

@section('title', 'Editar Detalhe')

@section('content_header')
    <div class="card mt-3">
        <div class="card-header">
            <nav aria-label="LaraFood BreadCrumb">
                <ol class="breadcrumb text-dark">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('plans.index') }}">Planos</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Editar detalhe
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="mb-2">Editar o detalhe: <b>{{ $detail->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.plan.update', [$plan->url, $detail->id]) }}" class="form" method="POST">
                @include('admin.pages.plans.details._partials.form')
                @method('PUT')
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection