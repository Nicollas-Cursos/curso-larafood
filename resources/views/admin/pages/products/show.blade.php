@extends('adminlte::page')

@section('title', "Produto: {$product->title}")

@section('content_header')
    <h1 class="mb-2">{{ $product->title }}</h1>
    @include("admin.includes.alerts")
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Informações do Produto
        </div>
        <div class="card-body">
            <ul>
                <li>
                    <strong>Título:</strong> {{ $product->title }}
                </li>
                <li>
                    <strong>URL:</strong> {{ $product->url }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $product->description }}
                </li>
                <li>
                    <strong>Imagem:</strong> <img width="150" src="{{ asset("storage/{$product->image}") }}" class="d-block" alt="{{ $product->title }}">
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger mb-1">
                    Deletar esse produto
                </button>
            </form>
        </div>
    </div>
@stop