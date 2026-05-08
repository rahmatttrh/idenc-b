@if ($perdin->status == 0)
    <span class="badge badge-warning  px-3 py-2">
        <i class="fas fa-clock"></i> Draft
    </span>
    @elseif($perdin->status == 1)
    <span class="badge badge-info  px-3 py-2">
        <i class="fas fa-clock"></i> Validasi Manager HRD
    </span>
@endif