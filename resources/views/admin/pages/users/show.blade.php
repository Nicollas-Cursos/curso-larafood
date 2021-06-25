@extends('adminlte::page')

@section('title', "Usuário: {$user->name}")

@section('content_header')
    <h1 class="mb-2">{{ $user->name }}</h1>
    @include("admin.includes.alerts")
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Informações do Usuário
        </div>
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $user->name }}
                </li>
                <li>
                    <strong>Email:</strong> {{ $user->email }}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    Deletar esse usuário
                </button>
                <a href="{{ route('user.roles', $user->id) }}" class="btn btn-dark btn-sm">Ver cargos desse usuário</a>
            </form>
        </div>
    </div>
@stop