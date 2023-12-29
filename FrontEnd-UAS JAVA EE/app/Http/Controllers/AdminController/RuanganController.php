<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class RuanganController extends Controller
{
    public function validate_token(){
   // Ambil token dari form atau dari sesi login (sesuai kebutuhan)
   $token = session('token');
   $response = Http::withHeaders([
       'Authorization' => 'Bearer ' . $token
   ])->get('http://localhost:8080/api/users/validate-token');
   $user = $response->json()['user'];
   return $user;
 
   }
   public function showRuangan(){
    $token = session('token');
    $user = $this->validate_token();
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token
    ])->get('http://localhost:8080/api/ruangan/all');
    $ruangan = $response->json();
    return view('pages.BAAK.ruang.index',compact('ruangan','user'));
}
    public function CreateRuangan(Request $request){
        $token = session('token');
        $user = $this->validate_token();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
          
        ])->post('http://localhost:8080/api/ruangan/add',[
            'nama_ruangan' => $request->input('nama_ruangan'),
            'kapasitas' => $request->input('kapasitas')
        ]);


        return redirect()->route('Ruangan_BAAK');
    }

    public function EditRuangan(Request $request,$id){
        $token = session('token');
        $user = $this->validate_token();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
          
        ])->put('http://localhost:8080/api/ruangan/edit/'.$id ,[
            'nama_ruangan' => $request->input('nama_ruangan'),
            'kapasitas' => $request->input('kapasitas')
        ]);


        return redirect()->route('Ruangan_BAAK');
    }

    public function DeleteRuangan($id){
        $token = session('token');
        $user = $this->validate_token();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
          
        ])->delete('http://localhost:8080/api/ruangan/delete/'.$id);
        $success = $response->json()['succes'];

        return redirect()->route('Ruangan_BAAK')->with('success',$success);
    }
}
