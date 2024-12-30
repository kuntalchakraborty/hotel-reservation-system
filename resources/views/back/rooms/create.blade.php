@extends('back.layouts.adminLayout')
@section('adminContent')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Add Room</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('rooms.index') }}">Rooms</a></li>
                    <li class="breadcrumb-item active">Add Room</li>
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
                    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="room_type_id" class="form-label">Room Type</label>
                                <select class="form-select" name="room_type_id" required>
                                    <option value="" disabled selected>Select Room Type</option>
                                    @foreach ($roomTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="room_number" class="form-label">Room Number</label>
                                <input type="text" class="form-control" name="room_number" required>
                            </div>
                            <div class=" col-6 mb-3">
                                <label for="price" class="form-label">Price / Night</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                            <div class=" col-6 mb-3">
                                <label for="bed_count" class="form-label">Bed Count</label>
                                <input type="number" class="form-control" name="bed_count" required>
                            </div>
                            <div class=" col-6 mb-3">
                                <label for="bed_type" class="form-label">Bed Type</label>
                                <input type="text" class="form-control" name="bed_type" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="floor_number" class="form-label">Floor Number</label>
                                <input type="number" class="form-control" name="floor_number" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="room_status" class="form-label">Room Status</label>
                                <select class="form-select" name="room_status" required>
                                    <option value="available">Available</option>
                                    <option value="unavailable">Unavailable</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="images" class="form-label">Room Images</label>
                                <input type="file" class="form-control" name="images[]" id="image-input" multiple>
                                <div id="image-preview" class="mt-2"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Room</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script>
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
                            <button type="button" class="btn-remove-image position-absolute top-0 start-100 translate-middle p-1 bg-danger border-0 rounded-circle" style="z-index: 10;">&times;</button>
                        </div>
                    `;
                        $('#image-preview').append(imagePreview);
                    };
                    reader.readAsDataURL(file);
                });
            });

            $(document).on('click', '.btn-remove-image', function() {
                let imageContainer = $(this).closest('.image-container');
                imageContainer.remove();
                let input = $('#image-input')[0];
                let files = Array.from(input.files);
                let index = files.indexOf(input.files[0]);

                if (index > -1) {
                    files.splice(index, 1);
                }
                let dataTransfer = new DataTransfer();
                files.forEach(file => dataTransfer.items.add(file));
                input.files = dataTransfer.files;
            });
        });

        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 3000);
    </script>
@endpush
