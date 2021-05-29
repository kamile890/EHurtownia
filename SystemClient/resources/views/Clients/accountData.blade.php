@extends('welcome')

@section('clientSection')
    <li class="nav-item">
        <a class="nav-link active" href="/accountData">Dane Osobowe</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/">Produkty</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/orders">Zamówienia</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/cart">Koszyk</a>
    </li>
@endsection

@section('body')

    <div style="margin:20px;">
        <form class="row" style="justify-content: center" action="/saveClientSelf">
            <input type="hidden" name="id" value="{{$client['id']}}">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="pwd">Imie:</label>
                    <input type="text" class="form-control" value="{{$client['imie']}}" name="imie"/>
                </div>
                <div class="form-group">
                    <label for="pwd">Nazwisko:</label>
                    <input type="text" class="form-control" value="{{$client['nazwisko']}}" name="nazwisko"/>
                </div>
                <div class="form-group">
                    <label for="pwd">Numer telefonu:</label>
                    <input type="text" class="form-control" value="{{$client['numer_telefonu']}}" name="numer_telefonu"/>
                </div>
                <div class="form-group">
                    <label for="pwd">Miasto:</label>
                    <input type="text" class="form-control" value="{{$client['miasto']}}" name="miasto"/>
                </div>

            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="pwd">Kod pocztowy:</label>
                    <input type="text" class="form-control" value="{{$client['kodpocztowy']}}" name="kodpocztowy"/>
                </div>
                <div class="form-group">
                    <label for="pwd">Ulica:</label>
                    <input type="text" class="form-control" value="{{$client['ulica']}}" name="ulica"/>
                </div>
                <div class="form-group">
                    <label for="pwd">Numer mieszkania:</label>
                    <input type="text" class="form-control" value="{{$client['numermieszkania']}}" name="numermieszkania"/>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Zapisz</button>
        </form>
    </div>

@endsection





