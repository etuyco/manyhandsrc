<template>
    <section id="programs" class="section-padding">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="display-5 fw-bold mb-3">Our Programs</h2>
                    <p class="lead text-muted">Supporting our community through various programs</p>
                </div>
            </div>
            <div v-if="loading" class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div v-else class="row g-4">
                <div v-for="program in programs" :key="program.id" class="col-md-6 col-lg-4">
                    <div class="card program-card card-hover h-100">
                        <div v-if="program.image" class="card-img-top" :style="{ backgroundImage: `url(${program.image})`, height: '220px', backgroundSize: 'cover', backgroundPosition: 'center' }">
                            <div class="card-overlay"></div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            
                            <h5 class="card-title mb-3">{{ program.title }}</h5>
                            <p class="card-text flex-grow-1 mb-3">{{ truncateText(program.description || program.content, 120) }}</p>
                            <div class="program-meta mb-3">
                                <div v-if="program.schedule" class="meta-item">
                                    <i class="bi bi-calendar-event text-primary"></i>
                                    <small class="text-muted ms-1">{{ program.schedule }}</small>
                                </div>
                                <div v-if="program.location" class="meta-item">
                                    <i class="bi bi-geo-alt-fill text-primary"></i>
                                    <small class="text-muted ms-1">{{ program.location }}</small>
                                </div>
                            </div>
                            <div class="card-actions mt-auto">
                                <router-link :to="`/programs/${program.id}`" class="btn btn-primary w-100 btn-sm">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="!loading && programs.length === 0" class="text-center">
                <p class="text-muted">No featured programs available at the moment.</p>
                <router-link to="/programs-events" class="btn btn-primary">View All Programs</router-link>
            </div>
            <div v-else-if="!loading && programs.length > 0" class="text-center mt-4">
                <router-link to="/programs-events" class="btn btn-primary">View All Programs & Events</router-link>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ProgramsSection',
    data() {
        return {
            programs: [],
            loading: true
        }
    },
    mounted() {
        this.fetchPrograms();
    },
    methods: {
        async fetchPrograms() {
            try {
                const response = await axios.get('/api/programs', {
                    params: {
                        featured: true,
                        limit: 3
                    }
                });
                this.programs = response.data;
            } catch (error) {
                console.error('Error fetching programs:', error);
            } finally {
                this.loading = false;
            }
        },
        truncateText(text, length) {
            if (!text || text.length <= length) return text;
            return text.substring(0, length) + '...';
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

.program-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    border-radius: 16px;
    overflow: hidden;
    background: white;
}

.program-card:hover {
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

.program-card:hover .card-overlay {
    opacity: 1;
}

.card-body {
    padding: 2rem;
    min-height: 280px;
}

.card-badges {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.featured-badge {
    font-weight: 600;
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
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

.program-meta {
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
    
    .program-meta {
        gap: 0.5rem;
    }
}
</style>

