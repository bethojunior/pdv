@extends('layouts.page')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/home/init.css') }}">
@endsection
@section('title', 'Painel ')
@section('content_header')
    <h1 class="m-0 text-dark">
        Caixa
    </h1>
@stop

@section('content')
    @include('includes.alerts')
    <div class="row col-lg-12 card header pt-2 pl-2">
        <label>Filtro</label>

        <form class="row col-lg-12" method="POST" action="{{route('cashier.filter')}}">
            @csrf
            <div class="form-group col-lg-2">
                <span>De</span>
                <input name="start" type="date" class="form-control">
            </div>
            <div class="form-group col-lg-2">
                <span>Até</span>
                <input name="end" type="date" class="form-control">
            </div>
            <div class="form-group col-lg-2">
                <span>Usuários</span>
                <select class="js-example-basic-single col-lg-12" name="user">
                    <option value="">--</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-1">
                <span>&nbsp;</span>
                <input type="submit" class="form-control btn btn-info" value="Pesquisar">
            </div>
        </form>

    </div>

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
                        <button data="{{$value->products}}"  class="btn btn-outline-info show-products">Ver</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal" tabindex="-1" id="modal-products">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Listagem de produtos</h5>
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
                        </tr>
                        </thead>
                        <tbody id="mount-products">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/modules/cashier/init.js') }}"></script>
@endsection

