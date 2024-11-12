<?php 

function isUserconnected() {
    return isset($_SESSION["user"]) && count($_SESSION["user"])> 1;
}

function getConnectedUser() {
    if (isUserconnected()) {
        return $_SESSION["user"];
    }
}

?>