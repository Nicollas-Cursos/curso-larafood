@extends('adminlte::page')

@section('title', "Mesa: {$table->identify}")

@section('content_header')
    <h1 class="mb-2">{{ $table->identify }}</h1>
    @include("admin.includes.alerts")
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Informações do Mesa
        </div>
        <div class="card-body">
            <ul>
                <li>
                    <strong>Identificador:</strong> {{ $table->identify }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $table->description }}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger mb-1">
                    Deletar essa mesa
                </button>
            </form>
        </div>
    </div>
@stop