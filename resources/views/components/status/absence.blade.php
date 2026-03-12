<span >
   @if ($absence->type == 1)
      Alpha
      @elseif($absence->type == 2)
      Telat
      {{-- @if (auth()->user()->hasRole('Karyawan'))
          @else --}}
          (< {{$absence->minute}} Menit)
      {{-- @endif  --}}
      
      @elseif($absence->type == 3)
      ATL 
      {{-- ({{$absence->desc ?? '-'}}) --}}
      @elseif($absence->type == 4)
      Izin (
         @if ($absence->type_desc == 'Setengah Hari')
             1/2 Hari
             @else
              {{$absence->type_desc}}
         @endif
        
         )
      {{-- {{$absence->type_izin}} ({{$absence->remark}}) --}}
      @elseif($absence->type == 5)
      Cuti
      @elseif($absence->type == 6)
      SPT 
      {{-- ({{$absence->type_desc}}) --}}
      @elseif($absence->type == 7)
      Sakit 
      @elseif($absence->type == 8)
      Dinas Luar
      @elseif($absence->type == 9)
      Off Kontrak
      @elseif($absence->type == 10)
      Izin Resmi 
   @endif
</span>