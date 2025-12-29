<template>
    <div class="volunteer-page">
        <!-- Hero Section -->
        <section class="hero-section-enhanced">
            <div class="hero-overlay"></div>
            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="hero-content">
                            <h1 class="display-3 fw-bold mb-4">
                                <i class="bi bi-people-fill hero-icon me-3"></i>
                                Join Our Team
                            </h1>
                            <p class="lead mb-4">Be part of a community that makes a real difference. Your time and skills can help transform lives and strengthen our neighborhood.</p>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <i class="bi bi-clock-fill"></i>
                                    <span>Flexible Hours</span>
                                </div>
                                <div class="stat-item">
                                    <i class="bi bi-award-fill"></i>
                                    <span>Meaningful Impact</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Opportunities Section -->
        <section class="opportunities-section py-5">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="display-5 fw-bold mb-3">Volunteer Opportunities</h2>
                        <p class="lead text-muted">Find the perfect way to contribute to your community</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="opportunity-card">
                            <div class="opportunity-icon">
                                <i class="bi bi-basket3-fill"></i>
                            </div>
                            <h4>Food Distribution</h4>
                            <p>Help organize and distribute food packages to families in need</p>
                            <ul class="opportunity-list">
                                <li><i class="bi bi-check-circle-fill"></i> Weekend shifts available</li>
                                <li><i class="bi bi-check-circle-fill"></i> No experience required</li>
                                <li><i class="bi bi-check-circle-fill"></i> Training provided</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="opportunity-card">
                            <div class="opportunity-icon">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <h4>Event Coordination</h4>
                            <p>Support community events and programs that bring people together</p>
                            <ul class="opportunity-list">
                                <li><i class="bi bi-check-circle-fill"></i> Creative opportunities</li>
                                <li><i class="bi bi-check-circle-fill"></i> Team collaboration</li>
                                <li><i class="bi bi-check-circle-fill"></i> Leadership development</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="opportunity-card">
                            <div class="opportunity-icon">
                                <i class="bi bi-chat-heart"></i>
                            </div>
                            <h4>Community Outreach</h4>
                            <p>Connect with community members and provide support where needed</p>
                            <ul class="opportunity-list">
                                <li><i class="bi bi-check-circle-fill"></i> People-focused work</li>
                                <li><i class="bi bi-check-circle-fill"></i> Flexible scheduling</li>
                                <li><i class="bi bi-check-circle-fill"></i> Personal growth</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Volunteer Content -->
        <VolunteerSection />
    </div>
</template>

<script>
import VolunteerSection from './VolunteerSection.vue';

export default {
    name: 'VolunteerPage',
    components: {
        VolunteerSection
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

.min-vh-50 {
    min-height: 50vh;
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

.volunteer-showcase {
    position: relative;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.volunteer-card {
    position: absolute;
    width: 140px;
    height: 140px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.volunteer-card:hover {
    transform: scale(1.1);
    background: rgba(255, 255, 255, 0.2);
}

.volunteer-card i {
    font-size: 2.5rem;
    color: white;
    margin-bottom: 0.5rem;
}

.volunteer-card span {
    font-size: 0.9rem;
    font-weight: 600;
    text-align: center;
    color: white;
}

.card-1 {
    top: 10%;
    left: 10%;
}

.card-2 {
    top: 50%;
    right: 20%;
}

.card-3 {
    bottom: 15%;
    left: 40%;
}

.opportunities-section {
    background: #347474;
    color: white;
}

.opportunity-card {
    background: white;
    color: #333;
    border-radius: 8px;
    padding: 2rem;
    border: 1px solid #e9ecef;
    transition: transform 0.2s ease;
}

.opportunity-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.opportunity-icon {
    width: 50px;
    height: 50px;
    background: #42b883;
    color: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.opportunity-card {
    background: white;
    border-radius: 20px;
    padding: 2.5rem 2rem;
    height: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    color: #333;
}

.opportunity-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.opportunity-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, #42b883 0_, #347474 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.opportunity-icon i {
    font-size: 2rem;
    color: white;
}

.opportunity-card h4 {
    color: #333;
    font-weight: bold;
    margin-bottom: 1rem;
    text-align: center;
}

.opportunity-card p {
    color: #666;
    line-height: 1.6;
    text-align: center;
    margin-bottom: 2rem;
}

.opportunity-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.opportunity-list li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
    color: #555;
}

.opportunity-list i {
    color: #42b883;
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .stats-row {
        flex-direction: column;
        gap: 1rem;
    }
    
    .volunteer-showcase {
        height: 300px;
        margin-top: 2rem;
    }
    
    .volunteer-card {
        width: 120px;
        height: 120px;
    }
    
    .volunteer-card i {
        font-size: 2rem;
    }
}
</style>