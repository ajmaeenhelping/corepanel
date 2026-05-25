<?php
require_once __DIR__ . '/config/common.php';

// Pull global site settings from setup table
$gen = mfa(mq("SELECT * FROM setup WHERE id = 1"));

$page_title = $site_name;
$page_desc  = "Welcome to " . $site_name . " — building reliable solutions for modern businesses.";

include 'includes/header.php';
?>

<!-- ===== HERO ===== -->
<section class="hero d-flex align-items-center" id="home">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 mb-3 rounded-pill">
                    Welcome to <?php echo htmlspecialchars($company_name); ?>
                </span>
                <h1 class="display-4 fw-bold lh-sm mb-4">
                    Building Solutions <br>
                    <span class="text-gradient">That Drive Growth</span>
                </h1>
                <p class="lead text-muted mb-5">
                    We deliver enterprise-grade tools, consulting, and support to help your business scale confidently.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#services" class="btn btn-primary btn-lg px-5">Our Services</a>
                    <a href="#contact" class="btn btn-outline-secondary btn-lg px-5">Get in Touch</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-graphic">
                    <div class="hero-blob">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== SERVICES ===== -->
<section class="section bg-light" id="services">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-label">What We Do</span>
            <h2 class="section-title">Our Core Services</h2>
            <p class="section-sub">End-to-end solutions tailored to your business needs.</p>
        </div>
        <div class="row g-4">

            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon bg-primary-subtle text-primary mb-3">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Technology Consulting</h5>
                        <p class="text-muted small mb-0">
                            Strategic guidance to modernise your tech stack, reduce overhead, and accelerate delivery.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <a href="#" class="btn-link-arrow">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon bg-success-subtle text-success mb-3">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Custom Development</h5>
                        <p class="text-muted small mb-0">
                            Bespoke web and enterprise applications built to your specifications, on time and on budget.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <a href="#" class="btn-link-arrow">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon bg-warning-subtle text-warning mb-3">
                            <i class="bi bi-bar-chart-line"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Analytics & Insights</h5>
                        <p class="text-muted small mb-0">
                            Data-driven dashboards and reporting tools that turn raw data into actionable business intelligence.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <a href="#" class="btn-link-arrow">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon bg-info-subtle text-info mb-3">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Security & Compliance</h5>
                        <p class="text-muted small mb-0">
                            Protect your business with robust security audits, hardening, and regulatory compliance support.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <a href="#" class="btn-link-arrow">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon bg-danger-subtle text-danger mb-3">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Cloud & Infrastructure</h5>
                        <p class="text-muted small mb-0">
                            Scalable cloud deployments and infrastructure management so you can focus on your product.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <a href="#" class="btn-link-arrow">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="service-icon bg-secondary-subtle text-secondary mb-3">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Ongoing Support</h5>
                        <p class="text-muted small mb-0">
                            Dedicated support plans with SLA guarantees — we're here when you need us most.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <a href="#" class="btn-link-arrow">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== ABOUT ===== -->
<section class="section" id="about">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-5">
                <div class="about-visual">
                    <div class="about-box-main bg-primary text-white p-5 rounded-4">
                        <i class="bi bi-buildings display-3"></i>
                        <h4 class="fw-bold mt-3 mb-0"><?php echo htmlspecialchars($company_name); ?></h4>
                        <p class="mb-0 opacity-75 small"><?php echo htmlspecialchars($company_url); ?></p>
                    </div>
                    <div class="about-badge bg-white shadow rounded-3 p-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-success d-flex align-items-center justify-content-center" style="width:36px;height:36px">
                                <i class="bi bi-check-lg text-white"></i>
                            </div>
                            <div>
                                <div class="fw-bold small">ISO Certified</div>
                                <div class="text-muted" style="font-size:11px">Quality Assured</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <span class="section-label">About Us</span>
                <h2 class="section-title">We Build With Purpose</h2>
                <p class="text-muted mb-4">
                    <?php echo htmlspecialchars($company_name); ?> is a technology company focused on delivering high-quality digital solutions to businesses of all sizes. Since our founding, we have helped hundreds of clients modernise their operations and grow sustainably.
                </p>
                <p class="text-muted mb-4">
                    Our team of engineers, designers, and consultants works closely with every client to understand their unique challenges and deliver results that matter.
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="d-flex align-items-start gap-2">
                            <i class="bi bi-check-circle-fill text-primary mt-1"></i>
                            <span class="small">Client-first approach</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-start gap-2">
                            <i class="bi bi-check-circle-fill text-primary mt-1"></i>
                            <span class="small">Transparent pricing</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-start gap-2">
                            <i class="bi bi-check-circle-fill text-primary mt-1"></i>
                            <span class="small">Agile delivery</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-start gap-2">
                            <i class="bi bi-check-circle-fill text-primary mt-1"></i>
                            <span class="small">Long-term partnership</span>
                        </div>
                    </div>
                </div>
                <a href="#contact" class="btn btn-primary px-5">Work With Us</a>
            </div>
        </div>
    </div>
</section>

<!-- ===== STATS ===== -->
<section class="section stats-section" id="stats">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number" data-target="250">0</div>
                    <div class="stat-label">Clients Served</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number" data-target="12">0</div>
                    <div class="stat-label">Years Experience</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number" data-target="98">0</div>
                    <div class="stat-label">% Satisfaction Rate</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number" data-target="40">0</div>
                    <div class="stat-label">Team Members</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CONTACT ===== -->
<section class="section bg-light" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <span class="section-label">Get In Touch</span>
                <h2 class="section-title">Let's Start a Conversation</h2>
                <p class="section-sub">Have a project in mind or need a consultation? Fill in the form and we'll get back to you within 24 hours.</p>
            </div>
        </div>
        <div class="row g-5 align-items-start">

            <div class="col-lg-4">
                <div class="d-flex flex-column gap-4">
                    <div class="contact-info-item d-flex align-items-start gap-3">
                        <div class="contact-icon bg-primary-subtle text-primary rounded-3 p-3">
                            <i class="bi bi-envelope-fill fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-semibold mb-1">Email</div>
                            <div class="text-muted small"><?php echo htmlspecialchars($site_email); ?></div>
                        </div>
                    </div>
                    <div class="contact-info-item d-flex align-items-start gap-3">
                        <div class="contact-icon bg-success-subtle text-success rounded-3 p-3">
                            <i class="bi bi-telephone-fill fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-semibold mb-1">Phone</div>
                            <div class="text-muted small">+60 3-0000 0000</div>
                        </div>
                    </div>
                    <div class="contact-info-item d-flex align-items-start gap-3">
                        <div class="contact-icon bg-warning-subtle text-warning rounded-3 p-3">
                            <i class="bi bi-geo-alt-fill fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-semibold mb-1">Address</div>
                            <div class="text-muted small">Kuala Lumpur, Malaysia</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <form class="contact-form bg-white p-4 p-lg-5 rounded-4 shadow-sm" id="contactForm" method="POST" action="contact.php">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="How can we help?">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Message</label>
                            <textarea name="message" class="form-control" rows="5" placeholder="Tell us about your project..." required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-send me-2"></i>Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
