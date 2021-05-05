@extends('siswa_header')

@section('content')
    <div>
        <h3>Mata Pelajaran</h3>
    </div>

    <div>
        <b>Tabel Materi</b>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Judul Materi</td>
            </tr>
            @foreach ($materis as $materi)
                <tr>
                    <td>
                        {{$noMateri++}}
                    </td>
                    <td>
                        <a href="">
                            {{$materi->judul_materi}}
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div>
        <b>Tabel Tugas</b>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Judul Tugas</td>
            </tr>
            @foreach ($tugass as $tugas)
                <tr>
                    <td>
                        {{$noTugas++}}
                    </td>
                    <td>
                        <a href="{{route('siswajawabantugas', ['gurumapelkelas' => $tugas->id_gurumapelkelas, 'tugas' => $tugas->id_tugas])}}">
                            {{$tugas->judul_tugas}}
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection