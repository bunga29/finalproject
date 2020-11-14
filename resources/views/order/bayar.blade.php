@extends('layouts.app')

@section('content')
@if (session('status'))
        <div class="offset-md-1 col-md-3 alert alert-success">
            {{ session('status') }}
        </div>
@endif
<div class="container">
    <h1>Bayar yuk</h1>
    <table class="table col-md-8">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Makanan</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $total=0;
                $i=1;
                foreach($order->makanans as $mak){
                    $tot= $mak->pivot->jumlah * $mak->harga;
                    echo
                    "<tr>
                        <th>{$i}</th>
                        <td>{$mak->nama}</td>
                        <td>{$mak->harga}</td>
                        <td>{$mak->pivot->jumlah }</td>
                        <td>{$tot} </td>
                        
                    </tr>";
                    $i++;
                    $total = $total + $tot;
                }
            ?>
            <tr>
                <td colspan="4"  class="text-center"><strong>TOTAL</strong></td>
                <td><strong>{{$total}}</strong></td>
            </tr>
            
        </tbody>
    </table>

    <div class="row offset-md-6">
        <form action=" {{url('/deleteeorder/'. $order->id)}}" method="post">    
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-secondary p-2">Batal deh</button>
        </form> 
        <a href="/listorder" class="btn btn-primary ml-2 p-2">OK</a>
    </div>
    
    
    
</div>


@endsection