@if ($data->status == 'masuk')
    <span class="badge rounded-pill bg-success">Masuk</span>
@elseif($data->status == 'izin')
    <span class="badge rounded-pill bg-warning">Masuk</span>
@elseif($data->status == 'sakit')
    <span class="badge rounded-pill bg-warning">Masuk</span>
@elseif($data->status == 'alpha')
    <span class="badge rounded-pill bg-danger">Masuk</span>
@endif
