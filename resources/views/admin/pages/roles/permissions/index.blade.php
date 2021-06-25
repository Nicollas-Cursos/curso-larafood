@extends('adminlte::page')

@section('title', "Permissões do Cargo: {$role->name}")

@section('content_header')
    <div class="card mt-3">
        <div class="card-header">
            <nav aria-label="LaraFood BreadCrumb">
                <ol class="breadcrumb text-dark">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('roles.index') }}">Cargos</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Permissões
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="mb-2">Permissões do Cargo: <b>{{ $role->name }}</b></h1>
    <a href="{{ route('profile.permissions.available', $role->id) }}" class="btn btn-sm btn-success"><i class="fas fa-plus mr-1"></i> Adicionar Permissão</a>
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
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>
                                {{ $permission->name }}
                            </td>
                            <td width="10">
                                <a href="{{ route('role.permission.detach', [$role->id, $permission->id]) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $permissions->appends($filters)->links() !!}
            @else
            {!! $permissions->links() !!}
            @endif
        </div>
    </div>
@stop