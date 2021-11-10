<?php
//  verifie si le $_POST n'est pas vide 
// renvoie sur la meme page et déclare une variable avec un message d'érreur, si l'un des change est vide ou négatif 
// si tout les chanmps sont renseignés renseigne la route 
var_dump($_POST);
if( $_POST["students"]<1 && $_POST["grades"] <1 ){
    header('Location: index.php?erreur=1');
    exit();
} 

$grades = [[10, 13, 12.5],[15, 15, 15],[20, 0, 15]];
$language = "php";
$class_average;
//creat and open a file 
$fichier = fopen("moyenne.txt","c+b");
//additionne les notes par tableau 
//renvoie la sum 
function sum($array){
    $sum=0;
    foreach( $array as $grade){
        $sum += $grade;
    }
    return $sum;
}

//calcule la moyenne par tableau avec la somme et la longueur de tableau 
//vérifi si le tableau est vide 
//renvoie la moyenne par entrée
function average($array){
    $sum_grade = sum($array);
    if(count($array)==0){
        $average_per_student = 0;
    }else{
        $average_per_student = $sum_grade / count($array);
    }
    return $average_per_student;  
}
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
         <!-- genère un formulaire pour chaque etudiant avec le nombre de note précédement renseigné
        récupere le nom de l'étudiant
        récupere les notes de chaque étudiant  -->
         <form action="#" method="get">
            <?php for($i=0; $i < (int) $_POST["students"]; $i++):?>
                <label for="name<?=$i ?>">Nom</label>
                <input type="text" name="name<?=$i ?>" id="name<?=$i ?>">
                <?php for($j=1; $j <= (int) $_POST["grades"]; $j++): ?>
                    <label for="grade<?=$j ?>">Note<?=$j ?></label> 
                    <input type="number" name="grade<?=$j?>" id="grade<?=$j?>">
                <?php endfor; ?>
            <?php endfor;?>
            <input type="submit" value="Envoyer">
        </form>

<!-- affiche les notes saisie par élève-->
        <?php foreach($grades as $key=>$grade): ?>
            <p>Eleve <?= $key+1 ?></p>
            <?php foreach($grade as $note): ?>
                <p> <?= $note; ?> </p>
            <?php endforeach;?>
        <?php endforeach;?>

<!-- affiche les moyennes par élève et écrit dans un fichier les résultats-->
        <?php foreach($grades as $key_student => $student): ?>
            <?php $class_average[] = round(average($student), 2)?>
            <p>Moyenne de l'élève  <?= $student_result = $key_student+1 . ": " . round(average($student), 2) ;?></p>
            <?php fwrite($fichier, "Moyenne de l'élève: $student_result  \n"); ?>
        <?php endforeach;?>

<!-- affiche la moyenne de la classe et écrit dans un fichier le résultat-->
    <p>Moyenne de la classe: <?=  $class_result = round(average($class_average), 2) ;?></p>
        <?php fwrite($fichier, "Moyenne de la classe: $class_result \n"); ?>
    </main>
</body>
</html>