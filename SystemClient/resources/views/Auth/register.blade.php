@extends('welcome')

@section('notLoggedClientSection')
    <li class="nav-item">
        <a class="nav-link" href="/cart">Koszyk</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="/registerPage">Register</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/loginPage">Login</a>
    </li>
@endsection

@section('body')
    <div class="container-fluid">
        <form action="/register">
            <div class="container-fluid form-container">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Hasło:</label>
                    <input type="password" class="form-control" placeholder="Enter password" name="haslo" required>
                </div>
            </div>
            <div onclick="switchPlace()" id="hideDate">Dane osobowe</div>

            <div class="row" id="dane" style="display: none;">
                <div class="col-sm-12 form-container">
                    <label for="city">Dane Osobowe:</label>
                    <div class="form-group">
                        <label>Imię:</label>
                        <input type="text" class="form-control" name="imie" placeholder="Imię">
                    </div>
                    <div class="form-group">
                        <label>Nazwisko:</label>
                        <input type="text" class="form-control" name="nazwisko" placeholder="Nazwisko">
                    </div>
                    <div class="form-group">
                        <label>Numer Telefonu:</label>
                        <input type="text" class="form-control" name="phone" placeholder="Wprowadź z numerem kierunkowym">
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" name="miasto" placeholder="Miasto">
                    </div>
                    <div class="form-group">
                        <label for="city">Kod Pocztowy:</label>
                        <input type="text" class="form-control" name="kodpocztowy" placeholder="Kod Pocztowy">
                    </div>
                    <div class="form-group">
                        <label for="city">Ulica:</label>
                        <input type="text" class="form-control" name="ulica" placeholder="Ulica">
                    </div>
                    <div class="form-group">
                        <label for="city">Numer Mieszkania:</label>
                        <input type="text" class="form-control" name="numermieszkania" placeholder="Numer Mieszkania">
                    </div>
                </div>


            </div>
            <div class="col-sm-12 form-container">
                <button class="btn btn-primary" type="submit">Rejestracja</button>
            </div>
        </form>
    </div>
@endsection
