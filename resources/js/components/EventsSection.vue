<template>
    <section id="events" class="section-padding bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="display-5 fw-bold mb-3">Events</h2>
                    <p class="lead text-muted">Join us for community events and activities</p>
                </div>
            </div>
            <div v-if="loading" class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div v-else class="row g-4">
                <div v-for="event in events" :key="event.id" class="col-md-6 col-lg-4">
                    <div class="card event-card card-hover h-100">
                        <div v-if="event.image" class="card-img-top" :style="{ backgroundImage: `url(${event.image})`, height: '220px', backgroundSize: 'cover', backgroundPosition: 'center' }">
                            <div class="card-overlay"></div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="card-badges mb-3">
                               
                                <span v-if="event.recurrence" class="badge bg-info text-white recurrence-badge ms-1">
                                    <i class="bi bi-arrow-repeat me-1"></i>{{ event.recurrence }}
                                </span>
                                <span v-if="isUpcoming(event.event_date)" class="badge bg-success upcoming-badge ms-1">
                                    <i class="bi bi-calendar-check me-1"></i>Upcoming
                                </span>
                            </div>
                            <h5 class="card-title mb-3">{{ event.title }}</h5>
                            <p class="card-text flex-grow-1 mb-3">{{ truncateText(event.description, 120) }}</p>
                            <div class="event-meta mb-3">
                                <div v-if="event.event_date" class="meta-item">
                                    <i class="bi bi-calendar-event text-primary"></i>
                                    <small class="text-muted ms-1">{{ formatDateShort(event.event_date) }}</small>
                                </div>
                                <div v-if="event.start_time" class="meta-item">
                                    <i class="bi bi-clock text-primary"></i>
                                    <small class="text-muted ms-1">{{ formatTime(event.start_time) }}
                                    <span v-if="event.end_time"> - {{ formatTime(event.end_time) }}</span></small>
                                </div>
                                <div v-if="event.location" class="meta-item">
                                    <i class="bi bi-geo-alt-fill text-primary"></i>
                                    <small class="text-muted ms-1">{{ event.location }}</small>
                                </div>
                            </div>
                            <div class="card-actions mt-auto">
                                <router-link :to="`/events/${event.id}`" class="btn btn-primary w-100 btn-sm">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="!loading && events.length === 0" class="text-center">
                <p class="text-muted">No featured events available at the moment.</p>
                <router-link to="/programs-events" class="btn btn-primary">View All Events</router-link>
            </div>
            <div v-else-if="!loading && events.length > 0" class="text-center mt-4">
                <router-link to="/programs-events" class="btn btn-primary">View All Programs & Events</router-link>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    name: 'EventsSection',
    data() {
        return {
            events: [],
            loading: true
        }
    },
    mounted() {
        this.fetchEvents();
    },
    methods: {
        async fetchEvents() {
            try {
                const response = await axios.get('/api/events', {
                    params: {
                        featured: true,
                        limit: 3
                    }
                });
                this.events = response.data;
            } catch (error) {
                console.error('Error fetching events:', error);
            } finally {
                this.loading = false;
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
        formatDateShort(date) {
            if (!date) return '';
            return new Date(date).toLocaleDateString('en-US', { 
                month: 'short', 
                day: 'numeric',
                year: 'numeric'
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
.section-padding {
    padding: 4rem 0;
}

.loading-spinner {
    text-align: center;
    padding: 3rem 0;
}

.event-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    border-radius: 16px;
    overflow: hidden;
    background: white;
}

.event-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.card-img-top {
    position: relative;
    border-radius: 0;
    transition: all 0.3s ease;
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.event-card:hover .card-overlay {
    opacity: 1;
}

.card-body {
    padding: 2rem;
    min-height: 320px;
}

.card-badges {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    min-height: 30px;
    align-items: flex-start;
}

.featured-badge {
    font-weight: 600;
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
}

.recurrence-badge {
    font-weight: 600;
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
}

.upcoming-badge {
    font-weight: 600;
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
}

.card-title {
    font-weight: 700;
    color: #2d3748;
    font-size: 1.3rem;
    line-height: 1.3;
}

.card-text {
    color: #718096;
    line-height: 1.7;
    font-size: 0.95rem;
}

.event-meta {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.meta-item {
    display: flex;
    align-items: center;
}

.meta-item i {
    font-size: 1rem;
    width: 16px;
}

.card-actions {
    padding-top: 1.5rem;
    border-top: 1px solid #f7fafc;
}

.card-actions .btn {
    border-radius: 10px;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    font-size: 0.9rem;
    text-transform: none;
    letter-spacing: 0.3px;
    transition: all 0.2s ease;
    background: linear-gradient(135deg, #42b883 0%, #369870 100%);
    border: none;
}

.card-actions .btn:hover {
    transform: translateY(-2px);
    background: linear-gradient(135deg, #369870 0%, #2d7a5f 100%);
    box-shadow: 0 8px 20px rgba(66, 184, 131, 0.3);
}

@media (max-width: 768px) {
    .section-padding {
        padding: 3rem 0;
    }
    
    .card-body {
        padding: 1.5rem;
        min-height: auto;
    }
    
    .event-meta {
        gap: 0.5rem;
    }
    
    .card-badges {
        min-height: auto;
    }
}
</style>

