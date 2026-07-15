<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PWD Registry | Persons with Disabilities Registry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html {
            scroll-behavior: smooth;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.4;
        }
        .hero-gradient::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 8s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        .service-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
        }
        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .service-icon-wrapper {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        .service-icon-wrapper svg {
            width: 32px;
            height: 32px;
        }
        .btn-glow {
            position: relative;
            overflow: hidden;
        }
        .btn-glow::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
            transform: rotate(45deg);
            transition: all 0.5s ease;
        }
        .btn-glow:hover::after {
            left: 100%;
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .stat-badge {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1;
        }
        .benefit-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }
        .benefit-card:hover {
            border-color: #667eea;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.1);
        }
        .benefit-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        .footer-link {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .footer-link:hover {
            color: #fff;
        }
        @media (max-width: 768px) {
            .stat-number {
                font-size: 2.5rem;
            }
            .hero-gradient h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body data-bs-theme="light" class="bg-body-tertiary">
<header class="bg-white border-bottom border-light shadow-sm sticky-top"><div class="container py-3"><div class="d-flex align-items-center justify-content-between"><a href="{{ route('home') }}" class="text-decoration-none text-dark fw-semibold fs-5 d-flex align-items-center"><span class="brand-mark text-white d-flex align-items-center justify-content-center">PR</span><span class="ms-2">PWD Registry</span></a><a href="{{ route('public.registration.create') }}" class="btn btn-primary btn-sm rounded-pill px-4">Get Started</a></div></div></header>
<main>
    <section class="hero-gradient text-white py-5 py-lg-5"><div class="container py-lg-5"><div class="row align-items-center hero-content"><div class="col-lg-7 animate-fade-in"><div class="stat-badge mb-3"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg><span class="small">Local Government Unit</span></div><h1 class="display-3 fw-bold mb-3">A more accessible path to PWD services.</h1><p class="lead mb-4 opacity-90">The Persons with Disabilities Registry helps residents submit registration details and allows staff to manage identification cards and applications efficiently.</p><div class="d-flex gap-3 flex-wrap"><a href="{{ route('public.registration.create') }}" class="btn btn-light btn-lg rounded-pill px-5 btn-glow fw-semibold">Start Registration</a><a href="#services" class="btn btn-outline-light btn-lg rounded-pill px-4">Learn more</a></div></div><div class="col-lg-5 d-none d-lg-block"><div class="text-center opacity-25"><svg width="400" height="400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div></div></div></div></section>
    <section id="services" class="py-5 py-lg-5"><div class="container"><div class="text-center mb-5"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">Our Services</span><h2 class="fw-bold display-6 mb-2">Registry services</h2><p class="text-muted fs-5">Comprehensive support for PWD identification and records management.</p></div><div class="row g-4"><div class="col-md-4"><div class="card h-100 service-card p-4"><div class="service-icon-wrapper bg-primary bg-opacity-10"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div><h3 class="h5 fw-bold mb-3">PWD Registration</h3><p class="text-muted mb-0">Submit registration details for review by the PWD affairs office with our streamlined process.</p></div></div><div class="col-md-4"><div class="card h-100 service-card p-4"><div class="service-icon-wrapper bg-success bg-opacity-10"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-success"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div><h3 class="h5 fw-bold mb-3">ID Card Management</h3><p class="text-muted mb-0">Track issued cards, renewals, and upcoming expiry dates in one centralized dashboard.</p></div></div><div class="col-md-4"><div class="card h-100 service-card p-4"><div class="service-icon-wrapper bg-info bg-opacity-10"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-info"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div><h3 class="h5 fw-bold mb-3">Application Tracking</h3><p class="text-muted mb-0">Staff can follow each application through review and approval with clear status updates.</p></div></div></div></div></section>
    <section class="py-5 py-lg-5 bg-light"><div class="container"><div class="text-center mb-5"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">Our Impact</span><h2 class="fw-bold display-6 mb-2">Making a difference</h2><p class="text-muted fs-5">Trusted by the local government to serve our community.</p></div><div class="row g-4"><div class="col-md-4"><div class="stat-card"><div class="stat-number">500+</div><div class="mt-2 opacity-90">Registered PWDs</div></div></div><div class="col-md-4"><div class="stat-card"><div class="stat-number">98%</div><div class="mt-2 opacity-90">Approval Rate</div></div></div><div class="col-md-4"><div class="stat-card"><div class="stat-number">24/7</div><div class="mt-2 opacity-90">Online Access</div></div></div></div></div></section>
    <section class="py-5 py-lg-5"><div class="container"><div class="text-center mb-5"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">Why Choose Us</span><h2 class="fw-bold display-6 mb-2">Benefits of registering</h2><p class="text-muted fs-5">Simplified access to government services and support programs.</p></div><div class="row g-4"><div class="col-md-6"><div class="benefit-card"><div class="benefit-icon bg-primary bg-opacity-10"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary" width="24" height="24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><h3 class="h5 fw-bold mb-2">Fast Processing</h3><p class="text-muted mb-0">Quick and efficient registration process with minimal paperwork and digital submission options.</p></div></div><div class="col-md-6"><div class="benefit-card"><div class="benefit-icon bg-success bg-opacity-10"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-success" width="24" height="24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><h3 class="h5 fw-bold mb-2">Secure & Private</h3><p class="text-muted mb-0">Your personal information is protected with advanced security measures and strict privacy policies.</p></div></div><div class="col-md-6"><div class="benefit-card"><div class="benefit-icon bg-info bg-opacity-10"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-info" width="24" height="24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div><h3 class="h5 fw-bold mb-2">Real-time Updates</h3><p class="text-muted mb-0">Track your application status in real-time and receive notifications at every step of the process.</p></div></div><div class="col-md-6"><div class="benefit-card"><div class="benefit-icon bg-warning bg-opacity-10"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-warning" width="24" height="24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div><h3 class="h5 fw-bold mb-2">Community Support</h3><p class="text-muted mb-0">Connect with support programs and resources designed specifically for the PWD community.</p></div></div></div></div></section>
    <section class="bg-white border-top py-5 py-lg-5"><div class="container text-center"><div class="row justify-content-center"><div class="col-lg-8"><h2 class="h3 fw-bold mb-3">Need help with registration?</h2><p class="text-muted fs-5 mb-4">Visit your local PWD affairs office for guidance and document requirements. Our team is ready to assist you.</p><a href="{{ route('public.registration.create') }}" class="btn btn-primary btn-lg rounded-pill px-5 btn-glow fw-semibold">Register a PWD</a></div></div></div></section>
</main>
<footer class="bg-dark text-white-50 py-5"><div class="container"><div class="row g-4"><div class="col-md-6"><div class="d-flex align-items-center mb-3"><span class="brand-mark text-white d-flex align-items-center justify-content-center me-2">PR</span><span class="fw-semibold text-white">PWD Registry</span></div><p class="small mb-0">Persons with Disabilities Registry Management System - Making services accessible for everyone.</p></div><div class="col-md-6 text-md-end"><p class="small mb-2">&copy; {{ now()->year }} PWD Registry. All rights reserved.</p><p class="small mb-0">Local Government Unit</p></div></div></div></footer>
</body>
</html>
