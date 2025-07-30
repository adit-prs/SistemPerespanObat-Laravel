@extends('layout.doctor')

@section('content')
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-1">
                        <i class="fas fa-stethoscope me-2"></i>New Patient Examination
                    </h2>
                    <p class="mb-0 opacity-75">Record examination details and vital signs</p>
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
                            <small class="text-muted">Nomor Rekam Medis: {{$patient->medical_record_number}} |
                                Umur: {{$patient->age}} |
                                @if($patient->gender == "L")
                                    Laki-laki
                                @elseif($patient->gender == "P")
                                    Perempuan
                                @endif
                                | Last Visit: Dec 15, 2023</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Indicator -->
        <div class="progress-indicator">
            <div class="progress-bar-custom"></div>
        </div>

        <!-- Information Alert -->
        <div class="alert alert-info-custom" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Complete all required fields (*)</strong> to ensure accurate medical records.
        </div>

        <!-- Examination Form -->
        <form id="examinationForm" action="{{route('examination.store',$patient->id)}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <!-- Date & Time Section -->
            <div class="form-card">
                <h4 class="section-title">
                    <i class="fas fa-calendar-alt me-2"></i>Examination Date & Time
                </h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $msg)
                                <li>{{ $msg }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="datetime-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="examDate" class="form-label required-field">Tanggal Pemeriksaan</label>
                                <input type="date" class="form-control" id="examDate" name="exam_date" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vital Signs Section -->
            <div class="form-card">
                <h4 class="section-title">
                    <i class="fas fa-heartbeat me-2"></i>Vital Signs
                </h4>

                <div class="vital-signs-grid">
                    <!-- Height -->
                    <div class="vital-input-group">
                        <div class="vital-label">Tinggi Badan</div>
                        <input type="number" class="vital-input" name="height" placeholder="170" step="0.1" min="0"
                               max="300">
                        <div class="vital-unit">cm</div>
                    </div>

                    <!-- Weight -->
                    <div class="vital-input-group">
                        <div class="vital-label">Berat Badan</div>
                        <input type="number" class="vital-input" name="weight" placeholder="70" step="0.1" min="0"
                               max="300">
                        <div class="vital-unit">kg</div>
                    </div>

                    <!-- Blood Pressure -->
                    <div class="vital-input-group">
                        <div class="vital-label">Tekanan Darah</div>
                        <div class="bp-input-group">
                            <input type="number" class="vital-input" name="systolic" placeholder="120" min="50"
                                   max="300" style="width: 40%;">
                            <span class="bp-separator">/</span>
                            <input type="number" class="vital-input" name="diastolic" placeholder="80" min="30"
                                   max="200" style="width: 40%;">
                        </div>
                        <div class="vital-unit">mmHg (Systolic/Diastolic)</div>
                    </div>

                    <!-- Heart Rate -->
                    <div class="vital-input-group">
                        <div class="vital-label">Heart Rate</div>
                        <input type="number" class="vital-input" name="heart_rate" placeholder="72" min="30" max="250">
                        <div class="vital-unit">bpm</div>
                    </div>

                    <!-- Respiratory Rate -->
                    <div class="vital-input-group">
                        <div class="vital-label">Respiratory Rate</div>
                        <input type="number" class="vital-input" name="respiratory_rate" placeholder="18" min="5"
                               max="60">
                        <div class="vital-unit">breaths/min</div>
                    </div>

                    <!-- Body Temperature -->
                    <div class="vital-input-group">
                        <div class="vital-label">Suhu Tubuh</div>
                        <input type="number" class="vital-input" name="temperature" placeholder="26.6" step="0.1"
                               min="20" max="50">
                        <div class="vital-unit">°C</div>
                    </div>
                </div>
            </div>

            <!-- Doctor's Notes Section -->
            <div class="form-card">
                <h4 class="section-title">
                    <i class="fas fa-notes-medical me-2"></i>Doctor's Notes & Observations
                </h4>
                <div class="mb-3">
                    <label for="diagnosis" class="form-label required-field">Diagnosis</label>
                    <textarea class="form-control" id="diagnosis" name="diagnosis" rows="4"
                              placeholder="Diagnosis"
                              required></textarea>
                </div>
            </div>

            <!-- File Upload Section -->
            <div class="form-card">
                <h4 class="section-title">
                    <i class="fas fa-paperclip me-2"></i>Attachments (Optional)
                </h4>

                <div class="file-upload-area" id="fileUploadArea">
                    <div class="file-upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <h6>Drag & drop files here or click to browse</h6>
                    <p class="text-muted mb-0">Supported formats: PDF, DOC, DOCX, JPG, PNG (Max 10MB each)</p>
                    <input type="file" id="fileInput" name="attachments[]" multiple
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" style="display: none;">
                </div>

                <div class="uploaded-files" id="uploadedFiles"></div>
            </div>

            <!-- Form Actions -->
            <div class="form-card">
                <div class="d-flex justify-content-end">
                    <button type="submit" name="action" value="save" class="btn btn-info mx-3">
                        <i class="fas fa-prescription me-2"></i>Save
                    </button>
                    <button type="submit" name="action" value="save_and_prescribe" class="btn btn-success-custom">
                        <i class="fas fa-prescription me-2"></i>Save & Continue to Prescription
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        // File upload functionality
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('fileInput');
        const uploadedFiles = document.getElementById('uploadedFiles');
        let selectedFiles = [];

        fileUploadArea.addEventListener('click', () => fileInput.click());

        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', () => {
            fileUploadArea.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });

        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        function handleFiles(files) {
            Array.from(files).forEach(file => {
                if (file.size <= 10 * 1024 * 1024) { // 10MB limit
                    selectedFiles.push(file);
                    displayFile(file);
                } else {
                    alert(`File "${file.name}" is too large. Maximum size is 10MB.`);
                }
            });
        }

        function displayFile(file) {
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            fileItem.innerHTML = `
                <div class="file-info">
                    <i class="fas fa-file file-icon"></i>
                    <span>${file.name}</span>
                    <small class="text-muted">(${(file.size / 1024 / 1024).toFixed(2)} MB)</small>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('${file.name}')">
                    <i class="fas fa-times"></i>
                </button>
            `;
            uploadedFiles.appendChild(fileItem);
        }

        function removeFile(fileName) {
            selectedFiles = selectedFiles.filter(file => file.name !== fileName);
            const fileItems = uploadedFiles.querySelectorAll('.file-item');
            fileItems.forEach(item => {
                if (item.textContent.includes(fileName)) {
                    item.remove();
                }
            });
        }

        // Form submission
        // document.getElementById('examinationForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //
        //     // Basic validation
        //     const requiredFields = this.querySelectorAll('[required]');
        //     let isValid = true;
        //
        //     requiredFields.forEach(field => {
        //         if (!field.value.trim()) {
        //             field.classList.add('is-invalid');
        //             isValid = false;
        //         } else {
        //             field.classList.remove('is-invalid');
        //         }
        //     });
        //
        //     if (isValid) {
        //         // Generate examination ID
        //         const examId = 'CHK' + String(Math.floor(Math.random() * 10000)).padStart(4, '0');
        //
        //         // Show success message
        //         alert('Examination saved successfully! Redirecting to prescription page...');
        //
        //         // Redirect to prescription page
        //         window.location.href = `new-prescription.html?patient_id=PAT001&exam_id=${examId}`;
        //     } else {
        //         alert('Please fill in all required fields.');
        //     }
        // });
    </script>
@endsection
