

<?php
    error_reporting(E_ALL); ini_set("display_errors",1);

    require_once ("../modele/conducteurDAO.class.php");
    require_once ("../modele/conducteur.class.php");

    $conducteurDAO = new ConducteurDAO();
    $conducteur = $conducteurDAO->getByNum($_SESSION['id']);
    $prenom = $conducteur->getPrenom();
    ?>

    <header>
    <div class="entete">


    <div class="compte">
        <img class="icon" src="../vue/style/account.png" alt="account.png">
        <?= "<label class='prenom'>Bonjour ".$prenom." !</label>"; ?>
    </div>
    <div class="title">
        <h1>Gestion d'infractions</h1>
    </div>
    <div class="deco">
        <form action="../controleur/login.php" method="post">
        <input class="disconnect" type="submit" name="deconnexion" value="Déconnexion">
        </form>

        <?php
        
        if(isset($_POST['disconnect'])){
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]);
               }
               session_unset();
               session_destroy();   
            }
        
        ?>

    </div>
    </div>
    </header>
    





