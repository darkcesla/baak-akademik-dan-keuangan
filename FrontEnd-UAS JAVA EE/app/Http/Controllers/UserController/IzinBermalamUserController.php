<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;


class IzinBermalamUserController extends Controller
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
        public function showIzinBermalam(){
         $token = session('token');
         $user = $this->validate_token();
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token,
         ])->get('http://localhost:8080/api/izinbermalam/alls');
         if ($response->successful()) {
         $izinbermalam = $response->json();
         return view('pages.Mahasiswa.IzinBermalam.index',compact('izinbermalam','user'));
         }
         else{
            $error = "Lakukan Login Sebelum memasuki halaman";
            return redirect()->route('vlogin')->with('error', $error);
        }

     }
     public function AddIzinBermalam(Request $request){
        $token = session('token');
        $user = $this->validate_token();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://localhost:8080/api/izinbermalam/add',[
            'keterangan' => $request->input('keterangan'),
            'waktuKembali' => $request->input('waktuKembali'),
            'waktuBerangkat' => $request->input('waktuBerangkat'),
            'tujuan' => $request->input('tujuan')
        ]);
        if ($response->successful()) {
        $izinBermalam = $response;
        return redirect()->route('IB_Mahasiswa');
        }
        if (isset($responseData['failed'])){
            $error = $response->json()['failed'];
            return back()->with('error', $error);
        }
        else{
           $error = "Gagal Request IB , Periksa Waktu Keberangkatan dan Waktu Kembali Anda";
           return back()->with('error', $error);
       }
     }
     public function Canceled($id)
     {
         $token = session('token');
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token
         ])->put('http://localhost:8080/api/izinbermalam/changestatus/' . $id, [
             'status' => "Canceled"
         ]);
     
         if ($response->successful()) {
             return redirect()->route('IB_Mahasiswa')->with('success', 'Status berhasil diubah');
         } else {
             return redirect()->route('IB_Mahasiswa')->with('error', 'Gagal mengubah status');
         }
     }



     public function generatePDF($id)
     {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://localhost:8080/api/izinbermalam/get/'.$id);
        if ($response->successful()) {
        $data = $response->json();
         // Render view ke dalam HTML
         $html = view('pages.Mahasiswa.IzinBermalam.laporan', compact('data'))->render();
     
         // Konfigurasi Dompdf
         $options = new Options();
         $options->set('defaultFont', 'Arial'); // Atur font default jika diperlukan
     
         // Inisialisasi Dompdf dengan opsi
         $dompdf = new Dompdf($options);
         
         // Muat HTML ke Dompdf
         $dompdf->loadHtml($html);
         
         // Render PDF
         $dompdf->render();
     
         // Tampilkan PDF di browser
         return $dompdf->stream('laporan.pdf');
        }
        else {
            return redirect()->route('IB_Mahasiswa')->with('error', 'Gagal mengubah status');
        }
     }

     



}
