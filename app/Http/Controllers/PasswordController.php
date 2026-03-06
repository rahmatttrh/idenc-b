<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
   public function index(){
      return view('auth.passwords.email');
   }

   public function update(Request $req){

      $user = User::find(auth()->user()->id);
      if (!Hash::check($req->password_current, $user->password)) {
         return back()->withErrors([
            'password_current' => 'Password saat ini tidak sesuai.'
         ]);
      }

     $req->validate([
         'password' => [
            'required',
            'confirmed', // kalau pakai password_confirmation
            Password::min(8)
               ->mixedCase()   // harus ada huruf besar & kecil
               ->letters()     // minimal ada huruf
               ->numbers()     // harus ada angka
               ->symbols()     // harus ada karakter spesial
         ],
      ]);

      // dd('ok');
      $user = User::find(auth()->user()->id);
      // dd($user->name);
      $user->update([
         'password' => Hash::make($req->password)
      ]);


      $employee = Employee::where('nik', auth()->user()->nik)->first();
      $employee->update([
         'password' => 'changed'
      ]);

      return redirect()->to('/')->with('Password successfully updated');

   }
}
