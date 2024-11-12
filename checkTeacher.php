<?php 

session_start();

include("Database.php");
$db = new Database();

$userLogged = false;
if($_POST['login'] === '1') // If user attemp to login
{
    echo 'attemp.. ';
    
    $isUserFound = $db->loginAttemp($_POST);
    if($isUserFound)
    {
        $_SESSION["user"] = $isUserFound;
    }
}
else if($_POST['logout'] === '1') // If user attemp to logout
{
    session_destroy();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        <h1>Validation</h1>
        <?php 
        // To pass GET values of delete action to post
        if($_SERVER['REQUEST_METHOD'] === 'GET'){$_POST['action'] = $_GET['action']; $_POST['idTeacher'] = $_GET['idTeacher'];}

        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";

        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'delete':
                    echo 'delete';
                    $db->delTeacher($_POST['idTeacher']);
                    break;
                
                case 'add':
                    echo 'insert';
                    $db->insertTeacher($_POST);
                    break;
        
                case 'update':
                    echo 'update';
                    $db->editTeacher($_POST);
                    break;
        
                default:
                    echo 'No action specified';
                    break;
            }
        }


            header("Location: index.php");
            exit;
        ?>
    </body>
</html>