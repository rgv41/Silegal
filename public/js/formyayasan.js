$(document).ready(function() {
    // Handle KBLI on Yayasan form
    $('#tambah_kbli').on('change', function() {
        if ($(this).val() === 'ya') {
            $('#kbli-section').show();
        } else {
            $('#kbli-section').hide();
        }
    });

    // KBLI Category Change for all forms
    $('#kbli_category_id').on('change', function() {
        const categoryId = $(this).val();
        const kbliCheckboxes = $('#kbli-checkboxes');
        // kbliCheckboxes.empty(); // Reset checkbox
        // $('#selected-kbli-list').empty(); // Reset selected KBLI list
        $('#search-container').hide(); // Hide search initially

        if (categoryId) {
            fetch(`/kbli/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    $('#search-container').show(); // Show search input
                    data.forEach(kbli => {
                        const checkbox = `
                            <div>
                                <input type="checkbox" name="kbli_ids[]" value="${kbli.id}" id="kbli_${kbli.id}" class="kbli-checkbox">
                                <label for="kbli_${kbli.id}">${kbli.kode_kbli} - ${kbli.deskripsi_kbli}</label>
                            </div>`;
                        kbliCheckboxes.append(checkbox);
                    });

                    // Add search functionality
                    $('#search_kbli').on('keyup', function() {
                        const query = $(this).val().toLowerCase();
                        $('.kbli-checkbox').each(function() {
                            const label = $(this).next('label').text().toLowerCase();
                            $(this).parent().toggle(label.indexOf(query) > -1);
                        });
                    });
                });
        }
    });

     // Tampilkan KBLI yang dipilih dan simpan ke Set
    $(document).on('change', '.kbli-checkbox', function() {
        const kbliId = $(this).val();
        const isChecked = $(this).is(':checked');
        const label = $(this).next('label').text();

        // Jika dicentang, tambahkan ke Set dan tampilkan di daftar
        if (isChecked) {
            selectedKblis.add(parseInt(kbliId));
            $('#selected-kbli-list').append(`<li id="selected-${kbliId}">${label}</li>`);
        } else {
            // Jika dihapus centangnya, hilangkan dari Set dan daftar
            selectedKblis.delete(parseInt(kbliId));
            $(`#selected-${kbliId}`).remove();
        }
    });
});


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
