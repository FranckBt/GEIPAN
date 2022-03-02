<h1>GEIPAN</h1>
<p id="msg">Nos derniers témoignages :</p>


<?php      
    $serverName = "localhost";
    $userName = "root";
    $database = "geipan";
    $userPassword = "";

try{
        $conn = new PDO("mysql:host=$serverName;dbname=$database", $userName, $userPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = $conn->prepare("SELECT * FROM observations ORDER BY obsDateTime ASC");
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

        $html = "<ul>";

        for($i = 0 ; $i < 5 ; $i++) {
            $dateOB = $resultat[$i]['obsDateTime'];
            $tempsOB = $resultat[$i]['obsDuration'];
            $lieu = $resultat[$i]['obsLocation'];
            $direction = $resultat[$i]['obsCardinalPoint'];
            $description = $resultat[$i]['obsDescription'];

            $html .="<li>$dateOB</li>";
            $html .="<li>temps de l'observation : $tempsOB</li>";
            $html .= "<li>Lieu : $lieu /direction: $direction </li>";
            $html .= "<li>Description: $description </li>";
            $html .= "<hr>";
        }
        $html .= "</lu>";

        echo $html;

}
catch(PDOException $e){
die("Erreur : " . $e->getMessage());
}
$conn= null;
            

