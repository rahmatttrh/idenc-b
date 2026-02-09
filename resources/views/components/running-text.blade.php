
{{-- <div class="shadow-lg"> --}}
   <marquee scrollamount="5" style="background-color: #e0dcdc" class="px-4 shadow-lg mb-3 rounded  py-2  " ><i class="fa fa-bell"></i> <a href="http://103.167.113.60:8007" target="_blank">Klik disini untuk melaporkan kendala seputar IT</a>  &nbsp;  &nbsp;  &nbsp; 
      <i class="fa fa-bell"></i>  <a href="http://booking.enc.co.id" target="_blank">Klik disini jika anda ingin melakukan Booking Meeting Room</a>
      {{-- @foreach ($alertbirtdays as $crew)
      <i class="fa fa-gift "></i> <b>{{$crew->name ?? '-'}}</b> {{\Carbon\Carbon::parse($crew->birth_date)->format('d F Y')}} {{$crew->position ?? '-'}} at {{$crew->vessel->name ?? '-'}} &nbsp;&nbsp;
      @endforeach    --}}
   </marquee>
{{-- </div> --}}