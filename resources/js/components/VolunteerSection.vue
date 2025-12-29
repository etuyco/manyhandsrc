<template>
    <section id="volunteer" class="section-padding">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="display-5 fw-bold mb-3">Volunteer With Us</h2>
                    <p class="lead text-muted">Join our community and make a difference</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <div v-if="success" class="alert alert-success" role="alert">
                                {{ successMessage }}
                            </div>
                            <div v-if="error" class="alert alert-danger" role="alert">
                                {{ errorMessage }}
                            </div>
                            <form @submit.prevent="submitForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name" class="form-label">First Name *</label>
                                        <input type="text" class="form-control" id="first_name" v-model="form.first_name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name" class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" id="last_name" v-model="form.last_name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="email" v-model="form.email" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="tel" class="form-control" id="phone" v-model="form.phone">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="availability" class="form-label">Availability</label>
                                    <textarea class="form-control" id="availability" rows="3" v-model="form.availability"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="skills" class="form-label">Skills</label>
                                    <textarea class="form-control" id="skills" rows="3" v-model="form.skills"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" rows="4" v-model="form.message"></textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary" :disabled="submitting">
                                        <span v-if="submitting" class="spinner-border spinner-border-sm me-2" role="status"></span>
                                        Submit Application
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    name: 'VolunteerSection',
    data() {
        return {
            form: {
                first_name: '',
                last_name: '',
                email: '',
                phone: '',
                availability: '',
                skills: '',
                message: ''
            },
            submitting: false,
            success: false,
            error: false,
            successMessage: 'Thank you for your interest in volunteering! We will contact you soon.',
            errorMessage: 'There was an error submitting your application. Please try again.'
        }
    },
    methods: {
        async submitForm() {
            this.submitting = true;
            this.success = false;
            this.error = false;

            try {
                await axios.post('/api/volunteers', this.form);
                this.success = true;
                this.form = {
                    first_name: '',
                    last_name: '',
                    email: '',
                    phone: '',
                    availability: '',
                    skills: '',
                    message: ''
                };
            } catch (error) {
                this.error = true;
                if (error.response && error.response.data && error.response.data.errors) {
                    this.errorMessage = Object.values(error.response.data.errors).flat().join(', ');
                }
            } finally {
                this.submitting = false;
            }
        }
    }
}
</script>

