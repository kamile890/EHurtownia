@extends('welcome')

@section('adminNavbarSection')
    <li class="nav-item">
        <a class="nav-link" href="/dealers">Lista Hurtowników</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/clients">Lista Klientów</a>
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
    <li class="nav-item active">
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
            <th>Name</th>
            <th>Kolor</th>
            <th style="text-align: end"><button class="btn btn-primary" data-toggle="modal" data-target="#addLabel"><i class="fa fa-plus"></i> Dodaj Etykiete</button></th>

        </tr>

        </thead>
        <tbody>

        @foreach ($labels as $label)
            <tr>
                <td>{{$label['name']}}</td>
                <td><div class="color" style="background-color: {{$label['color']}}; width: 120px; height: 40px;"></div></td>
                <td style="text-align: end"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a{{$label['id']}}">
                        Edytuj
                    </button>
                    <form class="delete{{$label->name}}" style="display: none" action="/deleteLabel">
                        <input name="name" value="{{$label->name}}" type="hidden">
                    </form>
                    <button onclick="submit('delete{{$label->name}}')">Usuń</button>
                </td>

                <div class="modal fade" id="a{{$label['id']}}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edycja etykiety '{{$label['name']}}'</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="aa{{$label['name']}}" action="/editLabel">
                                    <input type="hidden" class="form-control" name="name" value="{{$label['name']}}" required>
                                    <div class="form-group">
                                        <label for="pwd">Kolor:</label>
                                        <input type="color" value="{{$label['color']}}" name="color"/>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onclick="submit('aa{{$label['name']}}')" data-dismiss="modal">Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="addLabel">
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
                        <form class="addTemplateForm" action="/addLabel">
                            <div class="form-group">
                                <label>Nazwa:</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Kolor:</label>
                                <input type="color" name="color"/>
                            </div>
                        </form>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="submit('addTemplateForm')" data-dismiss="modal">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection





