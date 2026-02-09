<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
   public function index(){
      
      $logs = Log::orderBy('created_at', 'desc')->get();
      return view('pages.log.index', [
         'logs' => $logs
      ])->with('i');
   }
   public function auth(){
      $user = User::where('username', 'KJ-5-219')->first();
      // dd('ok');
      // $log = Log::orderBy('created_at', 'desc')->get()->first();
      // dd($log->created_at);
      // $logs = Log::where('department_id', '!=', null)->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
      $logs = Log::where('department_id', '!=', null)->orderBy('created_at', 'desc')->paginate(1500);
      return view('pages.log.auth', [
         'logs' => $logs
      ])->with('i');
   }
}
