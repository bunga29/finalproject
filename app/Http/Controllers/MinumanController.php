<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Minuman;

class MinumanController extends Controller
{
   

    public function create(Request $request)
    {   
        $this->validate($request,[
            'nama' => 'required',
            'harga' => 'required',
        ]);

        $minuman_baru = new Minuman;
        
        $minuman_baru->nama = $request->nama;
        $minuman_baru->harga = $request->harga;
        
        $minuman_baru->save();

        return redirect('/listmakanan')->with('status', 'Minuman Ditambahkan');
    }

    public function edit(Request $request, $id)
    {   
        if($request->isMethod('post')){
            $data = $request->all();
            $minuman = Minuman::findOrFail($id);
            
            $minuman->update(['nama'=>$data['nama'], 'harga'=>$data['harga'],]);
    
            return redirect()->back()->with('status', 'Berhasil diubah');
        }
    }

    public function delete($id)
    {
        Minuman::where(['id'=>$id])->delete();
        return redirect()->back()->with('status', 'Berhasil dihapus');
    }
}
