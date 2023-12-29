<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class IzinKeluarUserController extends Controller
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
        public function showIzinKeluar(){
         $token = session('token');
         $user = $this->validate_token();
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token,
         ])->get('http://localhost:8080/api/izinkeluar/alls');
         if ($response->successful()) {
         $izinkeluar = $response->json();
         return view('pages.Mahasiswa.IzinKeluar.index',compact('izinkeluar','user'));
         }
         else{
            $error = "Lakukan Login Sebelum memasuki halaman";
            return redirect()->route('vlogin')->with('error', $error);
        }

     }
     public function AddIzinKeluar(Request $request){
        $token = session('token');
        $user = $this->validate_token();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://localhost:8080/api/izinkeluar/add',[
            'keterangan' => $request->input('keterangan'),
            'waktuKembali' => $request->input('waktuKembali'),
            'waktuBerangkat' => $request->input('waktuBerangkat')
        ]);
        if ($response->successful()) {
        $izinkeluar = $response;
        return redirect()->route('IK_Mahasiswa');
        }
        else{
           $error = "Gagal Request IK , Periksa Waktu Keberangkatan dan Waktu Kembali Anda";
           return back()->with('error', $error);
       }
     }
     public function Cancaled($id)
     {
         $token = session('token');
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token
         ])->put('http://localhost:8080/api/izinkeluar/changestatus/'. $id, [
             'status' => "Canceled"
         ]);
     
         if ($response->successful()) {
             return redirect()->route('IK_Mahasiswa')->with('success', 'Berhasil Membatalkan Request Izin Keluar');
         } else {
             return redirect()->route('IK_Mahasiswa')->with('error', 'Gagal Membatalkan Request Izin Keluar');
         }
     }


}
