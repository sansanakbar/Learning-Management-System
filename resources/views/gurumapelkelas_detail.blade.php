@extends('guru_header')

@section('content')
    <div>
        <h3>{{$mapel->nama_mapel}}</h3>
        <p>{{$kelas->tahun_kelas}}</p>
    </div>

    <hr>

    <div>
        <button id="tambahMateriBtn" data-toggle="modal" data-target="#tambahMateriModal">Tambah Materi</button>
    </div>

    <div>
        <b>Tabel Materi</b>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Judul Materi</td>
                <td>Lampiran Materi</td>
                <td colspan="3">Action</td>
            </tr>
            @foreach ($materis as $materi)
                <tr>
                    <td>{{$noMateri++}}</td>
                    <td>
                        {{$materi->judul_materi}}
                    </td>

                    <td>
                        <a href="{{Route('downloadMateri', [
                            'gurumapel' => $idGuruMapel, 
                            'gurumapelkelas' => $idGuruMapelKelas, 
                            'idMateri' => $materi->id_materi])}}">
                            {{$materi->lampiran_materi}}
                        </a>
                    </td>

                    <td>
                        <button type="button" data-toggle="modal" data-target="#lihatMateriModal{{$materi->id}}">
                            Details
                        </button>
                    </td>

                    <td>
                        <button type="button" data-toggle="modal" data-target="#editMateriModal{{$materi->id}}">
                            Edit
                        </button>
                    </td>

                    <td>
                        <button type="button" data-toggle="modal" data-target="#hapusMateriModal{{$materi->id}}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <hr>

    <div>
        <button id="tambahTugasBtn" data-toggle="modal" data-target="#tambahTugasModal">Tambah Tugas</button>
    </div>

    <div>
        <b>Tabel Tugas</b>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Judul Tugas</td>
                <td>Lampiran Tugas</td>
                <td colspan="3">Action</td>
            </tr>
            @foreach ($tugass as $tugas)
                <tr>
                    <td>{{$noTugas++}}</td>
                    <td>
                        <a href="{{route('guruJawabanTugas', [
                            'gurumapel' => $idGuruMapel, 
                            'gurumapelkelas' => $idGuruMapelKelas, 
                            'gurumapelkelastugas' => $tugas->id
                        ])}}">
                            {{$tugas->judul_tugas}}
                        </a>
                    </td>

                    <td>
                        <a href="{{Route('downloadTugas', [
                            'gurumapel' => $idGuruMapel, 
                            'gurumapelkelas' => $idGuruMapelKelas, 
                            'idTugas' => $tugas->id_tugas
                        ])}}">
                            {{$tugas->lampiran_tugas}}
                        </a>
                    </td>

                    <td>
                        <button type="button" data-toggle="modal" data-target="#lihatTugasModal{{$tugas->id}}">
                            Details
                        </button>
                    </td>

                    <td>
                        <button type="button" data-toggle="modal" data-target="#editTugasModal{{$tugas->id}}">
                            Edit
                        </button>
                    </td>

                    <td>
                        <button type="button" data-toggle="modal" data-target="#hapusTugasModal{{$tugas->id}}">
                            Delete
                        </button>
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

    <div id="tambahMateriModal" class="modal">
        <div class="modal-content">
            <b>Tambah Materi</b>
            @if (session('status'))
                <div>
                    {{session('status')}}
                </div>
            @endif
            <form action="{{route('tambahTugas', ['gurumapel' => $idGuruMapel, 'gurumapelkelas' => $idGuruMapelKelas])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="">Judul Tugas</label>
                    <input type="text" id="judul_tugas" name="judul_tugas">
                </div>

                <div>
                    <label for="">Deskripsi Tugas</label>
                    <textarea type="text" id="isi_tugas" name="isi_tugas" cols="75" rows="5"></textarea>
                </div>

                <div>
                    <label for="">Lampiran Tugas</label>
                    <input type="file" id="lampiran_tugas" name="lampiran_tugas">
                </div>

                <div>
                    <button type="submit">Tambah Tugas</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($tugass as $tugas)
        <div id="lihatTugasModal{{$tugas->id}}" class="modal">
            <div class="modal-content">
                <b>Lihat Tugas</b>
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
                        'idTugas' => $tugas->id_tugas])}}">
                        {{$tugas->lampiran_tugas}}
                    </a></p>
                </div>
            </div>
        </div>

        <div id="editTugasModal{{$tugas->id}}" class="modal">
            <div class="modal-content">
                <b>Tambah Tugas</b>
                @if (session('status'))
                    <div>
                        {{session('status')}}
                    </div>
                @endif
                <form action="{{route('editTugas', [
                    'gurumapel' => $idGuruMapel, 
                    'gurumapelkelas' => $idGuruMapelKelas, 
                    'idTugas' => $tugas->id_tugas])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="">Judul Tugas</label>
                        <input type="text" id="judul_tugas" name="judul_tugas" value="{{$tugas->judul_tugas}}">
                    </div>
    
                    <div>
                        <label for="">Deskripsi Tugas</label>
                        <textarea type="text" id="isi_tugas" name="isi_tugas" cols="75" rows="5">{{$tugas->isi_tugas}}</textarea>
                    </div>
    
                    <div>
                        <label for="">Lampiran Tugas</label>
                        <input type="file" id="lampiran_tugas" name="lampiran_tugas">
                        <a href="{{Route('downloadTugas', [
                            'gurumapel' => $idGuruMapel, 
                            'gurumapelkelas' => $idGuruMapelKelas, 
                            'idTugas' => $tugas->id_tugas])}}">
                            {{$tugas->lampiran_tugas}}
                        </a>
                    </div>
    
                    <div>
                        <button type="submit">Edit Tugas</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="hapusTugasModal{{$tugas->id}}" class="modal">
            <div class="modal-content">
                <div>
                    <span>Delete Confirmation!</span>
                </div>
                <div>
                    <span>Apakah anda yakin akan menghapus?</span>
                </div>
                <div>
                    <a href="{{route('hapusTugas', [
                        'gurumapel' => $idGuruMapel,
                        'gurumapelkelas' => $idGuruMapelKelas,
                        'gurumapelkelastugas' => $tugas->id])}}">
                        <button type="button">
                            Hapus
                        </button>
                    </a>
                    <button type="button" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    @endforeach

    <div id="tambahTugasModal" class="modal">
        <div class="modal-content">
            <b>Tambah Tugas</b>
            @if (session('status'))
                <div>
                    {{session('status')}}
                </div>
            @endif
            <form action="{{route('tambahTugas', ['gurumapel' => $idGuruMapel, 'gurumapelkelas' => $idGuruMapelKelas])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="">Judul Tugas</label>
                    <input type="text" id="judul_tugas" name="judul_tugas">
                </div>

                <div>
                    <label for="">Deskripsi Tugas</label>
                    <textarea type="text" id="isi_tugas" name="isi_tugas" cols="75" rows="5"></textarea>
                </div>

                <div>
                    <label for="">Lampiran Tugas</label>
                    <input type="file" id="lampiran_tugas" name="lampiran_tugas">
                </div>

                <div>
                    <button type="submit">Tambah Tugas</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($tugass as $tugas)
        <div id="lihatTugasModal{{$tugas->id}}" class="modal">
            <div class="modal-content">
                <b>Lihat Tugas</b>
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
                        'idTugas' => $tugas->id_tugas])}}">
                        {{$tugas->lampiran_tugas}}
                    </a></p>
                </div>
            </div>
        </div>

        <div id="editTugasModal{{$tugas->id}}" class="modal">
            <div class="modal-content">
                <b>Tambah Tugas</b>
                @if (session('status'))
                    <div>
                        {{session('status')}}
                    </div>
                @endif
                <form action="{{route('editTugas', [
                    'gurumapel' => $idGuruMapel, 
                    'gurumapelkelas' => $idGuruMapelKelas, 
                    'idTugas' => $tugas->id_tugas])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="">Judul Tugas</label>
                        <input type="text" id="judul_tugas" name="judul_tugas" value="{{$tugas->judul_tugas}}">
                    </div>
    
                    <div>
                        <label for="">Deskripsi Tugas</label>
                        <textarea type="text" id="isi_tugas" name="isi_tugas" cols="75" rows="5">{{$tugas->isi_tugas}}</textarea>
                    </div>
    
                    <div>
                        <label for="">Lampiran Tugas</label>
                        <input type="file" id="lampiran_tugas" name="lampiran_tugas">
                        <a href="{{Route('downloadTugas', [
                            'gurumapel' => $idGuruMapel, 
                            'gurumapelkelas' => $idGuruMapelKelas, 
                            'idTugas' => $tugas->id_tugas])}}">
                            {{$tugas->lampiran_tugas}}
                        </a>
                    </div>
    
                    <div>
                        <button type="submit">Edit Tugas</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="hapusTugasModal{{$tugas->id}}" class="modal">
            <div class="modal-content">
                <div>
                    <span>Delete Confirmation!</span>
                </div>
                <div>
                    <span>Apakah anda yakin akan menghapus?</span>
                </div>
                <div>
                    <a href="{{route('hapusTugas', [
                        'gurumapel' => $idGuruMapel,
                        'gurumapelkelas' => $idGuruMapelKelas,
                        'gurumapelkelastugas' => $tugas->id])}}">
                        <button type="button">
                            Hapus
                        </button>
                    </a>
                    <button type="button" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    @endforeach
@endsection