@extends('layout.doctor')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-1">
                        <i class="fas fa-prescription me-2"></i>New Prescription
                    </h2>
                    <p class="mb-0 opacity-75">Add medications and create prescription for patient</p>
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
        <!-- Medicine Search & Add Section -->
        <div class="form-card">
            <h4 class="section-title">
                <i class="fas fa-search me-2"></i>Search & Add Medication
            </h4>

            <div class="row">
                <div class="col-md-6">
                    <div class="medicine-search">
                        <label for="medicineSearch" class="form-label">Search Medicine</label>
                        <input type="text" class="form-control" id="medicineSearch"
                               placeholder="Type medicine name or generic name...">
                        <div class="search-results" id="searchResults"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Medicine Form -->
        <div class="form-card" id="addMedicineForm" style="display: none;">
            <h4 class="section-title">
                <i class="fas fa-pills me-2"></i>Add Selected Medicine
            </h4>

            <form id="medicineForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Pilih Obat</label>
                            <div class="form-control" id="selectedMedicine" style="background-color: #f8f9fa;">
                                <!-- Selected medicine will appear here -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="quantity" class="form-label required-field">Jumlah</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="quantity" name="quantity" min="1"
                                       max="1000" required>
                                <span class="input-group-text">satuan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="dosage" class="form-label required-field">Dosis</label>
                            <input type="text" class="form-control" id="dosage" name="dosage"
                                   placeholder="e.g., 1 tablet" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="frequency" class="form-label required-field">Frekuensi</label>
                            <select class="form-select" id="frequency" name="frequency" required>
                                <option value="">Pilih Frekuensi</option>
                                <option value="once-daily">1x sehari</option>
                                <option value="twice-daily">2x sehari</option>
                                <option value="three-times-daily">3x sehari</option>
                                <option value="four-times-daily">4x sehari</option>
                                <option value="every-4-hours">Setiap 4 jam</option>
                                <option value="every-6-hours">Setiap 6 jam</option>
                                <option value="every-8-hours">Setiap 8 jam</option>
                                <option value="as-needed">Sesuai kebutuhan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="duration" class="form-label required-field">Durasi</label>
                            <input type="text" class="form-control" id="duration" name="duration"
                                   placeholder="e.g., 7 days" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jadwal Konsumsi</label>
                    <div class="dosage-grid">
                        <div class="dosage-item" data-time="morning">
                            <div class="dosage-time">Pagi</div>
                            <div class="dosage-label">Sebelum sarapan</div>
                        </div>
                        <div class="dosage-item" data-time="afternoon">
                            <div class="dosage-time">Siang</div>
                            <div class="dosage-label">Setelah makan siang</div>
                        </div>
                        <div class="dosage-item" data-time="evening">
                            <div class="dosage-time">Malam</div>
                            <div class="dosage-label">Setelah makan malam</div>
                        </div>
                        <div class="dosage-item" data-time="bedtime">
                            <div class="dosage-time">Sebelum Tidur</div>
                            <div class="dosage-label">Sebelum tidur</div>
                        </div>
                    </div>
                    <input type="hidden" id="dosageSchedule" name="dosage_schedule">
                </div>

                <div class="mb-3">
                    <label for="instructions" class="form-label">Additional Instructions</label>
                    <textarea class="form-control" id="instructions" name="instructions" rows="3"
                              placeholder="Special instructions for taking this medication..."></textarea>
                </div>

                <div class="text-end">
                    <button type="button" class="btn btn-secondary-custom me-2" onclick="cancelAddMedicine()">Cancel
                    </button>
                    <button type="submit" class="btn btn-purple-custom">
                        <i class="fas fa-plus me-2"></i>Add to Prescription
                    </button>
                </div>
            </form>
        </div>

        <!-- Current Prescription Items -->
        <div class="form-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0">
                    <i class="fas fa-list me-2"></i>Prescription Items
                </h4>
                <span class="badge bg-primary" id="itemCount">0 items</span>
            </div>
            <div id="prescriptionItems">
                <div class="text-center text-muted py-4">
                    <i class="fas fa-prescription fa-3x mb-3 opacity-50"></i>
                    <p>No medications added yet. Search and add medicines above.</p>
                </div>
            </div>
        </div>

        <!-- Prescription Summary & Actions -->
        <div class="form-card">
            <h4 class="section-title">
                <i class="fas fa-file-medical me-2"></i>Prescription Summary
            </h4>

            <div class="prescription-summary">
                <div class="summary-item">
                    <span class="summary-label">Total Medications:</span>
                    <span class="summary-value" id="totalMedications">0</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Prescription Date:</span>
                    <span class="summary-value" id="prescriptionDate"></span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Prescribing Doctor:</span>
                    <span class="summary-value">Dr. {{$doctor->name}}</span>
                </div>
            </div>

            <div class="alert alert-info-custom" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                This prescription can be edited until it's processed by the pharmacist. Once processed, a new
                prescription will be required for changes.
            </div>

            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{route('patient.show',$patient->id)}}" class="btn btn-secondary-custom me-2">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
                <button type="button" class="btn btn-success-custom" onclick="savePrescription()"
                        id="savePrescriptionBtn" disabled>
                    <i class="fas fa-prescription-bottle me-2"></i>Save Prescription
                </button>
            </div>
        </div>
    </div>
    <script>
        const medicineDatabase = @json($medicines);

        let selectedMedicine = null;
        let prescriptionItems = [];
        let selectedDosageTimes = [];

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('prescriptionDate').textContent = new Date().toLocaleDateString();

            const urlParams = new URLSearchParams(window.location.search);
            const patientId = '{{$patient->id}}';
            const examId = '{{$idCheckUp}}';

            if (examId) {
                console.log('Prescription linked to examination:', examId);
            }
        });

        document.getElementById('medicineSearch').addEventListener('focus', function () {
            displaySearchResults(medicineDatabase);
        });

        document.getElementById('medicineSearch').addEventListener('input', function () {
            const query = this.value.toLowerCase();
            if (query.length < 1) {
                displaySearchResults(medicineDatabase);
                return;
            }

            const results = medicineDatabase.filter(medicine =>
                medicine.name.toLowerCase().includes(query)
            );

            displaySearchResults(results);
        });

        function displaySearchResults(results) {
            const searchResults = document.getElementById('searchResults');

            if (results.length === 0) {
                searchResults.innerHTML = '<div class="search-result-item">No medicines found</div>';
            } else {
                searchResults.innerHTML = results.map(medicine => `
                    <div class="search-result-item" onclick="selectMedicine('${medicine.id}')">
                        <div class="medicine-name">${medicine.name}</div>
                    </div>
                `).join('');
            }

            searchResults.style.display = 'block';
        }

        function hideSearchResults() {
            document.getElementById('searchResults').style.display = 'none';
        }

        function selectMedicine(medicineId) {
            selectedMedicine = medicineDatabase.find(m => m.id === medicineId);

            document.getElementById('selectedMedicine').innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="medicine-name">${selectedMedicine.name}</div>
                    </div>
                </div>
            `;

            document.getElementById('addMedicineForm').style.display = 'block';
            document.getElementById('medicineSearch').value = '';
            hideSearchResults();
        }

        document.querySelectorAll('.dosage-item').forEach(item => {
            item.addEventListener('click', function () {
                const time = this.dataset.time;

                if (this.classList.contains('selected')) {
                    this.classList.remove('selected');
                    selectedDosageTimes = selectedDosageTimes.filter(t => t !== time);
                } else {
                    this.classList.add('selected');
                    selectedDosageTimes.push(time);
                }

                document.getElementById('dosageSchedule').value = selectedDosageTimes.join(',');
            });
        });

        document.getElementById('medicineForm').addEventListener('submit', function (e) {
            e.preventDefault();

            if (!selectedMedicine) {
                alert('Please select a medicine first.');
                return;
            }

            const formData = new FormData(this);
            const prescriptionItem = {
                id: selectedMedicine['id'],
                medicine: selectedMedicine['name'],
                quantity: formData.get('quantity'),
                dosage: formData.get('dosage'),
                frequency: formData.get('frequency'),
                duration: formData.get('duration'),
                dosage_schedule: selectedDosageTimes,
                instructions: formData.get('instructions'),
            };

            prescriptionItems.push(prescriptionItem);
            displayPrescriptionItems();
            resetMedicineForm();
            updateSummary();
        });

        function displayPrescriptionItems() {
            const container = document.getElementById('prescriptionItems');

            if (prescriptionItems.length === 0) {
                container.innerHTML = `
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-prescription fa-3x mb-3 opacity-50"></i>
                        <p>No medications added yet. Search and add medicines above.</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = prescriptionItems.map(item => `
                <div class="prescription-item">
                    <button class="remove-prescription" onclick="removePrescriptionItem(${item.id})">
                        <i class="fas fa-times"></i>
                    </button>

                    <div class="prescription-header">
                        <div>
                            <div class="prescription-medicine">${item.medicine.name}</div>
                        </div>
                    </div>

                   <div class="prescription-details">
                        <div class="detail-item">
                            <div class="detail-label">Jumlah</div>
                            <div class="detail-value">${item.quantity} unit</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Dosis</div>
                            <div class="detail-value">${item.dosage}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Frekuensi</div>
                            <div class="detail-value">${translateFrequency(item.frequency)}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Durasi</div>
                            <div class="detail-value">${item.duration}</div>
                        </div>
                    </div>

                    ${item.instructions ? `<div class="prescription-notes"><strong>Instructions:</strong> ${item.instructions}</div>` : ''}
                </div>
            `).join('');
        }

        function removePrescriptionItem(itemId) {
            prescriptionItems = prescriptionItems.filter(item => item.id !== itemId);
            displayPrescriptionItems();
            updateSummary();
        }

        function resetMedicineForm() {
            document.getElementById('medicineForm').reset();
            document.getElementById('addMedicineForm').style.display = 'none';
            document.querySelectorAll('.dosage-item').forEach(item => item.classList.remove('selected'));
            selectedMedicine = null;
            selectedDosageTimes = [];
        }

        function cancelAddMedicine() {
            resetMedicineForm();
        }

        function updateSummary() {
            const totalMeds = prescriptionItems.length;

            document.getElementById('itemCount').textContent = `${totalMeds} items`;
            document.getElementById('totalMedications').textContent = totalMeds;

            document.getElementById('savePrescriptionBtn').disabled = totalMeds === 0;
        }

        async function savePrescription() {
            if (prescriptionItems.length === 0) {
                alert('Silakan tambahkan minimal satu obat terlebih dahulu.');
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const prescriptionData = {
                examination_id: '{{$idCheckUp}}',
                items: prescriptionItems,
            };
            console.log(prescriptionData);
            const url = '{{ route('prescriptions.create', [$patient->id, $idCheckUp]) }}';
            console.log('URL:', url);
            console.log('CSRF Token:', csrfToken);
            console.log('Data:', prescriptionData);
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(prescriptionData)
                });
                const rawText = await response.text();
                console.log('Raw response:', rawText);
                const result = await response.json();
                console.log(result);
                if (response.ok) {
                    alert('Resep berhasil disimpan!');
                    window.location.href = `{{route('patient.show',$patient->id)}}`;
                } else {
                    console.error('Gagal menyimpan:', result);
                    alert('Terjadi kesalahan saat menyimpan resep.');
                }
            } catch (err) {
                console.error('Error:', err);
                alert('Tidak bisa terhubung ke server.');
            }
        }

        window.addEventListener('load', function () {
            const draft = localStorage.getItem('prescriptionDraft');
            if (draft) {
                const draftData = JSON.parse(draft);

                if (confirm('A prescription draft was found. Would you like to load it?')) {
                    prescriptionItems = draftData.prescriptionItems || [];
                    displayPrescriptionItems();
                    updateSummary();
                }
            }
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.medicine-search')) {
                hideSearchResults();
            }
        });

        function translateFrequency(freq) {
            const map = {
                'once-daily': 'Sekali sehari',
                'twice-daily': 'Dua kali sehari',
                'three-times-daily': 'Tiga kali sehari',
                'four-times-daily': 'Empat kali sehari',
                'every-4-hours': 'Setiap 4 jam',
                'every-6-hours': 'Setiap 6 jam',
                'every-8-hours': 'Setiap 8 jam',
                'as-needed': 'Sesuai kebutuhan'
            };

            return map[freq] || freq;
        }
    </script>

@endsection
