@extends('admin_header')

@section('content')
    <div>
        <h3>Manajemen Akun</h3>
    </div>

    <div>
        <b>Guru</b>
        <table border="1">
            <tr>
                <td>No</td>
                <td>NIP</td>
                <td>Nama</td>
                <td>Username</td>
                <td colspan="3">Action</td>
            </tr>
            @foreach ($gurus as $guru)
                <tr>
                    <td>{{$noguru++}}</td>
                    <td>{{$guru->nip}}</td>
                    <td>{{$guru->nama}}</td>
                    <td>{{$guru->username}}</td>
                    <td>Details</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            @endforeach
        </table>
    </div>
    
    <hr>
    
    <div>
        <b>Siswa</b>
        <table border="1">
            <tr>
                <td>No</td>
                <td>NISN</td>
                <td>Nama</td>
                <td>Username</td>
                <td colspan="3">Action</td>
            </tr>
            @foreach ($siswas as $siswa)
                <tr>
                    <td>{{$nosiswa++}}</td>
                    <td>{{$siswa->nisn}}</td>
                    <td>{{$siswa->nama}}</td>
                    <td>{{$siswa->username}}</td>
                    <td>Details</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            @endforeach
        </table>
    </div>

    <hr>
@endsection