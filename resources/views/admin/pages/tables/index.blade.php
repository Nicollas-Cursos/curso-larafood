@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <div class="card mt-3">
        <div class="card-header">
            <nav aria-label="LaraFood BreadCrumb">
                <ol class="breadcrumb text-dark">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="{{ route('tables.index') }}">Mesas</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="mb-2">Mesas</h1>
    <a href="{{ route('tables.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus mr-1"></i> Adicionar</a>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tables.search') }}" method="POST" class="form">
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
                        <th>Identificador</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tables as $table)
                        <tr>
                            <td>{{ $table->identify }}</td>
                            <td>{{ $table->description }}</td>
                            <td width="150">
                                <a href="{{ route('tables.show', $table->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye mr-1"></i> Ver</a>
                                <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt mr-1"></i> Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $tables->appends($filters)->links() !!}
            @else
            {!! $tables->links() !!}
            @endif
        </div>
    </div>
@stop