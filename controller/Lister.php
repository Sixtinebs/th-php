<?php
namespace crud\lister;


require_once dirname(__DIR__).'/model/PdoConnect.php';
require_once  dirname(__DIR__).'/model/Structure.php';
use bd\PdoConnect;
use entities\Structure;
use PDO;



class Lister extends pdoConnect
{

    public function findById(int $id) : object
    {

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare('SELECT * FROM `structure` WHERE ID=:ID');
        $stmt->execute( ['ID'=>$id]);
       // $stmt = $pdo->executePrepare('SELECT * FROM `structure` WHERE id=id' , ['id'=>$id]);
        $element = $stmt->fetch();
        return new Structure($element['ID'],$element['NOM'],$element['RUE'],$element['CP'],$element['VILLE'],$element['ESTASSO'],$element['NB_DONATEURS'],$element['NB_ACTIONNAIRES']);
    }

    public function findAll(): array

    {
        $pdo = $this->dbConnect();

        $res = $pdo->query('SELECT * FROM `structure`');
        $query = $res->fetchAll();
        $res = [];
        foreach ($query as $element){
            //var_dump($element['VILLE']);
           $res[] = new Structure($element['ID'],$element['NOM'],$element['RUE'],$element['CP'],$element['VILLE'],$element['ESTASSO'],$element['NB_DONATEURS'],$element['NB_ACTIONNAIRES']);
        }
        return  $res;
    }
    public function create (array $params) : string{
        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare('INSERT INTO `structure` (`NOM`,`RUE`,`CP`,`VILLE`,`ESTASSO`,`NB_DONATEURS`,`NB_ACTIONNAIRES`) VALUES(:NOM, :RUE, :CP,:VILLE, :ESTASSO, :NB_DONATEURS, :NB_ACTIONNAIRES)');
        $stmt->execute($params);
        $stmt->fetch();
        return $params['NOM']. ' a bien été ajouté';
    }
    public function update(array $params) : string
    {
        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare('UPDATE `structure` SET `ID`= :ID,`NOM`= :NOM,`RUE`= :RUE,`CP`= :CP,`VILLE`= :VILLE,`ESTASSO`= :ESTASSO,`NB_DONATEURS`= :NB_DONATEURS,`NB_ACTIONNAIRES`= :NB_ACTIONNAIRES WHERE ID= :ID');
        $stmt->execute($params);

       $stmt->fetch();
        return $params['NOM']. ' a bien été modifié';
    }
    public function delete(int $id) : string {
        var_dump($id);
        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare('DELETE FROM `structure` WHERE  ID=:ID');
        $stmt->execute( ['ID'=>$id]);

        $stmt->fetch();
        return 'Supprimé';
    }

}