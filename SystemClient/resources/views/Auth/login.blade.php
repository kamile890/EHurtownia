@extends('welcome')

@section('notLoggedClientSection')
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

                <div class="form-group form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="remember" type="checkbox"> Zapamiętaj
                    </label>
                </div>
            </div>
            <button type="submit">Zaloguj</button>

        </form>
    </div>
@endsection
