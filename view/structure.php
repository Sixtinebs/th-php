
<?php
require_once 'header.php';
use crud\Crud;
use entities\Structure;


require '../controller/Crud.php';
$list = new Crud();

$query = $list->findAll('structure');

$structures = [];
foreach ($query as $element){
    $structures[] = new Structure($element['ID'],$element['NOM'],$element['RUE'],$element['CP'],$element['VILLE'],$element['ESTASSO'],$element['NB_DONATEURS'],$element['NB_ACTIONNAIRES']);
}
?>
<h1>Les structures</h1>
<?php

foreach($structures as $structure){ ?>
    <form method="get" action="oneStructure.php">
        <a><?= $structure->getNom();?></a>
        <input type="hidden" name="id" value="<?= $structure->getId();?>">
        <input type="submit" value="Modifier">
        <input type="submit" value="supprimer" name="supprimer" >
    </form>
<?php } ?>

<form method="post" action="">
    <table>
        <tr><td>Nom</td><td><input required type="text" name="NOM" value=""></td></tr>
        <tr><td>rue</td><td><input required type="text" name="RUE" value=""></td></tr>
        <tr><td>cp</td><td><input required type="text" name="CP" value=""></td></tr>
        <tr><td>Ville</td><td><input required type="text" name="VILLE" value=""></td></tr>
        <tr><td>estasso</td><td><input required type="number" name="ESTASSO" value=""></td></tr>
        <tr><td>Nombre actionnaires</td><td><input  type="number" name="NB_ACTIONNAIRES" value=""></td></tr>
        <tr><td>Nombre donateurs</td><td><input type="number" name="NB_DONATEURS" value=""></td></tr>
    </table>
    <input type="submit" value="Ajouter">

</form>
<?php
if(!empty($_POST)) {
    $_POST['ESTASSO'] = intval($_POST['ESTASSO']);
    $_POST['NB_ACTIONNAIRES'] = $_POST['NB_ACTIONNAIRES'] !== "" ? intval($_POST['NB_ACTIONNAIRES']) : null;
    $_POST['NB_DONATEURS'] = $_POST['NB_DONATEURS'] !== "" ? intval($_POST['NB_DONATEURS']) : null;

    $query = 'INSERT INTO `structure` (`NOM`,`RUE`,`CP`,`VILLE`,`ESTASSO`,`NB_DONATEURS`,`NB_ACTIONNAIRES`) VALUES(:NOM, :RUE, :CP,:VILLE, :ESTASSO, :NB_DONATEURS, :NB_ACTIONNAIRES)';
    $createStructure = $list->create($_POST, $query);
    echo $createStructure;
    $structures = $list->findAll('structure');
}

 require_once 'footer.php' ?>
