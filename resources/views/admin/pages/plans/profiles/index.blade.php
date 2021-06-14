@extends('adminlte::page')

@section('title', "Perfis do Plano: {$plan->name}")

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
                        <a href="{{ route('plans.show', $plan->id) }}">{{ $plan->name }}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Perfis
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="mb-2">Perfis do Plano: <b>{{ $plan->name }}</b></h1>
    <a href="{{ route('plan.profiles.available', $plan->id) }}" class="btn btn-sm btn-success"><i class="fas fa-plus mr-1"></i> Adicionar Perfil</a>
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
                    @foreach ($profiles as $profile)
                        <tr>
                            <td>
                                {{ $profile->name }}
                            </td>
                            <td width="10">
                                <a href="{{ route('plan.profile.detach', [$plan->id, $profile->id]) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $profiles->appends($filters)->links() !!}
            @else
            {!! $profiles->links() !!}
            @endif
        </div>
    </div>
@stop