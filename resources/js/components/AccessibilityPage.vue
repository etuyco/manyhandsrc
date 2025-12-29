<template>
    <div class="accessibility-page">
        <!-- Hero Section -->
        <section class="hero-section-enhanced">
            <div class="hero-overlay"></div>
            <div class="container position-relative">
                <div class="row align-items-center min-vh-50">
                    <div class="col-lg-6">
                        <div class="hero-content">
                            <h1 class="display-3 fw-bold mb-4">
                                <i class="bi bi-universal-access-circle hero-icon me-3"></i>
                                Accessibility
                            </h1>
                            <p class="lead mb-4">Many Hands is committed to ensuring our services, programs, and digital presence are accessible to everyone in our community.</p>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Inclusive Design</span>
                                </div>
                                <div class="stat-item">
                                    <i class="bi bi-people-fill"></i>
                                    <span>Equal Access</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accessibility-showcase">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Commitment Section -->
        <section class="commitment-section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center mb-5">
                        <h2 class="display-5 fw-bold mb-4">Our Commitment</h2>
                        <p class="lead text-muted">We believe that everyone deserves equal access to community resources and support. Our commitment to accessibility goes beyond compliance—it's about creating an inclusive environment where all community members can participate fully.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Standards Section -->
        <section class="standards-section py-5 bg-light">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="display-6 fw-bold mb-3">Accessibility Standards</h2>
                        <p class="lead text-muted">We follow established guidelines to ensure accessibility</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="standard-card">
                            <div class="standard-icon">
                                <i class="bi bi-globe2"></i>
                            </div>
                            <h4>Web Accessibility</h4>
                            <p>Our website follows WCAG 2.1 AA guidelines to ensure it's usable by people with various disabilities, including those using screen readers, keyboard navigation, or other assistive technologies.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="standard-card">
                            <div class="standard-icon">
                                <i class="bi bi-building"></i>
                            </div>
                            <h4>Physical Accessibility</h4>
                            <p>Our facilities are designed to be accessible to people with mobility disabilities, including wheelchair-accessible entrances, restrooms, and parking spaces.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="standard-card">
                            <div class="standard-icon">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <h4>Communication Access</h4>
                            <p>We provide multiple ways to communicate and access information, including large print materials, sign language interpreters upon request, and multilingual support.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section py-5">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="display-6 fw-bold mb-3">Accessibility Features</h2>
                        <p class="lead text-muted">How we ensure equal access to our services</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-eye-fill"></i>
                            </div>
                            <div class="feature-content">
                                <h5>Visual Accessibility</h5>
                                <p>High contrast design, scalable fonts, alternative text for images, and screen reader compatibility.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-keyboard"></i>
                            </div>
                            <div class="feature-content">
                                <h5>Keyboard Navigation</h5>
                                <p>Full website functionality available through keyboard navigation without requiring a mouse.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-translate"></i>
                            </div>
                            <div class="feature-content">
                                <h5>Language Support</h5>
                                <p>Materials available in multiple languages and interpretation services available upon request.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="feature-content">
                                <h5>Multiple Contact Methods</h5>
                                <p>Phone, email, text, and in-person options to accommodate different communication preferences.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Support Section -->
        <section class="support-section py-5 bg-light">
            <div class="container">
                <div class="row text-center">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="display-6 fw-bold mb-4">Need Accessibility Support?</h2>
                        <p class="lead mb-4">If you encounter any barriers to accessing our services or website, please let us know. We're committed to making improvements and providing alternative access methods.</p>
                        <div class="contact-options">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <a href="tel:204-823-1678" class="contact-method">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span>Call Us</span>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="mailto:accessibility@manyhands.org" class="contact-method">
                                        <i class="bi bi-envelope-fill"></i>
                                        <span>Email Us</span>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <router-link to="/contact" class="contact-method">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span>Visit Us</span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: 'AccessibilityPage',
    mounted() {
        window.scrollTo(0, 0);
    }
}
</script>

<style scoped>
.hero-section-enhanced {
    background: #42b883;
    color: white;
    padding: 80px 0;
    margin-top: 80px;
}

.hero-overlay {
    display: none;
}

.hero-icon {
    font-size: 2.5rem;
    color: #fff;
    vertical-align: middle;
}

.stats-row {
    display: flex;
    gap: 2rem;
    margin-top: 2rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: rgba(255, 255, 255, 0.9);
}

.stat-item i {
    font-size: 1.25rem;
    color: #fff;
}

.standard-card {
    background: white;
    color: #333;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    border: 1px solid #e9ecef;
    transition: transform 0.2s ease;
    height: 100%;
}

.standard-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.standard-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, #42b883 0%, #347474 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.standard-icon i {
    font-size: 2rem;
    color: white;
}

.standard-card h4 {
    color: #333;
    font-weight: bold;
    margin-bottom: 1rem;
}

.standard-card p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 0;
}

.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    background: white;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    transition: transform 0.2s ease;
}

.feature-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #42b883 0%, #347474 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.feature-icon i {
    font-size: 1.5rem;
    color: white;
}

.feature-content h5 {
    color: #333;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.feature-content p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 0;
}

.contact-method {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    padding: 1.5rem;
    background: white;
    color: #333;
    text-decoration: none;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    transition: transform 0.2s ease;
}

.contact-method:hover {
    color: #42b883;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.contact-method i {
    font-size: 1.5rem;
    color: #42b883;
}

.contact-method span {
    font-weight: 600;
}

@media (max-width: 768px) {
    .stats-row {
        flex-direction: column;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    
    .stat-item {
        justify-content: center;
    }
    
    .hero-icon {
        font-size: 2rem;
    }
    
    .feature-item {
        flex-direction: column;
        text-align: center;
    }
    
    .feature-icon {
        margin: 0 auto;
    }
}
</style>