<!DOCTYPE html>
<html>

<head>
    <title>Laravel Jquery Ajax CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Multi Image CRUD</h2>
        <a class="btn btn-primary" href="{{ route('show_images') }}">Go To Laravel Ajax Crud</a>

        <hr>

        <div id="imageList"></div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>



{{--  <!DOCTYPE html>
<html>

<head>
    <title>Laravel Jquery Ajax CRUD</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    </head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Multi Image CRUD</h2>

        <form id="uploadForm">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card p-2 py-4">
                        <div class="form-group py-2">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="images">Images:</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple required>
                        </div>
                        <div id="imagePreview" class="mb-3">
                            <img src="{{ asset('images/no_img.png') }}" style="width: 90px;" alt="">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </div>
        </form>

        <hr>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="imageTableBody">
                <!-- Dynamic content will be inserted here by JavaScript -->
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        $(document).ready(function() {
            fetchImages();

            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: '/store_image',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        fetchImages(); // Fetch the updated image list
                        $('#uploadForm')[0].reset(); // Clear the form
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
            });

            function fetchImages() {
                $.ajax({
                    url: '/get_images_ajax',
                    type: 'GET',
                    success: function(response) {
                        let imageTableBody = $('#imageTableBody');
                        imageTableBody.empty(); // Clear existing rows

                        if (response.length > 0) {
                            response.forEach(function(image) {
                                imageTableBody.append(`
                                    <tr id="image-${image.id}">
                                        <td>${image.id}</td>
                                        <td>${image.title}</td>
                                        <td>
                                            <img src="/storage/${image.multi_images}" class="img-thumbnail" width="80" alt="Image">
                                        </td>
                                        <td>${image.created_at}</td>
                                        <td>
                                            <a href="/edit/${image.id}" class="btn btn-warning btn-sm">Edit</a>
                                            <button class="btn btn-danger btn-sm" onclick="deleteImage(${image.id})">Delete</button>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            imageTableBody.append(`
                                <tr>
                                    <td colspan="5" class="text-center">No Data Found</td>
                                </tr>
                            `);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }




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

    </script>
</body>

</html>  --}}

