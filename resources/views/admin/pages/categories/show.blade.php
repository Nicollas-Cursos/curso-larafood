@extends('adminlte::page')

@section('title', "Categoria: {$category->name}")

@section('content_header')
    <h1 class="mb-2">{{ $category->name }}</h1>
    @include("admin.includes.alerts")
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Informações do Categoria
        </div>
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $category->name }}
                </li>
                <li>
                    <strong>URL:</strong> {{ $category->url }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $category->description }}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger mb-1">
                    Deletar essa categoria
                </button>
            </form>
        </div>
    </div>
@stop