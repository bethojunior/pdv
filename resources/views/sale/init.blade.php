@extends('layouts.page')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/index.css') }}">
@endsection
@section('title', 'Painel ')
@section('content_header')
    <h1 class="m-0 text-dark">
        <span>Vendas</span>
    </h1>

@stop

@section('content')
    @include('includes.alerts')
    <form class="row col-lg-12" method="POST" action="{{route('sales.create')}}">
        @csrf
        <div class="form-group col-lg-1">
            <span>Mesa</span>
            <input required class="form-control" type="number" name="table">
        </div>
        <div class="form-group col-lg-6">
            <span>Produtos</span>
            <select required class="js-example-basic-multiple col-lg-12" name="product_id[]" multiple="multiple">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-lg-12">
            <input class="btn btn-success" type="submit" value="Adcionar">
        </div>
    </form>

    <hr>

    <h2>Listagem de mesas ativas</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Mesa</th>
                <th scope="col">Atendente</th>
                <th scope="col">Aberta</th>
                <th scope="col">Produtos</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr class="table{{$sale->id}}" id="{{ $sale->id }}" products="{{ $sale->products }}">
                    <th>{{ $sale->table }}</th>
                    <td>{{ $sale['user'][0]['name'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('d/m/Y - H:m:s')}}</td>
                    <td>
                        <button data="{{ $sale }}" products="{{ $sale->products }}" id="{{ $sale->id }}" class="btn btn-outline-info show-products">Ver itens</button>
                        <button id="{{ $sale->id }}" class="btn btn-outline-danger closed-table">Encerrar mesa</button>
                    </td>
{{--                    <form method="POST" action="{{route('sales.delete')}}">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button data="{{ $sale }}" products="{{ $sale->products }}" id="{{ $sale->id }}" class="btn btn-outline-info show-products">Ver itens</button>--}}
{{--                        --}}{{--                            <button id="{{ $sale->id }}" class="btn btn-outline-danger closed-table">Encerrar mesa</button>--}}
{{--                        <input class="hide" name="id" value="{{ $sale->id }}">--}}
{{--                        <input class="btn btn-outline-danger" type="submit" value="Encerrar mesa">--}}
{{--                    </form>--}}
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal" tabindex="-1" id="modal-products">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Produtos da mesa <span id="number-table"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody id="mount-products-by-table">
                        </tbody>
                        <tr class="mt-2">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th id="value-total"></th>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
{{--                    <button type="button" class="btn btn-primary">Encerrar mesa</button>--}}
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="{{ asset('js/controllers/Sale/SalesController.js') }}"></script>
    <script src="{{ asset('js/modules/sales/init.js') }}"></script>
@endsection

