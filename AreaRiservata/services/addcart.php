<?php
if (isset($_POST['action'])) {
    $app = $_POST['action'];
    $_SESSION["carrello"].= "$app , ";
    echo "riuscito";
}

?>
