@extends('back.layouts.adminLayout')
@push('stylesheet')
    <style>
        #calendar {
            margin-top: 20px;
            border: 1px solid #67a5bc;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 14px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            height: 500px;
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        #calendar:hover {
            transform: scale(1.01);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
        }
        .fc-event {
            background-color: #67a5bc !important;
            color: white !important;
            border: 1px solid #4e8593 !important;
            font-weight: 500;
            padding: 5px;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .fc-event:hover {
            background-color: #4e8593 !important;
            transform: scale(1.02);
        }
        .fc-toolbar {
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 2px solid #67a5bc;
            border-radius: 12px;
            background-color: #e9ecef;
            font-size: 16px;
            font-weight: bold;
        }
        .fc-daygrid-day {
            border: 1px solid #dee2e6;
            transition: background-color 0.3s ease;
        }
        .fc-daygrid-day:hover {
            background-color: #e3f2fd;
        }
        .fc-day-today {
            background-color: #67a5bc !important;
            color: white !important;
            font-weight: bold;
            border-radius: 8px;
        }
    </style>
@endpush
@section('adminContent')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Rooms List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item">Rooms List</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <!-- ======================================= Calendar View ======================================== -->
                <div class="col-lg-12">
                    <section class="room-availability">
                        <div class="container">
                            <div id="calendar"></div>
                        </div>
                    </section>
                </div>
                <!-- ======================================= End Calendar View ======================================== -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Rooms List</h5>
                                <a href="{{ route('rooms.create') }}" class="btn btn-success">Add Room</a>
                            </div>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Room Number</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Bed Count</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $room)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $room->room_number }}</td>
                                            <td>{{ $room->roomType->name ?? 'N/A' }}</td>
                                            <td>INR {{ $room->price }}/ Night</td>
                                            <td>{{ $room->bed_count }}</td>
                                            <td class="text-center">
                                                @if ($room->room_status == 'available')
                                                    <span class="badge bg-success">{{ ucfirst($room->room_status) }}</span>
                                                @elseif($room->room_status == 'unavailable')
                                                    <span class="badge bg-danger">{{ ucfirst($room->room_status) }}</span>
                                                @else
                                                    <span class="badge bg-warning">{{ ucfirst($room->room_status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('rooms.edit', $room->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form id="delete-room-form-{{ $room->id }}"
                                                    action="{{ route('rooms.destroy', $room->id) }}" method="POST"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDeletion({{ $room->id }})">Delete</button>
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
    <script src="{{ asset('public/assets/js/index.global.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/moment.min.js') }}"></script>
    <script>
        function confirmDeletion(roomId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-room-form-' + roomId).submit();
                }
            });
        }
    </script>
    <script>
     $(document).ready(function() {
    var calendarEl = $('#calendar')[0];
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
            @foreach ($rooms as $room)
                {
                    title: 'Room Number-({{ $room->room_number }})',
                    start: '{{ $room->available_from ?? \Carbon\Carbon::now()->format('Y-m-d') }}',
                    end: '{{ \Carbon\Carbon::now()->addYears(1)->format('Y-m-d') }}',
                    backgroundColor: '{{ $room->room_status == 'available' ? '#28a745' : ($room->room_status == 'unavailable' ? '#dc3545' : '#ffc107') }}',
                    borderColor: '#fff',
                    textColor: '#fff',
                },
            @endforeach
        ],
        eventClick: function(info) {
            var startDate = moment(info.event.start).format('DD-MM-YYYY');
            // var endDate = moment(info.event.extendedProps.end).format('DD-MM-YYYY');
            Swal.fire({
                title: info.event.title,
                html: "<p>Availability from: " + startDate  + "</p>",
                icon: "info",
                confirmButtonText: "OK"
            });
        }
    });
    calendar.render();
});

    </script>

@endpush
