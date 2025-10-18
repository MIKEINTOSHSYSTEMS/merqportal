<?php
// support.php - Support page that doesn't require login
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - MERQ Performance Evaluation System</title>
    <link rel="icon" type="image/x-icon" href="/assets/images/merq-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #003366;
            --secondary-color: #20c997;
            --accent-color: #ff6b6b;
            --light-bg: #f8f9fa;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .support-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .support-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #004080 100%);
            color: white;
            padding: 60px 40px;
            border-radius: 20px;
            margin-bottom: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .support-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .support-header img {
            height: 80px;
            margin-bottom: 20px;
            filter: brightness(0) invert(1);
        }

        .support-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: none;
        }

        .support-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .support-card .card-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .contact-method {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 15px;
            background: var(--light-bg);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .contact-method:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .contact-method .icon {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-right: 15px;
            width: 40px;
        }

        .quick-action-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, #004080 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .quick-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 51, 102, 0.3);
            color: white;
        }

        .faq-item {
            border: none;
            border-radius: 10px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .faq-item .card-header {
            background: var(--light-bg);
            border: none;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .faq-item .card-header:hover {
            background: #e9ecef;
        }

        .faq-item .card-body {
            padding: 20px;
            background: white;
        }

        .status-badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .bg-operational {
            background: #d4edda;
            color: #155724;
        }

        .bg-maintenance {
            background: #fff3cd;
            color: #856404;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .back-to-login {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
    </style>
</head>

<body>
    <!-- Back to Login Button -->
    <div class="back-to-login">
        <a href="login.php" class="quick-action-btn">
            <i class="fas fa-arrow-left me-2"></i>Back to Login
        </a>
    </div>

    <div class="support-container">
        <!-- Header Section -->
        <div class="support-header">
            <img src="https://merqconsultancy.org/wp-content/uploads/2017/07/merq.png" alt="MERQ Consultancy">
            <h1 class="display-4 fw-bold mb-3">Technical Support Center</h1>
            <p class="lead mb-4">Get help with the Performance Evaluation System</p>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <span class="status-badge bg-operational">
                        <i class="fas fa-check-circle me-2"></i>All Systems Operational
                    </span>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Quick Help Section -->
            <div class="col-lg-4 mb-4">
                <div class="support-card animated-card">
                    <div class="card-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3>Quick Solutions</h3>
                    <p class="text-muted">Common issues and their solutions</p>

                    <div class="mt-4">
                        <div class="contact-method">
                            <div class="icon">
                                <i class="fas fa-key"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Password Issues</h6>
                                <p class="small mb-0">Reset your password or unlock account</p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="icon">
                                <i class="fas fa-user-lock"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Login Problems</h6>
                                <p class="small mb-0">Trouble accessing your account</p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Evaluation Access</h6>
                                <p class="small mb-0">Can't view or submit evaluations</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Status -->
                <div class="support-card animated-card" style="animation-delay: 0.2s;">
                    <h5><i class="fas fa-server me-2"></i>System Status</h5>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Authentication Service</span>
                            <span class="status-badge bg-operational">Operational</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Evaluation System</span>
                            <span class="status-badge bg-operational">Operational</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Reporting Dashboard</span>
                            <span class="status-badge bg-operational">Operational</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-4 mb-4">
                <div class="support-card animated-card" style="animation-delay: 0.4s;">
                    <div class="card-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Contact Support</h3>
                    <p class="text-muted">Get in touch with our technical team</p>

                    <div class="mt-4">
                        <div class="contact-method">
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Email Support</h6>
                                <p class="small mb-0">support@merqconsultancy.org</p>
                                <a href="mailto:support@merqconsultancy.org" class="small">Send Email</a>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Phone Support</h6>
                                <p class="small mb-0">+251 913 391 985</p>
                                <a href="tel:+251913391985" class="small">Call Now</a>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Support Hours</h6>
                                <p class="small mb-0">Mon - Fri: 8:30 AM - 5:30 PM</p>
                                <p class="small mb-0">Sat: 9:00 AM - 1:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="quick-action-btn w-100" onclick="contactSupport()">
                            <i class="fas fa-paper-plane me-2"></i>Send Support Request
                        </button>
                    </div>
                </div>
            </div>

            <!-- FAQs -->
            <div class="col-lg-4 mb-4">
                <div class="support-card animated-card" style="animation-delay: 0.6s;">
                    <div class="card-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <h3>Frequently Asked Questions</h3>
                    <p class="text-muted">Quick answers to common questions</p>

                    <div class="mt-4">
                        <div class="accordion" id="faqAccordion">
                            <!-- FAQ 1 -->
                            <div class="faq-item">
                                <div class="card-header" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    <h6 class="mb-0">
                                        <i class="fas fa-chevron-down me-2"></i>
                                        I forgot my password. What should I do?
                                    </h6>
                                </div>
                                <div id="faq1" class="collapse" data-bs-parent="#faqAccordion">
                                    <div class="card-body">
                                        <p class="small mb-0">Contact the IT support team at support@merqconsultancy.org or call +251 913 391 985 to reset your password.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ 2 -->
                            <div class="faq-item">
                                <div class="card-header" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    <h6 class="mb-0">
                                        <i class="fas fa-chevron-down me-2"></i>
                                        I can't see my evaluation reports.
                                    </h6>
                                </div>
                                <div id="faq2" class="collapse" data-bs-parent="#faqAccordion">
                                    <div class="card-body">
                                        <p class="small mb-0">Ensure you're logged in with the correct account and check if the evaluation period is active. If issues persist, contact your supervisor or IT support.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ 3 -->
                            <div class="faq-item">
                                <div class="card-header" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    <h6 class="mb-0">
                                        <i class="fas fa-chevron-down me-2"></i>
                                        The system is running slow.
                                    </h6>
                                </div>
                                <div id="faq3" class="collapse" data-bs-parent="#faqAccordion">
                                    <div class="card-body">
                                        <p class="small mb-0">Try refreshing the page, clearing your browser cache, or using a different browser. If the problem continues, report it to IT support.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ 4 -->
                            <div class="faq-item">
                                <div class="card-header" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    <h6 class="mb-0">
                                        <i class="fas fa-chevron-down me-2"></i>
                                        I can't submit my evaluation form.
                                    </h6>
                                </div>
                                <div id="faq4" class="collapse" data-bs-parent="#faqAccordion">
                                    <div class="card-body">
                                        <p class="small mb-0">Check if all required fields are completed and ensure you have a stable internet connection. If the problem persists, contact support.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Emergency Contact -->
        <div class="row">
            <div class="col-12">
                <div class="support-card text-center">
                    <div class="row align-items-center">
                        <div class="col-md-8 text-md-start">
                            <h4 class="mb-2">Need Immediate Assistance?</h4>
                            <p class="text-muted mb-0">Our support team is ready to help you resolve any technical issues quickly.</p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <button class="quick-action-btn me-2" onclick="callSupport()">
                                <i class="fas fa-phone me-2"></i>Call Now
                            </button>
                            <button class="quick-action-btn" onclick="emailSupport()">
                                <i class="fas fa-envelope me-2"></i>Email Support
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Support contact functions
        function contactSupport() {
            Swal.fire({
                title: 'Contact Support',
                html: `
                    <div class="text-start">
                        <p>Please describe your issue in detail:</p>
                        <textarea id="supportMessage" class="form-control" rows="4" placeholder="Describe the problem you're experiencing..."></textarea>
                        <div class="mt-3">
                            <label for="supportEmail" class="form-label">Your Email</label>
                            <input type="email" id="supportEmail" class="form-control" placeholder="your.email@merqconsultancy.org">
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Send Message',
                confirmButtonColor: '#003366',
                preConfirm: () => {
                    const message = document.getElementById('supportMessage').value;
                    const email = document.getElementById('supportEmail').value;

                    if (!message) {
                        Swal.showValidationMessage('Please describe your issue');
                        return false;
                    }
                    if (!email) {
                        Swal.showValidationMessage('Please enter your email address');
                        return false;
                    }

                    return {
                        message,
                        email
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simulate sending message
                    Swal.fire({
                        title: 'Message Sent!',
                        text: 'Our support team will contact you within 24 hours.',
                        icon: 'success',
                        confirmButtonColor: '#003366'
                    });
                }
            });
        }

        function callSupport() {
            Swal.fire({
                title: 'Call Support',
                html: `
                    <div class="text-center">
                        <i class="fas fa-phone fa-3x text-primary mb-3"></i>
                        <h4>+251 913 391 985</h4>
                        <p class="text-muted">Available during support hours</p>
                    </div>
                `,
                confirmButtonText: 'Close',
                confirmButtonColor: '#003366'
            });
        }

        function emailSupport() {
            Swal.fire({
                title: 'Email Support',
                html: `
                    <div class="text-center">
                        <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                        <h4>support@merqconsultancy.org</h4>
                        <p class="text-muted">We typically respond within 4 hours</p>
                    </div>
                `,
                confirmButtonText: 'Copy Email',
                confirmButtonColor: '#003366',
                showCancelButton: true,
                cancelButtonText: 'Close'
            }).then((result) => {
                if (result.isConfirmed) {
                    navigator.clipboard.writeText('support@merqconsultancy.org');
                    Swal.fire({
                        title: 'Copied!',
                        text: 'Email address copied to clipboard',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }

        // Auto-expand first FAQ
        document.addEventListener('DOMContentLoaded', function() {
            const firstFaq = document.querySelector('.faq-item .card-header');
            if (firstFaq) {
                firstFaq.click();
            }
        });
    </script>
</body>

</html>