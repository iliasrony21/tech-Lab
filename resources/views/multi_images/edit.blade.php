<!DOCTYPE html>
<html>

<head>
    <title>Laravel Jquery Ajax CRUD - Edit Image</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Laravel Jquery Ajax CRUD-Edit Page</h2>

        <form id="editForm">
            <input type="hidden" id="imageId" value="{{ $image->id }}">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card p-2 py-4">
                        <div class="form-group py-2">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $image->title }}">
                            <div class="invalid-feedback">Title is required.</div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="images">New Image:</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple>
                            {{--  <div class="invalid-feedback">Please select at least one image.</div>  --}}
                        </div>
                        <div id="imagePreview" class="mb-3">
                            <img src="/storage/{{ $image->multi_images }}" class="img-thumbnail" width="150" alt="">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>

        <hr>

        <a href="{{ url('/get_images') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            //Edit form submit with ajax
            $('#editForm').on('submit', function(e) {
                e.preventDefault();

                // Client-side validation
                let isValid = true;
                let title = $('#title').val();
                let images = $('#images')[0].files;
                let maxFileSize = 2 * 1024 * 1024; // 2MB

                // Reset validation
                $('#title').removeClass('is-invalid');
                $('#images').removeClass('is-invalid');

                if (title.trim() === '') {
                    $('#title').addClass('is-invalid');
                    isValid = false;
                }

                {{--  if (images.length === 0) {
                    $('#images').addClass('is-invalid');
                    isValid = false;
                } else {
                    Array.from(images).forEach(file => {
                        if (file.size > maxFileSize) {
                            alert(`File size should be less than 2MB. ${file.name} is too large.`);
                            isValid = false;
                        }
                    });
                }  --}}

                if (!isValid) {
                    return;
                }

                let formData = new FormData(this);
                let imageId = $('#imageId').val();

                $.ajax({
                    url: `/update/${imageId}`,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-HTTP-Method-Override': 'PUT' // Spoofing PUT method
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(response) {
                        console.log(response);
                        if(response.responseJSON && response.responseJSON.errors) {
                            let errors = response.responseJSON.errors;
                            if(errors.title) {
                                alert(errors.title[0]);
                            }
                            if(errors.images) {
                                alert(errors.images[0]);
                            }
                        }
                    }
                });
            });
 //image preview
            $('#images').on('change', function() {
                $('#imagePreview').empty();
                let files = this.files;
                if (files) {
                    Array.from(files).forEach(file => {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $('#imagePreview').append(`
                                <img src="${e.target.result}" class="img-thumbnail m-1" width="100" />
                            `);
                        }
                        reader.readAsDataURL(file);
                    });
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
