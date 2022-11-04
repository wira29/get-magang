@if ($data->status == 'aktif')
<span class="badge badge-soft-success">{{ $data->status }}</span>
@else
<span class="badge badge-soft-danger">{{ $data->status }}</span>
@endif