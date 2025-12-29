<template>
    <div class="about-page">
        <!-- Hero Section -->
        <section class="hero-section-enhanced">
            <div class="hero-overlay"></div>
            <div class="container position-relative">
                <div class="row align-items-center min-vh-50">
                    <div class="col-lg-6">
                        <div class="hero-content">
                            <h1 class="display-3 fw-bold mb-4">
                                <i class="bi bi-heart-fill hero-icon me-3"></i>
                                About Us
                            </h1>
                            <p class="lead mb-4">Many Hands is a community-driven organization dedicated to making a positive impact in our neighborhood. Together, we believe that many hands make light work.</p>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <i class="bi bi-people-fill"></i>
                                    <span>Community First</span>
                                </div>
                                <div class="stat-item">
                                    <i class="bi bi-heart"></i>
                                    <span>Compassionate Care</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-showcase">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="mission-section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center mb-5">
                        <h2 class="display-5 fw-bold mb-4">Our Mission</h2>
                        <p class="lead text-muted">To strengthen our community by providing essential services, fostering connections, and empowering individuals to create positive change in their own lives and the lives of others.</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="mission-card">
                            <div class="mission-icon">
                                <i class="bi bi-compass-fill"></i>
                            </div>
                            <h4>Vision</h4>
                            <p>The vision of Many Hands is to be a non-profit organization that supports community members in and around Morden who are facing various challenges in accessing food, shelter, and meeting social and spiritual needs. </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mission-card">
                            <div class="mission-icon">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <h4>Values</h4>
                            <p>Compassion, integrity, collaboration, and respect for the dignity of every person we serve.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mission-card">
                            <div class="mission-icon">
                                <i class="bi bi-target"></i>
                            </div>
                            <h4>Goals</h4>
                            <p>To expand our reach, deepen our impact, and create lasting positive change in our community.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Story Section -->
        <section class="story-section py-5 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h2 class="display-6 fw-bold mb-4">Our Story</h2>
                        <p class="mb-4">In 2012, a group of community members from the Morden area came together around a concern for the growing number of local individuals and families who were really struggling to make ends meet. At a community-wide forum on food security issues and poverty, the group was encouraged by advice from David Northcott, Executive Director of Winnipeg Harvest, to “just take your vision and start something.”</p>
                        <p class="mb-4">Many Hands Resource Centre officially opened in 2013 with a physical location at 400 Stephen St. in Morden. This space, envisioned as “community living room,” provided an opportunity for individuals to connect with other people in the community during drop-in hours. The Centre also contained a food pantry, offered computer access, and assisted individuals in connecting with other local programs and resources. The drop in closed temporarily and reopened at 500 Stephen St. Many Hands continues working hard to make food and other resources available to local families and individuals facing access barriers.</p>
                        <p class="mb-4">Many Hands currently focuses their resources on providing food access through Community Meal, Community Kitchen, Morden’s Food Bank, the Farmer’s Market Voucher Program and the BAG Program (Better Access to Groceries).</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="story-stats">
                            <div class="row g-4">
                                <div class="col-6">
                                    <div class="stat-box">
                                        <h3 class="stat-number">500+</h3>
                                        <p class="stat-label">Families Served</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-box">
                                        <h3 class="stat-number">150+</h3>
                                        <p class="stat-label">Active Volunteers</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-box">
                                        <h3 class="stat-number">8</h3>
                                        <p class="stat-label">Years Strong</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-box">
                                        <h3 class="stat-number">12</h3>
                                        <p class="stat-label">Programs</p>
                                    </div>
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
    name: 'AboutPage',
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

.mission-section {
    background: white;
}

.mission-card {
    background: white;
    color: #333;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    border: 1px solid #e9ecef;
    transition: transform 0.2s ease;
    height: 100%;
}

.mission-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.mission-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, #42b883 0%, #347474 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.mission-icon i {
    font-size: 2rem;
    color: white;
}

.mission-card h4 {
    color: #333;
    font-weight: bold;
    margin-bottom: 1rem;
}

.mission-card p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 0;
}

.story-section {
    background: #f8f9fa;
}

.stat-box {
    text-align: center;
    padding: 1.5rem;
    background: white;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    color: #42b883;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #666;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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
    
    .stat-number {
        font-size: 2rem;
    }
}
</style>