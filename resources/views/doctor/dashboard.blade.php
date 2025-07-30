@extends('layout.doctor')

@section('content')
    <div class="main-content">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="mb-1">Selamat Datang, Dr. {{ Auth::user()->name }}!</h2>
                <p class="text-muted">Here's what's happening with your patients today.</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-number">24</div>
                    <div class="stats-label">Total Patients</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #27ae60, #229954);">
                        <i class="fas fa-prescription"></i>
                    </div>
                    <div class="stats-number">8</div>
                    <div class="stats-label">Today's Prescriptions</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stats-number">12</div>
                    <div class="stats-label">Appointments</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stats-number">3</div>
                    <div class="stats-label">Urgent Cases</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-3">Quick Actions</h4>
            </div>
            <div class="col-md-3 mb-3">
                <a href="#" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h6>Add New Patient</h6>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="#" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="fas fa-prescription-bottle"></i>
                    </div>
                    <h6>Write Prescription</h6>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="#" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <h6>Schedule Appointment</h6>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="#" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h6>Search Patient</h6>
                </a>
            </div>
        </div>

        <!-- Recent Activity and Upcoming Appointments -->
        <div class="row">
            <!-- Recent Prescriptions -->
            <div class="col-lg-8 mb-4">
                <div class="card recent-card">
                    <div class="card-header bg-transparent border-0 pt-3">
                        <h5 class="mb-0">Recent Prescriptions</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                <tr>
                                    <th>Patient</th>
                                    <th>Medication</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="patient-avatar me-2">JD</div>
                                            <span>John Doe</span>
                                        </div>
                                    </td>
                                    <td>Amoxicillin 500mg</td>
                                    <td>Today, 2:30 PM</td>
                                    <td><span class="badge badge-status status-pending">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary-custom">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="patient-avatar me-2">MS</div>
                                            <span>Mary Smith</span>
                                        </div>
                                    </td>
                                    <td>Lisinopril 10mg</td>
                                    <td>Today, 1:15 PM</td>
                                    <td><span class="badge badge-status status-completed">Dispensed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary-custom">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="patient-avatar me-2">RJ</div>
                                            <span>Robert Johnson</span>
                                        </div>
                                    </td>
                                    <td>Metformin 850mg</td>
                                    <td>Yesterday, 4:45 PM</td>
                                    <td><span class="badge badge-status status-urgent">Urgent</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary-custom">View</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Appointments -->
            <div class="col-lg-4 mb-4">
                <div class="card recent-card">
                    <div class="card-header bg-transparent border-0 pt-3">
                        <h5 class="mb-0">Today's Appointments</h5>
                    </div>
                    <div class="card-body">
                        <div class="appointment-item d-flex align-items-center mb-3 p-2 rounded"
                             style="background-color: #f8f9fa;">
                            <div class="patient-avatar me-3">SA</div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Sarah Anderson</h6>
                                <small class="text-muted">3:00 PM - Routine Checkup</small>
                            </div>
                        </div>
                        <div class="appointment-item d-flex align-items-center mb-3 p-2 rounded"
                             style="background-color: #f8f9fa;">
                            <div class="patient-avatar me-3">MW</div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Michael Wilson</h6>
                                <small class="text-muted">4:30 PM - Follow-up</small>
                            </div>
                        </div>
                        <div class="appointment-item d-flex align-items-center mb-3 p-2 rounded"
                             style="background-color: #f8f9fa;">
                            <div class="patient-avatar me-3">LB</div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Lisa Brown</h6>
                                <small class="text-muted">5:15 PM - Consultation</small>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-primary-custom">View All Appointments</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
