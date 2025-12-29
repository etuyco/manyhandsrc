<template>
    <div class="programs-events-page">
        <!-- Hero Section -->
        <section class="hero-section-enhanced">
            <div class="hero-overlay"></div>
            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="hero-content">
                            <h1 class="display-3 fw-bold mb-4">
                                <i class="bi bi-calendar-event hero-icon me-3"></i>
                                Programs & Events
                            </h1>
                            <p class="lead mb-4">Discover our comprehensive programs and exciting events designed to strengthen our community and support those in need.</p>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <i class="bi bi-graph-up-arrow"></i>
                                    <span>Growing Programs</span>
                                </div>
                                <div class="stat-item">
                                    <i class="bi bi-people-fill"></i>
                                    <span>Community Focused</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <h5>Regular Schedule</h5>
                            <p>Consistent programming you can count on</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <h5>Community Driven</h5>
                            <p>Programs designed by and for our community</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                            </div>
                            <h5>Free Access</h5>
                            <p>All programs are free and open to everyone</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <h5>Local Focus</h5>
                            <p>Serving our immediate community needs</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Programs Section -->
        <section class="section-padding">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="display-5 fw-bold mb-3">Our Programs</h2>
                        <p class="lead text-muted">Supporting our community through various programs</p>
                    </div>
                </div>
                <div v-if="loadingPrograms" class="text-center mb-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div v-else class="row g-4">
                    <div v-for="program in programs" :key="program.id" class="col-md-6 col-lg-4">
                        <div class="card program-card card-hover h-100">
                            <div v-if="program.image" class="card-img-top" :style="{ backgroundImage: `url(${program.image})`, height: '200px', backgroundSize: 'cover', backgroundPosition: 'center' }"></div>
                            <div class="card-body d-flex flex-column">
                                <div class="card-badges mb-2" v-if="program.is_featured">
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-star-fill me-1"></i>Featured
                                    </span>
                                </div>
                                <h5 class="card-title">{{ program.title }}</h5>
                                <p class="card-text flex-grow-1">{{ truncateText(program.description || program.content, 120) }}</p>
                                <div v-if="program.schedule" class="mb-2">
                                    <small class="text-muted"><i class="bi bi-calendar"></i> {{ program.schedule }}</small>
                                </div>
                                <div v-if="program.location" class="mb-3">
                                    <small class="text-muted"><i class="bi bi-geo-alt"></i> {{ program.location }}</small>
                                </div>
                                <div class="card-actions mt-auto">
                                    <router-link :to="`/programs/${program.id}`" class="btn btn-primary w-100">
                                        <i class="bi bi-eye me-2"></i>View Details
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="!loadingPrograms && programs.length === 0" class="text-center">
                    <p class="text-muted">No programs available at the moment.</p>
                </div>
            </div>
        </section>

        <!-- Events Section -->
        <section class="section-padding bg-light">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="display-5 fw-bold mb-3">Upcoming Events</h2>
                        <p class="lead text-muted">Join us for community events and activities</p>
                    </div>
                </div>
                <div v-if="loadingEvents" class="text-center mb-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div v-else class="row g-4">
                    <div v-for="event in events" :key="event.id" class="col-md-6 col-lg-4">
                        <div class="card event-card card-hover h-100">
                            <div v-if="event.image" class="card-img-top" :style="{ backgroundImage: `url(${event.image})`, height: '200px', backgroundSize: 'cover', backgroundPosition: 'center' }"></div>
                            <div class="card-body d-flex flex-column">
                                <div class="card-badges mb-2">
                                    <span v-if="event.is_featured" class="badge bg-warning text-dark">
                                        <i class="bi bi-star-fill me-1"></i>Featured
                                    </span>
                                    <span v-if="event.recurrence" class="badge bg-primary ms-1">
                                        <i class="bi bi-arrow-repeat me-1"></i>{{ event.recurrence }}
                                    </span>
                                    <span v-if="isUpcoming(event.event_date)" class="badge bg-success ms-1">
                                        <i class="bi bi-calendar-check me-1"></i>Upcoming
                                    </span>
                                </div>
                                <h5 class="card-title">{{ event.title }}</h5>
                                <p class="card-text flex-grow-1">{{ truncateText(event.description, 120) }}</p>
                                <div v-if="event.event_date" class="mb-2">
                                    <small class="text-muted"><i class="bi bi-calendar"></i> {{ formatDate(event.event_date) }}</small>
                                </div>
                                <div v-if="event.start_time" class="mb-2">
                                    <small class="text-muted"><i class="bi bi-clock"></i> {{ formatTime(event.start_time) }} 
                                    <span v-if="event.end_time">- {{ formatTime(event.end_time) }}</span></small>
                                </div>
                                <div v-if="event.location" class="mb-3">
                                    <small class="text-muted"><i class="bi bi-geo-alt"></i> {{ event.location }}</small>
                                </div>
                                <div class="card-actions mt-auto">
                                    <router-link :to="`/events/${event.id}`" class="btn btn-primary w-100">
                                        <i class="bi bi-eye me-2"></i>View Details
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="!loadingEvents && events.length === 0" class="text-center">
                    <p class="text-muted">No events available at the moment.</p>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ProgramsEventsPage',
    data() {
        return {
            programs: [],
            events: [],
            loadingPrograms: true,
            loadingEvents: true
        }
    },
    mounted() {
        this.fetchPrograms();
        this.fetchEvents();
    },
    methods: {
        async fetchPrograms() {
            try {
                const response = await axios.get('/api/programs');
                this.programs = response.data;
            } catch (error) {
                console.error('Error fetching programs:', error);
            } finally {
                this.loadingPrograms = false;
            }
        },
        async fetchEvents() {
            try {
                const response = await axios.get('/api/events');
                this.events = response.data;
            } catch (error) {
                console.error('Error fetching events:', error);
            } finally {
                this.loadingEvents = false;
            }
        },
        formatDate(date) {
            if (!date) return '';
            return new Date(date).toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
        },
        formatTime(time) {
            if (!time) return '';
            return new Date('2000-01-01T' + time).toLocaleTimeString('en-US', { 
                hour: 'numeric', 
                minute: '2-digit',
                hour12: true 
            });
        },
        truncateText(text, length) {
            if (!text || text.length <= length) return text;
            return text.substring(0, length) + '...';
        },
        isUpcoming(date) {
            if (!date) return false;
            return new Date(date) >= new Date();
        }
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

.programs-showcase {
    position: relative;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.program-highlight {
    position: absolute;
    width: 120px;
    height: 120px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    animation: float 4s ease-in-out infinite;
}

.program-highlight:hover {
    transform: scale(1.1);
    background: rgba(255, 255, 255, 0.2);
}

.program-highlight i {
    font-size: 2rem;
    color: white;
    margin-bottom: 0.5rem;
}

.program-highlight span {
    font-size: 0.8rem;
    font-weight: 600;
    text-align: center;
    color: white;
    line-height: 1.2;
}

.highlight-1 {
    top: 5%;
    left: 15%;
    animation-delay: 0s;
}

.highlight-2 {
    top: 15%;
    right: 10%;
    animation-delay: 1s;
}

.highlight-3 {
    bottom: 25%;
    left: 5%;
    animation-delay: 2s;
}

.highlight-4 {
    bottom: 5%;
    right: 25%;
    animation-delay: 3s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-12px); }
}

.features-section {
    background: #347474;
    color: white;
    padding: 60px 0;
}

.feature-card {
    background: white;
    color: #333;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    border: 1px solid #e9ecef;
    transition: transform 0.2s ease;
}

.feature-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.feature-icon {
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

.feature-card {
    text-align: center;
    padding: 2rem 1.5rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    height: 100%;
}

.feature-card:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-5px);
}

.feature-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 1rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.feature-icon i {
    font-size: 1.5rem;
    color: white;
}

.feature-card h5 {
    color: white;
    font-weight: 600;
    margin-bottom: 0.75rem;
}

.feature-card p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    line-height: 1.4;
    margin: 0;
}

.section-padding {
    padding: 4rem 0;
}

.program-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    overflow: hidden;
}

.program-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.event-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    overflow: hidden;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.card-badges {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    min-height: 24px;
}

.card-actions {
    padding-top: 1rem;
    border-top: 1px solid #f8f9fa;
}

.card-actions .btn {
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.card-actions .btn:hover {
    transform: translateY(-1px);
}

.card-img-top {
    position: relative;
    border-radius: 0;
}

.card-img-top::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.1) 100%);
}

.card-body {
    padding: 1.5rem;
}

.card-title {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.75rem;
    line-height: 1.3;
}

.card-text {
    color: #666;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

@media (max-width: 768px) {
    .stats-row {
        flex-direction: column;
        gap: 1rem;
    }
    
    .programs-showcase {
        height: 300px;
        margin-top: 2rem;
    }
    
    .program-highlight {
        width: 100px;
        height: 100px;
    }
    
    .program-highlight i {
        font-size: 1.5rem;
    }
    
    .program-highlight span {
        font-size: 0.7rem;
    }
}
</style>

