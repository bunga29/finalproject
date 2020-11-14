@extends('layouts.app')

@section('content')
@if (session('status'))
        <div class="offset-md-1 col-md-3 alert alert-success">
            {{ session('status') }}
        </div>
@endif


<div class="container">
    <div class="row">
        <button type="button" class="border-info ml-2 btn btn-success" data-toggle="modal" data-target="#modalOrder" style="font-size:30px; width: 18rem;">
            PESAN DISINI
        </button>
        @foreach ($orders as $order)
            @if($order->keterangan == "proses")
            <div class="card border-info ml-2" style="width: 18rem;">
                <div class="card-header text-center" style="font-size:20px;">
                    <strong>{{$order->nama}}</strong>
                    <h5 class="text-center p-1 mt-1">{{$loop->iteration}} antrian lagi ya..</h5>
                </div>
                
                <ul class="list-group list-group-flush">
                        @foreach($order->makanans as $mak)
                        <li class="list-group-item">{{$mak->nama}}</li>
                        @endforeach
                </ul>
            </div>
            @endif
        @endforeach
    </div>
</div>

<!-- MODAL tambah Order -->
<div class="modal fade" id="modalOrder" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pesan Yuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM TAMBAH Order-->
                <form action="{{ action('OrderController@create') }}" method="post">
                   @csrf
                   <label>Nama Pemesan</label>
                        <input type="text" class="form-control mb-2" id="nama" name="nama" aria-describedby="emailHelp">
                    <h3>List Makanan</h3>
                   <table class="mt-2 table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Makanan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($makanan as $makan)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$makan->nama}}</td>
                                <td>{{$makan->harga}}</td>
                                <td><input type="hidden" name="keterangan" value="proses">
                                    <input type="hidden" name="id_mak[]" value="{{$makan->id}}">
                                    <input type="hidden" name="harga_mak[]" value="{{$makan->harga}}">
                                    <input type="number" name="jumlah_mak[]" value="0" min="0" max="100" step="1"/>
                                    <input type="hidden" name="total" value="0">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                    <button type="submit" class="btn btn-primary float-right">Lanjutkan Bayar</button>
                </form>
                <!--END FORM TAMBAH Order-->
            </div>
        </div>
    </div>
</div>




@endsection
