<!-- resources/views/components/performance-appraisal.blade.php -->
<div class="pa-card">

    <!-- HEADER -->
    <div class="pa-header">
        <h6><i class="fa fa-file-contract"></i> Performance Appraisal</h6>
        <i class="fa fa-chart-line pa-icon"></i>
    </div>

    <!-- BODY -->
    <div class="pa-body">

        <!-- STATUS -->
        <div class="mb-2">
            @if($kpa->pe->status == 0)
                <div class="pa-status status-draft">
                    <i class="fa fa-edit"></i> Draft
                </div>

            @elseif($kpa->pe->status == 1)
                <div class="pa-status status-wait">
                    <i class="fa fa-clock"></i> Verifikasi Manager
                </div>

            @elseif($kpa->pe->status == 2 || $kpa->pe->status == 3)
                <div class="pa-status status-done">
                    <i class="fa fa-check-circle"></i> Completed
                </div>

            @elseif($kpa->pe->status == 101)
                <div class="pa-status status-reject">
                    <i class="fa fa-times-circle"></i> Rejected by Manager
                </div>

            @elseif($kpa->pe->status == 202)
                <div class="pa-status status-discuss">
                    <i class="fa fa-comments"></i> Need Discussion
                </div>
            @endif
        </div>

        <!-- INFO -->
        <div class="pa-info">
            <div class="pa-item">
                <div class="pa-label">NIK</div>
                <div class="pa-value">{{ $kpa->employe->nik }}</div>
            </div>

            <div class="pa-item">
                <div class="pa-label">Name</div>
                <div class="pa-value">{{ $kpa->employe->biodata->fullName() }}</div>
            </div>

            <div class="pa-item">
                <div class="pa-label">Department</div>
                <div class="pa-value">
                    {{ $kpa->employe->department->name ?? 'Finance GA' }}
                </div>
            </div>

            <div class="pa-item">
                <div class="pa-label">Period</div>
                <div class="pa-value">
                    Semester {{ $kpa->semester }} / {{ $kpa->tahun }}
                </div>
            </div>
        </div>

        <!-- REJECT NOTE -->
        @if($kpa->pe->status == 101)
        <div class="pa-note pa-note-danger">
            <b>Alasan Penolakan:</b><br>
            {{ $kpa->pe->alasan_reject }}
        </div>
        @endif

        <!-- DISCUSS NOTE -->
        @if($kpa->pe->status == 202)
        <div class="pa-note">
            <b>Discussion Note:</b><br>
            {{ $kpa->pe->nd_dibuat }} : <i>{{ $kpa->pe->nd_alasan }}</i>
            <br><br>

            <b>Undangan:</b><br>
            @if($kpa->pe->nd_for == '1')
                Team Leader / Supervisor
            @elseif($kpa->pe->nd_for == '2')
                Karyawan
            @else
                Karyawan & Atasan
            @endif

            <br><br>
            <b>Tanggal:</b> {{ formatDate($kpa->pe->nd_date) }}
        </div>
        @endif

    </div>

</div>
