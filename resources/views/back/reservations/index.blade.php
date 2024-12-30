@extends('back.layouts.adminLayout')
@section('adminContent')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Reservations List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item">Reservations List</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Reservations List</h5>

                            </div>
                            <table class="table datatable">
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
                                            <td>${{ $reservation->total_price }}</td>
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
            </div>
        </section>

    </main>
@endsection
@push('scripts')
    <script>
        function confirmChangeStatus(reservationId) {
            Swal.fire({
                title: 'Are you sure you want to change the status?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('status-form-' + reservationId).submit();
                }
            });
        }
    </script>
@endpush
