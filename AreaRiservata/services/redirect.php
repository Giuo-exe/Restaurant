<?php
echo ciao;
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'cart':
                cart();
                break;
            case 'select':
                select();
                break;
        }
    }

    function select() {
        echo "The select function is called.";
        exit;
    }

    function insert() {
        echo "The insert function is called.";
        exit;
    }

    function cart(){
      header("Location: cart.php");
      exit;
    }
?>
