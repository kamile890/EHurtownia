@extends('welcome')

@section('adminNavbarSection')
    <li class="nav-item">
        <a class="nav-link" href="/dealers">Lista Hurtowników</a>
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
    <li class="nav-item active">
        <a class="nav-link" href="/settings">Ustawienia</a>
    </li>
@endsection

@section('body')

    <form action="/saveSettings">
        <div class="container-fluid form-container">
            <div class="form-group">
                <label>Używana bramka SMS:</label>
                <select class="form-control" name="selectedGateway">
                    <option value="0"> --- </option>
                    @foreach($gateways as $gateway)
                        <option value="{{$gateway->name}}" @if(isset($usedGateway)) @if($usedGateway == $gateway->name) selected @endif @endif>{{$gateway->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Template dla nowego klienta:</label>
                <select class="form-control" name="selectedTemplate">
                    <option value="0"> --- </option>
                    @foreach($templates as $template)

                        <option value="{{$template->name}}" @if(isset($selectedTemplate)) @if($selectedTemplate == $template->name) selected @endif @endif>{{$template->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Etykieta dla nowego klienta:</label>
                <select class="form-control" name="selectedLabel">
                    <option value="0"> --- </option>

                </select>
            </div>
        </div>
        <button type="submit">Zapisz</button>

    </form>

@endsection
