<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\mobil_model;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class mobilcontroller extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $dt_mobil=mobil_model::get();
            return response()->json($dt_mobil);

    }else{
        return response()->json(['status'=>'anda bukan admin']);
    }}

    public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'plat_nomor'=>'required',
            'merk'=>'required',
            'foto'=>'required',
            'keterangan'=>'required',
        
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=mobil_model::create([
            'plat_nomor'=>$req->plat_nomor,
            'merk'=>$req->merk,
            'foto'=>$req->foto,
            'keterangan'=>$req->keterangan,
        
        ]);
        if($simpan){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }
    
    public function tampil_mobil()
    {
        $data_mobil=mobil_model::count();
        $data_mobil1=mobil_model::all();
        return Response()->json(['count'=> $data_mobil, 'mobil'=> $data_mobil1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'plat_nomor'=>'required',
            'merk'=>'required',
            'foto'=>'required',
            'keterangan'=>'required',
        
        ]);
        
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=mobil_model::where('id',$id)->update([
            'plat_nomor'=>$req->plat_nomor,
            'merk'=>$req->merk,
            'foto'=>$req->foto,
            'keterangan'=>$req->keterangan,
            
        ]);

        if($ubah){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Diubah!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }

    public function destroy($id)
    {
        $hapus=mobil_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
