@extends('siswa_header')

@section('content')
    <div>
        <h3>Nilai</h3>
    </div>

    @foreach ($mapels as $mapel)
        {{$mapel->nama_mapel}}
        <div>
            <table border="1">
                <tr>
                    <td>No</td>
                    <td>Judul Tugas</td>
                    <td>Nilai</td>
                </tr>

                @foreach ($tugass as $tugas)
                    @if ($tugas->id_gurumapelkelas == $mapel->id)
                        <tr>
                            <td>
                                {{$noTugas++}}
                            </td>
                            <td>
                                {{$tugas->judul_tugas}}
                            </td>
                            <td>
                                {{$tugas->nilai}}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    @endforeach
    
@endsection