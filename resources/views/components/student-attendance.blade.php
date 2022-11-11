<div class="card">
    <div class="card-header">
        <h5 class="card-title">Absensi Harian</h5>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Masuk</th>
                <th>Istirahat</th>
                <th>Kembali</th>
                <th>Pulang</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @if ($attendances)
                        @if (date('H:i:s', strtotime($attendances->created_at)) >= '08:00:00')
                            <span class="badge rounded-pill bg-warning">Telat</span>
                        @else
                            <span class="badge rounded-pill bg-success">Masuk</span>
                        @endif
                    @else
                        <span class="badge rounded-pill bg-danger">Belum Hadir</span>
                    @endif

                </td>
                <td>
                    @if ($attendances?->detail_attendances)
                        @foreach ($attendances?->detail_attendances as $item)
                            @if ($item->status == 'break')
                                <span class="badge rounded-pill bg-success">Sudah Absen</span>
                            @break
                        @endif
                    @endforeach
                @endif

            </td>
            <td class="d-none d-md-table-cell">
                @if ($attendances?->detail_attendances)
                    @foreach ($attendances?->detail_attendances as $item)
                        @if ($item->status == 'return_break')
                            @if (date('H:i:s', strtotime($item->created_at)) >= '13:00:00')
                                <span class="badge rounded-pill bg-warning">Telat</span>
                            @else
                                <span class="badge rounded-pill bg-success">Masuk</span>
                            @endif
                        @endif
                    @endforeach

                @endif
            </td>
            <td class="table-action">
                @if ($attendances?->detail_attendances)
                    @foreach ($attendances?->detail_attendances as $item)
                        @if ($item->status == 'return')
                            <span class="badge rounded-pill bg-success">Sudah Absen</span>
                        @break
                    @endif
                @endforeach
            @endif

        </td>
    </tr>

</tbody>
</table>
</div>
