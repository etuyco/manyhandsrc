<template>
    <div>
        <!-- Hero Slider -->
        <HeroSlider />

        <!-- Core Values Section -->
        <section class="section-padding bg-light">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="display-5 fw-bold mb-3">Our Core Values</h2>
                        <p class="lead text-muted">Building a stronger community together</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card card-hover h-100 text-center p-4">
                            <div class="card-body">
                                <i class="bi bi-people-fill icon-large"></i>
                                <h4 class="card-title">Social Connection</h4>
                                <p class="card-text">
                                    The support we get from our social connections can add to our feelings of meaning and purpose in life. 
                                    These, in turn, add to our resilience.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-hover h-100 text-center p-4">
                            <div class="card-body">
                                <i class="bi bi-shop icon-large"></i>
                                <h4 class="card-title">Food Security</h4>
                                <p class="card-text">
                                    Access to nutritious and sufficient food is a basic need. Apart from nutrition, food security is 
                                    linked to long-term health and economic stability.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-hover h-100 text-center p-4">
                            <div class="card-body">
                                <i class="bi bi-heart-fill icon-large"></i>
                                <h4 class="card-title">Community Support</h4>
                                <p class="card-text">
                                    Friendship and fellowship can be a source of social support which may provide a sense of belonging, 
                                    security, and community.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Programs Section -->
        <ProgramsSection />

        <!-- Events Section -->
        <EventsSection />

        <!-- Partners Section -->
        <section class="partners-section py-5">
            <div class="partners-bg-overlay"></div>
            <div class="container position-relative">
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <div class="section-badge mb-3">
                            <i class="bi bi-handshake me-2"></i>
                            <span>Trusted Partners</span>
                        </div>
                        <h2 class="display-4 fw-bold mb-4 text-white">Stronger Together</h2>
                        <p class="lead text-white-75 mx-auto" style="max-width: 600px;">
                            We collaborate with amazing organizations who share our vision of building a stronger, more connected community.
                        </p>
                    </div>
                </div>
                
                <div class="partners-grid mb-5">
                    <div class="partner-card-modern">
                        <div class="partner-logo-modern">
                            <img src="/img/partners/directfarm.png" alt="Direct Farm Manitoba" class="partner-image-modern">
                        </div>
                        <div class="partner-content">
                            <h5 class="partner-name-modern">Direct Farm Manitoba</h5>
                            <p class="partner-description-modern">Supporting local agriculture and fresh food access</p>
                            <div class="partner-tag">Agriculture</div>
                        </div>
                        <div class="partner-hover-effect"></div>
                    </div>
                    
                    <div class="partner-card-modern">
                        <div class="partner-logo-modern">
                            <img src="/img/partners/MCFCP.jpg" alt="Manitoba Community Food Currency Program" class="partner-image-modern">
                        </div>
                        <div class="partner-content">
                            <h5 class="partner-name-modern">MCFCP</h5>
                            <p class="partner-description-modern">Innovative food security solutions for families</p>
                            <div class="partner-tag">Food Security</div>
                        </div>
                        <div class="partner-hover-effect"></div>
                    </div>
                    
                    <div class="partner-card-modern">
                        <div class="partner-logo-modern">
                            <img src="/img/partners/southernhealth.jpg" alt="Southern Health Santé Sud" class="partner-image-modern">
                        </div>
                        <div class="partner-content">
                            <h5 class="partner-name-modern">Southern Health</h5>
                            <p class="partner-description-modern">Healthcare and wellness services for our community</p>
                            <div class="partner-tag">Healthcare</div>
                        </div>
                        <div class="partner-hover-effect"></div>
                    </div>
                    
                    <div class="partner-card-modern">
                        <div class="partner-logo-modern">
                            <img src="/img/partners/farmersmarket.jpg" alt="Morden Farmers Market" class="partner-image-modern">
                        </div>
                        <div class="partner-content">
                            <h5 class="partner-name-modern">Morden Farmers Market</h5>
                            <p class="partner-description-modern">Fresh local produce and community connections</p>
                            <div class="partner-tag">Community</div>
                        </div>
                        <div class="partner-hover-effect"></div>
                    </div>
                </div>
                
                <div class="row text-center">
                    <div class="col-12">
                        <div class="partnership-cta">
                            <h4 class="text-white mb-3">Want to Partner With Us?</h4>
                            <p class="text-white-75 mb-4">Join our network of community partners making a real difference</p>
                            <a href="/contact" class="btn btn-outline-light btn-lg px-5 py-3">
                                <i class="bi bi-arrow-right-circle me-2"></i>
                                Get In Touch
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import HeroSlider from './HeroSlider.vue';
import ProgramsSection from './ProgramsSection.vue';
import EventsSection from './EventsSection.vue';

export default {
    name: 'Home',
    components: {
        HeroSlider,
        ProgramsSection,
        EventsSection
    }
}
</script>

<style scoped>
/* Core Values Section Enhanced */
.section-padding {
    padding: 5rem 0;
}

.card-hover {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.card-hover:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.icon-large {
    font-size: 3rem;
    color: #42b883;
    margin-bottom: 1rem;
}

.partners-section {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 50%, #2ecc71 100%);
    position: relative;
    overflow: hidden;
}

.partners-bg-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 20%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255,255,255,0.08) 0%, transparent 50%),
        linear-gradient(45deg, rgba(0,0,0,0.1) 0%, transparent 100%);
}

.section-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    padding: 0.75rem 1.5rem;
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.text-white-75 {
    color: rgba(255, 255, 255, 0.75);
}

.partners-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin: 0 auto;
    max-width: 1200px;
}

.partner-card-modern {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    transform: translateY(0);
}

.partner-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #42b883, transparent);
    transition: all 0.6s ease;
}

.partner-card-modern:hover::before {
    left: 100%;
}

.partner-card-modern:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 
        0 20px 40px rgba(0, 0, 0, 0.1),
        0 0 0 1px rgba(66, 184, 131, 0.2);
    background: rgba(255, 255, 255, 0.98);
}

.partner-logo-modern {
    width: 100px;
    height: 100px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s ease;
    border: 3px solid rgba(66, 184, 131, 0.1);
    overflow: hidden;
    position: relative;
}

.partner-logo-modern::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: conic-gradient(from 0deg, transparent, rgba(66, 184, 131, 0.1), transparent);
    transition: all 0.6s ease;
    opacity: 0;
}

.partner-card-modern:hover .partner-logo-modern {
    transform: scale(1.1);
    border-color: rgba(66, 184, 131, 0.3);
    box-shadow: 0 10px 30px rgba(66, 184, 131, 0.2);
}

.partner-card-modern:hover .partner-logo-modern::after {
    opacity: 1;
    animation: rotate 2s linear infinite;
}

@keyframes rotate {
    100% { 
        transform: rotate(360deg); 
    }
}

.partner-image-modern {
    width: 70%;
    height: 70%;
    object-fit: contain;
    transition: all 0.4s ease;
    position: relative;
    z-index: 1;
}

.partner-content {
    position: relative;
    z-index: 2;
}

.partner-name-modern {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 0.75rem;
    font-size: 1.25rem;
    line-height: 1.3;
}

.partner-description-modern {
    color: #5a6c7d;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 1rem;
}

.partner-tag {
    display: inline-block;
    background: linear-gradient(135deg, #42b883, #2ecc71);
    color: white;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.partner-hover-effect {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(66, 184, 131, 0.05), rgba(46, 204, 113, 0.05));
    border-radius: 20px;
    opacity: 0;
    transition: all 0.4s ease;
}

.partner-card-modern:hover .partner-hover-effect {
    opacity: 1;
}

.partnership-cta {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 3rem 2rem;
    max-width: 600px;
    margin: 0 auto;
}

.partnership-cta .btn {
    border-width: 2px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.partnership-cta .btn:hover {
    background: white;
    color: #2c3e50;
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
}

@media (max-width: 768px) {
    .partners-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .partner-card-modern {
        padding: 1.5rem;
    }
    
    .partner-logo-modern {
        width: 80px;
        height: 80px;
    }
    
    .partnership-cta {
        padding: 2rem 1.5rem;
    }
}
</style>

