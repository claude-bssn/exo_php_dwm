<?php 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <?php if (isset($_GET["erreur"]) && $_GET["erreur"]==1):?>
            <span class="erreur">
                les valeurs ne peuvent pas être nules ou négatives !
            </span>
        <?php endif; ?>
        <!--formulaire demandant le nombre d'étudiant et le nombre de note par étudiant 
            vérifie si les valeur renseignées ne sont pas égale a 0
            si 0 ou negatives -> message erreur
            si valeur positive renseignée ->  
            renvoie sur la page suivante apres validation du formulaire -->
        <form action="grades.php" method="post">
        <div>
            <div>
                <label for="students">Nombre d'élèves*</label>
                <input type="number" name="students" id="students" min="0" value="3">
            </div>
            <div>
                <label for="grades">Nombre de notes par élève*</label>
                <input type="number" name="grades" id="grades" min="0" value="4">
            </div>
            <span>* Ne peut pas etre vide ou négatif </span>
        </div>
          <input type="submit" value="Valider">
        </form>

    </main>

    
   
</body>
</html>