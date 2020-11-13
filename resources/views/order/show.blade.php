<h2> Nama yang Pesan: </h2>
<p>{{ $order->nama }}</p>

<h3>Yang dipesan adalah:</h3>

<ul>
    @foreach($order->makanans as $mak)
    <li>{{ $mak->nama}}</li>
    @endforeach
</ul>