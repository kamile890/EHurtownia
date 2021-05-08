@extends('welcome')

@section('adminNavbarSection')
    <li class="nav-item">
        <a class="nav-link" href="/dealers">Lista Hurtowników</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/clients">Lista Klientów</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/customFields">Custom Fields</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/categories">Kategorie produktów</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/products">Produkty</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/labels">Etykiety</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/gateways">Bramki SMS</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/templatesList">Szablony SMS</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/settings">Ustawienia</a>
    </li>
@endsection

@section('body')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Imie i nazwisko</th>
            <th>Email</th>
        </tr>

        </thead>
        <tbody>

        @foreach ($clients as $client)
            <tr>
                <td>{{$client['imie']}} {{$client['nazwisko']}}</td>
                <td>{{$client['email']}}</td>
                <td style="text-align: end"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#b{{$client['id']}}">
                        Edytuj
                    </button></td>
                <div class="modal fade" id="b{{$client['id']}}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edycja klienta {{$client['imie']}} {{$client['nazwisko']}}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="bb{{$client['id']}}" action="/editClient">
                                    <input type="hidden" class="form-control" name="id" value="{{$client['id']}}" required>
                                    <div class="form-group">
                                        <label for="pwd">Imie:</label>
                                        <input type="text" class="form-control" value="{{$client['imie']}}" name="imie"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Nazwisko:</label>
                                        <input type="text" class="form-control" value="{{$client['nazwisko']}}" name="nazwisko"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Email:</label>
                                        <input type="email" class="form-control" value="{{$client['email']}}" name="email"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Numer Telefonu:</label>
                                        <input type="text" class="form-control" value="{{$client['numer_telefonu']}}" placeholder="Wprowadź z numerem kierunkowym" name="phone"/>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onclick="submit('bb{{$client['id']}}')" data-dismiss="modal">Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection





