<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class BookingController extends Controller
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
             'Authorization' => 'Bearer ' . $token
         ])->get('http://localhost:8080/api/booking/all');
         $Booking = $response->json();
         return view('pages.BAAK.Booking.index',compact('Booking','user'));
     }
     public function Approve($id)
{
    $token = session('token');
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token
    ])->put('http://localhost:8080/api/booking/changestatus/' . $id, [
        'status' => "Approve"
    ]);

    if ($response->successful()) {
        // Pesan berhasil diubah
        return redirect()->route('Booking_BAAK')->with('success', 'Status berhasil diubah');
    } else {
        return redirect()->route('Booking_BAAK')->with('error', 'Gagal mengubah status');
    }
}
public function Rejected($id)
{
    $token = session('token');
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token
    ])->put('http://localhost:8080/api/booking/changestatus/' . $id, [
        'status' => "Rejected"
    ]);

    if ($response->successful()) {
        // Pesan berhasil diubah
        return redirect()->route('Booking_BAAK')->with('success', 'Status berhasil diubah');
    } else {
        return redirect()->route('Booking_BAAK')->with('error', 'Gagal mengubah status');
    }
}


    

        
     
     
     
}
