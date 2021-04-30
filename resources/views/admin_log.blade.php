@extends('admin_header')

@section('content')
    <div>
        <h3>Log Data</h3>
    </div>
    <div>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Waktu</td>
                <td>Fungsi</td>
                <td>ID Pengguna</td>
            </tr>
            @foreach ($logs as $log)
                <tr align="center">
                    <td>{{ $no++ }}</td>
                    <td>{{$log->date}}</td>
                    <td>{{$log->function}}</td>
                    <td>{{$log->user_id}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection