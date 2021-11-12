<?php 
// inclue le fichier de connection a la BDD
include_once './pdo_connection.php';

$grades = $_POST;
$class_average;
$index_student = 0;
$date = date('d-m-y-his');

//crée et ouvre un fichier .txt comprenant un timestamp pour indentifier les fichiers
$fichier = fopen("moyenne.txt $date","c+b");
//additionne les notes par tableau 
//renvoie la somme
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

// enregistre les notes par étudiant en basse de donnée 
// prends une requete SQL et l'execute  

function save_grades($pdo, $student_data, $grades_data){
    $sql ="
        INSERT INTO grades (name, grade_list)
        VALUE (:name, :grade_list);
    ";

    $stmt = $pdo->prepare($sql);
    try{
        return $stmt->execute(
            [
                'name' => $student_data,
                'grade_list' => json_encode($grades_data)
            ]

            );
    }catch (Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
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
        <!-- affiche les notes saisie par élève-->
        <?php foreach($grades["grade"] as $grade): ?>
            <p>Eleve <?= $grades["name"][$index_student] ?></p>
            <?php save_grades($pdo, $grades["name"][$index_student], $grade)?>
            <?php $index_student += 1;  ?>
            <?php foreach($grade as $note): ?>
                <p> <?= $note; ?> </p>
            <?php endforeach;?>
        <?php endforeach;?>

<!-- affiche les moyennes par élève et écrit dans un fichier les résultats-->
        <?php foreach($grades["grade"] as $key_student => $student): ?>
            <?php $class_average[] = round(average($student), 2)?>
            <p>Moyenne de l'élève  <?= $student_result = $grades["name"][$key_student] . ": " . round(average($student), 2) ;?></p>
            <?php fwrite($fichier, "Moyenne de l'élève: $student_result  \n"); ?>
        <?php endforeach;?>

<!-- affiche la moyenne de la classe et écrit dans un fichier le résultat-->
    <p>Moyenne de la classe: <?=  $class_result = round(average($class_average), 2) ;?></p>
        <?php fwrite($fichier, "Moyenne de la classe: $class_result \n"); ?>
    </main>
    
</body>
</html>