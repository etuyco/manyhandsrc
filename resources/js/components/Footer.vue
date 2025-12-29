<template>
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Many Hands Resource Centre</h5>
                    <p>Building a diverse and healthy community where everyone belongs.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Contact</h5>
                    <p>
                        <i class="bi bi-geo-alt"></i> 500 Stephen St, Morden, MB R6M 1T7<br>
                        <i class="bi bi-envelope"></i> <a href="mailto:programs@manyhandsrc.com" class="text-light">programs@manyhandsrc.com</a><br>
                        <i class="bi bi-telephone"></i> <a href="tel:204-823-1678" class="text-light">204-823-1678</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h5>Office Hours</h5>
                    <p>
                        <strong>Office:</strong> Monday & Wednesday: 9:00 am - 4:00 pm<br>
                        <strong>Drop-in:</strong> Wednesday: 12:00 pm - 4:00 pm<br>
                        Thursday: 6:00 pm - 9:00 pm
                    </p>
                </div>
            </div>
            <hr class="bg-light my-4">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; {{ new Date().getFullYear() }} Many Hands Resource Centre. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'Footer'
}
</script>

