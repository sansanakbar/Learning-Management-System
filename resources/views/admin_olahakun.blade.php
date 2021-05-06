@extends('admin_header')

@section('content')
    <div>
        <h3>Manajemen Akun</h3>
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
                    <td>Details</td>
                    <td>Edit</td>
                    <td>
                        <a href="">
                            Delete
                        </a>
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
                    <td>Details</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            @endforeach
        </table>
    </div>

    <hr>

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
                <input type="hidden" name="id" id="id" value="{{old('id')}}">
            </div>

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
                <select name="jenis_kelamin" id="jenis_kelamin" value="{{old('jenis_kelamin')}}">
                    <option disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
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

            <div>
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
                <select name="jenis_akun" id="jenis_akun" value="{{old('jenis_akun')}}">
                    <option disabled selected>Pilih Jenis Akun</option>
                    <option value=1>Guru</option>
                    <option value=2>Siswa</option>
                </select>
            </div>

            <p>------KALAU PILIH JENIS AKUN GURU------</p>
            <div>
                <label for="">NIP</label>
                <input type="text" name="nip" id="nip" value="{{old('nip')}}">
                @error('nip')
                    <div>
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Mata Pelajaran</label>
                <select name="mapel" id="mapel" value="{{old('mapel')}}">
                    @foreach ($mapels as $mapel)
                        <option value="{{$mapel->id}}">{{$mapel->nama_mapel}}</option>
                    @endforeach
                </select>
                <span>kalo bisa pake javasript fleksibel bisa tambah lebih dari satu mapel</span>
            </div>

            <p>------KALAU PILIH JENIS AKUN SISWA------</p>
            <div>
                <label for="">NISN</label>
                <input type="text" name="nisn" id="nisn" value="{{old('nisn')}}">
                @error('nisn')
                    <div>
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Kelas</label>
                <select name="kelas" id="kelas" value="{{old('kelas')}}">
                    @foreach ($kelass as $kelas)
                        <option value="{{$kelas->id}}">{{$kelas->tahun_kelas}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit">Buat Akun</button>
            </div>
        </form>
    </div>

    <hr>

    <div>

    </div>
@endsection