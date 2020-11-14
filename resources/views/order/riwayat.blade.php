@extends('layouts.app')

@section('content')
@if (session('status'))
        <div class="offset-md-1 col-md-3 alert alert-success">
            {{ session('status') }}
        </div>
@endif
<div class="container">
    <button type="button" class="btn btn-success float-right mb-2" data-toggle="modal" data-target="#modalTambah">Tambah Makanan</button>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Waktu</th>
                <th scope="col">Nama</th>
                <th scope="col">Pesanan</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$order->updated_at}}</td>
                <td>{{$order->nama}}</td>
                <td>
                    <ul>
                        @foreach($order->makanans as $mak)
                            <li>{{$mak->nama}}  ({{$mak->pivot->jumlah}})</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{$order->total}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection