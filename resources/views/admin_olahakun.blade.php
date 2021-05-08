@extends('admin_header')

@section('content')
    <div>
        <h3>Manajemen Akun</h3>
    </div>
    
    <div>
        <button id="buatAkunBtn" data-toggle="modal" data-target="#buatAkunModal">Buat Akun</button>
    </div>

    <div>
        <b>Guru</b>
        <table border="1">
            <tr>
                <td>No</td>
                <td>NIP</td>
                <td>Nama</td>
                <td>Username</td>
                <td colspan="3">Action</td>
            </tr>
            @foreach ($gurus as $guru)
                <tr>
                    <td>{{$noguru++}}</td>
                    <td>{{$guru->nip}}</td>
                    <td>{{$guru->nama}}</td>
                    <td>{{$guru->username}}</td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#lihatGuruModal{{$guru->id}}">
                            Details
                        </button>
                    </td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#editGuruModal{{$guru->id}}">
                            Edit
                        </button>
                    </td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#hapusGuruModal{{$guru->id}}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    
    <hr>
    
    <div>
        <b>Siswa</b>
        <table border="1">
            <tr>
                <td>No</td>
                <td>NISN</td>
                <td>Nama</td>
                <td>Username</td>
                <td colspan="3">Action</td>
            </tr>
            @foreach ($siswas as $siswa)
                <tr>
                    <td>{{$nosiswa++}}</td>
                    <td>{{$siswa->nisn}}</td>
                    <td>{{$siswa->nama}}</td>
                    <td>{{$siswa->username}}</td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#lihatSiswaModal{{$siswa->id}}">
                            Details
                        </button>
                    </td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#editSiswaModal{{$siswa->id}}">
                            Edit
                        </button>
                    </td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#hapusSiswaModal{{$siswa->id}}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <hr>

    <!--MODAL BUAT AKUN-->
    <div id="buatAkunModal" class="modal">
        <div class="modal-content">
            <div>
                <b>Buat Akun</b>
                @if (session('status'))
                    <div>
                        {{session('status')}}
                    </div>
                @endif
                <form action="{{route('buatakun')}}" method="POST">
                    @csrf
        
                    <div>
                        <label>Nama</label>
                        <input type="text" name="nama" id="nama" value="{{old('nama')}}">
                        @error('nama')
                            <div>
                                {{$message}}
                            </div>
                        @enderror
                    </div>
        
                    <div>
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{old('tgl_lahir')}}">
                        @error('tgl_lahir')
                            <div>
                                {{$message}}
                            </div>
                        @enderror
                    </div>
        
                    <div>
                        <label>Jenis Kelamin</label>
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" id="jenis_kelamin">
                        <label for="">Laki-Laki</label>
                        <input type="radio" name="jenis_kelamin" value="Perempuan" id="jenis_kelamin">
                        <label for="">Perempuan</label>
                    </div>
        
                    <div>
                        <label for="">Email</label>
                        <input type="text" name="email" id="email" value="{{old('email')}}">
                        @error('email')
                            <div>
                                {{$message}}
                            </div>
                        @enderror
                    </div>
        
                    <div>
                        <label for="">Kontak</label>
                        <input type="text" name="kontak" id="kontak" value="{{old('kontak')}}">
                        @error('kontak')
                            <div>
                                {{$message}}
                            </div>
                        @enderror
                    </div>
        
                    <div style="display:none">
                        <label for="">Username</label>
                        <input type="text" name="username" id="username" value="{{old('username')}}">
                        @error('username')
                            <div>
                                {{$message}}
                            </div>
                        @enderror
                    </div>
        
                    <div>
                        <label for="">Password</label>
                        <input type="password" name="password" id="password">
                        @error('password')
                            <div>
                                {{$message}}
                            </div>
                        @enderror
                    </div>
        
                    <div>
                        <label for="">Jenis Akun</label>
                        <select name="jenis_akun" id="jenisAkun" onchange="ShowHideDiv()">
                            <option disabled selected>Pilih Jenis Akun</option>
                            <option value=1>Guru</option>
                            <option value=2>Siswa</option>
                        </select>
                    </div>
        
                    <div id="guruInputField" style="display: none">
                        <div>
                            <label for="">NIP</label>
                            <input type="text" name="nip" id="nip">
                        </div>
            
                        <div id="mapel_dynamic">
                            <label for="">Mata Pelajaran</label>
                            <select name="mapel[]" id="mapel"}>
                                <option disabled selected>Pilih Mata Pelajaran</option>
                                @foreach ($mapels as $mapel)
                                    <option value={{$mapel->id}}>{{$mapel->nama_mapel}}</option>
                                @endforeach
                            </select>
                            <button type="button" name="addMapel" id="addMapel">
                                +
                            </button>
                        </div>
                    </div>
                    
                    <div id="siswaInputField" style="display: none">
                        <div>
                            <label for="">NISN</label>
                            <input type="text" name="nisn" id="nisn">
                        </div>
            
                        <div>
                            <label for="">Kelas</label>
                            <select name="kelas" id="kelas">
                                @foreach ($kelass as $kelas)
                                    <option value={{$kelas->id}}>{{$kelas->tahun_kelas}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
        
                    <div>
                        <button type="submit">Buat Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){      
            var i=1;  

            $('#addMapel').click(function(){  
                i++;  
                
                $('#mapel_dynamic').append('<div id="row'+i+'"><label for="">Mata Pelajaran '+i+'</label><select name="mapel[]" id="mapel"><option disabled selected>Pilih Mata Pelajaran</option>@foreach ($mapels as $mapel)<option value={{$mapel->id}}>{{$mapel->nama_mapel}}</option>@endforeach</select><button type="button" name="remove" id="'+i+'" class="btn_remove">X</button></div>');
            });

            $(document).on('click', '.btn_remove', function(){  
                var button_id = $(this).attr("id");   
                $('#row'+button_id+'').remove();  
            });
        });  
    </script>

    <!--MODAL AKUN GURU-->
    @foreach ($gurus as $guru)
        <div id="lihatGuruModal{{$guru->id}}" class="modal">
            <div class="modal-content">
                <div>
                    <b>Lihat Akun</b>
                    <div>
                        <p>Nama: {{$guru->nama}}</p>
                    </div>
                    
                    <div>
                        <p>NIP: {{$guru->nip}}</p>
                    </div>
        
                    <div>
                        <p>Tanggal Lahir: {{$guru->tgl_lahir}}</p>
                    </div>
        
                    <div>
                        <p>Jenis Kelamin: {{$guru->jenis_kelamin}}</p>
                    </div>
        
                    <div>
                        <p>Email: {{$guru->email}}</p>
                    </div>
        
                    <div>
                        <p>Kontak: {{$guru->kontak}}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="editGuruModal{{$guru->id}}" class="modal">
            <div class="modal-content">
                <div>
                    <b>Edit Akun Guru</b>
                    @if (session('status'))
                        <div>
                            {{session('status')}}
                        </div>
                    @endif
                    <form action="{{route('editAkun', $guru->id)}}" method="POST">
                        @csrf
            
                        <div>
                            <label>Nama</label>
                            <input type="text" name="nama" id="nama" value="{{$guru->nama}}">
                            @error('nama')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="">NIP</label>
                            <input type="text" name="nip" id="nip" value={{$guru->nip}}>
                            @error('nip')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{$guru->tgl_lahir}}">
                            @error('tgl_lahir')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <label>Jenis Kelamin</label>
                            <input type="radio" name="jenis_kelamin" value="Laki-laki" id="jenis_kelamin" @if ($guru->jenis_kelamin=="Laki-laki")
                                checked
                            @endif>
                            <label for="">Laki-Laki</label>
                            <input type="radio" name="jenis_kelamin" value="Perempuan" id="jenis_kelamin" @if ($guru->jenis_kelamin=="Perempuan")
                                checked
                            @endif>
                            <label for="">Perempuan</label>
                        </div>
            
                        <div>
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" value="{{$guru->email}}">
                            @error('email')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <label for="">Kontak</label>
                            <input type="text" name="kontak" id="kontak" value="{{$guru->kontak}}">
                            @error('kontak')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <label for="">Username</label>
                            <input type="text" name="username" id="username" value="{{$guru->username}}" disabled>
                            @error('username')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <label for="">Password</label>
                            <input type="password" name="password" id="password">
                            @error('password')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <input type="hidden" name="jenis_akun" id="jenis_akun" value=1>
                        </div>
            
                        <div>
                            <button type="submit">Edit Akun</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="hapusGuruModal{{$guru->id}}" class="modal">
            <div class="modal-content">
                <div>
                    <span>Delete Confirmation!</span>
                </div>
                <div>
                    <span>Apakah anda yakin akan menghapus?</span>
                </div>
                <div>
                    <a href="{{route('hapusakun', $guru->id)}}">
                        <button type="button">
                            Hapus
                        </button>
                    </a>
                    <button type="button" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    @endforeach
    
    <!--MODAL LIHAT AKUN SISWA-->
    @foreach ($siswas as $siswa)
        <div id="lihatSiswaModal{{$siswa->id}}" class="modal">
            <div class="modal-content">
                <div>
                    <b>Lihat Akun</b>
                    <div>
                        <p>Nama: {{$siswa->nama}}</p>
                    </div>

                    <div>
                        <p>NISN: {{$siswa->nisn}}</p>
                    </div>

                    <div>
                        <p>Kelas: @foreach ($kelass as $kelas)
                            {{$siswa->id_kelas == $kelas->id ? $kelas->tahun_kelas : ''}}
                        @endforeach</p>
                    </div>
        
                    <div>
                        <p>Tanggal Lahir: {{$siswa->tgl_lahir}}</p>
                    </div>
        
                    <div>
                        <p>Jenis Kelamin: {{$siswa->jenis_kelamin}}</p>
                    </div>
        
                    <div>
                        <p>Email: {{$siswa->email}}</p>
                    </div>
        
                    <div>
                        <p>Kontak: {{$siswa->kontak}}</p>
                    </div>
        
                    
                </div>
            </div>
        </div>
        
        <div id="editSiswaModal{{$siswa->id}}" class="modal">
            <div class="modal-content">
                <div>
                    <b>Edit Akun Siswa</b>
                    @if (session('status'))
                        <div>
                            {{session('status')}}
                        </div>
                    @endif
                    <form action="{{route('editAkun', $siswa->id)}}" method="POST">
                        @csrf
            
                        <div>
                            <label>Nama</label>
                            <input type="text" name="nama" id="nama" value="{{$siswa->nama}}">
                            @error('nama')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="">NISN</label>
                            <input type="text" name="nisn" id="nisn" value={{$siswa->nisn}}>
                            @error('nisn')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="">Kelas</label>
                            <select name="kelas" id="kelas">
                                @foreach ($kelass as $kelas)
                                    <option value={{$kelas->id}} {{$siswa->id_kelas == $kelas->id ? 'selected' : ''}}>{{$kelas->tahun_kelas}}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <div>
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{$siswa->tgl_lahir}}">
                            @error('tgl_lahir')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <label>Jenis Kelamin</label>
                            <input type="radio" name="jenis_kelamin" value="Laki-laki" id="jenis_kelamin" @if ($siswa->jenis_kelamin=="Laki-laki")
                                checked
                            @endif>
                            <label for="">Laki-Laki</label>
                            <input type="radio" name="jenis_kelamin" value="Perempuan" id="jenis_kelamin" @if ($siswa->jenis_kelamin=="Perempuan")
                                checked
                            @endif>
                            <label for="">Perempuan</label>
                        </div>
            
                        <div>
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" value="{{$siswa->email}}">
                            @error('email')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <label for="">Kontak</label>
                            <input type="text" name="kontak" id="kontak" value="{{$siswa->kontak}}">
                            @error('kontak')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <label for="">Username</label>
                            <input type="text" name="username" id="username" value="{{$siswa->username}}" disabled>
                            @error('username')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <label for="">Password</label>
                            <input type="password" name="password" id="password">
                            @error('password')
                                <div>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <input type="hidden" name="jenis_akun" id="jenis_akun" value=2>
                        </div>
            
                        <div>
                            <button type="submit">Edit Akun</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="hapusSiswaModal{{$siswa->id}}" class="modal">
            <div class="modal-content">
                <div>
                    <span>Delete Confirmation!</span>
                </div>
                <div>
                    <span>Apakah anda yakin akan menghapus?</span>
                </div>
                <div>
                    <a href="{{route('hapusakun', $siswa->id)}}">
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