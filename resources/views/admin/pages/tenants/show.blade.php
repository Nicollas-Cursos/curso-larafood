@extends('adminlte::page')

@section('title', "Empresa: {$tenant->name}")

@section('content_header')
    <h1 class="mb-2">{{ $tenant->name }}</h1>
    @include("admin.includes.alerts")
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Informações da Empresa
        </div>
        <div class="card-body">
            <ul>
                <li>
                    <strong>Plano:</strong> {{ $tenant->plan->name }}
                </li>
                <li>
                    <strong>Nome:</strong> {{ $tenant->name }}
                </li>
                <li>
                    <strong>URL:</strong> {{ $tenant->url }}
                </li>
                <li>
                    <strong>E-mail:</strong> {{ $tenant->email }}
                </li>
                <li>
                    <strong>CNPJ:</strong> {{ $tenant->cnpj }}
                </li>
                <li>
                    <strong>Ativo:</strong> {{ $tenant->active == 'Y' ? 'Sim' : 'Não' }}
                </li>

                <hr>
                    <h3>Assinatura</h3>
                <hr>
                <li>
                    <strong>Data da Assinatura:</strong> {{ $tenant->subscription }}
                </li>
                <li>
                    <strong>Data de Expiração:</strong> {{ $tenant->expires_at }}
                </li>
                <li>
                    <strong>Identificador:</strong> {{ $tenant->subscription_id }}
                </li>
                <li>
                    <strong>Ativo:</strong> {{ $tenant->subscription_active ? 'Sim' : 'Não'}}
                </li>
                <li>
                    <strong>Cancelado:</strong> {{ $tenant->subscription_suspended ? 'Sim' : 'Não' }}
                </li>
            </ul>
        </div>
    </div>
@stop