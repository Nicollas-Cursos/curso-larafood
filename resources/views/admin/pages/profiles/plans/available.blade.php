@extends('adminlte::page')

@section('title', "Perfis para o Plano: {$profile->name}")

@section('content_header')
    <div class="card mt-3">
        <div class="card-header">
            <nav aria-label="LaraFood BreadCrumb">
                <ol class="breadcrumb text-dark">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('plans.index') }}">Perfis</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('plans.show', $profile->id) }}">{{ $profile->name }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('profile.plans', $profile->id) }}">Planos</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Vincular planos
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="mb-2">Perfis disponíveis para: <b>{{ $profile->name }}</b></h1>
    @include('admin.includes.alerts')
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('profile.plans.available', $profile->id) }}" method="POST" class="form">
                @csrf
                <div class="row">
                    <div class="col col-11">
                        <div class="form-group">
                            <input type="text" name="filter" placeholder="Pesquise aqui..." class="form-control" value="{{ $filters["filter"] ?? "" }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success py-2" style="font-size: 13px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('profile.plans.attach', $profile->id) }}" method="POST">
                        @csrf
                        @foreach ($plans as $plan)
                            <tr>
                                <td>
                                    <input type="checkbox" id="plan{{ $plan->id }}" name="plans[]" value="{{ $plan->id }}">
                                </td>
                                <td>
                                    <label class="font-weight-normal" role="button" for="plan{{ $plan->id }}">
                                        {{ $plan->name }}
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn float-right btn-sm btn-primary">Vincular</button>
                                </td>
                            </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $plans->appends($filters)->links() !!}
            @else
            {!! $plans->links() !!}
            @endif
        </div>
    </div>
@stop