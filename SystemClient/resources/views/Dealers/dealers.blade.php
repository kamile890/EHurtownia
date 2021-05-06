@extends('welcome')

@section('adminNavbarSection')
    <li class="nav-item">
        <a class="nav-link active" href="/dealers">Lista Hurtowników</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Lista Klientów</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Custom Fields</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Kategorie produktów</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Produkty</a>
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
            <th>Email</th>
            <th>Imie</th>
            <th>Nazwisko</th>
            <th>Numer Telefonu</th>
            <th style="text-align: end"><button class="btn btn-primary" data-toggle="modal" data-target="#addDealer"><i class="fa fa-plus"></i> Nowy Hurtownik</button></th>

        </tr>

        </thead>
        <tbody>

        @foreach ($dealers as $dealer)
            <tr>
                <td>{{$dealer['email']}}</td>
                <td>{{$dealer['imie']}}</td>
                <td>{{$dealer['nazwisko']}}</td>
                <td>{{$dealer['numer_telefonu']}}</td>
                <td style="text-align: end"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#b{{$dealer['id']}}">
                        Edytuj
                    </button></td>

                <div class="modal fade" id="b{{$dealer['id']}}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edycja hurtownika {{$dealer['imie']}}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="bb{{$dealer['id']}}" action="/editDealer">
                                    <input type="hidden" class="form-control" name="id" value="{{$dealer['id']}}" required>
                                    <div class="form-group">
                                        <label for="pwd">Imie:</label>
                                        <input type="text" class="form-control" value="{{$dealer['imie']}}" name="imie"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Nazwisko:</label>
                                        <input type="text" class="form-control" value="{{$dealer['nazwisko']}}" name="nazwisko"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Email:</label>
                                        <input type="email" class="form-control" value="{{$dealer['email']}}" name="email"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Numer Telefonu:</label>
                                        <input type="text" class="form-control" value="{{$dealer['numer_telefonu']}}" placeholder="Wprowadź z numerem kierunkowym" name="phone"/>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onclick="submit('bb{{$dealer['id']}}')" data-dismiss="modal">Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="addDealer">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body row">
                    <div class="col-sm-12">
                        <form class="addDealerForm" action="/addDealer">
                            <div class="form-group">
                                <label>Imie:</label>
                                <input type="text" class="form-control" name="imie" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Nazwisko:</label>
                                <input type="text" class="form-control" name="nazwisko"/>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Numer Telefonu:</label>
                                <input type="text" class="form-control" name="phone" placeholder="Wpisz z numerem kierunkowym" required>
                            </div>
                        </form>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="submit('addDealerForm')" data-dismiss="modal">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection





