<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class SuratAdminController extends Controller
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
         ])->get('http://localhost:8080/api/surat/all');
         if ($response->successful()) {
         $surat = $response->json();
         return view('pages.BAAK.Surat.index',compact('surat','user'));
         }
         else{
            $error = "Lakukan Login Sebelum memasuki halaman";
            return redirect()->route('vlogin')->with('error', $error);
        }
     }
    
     public function Rejected($id)
     {
         $token = session('token');
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token
         ])->put('http://localhost:8080/api/surat/status/' . $id, [
             'status' => "Rejected"
         ]);
            return redirect()->route('Surat_Mahasiswa')->with('success', 'Status berhasil diubah');
     }

     public function Approve($id, Request $request)
     {
         $token = session('token');
         if ($request->hasFile('nama_surat')) {
             $file = $request->file('nama_surat');
     
             $allowedFileTypes = ['pdf', 'doc', 'docx', 'xls', 'xlsx']; 
             $fileExtension = $file->getClientOriginalExtension();
             if (!in_array(strtolower($fileExtension), $allowedFileTypes)) {
                 return redirect()->back()->with('error', 'Hanya file PDF, Word, atau Excel yang diperbolehkan.');
             }
     
             $new_name = rand() . '.' . $fileExtension;
             $file->move(public_path('surat_mahasiswa'), $new_name);
     
             $response = Http::withHeaders([
                 'Authorization' => 'Bearer ' . $token
             ])->put('http://localhost:8080/api/surat/status/' . $id, [
                 'status' => "Approve",
                 'nama_surat' => $new_name
             ]);
             return redirect()->route('Surat_BAAK')->with('success', 'Status berhasil diubah');
         }
     }
     

    public function Add_File_Approve($id){
        $token = session('token');
        $user = $this->validate_token();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://localhost:8080/api/surat/get/'.$id);
        if ($response->successful()) {
        $data = $response->json();
        return view('pages.BAAK.Surat.add',compact('data','user'));
        }
        else{
           $error = "Lakukan Login Sebelum memasuki halaman";
           return redirect()->route('vlogin')->with('error', $error);
       }

    }
    }
