@extends('adminlte::page')

@section('title', "Perfis para o Plano: {$plan->name}")

@section('content_header')
    <div class="card mt-3">
        <div class="card-header">
            <nav aria-label="LaraFood BreadCrumb">
                <ol class="breadcrumb text-dark">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('plans.index') }}">Planos</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('plans.show', $plan->id) }}">{{ $plan->name }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('plan.profiles', $plan->id) }}">Perfis</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Vincular perfis
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="mb-2">Perfis disponíveis para: <b>{{ $plan->name }}</b></h1>
    @include('admin.includes.alerts')
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('plan.profiles.available', $plan->id) }}" method="POST" class="form">
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
                    <form action="{{ route('plan.profiles.attach', $plan->id) }}" method="POST">
                        @csrf
                        @foreach ($profiles as $profile)
                            <tr>
                                <td>
                                    <input type="checkbox" id="profile{{ $profile->id }}" name="profiles[]" value="{{ $profile->id }}">
                                </td>
                                <td>
                                    <label class="font-weight-normal" role="button" for="profile{{ $profile->id }}">
                                        {{ $profile->name }}
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
            {!! $profiles->appends($filters)->links() !!}
            @else
            {!! $profiles->links() !!}
            @endif
        </div>
    </div>
@stop