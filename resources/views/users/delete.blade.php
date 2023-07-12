@extends('layouts.main')

@section('content')
<h2 class="text-center">List Deleted User</h2>
<hr>

<div class="text-end">
    <a href="/users" class="btn btn-secondary">Back</a>
</div>

<div class="row mt-4">
    <div class="col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>USERNAME</th>
                    <th>PHONE</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            @if ($users->count())
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td class="fw-bold">{{ $loop->iteration }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ (isset($item->phone)) ? $item->phone : '-' }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="/users/{{ $item->slug }}/restore" class="btn btn-info"
                                onclick="return confirm('Serius mau di restore ?')">
                                <i class="bi bi-arrow-clockwise"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach            
                    @else
                    <tr>
                        <td colspan="5" class="text-center text-danger fw-semibold fs-5">User Banned Not Found</td>
                    </tr>
                </tbody>
            @endif
        </table>
    </div>
</div>
@endsection
