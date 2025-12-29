<template>
    <div>
        <Navigation v-if="!isAdminRoute" />
        <main id="main-content" role="main" :class="{ 'admin-layout': isAdminRoute }">
            <router-view />
        </main>
        <Footer v-if="!isAdminRoute" />
    </div>
</template>

<script>
import Navigation from './Navigation.vue';
import Footer from './Footer.vue';

export default {
    name: 'App',
    components: {
        Navigation,
        Footer
    },
    computed: {
        isAdminRoute() {
            return this.$route.path.startsWith('/admin') || this.$route.path.startsWith('/login');
        }
    }
}
</script>

<style scoped>
.admin-layout {
    padding: 0 !important;
    margin: 0 !important;
}
</style>

