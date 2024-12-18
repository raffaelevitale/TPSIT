<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($username == 'utente1' && $password == 'password1') {
        $_SESSION['userType'] = 1;
        $_SESSION['username'] = $username;
        header('Location: home.php');
        exit();
    } elseif ($username == 'utente2' && $password == 'password2') {
        $_SESSION['userType'] = 2;
        $_SESSION['username'] = $username;
        header('Location: home.php');
        exit();
    } else {
        $error = 'Credenziali non valide';
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login - Servizio Treni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2><i class="fas fa-train mb-4"></i> Accesso</h2>
            <?php if($error): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="username" placeholder="Nome utente" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-sign-in-alt"></i> Accedi
                </button>
            </form>
            <div class="mt-3">
                <small class="text-muted">
                    Demo: utente1/password1 (solo consultazione)<br>
                    utente2/password2 (consultazione e prenotazione)
                </small>
            </div>
        </div>
    </div>
</body>
</html>