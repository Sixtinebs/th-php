<?php
namespace bd;
use PDO;
use PDOException;
use PDOStatement;

require_once __DIR__.'/../config/config.php';

abstract class PdoConnect
{

    private $host;
    private $db;
    private $encoding;
    private $user;
    private $pass;
    private $port;
    public function __construct()
    {
        $this->host = $GLOBALS['host'];
        $this->db = $GLOBALS['db'];
        $this->encoding = $GLOBALS['encoding'];
        $this->user = $GLOBALS['user'];
        $this->pass = $GLOBALS['pass'];
        $this->port = $GLOBALS['port'];
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @param mixed $encoding
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }


    protected function dbConnect() :PDO
    {
        try {
            $pdo = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db",$this->user,$this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    protected function executePrepare(string $req, array $params) :PDOStatement {
        $co = null;
        try {
            $co = $this->dbConnect();
            $stmt = $co->prepare($req);

            $res =$stmt->execute($params);

            return $stmt;
        }
        catch (PDOException $ex) {
            throw $ex;
        }
        finally {
            if ($co != null) {
                $co = null;
            }
        }
    }
    public abstract function findById(int $id, string $query) : array;
    public abstract function findAll(string $table) : array;
    public abstract function create(array $params, string $query) : string;
    public abstract function update(array $params, string $query) : string;
    public abstract function delete(int $id, string $table) : string;












}