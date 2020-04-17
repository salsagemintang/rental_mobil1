<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\jenis_model;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class jeniscontroller extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $dt_jenis=jenis_model::get();
            return response()->json($dt_jenis);

    }else{
        return response()->json(['status'=>'anda bukan admin']);
    }}

    public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama_jenis'=>'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=jenis_model::create([
            'nama_jenis'=>$req->nama_jenis,
        
        ]);
        
        if($simpan){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }
    
    public function tampil_jenis()
    {
        $data_jenis=jenis_model::count();
        $data_jenis1=jenis_model::all();
        return Response()->json(['count'=> $data_jenis, 'jenis'=> $data_jenis1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama_jenis'=>'required',
        
        ]);
        
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=jenis_model::where('id',$id)->update([
            'nama_jenis'=>$req->nama_jenis,
           
        ]);

        if($ubah){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Diubah!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }

    public function destroy($id)
    {
        $hapus=jenis_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}