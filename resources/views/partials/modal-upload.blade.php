<div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="modalUploadLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalUploadLabel"><i class='bx bxs-image-add'></i> Upload Photo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" placeholder="Insert a title..." name="title">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" placeholder="Insert an description" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <label for="image-uploadify" class="form-label">Description</label>
                            <input id="image-uploadify" class="image-uploadify" type="file" accept="image/*" name="image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // $(document).ready(function() {
    //     $('.image-uploadify').imageUploader();
    // });
</script>
