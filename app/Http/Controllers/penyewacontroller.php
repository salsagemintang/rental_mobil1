<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\penyewa_model;
use JWTAuth;
use DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class penyewacontroller extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $dt_penyewa=penyewa_model::get();
            return response()->json($dt_penyewa);

    }else{
        return response()->json(['status'=>'anda bukan admin']);
    }
    }
    public function store(Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama_penyewa'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'no_ktp'=>'required',
            'foto'=>'required',
        ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=penyewa_model::create([
            'nama_penyewa'=>$req->nama_penyewa,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            'no_ktp'=>$req->no_ktp,
            'foto'=>$req->foto,
        ]);
        if($simpan){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Ditambahkan!"]);
        } else{
            return Response()->json(['status'=>0]);
        }
    }
    
    public function tampil_penyewa()
    {
        $data_penyewa=penyewa_model::count();
        $data_penyewa1=penyewa_model::all();
        return Response()->json(['count'=> $data_penyewa, 'penyewa'=> $data_penyewa1, 'status'=>1]);
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama_penyewa'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'no_ktp'=>'required',
            'foto'=>'required',
        ]);
        
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=penyewa_model::where('id',$id)->update([
            'nama_penyewa'=>$req->nama_penyewa,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            'no_ktp'=>$req->no_ktp,
            'foto'=>$req->foto,
        ]);
        if($ubah){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Diubah!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }

    public function destroy($id)
    {
        $hapus=penyewa_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>1, 'message'=>"Data Berhasil Dihapus!"]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
