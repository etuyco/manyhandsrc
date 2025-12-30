<template>
    <div class="program-detail-page">
        <!-- Loading State -->
        <div v-if="loading" class="loading-container">
            <div class="container text-center" style="padding-top: 120px; min-height: 50vh;">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="text-muted">Loading program details...</p>
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

        <!-- Program Content -->
        <div v-else-if="program">
            <!-- Hero Section -->
            <section class="program-hero-section">
                <div class="hero-overlay" v-if="program.image" :style="{ backgroundImage: `url(${program.image})` }"></div>
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
                                    <li class="breadcrumb-item active text-white" aria-current="page">{{ program.title }}</li>
                                </ol>
                            </nav>
                            <div class="hero-content">
                                <div class="program-badge mb-3" v-if="program.is_featured">
                                    <i class="bi bi-star-fill me-1"></i>Featured Program
                                </div>
                                <h1 class="display-4 fw-bold mb-4">{{ program.title }}</h1>
                                <p class="lead mb-4" v-if="program.description">{{ program.description }}</p>
                                <div class="program-meta">
                                    <div class="meta-item" v-if="program.schedule">
                                        <i class="bi bi-calendar-event"></i>
                                        <span>{{ program.schedule }}</span>
                                    </div>
                                    <div class="meta-item" v-if="program.location">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span>{{ program.location }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Program Details Section -->
            <section class="program-details-section py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="program-content">
                                <h2 class="h3 mb-4">About This Program</h2>
                                <div class="content-body" v-registration="{ type: 'program', itemId: program.id }" v-html="formatContent(program.content)"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="program-sidebar">
                                <!-- Quick Info Card -->
                                <div class="info-card mb-4">
                                    <h4 class="card-title">Program Information</h4>
                                    <div class="info-list">
                                        <div class="info-item" v-if="program.schedule">
                                            <div class="info-label">Schedule</div>
                                            <div class="info-value">{{ program.schedule }}</div>
                                        </div>
                                        <div class="info-item" v-if="program.location">
                                            <div class="info-label">Location</div>
                                            <div class="info-value">{{ program.location }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Cost</div>
                                            <div class="info-value text-success">Free</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">Registration</div>
                                            <div class="info-value">Open to all</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Card -->
                                <div class="info-card mb-4">
                                    <h4 class="card-title">Get Involved</h4>
                                    <p class="mb-3">Interested in this program? Get in touch with us!</p>
                                    <div class="action-buttons">
                                        <router-link to="/contact" class="btn btn-primary w-100 mb-2">
                                            <i class="bi bi-envelope me-2"></i>Contact Us
                                        </router-link>
                                        <router-link to="/volunteer" class="btn btn-outline-primary w-100">
                                            <i class="bi bi-heart me-2"></i>Volunteer
                                        </router-link>
                                    </div>
                                </div>

                                <!-- Share Card -->
                                <div class="info-card">
                                    <h4 class="card-title">Share This Program</h4>
                                    <div class="share-buttons">
                                        <button @click="shareProgram('facebook')" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-facebook"></i>
                                        </button>
                                        <button @click="shareProgram('twitter')" class="btn btn-outline-primary btn-sm">
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

            <!-- Related Programs Section -->
            <section class="related-programs-section bg-light py-5" v-if="relatedPrograms.length > 0">
                <div class="container">
                    <h3 class="mb-4">Other Programs You Might Like</h3>
                    <div class="row g-4">
                        <div v-for="relatedProgram in relatedPrograms" :key="relatedProgram.id" class="col-md-4">
                            <div class="card program-card h-100">
                                <div v-if="relatedProgram.image" class="card-img-top" :style="{ backgroundImage: `url(${relatedProgram.image})`, height: '180px', backgroundSize: 'cover', backgroundPosition: 'center' }"></div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ relatedProgram.title }}</h5>
                                    <p class="card-text">{{ truncateText(relatedProgram.description, 100) }}</p>
                                    <router-link :to="`/programs/${relatedProgram.id}`" class="btn btn-outline-primary btn-sm">
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
    name: 'ProgramDetail',
    data() {
        return {
            program: null,
            relatedPrograms: [],
            loading: true,
            error: null
        }
    },
    async mounted() {
        await this.fetchProgramDetail();
        if (this.program) {
            await this.fetchRelatedPrograms();
        }
    },
    watch: {
        '$route'() {
            this.fetchProgramDetail();
        }
    },
    methods: {
        async fetchProgramDetail() {
            this.loading = true;
            this.error = null;
            try {
                const programId = this.$route.params.id;
                const response = await axios.get(`/api/programs/${programId}`);
                this.program = response.data;
            } catch (error) {
                console.error('Error fetching program details:', error);
                if (error.response && error.response.status === 404) {
                    this.error = 'Program not found.';
                } else {
                    this.error = 'Failed to load program details. Please try again later.';
                }
            } finally {
                this.loading = false;
            }
        },
        async fetchRelatedPrograms() {
            try {
                const response = await axios.get('/api/programs');
                this.relatedPrograms = response.data
                    .filter(p => p.id !== this.program.id)
                    .slice(0, 3);
            } catch (error) {
                console.error('Error fetching related programs:', error);
            }
        },
        formatContent(content) {
            if (!content) return '';
            return content.replace(/\n/g, '<br>');
        },
        truncateText(text, length) {
            if (!text || text.length <= length) return text;
            return text.substring(0, length) + '...';
        },
        shareProgram(platform) {
            const url = window.location.href;
            const text = `Check out this program: ${this.program.title}`;
            
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
                // You could show a toast notification here
                alert('Link copied to clipboard!');
            } catch (error) {
                console.error('Failed to copy link:', error);
            }
        }
    }
}
</script>

<style scoped>
.program-hero-section {
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

.program-badge {
    display: inline-block;
    background: rgba(255, 215, 0, 0.9);
    color: #333;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
}

.program-meta {
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

.program-details-section {
    background: white;
}

.program-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.content-body {
    color: #555;
}

.program-sidebar {
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

.related-programs-section {
    border-top: 1px solid #e9ecef;
}

.program-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    border-radius: 12px;
    overflow: hidden;
}

.program-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.loading-container,
.error-container {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

@media (max-width: 768px) {
    .program-hero-section {
        padding: 100px 0 40px;
    }
    
    .program-meta {
        flex-direction: column;
        gap: 1rem;
    }
    
    .program-sidebar {
        position: relative;
        top: 0;
        margin-top: 2rem;
    }
    
    .share-buttons .btn {
        width: 35px;
        height: 35px;
    }
}
</style>