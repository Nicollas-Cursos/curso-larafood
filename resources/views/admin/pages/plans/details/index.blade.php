@extends('adminlte::page')

@section('title', "Detalhes do Plano: {$plan->name}")

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
                    <li class="breadcrumb-item active">
                        Detalhes
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    @include('admin.includes.alerts')
    <h1 class="my-2">Detalhes</h1>
    <a href="{{ route('details.plan.create', $plan->url) }}" class="btn btn-sm btn-success"><i class="fas fa-plus mr-1"></i> Adicionar</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>
                                {{ $detail->name }}
                            </td>
                            <td width="180">
                                <a href="{{ route('details.plan.show', [$plan->url, $detail->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-eye mr-1"></i> Ver</a>
                                <a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt mr-1"></i> Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $details->appends($filters)->links() !!}
            @else
            {!! $details->links() !!}
            @endif
        </div>
    </div>
@stop