@extends('layouts.page')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/index.css') }}">
@endsection
@section('title', 'Painel ')
@section('content_header')
    <h1 class="m-0 text-dark">
        <span>Produtos</span>
        <button class="btn btn-info" id="add-new-product">
            <i class="fas fa-plus"></i>
        </button>
    </h1>

@stop

@section('content')
    @include('includes.alerts')
    <div class="row col-lg-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Valor</th>
                <th scope="col">Descrição</th>
                <th scope="col">Tipo</th>
                <th scope="col">Criada</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="product{{$product->id}}">
                        <th>{{ $product->name }}</th>
                        <th>R$ {{ $product->value }}</th>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product['type'][0]['name'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}</td>
                        <td id="{{ $product->id }}" class="delete-item">
                            <button class="btn btn-danger">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-archive" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="modal" tabindex="-1" id="modal-add-product">
        <div class="modal-dialog">
            <form method="POST" action="{{route('products.create')}}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Adcionar produtos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div class="form-group">
                            <label>Nome do produto</label>
                            <input required class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Descrição do produto</label>
                            <input required class="form-control" name="description">
                        </div>
                        <div class="form-group">
                            <label for="productType">Tipo do produto</label>
                            <select required name="product_types_id" class="form-control" id="productType">
                                @foreach($productTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Valor do produto</label>
                            <input required id="value-product" class="form-control" name="value">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input  type="submit" class="btn btn-success" value="Salvar">
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/controllers/Product/ProductController.js') }}"></script>
    <script src="{{ asset('js/modules/products/index.js') }}"></script>
@endsection

