@extends('welcome')

@section('script')
    <script>

        $( document ).ready(function() {
            $('input.radio:first').click()
        });

        function selectDelivery(event){

            var value = parseFloat($('input.price').val()) + parseFloat($(event).val())
            console.log(value.toFixed(2))
            $('input.priceAll').attr('value', value.toFixed(2))
            $('div#razem').html('Razem: '+ value.toFixed(2) +' zł')
        }
    </script>
@endsection

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

    <p style="text-align: center; padding-top:10px;">Wybierz rodzaj dostawy</p>
    <div id="delivery">
        @foreach($delivery as $type)
            <div class="radio" style="text-align: center; padding-top:10px;">
                <label><input onclick="selectDelivery(this)" class="radio" type="radio" value="{{$type['price']}}" name="optradio"> {{$type['name']}} ({{$type['price']}} zł)</label>
            </div>
        @endforeach
    </div>
    <div class="podsumowanie">
    <div id="razem">Razem: {{$price}} zł</div>
    <form class="order" style="display: none" action="/order">
        <input class="price" value="{{$price}}" type='hidden'>
        <input class="priceAll" name="price" value="{{$price}}" type="hidden">
    </form>
    <button class="btn btn-primary" onclick="submit('order')">Zamów</button>
    </div>



</div>

@endsection



