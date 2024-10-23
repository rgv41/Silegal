@extends('admin.layouts.user_type.auth')

@section('content')
<div class="container">
    <h4>Manajemen KBLI dan Kategori KBLI</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Ikon untuk membuka modal impor kategori -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#importCategoryModal" title="Impor Kategori KBLI">
            <i class="fas fa-upload fa-lg"></i>
        </button>
       
        <button class="btn btn-light ms-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal" title="Tambah Kategori KBLI">
            <i class="fas fa-plus fa-lg"></i>
        </button>
        
    </div>

    <!-- Tabel untuk menampilkan kategori KBLI -->
    <h5 class="mt-4">Kategori KBLI</h5>
    <input type="text" id="searchCategory" class="form-control mb-3" placeholder="Cari Kategori...">
    <table class="table d-none" id="categoryTable">
        <thead>
            <tr>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->category_name }}</td>
                <td>
                    <button class="btn btn-primary" onclick="selectCategory({{ $category->id }}, '{{ $category->category_name }}')">Pilih</button>
                    <button class="btn btn-warning" onclick="editCategory({{ $category->id }}, '{{ $category->category_name }}')">Edit</button>
                    <button class="btn btn-danger" onclick="confirmDeleteCategory('{{ route('admin.kbli.category.destroy', $category->id) }}')">Hapus</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="btn btn-light ms-3" data-bs-toggle="modal" data-bs-target="#importKbliModal" title="Impor KBLI">
        <i class="fas fa-upload fa-lg"></i>
    </button>
<button class="btn btn-light ms-3" data-bs-toggle="modal" data-bs-target="#addKbliModal" title="Tambah KBLI">
            <i class="fas fa-plus fa-lg"></i>
        </button>
    <!-- Tabel untuk menampilkan KBLI -->
    <h5 class="mt-4">Daftar KBLI</h5>
    <input type="text" id="searchKbli" class="form-control mb-3" placeholder="Cari KBLI..." disabled>
    <table class="table d-none" id="kbliTable">
        <thead>
            <tr>
                <th>Kode KBLI</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data KBLI akan ditambahkan di sini -->
        </tbody>
    </table>
</div>


<!-- Modal untuk impor kategori KBLI -->
@include('admin.kbli.category.import')

<!-- Modal untuk impor KBLI -->
@include('admin.kbli.import')

<!-- Include modal tambah KBLI -->
@include('admin.kbli.create')

<!-- Include modal tambah category KBLI -->
@include('admin.kbli.category.create')

<!-- Include modal edit category KBLI -->
@include('admin.kbli.category.edit')

<!-- Include modal edit KBLI -->
@include('admin.kbli.edit')

<!-- Include modal delete confirmation -->
@include('admin.kbli.delete')

<!-- Include modal delete category KBLI -->
@include('admin.kbli.category.delete')

<script>
    // Real-time search for categories
    document.getElementById('searchCategory').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#categoryTable tbody tr');
        let found = false;

        rows.forEach(row => {
            const categoryName = row.cells[0].textContent.toLowerCase();
            if (categoryName.includes(filter)) {
                row.style.display = '';
                found = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Show/hide the category table based on search results
        const categoryTable = document.getElementById('categoryTable');
        categoryTable.classList.toggle('d-none', !found);
    });

    // Real-time search for KBLIs
    document.getElementById('searchKbli').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#kbliTable tbody tr');

        rows.forEach(row => {
            const kbliCode = row.cells[0].textContent.toLowerCase();
            const kbliDescription = row.cells[1].textContent.toLowerCase();
            row.style.display = kbliCode.includes(filter) || kbliDescription.includes(filter) ? '' : 'none';
        });
    });

    // Function to select a category and load corresponding KBLIs
    function selectCategory(id, name) {
        // Hide all other categories in the table
        const rows = document.querySelectorAll('#categoryTable tbody tr');
        rows.forEach(row => {
            const categoryId = row.querySelector('td button').onclick.toString().match(/(\d+)/)[0]; // Extract the ID from the onclick event
            if (categoryId != id) {
                row.style.display = 'none'; // Hide the non-selected category
            }
        });

        // Enable KBLI search input
        document.getElementById('searchKbli').disabled = false; // Enable KBLI search
        document.getElementById('searchKbli').value = ''; // Clear the KBLI search input

        // Fetch KBLI based on the selected category
        fetch(`/kblis-by-category?category_id=${id}`)
            .then(response => response.json())
            .then(data => {
                const kbliTableBody = document.querySelector('#kbliTable tbody');
                kbliTableBody.innerHTML = ''; // Clear existing KBLI data

                data.forEach(kbli => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${kbli.kode_kbli}</td>
                        <td>${kbli.deskripsi_kbli}</td>
                        <td>${kbli.category.category_name}</td>
                        <td>
                            <button class="btn btn-warning" onclick="editKbli(${kbli.id}, '${kbli.kode_kbli}', '${kbli.deskripsi_kbli}', ${kbli.kbli_category_id})">Edit</button>
                            <button class="btn btn-danger" onclick="confirmDelete('/kbli/hapus/${kbli.id}')">Hapus</button>
                        </td>
                    `;
                    kbliTableBody.appendChild(row);
                });

                // Show the KBLI table
                const kbliTable = document.getElementById('kbliTable');
                kbliTable.classList.remove('d-none');
            })
            .catch(error => {
                console.error('Error fetching KBLI:', error);
            });
    }

    // Edit Category Function
    function editCategory(id, name) {
        document.getElementById('editCategoryForm').action = '/kbli-categories/' + id; // Update action URL
        document.getElementById('edit_category_name').value = name; // Set the value
        var modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        modal.show();
    }

// Edit KBLI Function
function editKbli(id, code, description, categoryId) {
    document.getElementById('editKbliForm').action = '/kbli/' + id; // Set update URL
    document.getElementById('edit_kode_kbli').value = code; // Set value for kode_kbli
    document.getElementById('edit_deskripsi_kbli').value = description; // Set value for deskripsi_kbli
    document.getElementById('edit_kbli_category_id').value = categoryId; // Set value for kbli_category_id
    var modal = new bootstrap.Modal(document.getElementById('editKbliModal'));
    modal.show();
}

    // Delete confirmation modal
    function confirmDelete(url) {
        document.getElementById('deleteForm').action = url;
        var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
     // Function to handle deletion of category
     function confirmDeleteCategory(url) {
        document.getElementById('deleteCategoryForm').action = url; // Set the form action dynamically
        var modal = new bootstrap.Modal(document.getElementById('deleteCategoryModal'));
        modal.show();
    }
</script>
@endsection

