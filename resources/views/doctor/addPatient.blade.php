@extends('layout.doctor')

@section('content')
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-1">
                        <i class="fas fa-user-plus me-2 text-primary"></i>Add New Patient
                    </h2>
                    <p class="text-muted mb-0">Enter patient information to create a new medical record</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="patients-list.html" class="btn btn-secondary-custom">
                        <i class="fas fa-arrow-left me-2"></i>Back to Patients
                    </a>
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
            <strong>Required fields are marked with an asterisk (*)</strong>. Please ensure all mandatory information is
            completed accurately.
        </div>

        <!-- Patient Registration Form -->
        <form id="addPatientForm" action="process-patient.php" method="POST">
            <!-- Personal Information Section -->
            <div class="form-card form-section">
                <h4 class="section-title">
                    <i class="fas fa-user me-2"></i>Personal Information
                </h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="firstName" class="form-label required-field">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lastName" class="form-label required-field">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="dateOfBirth" class="form-label required-field">Date of Birth</label>
                            <input type="date" class="form-control" id="dateOfBirth" name="date_of_birth" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="gender" class="form-label required-field">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="bloodType" class="form-label">Blood Type</label>
                            <select class="form-select" id="bloodType" name="blood_type">
                                <option value="">Select Blood Type</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="maritalStatus" class="form-label">Marital Status</label>
                            <select class="form-select" id="maritalStatus" name="marital_status">
                                <option value="">Select Status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="widowed">Widowed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="occupation" class="form-label">Occupation</label>
                            <input type="text" class="form-control" id="occupation" name="occupation">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="form-card form-section">
                <h4 class="section-title">
                    <i class="fas fa-address-book me-2"></i>Contact Information
                </h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label required-field">Phone Number</label>
                            <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                       placeholder="(555) 123-4567" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="patient@example.com">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label required-field">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3"
                              placeholder="Street address, city, state, ZIP code" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="emergencyContactName" class="form-label">Emergency Contact Name</label>
                            <input type="text" class="form-control" id="emergencyContactName"
                                   name="emergency_contact_name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="emergencyContactPhone" class="form-label">Emergency Contact Phone</label>
                            <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                <input type="tel" class="form-control" id="emergencyContactPhone"
                                       name="emergency_contact_phone" placeholder="(555) 123-4567">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Insurance Information Section -->
            <div class="form-card form-section">
                <h4 class="section-title">
                    <i class="fas fa-shield-alt me-2"></i>Insurance Information
                </h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="insuranceProvider" class="form-label">Insurance Provider</label>
                            <input type="text" class="form-control" id="insuranceProvider" name="insurance_provider"
                                   placeholder="e.g., Blue Cross Blue Shield">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="insuranceNumber" class="form-label">Insurance Policy Number</label>
                            <input type="text" class="form-control" id="insuranceNumber" name="insurance_number"
                                   placeholder="Policy/Member ID">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="insuranceGroup" class="form-label">Group Number</label>
                            <input type="text" class="form-control" id="insuranceGroup" name="insurance_group">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="copay" class="form-label">Copay Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="copay" name="copay" placeholder="0.00"
                                       step="0.01">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medical History Section -->
            <div class="form-card form-section">
                <h4 class="section-title">
                    <i class="fas fa-notes-medical me-2"></i>Medical History
                </h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="allergies" class="form-label">Known Allergies</label>
                            <textarea class="form-control" id="allergies" name="allergies" rows="3"
                                      placeholder="List any known allergies (medications, food, environmental)"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="currentMedications" class="form-label">Current Medications</label>
                            <textarea class="form-control" id="currentMedications" name="current_medications" rows="3"
                                      placeholder="List current medications and dosages"></textarea>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="medicalHistory" class="form-label">Medical History</label>
                    <textarea class="form-control" id="medicalHistory" name="medical_history" rows="4"
                              placeholder="Previous surgeries, chronic conditions, family history, etc."></textarea>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">Lifestyle Information</label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="smoker" name="smoker" value="1">
                                    <label class="form-check-label" for="smoker">
                                        Smoker
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="drinker" name="drinker"
                                           value="1">
                                    <label class="form-check-label" for="drinker">
                                        Drinks Alcohol
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="exerciseRegularly"
                                           name="exercise_regularly" value="1">
                                    <label class="form-check-label" for="exerciseRegularly">
                                        Exercises Regularly
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="hasChronicConditions"
                                           name="has_chronic_conditions" value="1">
                                    <label class="form-check-label" for="hasChronicConditions">
                                        Chronic Conditions
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-card">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success-custom">
                        <i class="fas fa-user-plus me-2"></i>Add Patient
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
