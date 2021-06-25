@extends('adminlte::page')

@section('title', "Cargos do Usuário: {$user->name}")

@section('content_header')
    <div class="card mt-3">
        <div class="card-header">
            <nav aria-label="LaraFood BreadCrumb">
                <ol class="breadcrumb text-dark">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('roles.index') }}">Usuários</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('roles.show', $user->id) }}">{{ $user->name }}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Cargos
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="mb-2">Cargos do Cargo: <b>{{ $user->name }}</b></h1>
    <a href="{{ route('user.roles.available', $user->id) }}" class="btn btn-sm btn-success"><i class="fas fa-plus mr-1"></i> Adicionar Cargo</a>
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
                    @foreach ($roles as $role)
                        <tr>
                            <td>
                                {{ $role->name }}
                            </td>
                            <td width="10">
                                <a href="{{ route('user.role.detach', [$user->id, $role->id]) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $roles->appends($filters)->links() !!}
            @else
            {!! $roles->links() !!}
            @endif
        </div>
    </div>
@stop