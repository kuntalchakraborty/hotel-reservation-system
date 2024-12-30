@extends('back.layouts.adminLayout')
@section('adminContent')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Room</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('rooms.index') }}">Rooms</a></li>
                    <li class="breadcrumb-item active">Edit Room</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <!-- Display Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Display Error Message -->
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Room Type -->
                            <div class="col-6 mb-3">
                                <label for="room_type_id" class="form-label">Room Type</label>
                                <select class="form-select" name="room_type_id" required>
                                    <option value="" disabled>Select Room Type</option>
                                    @foreach ($roomTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $room->room_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Room Number -->
                            <div class="col-6 mb-3">
                                <label for="room_number" class="form-label">Room Number</label>
                                <input type="text" class="form-control" name="room_number"
                                    value="{{ $room->room_number }}" required>
                            </div>

                            <!-- Price -->
                            <div class="col-6 mb-3">
                                <label for="price" class="form-label">Price / Night</label>
                                <input type="number" class="form-control" name="price" value="{{ $room->price }}"
                                    required>
                            </div>

                            <!-- Bed Count -->
                            <div class="col-6 mb-3">
                                <label for="bed_count" class="form-label">Bed Count</label>
                                <input type="number" class="form-control" name="bed_count" value="{{ $room->bed_count }}"
                                    required>
                            </div>

                            <!-- Bed Type -->
                            <div class="col-6 mb-3">
                                <label for="bed_type" class="form-label">Bed Type</label>
                                <input type="text" class="form-control" name="bed_type" value="{{ $room->bed_type }}"
                                    required>
                            </div>

                            <!-- Floor Number -->
                            <div class="col-6 mb-3">
                                <label for="floor_number" class="form-label">Floor Number</label>
                                <input type="number" class="form-control" name="floor_number"
                                    value="{{ $room->floor_number }}" required>
                            </div>

                            <!-- Room Status -->
                            <div class="col-6 mb-3">
                                <label for="room_status" class="form-label">Room Status</label>
                                <select class="form-select" name="room_status" required>
                                    <option value="available" {{ $room->room_status == 'available' ? 'selected' : '' }}>
                                        Available</option>
                                    <option value="unavailable"
                                        {{ $room->room_status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                </select>
                            </div>

                            <!-- Display Existing Images -->
                            <div class="mb-3">
                                <label for="images" class="form-label">Current Room Images</label>
                                <div class="row">
                                    @foreach ($room->images as $image)
                                        <div class="col-md-2" id="image-{{ $image->id }}">
                                            <img src="{{ asset('public/storage/' . $image->image_path) }}" class="img-thumbnail" alt="Room Image">
                                            <button type="button" class="btn btn-danger btn-sm remove-image" data-id="{{ $image->id }}">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Image Upload Input -->
                            <div class="mb-3">
                                <label for="images" class="form-label">Upload New Room Images</label>
                                <input type="file" class="form-control" id="image-input" name="images[]" multiple>
                                <div id="image-preview" class="mt-2"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Update Room</button>
                            <a href="{{ route('rooms.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#imageInput').on('change', function(e) {
                var files = e.target.files;
                $('#imagePreview').html('');
                if (files) {
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            var imageUrl = event.target.result;
                            var imagePreview = `
                            <div class="image-thumbnail position-relative d-inline-block m-2">
                                <img src="${imageUrl}" class="img-thumbnail" width="100">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" onclick="removeImage(this)">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>`;
                            $('#imagePreview').append(imagePreview);
                        };

                        reader.readAsDataURL(file);
                    }
                }
            });
        });

        function removeImage(button) {
            $(button).closest('.image-thumbnail').remove();
        }

        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 3000);

        $(document).ready(function() {
            $('.remove-image').on('click', function() {
                var imageId = $(this).data('id');
                var imageElement = $('#image-' + imageId);
                const deleteUrl = "{{ url('admin/room_images') }}/" + imageId;

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response.success) {
                                    imageElement.remove();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your image has been deleted.',
                                        'success'
                                    );
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'There was an issue deleting the image.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue with the request.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#image-input').on('change', function(event) {
                $('#image-preview').empty();
                let files = event.target.files;

                $.each(files, function(index, file) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        let imageUrl = e.target.result;
                        let imagePreview = `
                        <div class="image-container position-relative d-inline-block mr-2" style="width: 100px; height: 100px;">
                            <img src="${imageUrl}" class="img-thumbnail" style="width: 100%; height: 100%; object-fit: cover;">
                            <button type="button" class="btn-remove-image position-absolute top-0 start-100 translate-middle p-1 bg-danger border-0 rounded-circle" style="z-index: 10;" data-index="${index}">&times;</button>
                        </div>
                    `;
                        $('#image-preview').append(imagePreview);
                    };
                    reader.readAsDataURL(file);
                });
            });
            $(document).on('click', '.btn-remove-image', function() {
                let imageContainer = $(this).closest('.image-container');
                let fileIndex = $(this).data('index');
                imageContainer.remove();
                let input = $('#image-input')[0];
                let files = Array.from(input.files);
                files.splice(fileIndex, 1);
                let dataTransfer = new DataTransfer();
                files.forEach(file => dataTransfer.items.add(file));
                input.files = dataTransfer.files;
            });
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 3000);
        });

    </script>
@endpush
