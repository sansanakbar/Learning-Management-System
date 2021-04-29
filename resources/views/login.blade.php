@extends('header')

@section('content')
    <div>
        @if (session('status'))
            <div>
                {{session('status')}}
            </div>
        @endif
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div>
                <label for="">Username</label>
                <input type="text" placeholder="Username" name="username" id="username"
                value="{{old('username')}}">
                @error('username')
                    <div>
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Password</label>
                <input type="password" placeholder="Password" name="password" id="password">
                @error('password')
                    <div>
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div>
                <input type="checkbox" name="remember" id="remember">
                <label for="">Remember me</label>
            </div>

            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
@endsection