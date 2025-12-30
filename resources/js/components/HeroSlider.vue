<template>
    <section id="home" class="hero-slider-section" role="banner">
        <div id="heroSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000" data-bs-pause="hover">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button v-for="(slide, index) in slides" :key="index" 
                        type="button" 
                        data-bs-target="#heroSlider" 
                        :data-bs-slide-to="index"
                        :class="{ active: index === 0 }"
                        :aria-label="`Slide ${index + 1}`"></button>
            </div>

            <!-- Slides -->
            <div class="carousel-inner">
                <div v-for="(slide, index) in slides" :key="index" 
                     :class="['carousel-item', { active: index === 0 }]">
                    <div class="hero-slide" :style="{ backgroundImage: `url(${slide.image})` }">
                        <div class="hero-overlay"></div>
                        <div class="container position-relative h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-lg-8 offset-lg-2 text-center">
                                    <div class="slide-content">
                                        <div v-if="slide.badge" class="welcome-badge mb-4">
                                            <i :class="slide.badgeIcon"></i>
                                            <span>{{ slide.badge }}</span>
                                        </div>
                                        <h1 class="display-2 fw-bold mb-4 slide-title" v-html="slide.title"></h1>
                                        <p class="lead mb-4 slide-description">{{ slide.description }}</p>
                                        <div class="hero-buttons d-flex gap-3 justify-content-center mb-5">
                                            <router-link v-if="slide.primaryButton" 
                                                        :to="slide.primaryButton.link" 
                                                        class="btn btn-primary btn-lg px-4 py-3">
                                                <i :class="slide.primaryButton.icon + ' me-2'"></i>
                                                {{ slide.primaryButton.text }}
                                            </router-link>
                                            <router-link v-if="slide.secondaryButton" 
                                                        :to="slide.secondaryButton.link" 
                                                        class="btn btn-outline-light btn-lg px-4 py-3">
                                                <i :class="slide.secondaryButton.icon + ' me-2'"></i>
                                                {{ slide.secondaryButton.text }}
                                            </router-link>
                                        </div>
                                        <div v-if="slide.stats" class="hero-stats">
                                            <div v-for="(stat, statIndex) in slide.stats" :key="statIndex" class="stat-item">
                                                <div class="stat-number">{{ stat.number }}</div>
                                                <div class="stat-label">{{ stat.label }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
</template>

<script>
export default {
    name: 'HeroSlider',
    data() {
        return {
            slides: [
                {
                    image: 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
                    badge: 'Welcome to our Community',
                    badgeIcon: 'bi bi-star-fill',
                    title: '<span class="text-primary">MANY HANDS</span><br>Nurturing Community and Empoweing Lives.',
                    description: 'Many Hands envisions a diverse and healthy community. A place where individuals and families all belong, have the opportunity to contribute, and access essential resources, social connection and personal growth.',
                    primaryButton: {
                        text: 'Our Programs',
                        link: '/programs-events',
                        icon: 'bi bi-calendar-check'
                    },
                    secondaryButton: {
                        text: 'Get Involved',
                        link: '/volunteer',
                        icon: 'bi bi-people'
                    },
                    stats: [
                        { number: '500+', label: 'Families Served' },
                        { number: '15+', label: 'Programs Running' },
                        { number: '100+', label: 'Volunteers' }
                    ]
                },
                {
                    image: 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
                    badge: 'Making a Difference',
                    badgeIcon: 'bi bi-heart-fill',
                    title: 'Join Our <span class="text-warning">Programs</span>',
                    description: 'Discover a wide range of community programs designed to support families, promote wellness, and create lasting connections in our neighborhood.',
                    primaryButton: {
                        text: 'View Programs',
                        link: '/programs-events',
                        icon: 'bi bi-list'
                    },
                    secondaryButton: {
                        text: 'Learn More',
                        link: '/about',
                        icon: 'bi bi-info-circle'
                    },
                    stats: [
                        { number: '20+', label: 'Weekly Programs' },
                        { number: '50+', label: 'Monthly Events' },
                        { number: '1000+', label: 'Community Members' }
                    ]
                },
                {
                    image: 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
                    badge: 'Volunteer Today',
                    badgeIcon: 'bi bi-people-fill',
                    title: 'Become a <span class="text-success">Volunteer</span>',
                    description: 'Join our amazing team of volunteers and make a real impact in your community. Every helping hand makes a difference in building a stronger, more connected neighborhood.',
                    primaryButton: {
                        text: 'Volunteer Now',
                        link: '/volunteer',
                        icon: 'bi bi-hand-thumbs-up'
                    },
                    secondaryButton: {
                        text: 'Contact Us',
                        link: '/contact',
                        icon: 'bi bi-envelope'
                    },
                    stats: [
                        { number: '150+', label: 'Active Volunteers' },
                        { number: '2000+', label: 'Volunteer Hours' },
                        { number: '10+', label: 'Years Serving' }
                    ]
                }
            ]
        }
    },
    mounted() {
        // Ensure carousel starts automatically after component mount
        this.$nextTick(() => {
            const carousel = document.getElementById('heroSlider');
            if (carousel) {
                // Initialize Bootstrap carousel with custom settings
                if (window.bootstrap && window.bootstrap.Carousel) {
                    new window.bootstrap.Carousel(carousel, {
                        interval: 4000,
                        wrap: true,
                        pause: 'hover',
                        keyboard: true
                    });
                } else {
                    // Fallback: use data attributes
                    carousel.setAttribute('data-bs-interval', '4000');
                    carousel.setAttribute('data-bs-pause', 'hover');
                }
            }
        });
    }
}
</script>

<style scoped>
.hero-slider-section {
    position: relative;
    overflow: hidden;
    height: 100vh;
    min-height: 700px;
}

.carousel {
    height: 100%;
}

.carousel-item {
    height: 100vh;
    min-height: 700px;
}

.hero-slide {
    position: relative;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, 
        rgba(17, 153, 142, 0.8) 0%, 
        rgba(56, 163, 165, 0.7) 50%, 
        rgba(26, 188, 156, 0.6) 100%);
    z-index: 1;
}

.slide-content {
    position: relative;
    z-index: 2;
    color: white;
    animation: slideInUp 1s ease-out;
}

.welcome-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    font-weight: 600;
    font-size: 0.9rem;
    color: white;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.slide-title {
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    line-height: 1.1;
}

.slide-description {
    color: rgba(255, 255, 255, 0.95);
    font-size: 1.2rem;
    max-width: 700px;
    margin: 0 auto;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

.hero-buttons .btn {
    border-radius: 50px;
    font-weight: 600;
    text-transform: none;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.hero-buttons .btn-primary {
    background: linear-gradient(135deg, #42b883 0%, #369870 100%);
    border: none;
}

.hero-buttons .btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(66, 184, 131, 0.4);
}

.hero-buttons .btn-outline-light {
    border: 2px solid rgba(255, 255, 255, 0.8);
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.hero-buttons .btn-outline-light:hover {
    transform: translateY(-3px);
    background: white;
    color: #11998e;
    box-shadow: 0 15px 35px rgba(255, 255, 255, 0.3);
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin-top: 2rem;
}

.stat-item {
    text-align: center;
    color: white;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 0.5rem;
    background: linear-gradient(45deg, #fff 0%, rgba(255,255,255,0.8) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: none;
}

.stat-label {
    font-size: 0.9rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.9;
}

/* Carousel Indicators */
.carousel-indicators {
    bottom: 30px;
    z-index: 3;
}

.carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin: 0 6px;
    background-color: rgba(255, 255, 255, 0.5);
    border: 2px solid rgba(255, 255, 255, 0.8);
    transition: all 0.3s ease;
}

.carousel-indicators button.active {
    background-color: white;
    transform: scale(1.2);
}

/* Carousel Controls */
.carousel-control-prev,
.carousel-control-next {
    width: 5%;
    z-index: 3;
    transition: opacity 0.3s ease;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    opacity: 1;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-size: 24px 24px;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.carousel-control-prev-icon:hover,
.carousel-control-next-icon:hover {
    background-color: rgba(255, 255, 255, 0.4);
    transform: scale(1.1);
}

/* Animations */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-slider-section {
        height: 100vh;
        min-height: 600px;
    }
    
    .carousel-item {
        height: 100vh;
        min-height: 600px;
    }
    
    .slide-title {
        font-size: 2.5rem !important;
    }
    
    .slide-description {
        font-size: 1rem;
        padding: 0 1rem;
    }
    
    .hero-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .hero-buttons .btn {
        width: 100%;
        max-width: 280px;
    }
    
    .hero-stats {
        gap: 1.5rem;
        flex-wrap: wrap;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .stat-label {
        font-size: 0.8rem;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 10%;
    }
    
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 36px;
        height: 36px;
        background-size: 18px 18px;
    }
}

@media (max-width: 576px) {
    .welcome-badge {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
    
    .slide-title {
        font-size: 2rem !important;
    }
    
    .hero-stats {
        gap: 1rem;
    }
    
    .stat-item {
        flex: 1;
        min-width: 80px;
    }
}

/* Fade transition */
.carousel-fade .carousel-item {
    opacity: 0;
    transition: opacity 0.6s ease-in-out;
}

.carousel-fade .carousel-item.active {
    opacity: 1;
}
</style>