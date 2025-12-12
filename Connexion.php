<?php 
include_once("DB.php");

// Initialisation des variables d'erreur
$emailError = '';
$passwordError = '';
$generalError = '';
session_start();

if(isset($_POST['Connecte'])){
    // Récupération et nettoyage des données
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    
    // Validation des champs
    $hasError = false;
    
    if(empty($email)){
        $emailError = 'L\'adresse email est obligatoire';
        $hasError = true;
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailError = 'Veuillez entrer une adresse email valide';
        $hasError = true;
    }
    
    if(empty($password)){
        $passwordError = 'Le mot de passe est obligatoire';
        $hasError = true;
    } elseif(strlen($password) < 6){
        $passwordError = 'Le mot de passe doit contenir au moins 6 caractères';
        $hasError = true;
    }
    
    // Si pas d'erreur de validation, vérifier la connexion
    if(!$hasError){
        $sql=DB::select_data("SELECT Connexion('$email', '$password') AS user_info");
        
        if($sql->rowCount()>0){
            $row=$sql->fetch();
            $user_info = $row['user_info'];
            $parts = explode('|', $user_info);
            $user_id = $parts[0];
            $role = $parts[1];
            if($role=='Etudiant'){
                $_SESSION['ROLE']=$role;
                $_SESSION['USER_ID']=$user_id;
                header("Location:Dashboard.php");
                exit();
            }
            elseif($role=='Admin'){
                $_SESSION['ROLE']=$role;
                $_SESSION['USER_ID']=$user_id;
                header("Location:Admindash.php");
                exit();
            }
            else{
                $generalError = 'Échec de la connexion. Utilisateur  non trouvé.';
            }
        } else {
            $generalError = 'Échec de la connexion. Veuillez vérifier vos identifiants.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Scholaria</title>
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
            --error-color: #e74c3c;
            --warning-color: #f39c12;
            --success-color: #27ae60;
            --shadow: 0 10px 30px rgba(26, 58, 82, 0.15);
            --shadow-sm: 0 4px 12px rgba(26, 58, 82, 0.08);
            --border-radius: 15px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Styles existants... */

        /* Styles pour les messages d'erreur */
        .error-message {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 8px;
            padding: 8px 12px;
            background-color: rgba(231, 76, 60, 0.08);
            border-radius: 8px;
            border-left: 3px solid var(--error-color);
            display: flex;
            align-items: center;
            gap: 8px;
            animation: fadeIn 0.3s ease-out;
        }

        .error-message i {
            font-size: 0.9rem;
        }

        .general-error {
            background-color: rgba(231, 76, 60, 0.1);
            border: 1px solid var(--error-color);
            color: var(--error-color);
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: fadeIn 0.3s ease-out;
        }

        .general-error i {
            font-size: 1.2rem;
        }

        .input-with-icon.has-error {
            border-color: var(--error-color) !important;
        }

        .input-with-icon.has-error i {
            color: var(--error-color);
        }

        .form-control.has-error {
            border-color: var(--error-color);
            background-color: rgba(231, 76, 60, 0.02);
        }

        .form-control.has-error:focus {
            box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.1);
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Autres styles existants... */
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
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 1100px;
            min-height: 650px;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        /* Left side - Branding */
        .login-branding {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-blue) 50%, var(--teal-light) 100%);
            color: white;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-branding::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 1;
        }

        .login-branding::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -30%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 1;
        }

        .branding-content {
            position: relative;
            z-index: 2;
        }

        .logo-image {
            width: 180px;
            height: 180px;
            margin-bottom: 30px;
            object-fit: contain;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2));
        }

        .logo-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--white);
            letter-spacing: -0.5px;
        }

        .logo-tagline {
            font-size: 0.95rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 40px;
            letter-spacing: 1px;
        }

        .branding-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 40px;
        }

        .features-list {
            list-style: none;
            text-align: left;
            display: inline-block;
        }

        .features-list li {
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
        }

        .features-list i {
            color: var(--gold-accent);
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        /* Right side - Login Form */
        .login-form-container {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(180deg, rgba(245, 248, 251, 0.5) 0%, rgba(255, 255, 255, 0) 100%);
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 10px;
        }

        .form-subtitle {
            color: var(--gray-dark);
            font-size: 0.95rem;
        }

        .login-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 28px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-with-icon {
            position: relative;
            border: 2px solid var(--gray-light);
            border-radius: 10px;
            transition: var(--transition);
        }

        .input-with-icon i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--teal-light);
            font-size: 1.1rem;
            z-index: 2;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 50px;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            transition: var(--transition);
            background-color: transparent;
            color: var(--gray-dark);
            position: relative;
            z-index: 1;
        }

        .form-control::placeholder {
            color: #b0bcc4;
        }

        .form-control:focus {
            outline: none;
            background-color: transparent;
        }

        .input-with-icon:focus-within {
            border-color: var(--teal-light);
            box-shadow: 0 0 0 4px rgba(26, 188, 156, 0.08);
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-dark);
            cursor: pointer;
            font-size: 1rem;
            transition: var(--transition);
            z-index: 2;
        }

        .password-toggle:hover {
            color: var(--teal-light);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray-dark);
        }

        .remember-me input[type="checkbox"] {
            accent-color: var(--teal-light);
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .forgot-password {
            color: var(--teal-light);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .forgot-password:hover {
            color: var(--teal-dark);
            text-decoration: underline;
        }

        .btn {
            padding: 14px 20px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--teal-light) 0%, var(--teal-dark) 100%);
            color: white;
            margin-bottom: 20px;
            font-size: 1rem;
            box-shadow: var(--shadow-sm);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .back-to-home {
            position: absolute;
            top: 30px;
            left: 30px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 10;
            transition: var(--transition);
            font-weight: 500;
        }

        .back-to-home:hover {
            color: white;
            transform: translateX(-5px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
            }

            .login-branding {
                padding: 40px 30px;
            }

            .login-form-container {
                padding: 40px 30px;
            }

            .back-to-home {
                top: 20px;
                left: 20px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .login-branding, .login-form-container {
                padding: 30px 20px;
            }

            .branding-title, .form-title {
                font-size: 1.5rem;
            }

            .logo {
                font-size: 1.7rem;
            }
        }

        /* Animation for form */
        .login-form-container {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left side - Branding -->
        <div class="login-branding">
            <a href="index.html" class="back-to-home">
                <i class="fas fa-arrow-left"></i> Retour à l'accueil
            </a>
            
            <div class="branding-content">
                <img src="logoBG.png" alt="Scholaria" class="logo-image">
                <h2 class="logo-title">Scholaria</h2>
                <p class="logo-tagline">Plateforme de Gestion Éducative</p>
                <p class="branding-description">
                    Connectez-vous à votre espace pour gérer vos étudiants, emplois du temps et ressources pédagogiques en toute simplicité.
                </p>
                
                <ul class="features-list">
                    <li><i class="fas fa-check-circle"></i> Gestion centralisée des étudiants</li>
                    <li><i class="fas fa-check-circle"></i> Emploi du temps intelligent</li>
                    <li><i class="fas fa-check-circle"></i> Suivi des notes et évaluations</li>
                    <li><i class="fas fa-check-circle"></i> Communication simplifiée</li>
                </ul>
            </div>
        </div>
        
        <!-- Right side - Login Form -->
        <div class="login-form-container">
            <div class="form-header">
                <h2 class="form-title">Connexion à votre compte</h2>
                <p class="form-subtitle">Entrez vos identifiants pour accéder à votre espace</p>
            </div>
            
            <form class="login-form" id="loginForm" action="" method="POST">
                <?php if(!empty($generalError)): ?>
                    <div class="general-error shake">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span><?php echo $generalError; ?></span>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label class="form-label" for="email">Adresse email</label>
                    <div class="input-with-icon <?php echo !empty($emailError) ? 'has-error shake' : ''; ?>">
                        <i class="fas fa-envelope"></i>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-control <?php echo !empty($emailError) ? 'has-error' : ''; ?>" 
                               placeholder="votre@email.com" 
                               value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"
                               required>
                    </div>
                    <?php if(!empty($emailError)): ?>
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $emailError; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">Mot de passe</label>
                    <div class="input-with-icon <?php echo !empty($passwordError) ? 'has-error shake' : ''; ?>">
                        <i class="fas fa-lock"></i>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-control <?php echo !empty($passwordError) ? 'has-error' : ''; ?>" 
                               placeholder="Votre mot de passe" 
                               required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <?php if(!empty($passwordError)): ?>
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $passwordError; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Se souvenir de moi</label>
                    </div>
                    <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                </div>
                
                <input type="submit" class="btn btn-login" name="Connecte" value="Se connecter">
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle eye icon
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
        
        // Validation côté client
        const loginForm = document.getElementById('loginForm');
        
        loginForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validation de l'email
            const emailInput = document.getElementById('email');
            const emailValue = emailInput.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (!emailValue) {
                showError(emailInput, 'L\'adresse email est obligatoire');
                isValid = false;
            } else if (!emailRegex.test(emailValue)) {
                showError(emailInput, 'Veuillez entrer une adresse email valide');
                isValid = false;
            } else {
                removeError(emailInput);
            }
            
            // Validation du mot de passe
            const passwordInput = document.getElementById('password');
            const passwordValue = passwordInput.value.trim();
            
            if (!passwordValue) {
                showError(passwordInput, 'Le mot de passe est obligatoire');
                isValid = false;
            } else if (passwordValue.length < 6) {
                showError(passwordInput, 'Le mot de passe doit contenir au moins 6 caractères');
                isValid = false;
            } else {
                removeError(passwordInput);
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
        
        function showError(inputElement, message) {
            const parentDiv = inputElement.closest('.input-with-icon');
            parentDiv.classList.add('has-error', 'shake');
            
            // Supprimer les messages d'erreur existants
            let existingError = parentDiv.parentNode.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }
            
            // Ajouter le message d'erreur
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
            parentDiv.parentNode.appendChild(errorDiv);
            
            // Arrêter l'animation après son exécution
            setTimeout(() => {
                parentDiv.classList.remove('shake');
            }, 500);
        }
        
        function removeError(inputElement) {
            const parentDiv = inputElement.closest('.input-with-icon');
            parentDiv.classList.remove('has-error');
            
            // Supprimer le message d'erreur
            const errorDiv = parentDiv.parentNode.querySelector('.error-message');
            if (errorDiv) {
                errorDiv.remove();
            }
        }
        
        // Enlever l'erreur quand l'utilisateur commence à taper
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                if (this.classList.contains('has-error')) {
                    removeError(this);
                }
            });
        });
        
        // Forgot password link
        document.querySelector('.forgot-password').addEventListener('click', function(e) {
            e.preventDefault();
            alert('Une demande de réinitialisation de mot de passe sera envoyée à votre email. Cette fonctionnalité est en cours de développement.');
        });
    </script>
</body>
</html>