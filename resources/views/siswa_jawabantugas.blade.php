@extends('siswa_header')

@section('content')
    <div>
        <h3>Detail Tugas</h3>
    </div>

    <div>
        <p>Judul Tugas      : {{$tugas->judul_tugas}}</p>
        <p>Deskripsi Tugas  : {{$tugas->isi_tugas}}</p>
        <p>File             : {{$tugas->lampiran_tugas}}</p>
    </div>

    <div>
        <b>Jawaban Siswa</b>
        <form action="">
            <div>
                <textarea name="" id="" cols="75" rows="5"></textarea>
            </div>
            
            <div>
                <input type="file">
            </div>
            
            <div>
                <button type="submit">Kirim Jawaban</button>
            </div>
        </form>
    </div>
@endsection