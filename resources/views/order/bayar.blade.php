@extends('layouts.app')

@section('content')
@if (session('status'))
        <div class="offset-md-1 col-md-3 alert alert-success">
            {{ session('status') }}
        </div>
@endif
<div class="container">
    <h1>Bayar yuk</h1>
    <table class="table">
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
            
        </tbody>
    </table>

    
    <a href="/listorder" class="btn btn-primary">OK</a>
    <form action=" {{url('/deleteeorder/'. $order->id)}}" method="post">    
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-secondary">eh gajadi deh</button>
    </form> 
    
    <h2>total = {{$total}}</h2>
</div>


@endsection