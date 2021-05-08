@extends('guru_header')

@section('content')
    <div>
        <b>Jawaban Tugas Siswa</b>
    </div>

    <div>
        <div>
            <p>Judul Tugas: {{$tugas->judul_tugas}}</p>
        </div>

        <div>
            <p>Deskripsi Tugas: </p>
            <p>{{$tugas->isi_tugas}}</p>
        </div>

        <div>
            <p>Lampiran: <a href="{{Route('downloadTugas', [
                'gurumapel' => $idGuruMapel, 
                'gurumapelkelas' => $idGuruMapelKelas, 
                'idTugas' => $tugas->id])}}">
                {{$tugas->lampiran_tugas}}
            </a></p>
        </div>
    </div>

    <div>
        <table border="1">
            <tr>
                <td>No</td>
                <td>NISN</td>
                <td>Nama</td>
                <td>Nilai</td>
                <td>Jawaban</td>
            </tr>
            @foreach ($siswas as $siswa)
                <tr>
                    <td>
                        {{$noSiswa++}}
                    </td>
                    <td>
                        {{$siswa->nisn}}
                    </td>
                    <td>
                        {{$siswa->nama}}
                    </td>
                    <td>
                        {{$siswa->nilai_jawabantugas}}
                    </td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#lihatJawabanModal{{$siswa->id}}">
                            Details
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    @foreach ($siswas as $siswa)
        <div id="lihatJawabanModal{{$siswa->id}}" class="modal">
            <div class="modal-content">
                <b>Lihat Jawaban Tugas</b>
                <div>
                    <form action="{{route('nilaiJawabanTugas', [
                        'gurumapel' => $idGuruMapel, 
                        'gurumapelkelas' => $idGuruMapelKelas, 
                        'gurumapelkelastugas' => $idGuruMapelKelasTugas,
                        'idJawabanTugas' => $siswa->id
                    ])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="">Jawaban Siswa: </label>
                            <p>{{$siswa->isi_jawabantugas}}</p>
                        </div>

                        <div>
                            <label for="">Lampiran Jawaban: </label>
                            <a href="">{{$siswa->lampiran_jawabantugas}}</a>
                        </div>

                        <div>
                            <label for="">Nilai: </label>
                            <input type="number" name="nilai_jawabantugas" id="nilai_jawabantugas" min="0" max="100" value="{{$siswa->nilai_jawabantugas}}">
                        </div>

                        <div>
                            <label for="">Catatan Guru:</label>
                            <textarea name="evaluasi_jawabantugas" id="evaluasi_jawabantugas" cols="30" rows="2">{{$siswa->evaluasi_jawabantugas}}</textarea>
                        </div>

                        <div>
                            <button type="submit">Simpan Nilai</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection