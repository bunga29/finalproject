@extends('layouts.app')

@section('content')
@if (session('status'))
        <div class="offset-md-1 col-md-3 alert alert-success">
            {{ session('status') }}
        </div>
@endif

<!-- LIST MAKANAN -->
<div class="container">
    <h2>LIST MAKANAN</h2>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Makanan</th>
                <th scope="col">Harga</th>
                <th scope="col">Lain-lain</th>
            </tr>
        </thead>
        <tbody>
            @foreach($makanan as $makan)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$makan->nama}}</td>
                <td>{{$makan->harga}}</td>
                <td class="text-center"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal-{{$makan->id}}">edit</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$makan->id}}">hapus</button>
                </td>
            </tr>
            @endforeach
            <tr>
              <td colspan="4"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambah">Tambah Makanan</button> </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- LIST MINUMAN-->
<div class="container">
    <h2>LIST MINUMAN</h2>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Minuman</th>
                <th scope="col">Harga</th>
                <th scope="col">Lain-lain</th>
            </tr>
        </thead>
        <tbody>
            @foreach($minuman as $minum)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$minum->nama}}</td>
                <td>{{$minum->harga}}</td>
                <td class="text-center"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editMinum-{{$minum->id}}">edit</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteMinum-{{$minum->id}}">hapus</button>
                </td>
            </tr>
            @endforeach
            <tr>
              <td colspan="4"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#minumTambah">Tambah Minuman</button> </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- MODAL TAMBAH MAKANAN -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Makanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM TAMBAH BARANG-->
                <form action="{{ action('MakananController@create') }}" method="post">
                   @csrf
                    <div class="form-group">
                        <label for="">Nama Makanan</label>
                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Makanan</label>
                        <input type="text" class="form-control" id="harga" name="harga">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <!--END FORM TAMBAH BARANG-->
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT MAKANAN --> 
@foreach($makanan as $data)
<div class="modal fade" id="editModal-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Makanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action=" {{ url('/edit/'. $data->id) }} " method="POST">    
            @csrf
            <div class="form-group">
                <label>Nama Makanan</label>
                <input type="text" class="form-control" name="nama" value="{{$data->nama}}">
            </div>
            <div class="form-group">
                <label>Harga Makanan</label>
                <input type="text" class="form-control" name="harga" value="{{$data->harga}}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form> 
      </div>   
    </div>
  </div>
</div>
@endforeach

<!-- MODAL DELETE MAKANAN --> 
@foreach($makanan as $data)
<div class="modal fade" id="deleteModal-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <h4 class="text-center">Apakah anda yakin menghapus <strong>{{$data->nama}}</strong>? </h4>
      </div>  
      <div class="modal-footer">
        <form action=" {{ url('/delete/'. $data->id) }} " method="post">    
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Hapus!</button>
        </form> 
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak Jadi</button>
      </div>  
        
       
    </div>
  </div>
</div>
@endforeach


<!-- MODAL TAMBAH MINUMAN -->
<div class="modal fade" id="minumTambah" tabindex="-1" aria-labelledby="minumTambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Minuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ action('MinumanController@create') }}" method="post">
                   @csrf
                    <div class="form-group">
                        <label for="">Nama Minuman</label>
                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Minuman</label>
                        <input type="text" class="form-control" id="harga" name="harga">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT MINUMAN--> 
@foreach($minuman as $data)
<div class="modal fade" id="editMinum-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Makanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action=" {{ url('/editminum/'. $data->id) }} " method="POST">    
            @csrf
            <div class="form-group">
                <label>Nama Minuman</label>
                <input type="text" class="form-control" name="nama" value="{{$data->nama}}">
            </div>
            <div class="form-group">
                <label>Harga Minuman</label>
                <input type="text" class="form-control" name="harga" value="{{$data->harga}}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form> 
      </div>   
    </div>
  </div>
</div>
@endforeach

<!-- MODAL DELETE MAKANAN --> 
@foreach($minuman as $data)
<div class="modal fade" id="deleteMinum-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <h4 class="text-center">Apakah anda yakin menghapus <strong>{{$data->nama}}</strong>? </h4>
      </div>  
      <div class="modal-footer">
        <form action=" {{ url('/deleteminum/'. $data->id) }} " method="post">    
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Hapus!</button>
        </form> 
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak Jadi</button>
      </div>  
        
       
    </div>
  </div>
</div>
@endforeach

@endsection
