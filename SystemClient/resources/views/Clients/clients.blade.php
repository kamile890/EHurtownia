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

@section('hurtownikNavbarSection')
    <li class="nav-item">
        <a class="nav-link active" href="/clients">Lista Klientów</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/products">Produkty</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/orders">Zamówienia</a>
    </li>
@endsection

@section('body')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Imie i nazwisko</th>
            <th>Email</th>
            <th>Etykiety</th>
            <th></th>
        </tr>

        </thead>
        <tbody>

        @foreach ($clients as $client)
            <tr>
                <td>{{$client['imie']}} {{$client['nazwisko']}}</td>
                <td>{{$client['email']}}</td>
                <td class="row">
                    @foreach($client->clientLabels as $label)
                        <div class="col-sm-4" style="padding:5px; height: 20px; width: 50px; background-color: {{$label['color']}}"></div>
                        <div class="col-sm-6">{{$label['name']}}</div>
                        <form class="delete{{$label['name']}}" style="display: none" action="/deleteLabelClient">
                            <input name="label" value="{{$label['id']}}" type="hidden">
                            <input name="client" value="{{$client['id']}}" type="hidden">
                        </form>
                        <button class="col-sm-2" onclick="submit('delete{{$label['name']}}')">Usuń</button>
                    @endforeach
                </td>
                <td style="text-align: end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sms{{$client['id']}}">
                        SMS
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#label{{$client['id']}}">
                        Etykiety
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#custom{{$client['id']}}">
                        Custom Fields
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#b{{$client['id']}}">
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
                                        <label for="pwd">Numer Telefonu:</label>
                                        <input type="text" class="form-control" value="{{$client['numer_telefonu']}}" placeholder="Wprowadź z numerem kierunkowym" name="numer_telefonu"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="pwd">Miasto:</label>
                                        <input type="text" class="form-control" value="{{$client['miasto']}}"  name="miasto"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Kod pocztowy:</label>
                                        <input type="text" class="form-control" value="{{$client['kodpocztowy']}}"  name='kodpocztowy'/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Ulica:</label>
                                        <input type="text" class="form-control" value="{{$client['ulica']}}"  name="ulica"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Numer mieszkania:</label>
                                        <input type="text" class="form-control" value="{{$client['numermieszkania']}}"  name="numermieszkania"/>
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

                <div class="modal fade" id="sms{{$client['id']}}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Wyślij SMS do {{$client['imie']}} {{$client['nazwisko']}}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="ssm{{$client['id']}}" action="/sendToClient">
                                    <input type="hidden" class="form-control" name="id" value="{{$client['id']}}" required>

                                    <select class="form-control" name="template">
                                        @foreach($templates as $template)
                                            <option value="{{$template['id']}}">{{$template['name']}}</option>
                                        @endforeach
                                    </select>

                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onclick="submit('ssm{{$client['id']}}')" data-dismiss="modal">Wyślij</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="label{{$client['id']}}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edycja klienta {{$client['imie']}} {{$client['nazwisko']}}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <form class="llabel{{$client['id']}}" action="/editClientLabel">
                                            <input type="hidden" class="form-control" name="id" value="{{$client['id']}}" required>

                                            <select name="label" class="form-control">
                                                @foreach($client['allLabels'] as $label)
                                                    <option value="{{$label['id']}}">{{$label['name']}}</option>
                                                @endforeach
                                            </select>

                                        </form>
                                        <button style="margin-top: 10px" type="button" class="btn btn-success" onclick="submit('llabel{{$client['id']}}')" data-dismiss="modal">Dodaj</button>

                                    </div>
                                </div>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="custom{{$client['id']}}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edycja klienta {{$client['imie']}} {{$client['nazwisko']}}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <form class="custommfield{{$client['id']}}" action="/editClientCustom">
                                            <input type="hidden" class="form-control" name="id" value="{{$client['id']}}" required>

                                            <select name="custom" class="form-control">
                                                @foreach($client['allCustoms'] as $custom)
                                                    <option value="{{$custom['id']}}">{{$custom['name']}}</option>
                                                @endforeach
                                            </select>

                                        </form>
                                        <button style="margin-top: 10px" type="button" class="btn btn-success" onclick="submit('custommfield{{$client['id']}}')" data-dismiss="modal">Dodaj</button>

                                    </div>
                                </div>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
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





