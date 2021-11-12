<?php
//  verifie si le $_POST n'est pas vide 
// renvoie sur la meme page et déclare une variable avec un message d'érreur, si l'un des change est vide ou négatif 
// si tout les chanmps sont renseignés renseigne la route 

if( (int)$_POST["students"]<1 || (int)$_POST["grades"] <1 ){
    header('Location: index.php?erreur=1');
    exit();
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <main>
         <!-- genère un formulaire pour chaque etudiant avec le nombre de note précédement renseigné
        récupere le nom de l'étudiant
        récupere les notes de chaque étudiant  -->
         <form action="result.php" method="post">
            <?php for($i=0; $i < (int) $_POST["students"]; $i++):?>
                <div>
                   <label for="name[<?=$i ?>]">Nom</label>
                    <input type="text" name="name[<?=$i ?>]" id="name<?=$i ?>">
                    <?php for($j=1; $j <= (int) $_POST["grades"]; $j++): ?>
                        <label for="grade[<?= $i?>][<?= $j-1?>]">Note<?=$j?></label> 
                        <input type="number" step="0.01" name="grade[<?= $i?>][<?= $j-1?>]" id="grade<?=$j?>">
                    <?php endfor; ?> 
                </div>
            <?php endfor;?>
            <input type="submit" value="Envoyer">
        </form>
    </main>
</body>
</html>