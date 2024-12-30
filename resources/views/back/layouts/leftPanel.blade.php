<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard Link -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <!-- User Menu -->
        <li class="nav-item">
            <!-- "User" dropdown toggle with dynamic active state -->
            <a class="nav-link {{ request()->is('admin/user-list') || request()->is('admin/users*') ? 'active' : '' }}"
                data-bs-target="#user-nav" data-bs-toggle="collapse" href="#"
                aria-expanded="{{ request()->is('admin/user-list') || request()->is('admin/users*') ? 'true' : 'false' }}">
                <i class="bi bi-menu-button-wide"></i><span>User</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <!-- User dropdown menu with dynamic 'show' class based on route -->
            <ul id="user-nav"
                class="nav-content collapse {{ request()->is('admin/user-list') || request()->is('admin/users*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <!-- Users List Link with dynamic active state -->
                <li>
                    <a href="{{ route('admin.userlist') }}"
                        class="{{ request()->routeIs('admin.userlist') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Users List</span>
                    </a>
                </li>
            </ul>
        </li><!-- End User Menu -->


        <!-- Room Types Menu -->
        <li class="nav-item">
            <!-- "Room Types" dropdown toggle with dynamic active state -->
            <a class="nav-link {{ request()->is('admin/room-types*') ? 'active' : '' }}"
                data-bs-target="#room-types-nav" data-bs-toggle="collapse" href="#"
                aria-expanded="{{ request()->is('admin/room-types*') ? 'true' : 'false' }}">
                <i class="bi bi-building"></i><span>Room Types</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <!-- Room Types dropdown menu with dynamic 'show' class based on route -->
            <ul id="room-types-nav" class="nav-content collapse {{ request()->is('admin/room-types*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <!-- Room Types Index Link with dynamic active state -->
                <li>
                    <a href="{{ route('room-types.index') }}"
                        class="{{ request()->routeIs('room-types.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>All Room Types</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Room Types Menu -->

        <!-- Rooms Menu -->
        <li class="nav-item">
            <!-- "Rooms" dropdown toggle with dynamic active state -->
            <a class="nav-link {{ request()->is('admin/rooms*') ? 'active' : '' }}" data-bs-target="#rooms-nav"
                data-bs-toggle="collapse" href="#"
                aria-expanded="{{ request()->is('admin/rooms*') ? 'true' : 'false' }}">
                <i class="bi bi-door-closed"></i><span>Rooms</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <!-- Rooms dropdown menu with dynamic 'show' class based on route -->
            <ul id="rooms-nav" class="nav-content collapse {{ request()->is('admin/rooms*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <!-- Rooms Index Link -->
                <li>
                    <a href="{{ route('rooms.index') }}"
                        class="{{ request()->routeIs('rooms.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>All Rooms</span>
                    </a>
                </li>
                <!-- Add Room Link -->
                <li>
                    <a href="{{ route('rooms.create') }}"
                        class="{{ request()->routeIs('rooms.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Add Room</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Rooms Menu -->

        <!-- Reservations Menu -->
        <li class="nav-item">
            <!-- "Reservations" dropdown toggle with dynamic active state -->
            <a class="nav-link {{ request()->is('admin/reservations*') ? 'active' : '' }}"
                data-bs-target="#reservations-nav" data-bs-toggle="collapse" href="#"
                aria-expanded="{{ request()->is('admin/reservations*') ? 'true' : 'false' }}">
                <i class="bi bi-calendar-check"></i><span>Reservations</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <!-- Reservations dropdown menu with dynamic 'show' class based on route -->
            <ul id="reservations-nav"
                class="nav-content collapse {{ request()->is('admin/reservations*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <!-- All Reservations Link -->
                <li>
                    <a href="{{ route('reservations.index') }}"
                        class="{{ request()->routeIs('reservations.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>All Reservations</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Reservations Menu -->



    </ul>

</aside><!-- End Sidebar -->
