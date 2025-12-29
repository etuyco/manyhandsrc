<template>
    <section id="donate" class="section-padding bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-8">
                    <h2 class="display-5 fw-bold mb-3">Donate</h2>
                    <p class="lead text-muted">Your support helps us serve the community</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <div v-if="success" class="alert alert-success" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ successMessage }}
                            </div>
                            <div v-if="error" class="alert alert-danger" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                {{ errorMessage }}
                            </div>
                            
                            <form @submit.prevent="submitDonation" v-if="!paymentStep">
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
                                    <label for="amount" class="form-label">Donation Amount ($) *</label>
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <div class="btn-group w-100" role="group">
                                                <button type="button" 
                                                        v-for="amount in [25, 50, 100, 250]" 
                                                        :key="amount"
                                                        class="btn btn-outline-primary"
                                                        :class="{ 'active': form.amount == amount }"
                                                        @click="form.amount = amount">
                                                    ${{ amount }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <input type="number" class="form-control" id="amount" v-model.number="form.amount" 
                                                   step="0.01" min="1" placeholder="Enter custom amount" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message (Optional)</label>
                                    <textarea class="form-control" id="message" rows="3" v-model="form.message"></textarea>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="is_anonymous" v-model="form.is_anonymous">
                                    <label class="form-check-label" for="is_anonymous">Make this donation anonymous</label>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary" :disabled="submitting">
                                        <span v-if="submitting" class="spinner-border spinner-border-sm me-2" role="status"></span>
                                        <i class="bi bi-credit-card me-2"></i>
                                        Continue to Payment
                                    </button>
                                </div>
                            </form>

                            <!-- Stripe Payment Form -->
                            <div v-if="paymentStep && !success">
                                <div class="mb-4">
                                    <h5 class="mb-3">Payment Details</h5>
                                    <div class="donation-summary p-3 mb-3 bg-light rounded">
                                        <div class="row">
                                            <div class="col-6"><strong>Donation Amount:</strong></div>
                                            <div class="col-6 text-end"><strong>${{ form.amount }}</strong></div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6">Donor:</div>
                                            <div class="col-6 text-end">{{ form.first_name }} {{ form.last_name }}</div>
                                        </div>
                                    </div>
                                </div>

                                <form @submit.prevent="processPayment">
                                    <div id="payment-element" class="mb-3">
                                        <!-- Stripe Elements will be mounted here -->
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-secondary" @click="goBack">
                                            <i class="bi bi-arrow-left me-2"></i>Back
                                        </button>
                                        <button type="submit" class="btn btn-success flex-fill" :disabled="processing">
                                            <span v-if="processing" class="spinner-border spinner-border-sm me-2" role="status"></span>
                                            <i class="bi bi-shield-check me-2" v-if="!processing"></i>
                                            Complete Donation ${{ form.amount }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
                                    <label class="form-check-label" for="is_anonymous">Make this donation anonymous</label>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary" :disabled="submitting">
                                        <span v-if="submitting" class="spinner-border spinner-border-sm me-2" role="status"></span>
                                        Donate
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
import { loadStripe } from '@stripe/stripe-js';

export default {
    name: 'DonateSection',
    data() {
        return {
            form: {
                first_name: '',
                last_name: '',
                email: '',
                phone: '',
                amount: '',
                message: '',
                is_anonymous: false
            },
            submitting: false,
            processing: false,
            paymentStep: false,
            success: false,
            error: false,
            successMessage: 'Thank you for your donation! We appreciate your support.',
            errorMessage: 'There was an error processing your donation. Please try again.',
            stripe: null,
            elements: null,
            paymentElement: null,
            clientSecret: null
        }
    },
    async mounted() {
        // Initialize Stripe
        console.log('Stripe Key:', process.env.MIX_STRIPE_KEY);
        if (!process.env.MIX_STRIPE_KEY) {
            console.error('Stripe publishable key not found in environment');
            this.error = true;
            this.errorMessage = 'Payment system configuration error. Please contact support.';
            return;
        }
        
        try {
            this.stripe = await loadStripe(process.env.MIX_STRIPE_KEY);
            if (!this.stripe) {
                throw new Error('Failed to initialize Stripe');
            }
            console.log('Stripe initialized successfully');
        } catch (error) {
            console.error('Stripe initialization error:', error);
            this.error = true;
            this.errorMessage = 'Failed to load payment system. Please refresh and try again.';
        }
    },
    methods: {
        async submitDonation() {
            this.submitting = true;
            this.success = false;
            this.error = false;

            try {
                // Validate Stripe is loaded
                if (!this.stripe) {
                    throw new Error('Payment system not initialized');
                }

                console.log('Creating payment intent for amount:', this.form.amount);
                
                // Create payment intent
                const response = await axios.post('/api/donations/payment-intent', {
                    amount: this.form.amount,
                    first_name: this.form.first_name,
                    last_name: this.form.last_name,
                    email: this.form.email
                });

                console.log('Payment intent response:', response.data);
                this.clientSecret = response.data.client_secret;
                this.paymentStep = true;
                
                // Wait for DOM to update before initializing Stripe Elements
                await this.$nextTick();
                await this.initializePaymentForm();
                
            } catch (error) {
                console.error('Donation submission error:', error);
                this.error = true;
                
                if (error.response) {
                    console.error('Error response:', error.response.data);
                    if (error.response.data && error.response.data.error) {
                        this.errorMessage = error.response.data.error;
                    } else if (error.response.data && error.response.data.errors) {
                        this.errorMessage = Object.values(error.response.data.errors).flat().join(', ');
                    } else {
                        this.errorMessage = `Server error: ${error.response.status}`;
                    }
                } else if (error.message) {
                    this.errorMessage = error.message;
                } else {
                    this.errorMessage = 'There was an error processing your donation. Please try again.';
                }
            } finally {
                this.submitting = false;
            }
        },

        async initializePaymentForm() {
            if (!this.stripe || !this.clientSecret) {
                console.error('Stripe or clientSecret not available');
                return;
            }

            // Check if the payment element exists in the DOM
            const paymentElement = document.getElementById('payment-element');
            if (!paymentElement) {
                console.error('Payment element not found in DOM');
                this.error = true;
                this.errorMessage = 'Payment form could not be loaded. Please try again.';
                return;
            }

            console.log('Initializing Stripe Elements...');

            const appearance = {
                theme: 'stripe',
                variables: {
                    colorPrimary: '#42b883',
                    colorBackground: '#ffffff',
                    colorText: '#212529',
                    colorDanger: '#dc3545',
                    fontFamily: '"Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif',
                    spacingUnit: '4px',
                    borderRadius: '8px'
                }
            };

            try {
                this.elements = this.stripe.elements({ 
                    clientSecret: this.clientSecret, 
                    appearance 
                });

                this.paymentElement = this.elements.create('payment');
                this.paymentElement.mount('#payment-element');
                
                console.log('Stripe Elements initialized successfully');
            } catch (error) {
                console.error('Failed to initialize Stripe Elements:', error);
                this.error = true;
                this.errorMessage = 'Failed to load payment form. Please refresh and try again.';
            }
        },

        async processPayment() {
            this.processing = true;
            this.error = false;

            try {
                const { error, paymentIntent } = await this.stripe.confirmPayment({
                    elements: this.elements,
                    confirmParams: {
                        return_url: window.location.href,
                    },
                    redirect: 'if_required'
                });

                if (error) {
                    this.error = true;
                    this.errorMessage = error.message;
                    return;
                }

                if (paymentIntent.status === 'succeeded') {
                    // Save the donation to database
                    await this.saveDonation(paymentIntent.id);
                }

            } catch (error) {
                this.error = true;
                this.errorMessage = 'Payment processing failed. Please try again.';
            } finally {
                this.processing = false;
            }
        },

        async saveDonation(paymentIntentId) {
            try {
                await axios.post('/api/donations', {
                    ...this.form,
                    payment_intent_id: paymentIntentId
                });

                this.success = true;
                this.paymentStep = false;
                this.resetForm();
                
            } catch (error) {
                this.error = true;
                if (error.response && error.response.data && error.response.data.error) {
                    this.errorMessage = error.response.data.error;
                } else {
                    this.errorMessage = 'Failed to save donation details. Please contact support.';
                }
            }
        },

        goBack() {
            this.paymentStep = false;
            if (this.paymentElement) {
                this.paymentElement.unmount();
            }
        },

        resetForm() {
            this.form = {
                first_name: '',
                last_name: '',
                email: '',
                phone: '',
                amount: '',
                message: '',
                is_anonymous: false
            };
        }
    }
}
</script>

<style scoped>
.section-padding {
    padding: 80px 0;
}

.donation-summary {
    border: 1px solid #e0e0e0;
}

.btn-group .btn.active {
    background-color: #42b883;
    border-color: #42b883;
    color: white;
}

.btn-outline-primary:hover {
    background-color: #42b883;
    border-color: #42b883;
}

#payment-element {
    padding: 20px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background: #fafafa;
}

.alert {
    border-radius: 8px;
}

.card {
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.btn-success {
    background: linear-gradient(135deg, #42b883 0%, #369870 100%);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(135deg, #369870 0%, #2d7a5f 100%);
}

.form-control:focus {
    border-color: #42b883;
    box-shadow: 0 0 0 0.2rem rgba(66, 184, 131, 0.25);
}
</style>

