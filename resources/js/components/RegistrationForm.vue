<template>
    <div class="registration-plugin">
        <div class="registration-header">
            <h4 class="registration-title">
                <i class="bi bi-person-plus-fill me-2"></i>
                Register for {{ type === 'program' ? 'Program' : 'Event' }}
            </h4>
            <p class="registration-subtitle">Fill out the form below to register</p>
        </div>

        <div v-if="submitted" class="registration-success">
            <div class="success-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h5>Registration Successful!</h5>
            <p>Thank you for registering. We'll be in touch with you soon.</p>
        </div>

        <form v-else @submit.prevent="submitRegistration" class="registration-form">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">First Name *</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="form.firstName" 
                        required
                        :disabled="submitting"
                    >
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name *</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="form.lastName" 
                        required
                        :disabled="submitting"
                    >
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email *</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        v-model="form.email" 
                        required
                        :disabled="submitting"
                    >
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input 
                        type="tel" 
                        class="form-control" 
                        v-model="form.phone"
                        :disabled="submitting"
                    >
                </div>
                
                <!-- Address Section -->
                <div class="col-12" v-if="showAddress">
                    <h6 class="mb-3">Address Information</h6>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Street Address</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                v-model="form.addressStreet"
                                :disabled="submitting"
                            >
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                v-model="form.addressCity"
                                :disabled="submitting"
                            >
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">State/Province</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                v-model="form.addressState"
                                :disabled="submitting"
                            >
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Postal Code</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                v-model="form.addressPostalCode"
                                :disabled="submitting"
                            >
                        </div>
                        <div class="col-12">
                            <label class="form-label">Country</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                v-model="form.addressCountry"
                                :disabled="submitting"
                            >
                        </div>
                    </div>
                </div>
                <div class="col-12" v-if="showAgeField">
                    <label class="form-label">Age</label>
                    <select class="form-control" v-model="form.age" :disabled="submitting">
                        <option value="">Select Age Range</option>
                        <option value="under-18">Under 18</option>
                        <option value="18-25">18-25</option>
                        <option value="26-35">26-35</option>
                        <option value="36-50">36-50</option>
                        <option value="51-65">51-65</option>
                        <option value="over-65">Over 65</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Additional Information</label>
                    <textarea 
                        class="form-control" 
                        v-model="form.message" 
                        rows="3"
                        placeholder="Any special requirements, dietary restrictions, or additional information..."
                        :disabled="submitting"
                    ></textarea>
                </div>
                <div class="col-12" v-if="showEmergencyContact">
                    <h6 class="mb-3">Emergency Contact Information</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Emergency Contact Name</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                v-model="form.emergencyContactName"
                                :disabled="submitting"
                            >
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Emergency Contact Phone</label>
                            <input 
                                type="tel" 
                                class="form-control" 
                                v-model="form.emergencyContactPhone"
                                :disabled="submitting"
                            >
                        </div>
                    </div>
                </div>
            </div>

            <div class="registration-actions mt-4">
                <button 
                    type="submit" 
                    class="btn btn-primary btn-lg"
                    :disabled="submitting"
                >
                    <span v-if="submitting" class="spinner-border spinner-border-sm me-2"></span>
                    <i v-else class="bi bi-check-lg me-2"></i>
                    {{ submitting ? 'Submitting...' : 'Submit Registration' }}
                </button>
            </div>
        </form>

        <div v-if="error" class="alert alert-danger mt-3">
            <i class="bi bi-exclamation-triangle me-2"></i>
            {{ error }}
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'RegistrationForm',
    props: {
        type: {
            type: String,
            required: true,
            validator: value => ['program', 'event'].includes(value)
        },
        itemId: {
            type: Number,
            required: true
        },
        options: {
            type: Object,
            default: () => ({})
        }
    },
    data() {
        return {
            form: {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                addressStreet: '',
                addressCity: '',
                addressState: '',
                addressPostalCode: '',
                addressCountry: '',
                age: '',
                message: '',
                emergencyContactName: '',
                emergencyContactPhone: ''
            },
            submitted: false,
            submitting: false,
            error: null
        };
    },
    computed: {
        showAgeField() {
            return this.options.showAge !== false;
        },
        showEmergencyContact() {
            return this.options.showEmergencyContact === true;
        },
        showAddress() {
            return this.options.showAddress !== false;
        }
    },
    methods: {
        async submitRegistration() {
            this.submitting = true;
            this.error = null;

            try {
                const registrationData = {
                    type: this.type,
                    item_id: this.itemId,
                    first_name: this.form.firstName,
                    last_name: this.form.lastName,
                    email: this.form.email,
                    phone: this.form.phone,
                    address_street: this.form.addressStreet,
                    address_city: this.form.addressCity,
                    address_state: this.form.addressState,
                    address_postal_code: this.form.addressPostalCode,
                    address_country: this.form.addressCountry,
                    age: this.form.age,
                    message: this.form.message,
                    emergency_contact_name: this.form.emergencyContactName,
                    emergency_contact_phone: this.form.emergencyContactPhone
                };

                await axios.post('/api/registrations', registrationData);
                
                this.submitted = true;
                
                // Reset form after successful submission
                setTimeout(() => {
                    this.resetForm();
                }, 3000);

            } catch (error) {
                console.error('Registration error:', error);
                this.error = error.response?.data?.message || 'Failed to submit registration. Please try again.';
            } finally {
                this.submitting = false;
            }
        },
        resetForm() {
            this.form = {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                addressStreet: '',
                addressCity: '',
                addressState: '',
                addressPostalCode: '',
                addressCountry: '',
                age: '',
                message: '',
                emergencyContactName: '',
                emergencyContactPhone: ''
            };
            this.submitted = false;
            this.error = null;
        }
    }
};
</script>

<style scoped>
.registration-plugin {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.registration-header {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid #e9ecef;
}

.registration-title {
    color: #42b883;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.registration-subtitle {
    color: #6c757d;
    margin: 0;
    font-size: 1.1rem;
}

.registration-form {
    max-width: 600px;
    margin: 0 auto;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.form-control {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #42b883;
    box-shadow: 0 0 0 0.2rem rgba(66, 184, 131, 0.25);
}

.registration-actions {
    text-align: center;
}

.btn-primary {
    background: linear-gradient(135deg, #42b883 0%, #347474 100%);
    border: none;
    border-radius: 8px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #347474 0%, #42b883 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(66, 184, 131, 0.3);
}

.btn-primary:disabled {
    opacity: 0.7;
    transform: none;
    box-shadow: none;
}

.registration-success {
    text-align: center;
    padding: 2rem;
}

.success-icon {
    font-size: 4rem;
    color: #28a745;
    margin-bottom: 1rem;
}

.registration-success h5 {
    color: #28a745;
    font-weight: 700;
    margin-bottom: 1rem;
}

.registration-success p {
    color: #6c757d;
    font-size: 1.1rem;
}

.alert {
    border-radius: 8px;
    border: none;
    padding: 1rem 1.5rem;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
}

.spinner-border-sm {
    width: 1rem;
    height: 1rem;
}

h6 {
    color: #42b883;
    font-weight: 600;
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .registration-plugin {
        padding: 1.5rem;
        margin: 1rem 0;
    }
    
    .registration-header {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
    }
    
    .registration-title {
        font-size: 1.5rem;
    }
    
    .btn-primary {
        width: 100%;
        padding: 1rem;
    }
}
</style>