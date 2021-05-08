@extends('welcome')

@section('adminNavbarSection')
    <li class="nav-item">
        <a class="nav-link" href="/dealers">Lista Hurtowników</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/clients">Lista Klientów</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/customFields">Custom Fields</a>
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
            <th>Nazwa</th>
            <th style="text-align: end"><button class="btn btn-primary" data-toggle="modal" data-target="#addCustom"><i class="fa fa-plus"></i> Dodaj Custom Field</button></th>

        </tr>

        </thead>
        <tbody>

        @foreach ($customs as $field)
            <tr>
                <td>{{$field['name']}}</td>
                <td style="text-align: end"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a{{$field['name']}}">
                        Edytuj
                    </button></td>

                <div class="modal fade" id="a{{$field['name']}}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edycja Custom Field '{{$field['name']}}'</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="aa{{$field['name']}}" action="/editCustom">
                                    <input type="hidden" class="form-control" name="id" value="{{$field['id']}}" required>
                                    <div class="form-group">
                                        <label for="pwd">Nazwa:</label>
                                        <input type="text" class="form-control" value="{{$field['name']}}" name="name"/>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onclick="submit('aa{{$field['name']}}')" data-dismiss="modal">Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="addCustom">
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
                        <form class="addCustomForm" action="/addCustom">
                            <div class="form-group">
                                <label>Nazwa:</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </form>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="submit('addCustomForm')" data-dismiss="modal">Dodaj</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection





