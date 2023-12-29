<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class RuanganUserController extends Controller
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
   public function showBooking(){
    $token = session('token');
    $user = $this->validate_token();
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->get('http://localhost:8080/api/booking/alls');
    if ($response->successful()) {
    $booking = $response->json();
    return view('pages.Mahasiswa.Booking.index',compact('booking','user'));
    } else{
        $error = "Lakukan Login Sebelum memasuki halaman";
        return redirect()->route('vlogin')->with('error', $error);
    }
}

public function AddBooking(Request $request){
    $token = session('token');
    $user = $this->validate_token();
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('http://localhost:8080/api/booking/add',[
        'keperluan' => $request->input('keterangan'),
        'odate' => $request->input('waktuMulai'),
        'cdate' => $request->input('waktuSelesai'),
        'ruangan' =>  [
            'id' => $request->input('ruangan_id')]
    ]);
    if ($response->successful()) {
    $izinBermalam = $response;
    return redirect()->route('Booking_Mahasiswa');
    }
    if (isset($response['failed'])){
        $error = $response->json()['failed'];
        return back()->with('error', $error);
    }
    else{
       $error = "Gagal Request Add Booking , Periksa Waktu Keberangkatan dan Waktu Kembali Anda";
       return back()->with('error', $error);
   }
 }
 public function Canceled($id)
 {
     $token = session('token');
     $response = Http::withHeaders([
         'Authorization' => 'Bearer ' . $token
     ])->put('http://localhost:8080/api/booking/changestatus/' . $id, [
         'status' => "Canceled"
     ]);
 
     if ($response->successful()) {
         return redirect()->route('Booking_Mahasiswa')->with('success', 'Status berhasil diubah');
     } else {
         return redirect()->route('Booking_Mahasiswa')->with('error', 'Gagal mengubah status');
     }
 }
}
