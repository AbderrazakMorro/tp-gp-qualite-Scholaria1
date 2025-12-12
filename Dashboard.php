<?php 
include_once("DB.php");
session_start();
if(isset($_SESSION['ROLE']) || $_SESSION['ROLE'] = 'Etudiant'){
    $roleDash=$_SESSION['ROLE'];
    $id=$_SESSION['USER_ID'];
    $sql=DB::select_data("CALL GetUserById($id)");
    if($sql->rowCount()>0){
        $row=$sql->fetch();
        $userName=$row['Nom_U'].' '.$row['Prenom_U'];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Scholaria</title>
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
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --shadow: 0 10px 30px rgba(26, 58, 82, 0.15);
            --shadow-sm: 0 4px 12px rgba(26, 58, 82, 0.08);
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--gray-dark);
            background-color: var(--light-bg);
            overflow-x: hidden;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary-blue) 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: var(--transition);
            z-index: 100;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            margin-bottom: 15px;
            background: rgba(255, 255, 255, 0.08);
            padding: 8px;
            border-radius: 50%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .logo-text h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
            margin-bottom: 5px;
        }

        .logo-subtitle {
            font-size: 0.75rem;
            color: var(--gold-accent);
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            transition: var(--transition);
            gap: 15px;
            text-decoration: none;
            border-left: 4px solid transparent;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: var(--gold-accent);
            color: white;
            padding-left: 25px;
        }

        .menu-item.active {
            background-color: rgba(26, 188, 156, 0.2);
            color: var(--gold-accent);
            border-left-color: var(--gold-accent);
        }

        .menu-item i {
            font-size: 1.1rem;
            width: 22px;
            text-align: center;
        }

        /* ==================== MAIN CONTENT ==================== */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 30px;
        }

        /* Header */
        .header {
            background: var(--white);
            padding: 25px 30px;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
            box-shadow: var(--shadow-sm);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
        }

        .header-left h1 {
            font-size: 1.8rem;
            color: var(--primary-dark);
            margin-bottom: 5px;
            font-weight: 700;
        }

        .header-left p {
            color: var(--gray-dark);
            font-size: 0.95rem;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 25px;
            flex: 1;
        }

        .search-bar {
            background-color: var(--light-bg);
            border: 2px solid var(--gray-light);
            padding: 12px 20px;
            border-radius: 50px;
            flex: 1;
            max-width: 300px;
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
            color: var(--gray-dark);
            font-size: 0.9rem;
        }

        .search-bar:focus {
            outline: none;
            border-color: var(--teal-light);
            box-shadow: 0 0 0 3px rgba(26, 188, 156, 0.1);
        }

        .search-bar::placeholder {
            color: var(--gray-dark);
        }

        .profile-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .profile-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--teal-light) 0%, var(--teal-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .profile-info h4 {
            font-size: 0.95rem;
            color: var(--primary-dark);
            margin-bottom: 3px;
        }

        .profile-info p {
            font-size: 0.8rem;
            color: var(--gray-dark);
        }

        /* ==================== STATS GRID ==================== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--white);
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            border-top: 4px solid var(--teal-light);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }

        .stat-card.danger {
            border-top-color: var(--danger-color);
        }

        .stat-card.warning {
            border-top-color: var(--warning-color);
        }

        .stat-card.success {
            border-top-color: var(--success-color);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, rgba(26, 188, 156, 0.2) 0%, rgba(26, 188, 156, 0.05) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--teal-light);
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .stat-card.danger .stat-icon {
            background: linear-gradient(135deg, rgba(231, 76, 60, 0.2) 0%, rgba(231, 76, 60, 0.05) 100%);
            color: var(--danger-color);
        }

        .stat-card.warning .stat-icon {
            background: linear-gradient(135deg, rgba(243, 156, 18, 0.2) 0%, rgba(243, 156, 18, 0.05) 100%);
            color: var(--warning-color);
        }

        .stat-card.success .stat-icon {
            background: linear-gradient(135deg, rgba(46, 204, 113, 0.2) 0%, rgba(46, 204, 113, 0.05) 100%);
            color: var(--success-color);
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--gray-dark);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 8px;
        }

        .stat-change {
            font-size: 0.8rem;
            color: var(--success-color);
            font-weight: 600;
        }

        .stat-change.negative {
            color: var(--danger-color);
        }

        /* ==================== CARDS ==================== */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .card {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: var(--shadow);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--gray-light);
        }

        .card-header h3 {
            font-size: 1.2rem;
            color: var(--primary-dark);
            font-weight: 700;
        }

        .card-header a {
            color: var(--teal-light);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .card-header a:hover {
            color: var(--teal-dark);
        }

        /* ==================== TABLES ==================== */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: var(--light-bg);
            padding: 12px;
            text-align: left;
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid var(--gray-light);
            font-size: 0.95rem;
            color: var(--gray-dark);
        }

        tr:hover {
            background-color: var(--light-bg);
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background-color: rgba(46, 204, 113, 0.15);
            color: var(--success-color);
        }

        .status-pending {
            background-color: rgba(243, 156, 18, 0.15);
            color: var(--warning-color);
        }

        .status-inactive {
            background-color: rgba(231, 76, 60, 0.15);
            color: var(--danger-color);
        }

        /* ==================== BUTTONS ==================== */
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 0.9rem;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--teal-light) 0%, var(--teal-dark) 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--gold-accent) 0%, #f5c774 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #27ae60 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #e8b04b 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-block {
            width: 100%;
            justify-content: flex-start;
            padding-left: 15px;
        }

        /* ==================== ACTIONS SECTION ==================== */
        .actions-section {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-right {
                width: 100%;
                flex-direction: column;
            }

            .search-bar {
                max-width: none;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                width: 250px;
                height: 100vh;
                z-index: 999;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }

            .search-bar {
                max-width: 100%;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            table {
                font-size: 0.85rem;
            }

            th, td {
                padding: 8px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 15px;
            }

            .header-left h1 {
                font-size: 1.3rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 15px;
            }

            .btn {
                padding: 10px 15px;
                font-size: 0.85rem;
            }
        }

        /* ==================== SCROLLBAR ==================== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--teal-light);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--teal-dark);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="logoBG.png" alt="Scholaria" class="logo-img">
                <div class="logo-text">
                    <h3><?php echo $userName; ?></h3>
                    <!-- <span class="logo-subtitle">Gestion Académique</span> -->
                </div>
            </div>

            <nav class="sidebar-menu">
                <a href="#" class="menu-item active">
                    <i class="fas fa-th-large"></i>
                    <span>Tableau de bord</span>
                </a>
                <!-- <a href="#" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Étudiants</span>
                </a> -->
                <a href="#" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Emploi du temps</span>
                </a>
                <!-- <a href="#" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span>Cours</span>
                </a> -->
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span>Notes</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-file-pdf"></i>
                    <span>Rapports</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>Paramètres</span>
                </a>
                <a href="Acceuil.php" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="header-left">
                    <h1>Bienvenue <?php echo $userName; ?></h1>
                    <p>Tableau de bord Scholaria</p>
                </div>
                <div class="header-right">
                    <input type="text" class="search-bar" placeholder="Rechercher...">
                    <div class="profile-section">
                        <div class="profile-avatar">U</div>
                        <div class="profile-info">
                            <h4><?php echo $userName; ?></h4>
                            <p><?php echo $roleDash; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <!-- <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-label">Total Étudiants</div>
                    <div class="stat-value">1,245</div>
                    <div class="stat-change"><i class="fas fa-arrow-up"></i> +12% ce mois</div>
                </div> -->

                <div class="stat-card success">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-label">Présences</div>
                    <div class="stat-value">94%</div>
                    <div class="stat-change"><i class="fas fa-arrow-up"></i> +3% cette semaine</div>
                </div>

                <div class="stat-card warning">
                    <div class="stat-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stat-label">Retards</div>
                    <div class="stat-value">28</div>
                    <div class="stat-change negative"><i class="fas fa-arrow-up"></i> +5 cette semaine</div>
                </div>

                <div class="stat-card danger">
                    <div class="stat-icon">
                        <i class="fas fa-ban"></i>
                    </div>
                    <div class="stat-label">Absences</div>
                    <div class="stat-value">78</div>
                    <div class="stat-change negative"><i class="fas fa-arrow-up"></i> +8 cette semaine</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Students Table -->
                <!-- <div class="card">
                    <div class="card-header">
                        <h3>Étudiants Récents</h3>
                        <a href="#">Voir tous →</a>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Classe</th>
                                    <th>Email</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Ahmed Benali</strong></td>
                                    <td>1ère Année A</td>
                                    <td>ahmed.benali@school.ma</td>
                                    <td><span class="status-badge status-active">Actif</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Fatima Zahra</strong></td>
                                    <td>2ème Année B</td>
                                    <td>fatima.z@school.ma</td>
                                    <td><span class="status-badge status-active">Actif</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Mohamed Samir</strong></td>
                                    <td>1ère Année C</td>
                                    <td>m.samir@school.ma</td>
                                    <td><span class="status-badge status-pending">En attente</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Laila Amira</strong></td>
                                    <td>3ème Année A</td>
                                    <td>laila.a@school.ma</td>
                                    <td><span class="status-badge status-active">Actif</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->

                <!-- Quick Actions -->
                <!-- <div class="card">
                    <div class="card-header">
                        <h3>Actions Rapides</h3>
                    </div>
                    <div class="actions-section">
                        <button class="btn btn-primary btn-block">
                            <i class="fas fa-user-plus"></i>
                            Ajouter Étudiant
                        </button>
                        <button class="btn btn-gold btn-block">
                            <i class="fas fa-calendar-plus"></i>
                            Planifier Cours
                        </button>
                        <button class="btn btn-warning btn-block">
                            <i class="fas fa-file-export"></i>
                            Générer Rapport
                        </button>
                        <button class="btn btn-success btn-block">
                            <i class="fas fa-envelope"></i>
                            Envoyer Message
                        </button>
                    </div>
                </div> -->
            </div>

            <!-- Schedule Table -->
            <div class="card">
                <div class="card-header">
                    <h3>Emploi du Temps - Aujourd'hui</h3>
                    <a href="#">Voir Calendrier →</a>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Heure</th>
                                <th>Cours</th>
                                <th>Enseignant</th>
                                <th>Salle</th>
                                <th>Étudiants</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>08:00 - 09:30</strong></td>
                                <td>Mathématiques</td>
                                <td>Dr. Hassan Mohamed</td>
                                <td>Salle 101</td>
                                <td>35</td>
                            </tr>
                            <tr>
                                <td><strong>09:45 - 11:15</strong></td>
                                <td>Physique</td>
                                <td>Pr. Fatima Noor</td>
                                <td>Salle 202</td>
                                <td>32</td>
                            </tr>
                            <tr>
                                <td><strong>11:30 - 13:00</strong></td>
                                <td>Français</td>
                                <td>Mme Sophie Martin</td>
                                <td>Salle 103</td>
                                <td>28</td>
                            </tr>
                            <tr>
                                <td><strong>14:00 - 15:30</strong></td>
                                <td>Informatique</td>
                                <td>Eng. Ahmed Karim</td>
                                <td>Laboratoire 1</td>
                                <td>25</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Menu items click handler
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', (e) => {
                if (!item.getAttribute('href').includes('.php')) {
                    e.preventDefault();
                    document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                }
            });
        });

        // Sidebar toggle for mobile (if needed)
        const sidebar = document.getElementById('sidebar');

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !e.target.classList.contains('menu-toggle')) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>
</body>
</html>
