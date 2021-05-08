@extends('siswa_header')

@section('content')
    <div>
        <h3>Nilai</h3>
    </div>

    @foreach ($mapels as $mapel)
        {{$mapel->nama_mapel}}
        <div>
            <table border="1">
                <tr align="center">
                    <td>No</td>
                    <td>Judul Tugas</td>
                    <td>Nilai</td>
                </tr>

                @foreach ($tugass as $tugas)
                    @if ($tugas->id_gurumapelkelas == $mapel->id)
                        <tr align="center">
                            <td>
                                {{$noTugas++}}
                            </td>
                            <td>
                                {{$tugas->judul_tugas}}
                            </td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#lihatJawabanModal{{$tugas->id}}">
                                    @if ($tugas->nilai_jawabantugas==NULL)
                                        -
                                    @else
                                        {{$tugas->nilai_jawabantugas}}
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    @endforeach

    @foreach ($tugass as $tugas)
        <div id="lihatJawabanModal{{$tugas->id}}" class="modal">
            <div class="modal-content">
                <div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <h3>{{$tugas->judul_tugas}}</h3>
                        </div>

                        <div>
                            <label for="">Deskripsi Tugas: </label>
                            <p>{{$tugas->isi_tugas}}</p>
                        </div>

                        <div>
                            <label for="">Lampiran Tugas: </label>
                            <a href="{{route('downloadTugas', [
                                'idTugas' => $tugas->id_tugas
                            ])}}">
                                {{$tugas->lampiran_tugas}}
                            </a>
                        </div>

                        <hr>
                        
                        <div>
                            <label for="">Jawaban Siswa: </label>
                            <p>{{$tugas->isi_jawabantugas}}</p>
                        </div>

                        <div>
                            <label for="">Lampiran Jawaban: </label>
                            <a href="{{route('downloadJawabanTugas', [
                                'idJawabanTugas' => $tugas->id
                            ])}}">
                                {{$tugas->lampiran_jawabantugas}}
                            </a>
                        </div>

                        <div>
                            <label for="">Nilai: </label>
                            {{$tugas->nilai_jawabantugas}}
                        </div>

                        <div>
                            <label for="">Catatan Guru:</label>
                            <p>{{$tugas->evaluasi_jawabantugas}}</p>
                            </textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    
@endsection