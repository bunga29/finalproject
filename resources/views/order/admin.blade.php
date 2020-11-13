@extends('layouts.app')

@section('content')
@if (session('status'))
        <div class="offset-md-1 col-md-3 alert alert-success">
            {{ session('status') }}
        </div>
@endif
<div class="container">
    <table class="table">
    <thead class="thead-light">
        <tr>
        <th scope="col">Antrian</th>
        <th scope="col">Nama</th>
        <th scope="col">Pesanan</th>
        <th scope="col">Hapus</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <th scope="row">{{ $loop->iteration}}</th>
            <td>{{ $order->nama}}</td>
            <td>
                <ul>
                @foreach($order->makanans as $mak)
                    <li>{{$mak->nama}} ({{$mak->pivot->jumlah}}) </li>
                @endforeach
                </ul>
            </td>
            <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$order->id}}">Hapus kalo udah jadi</button>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>

<!-- MODAL DELETE ORDER -->
@foreach($orders as $data)
<div class="modal fade" id="deleteModal-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready gan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <h4 class="text-center">Apakah makanan udah ready? </h4>
        <ul>
            @foreach($data->makanans as $mak)
                <li> {{$mak->nama}} ({{$mak->pivot->jumlah}})</li>
            @endforeach
        </ul>
      </div>  
      <div class="modal-footer">
        <form action=" {{ url('/deleteorder/'. $data->id) }} " method="post">    
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-primary">Ready gan!</button>
        </form> 
        <button type="button" class="btn btn-secondary" data-dismiss="modal">eh, masih kurang</button>
      </div>  
        
       
    </div>
  </div>
</div>
@endforeach

@endsection