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
            <input class="btn btn-success" type="submit" value="Abrir mesa">
        </div>
    </form>

    <hr>
    <h2>Listagem de mesas ativas</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Mesa</th>
                <th scope="col">Status</th>
                <th scope="col">Atendente</th>
                <th scope="col">Produtos</th>
            </tr>
        </thead>
        <tbody>
        {{ $sales }}
            @foreach($sales as $sale)
                <tr>
                    <th>{{ $sale->table }}</th>
                    <td>{{ $sale->status }}</td>
                    <td>{{ $sale['user'][0]['name'] }}</td>
                    <td>{{ $sale->table }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


@stop

@section('js')
    <script src="{{ asset('js/controllers/Product/ProductController.js') }}"></script>
    <script src="{{ asset('js/modules/sales/init.js') }}"></script>
@endsection

