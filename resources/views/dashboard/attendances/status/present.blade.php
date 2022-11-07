@if ($attendances)
    @if (date('H:i:s', strtotime($attendances->created_at)) >= '08:00:00')
        <span class="badge rounded-pill bg-warning">Telat</span>
    @else
        <span class="badge rounded-pill bg-success">Masuk</span>
    @endif
@else
    <span class="badge rounded-pill bg-danger">Belum Hadir</span>
@endif
