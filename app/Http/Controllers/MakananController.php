<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Makanan;
class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data
        $makanan = DB::table('makanans')->get();

        return view('makanan.list', ['makanan' => $makanan]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $this->validate($request,[
            'nama' => 'required',
            'harga' => 'required',
        ]);

        $makanan_baru = new Makanan;
        
        $makanan_baru->nama = $request->nama;
        $makanan_baru->harga = $request->harga;
        
        $makanan_baru->save();

        return redirect('/listmakanan')->with('status', 'Makanan Ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {   
        if($request->isMethod('post')){
            $data = $request->all();
            $makanan = Makanan::findOrFail($id);
            
            $makanan->update(['nama'=>$data['nama'], 'harga'=>$data['harga'],]);
    
            return redirect()->back()->with('status', 'Berhasil diubah');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Makanan::where(['id'=>$id])->delete();
        return redirect()->back()->with('status', 'Berhasil dihapus');
    }

}
