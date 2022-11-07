@if ($attendances)
    @foreach ($attendances as $item)
        @if ($item->status == 'return_break')
            @if (date('H:i:s', strtotime($item->created_at)) >= '13:00:00')
                <span class="badge rounded-pill bg-warning">Telat</span>
            @else
                <span class="badge rounded-pill bg-success">Masuk</span>
            @endif
        @endif
    @endforeach

@endif
