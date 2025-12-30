<template>
    <div class="event-detail-page">
        <!-- Loading State -->
        <div v-if="loading" class="loading-container">
            <div class="container text-center" style="padding-top: 120px; min-height: 50vh;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="text-muted">Loading event details...</p>
            </div>
        </div>

        <!-- Error State -->
        <div v-else-if="error" class="error-container">
            <div class="container text-center" style="padding-top: 120px; min-height: 50vh;">
                <div class="alert alert-danger mx-auto" style="max-width: 500px;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ error }}
                </div>
                <router-link to="/programs-events" class="btn btn-primary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Programs & Events
                </router-link>
            </div>
        </div>

        <!-- Event Content -->
        <div v-else-if="event">
            <!-- Hero Section -->
            <section class="event-hero-section">
                <div class="hero-overlay" v-if="event.image" :style="{ backgroundImage: `url(${event.image})` }"></div>
                <div class="container position-relative">
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="breadcrumb" class="mb-4">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <router-link to="/" class="text-white">Home</router-link>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <router-link to="/programs-events" class="text-white">Programs & Events</router-link>
                                    </li>
                                    <li class="breadcrumb-item active text-white" aria-current="page">{{ event.title }}</li>
                                </ol>
                            </nav>
                            <div class="hero-content">
                                <div class="event-badges mb-3">
                                    <div class="event-badge" v-if="event.is_featured">
                                        <i class="bi bi-star-fill me-1"></i>Featured Event
                                    </div>
                                    <div class="event-badge" v-if="event.recurrence" :class="getRecurrenceClass(event.recurrence)">
                                        <i class="bi bi-arrow-repeat me-1"></i>{{ event.recurrence }}
                                    </div>
                                    <div class="event-badge date-badge" v-if="isUpcoming">
                                        <i class="bi bi-calendar-check me-1"></i>Upcoming
                                    </div>
                                </div>
                                <h1 class="display-4 fw-bold mb-4">{{ event.title }}</h1>
                                <p class="lead mb-4" v-if="event.description">{{ event.description }}</p>
                                <div class="event-meta">
                                    <div class="meta-item" v-if="event.event_date">
                                        <i class="bi bi-calendar-event"></i>
                                        <span>{{ formatDate(event.event_date) }}</span>
                                    </div>
                                    <div class="meta-item" v-if="event.start_time">
                                        <i class="bi bi-clock"></i>
                                        <span>{{ formatTime(event.start_time) }}
                                        <span v-if="event.end_time"> - {{ formatTime(event.end_time) }}</span>
                                        </span>
                                    </div>
                                    <div class="meta-item" v-if="event.location">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span>{{ event.location }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Event Details Section -->
            <section class="event-details-section py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="event-content">
                                <h2 class="h3 mb-4">About This Event</h2>
                                <div class="content-body">
                                    <p v-if="event.description">{{ event.description }}</p>
                                    <div v-if="event.content" v-registration="{ type: 'event', itemId: event.id }" v-html="formatContent(event.content)"></div>
                                    <div v-else class="default-content">
                                        <p>Join us for this exciting community event! We look forward to seeing you there.</p>
                                        <h4>What to Expect:</h4>
                                        <ul>
                                            <li>Community gathering and networking</li>
                                            <li>Engaging activities and programs</li>
                                            <li>Opportunity to learn and get involved</li>
                                            <li>Free participation for all attendees</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <!-- Event Schedule -->
                                <div class="event-schedule mt-5" v-if="hasTimeInfo">
                                    <h3 class="h4 mb-3">Event Schedule</h3>
                                    <div class="schedule-card">
                                        <div class="schedule-item">
                                            <div class="time-badge">
                                                {{ formatTime(event.start_time) }}
                                            </div>
                                            <div class="schedule-content">
                                                <h5>Event Begins</h5>
                                                <p>{{ event.title }} starts</p>
                                            </div>
                                        </div>
                                        <div class="schedule-item" v-if="event.end_time">
                                            <div class="time-badge">
                                                {{ formatTime(event.end_time) }}
                                            </div>
                                            <div class="schedule-content">
                                                <h5>Event Ends</h5>
                                                <p>Wrap up and networking</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="event-sidebar">
                                <!-- Quick Info Card -->
                                <div class="info-card mb-4">
                                    <h4 class="card-title">Event Information</h4>
                                    <div class="info-list">
                                        <div class="info-item" v-if="event.event_date">
                                            <div class="info-label">Date</div>
                                            <div class="info-value">{{ formatDate(event.event_date) }}</div>
                                        </div>
                                        <div class="info-item" v-if="event.start_time">
                                            <div class="info-label">Time</div>
                                            <div class="info-value">
                                                {{ formatTime(event.start_time) }}
                                                <span v-if="event.end_time"> - {{ formatTime(event.end_time) }}</span>
                                            </div>
                                        </div>
                                        <div class="info-item" v-if="event.location">
                                            <div class="info-label">Location</div>
                                            <div class="info-value">{{ event.location }}</div>
                                        </div>
                                        <div class="info-item" v-if="event.recurrence">
                                            <div class="info-label">Frequency</div>
                                            <div class="info-value">{{ event.recurrence }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Cost</div>
                                            <div class="info-value text-success">Free</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Registration</div>
                                            <div class="info-value">{{ isUpcoming ? 'Open' : 'Event has passed' }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Card -->
                                <div class="info-card mb-4" v-if="isUpcoming">
                                    <h4 class="card-title">Join This Event</h4>
                                    <p class="mb-3">Interested in attending? Get in touch with us!</p>
                                    <div class="action-buttons">
                                        <router-link to="/contact" class="btn btn-primary w-100 mb-2">
                                            <i class="bi bi-calendar-plus me-2"></i>RSVP / Register
                                        </router-link>
                                        <router-link to="/volunteer" class="btn btn-outline-primary w-100">
                                            <i class="bi bi-heart me-2"></i>Volunteer for Event
                                        </router-link>
                                    </div>
                                </div>

                                <!-- Contact Card for Past Events -->
                                <div class="info-card mb-4" v-else>
                                    <h4 class="card-title">Missed This Event?</h4>
                                    <p class="mb-3">Stay connected for future events and updates!</p>
                                    <div class="action-buttons">
                                        <router-link to="/contact" class="btn btn-primary w-100 mb-2">
                                            <i class="bi bi-envelope me-2"></i>Get Updates
                                        </router-link>
                                        <router-link to="/programs-events" class="btn btn-outline-primary w-100">
                                            <i class="bi bi-calendar me-2"></i>View Upcoming Events
                                        </router-link>
                                    </div>
                                </div>

                                <!-- Share Card -->
                                <div class="info-card">
                                    <h4 class="card-title">Share This Event</h4>
                                    <div class="share-buttons">
                                        <button @click="shareEvent('facebook')" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-facebook"></i>
                                        </button>
                                        <button @click="shareEvent('twitter')" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-twitter"></i>
                                        </button>
                                        <button @click="copyLink" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-link-45deg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Related Events Section -->
            <section class="related-events-section bg-light py-5" v-if="relatedEvents.length > 0">
                <div class="container">
                    <h3 class="mb-4">Other Events You Might Like</h3>
                    <div class="row g-4">
                        <div v-for="relatedEvent in relatedEvents" :key="relatedEvent.id" class="col-md-4">
                            <div class="card event-card h-100">
                                <div v-if="relatedEvent.image" class="card-img-top" :style="{ backgroundImage: `url(${relatedEvent.image})`, height: '180px', backgroundSize: 'cover', backgroundPosition: 'center' }"></div>
                                <div class="card-body">
                                    <div class="event-date-badge mb-2" v-if="relatedEvent.event_date">
                                        {{ formatDateShort(relatedEvent.event_date) }}
                                    </div>
                                    <h5 class="card-title">{{ relatedEvent.title }}</h5>
                                    <p class="card-text">{{ truncateText(relatedEvent.description, 100) }}</p>
                                    <router-link :to="`/events/${relatedEvent.id}`" class="btn btn-outline-primary btn-sm">
                                        Learn More
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'EventDetail',
    data() {
        return {
            event: null,
            relatedEvents: [],
            loading: true,
            error: null
        }
    },
    computed: {
        isUpcoming() {
            if (!this.event?.event_date) return false;
            return new Date(this.event.event_date) >= new Date();
        },
        hasTimeInfo() {
            return this.event?.start_time || this.event?.end_time;
        }
    },
    async mounted() {
        await this.fetchEventDetail();
        if (this.event) {
            await this.fetchRelatedEvents();
        }
    },
    watch: {
        '$route'() {
            this.fetchEventDetail();
        }
    },
    methods: {
        async fetchEventDetail() {
            this.loading = true;
            this.error = null;
            try {
                const eventId = this.$route.params.id;
                const response = await axios.get(`/api/events/${eventId}`);
                this.event = response.data;
            } catch (error) {
                console.error('Error fetching event details:', error);
                if (error.response && error.response.status === 404) {
                    this.error = 'Event not found.';
                } else {
                    this.error = 'Failed to load event details. Please try again later.';
                }
            } finally {
                this.loading = false;
            }
        },
        async fetchRelatedEvents() {
            try {
                const response = await axios.get('/api/events');
                this.relatedEvents = response.data
                    .filter(e => e.id !== this.event.id)
                    .slice(0, 3);
            } catch (error) {
                console.error('Error fetching related events:', error);
            }
        },
        formatContent(content) {
            if (!content) return '';
            return content.replace(/\n/g, '<br>');
        },
        formatDate(date) {
            if (!date) return '';
            return new Date(date).toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                weekday: 'long'
            });
        },
        formatDateShort(date) {
            if (!date) return '';
            return new Date(date).toLocaleDateString('en-US', { 
                month: 'short', 
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
        getRecurrenceClass(recurrence) {
            const classes = {
                'Weekly': 'weekly-badge',
                'Monthly': 'monthly-badge',
                'Daily': 'daily-badge'
            };
            return classes[recurrence] || 'default-badge';
        },
        shareEvent(platform) {
            const url = window.location.href;
            const text = `Join me at this event: ${this.event.title}`;
            
            let shareUrl = '';
            switch (platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
                    break;
            }
            
            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
            }
        },
        async copyLink() {
            try {
                await navigator.clipboard.writeText(window.location.href);
                alert('Link copied to clipboard!');
            } catch (error) {
                console.error('Failed to copy link:', error);
            }
        }
    }
}
</script>

<style scoped>
.event-hero-section {
    background: linear-gradient(135deg, #42b883 0%, #347474 100%);
    color: white;
    padding: 120px 0 60px;
    position: relative;
    overflow: hidden;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-size: cover;
    background-position: center;
    opacity: 0.3;
    z-index: 1;
}

.hero-overlay::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #42b883 0%, #347474 100%);
    opacity: 0.8;
}

.container {
    position: relative;
    z-index: 2;
}

.breadcrumb {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 0.75rem 1rem;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.7);
}

.breadcrumb a {
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.event-badges {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.event-badge {
    display: inline-block;
    background: rgba(255, 215, 0, 0.9);
    color: #333;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
}

.date-badge {
    background: rgba(16, 185, 129, 0.9);
    color: white;
}

.weekly-badge {
    background: rgba(59, 130, 246, 0.9);
    color: white;
}

.monthly-badge {
    background: rgba(139, 92, 246, 0.9);
    color: white;
}

.event-meta {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
    margin-top: 2rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
}

.meta-item i {
    font-size: 1.2rem;
    color: #ffd700;
}

.event-details-section {
    background: white;
}

.event-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.content-body {
    color: #555;
}

.default-content ul {
    padding-left: 1.5rem;
    margin-top: 1rem;
}

.default-content li {
    margin-bottom: 0.5rem;
}

.event-schedule {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
}

.schedule-card {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.schedule-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 8px;
    border-left: 4px solid #42b883;
}

.time-badge {
    background: #42b883;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 600;
    min-width: 80px;
    text-align: center;
}

.schedule-content h5 {
    margin: 0 0 0.25rem 0;
    color: #333;
}

.schedule-content p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

.event-sidebar {
    position: sticky;
    top: 100px;
}

.info-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.card-title {
    color: #333;
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.info-list {
    space-y: 1rem;
}

.info-item {
    padding: 0.75rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.info-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.info-label {
    font-weight: 600;
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
}

.info-value {
    color: #333;
    font-weight: 500;
}

.action-buttons .btn {
    border-radius: 8px;
    font-weight: 600;
    padding: 0.75rem;
}

.share-buttons {
    display: flex;
    gap: 0.5rem;
}

.share-buttons .btn {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.related-events-section {
    border-top: 1px solid #e9ecef;
}

.event-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    border-radius: 12px;
    overflow: hidden;
}

.event-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.event-date-badge {
    background: #42b883;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-block;
}

.loading-container,
.error-container {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

@media (max-width: 768px) {
    .event-hero-section {
        padding: 100px 0 40px;
    }
    
    .event-meta {
        flex-direction: column;
        gap: 1rem;
    }
    
    .event-sidebar {
        position: relative;
        top: 0;
        margin-top: 2rem;
    }
    
    .schedule-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .time-badge {
        min-width: auto;
    }
    
    .share-buttons .btn {
        width: 35px;
        height: 35px;
    }
}
</style>