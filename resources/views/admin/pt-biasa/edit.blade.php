<!-- Modal Edit PT Biasa -->
<div class="modal fade" id="editPTBiasaModal" tabindex="-1" aria-labelledby="editPTBiasaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editPTBiasaForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Update Method -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editPTBiasaModalLabel">Edit PT Biasa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input Fields -->
                    @include('admin.pt-biasa._form-fields')

                    <!-- Upload Foto KTP -->
                    <div class="form-group">
                        <label for="edit_foto_ktp">Upload Foto KTP</label>
                        <input type="file" class="form-control" id="edit_foto_ktp" name="foto_ktp[]" multiple accept="image/*" onchange="previewImages(event, 'edit-ktp-preview')">
                        <div id="edit-ktp-preview" class="preview-images-zone mt-3"></div>
                    </div>

                    <!-- Upload Foto NPWP -->
                    <div class="form-group">
                        <label for="edit_foto_npwp">Upload Foto NPWP</label>
                        <input type="file" class="form-control" id="edit_foto_npwp" name="foto_npwp[]" multiple accept="image/*" onchange="previewImages(event, 'edit-npwp-preview')">
                        <div id="edit-npwp-preview" class="preview-images-zone mt-3"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function previewImages(event, previewId) {
        var files = event.target.files;
        var previewZone = document.getElementById(previewId);
        previewZone.innerHTML = ""; // Clear previous images
    
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
    
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.setAttribute('src', e.target.result);
                img.setAttribute('class', 'preview-img');
                img.setAttribute('style', 'max-width: 100px; margin: 10px;');
                previewZone.appendChild(img);
            }
    
            reader.readAsDataURL(file);
        }
    }
    
   
    </script>
    