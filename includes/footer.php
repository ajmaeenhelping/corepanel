<!-- ===== FOOTER ===== -->
<footer class="footer bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row gy-4">

            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-hexagon-fill me-2 text-primary"></i>
                    <?php echo htmlspecialchars($site_name); ?>
                </h5>
                <p class="text-muted small">
                    Building reliable solutions for modern businesses. We help you grow with the right tools and expertise.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-muted fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-muted fs-5"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-muted fs-5"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-muted fs-5"><i class="bi bi-instagram"></i></a>
                </div>
            </div>

            <div class="col-6 col-lg-2 offset-lg-1">
                <h6 class="fw-semibold mb-3 text-white-50 text-uppercase small ls-1">Company</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#about" class="text-muted text-decoration-none">About Us</a></li>
                    <li class="mb-2"><a href="#services" class="text-muted text-decoration-none">Services</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Careers</a></li>
                    <li class="mb-2"><a href="#contact" class="text-muted text-decoration-none">Contact</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-2">
                <h6 class="fw-semibold mb-3 text-white-50 text-uppercase small">Services</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Consulting</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Development</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Support</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Analytics</a></li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h6 class="fw-semibold mb-3 text-white-50 text-uppercase small">Contact</h6>
                <ul class="list-unstyled small text-muted">
                    <li class="mb-2"><i class="bi bi-envelope me-2"></i><?php echo htmlspecialchars($site_email); ?></li>
                    <li class="mb-2"><i class="bi bi-telephone me-2"></i>+60 3-0000 0000</li>
                    <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Kuala Lumpur, Malaysia</li>
                </ul>
            </div>

        </div>

        <hr class="border-secondary mt-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small text-muted">
            <span>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($company_name); ?>. All rights reserved.</span>
            <span class="mt-2 mt-md-0">
                <a href="#" class="text-muted text-decoration-none me-3">Privacy Policy</a>
                <a href="#" class="text-muted text-decoration-none">Terms of Use</a>
            </span>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script src="assets/js/main.js"></script>
</body>
</html>
