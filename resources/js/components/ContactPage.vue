<template>
    <div class="contact-page">
        <!-- Hero Section -->
        <section class="hero-section-enhanced">
            <div class="hero-overlay"></div>
            <div class="container position-relative">
                <div class="row align-items-center min-vh-50">
                    <div class="col-lg-6">
                        <div class="hero-content">
                            <h1 class="display-3 fw-bold mb-4">
                                <i class="bi bi-chat-dots-fill hero-icon me-3"></i>
                                Get in Touch
                            </h1>
                            <p class="lead mb-4">We're here to help and answer any questions you might have. Reach out to us and let's start a conversation.</p>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <i class="bi bi-telephone-fill"></i>
                                    <span>Quick Response</span>
                                </div>
                                <div class="stat-item">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span>Visit Us Anytime</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                       
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Contact Section -->
        <section class="quick-contact-section py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="contact-card phone-card">
                            <div class="contact-card-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <h4>Call Us</h4>
                            <p>Speak directly with our team</p>
                            <a href="tel:204-823-1678" class="contact-link">204-823-1678</a>
                            <div class="contact-hours">
                                <small><i class="bi bi-clock"></i> Mon-Fri: 9AM-5PM</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-card email-card">
                            <div class="contact-card-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <h4>Email Us</h4>
                            <p>Send us a message anytime</p>
                            <a href="mailto:programs@manyhandsrc.com" class="contact-link">programs@manyhandsrc.com</a>
                            <div class="contact-hours">
                                <small><i class="bi bi-reply"></i> Response within 24hrs</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-card location-card">
                            <div class="contact-card-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <h4>Visit Us</h4>
                            <p>Drop by our center</p>
                            <div class="contact-link address">
                                500 Stephen St<br>
                                Morden, MB R6M 1T7
                            </div>
                            <div class="contact-hours">
                                <small><i class="bi bi-door-open"></i> Open Door Policy</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Content -->
        <ContactSection />
    </div>
</template>

<script>
import ContactSection from './ContactSection.vue';

export default {
    name: 'ContactPage',
    components: {
        ContactSection
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
    flex-wrap: wrap;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

.stat-item i {
    font-size: 1.2rem;
    color: #ffd700;
}

.contact-methods {
    position: relative;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.contact-bubble {
    position: absolute;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 25px;
    padding: 1.5rem 2rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s ease;
}

.contact-bubble:hover {
    transform: scale(1.05);
    background: rgba(255, 255, 255, 0.2);
}

.contact-bubble i {
    font-size: 1.8rem;
    color: white;
}

.bubble-content h6 {
    margin: 0;
    color: white;
    font-weight: 600;
}

.bubble-content span {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.8);
}

.bubble-1 {
    top: 15%;
    left: 5%;
}

.bubble-2 {
    top: 45%;
    right: 10%;
}

.bubble-3 {
    bottom: 20%;
    left: 30%;
}

.quick-contact-section {
    background: #347474;
    color: white;
}

.contact-card {
    background: white;
    color: #333;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    border: 1px solid #e9ecef;
    transition: transform 0.2s ease;
}

.contact-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.contact-icon {
    width: 50px;
    height: 50px;
    background: #42b883;
    color: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.2rem;
}

.contact-card {
    background: white;
    border-radius: 20px;
    padding: 3rem 2rem;
    text-align: center;
    height: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.contact-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.contact-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--card-color) 0%, var(--card-color-alt) 100%);
}

.phone-card {
    --card-color: #42b883;
    --card-color-alt: #347474;
}

.email-card {
    --card-color: #10b981;
    --card-color-alt: #059669;
}

.location-card {
    --card-color: #34d399;
    --card-color-alt: #10b981;
}

.contact-card-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, var(--card-color) 0%, var(--card-color-alt) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.contact-card-icon i {
    font-size: 2rem;
    color: white;
}

.contact-card h4 {
    color: #333;
    font-weight: bold;
    margin-bottom: 1rem;
}

.contact-card p {
    color: #666;
    margin-bottom: 1.5rem;
}

.contact-link {
    display: inline-block;
    color: var(--card-color);
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 1rem;
    transition: color 0.3s ease;
}

.contact-link:hover {
    color: var(--card-color-alt);
    text-decoration: none;
}

.address {
    color: var(--card-color) !important;
    cursor: default;
    line-height: 1.4;
}

.contact-hours {
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.contact-hours small {
    color: #888;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.contact-hours i {
    color: var(--card-color);
}

@media (max-width: 768px) {
    .stats-row {
        flex-direction: column;
        gap: 1rem;
    }
    
    .contact-methods {
        height: 300px;
        margin-top: 2rem;
    }
    
    .contact-bubble {
        padding: 1rem 1.5rem;
        position: static;
        margin: 1rem 0;
        animation: none;
    }
    
    .bubble-1, .bubble-2, .bubble-3 {
        position: static;
        animation: none;
    }
}
</style>