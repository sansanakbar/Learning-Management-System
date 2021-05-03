@extends('guru_header')

@section('content')
    <div>
        <h3>{{$mapel->nama_mapel}}</h3>
        <p>{{$mapel->deskripsi_mapel}}</p>
    </div>
    <div>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Kelas</td>
                <td>Keterangan</td>
            </tr>
            @foreach ($kelass as $kelas)
                <tr>
                    <td>
                        {{$nokelas++}}
                    </td>
                    <td>
                        <a href="{{route('gurumapelkelasdetail', ['gurumapel' => $guruMapel, 'gurumapelkelas' => $kelas->id])}}">
                            {{$kelas->tahun_kelas}}
                        </a>
                    </td>
                    <td>
                        
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection