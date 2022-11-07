@if ($attendances)
    @foreach ($attendances as $item)
        @if ($item->status == 'return')
            <span class="badge rounded-pill bg-success">Sudah Absen</span>
        @break
    @endif
@endforeach
@endif
