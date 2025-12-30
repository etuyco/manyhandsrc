<template>
    <div class="gallery-page">
        <!-- Hero Section -->
        <section class="hero-section bg-primary text-white">
            <div class="container">
                <div class="row align-items-center min-vh-30">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">Gallery</h1>
                        <p class="lead mb-4">
                            Explore our collection of photos and videos capturing the moments that matter most in our community.
                        </p>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="hero-graphic">
                            <i class="bi bi-camera2" style="font-size: 8rem; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section class="section-padding">
            <div class="container">
                <!-- Filter Options -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="d-flex flex-wrap gap-3 justify-content-center align-items-center">
                            <h2 class="mb-0">Media Gallery</h2>
                            <div class="ms-auto d-flex gap-2">
                                <button 
                                    class="btn"
                                    :class="activeFilter === 'all' ? 'btn-primary' : 'btn-outline-primary'"
                                    @click="setFilter('all')"
                                >
                                    All
                                </button>
                                <button 
                                    class="btn"
                                    :class="activeFilter === 'image' ? 'btn-primary' : 'btn-outline-primary'"
                                    @click="setFilter('image')"
                                >
                                    Photos
                                </button>
                                <button 
                                    class="btn"
                                    :class="activeFilter === 'video' ? 'btn-primary' : 'btn-outline-primary'"
                                    @click="setFilter('video')"
                                >
                                    Videos
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loading State -->
                <div v-if="loading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted mt-3">Loading gallery items...</p>
                </div>

                <!-- Empty State -->
                <div v-else-if="filteredGallery.length === 0" class="text-center py-5">
                    <i class="bi bi-images text-muted" style="font-size: 4rem;"></i>
                    <h3 class="text-muted mt-3">No items found</h3>
                    <p class="text-muted">{{ activeFilter === 'all' ? 'No gallery items available.' : `No ${activeFilter}s found.` }}</p>
                </div>

                <!-- Gallery Grid -->
                <div v-else class="gallery-grid">
                    <div 
                        v-for="item in filteredGallery" 
                        :key="item.id" 
                        class="gallery-item"
                        @click="openModal(item)"
                    >
                        <div class="gallery-thumbnail">
                            <!-- Image -->
                            <img 
                                v-if="item.type === 'image'" 
                                :src="'/storage/' + item.file_path" 
                                :alt="item.title"
                                class="img-fluid"
                                @error="handleImageError"
                            >
                            <!-- Video Thumbnail -->
                            <div v-else-if="item.type === 'video'" class="video-thumbnail-container">
                                <img 
                                    :src="getYoutubeThumbnail(item.url)" 
                                    :alt="item.title"
                                    class="img-fluid"
                                    @error="handleImageError"
                                >
                                <div class="video-play-overlay">
                                    <i class="bi bi-play-circle-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="gallery-content">
                            <h5>{{ item.title }}</h5>
                            <p class="text-muted">{{ truncateText(item.description, 80) }}</p>
                            <div class="gallery-meta">
                                <span class="badge" :class="item.type === 'image' ? 'bg-primary' : 'bg-success'">
                                    <i :class="item.type === 'image' ? 'bi bi-image' : 'bi bi-play-btn'"></i>
                                    {{ item.type === 'image' ? 'Photo' : 'Video' }}
                                </span>
                                <span v-if="item.event" class="badge bg-secondary">
                                    {{ item.event.title }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal for viewing full item -->
        <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">{{ selectedItem?.title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div v-if="selectedItem" class="gallery-modal-content">
                            <!-- Image -->
                            <div v-if="selectedItem.type === 'image'" class="image-container">
                                <img 
                                    :src="'/storage/' + selectedItem.file_path" 
                                    :alt="selectedItem.title"
                                    class="img-fluid w-100"
                                    @error="handleImageError"
                                >
                            </div>
                            <!-- Video -->
                            <div v-else-if="selectedItem.type === 'video'" class="video-container">
                                <div class="ratio ratio-16x9">
                                    <iframe 
                                        :src="getYoutubeEmbedUrl(selectedItem.url)"
                                        title="YouTube video player"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                    ></iframe>
                                </div>
                            </div>
                            <!-- Description -->
                            <div v-if="selectedItem.description" class="p-4">
                                <h6>Description</h6>
                                <p class="text-muted">{{ selectedItem.description }}</p>
                                <div v-if="selectedItem.event" class="mt-3">
                                    <span class="badge bg-secondary">
                                        Event: {{ selectedItem.event.title }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { Modal } from 'bootstrap';

export default {
    name: 'GalleryPage',
    data() {
        return {
            gallery: [],
            loading: true,
            activeFilter: 'all',
            selectedItem: null
        };
    },
    computed: {
        filteredGallery() {
            if (this.activeFilter === 'all') {
                return this.gallery;
            }
            return this.gallery.filter(item => item.type === this.activeFilter);
        }
    },
    mounted() {
        this.loadGallery();
    },
    methods: {
        async loadGallery() {
            try {
                this.loading = true;
                const response = await axios.get('/api/galleries');
                this.gallery = response.data;
            } catch (error) {
                console.error('Error loading gallery:', error);
            } finally {
                this.loading = false;
            }
        },
        setFilter(filter) {
            this.activeFilter = filter;
        },
        openModal(item) {
            this.selectedItem = item;
            const modal = new Modal(document.getElementById('galleryModal'));
            modal.show();
        },
        getYoutubeThumbnail(url) {
            const videoId = this.extractYouTubeVideoId(url);
            return videoId ? `https://img.youtube.com/vi/${videoId}/maxresdefault.jpg` : '';
        },
        getYoutubeEmbedUrl(url) {
            const videoId = this.extractYouTubeVideoId(url);
            return videoId ? `https://www.youtube.com/embed/${videoId}` : '';
        },
        extractYouTubeVideoId(url) {
            if (!url) return null;
            const match = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^\"&?\/\s]{11})/);
            return match ? match[1] : null;
        },
        truncateText(text, length) {
            if (!text) return '';
            return text.length > length ? text.substring(0, length) + '...' : text;
        },
        handleImageError(event) {
            event.target.src = '/images/placeholder.jpg';
        }
    }
};
</script>

<style scoped>
.hero-section {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    position: relative;
    overflow: hidden;
}

.min-vh-30 {
    min-height: 30vh;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
}

.gallery-item {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    cursor: pointer;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.gallery-thumbnail {
    height: 250px;
    overflow: hidden;
    position: relative;
}

.gallery-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-thumbnail img {
    transform: scale(1.05);
}

.video-thumbnail-container {
    position: relative;
    height: 100%;
}

.video-play-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: rgba(255, 255, 255, 0.9);
    font-size: 4rem;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.gallery-item:hover .video-play-overlay {
    color: white;
    transform: translate(-50%, -50%) scale(1.1);
}

.gallery-content {
    padding: 1.5rem;
}

.gallery-content h5 {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.75rem;
}

.gallery-meta {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
    margin-top: 1rem;
}

.badge {
    font-size: 0.8rem;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
}

.gallery-modal-content .image-container {
    max-height: 70vh;
    overflow: hidden;
}

.video-container {
    background: #000;
}

/* Responsive Design */
@media (max-width: 768px) {
    .gallery-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .gallery-thumbnail {
        height: 200px;
    }
}

/* Filter buttons */
.btn {
    border-radius: 25px;
    padding: 0.5rem 1.5rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-outline-primary:hover {
    transform: translateY(-1px);
}
</style>