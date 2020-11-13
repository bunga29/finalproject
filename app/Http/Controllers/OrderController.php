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
        $order_baru = new Order();
        
        $order_baru->nama = request('nama');
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
        
       
        //dd($order_baru->makanans);
        return redirect()->route('order.bayar', ['id' => $order_baru->id]);
    }

    public function deletee($id)
    {
        Order::where(['id'=>$id])->delete();
        return redirect()->route('order.list')->with('status', 'Ayo pesenn!!');
    }

    public function delete($id)
    {
        Order::where(['id'=>$id])->delete();
        return redirect()->back()->with('status', 'Yok lanjut orderan selanjutnya!');
    }


}
