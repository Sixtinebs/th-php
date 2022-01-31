<?php
namespace crud;


require_once dirname(__DIR__).'/model/PdoConnect.php';
require_once  dirname(__DIR__).'/model/Structure.php';
use bd\PdoConnect;
use entities\Structure;
use PDO;



class Crud extends pdoConnect
{

    public function findById(int $id, string $query) : array
    {

        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($query);
        $stmt->execute( ['ID'=>$id]);
        $element = $stmt->fetch();
        //return new Structure($element['ID'],$element['NOM'],$element['RUE'],$element['CP'],$element['VILLE'],$element['ESTASSO'],$element['NB_DONATEURS'],$element['NB_ACTIONNAIRES']);
        return $element;
    }

    public function findAll(string $table): array

    {
        $pdo = $this->dbConnect();

        $res = $pdo->query('SELECT * FROM '.$table);
        $query = $res->fetchAll();
        /*$res = [];
        foreach ($query as $element){
            $res[] = new Structure($element['ID'],$element['NOM'],$element['RUE'],$element['CP'],$element['VILLE'],$element['ESTASSO'],$element['NB_DONATEURS'],$element['NB_ACTIONNAIRES']);
        }*/
        return  $query;
    }
    public function create (array $params, string $query) : string{
        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $stmt->fetch();
        return 'L\'element à bien été ajouté';
    }
    public function update(array $params, string $query) : string
    {
        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);

        $stmt->fetch();
        return 'La modification à bien été prise en compte';
    }
    public function delete(int $id, string $table) : string {
        $pdo = $this->dbConnect();
        $stmt = $pdo->prepare('DELETE FROM '.$table.' WHERE  ID=:ID  ADD CONSTRAINT `secteur_id_foreign` FOREIGN KEY `ID_SECTEUR` ON DELETE CASCADE;' );
        $stmt->execute( ['ID'=>$id]);

        $stmt->fetch();
        return 'L\'élément à bie, été supprimé';
    }

}