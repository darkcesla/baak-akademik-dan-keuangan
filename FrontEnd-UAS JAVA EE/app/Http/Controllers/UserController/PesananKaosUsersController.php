<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PesananKaosUsersController extends Controller
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
         ])->get('http://localhost:8080/api/paymentkaos/alls');
         if ($response->successful()) {
         $pemesanankaos = $response->json();
         return view('pages.Mahasiswa.PesananKaos.index',compact('pemesanankaos','user'));
         }
         else{
            $error = "Lakukan Login Sebelum memasuki halaman";
            return redirect()->route('vlogin')->with('error', $error);
        }
    }

    public function showkaos(){
        $token = session('token');
        $user = $this->validate_token();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('http://localhost:8080/api/kaos/all');
        $kaos = $response->json();
        return view('pages.Mahasiswa.PaymentKaos.index',compact('kaos','user'));
    }

    public function AddPaymentKaos(Request $request){
        $token = session('token');
        $user = $this->validate_token();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://localhost:8080/api/paymentkaos/add',[
            'nominal_pembayaran' => $request->input('nominal_pembayaran'),
            'jenis_pembayaran' => $request->input('jenis_pembayaran'),
            'kaos' =>  [
                'id' => $request->input('kaos_id')]
        ]);
        if ($response->successful()) {
        $izinBermalam = $response;
        return redirect()->route('PaymentKaos');
        }
        if ($response->json()['failed'] != null){
            $error = $response->json()['failed'];
            return back()->with('error', $error);
        }
        else{
           $error = "Gagal Memesan";
           return back()->with('error', $error);
       }
     }

}
