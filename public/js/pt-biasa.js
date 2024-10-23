$(document).ready(function() {
    const selectedKblis = new Set();

    $('#kbli_category_id').on('change', function() {
        const categoryId = $(this).val();
        const kbliCheckboxes = $('#kbli-checkboxes');
        $('#search-container').hide();
        if (categoryId) {
            fetch(`/kbli/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    $('#search-container').show();
                    kbliCheckboxes.empty();
                    data.forEach(kbli => {
                        const isChecked = selectedKblis.has(kbli.id) ? 'checked' : '';
                        const checkbox = `
                            <div>
                                <input type="checkbox" name="kbli_ids[]" value="${kbli.id}" id="kbli_${kbli.id}" class="kbli-checkbox" ${isChecked}>
                                <label for="kbli_${kbli.id}">${kbli.kode_kbli} - ${kbli.deskripsi_kbli}</label>
                            </div>
                        `;
                        kbliCheckboxes.append(checkbox);
                    });

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

    function previewImages(event, previewId) {
        const files = event.target.files;
        const previewContainer = document.getElementById(previewId);
        previewContainer.innerHTML = '';
        for (const file of files) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'm-2');
                img.style.width = '150px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }

    $('#foto_ktp').on('change', function(event) {
        previewImages(event, 'ktp-preview');
    });
    $('#foto_npwp').on('change', function(event) {
        previewImages(event, 'npwp-preview');
    });
});


$(document).ready(function() {
    const selectedKblis = new Set(); // Menyimpan KBLI yang telah dipilih

    // Ketika kategori KBLI dipilih
    $('#kbli_category_id').on('change', function() {
        const categoryId = $(this).val();
        const kbliCheckboxes = $('#kbli-checkboxes');
        $('#search-container').hide(); // Sembunyikan input pencarian sementara

        // Ambil KBLI berdasarkan kategori yang dipilih
        if (categoryId) {
            fetch(`/kbli/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    $('#search-container').show(); // Tampilkan input pencarian

                    // Kosongkan checkbox KBLI dari kategori yang sebelumnya (tetapi simpan yang dipilih)
                    kbliCheckboxes.empty();

                    // Tambahkan checkbox baru sesuai kategori yang dipilih
                    data.forEach(kbli => {
                        // Buat checkbox untuk KBLI baru
                        const isChecked = selectedKblis.has(kbli.id) ? 'checked' : ''; // Cek apakah KBLI sudah dipilih sebelumnya
                        const checkbox = `
                            <div>
                                <input type="checkbox" name="kbli_ids[]" value="${kbli.id}" id="kbli_${kbli.id}" class="kbli-checkbox" ${isChecked}>
                                <label for="kbli_${kbli.id}">${kbli.kode_kbli} - ${kbli.deskripsi_kbli}</label>
                            </div>
                        `;
                        kbliCheckboxes.append(checkbox);
                    });

                    // Tambahkan pencarian
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