<?php
// app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class PageController extends Controller

{
    public function showLogin()
    {
        return view('pages.login');
    }

    public function showRegister()
    {
        return view('pages.register');
    }


    // View Controller BAAK
    public function showDashboardBAAK(){
          $token = session('token');
          if ($token) {

          $response = Http::withHeaders([
              'Authorization' => 'Bearer ' . $token
          ])->get('http://localhost:8080/api/users/validate-token');
          $user = $response->json()['user'];
          
          if ($response->successful()) {
            $response1 = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get('http://localhost:8080/api/booking/all');
            $Booking = $response1->json();

            $response2 = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('http://localhost:8080/api/paymentkaos/all');
            $pemesanankaos = $response2->json();

            $response3 = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('http://localhost:8080/api/izinbermalam/all');
            $izinbermalam = $response3->json();

            $response4 = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('http://localhost:8080/api/izinkeluar/all');
            $izinkeluar = $response4->json();  
            
            $response5 = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('http://localhost:8080/api/surat/all');
            $surat = $response5->json();  
            
            
             return view('pages.BAAK.dashboard',compact('user','Booking','pemesanankaos','izinbermalam','izinkeluar','surat'));

          }
        }
          $error = "Lakukan Login Sebelum memasuki halaman";
          return redirect()->route('vlogin')->with('error', $error);

          }

        


            public function AddRuanganForm()
            {
                $token = session('token');
            
                if ($token) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->get('http://localhost:8080/api/users/validate-token');
            
                    if ($response->successful()) {
                        $user = $response->json()['user'];
                        return view('pages.BAAK.Ruang.add', compact('user'));
                    }
                }
                $error = "Lakukan Login Sebelum memasuki halaman";
                return redirect()->route('vlogin')->with('error', $error);
            }

            public function AddKaosForm()
            {
                $token = session('token');
            
                if ($token) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->get('http://localhost:8080/api/users/validate-token');
            
                    if ($response->successful()) {
                        $user = $response->json()['user'];
                        return view('pages.BAAK.Kaos.add', compact('user'));
                    }
                }
                $error = "Lakukan Login Sebelum memasuki halaman";
                return redirect()->route('vlogin')->with('error', $error);
            }


            public function EditRuanganForm($id)
            {
                $token = session('token');
            
                if ($token) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->get('http://localhost:8080/api/users/validate-token');
            
                    if ($response->successful()) {
                        $user = $response->json()['user'];
                        $getruangan = Http::withHeaders([
                            'Authorization' => 'Bearer ' . $token
                        ])->get('http://localhost:8080/api/ruangan/get/'.$id);
                        $ruangan = $getruangan->json();
                        return view('pages.BAAK.Ruang.edit', compact('user','ruangan'));
                    }
                }
                $error = "Lakukan Login Sebelum memasuki halaman";
                return redirect()->route('vlogin')->with('error', $error);
            }



            

            public function EditKaosForm($id)
            {
                $token = session('token');
            
                if ($token) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->get('http://localhost:8080/api/users/validate-token');
            
                    if ($response->successful()) {
                        $user = $response->json()['user'];
                        $getruangan = Http::withHeaders([
                            'Authorization' => 'Bearer ' . $token
                        ])->get('http://localhost:8080/api/kaos/get/'.$id);
                        $kaos = $getruangan->json();
                        return view('pages.BAAK.Kaos.edit', compact('user','kaos'));
                    }
                }
                $error = "Lakukan Login Sebelum memasuki halaman";
                return redirect()->route('vlogin')->with('error', $error);
            }

           


            public function EditUserForm($id)
            {
                $token = session('token');
            
                if ($token) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->get('http://localhost:8080/api/users/validate-token');
            
                    if ($response->successful()) {
                        $user = $response->json()['user'];
                        $getresponse = Http::withHeaders([
                            'Authorization' => 'Bearer ' . $token
                        ])->get('http://localhost:8080/api/users/mahasiswa/get/'.$id);
                        $users = $getresponse->json();
                        return view('pages.BAAK.Mahasiswa.edit', compact('user','users'));
                    }
                }
                $error = "Lakukan Login Sebelum memasuki halaman";
                return redirect()->route('vlogin')->with('error', $error);
            }

            //View Controller Mahasiswa

            public function showDashboardMahasiswa(){
                $token = session('token');
                if ($token) {
      
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token
                ])->get('http://localhost:8080/api/users/validate-token');
                $user = $response->json()['user'];
                
                if ($response->successful()) {
                   return view('pages.Mahasiswa.dashboard',compact('user'));
                }
              }
                $error = "Lakukan Login Sebelum memasuki halaman";
                return redirect()->route('vlogin')->with('error', $error);
                }
            
            public function AddIzinKeluarForm()
            {
                $token = session('token');
            
                if ($token) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->get('http://localhost:8080/api/users/validate-token');
            
                    if ($response->successful()) {
                        $user = $response->json()['user'];
                        return view('pages.Mahasiswa.IzinKeluar.add', compact('user'));
                    }
                }
                $error = "Lakukan Login Sebelum memasuki halaman";
                return redirect()->route('vlogin')->with('error', $error);
            }
            public function AddIzinBermalamForm()
            {
                $token = session('token');
            
                if ($token) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->get('http://localhost:8080/api/users/validate-token');
            
                    if ($response->successful()) {
                        $user = $response->json()['user'];
                        return view('pages.Mahasiswa.IzinBermalam.add', compact('user'));
                    }
                }
                $error = "Lakukan Login Sebelum memasuki halaman";
                return redirect()->route('vlogin')->with('error', $error);
            }

            public function AddBookingForm()
            {
                $token = session('token');
            
                if ($token) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->get('http://localhost:8080/api/users/validate-token');
            
                    $ruangan =Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->get('http://localhost:8080/api/ruangan/all');

                    if ($response->successful() && $ruangan->successful()) {
                        $user = $response->json()['user'];
                        $ruangan1 = $ruangan->json();
                        return view('pages.Mahasiswa.Booking.add', compact('user','ruangan1'));
                    }
                }
                $error = "Lakukan Login Sebelum memasuki halaman";
                return redirect()->route('vlogin')->with('error', $error);
            }

            public function AddSuratForm()
            {
                $token = session('token');
            
                if ($token) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->get('http://localhost:8080/api/users/validate-token');
            
                    if ($response->successful()) {
                        $user = $response->json()['user'];
                        return view('pages.Mahasiswa.Surat.add', compact('user'));
                    }
                }
                $error = "Lakukan Login Sebelum memasuki halaman";
                return redirect()->route('vlogin')->with('error', $error);
            }

            public function AddPaymentKaosForm()
            {
                $token = session('token');
            
                if ($token) {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->get('http://localhost:8080/api/users/validate-token');
            
                    $ruangan =Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->get('http://localhost:8080/api/kaos/all');

                    if ($response->successful() && $ruangan->successful()) {
                        $user = $response->json()['user'];
                        $kaos = $ruangan->json();
                        return view('pages.Mahasiswa.PaymentKaos.add', compact('user','kaos'));
                    }
                }
                $error = "Lakukan Login Sebelum memasuki halaman";
                return redirect()->route('vlogin')->with('error', $error);
            }
    
    
    }

