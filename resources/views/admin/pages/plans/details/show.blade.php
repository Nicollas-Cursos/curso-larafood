@extends('adminlte::page')

@section('title', "Detalhe: {$detail->name}")

@section('content_header')
    <h1 class="mb-2">{{ $detail->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Informações do Detalhe
        </div>
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $detail->name }}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('details.plan.destroy', [$plan->url, $detail->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger mb-1">
                    Deletar esse detalhe
                </button>
            </form>
        </div>
    </div>
@stop