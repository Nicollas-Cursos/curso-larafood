@extends('adminlte::page')

@section('title', "Permissão: {$permission->name}")

@section('content_header')
    <h1 class="mb-2">Permissão: <b>{{ $permission->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Informações da Permissão
        </div>
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $permission->name }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $permission->description }}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger mb-1">
                    Deletar essa permissão
                </button>
            </form>
            <a href="{{ route('permission.profiles', $permission->id) }}" class="btn btn-sm btn-dark">Ver perfis dessa permissão</a>
        </div>
    </div>
@stop