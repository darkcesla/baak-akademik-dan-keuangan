<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
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
        public function showUser(){
         $token = session('token');
         $user = $this->validate_token();
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token
         ])->get('http://localhost:8080/api/users/mahasiswa/all');
         $users = $response->json();
         return view('pages.BAAK.Mahasiswa.index',compact('user','users'));
     }
     
     
         public function EditUser(Request $request,$id){
             $token = session('token');
             $user = $this->validate_token();
             $response = Http::withHeaders([
                 'Authorization' => 'Bearer ' . $token,
               
             ])->put('http://localhost:8080/api/users/mahasiswa/edit/'.$id ,[
                'nomor_Handphone' =>  $request->input('noHandphone'),
                'nama_Lengkap'=>  $request->input('nama_lengkap'),
                'nomor_KTP'=>  $request->input('NIK'),
                'nim' => $request->input('nim')
             ]);
     
     
             return redirect()->route('User_BAAK');
         }
     
         public function DeleteUser($id){
             $token = session('token');
             $user = $this->validate_token();
             $response = Http::withHeaders([
                 'Authorization' => 'Bearer ' . $token,
               
             ])->delete('http://localhost:8080/api/users/mahasiswa/delete/'.$id);
             $success = "Berhasil Menghapus data mahasiswa";
     
             return redirect()->route('User_BAAK')->with('success',$success);
         }}
