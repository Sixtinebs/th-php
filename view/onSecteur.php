
<?php
require_once 'header.php';
use crud\Crud;
use entities\Secteur;
require '../model/Secteur.php';
require '../controller/Crud.php';
$list = new Crud();
$id = $_GET['id'];
$query = 'SELECT * FROM `secteur` WHERE ID=:ID';
$element = $list->findById($id, $query);

$secteur = new Secteur($element['ID'],$element['LIBELLE']);

if(isset($_GET['supprimer'])){
    $table = 'structure';
    $delete = $list->delete($id, $table);
    echo $delete;
    header("Location: secteur.php");
}
?>


<h1><?=  $secteur->getLibelle()?></h1>

<form method="post" action="">
    <table>

        <tr><td></td><td><input required type="hidden" name="ID" value="<?=  $secteur->getID()?>"></td></tr>
        <tr><td>Libelle</td><td><input required type="text" name="LIBELLE" value="<?= htmlspecialchars($secteur->getLibelle())?>"></td></tr>

    </table>
    <input type="submit"  >
    <?php
    if(!empty($_POST)){
        $_POST['ID'] = intval($_POST['ID']);
        $query = 'UPDATE `secteur` SET `ID`= :ID,`LIBELLE`= :LIBELLE';
        $updateSecteur = $list->update($_POST, $query);
        echo  $updateSecteur;
    }

    ?>
</form>

<?php require_once 'footer.php' ?>
