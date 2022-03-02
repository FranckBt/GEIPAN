<form action="index.php?page=deposerUnTemoignage" method="post">
    <ul>
        <li><label for="email2">e-mail :</label><input type="text" id="email2" name="email2" /></li>
        <li><label for="dateEvent">Date et heure de l'événement</label><input type="datetime-local" id="DTevent" name="DTevent" /> </li>
        <li><label for="dureeEvent">Durée de l'événement: </label><input type="time" id="dureeEvent" name="dureeEvent" /></li>
        <li><label for="depEvent">Département de l'événement :</label></li><select name="dep" id="dep">
            <?php
                $fichier = file('./_datas/departements.csv');
                for($i = 1; $i<count($fichier) ;$i++){
                    $aff="<option value=";
                    $aff.=$fichier[$i];
                    $aff.= ">";
                    $aff.=$fichier[$i];
                    $aff.= "</option>";
                    echo $aff;
                }
            ?>
        </select>
        <li><label for="cardEvent">Direction observation :</label></li><select name="cardPoint" id="cardPoint">
                <option value="nord">Nord</option>
                <option value="nord_est">Nord-Est</option>
                <option value="nord_ouest">Nord-Ouest</option>
                <option value="sud">Sud</option>
                <option value="sud_est">Sud-Est</option>
                <option value="sud_ouest">Sud-Ouest</option>
                <option value="est">Est</option>
                <option value="ouest">Ouest</option>
        </select>
        <li><label for="conditionMeteo">Conditions météorologiques (de 1 à 8 ) :</label><select name="condMeteo" id="condMeteo">
                <option value="1">1 (Aucun nuage)</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8 (aucune visu de ciel)</option>
            </select></li>
        <li><label for="descriptionEvent">Description de l'observation :</label><input type="text" id="desEvnet" name="desEvent" /></li>
        <li><input type="reset" value="Effacer" /><input type="submit" value="Envoyer" name="temoignage" /></li>
    </ul>
</form>