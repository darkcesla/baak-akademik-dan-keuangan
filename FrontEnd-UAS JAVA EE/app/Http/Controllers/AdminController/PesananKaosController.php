<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PesananKaosController extends Controller
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
        public function showPesananKaos(){
         $token = session('token');
         $user = $this->validate_token();
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token,
         ])->get('http://localhost:8080/api/paymentkaos/all');
         if ($response->successful()) {
         $pemesanankaos = $response->json();
         return view('pages.BAAK.PemesananKaos.index',compact('pemesanankaos','user'));
         }
         else{
            $error = "Lakukan Login Sebelum memasuki halaman";
            return redirect()->route('vlogin')->with('error', $error);
        }

}

}
