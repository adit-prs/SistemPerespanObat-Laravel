@extends('layout.pharmacist')

@section('content')
    <div class="main-content">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Prescription Management</h2>
                <p class="text-muted mb-0">Process and manage prescriptions</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-success-custom">
                    <i class="fas fa-download me-2"></i>Export List
                </button>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search prescriptions...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control">
                            <option>All Status</option>
                            <option>Draft</option>
                            <option>Served</option>
                            <option>Paid</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control">
                            <option>All Doctors</option>
                            <option>Dr. Smith</option>
                            <option>Dr. Johnson</option>
                            <option>Dr. Williams</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" placeholder="Date">
                    </div>
                </div>
            </div>
        </div>
        <!-- Prescriptions Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                        <tr>
                            <th>Prescription #</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Medications</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prescription as $receipt)
                            <tr>
                                <td><strong>{{$receipt->receipt_number}}</strong></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="patient-avatar me-2">JD</div>
                                        <span>{{$receipt->examination->patient->name}}</span>
                                    </div>
                                </td>
                                <td>Dr. {{$receipt->examination->doctor->name}}</td>
                                <td>Dec 15, 2023</td>
                                <td>
                                    @foreach($receipt['prescriptionitem'] as $item)
                                        {{$item->medicine_name}}
                                    @endforeach
                                </td>
                                <td>
                                    <span
                                        class="badge badge-status
                                        @if($receipt->status == "draft" or $receipt->status == "served")
                                            status-pending
                                        @else
                                            status-completed
                                        @endif
                                        ">{{$receipt->status}}</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary-custom me-1"
                                            onclick="viewPrescription('RX2024001', 'John Doe', 'Dr. Smith', 'Dec 15, 2023', 'Lisinopril 10mg, Metformin 500mg', 'Draft')">
                                        <i class="fas fa-eye"></i> View
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
    <!-- Prescription Details Modal -->
    <div class="modal fade" id="prescriptionModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--gradient-green); color: white;">
                    <h5 class="modal-title">
                        <i class="fas fa-prescription-bottle me-2"></i>Prescription Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Prescription Header -->
                    <div class="form-card mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Prescription Number</div>
                                    <div class="info-value" id="modalRxNumber">-</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Patient Name</div>
                                    <div class="info-value" id="modalPatientName">-</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Doctor</div>
                                    <div class="info-value" id="modalDoctor">-</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Date Prescribed</div>
                                    <div class="info-value" id="modalDate">-</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Current Status</div>
                                    <div class="info-value">
                                        <span class="badge badge-status" id="modalStatus">-</span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Priority</div>
                                    <div class="info-value">Normal</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Patient Information -->
                    <div class="form-card mb-4">
                        <h6 class="section-title">Patient Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Patient ID</div>
                                    <div class="info-value">P001</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Age</div>
                                    <div class="info-value">45 years</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Phone</div>
                                    <div class="info-value">+1 234-567-8901</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Insurance</div>
                                    <div class="info-value">Blue Cross Blue Shield</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Medication Details -->
                    <div class="form-card mb-4">
                        <h6 class="section-title">Medications</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-light">
                                <tr>
                                    <th>Medication</th>
                                    <th>Strength</th>
                                    <th>Quantity</th>
                                    <th>Instructions</th>
                                    <th>Refills</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tbody id="modalMedications">
                                <tr>
                                    <td id="modalMedName">-</td>
                                    <td>10mg</td>
                                    <td>30 tablets</td>
                                    <td>Take once daily with food</td>
                                    <td>2</td>
                                    <td>$25.50</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Diagnosis</div>
                                    <div class="info-value">Hypertension</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Total Cost</div>
                                    <div class="info-value text-success"><strong>$25.50</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="form-card">
                        <h6 class="section-title">Additional Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Valid Until</div>
                                    <div class="info-value">Jan 15, 2024</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">DEA Number</div>
                                    <div class="info-value">BS1234567</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Special Instructions</div>
                                    <div class="info-value">Monitor blood pressure regularly</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Generic Substitution</div>
                                    <div class="info-value">Allowed</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning-custom" id="statusBtn" onclick="changeStatus()">
                        <i class="fas fa-edit me-2"></i>Change Status
                    </button>
                    <button type="button" class="btn btn-success-custom" onclick="proceedToPayment()">
                        <i class="fas fa-credit-card me-2"></i>Proceed to Payment
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentPrescription = {};

        function viewPrescription(rxNumber, patientName, doctor, date, medications, status) {
            // Store current prescription data
            currentPrescription = {
                rxNumber: rxNumber,
                patientName: patientName,
                doctor: doctor,
                date: date,
                medications: medications,
                status: status
            };

            // Populate modal with prescription details
            document.getElementById('modalRxNumber').textContent = rxNumber;
            document.getElementById('modalPatientName').textContent = patientName;
            document.getElementById('modalDoctor').textContent = doctor;
            document.getElementById('modalDate').textContent = date;
            document.getElementById('modalMedName').textContent = medications;

            // Update status badge
            const statusBadge = document.getElementById('modalStatus');
            statusBadge.textContent = status;
            statusBadge.className = 'badge badge-status';

            if (status === 'Draft') {
                statusBadge.classList.add('status-draft');
            } else if (status === 'Served') {
                statusBadge.classList.add('status-served');
            } else if (status === 'Paid') {
                statusBadge.classList.add('status-completed');
            }

            // Update button text based on status
            const statusBtn = document.getElementById('statusBtn');
            if (status === 'Draft') {
                statusBtn.innerHTML = '<i class="fas fa-check me-2"></i>Mark as Served';
                statusBtn.style.display = 'inline-block';
            } else if (status === 'Served') {
                statusBtn.innerHTML = '<i class="fas fa-undo me-2"></i>Mark as Draft';
                statusBtn.style.display = 'inline-block';
            } else {
                statusBtn.style.display = 'none';
            }

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('prescriptionModal'));
            modal.show();
        }

        function changeStatus() {
            const currentStatus = currentPrescription.status;
            let newStatus;

            if (currentStatus === 'Draft') {
                newStatus = 'Served';
                alert('Prescription marked as Served! Ready for dispensing.');
            } else if (currentStatus === 'Served') {
                newStatus = 'Draft';
                alert('Prescription marked as Draft.');
            }

            // Update the status in the table and modal
            currentPrescription.status = newStatus;

            // Close modal and refresh view
            const modal = bootstrap.Modal.getInstance(document.getElementById('prescriptionModal'));
            modal.hide();

            // In a real application, this would update the database and refresh the table
            setTimeout(() => {
                location.reload();
            }, 500);
        }

        function proceedToPayment() {
            if (currentPrescription.status === 'Served') {
                // Simulate payment processing
                const confirmed = confirm('Process payment of $25.50 for ' + currentPrescription.patientName + '?');

                if (confirmed) {
                    alert('Payment processed successfully! Prescription marked as Paid.');

                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('prescriptionModal'));
                    modal.hide();

                    // In a real application, this would:
                    // 1. Process the payment
                    // 2. Update prescription status to 'Paid'
                    // 3. Generate receipt
                    // 4. Update inventory
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                }
            } else if (currentPrescription.status === 'Draft') {
                alert('Prescription must be served before payment can be processed.');
            } else {
                alert('This prescription has already been paid for.');
            }
        }

        // Set current date for date filter
        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date().toISOString().split('T')[0];
            const dateInput = document.querySelector('input[type="date"]');
            if (dateInput) {
                dateInput.value = today;
            }
        });
    </script>
@endsection
