@extends('guru_header')

@section('content')
    <div>
        <h3>Mata Pelajaran</h3>
    </div>

    <div>
        <button id="tambahMapelBtn" data-toggle="modal" data-target="#tambahMapelModal">Tambah Mapel</button>
    </div>

    <div>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Kode</td>
                <td>Mata Pelajaran</td>
                <td>Action</td>
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
                        <a href="{{route('gurumapelkelas', $mapel->id)}}">
                            {{$mapel->nama_mapel}}
                        </a>
                    </td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#hapusGuruMapelModal{{$mapel->id}}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div id="tambahMapelModal" class="modal">
        <div class="modal-content">
            <div>
                <form action="{{route('tambahGuruMapel')}}" method="POST">
                    @csrf
                    <div id="mapel_dynamic">
                        <label for="">Mata Pelajaran</label>
                        <select name="mapel[]" id="mapel">
                            <option disabled selected>Pilih Mata Pelajaran</option>
                            <?php foreach($allMapels as $aMapel):
                                $array1 = array('id_guru' => $idGuru, 'id_mapel' => $aMapel->id);
                                $array2 = array();
                                $n=0;
                                foreach ($mapels as $mapel) {
                                    $array2[$n]['id_guru'] = $mapel->id_guru;
                                    $array2[$n]['id_mapel'] = $mapel->id_mapel;
                                    $n++;
                                };?>
                                
                                @if (! in_array($array1, $array2))
                                    <option value={{$aMapel->id}}>{{$aMapel->nama_mapel}}</option>
                                @endif

                                <?php endforeach; ?>
                        </select>
                        <button type="button" name="addMapel" id="addMapel">
                            +
                        </button>
                    </div>
                    
                    <div>
                        <button type="submit">Tambah Mapel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($mapels as $mapel)
        <div id="hapusGuruMapelModal{{$mapel->id}}" class="modal">
            <div class="modal-content">
                <div>
                    <span>Delete Confirmation!</span>
                </div>
                <div>
                    <span>Apakah anda yakin akan menghapus?</span>
                </div>
                <div>
                    <a href="{{route('hapusGuruMapel', $mapel->id)}}">
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

            $('#addMapel').click(function(){  
                i++;  
                
                $('#mapel_dynamic').append('<div id="row'+i+'"><label for="">Mata Pelajaran '+i+'</label><select name="mapel[]" id="mapel"><option disabled selected>Pilih Mata Pelajaran</option><?php foreach($allMapels as $aMapel):$array1 = array('id_guru' => $idGuru, 'id_mapel' => $aMapel->id);$array2 = array();$n=0;foreach ($mapels as $mapel) {$array2[$n]['id_guru'] = $mapel->id_guru;$array2[$n]['id_mapel'] = $mapel->id_mapel;$n++;};?>@if (! in_array($array1, $array2))<option value={{$aMapel->id}}>{{$aMapel->nama_mapel}}</option>@endif<?php endforeach; ?></select><button type="button" name="remove" id="'+i+'" class="btn_remove">X</button></div>');
            });

            $(document).on('click', '.btn_remove', function(){  
                var button_id = $(this).attr("id");   
                $('#row'+button_id+'').remove();  
            });
        });  
    </script>
@endsection