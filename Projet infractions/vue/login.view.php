<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../vue/style/style.css">
</head>
<body>
    <div class="container">
        <div class="box">
        <div class="titre">
            <h1>Connexion</h1>
        </div>
        
        <div class="item">
            <form action="../controleur/login.php" method="post">
            <label class="lib">Numéro de permis : </label> <br>
            <input class="login" type="text" name="permis" value="<?=$identifiant['permis']?>" > <br>

            <label class="lib">Mot de passe : </label> <br>
            <input class="login" type="password" name="mdp" value="<?=$identifiant['mdp']?>"> <br>
            <?php echo "<label class='mess'>" . $message . "</label>" ?> <br>
             
            <input class="connexion" type="submit" name="Se connecter" value="Se connecter">
            
        </form>
    </div>
</div>
</div>
</body>
</html>