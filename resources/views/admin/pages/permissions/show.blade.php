@extends('adminlte::page')

@section('title', "Permissão: {$permission->name}")

@section('content_header')
    <h1 class="mb-2">{{ $permission->name }}</h1>
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
                <button type="submit" class="btn btn-sm btn-danger">
                    Deletar esse perfil
                </button>
            </form>
        </div>
    </div>
@stop