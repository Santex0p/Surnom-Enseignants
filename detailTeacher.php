<?php 
session_start();
include("Database.php");
include("./utils.php");
$db = new Database();

// To have $teacher in table format
$teacher = $db->getOneTeacher($_GET["idTeacher"]);

var_dump($teacher);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./css/style.css" rel="stylesheet">
    <title>Version statique de l'application des surnoms</title>
</head>

<body>

    <header>
        <div class="container-header">
            <div class="titre-header">
                <h1>Surnom des enseignants</h1>
            </div>
            <div class="login-container">
                <form action="#" method="post">
                    <label for="user"> </label>
                    <input type="text" name="user" id="user" placeholder="Login">
                    <label for="password"> </label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe">
                    <button type="submit" class="btn btn-login">Se connecter</button>
                </form>
            </div>
        </div>
        <nav>
            <h2>Zone pour le menu</h2>
            <a href="index.php">Accueil</a>
            <?php if(getConnectedUser()['logRole'] === 'admin'){?>
            <a href="addTeacher.php">Ajouter un enseignant</a>
            <?php }?>
        </nav>
    </header>

    <div class="container">
        <div class="user-head">
            <h3>
            <?php 

                echo "Détail : " . $teacher['teaFirstname'] . " " . $teacher['teaName'] . " ";
                if($teacher['teaGender'] == "M")
                {
                ?>
                <img style="margin-left: 1vw;" height="20em" src="./img/male.png" alt="male symbole">
                <?php
                }
                elseif($teacher['teaGender'] == "F")
                { 
                ?>
                <img style="margin-left: 1vw;" height="20em" src="./img/femelle.png" alt="femelle symbole">
                <?php
                }
                elseif($teacher['teaGender'] == "A") 
                {
                ?>
                <img style="margin-left: 1vw;" height="20em" src="./img/autre.png" alt="autre symbole">
                <?php
                }
                ?>
            </h3>
            <p>
                <?= $db->getOneSection($teacher['fkSection'])["secName"]; ?>
            </p>
            <?php
            if (getConnectedUser()['logRole'] === 'admin'){
            ?>
            <div class="actions">
                <a href="updateTeacher.php?idTeacher=<?php echo $teacher['idTeacher']?>">
                    <img height="20em" src="./img/edit.png" alt="edit icon"></a>
                <a href="checkTeacher.php?idTeacher=<?php echo $teacher['idTeacher']?>&action=delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'enseignant<?php echo " " . $teacher['teaName'] . " "; ?>');">
                    <img height="20em" src="./img/delete.png" alt="delete icon"> </a>
            </div>
            <?php } ?>
        </div>
        <div class="user-body">
            <div class="left">
                <?php 
                    echo "<p>Surnom : " . $teacher['teaNickname'] . " </p>";
                    if($teacher['teaOrigine'] != " ")
                    {
                        echo "<p>". $teacher['teaOrigine'] ."</p>";
                    }
                    else
                    {
                        echo "No info";
                    }
                ?>
            </div>
        </div>
        <div class="user-footer">
            <a href="index.php">Retour à la page d'accueil</a>
        </div>

    </div>

    <footer>
        <p>Copyright GCR - bulle web-db - 2022</p>
    </footer>

    <!-- <script src="js/script.js"></script> -->

</body>

</html>