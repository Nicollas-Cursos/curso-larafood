@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')
    <div class="card mt-3">
        <div class="card-header">
            <nav aria-label="LaraFood BreadCrumb">
                <ol class="breadcrumb text-dark">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="{{ route('roles.index') }}">Cargos</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="mb-2">Cargos</h1>
    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus mr-1"></i> Adicionar</a>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('roles.search') }}" method="POST" class="form">
                @csrf
                <div class="row">
                    <div class="col col-11">
                        <div class="form-group">
                            <input type="text" name="filter" placeholder="Pesquise aqui..." class="form-control" value="{{ $filters["filter"] ?? "" }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success py-2" style="font-size: 13px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
                            <td width="180">
                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye mr-1"></i> Ver</a>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt mr-1"></i> Editar</a>
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