<template>
    <div class="admin-container">
        <!-- Admin Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <div class="brand">
                    <i class="bi bi-shield-check"></i>
                    <span>Admin Panel</span>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="#" @click.prevent="setActiveTab('dashboard')" :class="{ active: activeTab === 'dashboard' }">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="setActiveTab('messages')" :class="{ active: activeTab === 'messages' }">
                            <i class="bi bi-envelope"></i>
                            <span>Messages</span>
                            <span class="badge" v-if="contactMessages.length">{{ contactMessages.length }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="setActiveTab('programs')" :class="{ active: activeTab === 'programs' }">
                            <i class="bi bi-calendar-week"></i>
                            <span>Programs</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="setActiveTab('events')" :class="{ active: activeTab === 'events' }">
                            <i class="bi bi-calendar-check"></i>
                            <span>Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="setActiveTab('gallery')" :class="{ active: activeTab === 'gallery' }">
                            <i class="bi bi-images"></i>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="setActiveTab('registrations')" :class="{ active: activeTab === 'registrations' }">
                            <i class="bi bi-person-check"></i>
                            <span>Registrations</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="setActiveTab('users')" :class="{ active: activeTab === 'users' }">
                            <i class="bi bi-people"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="setActiveTab('content')" :class="{ active: activeTab === 'content' }">
                            <i class="bi bi-pencil-square"></i>
                            <span>Content</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="setActiveTab('settings')" :class="{ active: activeTab === 'settings' }">
                            <i class="bi bi-gear"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="admin-main">
            <!-- Top Header -->
            <header class="admin-header">
                <div class="header-left">
                    <h1 class="page-title">{{ getPageTitle() }}</h1>
                </div>
                <div class="header-right">
                    <div class="user-info">
                        <span class="greeting">Welcome back, Admin</span>
                        <div class="user-menu">
                            <button class="btn btn-outline-danger btn-sm" @click="logout">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="content-wrapper">
                <!-- Dashboard Content -->
                <div v-if="activeTab === 'dashboard'" class="dashboard">
                    <!-- Stats Overview -->
                    <div class="stats-overview">
                        <div class="stats-card">
                            <div class="stats-icon primary">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="stats-content">
                                <h3>{{ contactMessages.length }}</h3>
                                <p>New Messages</p>
                            </div>
                        </div>
                        
                        <div class="stats-card">
                            <div class="stats-icon success">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="stats-content">
                                <h3>156</h3>
                                <p>Active Users</p>
                            </div>
                        </div>
                        
                        <div class="stats-card">
                            <div class="stats-icon warning">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="stats-content">
                                <h3>23</h3>
                                <p>Events</p>
                            </div>
                        </div>
                        
                        <div class="stats-card">
                            <div class="stats-icon info">
                                <i class="bi bi-heart"></i>
                            </div>
                            <div class="stats-content">
                                <h3>$12,450</h3>
                                <p>Donations</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="dashboard-grid">
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="bi bi-clock"></i> Recent Activity</h5>
                            </div>
                            <div class="card-body">
                                <div v-if="contactMessages.length === 0" class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <p>No recent activity</p>
                                </div>
                                <div v-else class="activity-list">
                                    <div v-for="message in contactMessages.slice(0, 5)" :key="message.id" class="activity-item">
                                        <div class="activity-avatar">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div class="activity-details">
                                            <p><strong>{{ message.name }}</strong> sent a new message</p>
                                            <span class="time">{{ formatDate(message.created_at) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="bi bi-lightning"></i> Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <div class="quick-actions">
                                    <button class="action-btn" @click="setActiveTab('messages')">
                                        <i class="bi bi-envelope"></i>
                                        View Messages
                                    </button>
                                    <button class="action-btn" @click="setActiveTab('users')">
                                        <i class="bi bi-person-plus"></i>
                                        Add User
                                    </button>
                                    <button class="action-btn" @click="setActiveTab('content')">
                                        <i class="bi bi-plus-circle"></i>
                                        Create Post
                                    </button>
                                    <button class="action-btn" @click="setActiveTab('settings')">
                                        <i class="bi bi-gear"></i>
                                        Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Messages Content -->
                <div v-if="activeTab === 'messages'" class="messages-page">
                    <div class="page-actions">
                        <div class="search-bar">
                            <i class="bi bi-search"></i>
                            <input type="text" placeholder="Search messages..." v-model="searchTerm">
                        </div>
                        <button class="btn btn-danger" @click="deleteAllMessages" v-if="contactMessages.length">
                            <i class="bi bi-trash"></i>
                            Clear All
                        </button>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="header-info">
                                <h5><i class="bi bi-envelope"></i> Contact Messages</h5>
                                <span class="count-badge">{{ filteredMessages.length }} messages</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div v-if="filteredMessages.length === 0" class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h3>No messages found</h3>
                                <p>{{ contactMessages.length === 0 ? 'No messages have been received yet.' : 'No messages match your search.' }}</p>
                            </div>
                            <div v-else class="messages-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sender</th>
                                            <th>Subject</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="message in filteredMessages" :key="message.id" class="message-row">
                                            <td>
                                                <div class="sender-info">
                                                    <div class="sender-name">{{ message.name }}</div>
                                                    <div class="sender-email">{{ message.email }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="subject">{{ message.subject || 'No Subject' }}</div>
                                            </td>
                                            <td>
                                                <span class="date">{{ formatDate(message.created_at) }}</span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-primary" @click="viewMessage(message)" title="View Message">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" @click="deleteMessage(message.id)" title="Delete Message">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Programs Content -->
                <div v-if="activeTab === 'programs'" class="programs-page">
                    <div class="page-actions">
                        <button class="btn btn-success" @click="showProgramModal()">
                            <i class="bi bi-plus-circle"></i>
                            Add New Program
                        </button>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="header-info">
                                <h5><i class="bi bi-calendar-week"></i> Programs</h5>
                                <span class="count-badge">{{ programs.length }} programs</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div v-if="programs.length === 0" class="empty-state">
                                <i class="fas fa-calendar-week"></i>
                                <h3>No programs yet</h3>
                                <p>Create your first program to get started.</p>
                            </div>
                            <div v-else class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="program in programs" :key="program.id" class="message-row">
                                            <td>
                                                <div class="program-title">{{ program.title }}</div>
                                            </td>
                                            <td>
                                                <div class="program-desc">{{ truncateText(program.description, 100) }}</div>
                                            </td>
                                            <td>
                                                <span class="badge" :class="program.is_active ? 'bg-success' : 'bg-secondary'">
                                                    {{ program.is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="date">{{ formatDate(program.created_at) }}</span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-primary" @click="editProgram(program)" title="Edit Program">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" @click="deleteProgram(program.id)" title="Delete Program">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Events Content -->
                <div v-if="activeTab === 'events'" class="events-page">
                    <div class="page-actions">
                        <button class="btn btn-success" @click="showEventModal()">
                            <i class="bi bi-plus-circle"></i>
                            Add New Event
                        </button>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="header-info">
                                <h5><i class="bi bi-calendar-check"></i> Events</h5>
                                <span class="count-badge">{{ events.length }} events</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div v-if="events.length === 0" class="empty-state">
                                <i class="fas fa-calendar-check"></i>
                                <h3>No events yet</h3>
                                <p>Create your first event to get started.</p>
                            </div>
                            <div v-else class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="event in events" :key="event.id" class="message-row">
                                            <td>
                                                <div class="event-title">{{ event.title }}</div>
                                            </td>
                                            <td>
                                                <span class="date">{{ formatEventDate(event.event_date) }}</span>
                                            </td>
                                            <td>
                                                <div class="event-location">{{ event.location || 'TBA' }}</div>
                                            </td>
                                            <td>
                                                <span class="badge" :class="event.is_active ? 'bg-success' : 'bg-secondary'">
                                                    {{ event.is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-primary" @click="editEvent(event)" title="Edit Event">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" @click="deleteEvent(event.id)" title="Delete Event">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery Content -->
                <div v-if="activeTab === 'gallery'" class="gallery-page">
                    <div class="page-actions">
                        <button class="btn btn-success" @click="showGalleryModal()">
                            <i class="bi bi-plus-circle"></i>
                            Add Gallery Item
                        </button>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="header-info">
                                <h5><i class="bi bi-images"></i> Gallery</h5>
                                <span class="count-badge">{{ galleries.length }} items</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div v-if="galleries.length === 0" class="empty-state">
                                <i class="bi bi-images"></i>
                                <h3>No gallery items yet</h3>
                                <p>Add your first image or video to get started.</p>
                            </div>
                            <div v-else class="gallery-grid">
                                <div v-for="gallery in galleries" :key="gallery.id" class="gallery-item">
                                    <div class="gallery-thumbnail">
                                        <img 
                                            v-if="gallery.type === 'image'" 
                                            :src="'/storage/' + gallery.file_path" 
                                            :alt="gallery.title"
                                            @error="handleImageError"
                                        >
                                        <div 
                                            v-else-if="gallery.type === 'video'"
                                            class="video-thumbnail"
                                        >
                                            <img 
                                                :src="gallery.thumbnail || '/storage/default-video.jpg'" 
                                                :alt="gallery.title"
                                                @error="handleImageError"
                                            >
                                            <div class="play-overlay">
                                                <i class="bi bi-play-circle-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gallery-info">
                                        <h6>{{ gallery.title }}</h6>
                                        <p class="gallery-desc">{{ truncateText(gallery.description, 60) }}</p>
                                        <div class="gallery-meta">
                                            <span class="badge" :class="gallery.type === 'image' ? 'bg-primary' : 'bg-success'">
                                                {{ gallery.type }}
                                            </span>
                                            <span v-if="gallery.event" class="event-tag">
                                                {{ gallery.event.title }}
                                            </span>
                                        </div>
                                        <div class="gallery-actions">
                                            <button class="btn btn-sm btn-primary" @click="editGallery(gallery)" title="Edit Item">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" @click="deleteGallery(gallery.id)" title="Delete Item">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other Tabs -->
                <div v-if="activeTab === 'users'" class="page-content">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-users"></i> User Management</h5>
                        </div>
                        <div class="card-body">
                            <div class="coming-soon">
                                <i class="fas fa-tools"></i>
                                <h3>Coming Soon</h3>
                                <p>User management features are under development.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="activeTab === 'registrations'" class="page-content">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5><i class="bi bi-person-check"></i> Registration Management</h5>
                            <div class="header-actions">
                                <div class="form-check form-switch me-3">
                                    <input class="form-check-input" type="checkbox" id="autoRefresh" v-model="autoRefresh">
                                    <label class="form-check-label" for="autoRefresh">Auto Refresh</label>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" @click="fetchRegistrations" :disabled="loadingRegistrations">
                                    <i class="bi bi-arrow-clockwise"></i>
                                    <span v-if="loadingRegistrations">Refreshing...</span>
                                    <span v-else>Refresh</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Registrations Stats -->
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="stat-card">
                                        <div class="stat-icon bg-primary">
                                            <i class="bi bi-person-plus"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h3>{{ registrations.total || 0 }}</h3>
                                            <p>Total Registrations</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card">
                                        <div class="stat-icon bg-success">
                                            <i class="bi bi-check-circle"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h3>{{ confirmedRegistrationsCount }}</h3>
                                            <p>Confirmed</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card">
                                        <div class="stat-icon bg-warning">
                                            <i class="bi bi-hourglass-split"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h3>{{ pendingRegistrationsCount }}</h3>
                                            <p>Pending</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card">
                                        <div class="stat-icon bg-info">
                                            <i class="bi bi-calendar-today"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h3>{{ todaysRegistrations }}</h3>
                                            <p>Today</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Filter Controls -->
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label class="form-label">Filter by Type</label>
                                    <select class="form-select" v-model="registrationFilters.type" @change="fetchRegistrations">
                                        <option value="">All Types</option>
                                        <option value="program">Programs</option>
                                        <option value="event">Events</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Filter by Status</label>
                                    <select class="form-select" v-model="registrationFilters.status" @change="fetchRegistrations">
                                        <option value="">All Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Search</label>
                                    <input type="text" class="form-control" placeholder="Search by name or email..." v-model="registrationFilters.search" @input="debounceSearch">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button class="btn btn-outline-secondary" @click="clearRegistrationFilters">
                                        <i class="bi bi-x-circle"></i> Clear
                                    </button>
                                </div>
                            </div>

                            <!-- Loading State -->
                            <div v-if="loadingRegistrations" class="text-center py-4">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="text-muted mt-2">Loading registrations...</p>
                            </div>

                            <!-- Registrations Table -->
                            <div v-else-if="registrations.data && registrations.data.length > 0" class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Program/Event</th>
                                            <th>Age</th>
                                            <th>Emergency Contact</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="registration in registrations.data" :key="registration.id">
                                            <td>
                                                <div class="registration-name">
                                                    <strong>{{ registration.full_name || (registration.first_name + ' ' + registration.last_name) }}</strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="contact-info">
                                                    <div><i class="bi bi-envelope"></i> {{ registration.email }}</div>
                                                    <div><i class="bi bi-phone"></i> {{ registration.phone }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="address-info" v-if="registration.full_address">
                                                    <div class="address-compact">
                                                        <i class="bi bi-geo-alt me-1 text-primary"></i>
                                                        <small class="text-truncate" style="max-width: 200px; display: inline-block;" :title="registration.full_address">
                                                            {{ registration.full_address }}
                                                        </small>
                                                    </div>
                                                </div>
                                                <span v-else class="text-muted small"><i class="bi bi-geo-alt me-1"></i>Not provided</span>
                                            </td>
                                            <td>
                                                <div class="program-info">
                                                    <span class="badge" :class="registration.type === 'program' ? 'bg-primary' : 'bg-info'">
                                                        {{ registration.type === 'program' ? 'Program' : 'Event' }}
                                                    </span>
                                                    <div class="program-title mt-1">
                                                        {{ registration.related_item ? registration.related_item.title : 'Unknown' }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="age-badge">{{ registration.age || 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <div class="emergency-contact" v-if="registration.emergency_contact_name">
                                                    <div><strong>{{ registration.emergency_contact_name }}</strong></div>
                                                    <div><i class="bi bi-phone"></i> {{ registration.emergency_contact_phone }}</div>
                                                </div>
                                                <span v-else class="text-muted">Not provided</span>
                                            </td>
                                            <td>
                                                <span class="badge" :class="{
                                                    'bg-success': registration.status === 'confirmed',
                                                    'bg-warning': registration.status === 'pending',
                                                    'bg-danger': registration.status === 'cancelled'
                                                }">
                                                    {{ registration.status }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="date">{{ formatDate(registration.created_at) }}</span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-outline-primary me-1" @click="viewRegistration(registration)" title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <div class="dropdown d-inline-block me-1">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" @click="toggleDropdown($event)" :id="'dropdown-' + registration.id">
                                                            <i class="bi bi-gear"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" :id="'menu-' + registration.id">
                                                            <li><a class="dropdown-item" href="#" @click.prevent="updateRegistrationStatus(registration.id, 'pending')">
                                                                <i class="bi bi-hourglass"></i> Set Pending
                                                            </a></li>
                                                            <li><a class="dropdown-item" href="#" @click.prevent="updateRegistrationStatus(registration.id, 'confirmed')">
                                                                <i class="bi bi-check-circle"></i> Confirm
                                                            </a></li>
                                                            <li><a class="dropdown-item" href="#" @click.prevent="updateRegistrationStatus(registration.id, 'cancelled')">
                                                                <i class="bi bi-x-circle"></i> Cancel
                                                            </a></li>
                                                        </ul>
                                                    </div>
                                                    <button class="btn btn-sm btn-outline-danger" @click="deleteRegistration(registration.id)" title="Delete Registration">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <nav v-if="registrations.last_page > 1" aria-label="Registration pagination">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item" :class="{ disabled: registrations.current_page === 1 }">
                                            <button class="page-link" @click="setRegistrationPage(registrations.current_page - 1)" :disabled="registrations.current_page === 1">
                                                Previous
                                            </button>
                                        </li>
                                        <li v-for="page in registrations.last_page" :key="page" class="page-item" :class="{ active: registrations.current_page === page }">
                                            <button class="page-link" @click="setRegistrationPage(page)">{{ page }}</button>
                                        </li>
                                        <li class="page-item" :class="{ disabled: registrations.current_page === registrations.last_page }">
                                            <button class="page-link" @click="setRegistrationPage(registrations.current_page + 1)" :disabled="registrations.current_page === registrations.last_page">
                                                Next
                                            </button>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                            <!-- No Registrations -->
                            <div v-else class="text-center py-5">
                                <div class="empty-state">
                                    <i class="bi bi-person-plus display-1 text-muted"></i>
                                    <h3>No Registrations Yet</h3>
                                    <p class="text-muted">Registrations will appear here once people start signing up for programs and events.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="activeTab === 'content'" class="page-content">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-edit"></i> Content Management</h5>
                        </div>
                        <div class="card-body">
                            <div class="coming-soon">
                                <i class="fas fa-file-alt"></i>
                                <h3>Coming Soon</h3>
                                <p>Content management system is under development.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="activeTab === 'settings'" class="page-content">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-cog"></i> System Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="coming-soon">
                                <i class="fas fa-sliders-h"></i>
                                <h3>Coming Soon</h3>
                                <p>Settings panel is under development.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Message Detail Modal -->
        <div class="modal fade" id="messageModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-envelope-open"></i>
                            Message from {{ selectedMessage?.name }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" v-if="selectedMessage">
                        <div class="message-details">
                            <div class="detail-row">
                                <label>From:</label>
                                <span>{{ selectedMessage.name }} &lt;{{ selectedMessage.email }}&gt;</span>
                            </div>
                            <div class="detail-row">
                                <label>Subject:</label>
                                <span>{{ selectedMessage.subject || 'No Subject' }}</span>
                            </div>
                            <div class="detail-row">
                                <label>Received:</label>
                                <span>{{ formatDate(selectedMessage.created_at) }}</span>
                            </div>
                            <div class="detail-row">
                                <label>Message:</label>
                                <div class="message-body">{{ selectedMessage.message }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Close
                        </button>
                        <button type="button" class="btn btn-danger" @click="deleteMessage(selectedMessage?.id)" data-bs-dismiss="modal">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Program Modal -->
        <div class="modal fade" id="programModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-calendar-week"></i>
                            {{ programForm.id ? 'Edit Program' : 'Add New Program' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="saveProgram">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" v-model="programForm.title" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" v-model="programForm.description" rows="4" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Content <small class="text-muted">(HTML allowed - add &lt;registration&gt;&lt;/registration&gt; tags where you want registration forms)</small></label>
                                <textarea class="form-control" v-model="programForm.content" rows="8" 
                                          placeholder="Enter program content. Use &lt;registration&gt;&lt;/registration&gt; tags to add registration forms."></textarea>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="programForm.is_active" id="programActive">
                                <label class="form-check-label" for="programActive">
                                    Active
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i> Cancel
                        </button>
                        <button type="button" class="btn btn-primary" @click="saveProgram">
                            <i class="bi bi-check"></i> {{ programForm.id ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Modal -->
        <div class="modal fade" id="eventModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-calendar-check"></i>
                            {{ eventForm.id ? 'Edit Event' : 'Add New Event' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="saveEvent">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" v-model="eventForm.title" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" v-model="eventForm.description" rows="4" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Content <small class="text-muted">(HTML allowed - add &lt;registration&gt;&lt;/registration&gt; tags where you want registration forms)</small></label>
                                <textarea class="form-control" v-model="eventForm.content" rows="8" 
                                          placeholder="Enter event content. Use &lt;registration&gt;&lt;/registration&gt; tags to add registration forms."></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Event Date</label>
                                        <input type="date" class="form-control" v-model="eventForm.event_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Event Time</label>
                                        <input type="time" class="form-control" v-model="eventForm.event_time">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" v-model="eventForm.location">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="eventForm.is_active" id="eventActive">
                                <label class="form-check-label" for="eventActive">
                                    Active
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i> Cancel
                        </button>
                        <button type="button" class="btn btn-primary" @click="saveEvent">
                            <i class="bi bi-check"></i> {{ eventForm.id ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Modal -->
        <div class="modal fade" id="galleryModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-images"></i>
                            {{ galleryForm.id ? 'Edit Gallery Item' : 'Add New Gallery Item' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="saveGallery" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" v-model="galleryForm.title" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" v-model="galleryForm.description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select class="form-control" v-model="galleryForm.type" required @change="onTypeChange">
                                    <option value="">Select Type</option>
                                    <option value="image">Image</option>
                                    <option value="video">Video (YouTube)</option>
                                </select>
                            </div>
                            <div v-if="galleryForm.type === 'video'" class="mb-3">
                                <label class="form-label">YouTube URL</label>
                                <input type="url" class="form-control" v-model="galleryForm.url" 
                                       placeholder="https://www.youtube.com/watch?v=..." required>
                                <small class="form-text text-muted">Paste a YouTube video URL</small>
                            </div>
                            <div v-if="galleryForm.type === 'image'" class="mb-3">
                                <label class="form-label">Upload Image</label>
                                <input type="file" class="form-control" ref="fileInput" 
                                       @change="onFileChange" accept="image/*" :required="!galleryForm.id">
                                <small class="form-text text-muted">Supported formats: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Associated Event (Optional)</label>
                                <select class="form-control" v-model="galleryForm.event_id">
                                    <option value="">No specific event</option>
                                    <option v-for="event in availableEvents" :key="event.id" :value="event.id">
                                        {{ event.title }}
                                    </option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="galleryForm.is_active" id="galleryActive">
                                        <label class="form-check-label" for="galleryActive">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" class="form-control" v-model="galleryForm.sort_order" min="0">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i> Cancel
                        </button>
                        <button type="button" class="btn btn-primary" @click="saveGallery">
                            <i class="bi bi-check"></i> {{ galleryForm.id ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Registration Detail Modal -->
        <div class="modal fade" id="registrationDetailModal" tabindex="-1" v-if="selectedRegistration">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-person-lines-fill"></i>
                            Registration Details
                        </h5>
                        <button type="button" class="btn-close" @click="closeRegistrationModal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Personal Information Card -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 text-primary">
                                    <i class="bi bi-person me-2"></i>Personal Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="text-muted small">Full Name</label>
                                            <div class="fw-bold">{{ selectedRegistration.full_name || (selectedRegistration.first_name + ' ' + selectedRegistration.last_name) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="text-muted small">Age Range</label>
                                            <div>{{ selectedRegistration.age || 'Not provided' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="text-muted small">Email</label>
                                            <div><i class="bi bi-envelope me-1"></i>{{ selectedRegistration.email }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="text-muted small">Phone</label>
                                            <div><i class="bi bi-phone me-1"></i>{{ selectedRegistration.phone || 'Not provided' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Information Card -->
                        <div class="card mb-3" v-if="selectedRegistration.full_address">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 text-primary">
                                    <i class="bi bi-geo-alt me-2"></i>Address Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12" v-if="selectedRegistration.address_street">
                                        <div class="info-item">
                                            <label class="text-muted small">Street Address</label>
                                            <div>{{ selectedRegistration.address_street }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" v-if="selectedRegistration.address_city">
                                        <div class="info-item">
                                            <label class="text-muted small">City</label>
                                            <div>{{ selectedRegistration.address_city }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" v-if="selectedRegistration.address_state">
                                        <div class="info-item">
                                            <label class="text-muted small">State/Province</label>
                                            <div>{{ selectedRegistration.address_state }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" v-if="selectedRegistration.address_postal_code">
                                        <div class="info-item">
                                            <label class="text-muted small">Postal Code</label>
                                            <div>{{ selectedRegistration.address_postal_code }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" v-if="selectedRegistration.address_country">
                                        <div class="info-item">
                                            <label class="text-muted small">Country</label>
                                            <div>{{ selectedRegistration.address_country }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="alert alert-info mb-0">
                                            <small><i class="bi bi-geo me-1"></i>{{ selectedRegistration.full_address }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Registration Details Card -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 text-primary">
                                    <i class="bi bi-clipboard-check me-2"></i>Registration Details
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="text-muted small">Registration Type</label>
                                            <div>
                                                <span class="badge" :class="selectedRegistration.type === 'program' ? 'bg-primary' : 'bg-info'">
                                                    <i :class="selectedRegistration.type === 'program' ? 'bi bi-collection' : 'bi bi-calendar-event'" class="me-1"></i>
                                                    {{ selectedRegistration.type === 'program' ? 'Program' : 'Event' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="text-muted small">Status</label>
                                            <div>
                                                <span class="badge" :class="{
                                                    'bg-success': selectedRegistration.status === 'confirmed',
                                                    'bg-warning text-dark': selectedRegistration.status === 'pending',
                                                    'bg-danger': selectedRegistration.status === 'cancelled'
                                                }">
                                                    <i :class="{
                                                        'bi bi-check-circle': selectedRegistration.status === 'confirmed',
                                                        'bi bi-hourglass': selectedRegistration.status === 'pending',
                                                        'bi bi-x-circle': selectedRegistration.status === 'cancelled'
                                                    }" class="me-1"></i>
                                                    {{ selectedRegistration.status.charAt(0).toUpperCase() + selectedRegistration.status.slice(1) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="info-item">
                                            <label class="text-muted small">{{ selectedRegistration.type === 'program' ? 'Program' : 'Event' }} Title</label>
                                            <div class="fw-bold">{{ selectedRegistration.related_item ? selectedRegistration.related_item.title : 'Unknown' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-item">
                                            <label class="text-muted small">Registration Date</label>
                                            <div><i class="bi bi-calendar me-1"></i>{{ formatDate(selectedRegistration.created_at) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Emergency Contact Card -->
                        <div class="card mb-3" v-if="selectedRegistration.emergency_contact_name">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 text-primary">
                                    <i class="bi bi-person-exclamation me-2"></i>Emergency Contact
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="text-muted small">Contact Name</label>
                                            <div class="fw-bold">{{ selectedRegistration.emergency_contact_name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="text-muted small">Contact Phone</label>
                                            <div><i class="bi bi-phone me-1"></i>{{ selectedRegistration.emergency_contact_phone }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Message Card -->
                        <div class="card mb-3" v-if="selectedRegistration.message">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 text-primary">
                                    <i class="bi bi-chat-text me-2"></i>Additional Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info mb-0">
                                    <i class="bi bi-info-circle me-2"></i>{{ selectedRegistration.message }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <div class="d-flex justify-content-between w-100">
                            <button type="button" class="btn btn-outline-secondary" @click="closeRegistrationModal">
                                <i class="bi bi-x me-1"></i> Close
                            </button>
                            <div class="btn-group">
                                <button type="button" 
                                        class="btn btn-outline-warning" 
                                        :class="{ 'active': selectedRegistration.status === 'pending' }"
                                        @click="updateRegistrationStatus(selectedRegistration.id, 'pending')">
                                    <i class="bi bi-hourglass me-1"></i> Pending
                                </button>
                                <button type="button" 
                                        class="btn btn-outline-success" 
                                        :class="{ 'active': selectedRegistration.status === 'confirmed' }"
                                        @click="updateRegistrationStatus(selectedRegistration.id, 'confirmed')">
                                    <i class="bi bi-check-circle me-1"></i> Confirmed
                                </button>
                                <button type="button" 
                                        class="btn btn-outline-danger" 
                                        :class="{ 'active': selectedRegistration.status === 'cancelled' }"
                                        @click="updateRegistrationStatus(selectedRegistration.id, 'cancelled')">
                                    <i class="bi bi-x-circle me-1"></i> Cancelled
                                </button>
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
    name: 'AdminPanel',
    data() {
        return {
            activeTab: 'dashboard',
            contactMessages: [],
            programs: [],
            events: [],
            galleries: [],
            registrations: [],
            availableEvents: [],
            selectedMessage: null,
            selectedProgram: null,
            selectedEvent: null,
            selectedGallery: null,
            searchTerm: '',
            loading: false,
            loadingRegistrations: false,
            autoRefresh: false,
            currentRegistrationPage: 1,
            registrationsPerPage: 10,
            registrationFilters: {
                type: '',
                status: '',
                search: ''
            },
            selectedRegistration: null,
            showRegistrationModal: false,
            searchTimeout: null,
            showProgramForm: false,
            showEventForm: false,
            showGalleryForm: false,
            programForm: {
                id: null,
                title: '',
                description: '',
                content: '',
                is_active: true
            },
            eventForm: {
                id: null,
                title: '',
                description: '',
                content: '',
                event_date: '',
                event_time: '',
                location: '',
                is_active: true
            },
            galleryForm: {
                id: null,
                title: '',
                description: '',
                type: '',
                url: '',
                file: null,
                event_id: '',
                is_active: true,
                sort_order: 0
            }
        }
    },
    computed: {
        filteredMessages() {
            if (!this.searchTerm) return this.contactMessages;
            
            const search = this.searchTerm.toLowerCase();
            return this.contactMessages.filter(message => 
                message.name.toLowerCase().includes(search) ||
                message.email.toLowerCase().includes(search) ||
                (message.subject && message.subject.toLowerCase().includes(search)) ||
                message.message.toLowerCase().includes(search)
            );
        },
        confirmedRegistrationsCount() {
            if (!this.registrations.data) return 0;
            return this.registrations.data.filter(r => r.status === 'confirmed').length;
        },
        pendingRegistrationsCount() {
            if (!this.registrations.data) return 0;
            return this.registrations.data.filter(r => r.status === 'pending').length;
        },
        todaysRegistrations() {
            if (!this.registrations.data) return 0;
            const today = new Date().toDateString();
            return this.registrations.data.filter(registration => 
                new Date(registration.created_at).toDateString() === today
            ).length;
        }
    },
    mounted() {
        this.loadContactMessages();
        this.loadPrograms();
        this.loadEvents();
        this.loadGalleries();
        this.loadAvailableEvents();
        this.fetchRegistrations();
        // Check for new messages every 30 seconds
        setInterval(() => {
            this.loadContactMessages(true);
        }, 30000);
    },
    methods: {
        setActiveTab(tab) {
            this.activeTab = tab;
        },
        getPageTitle() {
            const titles = {
                dashboard: 'Dashboard',
                messages: 'Contact Messages',
                programs: 'Programs Management',
                events: 'Events Management',
                gallery: 'Gallery Management',
                registrations: 'Registration Management',
                users: 'User Management',
                content: 'Content Management',
                settings: 'System Settings'
            };
            return titles[this.activeTab] || 'Admin Panel';
        },
        async loadContactMessages(silent = false) {
            try {
                if (!silent) this.loading = true;
                const response = await axios.get('/api/contact-messages');
                const newMessages = response.data;
                
                // Check for new messages and show notification
                if (silent && newMessages.length > this.contactMessages.length) {
                    const newCount = newMessages.length - this.contactMessages.length;
                    this.showNotification(`${newCount} new message${newCount > 1 ? 's' : ''} received!`, 'success');
                }
                
                this.contactMessages = newMessages;
            } catch (error) {
                console.error('Error loading contact messages:', error);
                this.contactMessages = [];
            } finally {
                if (!silent) this.loading = false;
            }
        },
        async loadPrograms() {
            try {
                const response = await axios.get('/api/programs');
                this.programs = response.data;
            } catch (error) {
                console.error('Error loading programs:', error);
                this.programs = [];
            }
        },
        async loadEvents() {
            try {
                const response = await axios.get('/api/events');
                this.events = response.data;
            } catch (error) {
                console.error('Error loading events:', error);
                this.events = [];
            }
        },
        async logout() {
            if (!confirm('Are you sure you want to logout?')) {
                return;
            }
            
            try {
                await axios.post('/logout');
                window.location.href = '/';
            } catch (error) {
                console.error('Logout error:', error);
                // Force redirect even if API fails
                window.location.href = '/';
            }
        },
        showNotification(message, type = 'info') {
            // Create a simple notification
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'success' ? 'success' : 'info'} notification-toast`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                animation: slideIn 0.3s ease;
            `;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
            `;
            
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        },
        // Program Methods
        showProgramModal(program = null) {
            if (program) {
                this.programForm = {
                    id: program.id,
                    title: program.title,
                    description: program.description,
                    content: program.content || '',
                    is_active: program.is_active
                };
            } else {
                this.programForm = {
                    id: null,
                    title: '',
                    description: '',
                    content: '',
                    is_active: true
                };
            }
            this.showProgramForm = true;
            const modal = new Modal(document.getElementById('programModal'));
            modal.show();
        },
        async saveProgram() {
            try {
                if (this.programForm.id) {
                    // Update existing program
                    await axios.put(`/api/programs/${this.programForm.id}`, this.programForm);
                    this.showNotification('Program updated successfully!', 'success');
                } else {
                    // Create new program
                    await axios.post('/api/programs', this.programForm);
                    this.showNotification('Program created successfully!', 'success');
                }
                
                await this.loadPrograms();
                Modal.getInstance(document.getElementById('programModal')).hide();
            } catch (error) {
                console.error('Error saving program:', error);
                this.showNotification('Error saving program. Please try again.', 'error');
            }
        },
        editProgram(program) {
            this.showProgramModal(program);
        },
        async deleteProgram(programId) {
            if (!confirm('Are you sure you want to delete this program?')) {
                return;
            }
            
            try {
                await axios.delete(`/api/programs/${programId}`);
                this.programs = this.programs.filter(p => p.id !== programId);
                this.showNotification('Program deleted successfully!', 'success');
            } catch (error) {
                console.error('Error deleting program:', error);
                this.showNotification('Error deleting program. Please try again.', 'error');
            }
        },
        // Event Methods
        showEventModal(event = null) {
            if (event) {
                this.eventForm = {
                    id: event.id,
                    title: event.title,
                    description: event.description,
                    content: event.content || '',
                    event_date: event.event_date,
                    event_time: event.event_time,
                    location: event.location,
                    is_active: event.is_active
                };
            } else {
                this.eventForm = {
                    id: null,
                    title: '',
                    description: '',
                    content: '',
                    event_date: '',
                    event_time: '',
                    location: '',
                    is_active: true
                };
            }
            this.showEventForm = true;
            const modal = new Modal(document.getElementById('eventModal'));
            modal.show();
        },
        async saveEvent() {
            try {
                if (this.eventForm.id) {
                    // Update existing event
                    await axios.put(`/api/events/${this.eventForm.id}`, this.eventForm);
                    this.showNotification('Event updated successfully!', 'success');
                } else {
                    // Create new event
                    await axios.post('/api/events', this.eventForm);
                    this.showNotification('Event created successfully!', 'success');
                }
                
                await this.loadEvents();
                Modal.getInstance(document.getElementById('eventModal')).hide();
            } catch (error) {
                console.error('Error saving event:', error);
                this.showNotification('Error saving event. Please try again.', 'error');
            }
        },
        editEvent(event) {
            this.showEventModal(event);
        },
        async deleteEvent(eventId) {
            if (!confirm('Are you sure you want to delete this event?')) {
                return;
            }
            
            try {
                await axios.delete(`/api/events/${eventId}`);
                this.events = this.events.filter(e => e.id !== eventId);
                this.showNotification('Event deleted successfully!', 'success');
            } catch (error) {
                console.error('Error deleting event:', error);
                this.showNotification('Error deleting event. Please try again.', 'error');
            }
        },
        truncateText(text, length) {
            if (!text) return '';
            return text.length > length ? text.substring(0, length) + '...' : text;
        },
        formatEventDate(dateString) {
            if (!dateString) return '';
            return new Date(dateString).toLocaleDateString('en-US', {
                weekday: 'short',
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        },
        viewMessage(message) {
            this.selectedMessage = message;
            const modal = new bootstrap.Modal(document.getElementById('messageModal'));
            modal.show();
        },
        async deleteMessage(messageId) {
            if (!confirm('Are you sure you want to delete this message?')) {
                return;
            }

            try {
                await axios.delete(`/api/contact-messages/${messageId}`);
                this.contactMessages = this.contactMessages.filter(msg => msg.id !== messageId);
                
                if (this.selectedMessage && this.selectedMessage.id === messageId) {
                    this.selectedMessage = null;
                }
            } catch (error) {
                console.error('Error deleting message:', error);
                alert('Failed to delete message. Please try again.');
            }
        },
        async deleteAllMessages() {
            if (!confirm('Are you sure you want to delete ALL messages? This action cannot be undone.')) {
                return;
            }

            try {
                await axios.delete('/api/contact-messages');
                this.contactMessages = [];
                this.selectedMessage = null;
            } catch (error) {
                console.error('Error deleting all messages:', error);
                alert('Failed to delete messages. Please try again.');
            }
        },
        formatDate(dateString) {
            if (!dateString) return '';
            
            const date = new Date(dateString);
            const now = new Date();
            const diff = now - date;
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            
            if (days === 0) {
                return 'Today';
            } else if (days === 1) {
                return 'Yesterday';
            } else if (days < 7) {
                return `${days} days ago`;
            } else {
                return date.toLocaleDateString();
            }
        },
        // Gallery Methods
        async loadGalleries() {
            try {
                const response = await axios.get('/api/admin/galleries');
                this.galleries = response.data;
            } catch (error) {
                console.error('Error loading galleries:', error);
            }
        },
        async loadAvailableEvents() {
            try {
                const response = await axios.get('/api/admin/gallery-events');
                this.availableEvents = response.data;
            } catch (error) {
                console.error('Error loading events:', error);
                this.availableEvents = [];
            }
        },
        showGalleryModal(gallery = null) {
            if (gallery) {
                this.galleryForm = {
                    id: gallery.id,
                    title: gallery.title,
                    description: gallery.description || '',
                    type: gallery.type,
                    url: gallery.url || '',
                    file: null,
                    event_id: gallery.event_id || '',
                    is_active: gallery.is_active,
                    sort_order: gallery.sort_order || 0
                };
            } else {
                this.galleryForm = {
                    id: null,
                    title: '',
                    description: '',
                    type: '',
                    url: '',
                    file: null,
                    event_id: '',
                    is_active: true,
                    sort_order: 0
                };
            }

            const modal = new Modal(document.getElementById('galleryModal'));
            modal.show();
        },
        async saveGallery() {
            try {
                const formData = new FormData();
                formData.append('title', this.galleryForm.title);
                formData.append('description', this.galleryForm.description || '');
                formData.append('type', this.galleryForm.type);
                formData.append('is_active', this.galleryForm.is_active ? '1' : '0');
                formData.append('sort_order', this.galleryForm.sort_order || '0');
                
                if (this.galleryForm.event_id && this.galleryForm.event_id !== '') {
                    formData.append('event_id', this.galleryForm.event_id);
                }
                
                if (this.galleryForm.type === 'video') {
                    formData.append('url', this.galleryForm.url);
                }
                
                if (this.galleryForm.type === 'image' && this.galleryForm.file) {
                    formData.append('file', this.galleryForm.file);
                }

                let response;
                if (this.galleryForm.id) {
                    formData.append('_method', 'PUT');
                    response = await axios.post(`/api/admin/galleries/${this.galleryForm.id}`, formData, {
                        headers: { 'Content-Type': 'multipart/form-data' }
                    });
                } else {
                    response = await axios.post('/api/admin/galleries', formData, {
                        headers: { 'Content-Type': 'multipart/form-data' }
                    });
                }

                Modal.getInstance(document.getElementById('galleryModal')).hide();
                this.showNotification(
                    `Gallery item ${this.galleryForm.id ? 'updated' : 'created'} successfully!`,
                    'success'
                );
                this.loadGalleries();
            } catch (error) {
                console.error('Gallery save error:', error);
                this.showNotification('Error saving gallery item. Please try again.', 'error');
            }
        },
        editGallery(gallery) {
            this.showGalleryModal(gallery);
        },
        async deleteGallery(galleryId) {
            if (!confirm('Are you sure you want to delete this gallery item?')) {
                return;
            }

            try {
                await axios.delete(`/api/admin/galleries/${galleryId}`);
                this.galleries = this.galleries.filter(item => item.id !== galleryId);
                this.showNotification('Gallery item deleted successfully!', 'success');
            } catch (error) {
                console.error('Error deleting gallery item:', error);
                this.showNotification('Error deleting gallery item. Please try again.', 'error');
            }
        },
        onTypeChange() {
            // Reset form fields when type changes
            this.galleryForm.url = '';
            this.galleryForm.file = null;
            if (this.$refs.fileInput) {
                this.$refs.fileInput.value = '';
            }
        },
        onFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.galleryForm.file = file;
            }
        },
        handleImageError(event) {
            event.target.src = '/storage/placeholder.jpg';
        },
        // Registration Methods
        async fetchRegistrations(page = 1) {
            try {
                this.loadingRegistrations = true;
                const params = new URLSearchParams();
                
                if (this.registrationFilters.type) {
                    params.append('type', this.registrationFilters.type);
                }
                if (this.registrationFilters.status) {
                    params.append('status', this.registrationFilters.status);
                }
                if (this.registrationFilters.search) {
                    params.append('search', this.registrationFilters.search);
                }
                params.append('page', page);
                
                const response = await axios.get(`/api/registrations?${params.toString()}`);
                this.registrations = response.data;
            } catch (error) {
                console.error('Error fetching registrations:', error);
                this.showNotification('Error loading registrations. Please try again.', 'error');
            } finally {
                this.loadingRegistrations = false;
            }
        },
        setRegistrationPage(page) {
            if (page >= 1 && page <= this.registrations.last_page) {
                this.fetchRegistrations(page);
            }
        },
        clearRegistrationFilters() {
            this.registrationFilters = {
                type: '',
                status: '',
                search: ''
            };
            this.fetchRegistrations();
        },
        debounceSearch: function() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.fetchRegistrations();
            }, 500);
        },
        async updateRegistrationStatus(registrationId, status) {
            try {
                await axios.put(`/api/registrations/${registrationId}`, { status });
                this.fetchRegistrations(this.registrations.current_page);
                this.showNotification(`Registration status updated to ${status}!`, 'success');
                
                // Update the selected registration if modal is open
                if (this.selectedRegistration && this.selectedRegistration.id === registrationId) {
                    this.selectedRegistration.status = status;
                }
            } catch (error) {
                console.error('Error updating registration status:', error);
                this.showNotification('Error updating registration status. Please try again.', 'error');
            }
        },
        async viewRegistration(registration) {
            this.selectedRegistration = registration;
            this.showRegistrationModal = true;
            // Show the modal
            const modal = document.getElementById('registrationDetailModal');
            if (modal) {
                const bsModal = new Modal(modal);
                bsModal.show();
            }
        },
        closeRegistrationModal() {
            this.selectedRegistration = null;
            this.showRegistrationModal = false;
            const modal = document.getElementById('registrationDetailModal');
            if (modal) {
                const bsModal = Modal.getInstance(modal);
                if (bsModal) {
                    bsModal.hide();
                }
            }
        },
        async deleteRegistration(registrationId) {
            if (!confirm('Are you sure you want to delete this registration?')) {
                return;
            }
            
            try {
                await axios.delete(`/api/registrations/${registrationId}`);
                this.fetchRegistrations(this.registrations.current_page);
                this.showNotification('Registration deleted successfully!', 'success');
            } catch (error) {
                console.error('Error deleting registration:', error);
                this.showNotification('Error deleting registration. Please try again.', 'error');
            }
        },
        formatDate(dateString) {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        },
        toggleDropdown(event) {
            event.stopPropagation();
            const button = event.target.closest('button');
            const dropdown = button.nextElementSibling;
            
            // Close all other dropdowns
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                if (menu !== dropdown) {
                    menu.classList.remove('show');
                }
            });
            
            // Toggle current dropdown
            dropdown.classList.toggle('show');
            
            // Close dropdown when clicking outside
            const closeDropdown = (e) => {
                if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.remove('show');
                    document.removeEventListener('click', closeDropdown);
                }
            };
            
            if (dropdown.classList.contains('show')) {
                setTimeout(() => document.addEventListener('click', closeDropdown), 0);
            }
        }
    }
}
</script>

<style scoped>
/* Admin Container */
.admin-container {
    display: flex;
    min-height: 100vh;
    background-color: #f8f9fa;
}

/* Sidebar Styles */
.admin-sidebar {
    width: 260px;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    position: fixed;
    height: 100vh;
    left: 0;
    top: 0;
    z-index: 1000;
}

.sidebar-header {
    padding: 1.5rem;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.sidebar-header .brand {
    display: flex;
    align-items: center;
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
}

.sidebar-header .brand i {
    margin-right: 0.75rem;
    font-size: 1.4rem;
}

.sidebar-nav {
    padding: 1rem 0;
}

.sidebar-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-nav li {
    margin: 0.25rem 0;
}

.sidebar-nav a {
    display: flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
}

.sidebar-nav a:hover {
    background-color: rgba(255,255,255,0.1);
    color: white;
}

.sidebar-nav a.active {
    background-color: rgba(255,255,255,0.15);
    color: white;
}

.sidebar-nav a.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background-color: white;
}

.sidebar-nav i {
    margin-right: 0.75rem;
    width: 18px;
    text-align: center;
}

.sidebar-nav .badge {
    background-color: #e74c3c;
    color: white;
    border-radius: 12px;
    padding: 0.2rem 0.6rem;
    font-size: 0.75rem;
    margin-left: auto;
}

/* Main Content */
.admin-main {
    flex: 1;
    margin-left: 260px;
    display: flex;
    flex-direction: column;
}

.admin-header {
    background: white;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.page-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
}

.header-right {
    display: flex;
    align-items: center;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.greeting {
    color: #6c757d;
    font-size: 0.9rem;
}

/* Content Wrapper */
.content-wrapper {
    flex: 1;
    padding: 1.5rem;
    overflow-y: auto;
}

/* Stats Overview */
.stats-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stats-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    transition: transform 0.2s ease;
}

.stats-card:hover {
    transform: translateY(-2px);
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
}

.stats-icon.primary {
    background: linear-gradient(135deg, #11998e, #38ef7d);
    color: white;
}

.stats-icon.success {
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    color: white;
}

.stats-icon.warning {
    background: linear-gradient(135deg, #fa709a, #fee140);
    color: white;
}

.stats-icon.info {
    background: linear-gradient(135deg, #a8edea, #fed6e3);
    color: #2c3e50;
}

.stats-content h3 {
    margin: 0 0 0.25rem 0;
    font-size: 1.75rem;
    font-weight: 700;
    color: #2c3e50;
}

.stats-content p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1.5rem;
}

/* Cards */
.card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    overflow: hidden;
}

.card-header {
    background: #f8f9fa;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.card-header h5 {
    margin: 0;
    font-weight: 600;
    color: #2c3e50;
}

.card-header i {
    margin-right: 0.5rem;
}

.card-body {
    padding: 1.5rem;
}

/* Activity List */
.activity-list {
    max-height: 300px;
    overflow-y: auto;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f1f3f4;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-avatar {
    width: 40px;
    height: 40px;
    background: #11998e;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 1rem;
}

.activity-details p {
    margin: 0 0 0.25rem 0;
    font-size: 0.9rem;
}

.time {
    font-size: 0.8rem;
    color: #6c757d;
}

/* Quick Actions */
.quick-actions {
    display: grid;
    gap: 0.75rem;
}

.action-btn {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    text-align: left;
    transition: all 0.2s ease;
    color: #495057;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
}

.action-btn:hover {
    border-color: #11998e;
    background: #f0fdf4;
    color: #11998e;
}

.action-btn i {
    margin-right: 0.75rem;
    width: 16px;
}

/* Messages Page */
.page-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    gap: 1rem;
}

.search-bar {
    position: relative;
    flex: 1;
    max-width: 400px;
}

.search-bar i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
}

.search-bar input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 0.9rem;
    transition: border-color 0.2s ease;
}

.search-bar input:focus {
    outline: none;
    border-color: #11998e;
}

.header-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.count-badge {
    background: #11998e;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
}

/* Messages Table */
.messages-table {
    overflow-x: auto;
}

.table {
    margin: 0;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #e9ecef;
}

.message-row:hover {
    background-color: #f0fdf4;
}

.sender-info {
    min-width: 180px;
}

.sender-name {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.25rem;
}

.sender-email {
    font-size: 0.85rem;
    color: #6c757d;
}

.subject {
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.date {
    white-space: nowrap;
    font-size: 0.9rem;
    color: #6c757d;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

/* Empty States */
.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: #6c757d;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #dee2e6;
}

.empty-state h3 {
    color: #495057;
    margin-bottom: 0.5rem;
}

.coming-soon {
    text-align: center;
    padding: 4rem 2rem;
    color: #6c757d;
}

.coming-soon i {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    color: #dee2e6;
}

.coming-soon h3 {
    color: #495057;
    margin-bottom: 0.5rem;
}

/* Modal Styles */
.message-details {
    font-size: 0.95rem;
}

.detail-row {
    margin-bottom: 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.detail-row label {
    font-weight: 600;
    color: #2c3e50;
}

.message-body {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    border-left: 4px solid #11998e;
    white-space: pre-wrap;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .admin-sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .admin-main {
        margin-left: 0;
    }
    
    .stats-overview {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    
    .page-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-bar {
        max-width: none;
    }
}

@media (max-width: 480px) {
    .content-wrapper {
        padding: 1rem;
    }
    
    .stats-card {
        padding: 1rem;
    }
    
    .card-header,
    .card-body {
        padding: 1rem;
    }
}

/* Program and Event specific styles */
.program-title, .event-title {
    font-weight: 600;
    color: #2c3e50;
}

.program-desc {
    font-size: 0.9rem;
    color: #6c757d;
    max-width: 300px;
}

.event-location {
    font-size: 0.9rem;
    color: #6c757d;
}

/* Form styles */
.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    transition: border-color 0.2s ease;
}

.form-control:focus {
    border-color: #11998e;
    box-shadow: 0 0 0 0.2rem rgba(17, 153, 142, 0.25);
}

.form-check-input {
    border: 2px solid #e9ecef;
    border-radius: 4px;
}

.form-check-input:checked {
    background-color: #11998e;
    border-color: #11998e;
}

/* Notification toast */
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.notification-toast {
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border: none;
    border-radius: 8px;
}

/* Badge styles */
.badge {
    font-size: 0.75rem;
    padding: 0.35rem 0.65rem;
    border-radius: 6px;
    font-weight: 500;
}

.bg-success {
    background-color: #11998e !important;
}

.bg-secondary {
    background-color: #6c757d !important;
}

/* Gallery Styles */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    padding: 1rem 0;
}

.gallery-item {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: transform 0.2s ease;
}

.gallery-item:hover {
    transform: translateY(-2px);
}

.gallery-thumbnail {
    height: 200px;
    overflow: hidden;
    position: relative;
}

.gallery-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.video-thumbnail {
    position: relative;
    height: 100%;
}

.play-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: rgba(255, 255, 255, 0.9);
    font-size: 3rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.gallery-info {
    padding: 1.25rem;
}

.gallery-info h6 {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.75rem;
}

.gallery-desc {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.gallery-meta {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.event-tag {
    background: #e9ecef;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    color: #6c757d;
}

.gallery-actions {
    display: flex;
    gap: 0.5rem;
    justify-content: flex-end;
}

/* Registration Styles */
.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    transition: transform 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    color: white;
    font-size: 1.5rem;
}

.stat-content h3 {
    margin: 0 0 0.25rem 0;
    font-size: 1.75rem;
    font-weight: 700;
    color: #2c3e50;
}

.stat-content p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
}

.contact-info {
    font-size: 0.85rem;
    line-height: 1.4;
}

.contact-info div {
    margin-bottom: 0.25rem;
}

.contact-info i {
    width: 12px;
    margin-right: 0.5rem;
    color: #6c757d;
}

.program-info .badge {
    margin-bottom: 0.5rem;
    display: inline-block;
}

.program-title {
    font-size: 0.9rem;
    color: #2c3e50;
    font-weight: 500;
}

.age-badge {
    background: #e9ecef;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    color: #6c757d;
    font-weight: 500;
}

.emergency-contact {
    font-size: 0.85rem;
    line-height: 1.4;
}

.emergency-contact i {
    width: 12px;
    margin-right: 0.5rem;
    color: #6c757d;
}

.registration-name {
    font-weight: 600;
    color: #2c3e50;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

/* Dropdown Styles */
.dropdown-menu.show {
    display: block !important;
}

.dropdown-menu {
    display: none;
    position: absolute;
    z-index: 1000;
    min-width: 160px;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 0.375rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.175);
}

.dropdown-item {
    display: block;
    width: 100%;
    padding: 0.375rem 1rem;
    clear: both;
    font-weight: 400;
    color: #212529;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
    text-decoration: none;
}

.dropdown-item:hover, .dropdown-item:focus {
    background-color: #f8f9fa;
    color: #1e2125;
}

.action-buttons .btn {
    margin-right: 0.25rem;
}

.action-buttons .dropdown {
    display: inline-block;
}

/* Address display styles */
.address-compact {
    display: flex;
    align-items: center;
    font-size: 0.85rem;
    line-height: 1.4;
}

.address-compact small {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Modal card styles */
.modal-body .card {
    border: 1px solid #e9ecef;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.modal-body .card-header {
    border-bottom: 1px solid #e9ecef;
    padding: 0.75rem 1rem;
}

.modal-body .card-header h6 {
    margin: 0;
    font-size: 0.9rem;
    font-weight: 600;
}

.info-item {
    margin-bottom: 0.5rem;
}

.info-item label {
    display: block;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.25rem;
}

.info-item div {
    font-size: 0.9rem;
    color: #2c3e50;
}

.info-item .fw-bold {
    font-weight: 600 !important;
}

.modal-footer.bg-light {
    background-color: #f8f9fa !important;
    border-top: 1px solid #e9ecef;
}

.modal-footer .btn-group .btn.active {
    background-color: var(--bs-color) !important;
    border-color: var(--bs-color) !important;
    color: white !important;
}

.modal-footer .btn-outline-warning.active {
    background-color: #ffc107 !important;
    border-color: #ffc107 !important;
    color: #000 !important;
}

.modal-footer .btn-outline-success.active {
    background-color: #198754 !important;
    border-color: #198754 !important;
}

.modal-footer .btn-outline-danger.active {
    background-color: #dc3545 !important;
    border-color: #dc3545 !important;
}
</style>