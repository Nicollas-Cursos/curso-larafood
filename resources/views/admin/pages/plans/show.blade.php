@extends('adminlte::page')

@section('title', "Plano: {$plan->name}")

@section('content_header')
    <h1 class="mb-2">{{ $plan->name }}</h1>
    @include("admin.includes.alerts")
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Informações do Plano
        </div>
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $plan->name }}
                </li>
                <li>
                    <strong>URL:</strong> {{ $plan->url }}
                </li>
                <li>
                    <strong>Preço:</strong> R$ {{ number_format($plan->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $plan->description }}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('plans.destroy', $plan->url) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger mb-1">
                    Deletar esse plano
                </button>
            </form>
            <a href="{{ route('plan.profiles', $plan->id) }}" class="btn btn-sm btn-dark">Ver perfis deste plano</a>
            <a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-sm btn-dark">Ver detalhes deste plano</a>
        </div>
    </div>
@stop