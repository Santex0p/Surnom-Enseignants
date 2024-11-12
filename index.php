<?php 
session_start();

include("Database.php");
include("./utils.php");
$db = new Database();

$teachers = $db->getAllTeachers();

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
            <?php if (isUserconnected()) {
                ?> 
                    <div class="login-container">
                        <form action="checkTeacher.php" method="post">
                            <p><?= getConnectedUser()["logUser"] . "("  . getConnectedUser()["logRole"] . ")"; ?></p>
                            <input type="hidden" name="logout" value=<?= true; ?>>
                            <button type="submit" class="btn btn-logout">Se déconnecter</button>
                        </form>
                    </div><?php
            } else { ?>
            <div class="login-container">
                <form action="checkTeacher.php" method="post">
                    <label for="user"> </label>
                    <input type="text" name="user" id="user" placeholder="Login">
                    <label for="password"> </label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe">
                    <input type="hidden" name="login" value=<?= true; ?>>
                    <button type="submit" class="btn btn-login">Se connecter</button>
                </form>
            </div>
            <?php 
            }
            ?>
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
        <h3>Liste des enseignants</h3>
        <form action="#" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Surnom</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($teachers as $teacher){
                            echo "<tr>";
                            echo "<td>" . $teacher['teaName'] . "</td>";
                            echo "<td>" . $teacher['teaNickname'] . "</td>";
                        ?>
                        <td class="containerOptions">
                        <?php
                        if(getConnectedUser()['logRole'] === 'admin'){
                        ?>
                            <a href="updateTeacher.php?idTeacher=<?php echo $teacher['idTeacher']?>">
                                <img height="20em" src="./img/edit.png" alt="edit">
                            </a>
                            <!-- Delete action have variables in Get mode avoid having to create a new file php -->
                            <a href="checkTeacher.php?idTeacher=<?php echo $teacher['idTeacher']?>&action=delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'enseignant<?php echo " " . $teacher['teaName'] . " "; ?>');">
                                <img height="20em" src="./img/delete.png" alt="delete">
                            </a>
                            <?php } ?>
                            <a href="detailTeacher.php?idTeacher=<?php echo $teacher['idTeacher']?>">
                                <img height="20em" src="./img/detail.png" alt="detail">
                            </a>
                        </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>

    <footer>
        <p>Copyright GCR - bulle web-db - 2022</p>
    </footer>

</body>
</html>