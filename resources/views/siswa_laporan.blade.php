@extends('siswa_header')

@section('content')
    <div>
        Nama: {{$profil->nama}}
    </div>
    <div>
        NISN: {{$profil->nisn}}
    </div>

    <hr>

    <div>
        Nilai
        <table border="1">
            <tr align="center">
                <td>Mata Pelajaran</td>
                <td>Nilai Rata-Rata</td>
            </tr>
            @foreach ($mapels as $mapel)
                <?php $nilaiRata = 0;?>
                <tr align="center">
                    <td>
                        {{$mapel->nama_mapel}}
                    </td>
                    @foreach ($tugass as $tugas)
                        @if ($tugas->id_gurumapelkelas == $mapel->id)
                            <?php 
                                $nilaiRata += $tugas->nilai_jawabantugas;
                                $nNilai+=1;
                            ?>
                        @endif
                    @endforeach
                    <td>
                        <?php if($nNilai!=0){$nilaiRata /= $nNilai;}?>
                        {{$nilaiRata}}
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

    <hr>

    <div>
        Tugas dengan perolehan nilai tertinggi
        <table border="1">
            <tr align="center">
                <td>
                    Mata Pelajaran
                </td>
                <td>
                    Tugas
                </td>
                <td>
                    Nilai
                </td>
            </tr>
            @foreach ($tugass as $tugas)
                <tr align="center">
                    <td>
                        {{$tugas->nama_mapel}}
                    </td>
                    <td>
                        {{$tugas->judul_tugas}}
                    </td>
                    <td>
                        {{$tugas->nilai_jawabantugas}}
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
@endsection