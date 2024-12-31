@extends('front.layouts.frontlayout')
@push('stylesheet')
    <link href="{{ asset('public/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/simple-datatables/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">
@endpush
@section('adminContent')
    <section class="banner inner-banner"
        style="background-image: url({{ asset('public/front/images/beautiful-umbrella-chair-around-swimming-pool-hotel-resort.jpg') }});">
        <div class="container">
            <div class="banner-text">
                <h1>User Dashboard</h1>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>User Dashboard</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section profile" style="margin-top: 50px">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if (auth()->user()->user_img)
                            <img src="{{ asset('public/storage/' . auth()->user()->user_img) }}" alt="Profile"
                                class="rounded-circle">
                        @endif
                        <h2>{{ auth()->user()->name }}</h2>

                        <!-- Logout Button -->
                        <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Booking
                                    History</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img id="profileImagePreview"
                                                src="{{ asset('public/storage/' . auth()->user()->user_img) }}"
                                                alt="Profile" class="img-thumbnail" width="150" style="display: block;">
                                            <input type="file" name="user_img" id="profileImageInput"
                                                class="form-control-file" accept="image/*" style="display: none;"
                                                onchange="previewImage(event)">

                                            <div class="pt-2">
                                                <label for="profileImageInput" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-upload"></i> Upload Image
                                                </label>
                                                <button type="button" class="btn btn-danger btn-sm " id="removeBtn"
                                                    style="display: {{ auth()->user()->user_img ? 'inline-block' : 'none' }};">
                                                    <i class="bi bi-trash"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName"
                                                value="{{ auth()->user()->name }}">
                                        </div>
                                    </div>



                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Phone"
                                                value="{{ auth()->user()->phone }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email"
                                                value="{{ auth()->user()->email }}">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="cmn-btn">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Room Type</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Guests</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reservations as $reservation)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $reservation->room_type->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('d-m-Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('d-m-Y') }}</td>
                                                <td>{{ $reservation->number_of_guests }}</td>
                                                <td>₹{{ $reservation->total_price }}</td>
                                                <td>
                                                    @if ($reservation->status == 'approved')
                                                        <span class="badge bg-success">Approved</span>
                                                    @elseif ($reservation->status == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif ($reservation->status == 'canceled')
                                                        <span class="badge bg-danger">Canceled</span>
                                                    @else
                                                        <span class="btn btn-secondary">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($reservation->status != 'canceled')
                                                        <form
                                                            action="{{ route('cancel-reservation', ['id' => encrypt($reservation->id)]) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Cancel</button>
                                                        </form>
                                                    @else
                                                        <span class="text-muted">Canceled</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/chart.js') }}/chart.umd.js')}}"></script>
    <script src="{{ asset('public/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('public/assets/js/main.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/sweetalert2.all.min.js') }}"></script>
    <script>
        function previewImage(event) {
            const output = document.getElementById('profileImagePreview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    output.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
        $(document).ready(function() {
            $('#profileImageInput').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profileImagePreview').attr('src', e.target.result).show();
                    $('#uploadBtn').show();
                    $('#removeBtn').show();
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#uploadBtn').click(function() {
                alert('Image uploaded successfully (client-side only).');
            });
            $('#removeBtn').click(function() {
                $('#profileImageInput').val('');
                $('#profileImagePreview').hide();
                $('#uploadBtn').hide();
                $('#removeBtn').hide();
            });
        });
    </script>
@endpush
