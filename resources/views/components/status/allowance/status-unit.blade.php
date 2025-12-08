@if ($allowanceunit->status == 0)
    Draft
    @elseif($allowanceunit->status == 1)
    Validasi HRD Manager
    @elseif($allowanceunit->status == 2)
    Validasi Finance Manager
    @elseif($allowanceunit->status == 3)
    Validasi General Manager
    @elseif($allowanceunit->status == 4)
    Validasi Direktur
    @elseif($allowanceunit->status == 5)
    Validasi Presiden Direktur
    @elseif($allowanceunit->status == 6)
    Validasi Complete
@endif