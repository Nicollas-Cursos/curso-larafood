@extends('adminlte::page')

@section('title', "Cargos para o usuário: {$user->name}")

@section('content_header')
    <div class="card mt-3">
        <div class="card-header">
            <nav aria-label="LaraFood BreadCrumb">
                <ol class="breadcrumb text-dark">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('roles.index') }}">Perfis</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('roles.show', $user->id) }}">{{ $user->name }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.roles', $user->id) }}">Permissões</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Vincular cargos
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="mb-2">Cargos disponíveis para: <b>{{ $user->name }}</b></h1>
    @include('admin.includes.alerts')
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('user.roles.available', $user->id) }}" method="POST" class="form">
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
                        <th width="50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('user.roles.attach', $user->id) }}" method="POST">
                        @csrf
                        @foreach ($roles as $role)
                            <tr>
                                <td>
                                    <input type="checkbox" id="role{{ $role->id }}" name="roles[]" value="{{ $role->id }}">
                                </td>
                                <td>
                                    <label class="font-weight-normal" role="button" for="role{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn float-right btn-sm btn-primary">Vincular</button>
                                </td>
                            </tr>
                    </form>
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