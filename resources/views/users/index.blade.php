@extends('layouts.main')

@section('content')
{{-- DataTables --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

<h2 class="text-center">List User Active</h2>
<hr>
<div class="text-end">
    <a href="/users/active-user" class="btn btn-primary me-3">User inActive</a>
    <a href="/users/list-delete" class="btn btn-info">List Banned User</a>
</div>


<div class="row justify-content-center mt-4">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-10 mt-3" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="col-lg-10">
        <table class="table table-hover" id="example">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>USERNAME</th>
                    <th>PHONE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="fw-bold">{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ (isset($user->phone)) ? $user->phone : '-' }}</td>
                    <td>
                        <a href="/users/{{ $user->slug }}/detail" class="btn btn-warning me-2">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <button class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $user->slug }}">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $user->slug }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Banned User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>Are You Sure {{ $user->username }} ?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="/users/{{ $user->slug }}/delete" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    new DataTable('#example');
</script>
@endsection
