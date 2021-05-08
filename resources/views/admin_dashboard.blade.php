@extends('admin_header')

@section('content')
    <div>
        <h3>Dashboard Admin</h3>
    </div>

    <div>
        <div>
            <p>Jumlah User: {{$usersCount}}</p>
        </div>
    </div>

    <div>
        <div>
            <p>Jumlah Admin: {{$adminsCount}}</p>
        </div>
    </div>

    <div>
        <div>
            <p>Jumlah Guru: {{$gurusCount}}</p>
        </div>
    </div>

    <div>
        <div>
            <p>Jumlah Siswa: {{$siswasCount}}</p>
        </div>
    </div>

    <div>
        <span>Selamat Datang, Administrator<span>
    </div>
@endsection

