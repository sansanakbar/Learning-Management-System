<!DOCTYPE html>
<html>
    <head>
        <title>Learning Management System</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
            <div>
                <ul>
                    <li>
                        <a href="">Admin</a>
                    </li>
                    <li>
                        <a href="{{route('admindashboard')}}">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{route('adminolahakun')}}">Manajemen Akun</a>
                    </li>
                    <li>
                        <a href="{{route('adminlog')}}">Log Data</a>
                    </li>
                </ul>
            </div>
        </div>
        
        @yield('content')
    @include('footer')