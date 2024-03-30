<!-- Modal -->
<div class="modal fade" id="uploadCVModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- <form action="" enctype="multipart/form-data"> -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tải CV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tên CV</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1"
                        placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">File</label>
                    <input type="file" class="form-control" id="fileInput" onChange="validateFile()">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- </form> -->
    </div>
</div>
<script>
function validateFile() {
    var fileInput = document.getElementById("fileInput");
    var filePath = fileInput.value;
    var allowedExtensions = /(\.pdf)$/i; // Chỉ cho phép file có phần mở rộng là .pdf
    if (!allowedExtensions.exec(filePath)) {
        alert('Chỉ được phép tải lên file PDF.');
        fileInput.value = '';
    } else {
        alert('File PDF đã được tải lên thành công.');
    }
}
</script>