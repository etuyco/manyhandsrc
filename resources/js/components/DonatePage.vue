<template>
    <div class="donate-page">
        <!-- Hero Section -->
        <section class="hero-section-enhanced">
            <div class="hero-overlay"></div>
            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="hero-content">
                            <h1 class="display-3 fw-bold mb-4">
                                <i class="bi bi-heart-fill hero-icon me-3"></i>
                                Make a Difference
                            </h1>
                            <p class="lead mb-4">Your generous donation helps us provide essential resources, food security, and community support to those who need it most.</p>
                            <div class="stats-row">
                                <div class="stat-item">
                                     <i class="bi bi-people-fill"></i>
                                    <span>500+ Families Served</span>
                                </div>
                                <div class="stat-item">
                                    <i class="bi bi-house-heart-fill"></i>
                                    <span>Community Impact</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Impact Section -->
        <section class="impact-section py-5">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="display-5 fw-bold mb-3">Your Impact</h2>
                        <p class="lead text-muted">See how you can make a real difference</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="impact-card">
                            <div class="impact-icon">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <h4>Cash or Cheque</h4>
                            <p>Monetary donations can be dropped off in person or mailed to Many Hands RC, 500 Stephen St, Morden, MB R6M 1T7.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="impact-card">
                            <div class="impact-icon">
                                <i class="bi bi-bag-heart"></i>
                            </div>
                            <h4>E-Transfer</h4>
                            <p>Donations can be sent to info@manyhandsrc.com using your online banking account.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="impact-card">
                            <div class="impact-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <h4>Food Bank Needs</h4>
                            <p>We accept donations of food items that can be used to help families in need. The types of items we accept are primarily canned and packaged food goods. Use the bins set up at Co-op or Giant Tiger to make your food item donation. Or call us to help with larger donations: 204 823 1678</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Donate Content -->
        <DonateSection />
    </div>
</template>

<script>
import DonateSection from './DonateSection.vue';

export default {
    name: 'DonatePage',
    components: {
        DonateSection
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

.hero-image {
    position: relative;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.floating-elements {
    position: relative;
    width: 100%;
    height: 100%;
}

.floating-icon {
    position: absolute;
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.floating-icon i {
    font-size: 2rem;
    color: white;
}

.floating-1 {
    top: 20%;
    left: 20%;
}

.floating-2 {
    top: 60%;
    right: 30%;
}

.floating-3 {
    bottom: 20%;
    left: 50%;
}

.impact-section {
    background: linear-gradient(135deg, #f0f9ff 0%, #ecfdf5 100%);
}

.impact-card {
    text-align: center;
    padding: 3rem 2rem;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.impact-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.impact-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, #42b883 0%, #347474 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.impact-icon i {
    font-size: 2rem;
    color: white;
}

.impact-card h4 {
    color: #42b883;
    font-weight: bold;
    font-size: 2rem;
    margin-bottom: 1rem;
}

.impact-card p {
    color: #666;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .stats-row {
        flex-direction: column;
        gap: 1rem;
    }
    
    .hero-image {
        height: 300px;
        margin-top: 2rem;
    }
}
</style>