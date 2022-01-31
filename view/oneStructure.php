

<?php require_once 'header.php';
use crud\Crud;
use entities\Structure;

require '../controller/Crud.php';
$list = new Crud();
$id = $_GET['id'];
$query = 'SELECT * FROM `structure` WHERE ID=:ID';
$element = $list->findById($id, $query);
$structure = new Structure($element['ID'],$element['NOM'],$element['RUE'],$element['CP'],$element['VILLE'],$element['ESTASSO'],$element['NB_DONATEURS'],$element['NB_ACTIONNAIRES']);

if(isset($_GET['supprimer'])){
    echo 'ici';
    $table = 'structure';
    $delete = $list->delete($id, $table);
    echo $delete;
    header("Location: structure.php");
}
?>


<h1><?=  $structure->getNom()?></h1>

<form method="post" action="">
    <table>

        <tr><td></td><td><input required type="hidden" name="ID" value="<?=  $structure->getID()?>"></td></tr>
        <tr><td>Nom</td><td><input required type="text" name="NOM" value="<?= htmlspecialchars($structure->getNom())?>"></td></tr>
        <tr><td>rue</td><td><input required type="text" name="RUE" value="<?=   htmlspecialchars($structure->getRue())?>"></td></tr>
        <tr><td>cp</td><td><input required type="text" name="CP" value="<?=   htmlspecialchars($structure->getCp())?>"></td></tr>
        <tr><td>Ville</td><td><input required type="text" name="VILLE" value="<?=   htmlspecialchars($structure->getVille())?>"></td></tr>
        <tr><td>estasso</td><td><input required type="number" name="ESTASSO" value="<?= ($structure->getEstasso())?>"></td></tr>
        <?php if ($structure->getNbActionnaires() != null) { ?>
        <tr><td>Nombre actionnaires</td><td><input required type="number" name="NB_ACTIONNAIRES" value="<?=  $structure->getNbActionnaires()?>"></td></tr>
        <?php }else {  ?>
        <tr><td></td><td><input required type="hidden" name="NB_ACTIONNAIRES" value=""></td></tr>
        <?php } ?>
        <?php if ($structure->getNbDonateurs() != null) { ?>
        <tr><td>Nombre donateurs</td><td><input required type="number" name="NB_DONATEURS" value="<?=  $structure->getNbDonateurs()?>">
        <?php }else { ?>
            <input required type="hidden" name="NB_DONATEURS" value="">
        <?php } ?>

    </table>
    <input type="submit"  >
    <?php
    if(!empty($_POST)){
        $_POST['ID'] = intval($_POST['ID']);
        $_POST['ESTASSO'] = intval($_POST['ESTASSO']);
        $_POST['NB_ACTIONNAIRES'] = intval($_POST['NB_ACTIONNAIRES']);
        $_POST['NB_DONATEURS'] = intval($_POST['NB_DONATEURS']);
        $query = 'UPDATE `structure` SET `ID`= :ID,`NOM`= :NOM,`RUE`= :RUE,`CP`= :CP,`VILLE`= :VILLE,`ESTASSO`= :ESTASSO,`NB_DONATEURS`= :NB_DONATEURS,`NB_ACTIONNAIRES`= :NB_ACTIONNAIRES WHERE ID= :ID';
        $updateStructure = $list->update($_POST, $query);
        echo  $updateStructure;
    }

    ?>
</form>

<?php require_once 'footer.php' ?>