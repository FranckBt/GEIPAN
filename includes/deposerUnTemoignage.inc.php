<h2> Deposer un témoignage : </h2>
<p id="msg">(Si vous n'ête pas <a href="http://localhost/geipan/index.php?page=inscription">inscrit</a> , vous ne pouvez déposer qu'un témoignage par adresse mail.)</p>

<?php

if (isset($_POST['temoignage'])) {
    $email2 = trim(mb_strtolower($_POST['email2'])) ?? '';
    $dateH = $_POST['DTevent'] ?? '';
    $dureeEvent = htmlentities($_POST['dureeEvent']) ?? '';
    $departement = htmlentities(ucfirst(mb_strtolower(trim($_POST['dep'])))) ?? '';
    $card = htmlentities($_POST['cardPoint']) ?? '';
    $meteo = htmlentities($_POST['condMeteo']) ?? '';
    $description = htmlentities($_POST['desEvent']) ?? '';
    $role = 1;

    $erreur = array();

    if (!filter_var($email2, FILTER_VALIDATE_EMAIL))
        array_push($erreur, "Veuillez saisir un e-mail valide");

    if (strlen($dateH) === 0)
        array_push($erreur, "Veuillez saisir une date et une heure");

    if (strlen($dureeEvent) === 0)
        array_push($erreur, "Veuillez saisir la durée de l'événement");

    if (strlen($description) === 0)
        array_push($erreur, "Veuillez saisir une description");

    if (count($erreur) === 0) {
        $serverName = "localhost";
        $userName = "root";
        $database = "geipan";
        $userPassword = "";
        try {
            $conn = new PDO("mysql:host=$serverName;dbname=$database", $userName, $userPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $requete = $conn->prepare("SELECT * FROM users WHERE userMail='$email2'");
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_OBJ);

            if (count($resultat) !== 0 && $_SESSION['role']<1) {
                echo "<p>Votre adresse est déjà enregistrée veuillez vous <a href='http://localhost/geipan/index.php?page=inscription'>inscrire</a> / vous <a href='http://localhost/geipan/index.php?page=login'>connecter</a></p>";
            
            } if ($_SESSION = null) {

                $query = $conn->prepare("
                INSERT INTO users(userMail, id_role)
                VALUES (:email, :role)");

                $query->bindParam(':email', $email2, PDO::PARAM_STR_CHAR);
                $query->bindParam('role', $role, PDO::PARAM_STR_CHAR);

                echo "<p>Email enregistré pensez à vous <a href='http://localhost/geipan/index.php?page=inscription'>inscrire</a> la prochaine fois </p>";
                $query->execute();
            
                $query2 = $conn->prepare("
                INSERT INTO observations(obsDateTime, obsDuration, obsLocation, obsCardinalPoint, obsWeather, obsDescription)
                VALUES ('$dateH','$dureeEvent','$departement','$card', '$meteo', '$description')
                ");
                $query2->execute();
           } else{
            $query2 = $conn->prepare("
            INSERT INTO observations(obsDateTime, obsDuration, obsLocation, obsCardinalPoint, obsWeather, obsDescription)
            VALUES ('$dateH','$dureeEvent','$departement','$card', '$meteo', '$description')
            ");
            $query2->execute();
           }
        }catch (PDOException $e) {
            die("Erreur :  " . $e->getMessage());
        }

        $conn = null;
    } else {
       
        $messageErreur = "<ul>";
        $i = 0;
        do {
            $messageErreur .= "<li>" . $erreur[$i] . "</li>";
            $i++;
        } while ($i < count($erreur));

        $messageErreur .= "</ul>";

        echo $messageErreur;
        include 'form_temoignage.php';
    }
} else {
    echo "<h2>Merci de renseigner le formulaire&nbsp;:</h2>";
    $name = $firstname = $email = $pseudo = '';
    include 'form_temoignage.php';
}
