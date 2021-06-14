@extends('adminlte::page')

@section('title', "Planos do Perfil: {$profile->name}")

@section('content_header')
    <div class="card mt-3">
        <div class="card-header">
            <nav aria-label="LaraFood BreadCrumb">
                <ol class="breadcrumb text-dark">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('profiles.index') }}">Perfis</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('profiles.show', $profile->id) }}">{{ $profile->name }}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Planos
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="mb-2">Perfis do Plano: <b>{{ $profile->name }}</b></h1>
    <a href="{{ route('profile.plans.available', $profile->id) }}" class="btn btn-sm btn-success"><i class="fas fa-plus mr-1"></i> Adicionar Plano</a>
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
                    @foreach ($plans as $plan)
                        <tr>
                            <td>
                                {{ $plan->name }}
                            </td>
                            <td width="10">
                                <a href="{{ route('profile.plan.detach', [$profile->id, $plan->id]) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $plans->appends($filters)->links() !!}
            @else
            {!! $plans->links() !!}
            @endif
        </div>
    </div>
@stop