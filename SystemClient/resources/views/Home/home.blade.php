@extends('welcome')

@section('body')
    <div class="tab">
                @foreach($categories as $category)
                    <button class="tablinks" onclick="openCity(event, 'aa{{$category['id']}}')">{{$category['name']}}</button>
                @endforeach
    </div>

    @foreach($categories as $category)
        <div id="aa{{$category['id']}}" class="tabcontent" style="display: none">
            <h3>{{$category['name']}}</h3>
            <div class="row">


            @foreach($products as $product)
                @if($product['category_id'] == $category['id'])
                    <div class="item-container col-sm-4">
                        <p class="title-item">{{$product['name']}}</p>
                        <div class="item-img">
                            <img src="{{ asset('images/' . $product['image_path']) }}" class="rounded" alt="Cinque Terre">
                        </div>
                        <p class="price">Cena: {{$product['price']}} zł</p>
                        <form class="add{{$product['id']}}" style="display: none" action="/addToCart">
                            <input name="id" value="{{$product['id']}}" type="hidden">
                        </form>
                        <button class="btn btn-primary" onclick="submit('add{{$product['id']}}')">Dodaj do koszyka</button>

                    </div>
                @endif
            @endforeach
            </div>
        </div>
    @endforeach
@endsection
