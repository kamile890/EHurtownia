@extends('welcome')

@section('adminNavbarSection')
    <li class="nav-item">
        <a class="nav-link" href="#">Lista Hurtowników</a>
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
        <a class="nav-link" href="#">Etykiety</a>
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
                <select class="form-control" name="gateway">
                    @foreach($gateways as $gateway)
                        <option value="{{$gateway->name}}">{{$gateway->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit">Zapisz</button>

    </form>

@endsection
