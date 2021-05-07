<!DOCTYPE html>
<html>
    <head>
        <title>Learning Management System</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </head>
    <body>
        <div>
            <div>
                <nav>
                    <ul>
                        <li>icon</li>
                        <li>Learning Management System</li>
                    </ul>
        
                    <ul>
                        @guest
                            <li>
                                <a href="/">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}">Sign in</a>
                            </li> 
                        @endguest
                            
                        @auth
                            <li>
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button type="submit">Logout</button>
                                </form>
                            </li> 
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
        
        @yield('content')
    @include('footer')