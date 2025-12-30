<template>
    <nav class="navbar navbar-expand-lg navbar-modern fixed-top" role="navigation" aria-label="Main navigation">
        <div class="container">
            <router-link class="navbar-brand" to="/">
                <div class="brand-wrapper">
                    <div class="brand-logo">
                        <img src="/manyhandslogo_.png" alt="Many Hands Logo" class="logo-image">
                    </div>
                </div>
            </router-link>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-line"></span>
                <span class="toggler-line"></span>
                <span class="toggler-line"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/" exact @click.native="handleNavClick">
                            <span>Home</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/programs-events">
                            <span>Events</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/gallery">
                            <span>Gallery</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/volunteer">
                            <span>Volunteer</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/donate">
                            <span>Donate</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/contact">
                            <span>Contact</span>
                        </router-link>
                    </li>
                    <li class="nav-item dropdown" @click="toggleDropdown" ref="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" aria-expanded="false" @click.prevent="toggleDropdown">
                            <span>About Us</span>
                        </a>
                        <ul class="dropdown-menu" :class="{ 'show': dropdownOpen }" aria-labelledby="aboutDropdown">
                            <li><router-link class="dropdown-item" to="/about" @click.native="closeDropdown">About Us</router-link></li>
                            <li><router-link class="dropdown-item" to="/about/team" @click.native="closeDropdown">Meet Our Team</router-link></li>
                            <li><router-link class="dropdown-item" to="/about/accessibility" @click.native="closeDropdown">Accessibility</router-link></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Navigation',
    data() {
        return {
            dropdownOpen: false
        }
    },
    mounted() {
        // Close dropdown when clicking outside
        document.addEventListener('click', this.handleClickOutside);
    },
    beforeDestroy() {
        document.removeEventListener('click', this.handleClickOutside);
    },
    methods: {
        handleNavClick() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        toggleDropdown(event) {
            event.stopPropagation();
            this.dropdownOpen = !this.dropdownOpen;
        },
        closeDropdown() {
            this.dropdownOpen = false;
        },
        handleClickOutside(event) {
            if (this.$refs.dropdown && !this.$refs.dropdown.contains(event.target)) {
                this.dropdownOpen = false;
            }
        }
    }
}
</script>

<style scoped>
.navbar-modern {
    background: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 1rem 0;
    transition: all 0.3s ease;
}

.navbar-modern.scrolled {
    background: white;
    padding: 0.75rem 0;
}

.brand-wrapper {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
}

.brand-logo {
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    position: relative;
    z-index: 10;
    margin: -20px 0;
}

.logo-image {
    width: 30%;
    object-fit: contain;
    transition: all 0.2s ease;
    background: white;
    padding: 10px;
}

.navbar-brand {
    text-decoration: none;
}

.navbar-brand:focus {
    outline: none;
    box-shadow: none;
}


.brand-text {
    font-size: 1.5rem;
    font-weight: 700;
    color: #42b883;
    letter-spacing: 0.5px;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem !important;
    border-radius: 6px;
    font-weight: 500;
    color: #333 !important;
    transition: all 0.2s ease;
    text-decoration: none;
}

.nav-link:hover {
    color: #42b883 !important;
    text-decoration: underline;
    text-underline-offset: 4px;
    text-decoration-thickness: 2px;
    transform: translateY(-2px);
}

.nav-link.router-link-active {
    background: linear-gradient(135deg, #42b883 0%, #347474 100%);
    color: white !important;
}

.nav-link.router-link-active::before {
    left: 0;
}

.nav-icon {
    font-size: 1rem;
    opacity: 0.8;
}

.login-link {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
    color: white !important;
    margin-left: 0.5rem;
}

.login-link:hover {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%) !important;
    transform: translateY(-2px) scale(1.05);
}

.dropdown-toggle {
    position: relative;
}

.dropdown-toggle::after {
    margin-left: 0.5rem;
}

.nav-item.dropdown {
    position: relative;
}

.dropdown-menu {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 0.5rem 0;
    margin-top: 0.5rem;
    min-width: 200px;
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
}

.dropdown-menu.show {
    display: block;
}

.dropdown-item {
    padding: 0.75rem 1.25rem;
    color: #333 !important;
    text-decoration: none;
    display: block;
    transition: all 0.2s ease;
    border: none;
    background: none;
    font-weight: 500;
}

.dropdown-item:hover {
    color: #42b883 !important;
    text-decoration: underline;
    text-underline-offset: 4px;
    text-decoration-thickness: 2px;
}

.dropdown-item.router-link-active {
    background: linear-gradient(135deg, #42b883 0%, #347474 100%);
    color: white !important;
}

.custom-toggler {
    border: none;
    padding: 0.5rem;
    background: transparent;
    position: relative;
    width: 30px;
    height: 30px;
}

.toggler-line {
    display: block;
    width: 25px;
    height: 3px;
    background: #333;
    margin: 5px 0;
    border-radius: 2px;
    transition: all 0.3s ease;
}

.custom-toggler:focus {
    box-shadow: none;
}

.custom-toggler[aria-expanded="true"] .toggler-line:nth-child(1) {
    transform: rotate(45deg) translate(8px, 8px);
}

.custom-toggler[aria-expanded="true"] .toggler-line:nth-child(2) {
    opacity: 0;
}

.custom-toggler[aria-expanded="true"] .toggler-line:nth-child(3) {
    transform: rotate(-45deg) translate(8px, -8px);
}

@media (max-width: 991.98px) {
    .navbar-collapse {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border-radius: 15px;
        padding: 1rem;
        margin-top: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .navbar-nav {
        gap: 0;
    }
    
    .nav-link {
        margin: 0.25rem 0;
        justify-content: center;
    }
    
    .login-link {
        margin: 0.5rem 0 0 0;
    }
}

@media (max-width: 768px) {
    .brand-logo {
        width: 70px;
        height: 70px;
        margin: -10px 0;
    }
    
    .logo-image {
        padding: 8px;
    }
}
</style>

