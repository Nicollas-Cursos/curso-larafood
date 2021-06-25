@extends('adminlte::page')

@section('title', "Cargo: {$role->name}")

@section('content_header')
    <h1 class="mb-2">{{ $role->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Informações do Cargo
        </div>
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $role->name }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $role->description }}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger mb-1">
                    Deletar esse cargo
                </button>
            </form>
            <a href="{{ route('role.permissions', $role->id) }}" class="btn btn-dark btn-sm">Ver permissões desse cargo</a>
        </div>
    </div>
@stop