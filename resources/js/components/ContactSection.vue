<template>
    <section id="contact" class="section-padding">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="display-5 fw-bold mb-3">Contact Us</h2>
                    <p class="lead text-muted">Get in touch with us</p>
                </div>
            </div>
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card card-hover h-100 text-center p-4">
                        <div class="card-body">
                            <i class="bi bi-geo-alt-fill icon-large"></i>
                            <h5 class="card-title">Address</h5>
                            <p class="card-text">
                                <strong>Drop in:</strong><br>
                                500 Stephen St<br>
                                Morden, MB R6M 1T7
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-hover h-100 text-center p-4">
                        <div class="card-body">
                            <i class="bi bi-envelope-fill icon-large"></i>
                            <h5 class="card-title">Email</h5>
                            <p class="card-text">
                                <a href="mailto:programs@manyhandsrc.com" class="text-decoration-none">
                                    programs@manyhandsrc.com
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-hover h-100 text-center p-4">
                        <div class="card-body">
                            <i class="bi bi-telephone-fill icon-large"></i>
                            <h5 class="card-title">Phone</h5>
                            <p class="card-text">
                                <a href="tel:204-823-1678" class="text-decoration-none">
                                    204-823-1678
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-4">Send us a Message</h5>
                            <div v-if="success" class="alert alert-success" role="alert">
                                {{ successMessage }}
                            </div>
                            <div v-if="error" class="alert alert-danger" role="alert">
                                {{ errorMessage }}
                            </div>
                            <form @submit.prevent="submitForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Name *</label>
                                        <input type="text" class="form-control" id="name" v-model="form.name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="email" v-model="form.email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="tel" class="form-control" id="phone" v-model="form.phone">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control" id="subject" v-model="form.subject">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" rows="5" v-model="form.message" required></textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary" :disabled="submitting">
                                        <span v-if="submitting" class="spinner-border spinner-border-sm me-2" role="status"></span>
                                        Send Message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Office Hours</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Office Hours:</strong><br>
                                    Monday & Wednesday: 9:00 am - 4:00 pm</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Drop-in Hours:</strong><br>
                                    Wednesday: 12:00 pm - 4:00 pm<br>
                                    Thursday: 6:00 pm - 9:00 pm</p>
                                </div>
                            </div>
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
    name: 'ContactSection',
    data() {
        return {
            form: {
                name: '',
                email: '',
                phone: '',
                subject: '',
                message: ''
            },
            submitting: false,
            success: false,
            error: false,
            successMessage: 'Thank you for contacting us! We will get back to you soon.',
            errorMessage: 'There was an error sending your message. Please try again.'
        }
    },
    methods: {
        async submitForm() {
            this.submitting = true;
            this.success = false;
            this.error = false;

            try {
                await axios.post('/api/contact', this.form);
                this.success = true;
                this.form = {
                    name: '',
                    email: '',
                    phone: '',
                    subject: '',
                    message: ''
                };
                // Scroll to top to show success message
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } catch (error) {
                this.error = true;
                if (error.response && error.response.data && error.response.data.errors) {
                    this.errorMessage = Object.values(error.response.data.errors).flat().join(', ');
                } else if (error.response && error.response.data && error.response.data.message) {
                    this.errorMessage = error.response.data.message;
                }
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } finally {
                this.submitting = false;
            }
        }
    }
}
</script>
