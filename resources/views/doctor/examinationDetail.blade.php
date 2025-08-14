@extends('layout.doctor')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header purple-gradient">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-1">
                        <i class="fas fa-stethoscope me-2"></i>Examination Details
                    </h2>
                    <p class="mb-0 opacity-75">Complete examination record and findings</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{route('patient.show',$patient->id)}}" class="btn btn-secondary-custom">
                        <i class="fas fa-arrow-left me-2"></i>Back to Patient
                    </a>
                </div>
            </div>
        </div>

        <!-- Patient Information Bar -->
        <div class="patient-info-bar">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div class="patient-avatar me-3">JD</div>
                        <div>
                            <h6 class="mb-1">{{$patient->name}}</h6>
                            <small class="text-muted">
                                Nomor Rekam Medis: {{$patient->medical_record_number}}
                                | Umur:{{$patient->age}} |
                                @if($patient->gender == "L")
                                    Laki-laki
                                @elseif($patient->gender == "P")
                                    Perempuan
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vital Signs -->
        <div class="info-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0">
                    <i class="fas fa-heartbeat me-2"></i>Vital Signs
                </h4>
                <div class="d-flex gap-2">
                    <button class="btn btn-success-custom btn-sm" onclick="createPrescription()">
                        <i class="fas fa-prescription me-1"></i>Create Prescription
                    </button>
                    <button class="btn btn-primary-custom btn-sm" onclick="editExamination()">
                        <i class="fas fa-edit me-1"></i>Edit
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">{{$examinations->visit}}</div>
                        <div class="stat-label">Examination Date</div>
                    </div>
                </div>
            </div>
            <div class="vital-signs">
                <div class="vital-item">
                    <div class="vital-value">{{round($examinations->height_cm, 1)}}cm</div>
                    <div class="vital-label">Height</div>
                </div>
                <div class="vital-item">
                    <div class="vital-value">{{round($examinations->weight_kg, 1)}}kg</div>
                    <div class="vital-label">Weight</div>
                </div>
                <div class="vital-item">
                    <div class="vital-value">{{$examinations->systole}}/{{$examinations->diastole}}</div>
                    <div class="vital-label">Blood Pressure</div>
                </div>
                <div class="vital-item">
                    <div class="vital-value">{{$examinations->heart_rate}}</div>
                    <div class="vital-label">Heart Rate (bpm)</div>
                </div>
                <div class="vital-item">
                    <div class="vital-value">{{$examinations->respiratory_rate}}</div>
                    <div class="vital-label">Respiratory Rate</div>
                </div>
                <div class="vital-item">
                    <div class="vital-value">{{round($examinations->temperature_c, 1)}}°C</div>
                    <div class="vital-label">Temperature</div>
                </div>
            </div>
        </div>

        <!-- Attachments & Documents -->
        <div class="info-card">
            <h4 class="section-title">
                <i class="fas fa-paperclip me-2"></i>Attachments & Documents
            </h4>

            <div class="row">
                @foreach($attachments ?? [] as $attachment)
                    <div class="col-md-6">
                        <div class="prescription-item">
                            <div class="prescription-header">
                                <div>
                                    <div class="prescription-medicine">
                                        <i class="fas fa-file-pdf text-danger me-2"></i>{{$attachment['original_name']}}
                                    </div>
                                </div>
                                <button class="btn btn-primary-custom btn-sm"
                                        onclick="window.open('{{asset('storage/'.$attachment->file_path)}}','_blank')">
                                    <i class="fas fa-eye me-1"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Diagnosis -->
        <div class="info-card">
            <h4 class="section-title">
                <i class="fas fa-notes-medical me-2"></i>Diagnosis
            </h4>

            <div class="checkup-item">
                <div class="checkup-summary">
                    {{$examinations->diagnosis}}
                </div>
            </div>

        </div>
        <div class="info-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0">
                    <i class="fa-solid fa-tablets me-2"></i>Prescription
                </h4>
            </div>

            @foreach($prescription as $recipe)
                <div class="vital-signs">
                    <div class="vital-item">
                        <div class="vital-value">{{$recipe->receipt_number}}</div>
                        <div class="vital-label">receipt number</div>
                    </div>
                    <div class="vital-item">
                        <div class="vital-value">{{$recipe->status}}</div>
                        <div class="vital-label">status</div>
                    </div>
                </div>

                @foreach($recipe['prescriptionitem'] as $item)
                    <div class="prescription-item">
                        <div class="prescription-header">
                            <div>
                                <div class="prescription-medicine">{{$item->medicine_name}}</div>
                            </div>
                        </div>

                        <div class="prescription-details">
                            <div class="detail-item">
                                <div class="detail-label">Jumlah</div>
                                <div class="detail-value">{{$item->quantity}}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Dosis</div>
                                <div class="detail-value">{{$item->dosage}}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Frekuensi</div>
                                <div class="detail-value">{{$item->frequency}}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Durasi</div>
                                <div class="detail-value">{{$item->duration}}</div>
                            </div>
                        </div>
                        @if(isset($item->instructions))
                            <div class="prescription-notes"><strong>Instructions:</strong> {{$item->instructions}}
                            </div>
                        @endif
                    </div>
                @endforeach
            @endforeach
        </div>

        <!-- Action Buttons -->
        <div class="info-card">
            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{route('patient.show',$patient->id)}}" class="btn btn-secondary-custom">
                        <i class="fas fa-arrow-left me-2"></i>Back to Patient Profile
                    </a>
                </div>

            </div>
        </div>
    </div>
    <script>
        // Get examination ID from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const examId = urlParams.get('id');
        const patientId = urlParams.get('patient_id');

        // Load examination data based on ID (in real app, this would fetch from backend)
        if (examId) {
            console.log('Loading examination data for ID:', examId);
            // Here you would fetch examination data from your backend
        }

        function printExamination() {
            window.print();
        }

        function editExamination() {
            if (examId) {
                window.location.href = `new-checkup.html?edit=true&id=${examId}&patient_id=${patientId || 'PAT001'}`;
            } else {
                alert('Examination ID not found.');
            }
        }

        function createPrescription() {
            const patientIdToUse = patientId || 'PAT001';
            const examIdToUse = examId || 'CHK001';
            window.location.href = `new-prescription.html?patient_id=${patientIdToUse}&exam_id=${examIdToUse}`;
        }

        function scheduleFollowUp() {
            alert('Redirecting to appointment scheduling...');
            // In real app, this would redirect to appointment scheduling page
            // window.location.href = `schedule-appointment.html?patient_id=${patientId || 'PAT001'}`;
        }

        // Add print styles
        const printStyles = `
            @media print {
                .sidebar, .navbar, .btn, .dropdown { display: none !important; }
                .main-content { padding: 0 !important; }
                .col-md-9, .col-lg-10 { width: 100% !important; max-width: 100% !important; }
                .page-header { background: #f8f9fa !important; color: #2c3e50 !important; }
                .info-card { box-shadow: none !important; border: 1px solid #dee2e6 !important; }
                body { font-size: 12px !important; }
            }
        `;

        // Add print styles to document
        const styleSheet = document.createElement('style');
        styleSheet.textContent = printStyles;
        document.head.appendChild(styleSheet);
    </script>
@endsection
