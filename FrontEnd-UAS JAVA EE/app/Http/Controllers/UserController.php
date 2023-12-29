<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // Lakukan HTTP POST request ke endpoint /login pada RESTful API
        $response = Http::post('http://localhost:8080/api/users/login', [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ]);

    if ($response->successful()) {

        $token = $response->json()['user']['token'];
        
        $response2 = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('http://localhost:8080/api/users/validate-token');
        session(['token' => $token]);
        $user = $response2['user'];
        if($user['roles'] == "Admin") {
            return redirect()->route('dashboard_BAAK');
        }
        if($user['roles'] = "Mahasiswa"){
            return redirect()->route('dashboard_Mahasiswa');
        }
        else{
            $error =$response['error'];
            return back()->with('error',$error);
        }
    }
    else{
        $error =$response['error'];
        return back()->with('error',$error);
    }
}


    public function register(Request $request)
    {
        // Lakukan HTTP POST request ke endpoint /register pada RESTful API
        $response = Http::post('http://localhost:8080/api/users/register', [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'nomor_KTP' => $request->input('Nomor_KTP'),
            'nim' => $request->input("NIM"),
            'nama_Lengkap' =>$request->input('nama_lengkap'),
            'nomor_Handphone' => $request->input('Nhp')
        ]);
        if ($response->successful()) {
            // Jika request berhasil, lakukan redirect ke rute yang diinginkan
            $succes ='Behasil Mendaftar';
            return redirect()->route('vlogin')->with('succes',$succes);
        } else {
            // Jika request tidak berhasil, ambil pesan kesalahan dari respons API
            $error = $response->json()['message'] ?? 'Terjadi kesalahan saat mendaftar';
    
            // Kembalikan ke halaman sebelumnya dengan pesan kesalahan
            return back()->with('error', $error);
        }
    }

    public function validateToken(Request $request)
    {
        // Ambil token dari form atau dari sesi login (sesuai kebutuhan)
        $token = $request->input('token');

        // Lakukan HTTP GET request ke endpoint /validate-token pada RESTful API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('http://localhost:8080/api/users/validate-token');

        // Mengembalikan respons dari RESTful API ke halaman user-data
        return $response->body();
    }
    public function logout()
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('http://localhost:8080/api/users/logout');

        
        session()->forget('auth_token');
        session()->forget('id_users');
        
    
        return redirect()->route('login');
    }
}

