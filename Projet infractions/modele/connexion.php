<?php
class Connexion{
    private $db;

    function __construct(){
        $db_config['SGBD'] = 'mysql';
        $db_config['HOST'] = 'devbdd.iutmetz.univ-lorraine.fr';
        $db_config['DB_NAME'] = 'er5u_tpnote';
        $db_config['USER'] = 'er5u_appli';
        $db_config['PASSWORD'] = '32202468';
        
        try{
        $this->db = new PDO( $db_config['SGBD'].':host='.$db_config['HOST'].';dbname='.$db_config['DB_NAME'],
        $db_config['USER'], $db_config['PASSWORD'],
        array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    
        unset($db_config);

    }
        catch( Exception $exception ) {
        die($exception->getMessage());
        } 
    }

    function execSQL(string $req, array $valeurs=[]):array{
        $res = $this->db->prepare($req);
        try {
            $res -> execute($valeurs);
            }
            catch( Exception $exception ) {
            die($exception->getMessage());
            }

        $t = $res->fetchall(PDO::FETCH_ASSOC);
        return $t;
        }
    
}
?>  