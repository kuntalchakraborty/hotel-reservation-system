@extends('back.layouts.adminLayout')
@section('adminContent')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-6 col-md-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Bookings</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$reservationscount}}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-6 col-xl-12">

                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Customers</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$totalusers}}</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->



                        <!-- Recent Sales -->
                        <div class="col-lg-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Recent Booking <span>| Today</span></h5>
                                    <div class="table-responsive">
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Room Type</th>
                                                <th>Room Number</th>
                                                <th>User</th>
                                                <th>Phone Number</th>
                                                <th>Check-in</th>
                                                <th>Check-out</th>
                                                <th>Guests</th>
                                                <th>Total Price</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reservations as $reservation)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $reservation->room_type->name }}</td>
                                                    <td>{{ $reservation->room->room_number }}</td>
                                                    <td>{{ $reservation->user->name }}</td>
                                                    <td>{{ $reservation->user->phone }}</td>
                                                    <td>{{ $reservation->check_in }}</td>
                                                    <td>{{ $reservation->check_out }}</td>
                                                    <td>{{ $reservation->number_of_guests }}</td>
                                                    <td>₹{{ $reservation->total_price }}</td>
                                                    <td>
                                                        <form action="{{ route('reservation.updateStatus', $reservation->id) }}"
                                                            method="POST" id="status-form-{{ $reservation->id }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="status" class="form-control"
                                                                onchange="confirmChangeStatus({{ $reservation->id }})"
                                                                style="background-color:
                                                                {{ $reservation->status == 'pending' ? '#ffc107' : ($reservation->status == 'approved' ? '#d4edda' : '#f8d7da') }};
                                                                color:
                                                                {{ $reservation->status == 'pending' ? '#721c24' : ($reservation->status == 'approved' ? '#155724' : '#721c24') }};">
                                                                <option value="pending"
                                                                    {{ $reservation->status == 'pending' ? 'selected' : '' }}
                                                                    class="bg-warning text-white"
                                                                    style="{{ $reservation->status == 'pending' ? 'background-color: #f8d7da; color: #721c24;' : '' }}">
                                                                    Pending
                                                                </option>
                                                                <option value="approved"
                                                                    {{ $reservation->status == 'approved' ? 'selected' : '' }}
                                                                    class="bg-success text-white"
                                                                    style="{{ $reservation->status == 'approved' ? 'background-color: #d4edda; color: #155724;' : '' }}">
                                                                    Approved
                                                                </option>
                                                                <option value="canceled"
                                                                    {{ $reservation->status == 'canceled' ? 'selected' : '' }}
                                                                    class="bg-danger text-dark"
                                                                    style="{{ $reservation->status == 'canceled' ? 'background-color: #f8d7da; color: #721c24;' : '' }}">
                                                                    Canceled
                                                                </option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Recent Sales -->
                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    @push('stylesheet')
    @endpush
    @push('scripts')
        <!-- Sweet-alert js  -->
    @endpush
@endsection
