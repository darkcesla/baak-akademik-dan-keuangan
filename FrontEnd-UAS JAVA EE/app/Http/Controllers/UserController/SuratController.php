<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuratController extends Controller
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
        public function showSurat(){
         $token = session('token');
         $user = $this->validate_token();
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token,
         ])->get('http://localhost:8080/api/surat/alls');
         if ($response->successful()) {
         $surat = $response->json();
         return view('pages.Mahasiswa.Surat.index',compact('surat','user'));
         }
         else{
            $error = "Lakukan Login Sebelum memasuki halaman";
            return redirect()->route('vlogin')->with('error', $error);
        }

     }


     public function AddSurat(Request $request){
        $token = session('token');
        $user = $this->validate_token();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://localhost:8080/api/surat/create',[
            'topic' => $request->input('topic'),
            'keterangan_surat' => $request->input('keterangan_surat')
        ]);
        if ($response->successful()) {
        $izinBermalam = $response;
        return redirect()->route('Surat_Mahasiswa');
        }
        if ($response->json()['failed'] != null){
            $error = $response->json()['failed'];
            return back()->with('error', $error);
        }
        else{
           $error = "Gagal Membuat Surat , Periksa Surat Anda";
           return back()->with('error', $error);
       }
     }
     public function Canceled($id)
     {
         $token = session('token');
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token
         ])->put('http://localhost:8080/api/surat/status/' . $id, [
             'status' => "Canceled"
         ]);
            return redirect()->route('Surat_Mahasiswa')->with('success', 'Status berhasil diubah');
     }

     
}
