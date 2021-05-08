@extends('siswa_header')

@section('content')
    <div>
        <h3>Mata Pelajaran</h3>
    </div>
    <div>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Kode</td>
                <td>Mata Pelajaran</td>
                <td>Guru Mapel</td>
            </tr>
            @foreach ($mapels as $mapel)
                <tr>
                    <td>
                        {{$noMapel++}}
                    </td>
                    <td>
                        {{$mapel->kode_mapel}}
                    </td>
                    <td>
                        <a href="{{route('siswamapeldetail', $mapel->id)}}">
                            {{$mapel->nama_mapel}}
                        </a>
                    </td>
                    <td>
                        {{$mapel->nama}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection