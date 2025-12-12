<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholaria - Gestion Académique Simplifiée</title>
    <link rel="icon" href="logoBG.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #1a3a52;
            --primary-blue: #2c5aa0;
            --teal-light: #1abc9c;
            --teal-dark: #16a085;
            --gold-accent: #f4b860;
            --light-bg: #f5f8fb;
            --white: #ffffff;
            --gray-light: #ecf0f5;
            --gray-dark: #5a6c7d;
            --shadow: 0 10px 30px rgba(26, 58, 82, 0.15);
            --shadow-sm: 0 4px 12px rgba(26, 58, 82, 0.08);
            --border-radius: 15px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--gray-dark);
            background: linear-gradient(135deg, #e8f1f8 0%, #f0f6fb 50%, #e8f4f8 100%);
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Header */
        header {
            background-color: var(--white);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 10px;
            color: var(--primary-dark);
            text-decoration: none;
        }

        .logo-image {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
            color: var(--primary-dark);
        }

        .logo-subtitle {
            font-size: 0.65rem;
            font-weight: 500;
            color: var(--teal-light);
            letter-spacing: 0.5px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--gray-dark);
            font-weight: 500;
            transition: var(--transition);
            padding: 5px 0;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--teal-light);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--teal-light);
            transition: var(--transition);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .auth-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .btn {
            padding: 10px 24px;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-login {
            background-color: transparent;
            color: var(--teal-light);
            border: 2px solid var(--teal-light);
        }

        .btn-login:hover {
            background-color: var(--teal-light);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--teal-light) 0%, var(--teal-dark) 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary-dark);
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            padding: 100px 0;
            background: linear-gradient(135deg, rgba(26, 58, 82, 0.05) 0%, rgba(26, 188, 156, 0.05) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(26, 188, 156, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 1;
        }

        .hero-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 50px;
            position: relative;
            z-index: 2;
        }

        .hero-text {
            flex: 1;
            max-width: 600px;
        }

        .hero-title {
            font-size: 3.2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 25px;
            color: var(--primary-dark);
        }

        .hero-title span {
            color: var(--teal-light);
        }

        .hero-description {
            font-size: 1.1rem;
            color: var(--gray-dark);
            margin-bottom: 35px;
            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            margin-top: 35px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--teal-light) 0%, var(--teal-dark) 100%);
            color: white;
            padding: 14px 35px;
            font-size: 1rem;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        .btn-secondary {
            background-color: var(--white);
            color: var(--teal-light);
            border: 2px solid var(--teal-light);
            padding: 14px 35px;
            font-size: 1rem;
        }

        .btn-secondary:hover {
            background-color: var(--teal-light);
            color: white;
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .logo-showcase {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle at 30% 30%, var(--white) 0%, var(--gray-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
            animation: float 6s ease-in-out infinite;
        }

        .logo-showcase img {
            width: 250px;
            height: 250px;
            object-fit: contain;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-30px); }
        }

        /* Features Section */
        .features {
            padding: 100px 0;
            background-color: var(--white);
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 15px;
        }

        .section-subtitle {
            color: var(--gray-dark);
            max-width: 600px;
            margin: 0 auto;
            font-size: 1.1rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .feature-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            padding: 40px 35px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            text-align: center;
            border: 1px solid var(--gray-light);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow);
            border-color: var(--teal-light);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(26, 188, 156, 0.15) 0%, rgba(26, 188, 156, 0.05) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: var(--teal-light);
            font-size: 2rem;
        }

        .feature-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--primary-dark);
        }

        .feature-description {
            color: var(--gray-dark);
            line-height: 1.8;
        }

        /* How It Works Section */
        .how-it-works {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--light-bg) 0%, var(--white) 100%);
        }

        .steps-container {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            margin-top: 60px;
            position: relative;
        }

        .steps-container::before {
            content: '';
            position: absolute;
            top: 40px;
            left: 15%;
            width: 70%;
            height: 3px;
            background: linear-gradient(90deg, var(--teal-light) 0%, var(--teal-dark) 100%);
            z-index: 1;
        }

        .step {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .step-number {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, var(--teal-light) 0%, var(--teal-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 2rem;
            font-weight: 700;
            box-shadow: var(--shadow-sm);
            border: 4px solid var(--white);
        }

        .step-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--primary-dark);
        }

        .step-description {
            color: var(--gray-dark);
            max-width: 280px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* CTA Section */
        .cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-blue) 100%);
            border-radius: var(--border-radius);
            text-align: center;
            color: white;
            margin: 80px 0;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .cta-description {
            font-size: 1.1rem;
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            color: rgba(255, 255, 255, 0.9);
        }

        .btn-cta {
            background: var(--gold-accent);
            color: var(--primary-dark);
            padding: 15px 40px;
            font-size: 1.05rem;
            box-shadow: var(--shadow);
        }

        .btn-cta:hover {
            background: #f5c774;
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-blue) 100%);
            color: white;
            padding: 70px 0 30px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 50px;
            margin-bottom: 50px;
        }

        .footer-section {
            display: flex;
            flex-direction: column;
        }

        .footer-logo {
            margin-bottom: 20px;
        }

        .footer-logo .logo {
            color: white;
            font-size: 1.3rem;
        }

        .footer-logo p {
            color: rgba(255, 255, 255, 0.85);
            margin-top: 15px;
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .footer-links h3, .footer-contact h3 {
            font-size: 1.1rem;
            margin-bottom: 20px;
            font-weight: 700;
            color: white;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.95rem;
        }

        .footer-links a:hover {
            color: var(--gold-accent);
            padding-left: 5px;
        }

        .footer-contact p {
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
        }

        .social-icons {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .social-icons a {
            width: 45px;
            height: 45px;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: var(--transition);
            font-size: 1.1rem;
        }

        .social-icons a:hover {
            background-color: var(--teal-light);
            transform: translateY(-3px);
        }

        .footer-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
            margin: 40px 0;
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.75);
            font-size: 0.9rem;
        }

        @media (max-width: 992px) {
            .hero-content {
                flex-direction: column;
                text-align: center;
            }

            .hero-text {
                max-width: 100%;
            }

            .hero-buttons {
                justify-content: center;
            }

            .nav-links {
                display: none;
            }

            .steps-container::before {
                width: 90%;
                left: 5%;
            }
        }

        @media (max-width: 768px) {
            .nav-links, .auth-buttons {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .hero {
                padding: 60px 0;
            }

            .cta-section {
                padding: 50px 20px;
            }

            .steps-container {
                flex-direction: column;
                gap: 50px;
            }

            .steps-container::before {
                display: none;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .btn-primary, .btn-secondary {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                flex-wrap: wrap;
            }

            .logo {
                font-size: 1.2rem;
            }

            .logo-image {
                width: 40px;
                height: 40px;
            }

            .hero-title {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <a href="#" class="logo">
                    <img src="logoBG.png" width="80px">
                    <!-- <div class="logo-text">
                        Scholaria
                        <span class="logo-subtitle">Gérez l'avenir étudiant</span>
                    </div> -->
                </a>

                <div class="nav-links">
                    <a href="#accueil">Accueil</a>
                    <a href="#fonctionnalites">Fonctionnalités</a>
                    <a href="#fonctionnement">Comment ça marche</a>
                    <a href="#contact">Contact</a>
                </div>

                <div class="auth-buttons">
                    <a href="Connexion.php" class="btn btn-login">Connexion</a>
                    <!-- <a href="#" class="btn btn-register">Inscription</a> -->
                </div>

                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="accueil">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">Gestion académique <span>simplifiée</span></h1>
                    <p class="hero-description">
                        Scholaria est la plateforme tout-en-un pour gérer efficacement votre établissement. Emplois du temps, notes, communications - tout au même endroit.
                    </p>
                    <div class="hero-buttons">
                        <a href="Connexion.php" class="btn btn-primary">Commencer maintenant</a>
                        <button class="btn btn-secondary">Voir la démo</button>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="logo-showcase">
                        <img src="logoBG.png" width="80px">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="fonctionnalites">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Fonctionnalités principales</h2>
                <p class="section-subtitle">Tous les outils nécessaires pour optimiser votre gestion académique</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="feature-title">Emploi du temps intelligent</h3>
                    <p class="feature-description">Créez et gérez des emplois du temps dynamiques avec ajustements automatiques et gestion des changements.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">Gestion des étudiants</h3>
                    <p class="feature-description">Suivi complet des informations étudiantes, présences, notes et progression académique en temps réel.</p>
                </div>
                
                <!-- <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Analytique et rapports</h3>
                    <p class="feature-description">Générez des rapports détaillés et analyses pour prendre les meilleures décisions académiques.</p>
                </div> -->

                <!-- <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="feature-title">Communication</h3>
                    <p class="feature-description">Plateforme de communication intégrée pour enseignants, étudiants et parents en un seul endroit.</p>
                </div> -->

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="feature-title">Gestion des ressources</h3>
                    <p class="feature-description">Bibliothèque numérique de ressources pédagogiques accessible à tous les utilisateurs.</p>
                </div>

                <!-- <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Sécurité avancée</h3>
                    <p class="feature-description">Données protégées avec chiffrement de pointe et conformité aux normes de protection.</p>
                </div> -->
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works" id="fonctionnement">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Comment ça marche</h2>
                <p class="section-subtitle">Mettez en place Scholaria en quelques étapes simples</p>
            </div>
            
            <div class="steps-container">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Inscription</h3>
                    <p class="step-description">Créez votre compte en tant qu'établissement ou utilisateur en quelques minutes.</p>
                </div>
                
                <div class="step">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Configuration</h3>
                    <p class="step-description">Personnalisez votre espace et importez vos données existantes facilement.</p>
                </div>
                
                <div class="step">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Utilisation</h3>
                    <p class="step-description">Commencez à gérer et bénéficiez d'une gestion académique simplifiée.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">Prêt à transformer votre gestion académique ?</h2>
            <p class="cta-description">Rejoignez des centaines d'établissements qui font confiance à Scholaria pour optimiser leur gestion étudiante.</p>
            <a href="Connexion.php" class="btn btn-primary btn-cta">Se connecter maintenant</a>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section footer-logo">
                    <a href="#" class="logo">
                        <img src="logoBG.png" width="80px">
                        <!-- <div class="logo-text">
                            Scholaria
                            <span class="logo-subtitle">Gérez l'avenir étudiant</span>
                        </div> -->
                    </a>
                    <p>La plateforme de gestion académique tout-en-un pour les établissements d'enseignement modernes.</p>
                </div>
                
                <div class="footer-section">
                    <h3>Liens rapides</h3>
                    <ul class="footer-links">
                        <li><a href="#accueil">Accueil</a></li>
                        <li><a href="#fonctionnalites">Fonctionnalités</a></li>
                        <li><a href="#fonctionnement">Comment ça marche</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contact</h3>
                    <div class="footer-contact">
                        <p><i class="fas fa-map-marker-alt"></i> 123 Rue de l'Éducation, Marrakech 75000</p>
                        <p><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
                        <p><i class="fas fa-envelope"></i> contact@scholaria.ma</p>
                    </div>
                    <div class="social-icons">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-divider"></div>
            
            <div class="copyright">
                <p>&copy; 2024 Scholaria. Tous droits réservés. | Conçu pour l'éducation moderne</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');
        const authButtons = document.querySelector('.auth-buttons');
        
        mobileMenuBtn.addEventListener('click', () => {
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
            authButtons.style.display = authButtons.style.display === 'flex' ? 'none' : 'flex';
            
            if (navLinks.style.display === 'flex') {
                navLinks.style.flexDirection = 'column';
                navLinks.style.position = 'absolute';
                navLinks.style.top = '100%';
                navLinks.style.left = '0';
                navLinks.style.width = '100%';
                navLinks.style.backgroundColor = 'white';
                navLinks.style.padding = '20px';
                navLinks.style.boxShadow = '0 10px 20px rgba(0,0,0,0.1)';
                
                authButtons.style.flexDirection = 'column';
                authButtons.style.position = 'absolute';
                authButtons.style.top = 'calc(100% + 150px)';
                authButtons.style.left = '0';
                authButtons.style.width = '100%';
                authButtons.style.padding = '20px';
                authButtons.style.backgroundColor = 'white';
                authButtons.style.boxShadow = '0 10px 20px rgba(0,0,0,0.1)';
            }
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    if(window.innerWidth <= 768) {
                        navLinks.style.display = 'none';
                        authButtons.style.display = 'none';
                    }
                }
            });
        });
        
        // Button interactions
        document.querySelectorAll('.btn-register, .btn-primary').forEach(button => {
            button.addEventListener('click', () => {
                alert('Redirection vers la page d\'inscription...');
            });
        });
        
        document.querySelectorAll('.btn-login, .btn-secondary').forEach(button => {
            button.addEventListener('click', () => {
                alert('Redirection vers la page de connexion / démo...');
            });
        });
    </script>
</body>
</html>