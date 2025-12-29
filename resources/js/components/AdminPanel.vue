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
            selectedMessage: null,
            selectedProgram: null,
            selectedEvent: null,
            searchTerm: '',
            loading: false,
            showProgramForm: false,
            showEventForm: false,
            programForm: {
                id: null,
                title: '',
                description: '',
                is_active: true
            },
            eventForm: {
                id: null,
                title: '',
                description: '',
                event_date: '',
                event_time: '',
                location: '',
                is_active: true
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
        }
    },
    mounted() {
        this.loadContactMessages();
        this.loadPrograms();
        this.loadEvents();
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
                    is_active: program.is_active
                };
            } else {
                this.programForm = {
                    id: null,
                    title: '',
                    description: '',
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
</style>