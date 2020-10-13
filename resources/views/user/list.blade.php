@extends('layouts.page')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/index.css') }}">
@endsection
@section('title', 'Painel ')
@section('content_header')
    <h1 class="m-0 text-dark">
        <span>Usuários</span>
        <button class="btn btn-info" id="add-new-user">
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
                <th scope="col">Fone</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Tipo</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
{{--                {{ dd($user) }}--}}
                <tr class="user{{$user->id}}">
                    <th>{{ $user->name }}</th>
                    <th>{{ $user->phone }}</th>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->userStatus->name }}</td>
                    <td>{{ $user->userType->name }}</td>
                    <td id="{{ $user->id }}" class="delete-user">
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

    <div class="modal" tabindex="-1" id="modal-add-user">
        <div class="modal-dialog">
            <form method="POST" action="{{route('user.insert')}}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Adcionar produtos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>Fone</label>
                        <input class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="user_type_id">Tipo do produto</label>
                        <select name="user_type_id" class="form-control" id="user_type_id">
                            <option value="{{ \App\Constants\UserConstant::ADMIN }}">Admin</option>
                            <option value="{{ \App\Constants\UserConstant::SALES }}">Vendedor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Senha</label>
                        <input class="form-control" name="password">
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
    <script src="{{ asset('js/controllers/User/UserController.js') }}"></script>
    <script src="{{ asset('js/modules/user/index.js') }}"></script>
@endsection

