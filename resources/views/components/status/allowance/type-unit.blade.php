@if ($allowanceunit->type == 1)
    Akomodasi Perdin
    @elseif($allowanceunit->type == 2)
    Kompensasi
    @elseif($allowanceunit->type == 3)
    Uang Duka
    @elseif($allowanceunit->type == 4)
    Tunjangan Pernikahan
    @elseif($allowanceunit->type == 5)
    Tunjangan Kelahiran
    @elseif($allowanceunit->type == 6)
    Insentif
@endif