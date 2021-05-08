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
                        <a href="" data-toggle="modal" data-target="#lihatMateriModal{{$materi->id}}">
                            {{$materi->judul_materi}}
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
            </tr>
            @foreach ($tugass as $tugas)
                <tr>
                    <td>
                        {{$noTugas++}}
                    </td>
                    <td>
                        <a href="{{route('siswajawabantugas', ['gurumapelkelas' => $tugas->id_gurumapelkelas, 'gurumapelkelastugas' => $tugas->id])}}">
                            {{$tugas->judul_tugas}}
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    @foreach ($materis as $materi)
        <div id="lihatMateriModal{{$materi->id}}" class="modal">
            <div class="modal-content">
                <b>Lihat Materi</b>
                <div>
                    <p>Judul Materi: {{$materi->judul_materi}}</p>
                </div>

                <div>
                    <p>Deskripsi Materi: </p>
                    <p>{{$materi->isi_materi}}</p>
                </div>

                <div>
                    <p>Lampiran: <a href="{{route('downloadMateri', [
                        'idMateri' => $materi->id_materi
                    ])}}">
                        {{$materi->lampiran_materi}}
                    </a></p>
                </div>
            </div>
        </div>
    @endforeach
@endsection