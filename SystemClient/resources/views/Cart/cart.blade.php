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

@section('clientSection')
    <li class="nav-item">
        <a class="nav-link" href="/">Produkty</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/orders">Zamówienia</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/cart">Koszyk</a>
    </li>
@endsection

@section('body')
    <h2 style="text-align: center; padding-top: 15px;">Koszyk</h2>
<div class="row">
    @foreach($products as $key=>$product)
        <div class="col-sm-6" align="center">

            <div class="items" style="justify-content: center">
                #{{$key + 1}}
                {{$product['product']['name']}}
                <div class="item-img">
                    <img src="{{ asset('images/' . $product['product']['image_path']) }}" class="rounded" alt="Cinque Terre" width="20%">
                </div>

                <div>Ilość :  {{$product['amount']}}</div>
                <div>Cena: {{$product['price']}} zł</div>
            </div>

        </div>
    @endforeach

</div>

        <div class="podsumowanie">
            <div>Podsumowanie</div>
            <div>Cena: {{$price}} zł</div>
            <a class="btn btn-primary" href="/zamow">Złóż zamówienie</a>
        </div>


    @endsection


