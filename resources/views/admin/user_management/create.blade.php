<!-- Modal for Add New User -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addUserForm" method="POST" action="{{ route('admin.user_management.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="add-name">Name</label>
                        <input type="text" class="form-control" id="add-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="add-email">Email</label>
                        <input type="email" class="form-control" id="add-email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="add-role">Role</label>
                        <input type="text" class="form-control" id="add-role" name="role" required>
                    </div>
                    <div class="form-group">
                        <label for="add-password">Password</label>
                        <input type="password" class="form-control" id="add-password" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah User</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
