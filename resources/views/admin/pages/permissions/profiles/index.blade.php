@extends('adminlte::page')

@section('title', "Perfis da Permissão: {$permission->name}")

@section('content_header')
    <div class="card mt-3">
        <div class="card-header">
            <nav aria-label="LaraFood BreadCrumb">
                <ol class="breadcrumb text-dark">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('permissions.index') }}">Permissões</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('permissions.show', $permission->id) }}">{{ $permission->name }}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Perfis
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="mb-2">Perfis da Permissão: <b>{{ $permission->name }}</b></h1>
    <a href="{{ route('permission.profiles.available', $permission->id) }}" class="btn btn-sm btn-success"><i class="fas fa-plus mr-1"></i> Adicionar Permissão</a>
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
                                <a href="{{ route('permission.profile.detach', [$permission->id, $profile->id]) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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