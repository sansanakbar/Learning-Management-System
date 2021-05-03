@extends('guru_header')

@section('content')
    <div>
        <h3>Mata Pelajaran</h3>
        <p>Kelas</p>
    </div>

    <hr>

    <div>
        <b>Tabel Materi</b>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Judul Materi</td>
                <td>Isi Materi</td>
                <td>Lampiran Materi</td>
            </tr>
            @foreach ($materis as $materi)
                <tr>
                    <td>{{$noMateri++}}</td>
                    <td>
                        <a href="">
                            {{$materi->judul_materi}}
                        </a>
                    </td>
                    <td>
                        {{$materi->isi_materi}}
                    </td>
                    <td>
                        <a href="">
                            {{$materi->lampiran_materi}}
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <hr>

    <div>
        <b>Tabel Tugas</b>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Judul Tugas</td>
                <td>Isi Tugas</td>
                <td>Lampiran Tugas</td>
            </tr>
            @foreach ($tugass as $tugas)
                <tr>
                    <td>{{$noTugas++}}</td>
                    <td>
                        <a href="">
                            {{$tugas->judul_tugas}}
                        </a>
                    </td>
                    <td>
                        {{$tugas->isi_tugas}}
                    </td>
                    <td>
                        <a href="">
                            {{$tugas->lampiran_tugas}}
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    
    <hr>

    <div>
        <b>Tabel Siswa</b>
        <table border="1">
            <tr>
                <td>No</td>
                <td>NISN</td>
                <td>Nama</td>
                <td>Jenis Kelamin</td>
            </tr>
            @foreach ($siswas as $siswa)
                <tr>
                    <td>{{$noSiswa++}}</td>
                    <td>
                        <a href="">
                            {{$siswa->nisn}}
                        </a>
                    </td>
                    <td>
                        {{$siswa->nama}}
                    </td>
                    <td>
                        {{$siswa->jenis_kelamin}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection