<?php 

include("Database.php");
$db = new Database();

$sections = $db->getAllSections();
$teacher = $db->getOneTeacher($_GET["idTeacher"]);
$currentSection = $db->getOneSection($teacher['fkSection']);

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
                <form action="addTeacher.php" method="post">
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
            <a href="addTeacher.html">Ajouter un enseignant</a>
        </nav>
    </header>

    <div class="container">
        <div class="user-body">
            <form action="checkTeacher.php" method="post" id="form">
                <h3>Mise à jour d'un enseignant</h3>
                <p>
                    <!-- "if" shortcut where (condition) ? 'if_condition' : 'not_condition'. -->
                    <input type="radio" id="genre1" name="genre" value="M" <?php echo ($teacher['teaGender'] == "M") ?  'checked' : ' ' ;?>>
                    <label for="genre1">Homme</label>
                    <input type="radio" id="genre2" name="genre" value="F" <?php echo ($teacher['teaGender'] == "F") ?  'checked' : ' ' ;?>>
                    <label for="genre2">Femme</label>
                    <input type="radio" id="genre3" name="genre" value="A" <?php echo ($teacher['teaGender'] == "A") ?  'checked' : ' ' ;?>>
                    <label for="genre3">Autre</label>
                </p>
                <p>
                    <label for="name">Nom :</label>
                    <input type="text" name="name" id="name" value="<?php echo $teacher['teaName']?>" required minlength="5" maxlength="50">
                </p>
                <p>
                    <label for="firstName">Prénom :</label>
                    <input type="text" name="firstName" id="firstName" value="<?php echo $teacher['teaFirstname'] ?>" required minlength="5" maxlength="50">
                </p>
                <p>
                    <label for="nickName">Surnom :</label>
                    <input type="text" name="nickName" id="nickName" value="<?php echo $teacher['teaNickname'] ?>" required minlength="5" maxlength="50">
                </p>
                <p>
                    <label for="origin">Origine :</label>
                    <textarea name="origin" id="origin" required minlength="5" maxlength="50" ><?php echo $teacher['teaOrigine'] ?></textarea>
                </p>
                <p>
                    <label style="display: none" for="section"></label>
                    <select name="section" id="section">
                        
                        <option value="<?= $currentSection["idSection"] ?>" selected><?php echo $currentSection["secName"] ?></option>
                        <!-- To have section in dynamique list -->
                        <?php
                        $html = '';
                        foreach($sections as $section) {
                            if($section['idSection'] != $currentSection["idSection"]) // Avoid using the section that is already instantiated
                            {
                            $html .= "<option value='" . $section["idSection"] . "'>" . $section["secName"] . "</option>";
                            }
                        }
                        echo $html;
                        ?>
                    </select>
                    
                </p>
                <p>
                    <input type="hidden" name="action" value ="update">
                    <input type="hidden" name="idTeacher" value = "<?php echo $teacher['idTeacher']?>">
                    <input type="submit" value="Mettre à Jour">
                    <button type="button" onclick="document.getElementById('form').reset();">Effacer</button>
                <?php   
                    //echo "<pre>";
                    //var_dump($teacher);
                    //echo "</pre>";?>
                </p>
            </form>
        </div>
        <div class="user-footer">
            <a href="index.php">Retour à la page d'accueil</a>
        </div>
    </div>

    <footer>
        <p>Copyright GCR - bulle web-db - 2022</p>
    </footer>

</body>

</html>