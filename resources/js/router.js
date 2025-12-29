import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/Home.vue';
import ProgramsEventsPage from './components/ProgramsEventsPage.vue';
import ProgramDetail from './components/ProgramDetail.vue';
import EventDetail from './components/EventDetail.vue';
import DonatePage from './components/DonatePage.vue';
import VolunteerPage from './components/VolunteerPage.vue';
import ContactPage from './components/ContactPage.vue';
import AboutPage from './components/AboutPage.vue';
import TeamPage from './components/TeamPage.vue';
import AccessibilityPage from './components/AccessibilityPage.vue';
import AdminPanel from './components/AdminPanel.vue';
import Login from './components/Login.vue';
import axios from 'axios';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/programs-events',
        name: 'ProgramsEvents',
        component: ProgramsEventsPage
    },
    {
        path: '/programs/:id',
        name: 'ProgramDetail',
        component: ProgramDetail
    },
    {
        path: '/events/:id',
        name: 'EventDetail',
        component: EventDetail
    },
    {
        path: '/donate',
        name: 'Donate',
        component: DonatePage
    },
    {
        path: '/volunteer',
        name: 'Volunteer',
        component: VolunteerPage
    },
    {
        path: '/contact',
        name: 'Contact',
        component: ContactPage
    },
    {
        path: '/about',
        name: 'About',
        component: AboutPage
    },
    {
        path: '/about/team',
        name: 'Team',
        component: TeamPage
    },
    {
        path: '/about/accessibility',
        name: 'Accessibility',
        component: AccessibilityPage
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/admin',
        name: 'Admin',
        component: AdminPanel,
        meta: { requiresAuth: true }
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

// Navigation guard to check authentication
router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        // Check if user is authenticated
        axios.get('/check-auth')
            .then(response => {
                if (response.data.authenticated) {
                    next();
                } else {
                    next('/login');
                }
            })
            .catch(() => {
                next('/login');
            });
    } else {
        next();
    }
});

export default router;
