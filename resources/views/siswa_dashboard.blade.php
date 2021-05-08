@extends('siswa_header')

@section('content')
    <div>
        <h3>Dashboard Admin</h3>
    </div>
    
    <div>
        <span>Selamat Datang, Siswa<span>
    </div>

    <div>
        <span>Jumlah Mata Pelajaran: {{$mapelsCount}}</span>
    </div>

    <div>
        <span>Jumlah Materi: {{$materisCount}}</span>
    </div>

    <div>
        <span>Jumlah Tugas: {{$tugassCount}}</span>
    </div>
@endsection