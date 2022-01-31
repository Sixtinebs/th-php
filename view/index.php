
<?php

if(isset($_GET['structure'])){
    include "structure.php";
}else if(isset($_GET['secteur'])){
    include "secteur.php";
}else {
    include "404.php";
}





