@extends('welcome')

@section('notLoggedClientSection')
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

            <div class="row">
                <div class="col-sm-6 form-container">
                    <label for="city">Dane Osobowe:</label>
                    <div class="form-group">
                        <label>Imię:</label>
                        <input type="text" class="form-control" name="imie" placeholder="Imię" required>
                    </div>
                    <div class="form-group">
                        <label>Nazwisko:</label>
                        <input type="text" class="form-control" name="nazwisko" placeholder="Nazwisko" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" placeholder="Miasto">
                    </div>
                    <div class="form-group">
                        <label for="city">Kod Pocztowy:</label>
                        <input type="text" class="form-control" placeholder="Kod Pocztowy">
                    </div>
                    <div class="form-group">
                        <label for="city">Ulica:</label>
                        <input type="text" class="form-control" placeholder="Ulica">
                    </div>
                    <div class="form-group">
                        <label for="city">Numer Mieszkania:</label>
                        <input type="text" class="form-control" placeholder="Numer Mieszkania">
                    </div>
                </div>
                <div class="col-sm-6 form-container">
                    <button type="submit">Rejestracja</button>
                </div>

            </div>
        </form>
    </div>
@endsection
