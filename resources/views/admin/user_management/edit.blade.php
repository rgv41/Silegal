<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editUserForm" method="POST">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-name">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email</label>
                        <input type="email" class="form-control" id="edit-email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-role">Role</label>
                        <input type="text" class="form-control" id="edit-role" name="role" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
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