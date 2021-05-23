@extends('welcome')

@section('notLoggedClientSection')
    <li class="nav-item">
        <a class="nav-link" href="/cart">Koszyk</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/registerPage">Register</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="/loginPage">Login</a>
    </li>
@stop

@section('body')
    <div class="container-fluid">
        <form action="/login">
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
            <button class="btn btn-primary" type="submit">Zaloguj</button>

        </form>
    </div>
@endsection
