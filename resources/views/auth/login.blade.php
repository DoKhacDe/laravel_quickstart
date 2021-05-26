@extends('layouts.login_register')
    @section('login_register_content')
                <h4 style="text-align: center;">Login</h4>
                <form action="{{ route('auth.check') }}" method="post">
                @if (Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>
                @endif
                @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}">
                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                    <br>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-block btn-success">Sign In</button>
                    </div>
                    <br>
                    <a href="{{ route('auth.register') }}">I don't have account, create new</a>
                </form>
    @endsection