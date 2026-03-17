<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

function formatRupiah($data)
{
   $rupiah = 'Rp ' . number_format($data, 0, ",", ".");
   return $rupiah;
}

function formatRupiahB($data)
{
   $rupiah = " " . number_format($data, 0, ",", ".");
   return $rupiah;
}

function absenceName($absence){
   if ($absence->type == 1){
     $name =  'Alpha';
   } else if($absence->type == 2) {
     $name =  'Telat ' .  '(< ' . $absence->minute . ' Menit)';

   } else if($absence->type == 3) {
      $name =  'ATL';
   } else if($absence->type == 4) {
      if ($absence->type_desc == 'Setengah Hari'){
        $desc = ' 1/2 Hari' ;
      } else {
         $desc = $absence->type_desc;
      }
            
      $name =  'Izin ' . '(' . $desc . ')';
      
   } else if($absence->type == 5) {
      $name =  'Cuti';
   } else if($absence->type == 6) {
      $name =  'SPT';
   } else if($absence->type == 7) {
      $name =  'Sakit';
   } else if($absence->type == 8) {
      $name =  'Dinas Luar';
   } else if($absence->type == 9) {
      $name =  'Off Kontrak';
   } else if($absence->type == 10) {
      $name =  'Izin Resmi';
   } else if($absence->type == 11) {
      $name =  'Perjalanan Dinas';
   } else {
      $name = '-';
   }
     
   return $name;
}

function statusForm($status)
{
    if ($status == 0) {
        return 'Draft';
    } elseif ($status == 1) {
        return 'Approval Atasan';
    } elseif ($status == 2) {
        return 'Approval Manager';
    } elseif ($status == 3) {
        return 'Validasi HRD';
    } elseif ($status == 5) {
        return 'Published';
    } elseif ($status == 101) {
        return 'Reject Atasan';
    } elseif ($status == 202) {
        return 'Reject Manager';
    } elseif ($status == 303) {
        return 'Reject HRD';
    }

    return '-';
}

/**
 * Menghitung selisih antara dua tanggal
 * dalam format total bulan dan sisa hari.
 *
 * @param  string|DateTime  $start  Tanggal mulai (join date)
 * @param  string|DateTime  $end    Tanggal akhir (cut off date)
 * @return array{months:int, days:int}
 */
function diffMonthDays($start, $end): array
{
    // Normalisasi input menjadi instance Carbon
    $startDate = Carbon::parse($start);
    $endDate   = Carbon::parse($end);

    // Hitung selisih tanggal
    $interval = $startDate->diff($endDate);

    // Total bulan = (tahun × 12) + bulan
    $totalMonths = ($interval->y * 12) + $interval->m;

    return [
        'months' => $totalMonths,
        'days'   => $interval->d, // Sisa hari setelah dikurangi bulan penuh
    ];
}

function host()
{
   $host = '/var/www/html/dsp-phe/';
   // $srv = $_SERVER['SERVER_NAME'];
   // $port = ":" .  $_SERVER['SERVER_PORT'];
   // $host = 'http://' . $srv . ':' . $port;

   return $host;
}


function enkripRambo($data)
{
   return base64_encode(base64_encode(base64_encode($data)));
}

function dekripRambo($data)
{
   return base64_decode(base64_decode(base64_decode($data)));
}

function getMonthNameIndonesian($monthNumber)
{
   $bulan = [
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember',
   ];

   return   $bulan[$monthNumber];
}

function dateToMonth($date)
{

   // Ambil dua karakter terakhir dari string tanggal
   $bulan = intval(substr($date, 5, 2));

   $tahun = intval(substr($date, 0, 4));


   return getMonthNameIndonesian($bulan) . ' ' . $tahun;
   // return $bulan;
}

function formatMonthName($data)
{
   $date = \Carbon\Carbon::parse($data)->format('F');
   return $date;
}

function formatDate($data)
{
   $date = \Carbon\Carbon::parse($data)->format('d/m/Y');
   return $date;
}

function formatDateTime($data)
{
   $date = \Carbon\Carbon::parse($data)->format('d/m/Y H:i');
   return $date;
}

function formatDateTimeB($data)
{
   $date = \Carbon\Carbon::parse($data)->format('d/m/y H:i');
   return $date;
}

function formatDateDay($data)
{
   $date = \Carbon\Carbon::parse($data)->format('d');
   return $date;
}

function formatDateDayB($data)
{
   $date = \Carbon\Carbon::parse($data)->format('l, d/m/Y');
   return $date;
}

function formatDateDayMonth($data)
{
   $date = \Carbon\Carbon::parse($data)->format('d F');
   return $date;
}

function formatDayName($data)
{
   $date = \Carbon\Carbon::parse($data)->format('l');
   return $date;
}


function formatYear($data)
{
   $date = \Carbon\Carbon::parse($data)->format('Y');
   return $date;
}






function formatDateB($data)
{
   $date = \Carbon\Carbon::parse($data)->format('d F Y');
   return $date;
}

function formatDateC($data)
{
   $date = \Carbon\Carbon::parse($data)->format('d M Y');
   return $date;
}

function formatTime($data)
{
   $date = \Carbon\Carbon::parse($data)->format('H:i');
   return $date;
}

function formatDayDate($data)
{
   $date = \Carbon\Carbon::parse($data)->format('l, d/m/Y');
   return $date;
}

function numberToAlphabet($number)
{
   // Array untuk menyimpan huruf hasil konversi
   $letters = [];

   // Menghitung huruf berdasarkan angka yang diberikan
   while ($number > 0) {
      // Mengurangi 1 dari nomor untuk menangani indeks nol
      $number--;

      // Menentukan huruf berdasarkan nilai saat ini
      $remainder = $number % 26;
      $letters[] = chr($remainder + ord('a'));

      // Mengupdate nomor untuk loop berikutnya
      $number = intdiv($number, 26);
   }

   // Menggabungkan hasil dalam urutan terbalik
   return implode('', array_reverse($letters));
}

function getMultiple($hours)
{
   $multiHours = $hours - 1;
   $totalHours = $multiHours * 2 + 1.5;
   // $rate = $totalHours * round($rateOvertime);
   return $totalHours;
}

function clearAllCookies()
{
   $cookies = request()->cookies->all();
   
   foreach ($cookies as $name => $value) {
      Cookie::queue(Cookie::forget($name));
   }

   // dd('ok');
   
}
