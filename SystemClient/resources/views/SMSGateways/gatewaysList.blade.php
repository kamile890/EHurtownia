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
    <li class="nav-item">
        <a class="nav-link" href="/labels">Etykiety</a>
    </li>
    <li class="nav-item active">
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
        <th>Link</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @foreach ($gatewayList as $gateway)
        <tr>
            <td>{{$gateway['name']}}</td>
            <td><a href="//{{$gateway['link']}}" target="_blank">{{$gateway['link']}}<a></td>
            <td style="text-align: end"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{$gateway['id']}}">
                    Configure
                </button></td>

            <div class="modal fade" id="{{$gateway['id']}}">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">{{$gateway['name']}} Gateway Configuration</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form class="{{$gateway['id']}}" action="/saveConfiguration">
                                <input type="hidden" value="{{$gateway['name']}}" name="gatewayName">
                                @foreach($gateway['configuration'] as $key=>$value)
                                    <div class="form-group">
                                        <label>{{$value['name']}}</label>
                                        <input type="{{$value['type']}}" class="form-control" @if(isset($gateway['configurationValues'][$key]))value="{{$gateway['configurationValues'][$key]}}" @endif name="{{$key}}">
                                    </div>
                                @endforeach
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" onclick="submit('{{$gateway['id']}}')" data-dismiss="modal">Save</button>
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





