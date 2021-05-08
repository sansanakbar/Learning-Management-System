@extends('siswa_header')

@section('content')
    <div>
        <h3>Detail Tugas</h3>
    </div>

    <div>
        <p>Judul Tugas      : {{$tugas->judul_tugas}}</p>
        <p>Deskripsi Tugas  : {{$tugas->isi_tugas}}</p>
        <p>Lampiran Tugas   : <a href="{{route('downloadTugas', ['idTugas' => $tugas->id_tugas])}}">{{$tugas->lampiran_tugas}}</a></p>
    </div>

    <hr>

    <div>
        <b>Jawaban Siswa</b>
        @if ($jawaban == NULL)
            <form action="{{route('siswajawabantugas', [
                'gurumapelkelas' => $idGuruMapelKelas,
                'gurumapelkelastugas' => $idGuruMapelKelasTugas
            ])}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div>
                    <textarea name="isi_jawabantugas" id="isi_jawabantugas" cols="75" rows="5"></textarea>
                </div>
                
                <div>
                    <input type="file" name="lampiran_jawabantugas" id="lampiran_jawabantugas">
                </div>
                
                <div>
                    <button type="submit">Kirim Jawaban</button>
                </div>
            </form>
        @else
            <div>
                <p>{{$jawaban->isi_jawabantugas}}</p>
            </div>
            
            <div>
                <label for="">Lampiran:</label>
                <a href="{{route('downloadJawabanTugas', ['idJawabanTugas' => $jawaban->id])}}">{{$jawaban->lampiran_jawabantugas}}</a>
            </div>

            <div>
                <button type="button" data-toggle="modal" data-target="#hapusJawabanTugas">
                    Hapus Jawaban
                </button>
            </div>
            
            <div id="hapusJawabanTugas" class="modal">
                <div class="modal-content">
                    <div>
                        <span>Delete Confirmation!</span>
                    </div>
                    <div>
                        <span>Apakah anda yakin akan menghapus?</span>
                    </div>
                    <div>
                        <a href="{{route('hapusJawabanTugas', [
                            'gurumapelkelas' => $idGuruMapelKelas,
                            'gurumapelkelastugas' => $idGuruMapelKelasTugas,
                            'idJawabanTugas' => $jawaban->id])}}">
                            <button type="button">
                                Hapus
                            </button>
                        </a>
                        <button type="button" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    
@endsection