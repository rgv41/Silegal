function previewKtpFiles() {
    var preview = document.getElementById('ktp-preview');
    var files = document.getElementById('foto_ktp').files;

    // Kosongkan preview jika sebelumnya sudah ada gambar
    preview.innerHTML = '';

    // Looping melalui file yang dipilih
    for (var i = 0; i < files.length; i++) {
        var file = files[i];

        // Pastikan file adalah gambar
        if (file.type.match('image.*')) {
            var reader = new FileReader();

            reader.onload = (function(file) {
                return function(e) {
                    // Buat div container untuk gambar dan tombol silang
                    var div = document.createElement('div');
                    div.classList.add('col-md-3', 'position-relative', 'mt-2');

                    // Buat gambar dan set src-nya ke file yang diupload
                    var img = document.createElement('img');
                    img.classList.add('img-fluid', 'rounded');
                    img.src = e.target.result;
                    img.style.width = '150px'; // Ukuran gambar lebih besar
                    img.style.height = 'auto'; // Tinggi gambar mengikuti proporsi asli

                    // Buat tombol silang (X) untuk menghapus gambar
                    var removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '&times;';
                    removeBtn.classList.add('btn', 'btn-danger', 'position-absolute', 'p-1');
                    removeBtn.style.top = '5px'; // Atur jarak dari atas
                    removeBtn.style.right = '5px'; // Atur jarak dari kanan
                    removeBtn.style.fontSize = '14px'; // Ukuran tombol silang lebih kecil
                    removeBtn.style.lineHeight = '1'; // Supaya silang berada di tengah
                    removeBtn.style.width = '20px'; // Ukuran lebih kecil
                    removeBtn.style.height = '20px';
                    removeBtn.style.display = 'flex';
                    removeBtn.style.justifyContent = 'center';
                    removeBtn.style.alignItems = 'center';
                    removeBtn.style.cursor = 'pointer';

                    removeBtn.onclick = function() {
                        div.remove(); // Hapus div container ini
                    };

                    // Tambahkan gambar dan tombol ke dalam div
                    div.appendChild(img);
                    div.appendChild(removeBtn);

                    // Tambahkan div ke dalam preview container
                    preview.appendChild(div);
                };
            })(file);

            reader.readAsDataURL(file);
        }
    }
}

// Fungsi untuk menampilkan preview gambar NPWP (sama seperti KTP)
function previewNpwpFiles() {
    var preview = document.getElementById('npwp-preview');
    var files = document.getElementById('foto_npwp').files;

    // Kosongkan preview jika sebelumnya sudah ada gambar
    preview.innerHTML = '';

    // Looping melalui file yang dipilih
    for (var i = 0; i < files.length; i++) {
        var file = files[i];

        // Pastikan file adalah gambar
        if (file.type.match('image.*')) {
            var reader = new FileReader();

            reader.onload = (function(file) {
                return function(e) {
                    // Buat div container untuk gambar dan tombol silang
                    var div = document.createElement('div');
                    div.classList.add('col-md-3', 'position-relative', 'mt-2');

                    // Buat gambar dan set src-nya ke file yang diupload
                    var img = document.createElement('img');
                    img.classList.add('img-fluid', 'rounded');
                    img.src = e.target.result;
                    img.style.width = '150px'; // Ukuran gambar lebih besar
                    img.style.height = 'auto'; // Tinggi gambar mengikuti proporsi asli

                    // Buat tombol silang (X) untuk menghapus gambar
                    var removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '&times;';
                    removeBtn.classList.add('btn', 'btn-danger', 'position-absolute', 'p-1');
                    removeBtn.style.top = '5px'; // Atur jarak dari atas
                    removeBtn.style.right = '5px'; // Atur jarak dari kanan
                    removeBtn.style.fontSize = '14px'; // Ukuran tombol silang lebih kecil
                    removeBtn.style.lineHeight = '1'; // Supaya silang berada di tengah
                    removeBtn.style.width = '20px'; // Ukuran lebih kecil
                    removeBtn.style.height = '20px';
                    removeBtn.style.display = 'flex';
                    removeBtn.style.justifyContent = 'center';
                    removeBtn.style.alignItems = 'center';
                    removeBtn.style.cursor = 'pointer';

                    removeBtn.onclick = function() {
                        div.remove(); // Hapus div container ini
                    };

                    // Tambahkan gambar dan tombol ke dalam div
                    div.appendChild(img);
                    div.appendChild(removeBtn);

                    // Tambahkan div ke dalam preview container
                    preview.appendChild(div);
                };
            })(file);

            reader.readAsDataURL(file);
        }
    }
}