@extends('guru_header')

@section('content')
    <div>
        <h3>{{$mapel->nama_mapel}}</h3>
        <p>{{$mapel->deskripsi_mapel}}</p>
    </div>

    <div>
        <button id="tambahKelasBtn" data-toggle="modal" data-target="#tambahKelasModal">Tambah Kelas</button>
    </div>
    
    <div>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Kelas</td>
                <td>Action</td>
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
                        <button type="button" data-toggle="modal" data-target="#hapusGuruMapelKelasModal{{$kelas->id}}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div id="tambahKelasModal" class="modal">
        <div class="modal-content">
            <div>
                <form action="{{route('tambahGuruMapelKelas', $guruMapel)}}" method="POST">
                    @csrf
                    <div id="kelas_dynamic">
                        <label for="">Kelas</label>
                        <select name="kelas[]" id="kelas">
                            <option disabled selected>Pilih Kelas</option>
                            <?php foreach($allKelass as $aKelas):
                                $array1 = array('id_gurumapel' => $guruMapel, 'id_kelas' => $aKelas->id);
                                $array2 = array();
                                $n=0;
                                foreach ($kelass as $kelas) {
                                    $array2[$n]['id_gurumapel'] = $kelas->id_gurumapel;
                                    $array2[$n]['id_kelas'] = $kelas->id_kelas;
                                    $n++;
                                };?>
                                
                                @if (! in_array($array1, $array2))
                                    <option value={{$aKelas->id}}>{{$aKelas->tahun_kelas}}</option>
                                @endif

                                <?php endforeach; ?>
                        </select>
                        <button type="button" name="addKelas" id="addKelas">
                            +
                        </button>
                    </div>
                    
                    <div>
                        <button type="submit">Tambah Kelas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($kelass as $kelas)
        <div id="hapusGuruMapelKelasModal{{$kelas->id}}" class="modal">
            <div class="modal-content">
                <div>
                    <span>Delete Confirmation!</span>
                </div>
                <div>
                    <span>Apakah anda yakin akan menghapus?</span>
                </div>
                <div>
                    <a href="{{route('hapusGuruMapelKelas', ['gurumapel' => $gurumapel, 'idGuruMapelKelas' => $kelas->id])}}">
                        <button type="button">
                            Hapus
                        </button>
                    </a>
                    <button type="button" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div> 
    @endforeach

    <script type="text/javascript">
        $(document).ready(function(){      
            var i=1;  

            $('#addKelas').click(function(){  
                i++;  
                
                $('#kelas_dynamic').append('<div id="row'+i+'"><label for="">Kelas '+i+'</label><select name="kelas[]" id="kelas"><option disabled selected>Pilih Kelas</option><?php foreach($allKelass as $aKelas):$array1 = array('id_gurumapel' => $guruMapel, 'id_kelas' => $aKelas->id);$array2 = array();$n=0;foreach ($kelass as $kelas) {$array2[$n]['id_gurumapel'] = $kelas->id_gurumapel;$array2[$n]['id_kelas'] = $mapel->id_kelas;$n++;};?>@if (! in_array($array1, $array2))<option value={{$aKelas->id}}>{{$aKelas->tahun_kelas}}</option>@endif<?php endforeach; ?></select><button type="button" name="remove" id="'+i+'" class="btn_remove">X</button></div>');
            });

            $(document).on('click', '.btn_remove', function(){  
                var button_id = $(this).attr("id");   
                $('#row'+button_id+'').remove();  
            });
        });  
    </script>
@endsection