@extends('welcome')

@section('body')
<div>

    <div>Podsumowanie:</div>

    @foreach($products as $product)
        <div>Nazwa: {{$product['product']['name']}}</div>
        <div>Ilość: {{$product['amount']}}</div>
        <div>Cena: {{$product['price']}} zł</div>

    @endforeach

    <div>Razem: {{$price}} zł</div>
    <form class="order" style="display: none" action="/order">
        <input name="price" value="{{$price}}" type="hidden">
    </form>
    <button onclick="submit('order')">Zamów</button>

</div>

@endsection



