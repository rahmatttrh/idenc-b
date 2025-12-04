@if ($allowanceunit->status == 0)
    Draft
    @elseif($allowanceunit->status == 1)
    Validasi HRD Manager
    @elseif($allowanceunit->status == 2)
    Validasi General Manager
    @elseif($allowanceunit->status == 3)
    Validasi Direktur
    @elseif($allowanceunit->status == 4)
    Validasi Presiden Direktur
    @elseif($allowanceunit->status == 4)
    Validasi Complete
@endif