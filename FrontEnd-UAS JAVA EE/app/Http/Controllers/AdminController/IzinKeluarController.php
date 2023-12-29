<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class IzinKeluarController extends Controller
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
        public function showIK(){
         $token = session('token');
         $user = $this->validate_token();
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token,
         ])->get('http://localhost:8080/api/izinkeluar/all');
         if ($response->successful()) {
         $izinkeluar = $response->json();
         return view('pages.BAAK.IzinKeluar.index',compact('izinkeluar','user'));
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
         ])->put('http://localhost:8080/api/izinkeluar/changestatus/' . $id, [
             'status' => "Approve"
         ]);
     
         if ($response->successful()) {
             return redirect()->route('IK_BAAK')->with('success', 'Status berhasil diubah');
         } else {
             return redirect()->route('IK_BAAK')->with('error', 'Gagal mengubah status');
         }
     }
     public function Rejected($id)
     {
         $token = session('token');
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token
         ])->put('http://localhost:8080/api/izinkeluar/changestatus/' . $id, [
             'status' => "Rejected"
         ]);
     
         if ($response->successful()) {
             return redirect()->route('IK_BAAK')->with('success', 'Status berhasil diubah');
         } else {
             return redirect()->route('IK_BAAK')->with('error', 'Gagal mengubah status');
         }
     }

    }
