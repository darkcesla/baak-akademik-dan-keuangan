<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class IzinBermalamController extends Controller
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
        public function showIB(){
         $token = session('token');
         $user = $this->validate_token();
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token,
         ])->get('http://localhost:8080/api/izinbermalam/all');
         if ($response->successful()) {
         $izinbermalam = $response->json();
         return view('pages.BAAK.IzinBermalam.index',compact('izinbermalam','user'));
         }
         else{
            $error = "Lakukan Login Sebelum memasuki halaman";
            return redirect()->route('vlogin')->with('error', $error);
        }

     }
   
     public function Approve($id)
     {
         $token = session('token');
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token
         ])->put('http://localhost:8080/api/izinbermalam/changestatus/' . $id, [
             'status' => "Approve"
         ]);
     
         if ($response->successful()) {
             return redirect()->route('IB_BAAK')->with('success', 'Status berhasil diubah');
         } else {
             return redirect()->route('IB_BAAK')->with('error', 'Gagal mengubah status');
         }
     }
     public function Rejected($id)
     {
         $token = session('token');
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token
         ])->put('http://localhost:8080/api/izinbermalam/changestatus/' . $id, [
             'status' => "Rejected"
         ]);
     
         if ($response->successful()) {
             return redirect()->route('IB_BAAK')->with('success', 'Status berhasil diubah');
         } else {
             return redirect()->route('IB_BAAK')->with('error', 'Gagal mengubah status');
         }
     }
}
