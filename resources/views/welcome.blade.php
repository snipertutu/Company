<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bakery & Gas Hub | Kualitas Premium & Energi</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
        
        <style>
            :root {
                --primary-gold: #D4AF37;
                --primary-blue: #0A2647;
                --accent-blue: #144272;
                --bg-dark: #050A14;
                --text-light: #F8F9FA;
                --text-muted: #A0A0A0;
                --glass: rgba(255, 255, 255, 0.05);
                --glass-border: rgba(255, 255, 255, 0.1);
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Outfit', sans-serif;
                background-color: var(--bg-dark);
                color: var(--text-light);
                line-height: 1.6;
                overflow-x: hidden;
            }

            h1, h2, h3 {
                font-family: 'Playfair Display', serif;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            /* Navigation */
            nav {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 30px 0;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 100;
            }

            .logo {
                font-size: 1.5rem;
                font-weight: 800;
                letter-spacing: 2px;
                background: linear-gradient(45deg, var(--primary-gold), #fff);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .nav-links {
                display: flex;
                gap: 40px;
                align-items: center;
            }

            .nav-links a {
                color: var(--text-light);
                text-decoration: none;
                font-weight: 400;
                font-size: 0.9rem;
                text-transform: uppercase;
                letter-spacing: 1px;
                transition: 0.3s;
                opacity: 0.8;
            }

            .nav-links a:hover {
                opacity: 1;
                color: var(--primary-gold);
            }

            .btn-login {
                padding: 12px 30px;
                border: 1px solid var(--primary-gold);
                color: var(--primary-gold);
                text-decoration: none;
                border-radius: 50px;
                font-weight: 600;
                transition: 0.3s;
            }

            .btn-login:hover {
                background: var(--primary-gold);
                color: var(--bg-dark);
            }

            /* Hero */
            .hero {
                height: 100vh;
                display: flex;
                align-items: center;
                position: relative;
                background: linear-gradient(to right, rgba(5, 10, 20, 0.9), rgba(5, 10, 20, 0.4)), url('/images/hero.png');
                background-size: cover;
                background-position: center;
            }

            .hero-content {
                max-width: 700px;
            }

            .hero h1 {
                font-size: 4.5rem;
                line-height: 1.1;
                margin-bottom: 20px;
                animation: fadeInUp 1s ease;
            }

            .hero p {
                font-size: 1.2rem;
                margin-bottom: 40px;
                color: var(--text-muted);
                animation: fadeInUp 1.2s ease;
            }

            .hero-btns {
                display: flex;
                gap: 20px;
                animation: fadeInUp 1.4s ease;
            }

            .btn-primary {
                padding: 15px 40px;
                background: var(--primary-gold);
                color: var(--bg-dark);
                text-decoration: none;
                border-radius: 50px;
                font-weight: 800;
                font-size: 1rem;
                transition: 0.3s;
            }

            .btn-primary:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
            }

            /* Products */
            .section {
                padding: 120px 0;
            }

            .section-title {
                text-align: center;
                margin-bottom: 80px;
            }

            .section-title h2 {
                font-size: 3rem;
                margin-bottom: 10px;
            }

            .section-title p {
                color: var(--primary-gold);
                text-transform: uppercase;
                letter-spacing: 3px;
                font-weight: 600;
            }

            .product-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 60px;
                align-items: center;
            }

            .product-image {
                position: relative;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
            }

            .product-image img {
                width: 100%;
                display: block;
            }

            .product-content h3 {
                font-size: 2.5rem;
                margin-bottom: 20px;
                color: var(--primary-gold);
            }

            .product-content p {
                margin-bottom: 30px;
                color: var(--text-muted);
                font-size: 1.1rem;
            }

            .features {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .feature-item {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .feature-item span {
                color: var(--primary-gold);
                font-size: 1.5rem;
            }

            /* Dashboards Preview */
            .app-preview {
                background: linear-gradient(var(--bg-dark), var(--accent-blue));
            }

            .app-card {
                background: var(--glass);
                border: 1px solid var(--glass-border);
                backdrop-filter: blur(20px);
                border-radius: 30px;
                padding: 60px;
                text-align: center;
            }

            .app-card h2 {
                font-size: 3rem;
                margin-bottom: 20px;
            }

            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }

            footer {
                padding: 60px 0;
                text-align: center;
                border-top: 1px solid var(--glass-border);
                color: var(--text-muted);
            }

            /* Animations */
            .float {
                animation: float 6s ease-in-out infinite;
            }

            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0px); }
            }
        </style>
    </head>
    <body>
        <nav>
            <div class="container" style="display: flex; justify-content: space-between; width: 100%;">
                <div class="logo">LUXE BAKERY & GAS</div>
                <div class="nav-links">
                    <a href="#about">Tentang</a>
                    <a href="#products">Produk</a>
                    <a href="#contact">Kontak</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-login">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login">Login Mitra</a>
                    @endauth
                </div>
            </div>
        </nav>

        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Savor Excellence, Fuel Your Life</h1>
                    <p>Rasakan perpaduan sempurna antara keunggulan roti artisanal dan solusi energi profesional. Kami menyediakan Roti dan LPG berkualitas tinggi dengan komitmen penuh pada integritas dan layanan.</p>
                    <div class="hero-btns">
                        <a href="#products" class="btn-primary">Jelajahi Produk</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="products">
            <div class="container">
                <div class="section-title">
                    <p>Penawaran Kami</p>
                    <h2>Esensial Premium</h2>
                </div>
                
                <div class="product-grid">
                    <div class="product-image float">
                        <img src="/images/products.png" alt="Produk Bakery dan Gas">
                    </div>
                    <div class="product-content">
                        <h3>Roti Artisanal & LPG Andal</h3>
                        <p>Kami mengutamakan kualitas tanpa kompromi. Dari roti segar yang dipanggang setiap hari hingga layanan distribusi gas yang mengutamakan keselamatan, kami memberdayakan dapur dan rumah Anda.</p>
                        
                        <div class="features">
                            <div class="feature-item">
                                <span>&#10003;</span>
                                <div><strong>Segar Setiap Hari</strong> - Dipanggang dengan bahan-bahan premium setiap pagi.</div>
                            </div>
                            <div class="feature-item">
                                <span>&#10003;</span>
                                <div><strong>Sertifikasi Aman</strong> - Tabung LPG diuji dan disertifikasi untuk keamanan maksimum.</div>
                            </div>
                            <div class="feature-item">
                                <span>&#10003;</span>
                                <div><strong>Pengiriman Cepat</strong> - Rantai pasokan yang andal untuk kebutuhan rumah tangga dan bisnis Anda.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section app-preview">
            <div class="container">
                <div class="app-card">
                    <h2>Manajemen Terintegrasi</h2>
                    <p style="max-width: 600px; margin: 0 auto 40px; color: var(--text-muted);">Sistem POS dan Inventori internal kami memastikan operasional yang lancar untuk hub distribusi roti dan gas kami.</p>
                    <a href="{{ route('login') }}" class="btn-primary">Akses Portal Internal</a>
                </div>
            </div>
        </section>

        <footer>
            <div class="container">
                <p>&copy; 2026 Luxe Bakery & Gas Hub. Hak Cipta Dilindungi.</p>
                <div style="margin-top: 10px; font-size: 0.8rem;">Solusi Modern untuk Kehidupan Modern</div>
            </div>
        </footer>
    </body>
</html>
