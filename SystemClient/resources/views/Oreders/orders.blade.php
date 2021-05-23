@extends('welcome')



@section('clientSection')
    <li class="nav-item">
        <a class="nav-link" href="/">Produkty</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/orders">Zamówienia</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/cart">Koszyk</a>
    </li>
@endsection

@section('hurtownikNavbarSection')
    {{-- sekcja hurtownika --}}
    <li class="nav-item">
        <a class="nav-link" href="/products">Produkty</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/orders">Zamówienia</a>
    </li>
@endsection

@section('body')

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Numer zamówienia</th>
            <th>Kwota</th>
            <th>Zrealizowano</th>
            <th>Data złożenia</th>
            @if($role == 'Hurtownik')
                <th>Realizuj</th>
            @endif

        </tr>

        </thead>
        <tbody>

        @foreach ($orders as $order)
            <tr>
                <td>{{$order['order_number']}}</td>
                <td>{{$order['price']}} zł</td>
                <td>{{$order['realized']}}</td>
                <td>{{$order['created_at']}}</td>
                @if($role == 'Hurtownik' )
                    <td>
                        @if(!$order['realized'])
                            <form class="restore{{$order['id']}}" style="display: none" action="/realize">
                                <input name="id" value="{{$order['id']}}" type="hidden">
                            </form>
                            <button class="btn btn-primary" onclick="submit('restore{{$order['id']}}')">Realizuj</button>
                        @endif
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection
