@extends('layouts.app')

@section('content')
@if (session('status'))
        <div class="offset-md-1 col-md-3 alert alert-success">
            {{ session('status') }}
        </div>
@endif
<div class="container">
    <?php 
        $total=0;
        foreach($orders as $order){
            $total += $order->total;
        }
    ?>
    <div class="btn btn-danger m-2"> TOTAL PEMASUKAN: 
        <h2 class="m-0">Rp. {{$total}},00 </h2>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Waktu</th>
                <th scope="col">Nama</th>
                <th scope="col">Pesanan</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$order->updated_at}}</td>
                <td>{{$order->nama}}</td>
                <td>
                    
                        @foreach($order->makanans as $mak)
                            <p class="m-0">{{$mak->nama}}  ({{$mak->pivot->jumlah}})</p>
                        @endforeach
                        @foreach($order->minumans as $min)
                            <p>{{$min->nama}}  ({{$min->pivot->jumlah}})</p>
                        @endforeach
                    
                </td>
                <td>{{$order->total}}</td>
                <td>
                    @if($order->keterangan == "proses")
                        <strong class="text-danger">ON PROCESS</strong>
                    @else
                        <strong class="text-info">COMPLETE</strong>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection