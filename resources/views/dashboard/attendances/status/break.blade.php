@if ($attendances)
    @foreach ($attendances as $item)
        @if ($item->status == 'break')
            <span class="badge rounded-pill bg-success">Sudah Absen</span>
        @break
    @endif
@endforeach
@endif
