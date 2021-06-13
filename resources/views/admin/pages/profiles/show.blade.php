@extends('adminlte::page')

@section('title', "Perfil: {$profile->name}")

@section('content_header')
    <h1 class="mb-2">{{ $profile->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Informações do Perfil
        </div>
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $profile->name }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $profile->description }}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger mb-1">
                    Deletar esse perfil
                </button>
            </form>
            <a href="{{ route('profile.permissions', $profile->id) }}" class="btn btn-dark btn-sm">Ver permissões desse perfil</a>
        </div>
    </div>
@stop