<?php
// index.php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Simulazione autenticazione utenti
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simulazione tipi di utenti
    // Tipo 1: consulta solo
    // Tipo 2: consulta e prenota
    // In un caso reale, questi dati verrebbero presi da un database

    if ($username == 'utente1' && $password == 'password1') {
        $_SESSION['user_type'] = 1;
        //header di PHP/home.php
        header('Location: home.php');
        exit();
    } elseif ($username == 'utente2' && $password == 'password2') {
        $_SESSION['user_type'] = 2;
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
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Accedi</button>
        </form>
    </div>
</body>
</html>