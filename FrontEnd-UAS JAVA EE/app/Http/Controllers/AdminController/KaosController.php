<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KaosController extends Controller
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
        public function showkaos(){
         $token = session('token');
         $user = $this->validate_token();
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token
         ])->get('http://localhost:8080/api/kaos/all');
         $kaos = $response->json();
         return view('pages.BAAK.Kaos.index',compact('kaos','user'));
     }
         public function Createkaos(Request $request){
             $token = session('token');
             $user = $this->validate_token();
             $response = Http::withHeaders([
                 'Authorization' => 'Bearer ' . $token,
               
             ])->post('http://localhost:8080/api/kaos/add',[
                 'ukuran' => $request->input('ukuran'),
                 'harga' => $request->input('harga'),
                 'keterangan' => $request->input('keterangan')

             ]);
     
     
             return redirect()->route('kaos_BAAK');
         }
     
         public function Editkaos(Request $request,$id){
             $token = session('token');
             $user = $this->validate_token();
             $response = Http::withHeaders([
                 'Authorization' => 'Bearer ' . $token,
               
             ])->put('http://localhost:8080/api/kaos/edit/'.$id ,[
                'ukuran' => $request->input('ukuran'),
                'harga' => $request->input('harga'),
                'keterangan' => $request->input('keterangan')
             ]);
     
     
             return redirect()->route('kaos_BAAK');
         }
     
         public function Deletekaos($id){
             $token = session('token');
             $user = $this->validate_token();
             $response = Http::withHeaders([
                 'Authorization' => 'Bearer ' . $token,
               
             ])->delete('http://localhost:8080/api/kaos/delete/'.$id);
             $success = $response->json()['success'];
     
             return redirect()->route('kaos_BAAK')->with('success',$success);
         }
        
    }
