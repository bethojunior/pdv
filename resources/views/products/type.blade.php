@extends('layouts.page')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/index.css') }}">
@endsection
@section('title', 'Painel ')
@section('content_header')
    <h1 class="m-0 text-dark">
        <span>Categoria Produtos</span>
    </h1>

@stop

@section('content')
    @include('includes.alerts')
    <form class="col-lg-12" method="POST" action="{{route('typeProduct.create')}}">
        @csrf
        <div class="form-group">
            <label>Nome da categoria</label>
            <input name="name" placeholder="Nome da categoria" class="form-control">
        </div>
        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Salvar">
        </div>
    </form>
    <hr>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Categoria</th>
            <th scope="col">Data</th>
        </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
                <tr>
                    <th scope="row">{{ $type->id }}</th>
                    <td>{{ $type->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($type->created_at)->format('d/m/Y')}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('js')
    <script src="{{ asset('js/modules/products/index.js') }}"></script>
@endsection

