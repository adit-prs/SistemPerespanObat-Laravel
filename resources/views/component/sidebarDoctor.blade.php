<!-- Sidebar -->
<div class="sidebar">
    <nav class="nav flex-column py-3">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{route('dashboard')}}">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>
        <a class="nav-link {{ request()->routeIs('patients.index') ? 'active' : '' }}"
           href="{{route('patients.index')}}">
            <i class="fas fa-users me-2"></i>Patients
        </a>
    </nav>
</div>

