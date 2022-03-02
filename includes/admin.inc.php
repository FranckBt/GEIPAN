<h2 id="msg">Suppression utilisateur :  </h2>

<?php
 if(isset($_SESSION['login']) && $_SESSION['login'] === true && $_SESSION['role']>2 ){
    $serverName = "localhost";
    $userName = "root";
    $database = "geipan";
    $userPassword = "";

    try{
            $conn = new PDO("mysql:host=$serverName;dbname=$database", $userName, $userPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $requete = $conn->prepare("SELECT * FROM users ORDER BY id_user ASC");
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

            $html = "<form action='index.php?page=admin' method='post'>";

            for($i = 0 ; $i < count($resultat) ; $i++) {
                $id = $resultat[$i]['id_user'];
                $nom = $resultat[$i]['userName'];
                $prenom = $resultat[$i]['userFirstname'];
                $mail = $resultat[$i]['userMail'];
                $role = $resultat[$i]['id_role'];

                $html .="<li>$id / ";
                $html .=" Nom : $nom / ";
                $html .= " Prenom: $prenom / ";
                $html .= " Mail :$mail / ";
                $html .= " Role :$role / ";
                $html .= "</li>";
                $html .= "<li><input type='submit' value='effacer' name='$id' /></li>";
                $html .= "<hr>";
            }
            $html .= "</form>";

            echo $html;

    }
    catch(PDOException $e){
    die("Erreur : " . $e->getMessage());
    }
    $conn= null;

    var_dump($_POST);
    
}else{   
    
    echo "<p>Vous ne disposez des droits nécessaires</p>";
    
}
