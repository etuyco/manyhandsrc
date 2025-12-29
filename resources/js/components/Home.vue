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
        <section class="partners-section py-5 bg-light">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="display-5 fw-bold mb-3">Our Partners</h2>
                        <p class="lead text-muted">Working together to strengthen our community</p>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="partner-card">
                            <div class="partner-logo">
                                <i class="bi bi-building"></i>
                            </div>
                            <h5 class="partner-name">Direct Farm Manitoba</h5>
                            <p class="partner-description">Supporting local agriculture and fresh food access</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="partner-card">
                            <div class="partner-logo">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <h5 class="partner-name">Manitoba Community Food Currency Program</h5>
                            <p class="partner-description">Innovative food security solutions for families</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="partner-card">
                            <div class="partner-logo">
                                <i class="bi bi-hospital"></i>
                            </div>
                            <h5 class="partner-name">Southern Health Santé Sud</h5>
                            <p class="partner-description">Healthcare and wellness services for our community</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="partner-card">
                            <div class="partner-logo">
                                <i class="bi bi-shop"></i>
                            </div>
                            <h5 class="partner-name">Morden Farmers Market</h5>
                            <p class="partner-description">Fresh local produce and community connections</p>
                        </div>
                    </div>
                </div>
                <div class="row text-center mt-5">
                    <div class="col-12">
                        <p class="text-muted">Together, we're making a difference in our community</p>
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
    background: #f8f9fa;
}

.partner-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    text-align: center;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.partner-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border-color: #42b883;
}

.partner-logo {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, #42b883 0%, #347474 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.partner-logo i {
    font-size: 2.5rem;
    color: white;
}

.partner-card:hover .partner-logo {
    transform: scale(1.1);
}

.partner-name {
    color: #333;
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1.1rem;
    line-height: 1.3;
}

.partner-description {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .partner-logo {
        width: 60px;
        height: 60px;
        margin-bottom: 1rem;
    }
    
    .partner-logo i {
        font-size: 2rem;
    }
    
    .partner-name {
        font-size: 1rem;
    }
    
    .partner-description {
        font-size: 0.85rem;
    }
}
</style>

