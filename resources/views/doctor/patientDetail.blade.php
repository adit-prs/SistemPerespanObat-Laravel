@extends('layout.doctor')

@section('content')
    <div class="main-content">
        <!-- Patient Header -->
        <div class="patient-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div class="patient-avatar-large me-4">JD</div>
                        <div>
                            <h2 class="mb-1">{{$patient->name}}</h2>
                            <p class="mb-1 opacity-75">Nomor Rekam Medis: {{$patient->medical_record_number}}
                                |
                                @if($patient->gender == "L")
                                    Laki-laki
                                @elseif($patient->gender == "P")
                                    Perempuan
                                @endif
                            </p>
                            <p class="mb-0 opacity-75">
                                Umur: {{$patient->age}} Tahun |
                                <i class="fas fa-phone me-2"></i>{{$patient->phone_number}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <button class="btn btn-warning-custom" data-bs-toggle="modal" data-bs-target="#editPatientModal">
                        <i class="fas fa-edit me-2"></i>Edit
                    </button>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="quick-stats mt-4">
                <div class="stat-item">
                    <div class="stat-number">{{$patient->totalVisit}}</div>
                    <div class="stat-label">Total Visits</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{$patient->lastVisit}}</div>
                    <div class="stat-label">Last Visit</div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs mb-4" id="patientTabs" role="tablist">
            <li class="nav-item active" role="presentation">
                <button class="nav-link active" id="checkups-tab" data-bs-toggle="tab" data-bs-target="#checkups"
                        type="button" role="tab">
                    <i class="fas fa-stethoscope me-2"></i>Medical History
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="prescriptions-tab" data-bs-toggle="tab" data-bs-target="#prescriptions"
                        type="button" role="tab">
                    <i class="fas fa-prescription me-2"></i>Prescriptions
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="vitals-tab" data-bs-toggle="tab" data-bs-target="#vitals" type="button"
                        role="tab">
                    <i class="fas fa-heartbeat me-2"></i>Vital Signs
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="patientTabsContent">
            <!-- Medical History Tab -->
            <div class="tab-pane fade show active" id="checkups" role="tabpanel">
                <div class="row">
                    <div class="col-12">
                        <div class="info-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-history me-2"></i>Medical History & Checkups
                                </h5>
                                <a href="{{route('examination.index',$patient->id)}}" class="btn btn-success-custom">
                                    <i class="fas fa-plus me-2"></i>New Checkup
                                </a>
                            </div>

                            <!-- Recent Checkups -->
                            @foreach($examinations as $examination)
                                <div class="checkup-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="checkup-date">{{$examination->date}}</div>
                                            <div class="checkup-summary">
                                                {{$examination->diagnosis}}
                                            </div>
                                            <div class="checkup-doctor">
                                                <i class="fas fa-user-md me-1"></i>Dr. {{$examination->doctor}}
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <a href="#"
                                               class="btn btn-sm btn-primary-custom">
                                                <i class="fas fa-eye me-1"></i>View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <!-- Prescriptions Tab -->
            <div class="tab-pane fade" id="prescriptions" role="tabpanel">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-card">
                            <h5 class="card-title">
                                <i class="fas fa-pills me-2"></i>Current Medications
                            </h5>
                            <div class="medication-item">
                                <div class="medication-name">Lisinopril</div>
                                <div class="medication-dosage">10mg - Once daily</div>
                                <div class="medication-instructions">Take in the morning with food</div>
                            </div>
                            <div class="medication-item">
                                <div class="medication-name">Metformin</div>
                                <div class="medication-dosage">500mg - Twice daily</div>
                                <div class="medication-instructions">Take with meals</div>
                            </div>
                            <div class="medication-item">
                                <div class="medication-name">Atorvastatin</div>
                                <div class="medication-dosage">20mg - Once daily</div>
                                <div class="medication-instructions">Take at bedtime</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-card">
                            <h5 class="card-title">
                                <i class="fas fa-history me-2"></i>Prescription History
                            </h5>
                            <div class="timeline-item">
                                <div class="checkup-date">Dec 15, 2023</div>
                                <div class="checkup-summary">Lisinopril 10mg prescribed for hypertension</div>
                            </div>
                            <div class="timeline-item">
                                <div class="checkup-date">Sep 22, 2023</div>
                                <div class="checkup-summary">Metformin 500mg added for diabetes management</div>
                            </div>
                            <div class="timeline-item">
                                <div class="checkup-date">Jun 10, 2023</div>
                                <div class="checkup-summary">Lorazepam 0.5mg (short-term) for anxiety</div>
                            </div>
                            <div class="timeline-item">
                                <div class="checkup-date">Mar 5, 2023</div>
                                <div class="checkup-summary">Atorvastatin 20mg prescribed for cholesterol</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vital Signs Tab -->
            <div class="tab-pane fade" id="vitals" role="tabpanel">
                <div class="info-card">
                    <h5 class="card-title">
                        <i class="fas fa-heartbeat me-2"></i>Latest Vital Signs
                        <small class="text-muted">(December 15, 2023)</small>
                    </h5>
                    <div class="vital-signs">
                        <div class="vital-item">
                            <div class="vital-value">140/90</div>
                            <div class="vital-label">Blood Pressure</div>
                        </div>
                        <div class="vital-item">
                            <div class="vital-value">72</div>
                            <div class="vital-label">Heart Rate</div>
                        </div>
                        <div class="vital-item">
                            <div class="vital-value">98.6°F</div>
                            <div class="vital-label">Temperature</div>
                        </div>
                        <div class="vital-item">
                            <div class="vital-value">18</div>
                            <div class="vital-label">Respiratory Rate</div>
                        </div>
                        <div class="vital-item">
                            <div class="vital-value">98%</div>
                            <div class="vital-label">Oxygen Saturation</div>
                        </div>
                        <div class="vital-item">
                            <div class="vital-value">180 lbs</div>
                            <div class="vital-label">Weight</div>
                        </div>
                        <div class="vital-item">
                            <div class="vital-value">5'10"</div>
                            <div class="vital-label">Height</div>
                        </div>
                        <div class="vital-item">
                            <div class="vital-value">25.8</div>
                            <div class="vital-label">BMI</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
