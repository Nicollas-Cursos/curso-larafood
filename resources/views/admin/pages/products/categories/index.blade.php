@extends('adminlte::page')

@section('title', "Perfis do Plano: {$product->title}")

@section('content_header')
    <div class="card mt-3">
        <div class="card-header">
            <nav aria-label="LaraFood BreadCrumb">
                <ol class="breadcrumb text-dark">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('products.index') }}">Produtos</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('products.show', $product->id) }}">{{ $product->title }}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Categorias
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="mb-2">Categorias do Produto: <b>{{ $product->title }}</b></h1>
    <a href="{{ route('product.categories.available', $product->id) }}" class="btn btn-sm btn-success"><i class="fas fa-plus mr-1"></i> Adicionar Categoria</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td width="10">
                                <a href="{{ route('product.category.detach', [$product->id, $category->id]) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $categories->appends($filters)->links() !!}
            @else
            {!! $categories->links() !!}
            @endif
        </div>
    </div>
@stop