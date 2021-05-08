@extends('guru_header')

@section('content')
    <div>
        <h3>Dashboard Guru</h3>
    </div>
    <div>
        <span>Selamat Datang, Guru<span>
    </div>

    <div>
        <span>Jumlah Mata Pelajaran: {{$mapelsCount}}</span>
    </div>

    <div>
        <span>Jumlah Pertemuan: {{$kelassCount}} kelas</span>
    </div>

    <div>
        <span>Jumlah Materi: {{$materisCount}}</span>
    </div>

    <div>
        <span>Jumlah Tugas: {{$tugassCount}}</span>
    </div>
@endsection