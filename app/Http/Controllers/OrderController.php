<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Makanan;

class OrderController extends Controller
{
    public static function index()
    {
        //mengambil data
        $makanan = Makanan::get();
        $orders = Order::get();
     
        return view('order.list', ['orders' => $orders, 'makanan' => $makanan]);
    }

    public static function riwayat()
    {
        //mengambil data
        $makanan = Makanan::get();
        $orders = Order::get();
     
        return view('order.riwayat', ['orders' => $orders, 'makanan' => $makanan]);
    }

    public static function admin()
    {
        //mengambil data
        $makanan = Makanan::get();
        $orders = Order::get();
     
        return view('order.admin', ['orders' => $orders, 'makanan' => $makanan]);
    }

    public function bayar($id)
    {
        $order = Order::findOrFail($id);

        return view('order.bayar', ['order' => $order]);
    }

    public function create(Request $request)
    {   
        //dd($request->all());
        $order_baru = new Order();
        
        $order_baru->nama = request('nama');
        
        $order_baru->keterangan = request('keterangan');
        $order_baru->total = request('total');
        $order_baru->save();
        $order_temp = new Order();
        $order_temp->id_mak = request('id_mak');
        $order_temp->jumlah_mak = request('jumlah_mak');
        
        
        $i=0;
        foreach($order_temp->jumlah_mak as $jumlah){
            if($jumlah != 0){
                $id= $order_temp->id_mak[$i];
                $jumlah = $order_temp->jumlah_mak[$i];
                $makanan = Makanan::find($id);
                
                $order_baru->makanans()->attach($id, ['jumlah'=>$jumlah]);
            }
            $i++;
        }
       
        //dd($order_baru);
        return redirect()->route('order.bayar', ['id' => $order_baru->id]);
    }


    public function delete($id)
    {
        Order::where(['id'=>$id])->delete();
        return redirect()->back()->with('status', 'Yok lanjut orderan selanjutnya!');
    }

    public function total(Request $request, $id)
    {   
        if($request->isMethod('post')){
            $data = $request->all();
            $order = Order::findOrFail($id);
            
            $order->update(['total'=>$data['total']]);
            
            return redirect()->route('order.list')->with('status', 'Mohon ditunggu ya lorr');
        }
    }

    public function complete(Request $request, $id)
    {   
        if($request->isMethod('post')){
            $data = $request->all();
            $order = Order::findOrFail($id);
            
            $order->update(['keterangan'=>$data['keterangan']]);
            
            return redirect()->route('order.admin')->with('status', 'Selanjutnya yok');
        }
    }


}
