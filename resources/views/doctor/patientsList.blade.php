@extends('layout.doctor')

@section('content')
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-1">
                        <i class="fas fa-users me-2 text-primary"></i>Daftar Pasien
                    </h2>
                    <p class="text-muted mb-0">Manage and view all registered patients</p>
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-success-custom" data-bs-toggle="modal" data-bs-target="#addPatientModal">
                        <i class="fas fa-user-plus me-2"></i>Tambah Pasien Baru
                    </button>
                </div>
            </div>
        </div>

        <!-- Statistics Summary -->
        <div class="stats-summary">
            <div class="row text-center">
                <div class="col-md-3">
                    <h4 class="mb-1">156</h4>
                    <small>Total Patients</small>
                </div>
                <div class="col-md-3">
                    <h4 class="mb-1">23</h4>
                    <small>New This Month</small>
                </div>
                <div class="col-md-3">
                    <h4 class="mb-1">89</h4>
                    <small>Active Cases</small>
                </div>
                <div class="col-md-3">
                    <h4 class="mb-1">12</h4>
                    <small>Appointments Today</small>
                </div>
            </div>
        </div>
        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control search-box border-start-0"
                               placeholder="Search patients by name, ID, or phone...">
                    </div>
                </div>
                <div class="col-md-2">
                    <select class="form-select filter-select">
                        <option value="">All Genders</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select filter-select">
                        <option value="">All Ages</option>
                        <option value="0-18">0-18 years</option>
                        <option value="19-35">19-35 years</option>
                        <option value="36-60">36-60 years</option>
                        <option value="60+">60+ years</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select filter-select">
                        <option value="">Sort By</option>
                        <option value="name">Name A-Z</option>
                        <option value="date">Date Added</option>
                        <option value="last-visit">Last Visit</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary-custom w-100">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Patients Table -->
        <div class="patients-table-card">
            <div class="table-responsive">
                <table class="table table-custom table-hover mb-0">
                    <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Contact Info</th>
                        <th>Age/Gender</th>
                        <th>Last Visit</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($patients as $patient)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="patient-avatar male me-3">JD</div>
                                    <div class="patient-info">
                                        <div class="patient-name">{{$patient->name}}</div>
                                        <div class="patient-id">{{$patient->medical_record_number}}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="contact-info">
                                    <div><i class="fas fa-phone me-1"></i>{{$patient->phone_number}}</div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-age">{{$patient->age}} Tahun</span><br>
                                @if($patient->gender == "L")
                                    <span class="badge badge-gender badge-male">Laki-laki</span>
                                @elseif($patient->gender == "P")
                                    <span class="badge badge-gender badge-female">Perempuan</span>
                                @endif
                            </td>
                            <td>
                                <div class="last-visit">
                                    <strong>{{$patient->lastVisit}}</strong><br>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{route('patient.show',$patient->id)}}"
                                       class="btn btn-sm btn-primary-custom">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                    <a href="{{route('examination.index',$patient->id)}}"
                                       class="btn btn-success-custom">
                                        <i class="fas fa-plus me-2"></i>Prescribe
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@section('modals')
    <!-- Add Patient Modal -->
    <div class="modal fade" id="addPatientModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-plus me-2"></i>Add New Patient
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $msg)
                                    <li>{{ $msg }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="addPatientForm" method="post" action="{{route('patient.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="date-of-birth" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="gender" required>
                                        <option selected value="" disabled>Pilih Gender</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Telp</label>
                                    <input type="tel" class="form-control" name="phone-number" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="2" name="address" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success-custom" form="addPatientForm">
                        <i class="fas fa-save me-2"></i>Add Patient
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
