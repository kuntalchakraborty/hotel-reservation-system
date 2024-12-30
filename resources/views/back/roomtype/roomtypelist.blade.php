@extends('back.layouts.adminLayout')
@section('adminContent')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Room Type List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item">Room Type List</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Room Type List</h5>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal">
                                    Add Room Type
                                </button>
                            </div>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Max Occupancy</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roomTypes as $roomType)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $roomType->name }}</td>
                                            <td>{{ $roomType->description }}</td>
                                            <td>{{ $roomType->max_occupancy }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm editRoomType"
                                                    data-id="{{ $roomType->id }}" data-name="{{ $roomType->name }}"
                                                    data-description="{{ $roomType->description }}"
                                                    data-max_occupancy="{{ $roomType->max_occupancy }}"
                                                    {{-- data-security="{{ $roomType->security }}" --}}
                                                    data-air_conditioned="{{ $roomType->air_conditioned }}"
                                                    data-free_wifi="{{ $roomType->free_wifi }}"
                                                    data-parking="{{ $roomType->parking }}"
                                                    data-restaurant="{{ $roomType->restaurant }}"
                                                    data-complimentary_breakfast="{{ $roomType->complimentary_breakfast }}"
                                                    {{-- data-hair_dryer="{{ $roomType->hair_dryer }}" --}}
                                                    data-mini_fridge="{{ $roomType->mini_fridge }}"
                                                    data-room_service="{{ $roomType->room_service }}"
                                                    data-swimming_pool="{{ $roomType->swimming_pool }}">
                                                    Edit
                                                </button>
                                                <button class="btn btn-danger btn-sm deleteRoomType"
                                                    data-id="{{ $roomType->id }}">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Add Room Type Modal -->
        <div class="modal fade" id="addRoomTypeModal" tabindex="-1" aria-labelledby="addRoomTypeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoomTypeModalLabel">Add Room Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addRoomTypeForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="max_occupancy" class="form-label">Max Occupancy</label>
                                <input type="number" class="form-control" id="max_occupancy" name="max_occupancy" required>
                            </div>

                            <!-- Features Checkboxes -->
                            @foreach (['air_conditioned', 'free_wifi', 'parking', 'restaurant', 'complimentary_breakfast','mini_fridge', 'room_service', 'swimming_pool'] as $feature)
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="{{ $feature }}"
                                        name="{{ $feature }}">
                                    <label class="form-check-label"
                                        for="{{ $feature }}">{{ ucwords(str_replace('_', ' ', $feature)) }}</label>
                                </div>
                            @endforeach

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Room Type Modal -->
        <div class="modal fade" id="editRoomTypeModal" tabindex="-1" aria-labelledby="editRoomTypeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoomTypeModalLabel">Edit Room Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editRoomTypeForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="roomTypeId" name="roomTypeId">

                            <div class="mb-3">
                                <label for="name" class="form-label">Room Type Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="edit_description" name="description"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="max_occupancy" class="form-label">Max Occupancy</label>
                                <input type="number" class="form-control" id="edit_max_occupancy" name="max_occupancy">
                            </div>
                            @foreach (['air_conditioned', 'free_wifi', 'parking', 'restaurant', 'complimentary_breakfast','mini_fridge', 'room_service', 'swimming_pool'] as $feature)
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="edit_{{ $feature }}"
                                        name="{{ $feature }}">
                                    <label class="form-check-label"
                                        for="edit_{{ $feature }}">{{ ucwords(str_replace('_', ' ', $feature)) }}</label>
                                </div>
                            @endforeach

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // ADD Room Type
            $('#addRoomTypeForm').on('submit', function(e) {
                e.preventDefault();
                $(this).find('input[type="checkbox"]').each(function() {
                    if (!this.checked) {
                        $(this).val('false');
                    }
                });
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait...',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit form data via AJAX
                $.ajax({
                    url: '{{ route('room-types.store') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        Swal.fire('Success', response.message, 'success').then(() => {
                            $('#addRoomTypeModal').modal('hide');
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr
                            .responseJSON.message : 'Failed to add Room Type';
                        Swal.fire('Error', errorMessage, 'error');
                    }
                });
            });

            // Delete Room Type
            $(document).on('click', '.deleteRoomType', function() {
                const roomTypeId = $(this).data('id');
                const deleteUrl = "{{ url('admin/room-types') }}/" + roomTypeId;

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                            success: function(response) {
                                Swal.fire('Deleted!', response.message, 'success').then(
                                    () => {
                                        location.reload();
                                    });
                            },
                            error: function() {
                                Swal.fire('Error', 'Failed to delete Room Type',
                                    'error');
                            },
                        });
                    }
                });
            });

            // Edit Room Type
            $('#editRoomTypeForm').on('submit', function(e) {
                e.preventDefault();
                $(this).find('input[type="checkbox"]').each(function() {
                    if (!this.checked) {
                        $(this).val('false');
                    }
                });
                const formData = $(this).serialize();
                const roomTypeId = $('#roomTypeId').val();
                const updateUrl = "{{ url('admin/room-types') }}/" + roomTypeId;

                $.ajax({
                    url: updateUrl,
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        Swal.fire('Success', response.message, 'success').then(() => {
                            $('#editRoomTypeModal').modal('hide');
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr
                            .responseJSON.message : 'Failed to update Room Type';
                        Swal.fire('Error', errorMessage, 'error');
                    }
                });
            });

            $(document).on('click', '.editRoomType', function() {
                const roomTypeId = $(this).data('id');
                const name = $(this).data('name');
                const description = $(this).data('description');
                const maxOccupancy = $(this).data('max_occupancy');
                const features = {
                    //security: $(this).data('security'),
                    air_conditioned: $(this).data('air_conditioned'),
                    free_wifi: $(this).data('free_wifi'),
                    parking: $(this).data('parking'),
                    restaurant: $(this).data('restaurant'),
                    complimentary_breakfast: $(this).data('complimentary_breakfast'),
                    // hair_dryer: $(this).data('hair_dryer'),
                    mini_fridge: $(this).data('mini_fridge'),
                    room_service: $(this).data('room_service'),
                    swimming_pool: $(this).data('swimming_pool')
                };

                $('#editRoomTypeModal').modal('show');
                $('#roomTypeId').val(roomTypeId);
                $('#edit_name').val(name);
                $('#edit_description').val(description);
                $('#edit_max_occupancy').val(maxOccupancy);

                $.each(features, function(key, value) {
                    if (value) {
                        $('#edit_' + key).prop('checked', true);
                    } else {
                        $('#edit_' + key).prop('checked', false);
                    }
                });
            });
            // Get Room Type
            $('#editRoomTypeModal').on('hidden.bs.modal', function() {
                $('#editRoomTypeForm')[0].reset();
                $('input[type="checkbox"]').prop('checked', false);
            });
        });
    </script>
@endpush
