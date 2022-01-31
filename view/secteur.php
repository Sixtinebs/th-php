
<?php
require_once 'header.php';
use crud\Crud;
use entities\Secteur;

require '../model/Secteur.php';
require '../controller/Crud.php';
$list = new Crud();

$query = $list->findAll('secteur');

$secteurs = [];
foreach ($query as $element){
    $secteurs[] = new Secteur($element['ID'],$element['LIBELLE']);
}

?>
<h1>Les Secteurs</h1>
<?php

foreach($secteurs as $secteur){ ?>
    <form method="get" action="onSecteur.php">
        <a><?= $secteur->getLibelle();?></a>
        <input type="hidden" name="id" value="<?= $secteur->getId();?>">
        <input type="submit" value="Modifier">
        <input type="submit" value="supprimer" name="supprimer" >
    </form>
<?php } ?>

<form method="post" action="">
    <table>
        <tr><td>Libelle</td><td><input required type="text" name="LIBELLE" value=""></td></tr>
    </table>
    <input type="submit" value="Ajouter">

</form>
<?php
if(!empty($_POST)) {


    $query = 'INSERT INTO `secteur` (`LIBELLE`) VALUES(:LIBELLE)';
    $createSecteur = $list->create($_POST, $query);
    echo $createSecteur;
    $secteurs = $list->findAll('secteur');
}

require_once 'footer.php' ?>
