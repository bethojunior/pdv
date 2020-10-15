@extends('layouts.page')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/home/init.css') }}">
@endsection
@section('title', 'Painel ')
@section('content_header')
    <h1 class="m-0 text-dark">
        Filtro
    </h1>
@stop

@section('content')
    @include('includes.alerts')

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Mesa</th>
            <th scope="col">Data</th>
            <th scope="col">Usuário</th>
            <th scope="col">Valor</th>
            <th scope="col">Produtos</th>
            <th scope="col">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($today as $value)
            <tr>
                <th>{{ $value->table }}</th>
                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d/m/Y H:m:s')}}</td>
                <td>{{ $value['user'][0]['name'] }}</td>
                <td>R$ {{ $value->value }}</td>
                <td>
                    <button class="btn btn-outline-info">Ver</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('js')
    <script src="{{ asset('js/modules/cashier/init.js') }}"></script>
@endsection

