<template>
    <div class="login-page">
        <div class="login-background">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
                <div class="shape shape-5"></div>
            </div>
        </div>
        <div class="container position-relative">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-lg-5 col-md-6">
                    <div class="login-card">
                        <div class="login-header">
                            <div class="brand-section">
                                <div class="brand-icon">
                                    <i class="bi bi-shield-lock-fill"></i>
                                </div>
                                <h1 class="brand-title">Admin Access</h1>
                                <p class="brand-subtitle">Secure login to Many Hands admin panel</p>
                            </div>
                        </div>
                        
                        <div class="login-body">
                            <div v-if="error" class="error-alert">
                                <div class="error-icon">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </div>
                                <div class="error-content">
                                    <strong>Login Failed</strong>
                                    <p>{{ errorMessage }}</p>
                                </div>
                            </div>
                            
                            <form @submit.prevent="handleLogin" class="login-form">
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope-fill"></i>
                                        Email Address
                                    </label>
                                    <div class="input-wrapper">
                                        <input 
                                            type="email" 
                                            class="form-control" 
                                            id="email" 
                                            v-model="form.email" 
                                            required
                                            autocomplete="email"
                                            placeholder="Enter your email"
                                        >
                                        <div class="input-focus-border"></div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="bi bi-lock-fill"></i>
                                        Password
                                    </label>
                                    <div class="input-wrapper">
                                        <input 
                                            type="password" 
                                            class="form-control" 
                                            id="password" 
                                            v-model="form.password" 
                                            required
                                            autocomplete="current-password"
                                            placeholder="Enter your password"
                                        >
                                        <div class="input-focus-border"></div>
                                    </div>
                                </div>
                                
                                <div class="form-options">
                                    <div class="remember-me">
                                        <input type="checkbox" class="form-check-input" id="remember" v-model="form.remember">
                                        <label class="form-check-label" for="remember">
                                            <span class="checkmark"></span>
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                
                                <button type="submit" class="login-btn" :disabled="loading" :class="{ 'loading': loading }">
                                    <span v-if="loading" class="loading-spinner">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </span>
                                    <span v-else class="btn-content">
                                        <i class="bi bi-box-arrow-in-right"></i>
                                        Sign In
                                    </span>
                                </button>
                            </form>
                        </div>
                        
                        <div class="login-footer">
                            <div class="security-note">
                                <i class="bi bi-shield-check"></i>
                                <span>Secured with enterprise-grade encryption</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Login',
    data() {
        return {
            form: {
                email: '',
                password: '',
                remember: false
            },
            loading: false,
            error: false,
            errorMessage: ''
        }
    },
    mounted() {
        // Check if already authenticated
        this.checkAuth();
    },
    methods: {
        async checkAuth() {
            try {
                const response = await axios.get('/check-auth');
                if (response.data.authenticated) {
                    this.$router.push('/admin');
                }
            } catch (error) {
                // Not authenticated, stay on login page
            }
        },
        async handleLogin() {
            this.loading = true;
            this.error = false;
            this.errorMessage = '';

            try {
                // Use Breeze's login endpoint
                const response = await axios.post('/login', this.form);
                
                // Login successful, redirect to admin panel
                this.$router.push('/admin');
            } catch (error) {
                this.error = true;
                if (error.response && error.response.data && error.response.data.errors) {
                    this.errorMessage = Object.values(error.response.data.errors).flat().join(', ');
                } else if (error.response && error.response.data && error.response.data.message) {
                    this.errorMessage = error.response.data.message;
                } else {
                    this.errorMessage = 'Invalid email or password. Please try again.';
                }
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>

<style scoped>
.login-page {
    min-height: 100vh;
    background: #42b883;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.login-background {
    display: none;
}

.floating-shapes {
    display: none;
}

.shape {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 60px;
    height: 60px;
    top: 60%;
    right: 20%;
    animation-delay: 1.5s;
}

.shape-3 {
    width: 100px;
    height: 100px;
    bottom: 30%;
    left: 15%;
    animation-delay: 3s;
}

.shape-4 {
    width: 40px;
    height: 40px;
    top: 80%;
    right: 10%;
    animation-delay: 4.5s;
}

.shape-5 {
    width: 120px;
    height: 120px;
    top: 10%;
    right: 5%;
    animation-delay: 2s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33% { transform: translateY(-20px) rotate(120deg); }
    66% { transform: translateY(10px) rotate(240deg); }
}

.container {
    z-index: 10;
}

.login-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    width: 100%;
    max-width: 400px;
}

.login-header {
    padding: 2rem;
    text-align: center;
    background: #f8f9fa;
}

.brand-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 1rem;
    background: #42b883;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.brand-icon i {
    font-size: 1.8rem;
    color: white;
}

.brand-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
}

.brand-subtitle {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
}

.login-body {
    padding: 2rem 3rem;
}

.error-alert {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    background: linear-gradient(135deg, #ff6b6b 0%, #ffa726 100%);
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.error-icon i {
    font-size: 1.5rem;
}

.error-content strong {
    display: block;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.error-content p {
    margin: 0;
    font-size: 0.9rem;
    opacity: 0.9;
}

.form-group {
    margin-bottom: 2rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-label i {
    color: #42b883;
    font-size: 1rem;
}

.input-wrapper {
    position: relative;
}

.form-control {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e1e5e9;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.9);
    position: relative;
}

.form-control:focus {
    outline: none;
    border-color: #42b883;
    background: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(66, 184, 131, 0.2);
}

.input-focus-border {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 2px;
    width: 0;
    background: linear-gradient(135deg, #42b883 0%, #347474 100%);
    transition: width 0.3s ease;
}

.form-control:focus + .input-focus-border {
    width: 100%;
}

.form-options {
    margin-bottom: 2rem;
}

.remember-me {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
}

.form-check-input {
    appearance: none;
    width: 20px;
    height: 20px;
    border: 2px solid #d1d5db;
    border-radius: 4px;
    background: white;
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-check-input:checked {
    background: linear-gradient(135deg, #42b883 0%, #347474 100%);
    border-color: #42b883;
}

.form-check-input:checked::before {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-weight: bold;
    font-size: 0.8rem;
}

.form-check-label {
    font-size: 0.9rem;
    color: #666;
    cursor: pointer;
    user-select: none;
}

.login-btn {
    width: 100%;
    padding: 0.75rem;
    background: #42b883;
    border: none;
    border-radius: 6px;
    color: white;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.login-btn:hover {
    background: #347474;
}

.login-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.form-control {
    padding: 0.75rem;
    border: 2px solid #e9ecef;
    border-radius: 6px;
    transition: border-color 0.2s ease;
}

.form-control:focus {
    outline: none;
    border-color: #42b883;
    box-shadow: 0 0 0 3px rgba(66, 184, 131, 0.1);
}

.login-footer {
    padding: 1.5rem 3rem 2rem;
    text-align: center;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    background: rgba(248, 250, 252, 0.5);
}

.security-note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: #666;
}

.security-note i {
    color: #10b981;
    font-size: 1rem;
}

@media (max-width: 768px) {
    .login-header,
    .login-body,
    .login-footer {
        padding-left: 2rem;
        padding-right: 2rem;
    }
    
    .brand-title {
        font-size: 1.75rem;
    }
    
    .brand-icon {
        width: 70px;
        height: 70px;
    }
    
    .brand-icon i {
        font-size: 2rem;
    }
    
    .floating-shapes {
        display: none;
    }
}

@media (max-width: 480px) {
    .login-header,
    .login-body,
    .login-footer {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
}
</style>
