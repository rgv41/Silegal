@extends('admin.layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Semua Users</h5>
                        </div>
                        <!-- Button to trigger modal -->
                        <a href="javascript:void(0)" class="btn bg-gradient-dark btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#addUserModal">+&nbsp; User Baru</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th> --}}
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Role
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                    </td>
                                    {{-- <td>
                                        <div>
                                            <img src="{{ asset('assets/img/team-' . $loop->iteration . '.jpg') }}" class="avatar avatar-sm me-3">
                                        </div>
                                    </td> --}}
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->role }}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at->format('d/m/y') }}</span>
                                    </td>
                                    <td class="text-center">
                                        <!-- Button Edit -->
                                        <a href="javascript:void(0)" class="mx-3" data-bs-toggle="modal" data-bs-target="#editUserModal" onclick="editUser({{ $user->id }})">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        
                                        <!-- Button Delete -->
                                        <a href="javascript:void(0)" class="mx-3" data-bs-toggle="modal" data-bs-target="#deleteUserModal" onclick="deleteUser({{ $user->id }})">
                                            <i class="fas fa-trash text-secondary"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Include Add User Modal -->
                        @include('admin.user_management.create')
                        @include('admin.user_management.edit')
                        
                        <!-- Modal Delete User -->
                        <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="deleteUserForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteUserModalLabel">Hapus User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus user ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak, Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tambahkan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Tambahkan script untuk editUser -->
<script>
    function editUser(id) {
        $.ajax({
            url: '/user-management/edit/' + id,  // URL untuk mengambil data user berdasarkan ID
            method: 'GET',
            success: function(data) {
                // Ganti isi modal dengan data yang diambil dari server
                $('#edit-name').val(data.name);
                $('#edit-email').val(data.email);
                $('#edit-role').val(data.role);

                // Set action form untuk update dengan URL yang benar
                $('#editUserForm').attr('action', '/user-management/update/' + id);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Failed to load user data.');
            }
        });
    }
</script>
@endsection
