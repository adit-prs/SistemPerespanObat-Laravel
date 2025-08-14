@extends('layout.pharmacist')

@section('content')
    <div class="main-content">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="mb-1">Welcome back, Sarah!</h2>
                <p class="text-muted">Here's your pharmacy overview for today.</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-icon" style="background: var(--gradient-orange);">
                        <i class="fas fa-prescription"></i>
                    </div>
                    <div class="stats-number">18</div>
                    <div class="stats-label">Pending Prescriptions</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-icon" style="background: var(--gradient-green);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stats-number">42</div>
                    <div class="stats-label">Processed Today</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-icon" style="background: var(--gradient-primary);">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stats-number">$2,847</div>
                    <div class="stats-label">Today's Revenue</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stats-number">5</div>
                    <div class="stats-label">Low Stock Alerts</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-3">Quick Actions</h4>
            </div>
            <div class="col-md-3 mb-3">
                <a href="prescriptions-list.html" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="fas fa-prescription-bottle"></i>
                    </div>
                    <h6>Process Prescription</h6>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="#" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <h6>Print Receipt</h6>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="#" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h6>Search Customer</h6>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="#" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <h6>Check Inventory</h6>
                </a>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="row">
            <!-- Pending Prescriptions -->
            <div class="col-lg-8 mb-4">
                <div class="card recent-card">
                    <div class="card-header bg-transparent border-0 pt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Pending Prescriptions</h5>
                            <a href="prescriptions-list.html" class="btn btn-primary-custom btn-sm">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                <tr>
                                    <th>Prescription ID</th>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Medications</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><strong>RX2024001</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="patient-avatar me-2">JD</div>
                                            <span>John Doe</span>
                                        </div>
                                    </td>
                                    <td>Dr. Smith</td>
                                    <td>Amoxicillin 500mg</td>
                                    <td><span class="badge badge-status status-pending">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-success-custom">Process</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>RX2024002</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="patient-avatar female me-2">MS</div>
                                            <span>Mary Smith</span>
                                        </div>
                                    </td>
                                    <td>Dr. Johnson</td>
                                    <td>Lisinopril 10mg, Metformin 500mg</td>
                                    <td><span class="badge badge-status status-urgent">Urgent</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-success-custom">Process</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>RX2024003</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="patient-avatar me-2">RJ</div>
                                            <span>Robert Johnson</span>
                                        </div>
                                    </td>
                                    <td>Dr. Williams</td>
                                    <td>Insulin Glargine</td>
                                    <td><span class="badge badge-status status-pending">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-success-custom">Process</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>RX2024004</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="patient-avatar female me-2">LB</div>
                                            <span>Lisa Brown</span>
                                        </div>
                                    </td>
                                    <td>Dr. Davis</td>
                                    <td>Atorvastatin 20mg</td>
                                    <td><span class="badge badge-status status-pending">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-success-custom">Process</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Activity & Alerts -->
            <div class="col-lg-4 mb-4">
                <!-- Low Stock Alerts -->
                <div class="card recent-card mb-4">
                    <div class="card-header bg-transparent border-0 pt-3">
                        <h5 class="mb-0 text-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>Low Stock Alerts
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning-custom mb-2">
                            <strong>Amoxicillin 500mg</strong><br>
                            <small>Only 15 units remaining</small>
                        </div>
                        <div class="alert alert-warning-custom mb-2">
                            <strong>Insulin Glargine</strong><br>
                            <small>Only 8 units remaining</small>
                        </div>
                        <div class="alert alert-warning-custom mb-2">
                            <strong>Lisinopril 10mg</strong><br>
                            <small>Only 22 units remaining</small>
                        </div>
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-warning-custom btn-sm">Reorder Stock</a>
                        </div>
                    </div>
                </div>

                <!-- Recent Payments -->
                <div class="card recent-card">
                    <div class="card-header bg-transparent border-0 pt-3">
                        <h5 class="mb-0">Recent Payments</h5>
                    </div>
                    <div class="card-body">
                        <div class="payment-item d-flex justify-content-between align-items-center mb-3 p-2 rounded"
                             style="background-color: #f8f9fa;">
                            <div>
                                <h6 class="mb-1">RX2024001</h6>
                                <small class="text-muted">John Doe - Cash</small>
                            </div>
                            <div class="text-success fw-bold">$45.50</div>
                        </div>
                        <div class="payment-item d-flex justify-content-between align-items-center mb-3 p-2 rounded"
                             style="background-color: #f8f9fa;">
                            <div>
                                <h6 class="mb-1">RX2024002</h6>
                                <small class="text-muted">Mary Smith - Insurance</small>
                            </div>
                            <div class="text-success fw-bold">$12.00</div>
                        </div>
                        <div class="payment-item d-flex justify-content-between align-items-center mb-3 p-2 rounded"
                             style="background-color: #f8f9fa;">
                            <div>
                                <h6 class="mb-1">RX2024003</h6>
                                <small class="text-muted">Robert Johnson - Card</small>
                            </div>
                            <div class="text-success fw-bold">$89.25</div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-primary-custom btn-sm">View All Payments</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Dashboard Sections -->
        <div class="row">
            <!-- Today's Summary -->
            <div class="col-md-6 mb-4">
                <div class="card recent-card">
                    <div class="card-header bg-transparent border-0 pt-3">
                        <h5 class="mb-0">Today's Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="stat-number">42</div>
                                    <div class="stat-label">Processed</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="stat-number">18</div>
                                    <div class="stat-label">Pending</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="stat-number">3</div>
                                    <div class="stat-label">Rejected</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Total Revenue:</span>
                            <strong class="text-success">$2,847.25</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Insurance Claims:</span>
                            <strong class="text-info">$1,892.50</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Cash Payments:</span>
                            <strong class="text-primary">$954.75</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="col-md-6 mb-4">
                <div class="card recent-card">
                    <div class="card-header bg-transparent border-0 pt-3">
                        <h5 class="mb-0">Pharmacy Metrics</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Processing Efficiency</span>
                                <span>92%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: 92%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Customer Satisfaction</span>
                                <span>96%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" style="width: 96%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Inventory Turnover</span>
                                <span>78%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning" style="width: 78%"></div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-primary-custom btn-sm">View Detailed Reports</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
