@extends('layouts.app')

@section('content')
@if (session('status'))
        <div class="offset-md-1 col-md-3 alert alert-success">
            {{ session('status') }}
        </div>
@endif


<div class="container">
    <button type="button" class="btn btn-success float-left mb-2" data-toggle="modal" data-target="#modalOrder">Order pencet</button>
    @foreach ($orders as $order)
    <div class="row">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$order->nama}}</h5>
                <a href="{{url('/listorder/'.$order->id)}}" class="btn btn-info"> Lihat</a>
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalPesanan{{$order->id}}">
                    Lihat Pesanan
                </button> -->
            </div>
        </div>
    @endforeach
    </div>
</div>

<!-- MODAL Order -->
<div class="modal fade" id="modalOrder" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pesan Yuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM TAMBAH BARANG-->
                <form action="{{ action('OrderController@create') }}" method="post">
                   @csrf
                   <label for="">Namamu siapaa?</label>
                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp">
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
                                <td><input type="hidden" name="id_mak[]" value="{{$makan->id}}">
                                    <input type="number" class='jumlah' name="jumlah_mak[]" value="0" min="0" max="100" step="1"/>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="total float-right">
                        <strong>Total</strong>
                        <span class="total-harga">0</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <!--END FORM TAMBAH BARANG-->

                
            </div>
        </div>
    </div>
</div>

<script>
// console.log("halo");
function updateharga(){
    var item_makanan = document.getElementByClassName('jumlah');
    console.log("haloo");
}  
</script> 

@endsection
