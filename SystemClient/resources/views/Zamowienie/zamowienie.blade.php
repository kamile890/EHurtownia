@extends('welcome')

@section('body')
<div>

    <h1 style="text-align: center; padding-top:10px;">Podsumowanie</h1>
        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-12" align="center" style="margin: 10px 0 10px 0; border: 1px solid black; border-radius: 10px;">
                    <div>Nazwa: {{$product['product']['name']}}</div>
                    <div>Ilość: {{$product['amount']}}</div>
                    <div>Cena: {{$product['price']}} zł</div>
                </div>


            @endforeach
        </div>

    <div class="podsumowanie">
    <div>Razem: {{$price}} zł</div>
    <form class="order" style="display: none" action="/order">
        <input name="price" value="{{$price}}" type="hidden">
    </form>

    <button class="btn btn-primary" onclick="submit('order')">Zamów</button>
    </div>



</div>

@endsection



