@extends('welcome')

@section('notLoggedClientSection')
    <li class="nav-item">
        <a class="nav-link active" href="/cart">Koszyk</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/registerPage">Register</a>
    </li>
    <li class="nav-item ">
        <a class="nav-link" href="/loginPage">Login</a>
    </li>
@stop

@section('body')
    <div>Koszyk</div>

    @foreach($products as $key=>$product)
        <div class="container-fluid">
            #{{$key + 1}}
            {{$product['product']['name']}}
            <img src="{{ asset('images/' . $product['product']['image_path']) }}" class="rounded" alt="Cinque Terre" width="20%">
            <div>Ilość :  {{$product['amount']}}</div>
            <div>Cena: {{$product['price']}} zł</div>
        </div>


    @endforeach
    <div>Podsumowanie</div>
    <div>Cena: {{$price}} zł</div>


    <a href="/zamow">Złóż zamówienie</a>
@endsection
