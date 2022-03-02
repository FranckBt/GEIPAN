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
                $html .= "<li>Effacer<input type='submit' value=$id name='effacer' /></li>";
                $html .= "<hr>";
            }
            $html .= "</form>";

            echo $html;

    }
    catch(PDOException $e){
    die("Erreur : " . $e->getMessage());
    }
    $conn= null;

    
        $serverName = "localhost";
        $userName = "root";
        $database = "geipan";
        $userPassword = "";
$del=$_POST[0];
var_dump($del);
        try {
            $conn = new PDO("mysql:host=$serverName;dbname=$database", $userName, $userPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $query = $conn->prepare("
                DELETE FROM `users` WHERE `users`.`id_user`= $del
                ");
                $query->execute();
                echo "<p>User suprimé</p>";
                echo("<meta http-equiv='refresh' content='1'>");

        } catch (PDOException $e) {
            die("Erreur :  " . $e->getMessage());
        }
    
}else{   
    
    echo "<p>Vous ne disposez des droits nécessaires</p>";

}
