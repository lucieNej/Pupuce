<?php


Database::connect();



class Users
{
    private $user_nom;
    private $user_mdp;
    private $bdd;

	function __construct($user_nom, $user_mdp)
	{


    // $this->_user_id = $user_id;
    $this->user_nom = $user_nom;
    // $this->_user_login = $user_login;
    $this->user_mdp = $user_mdp;
    $this->bdd = $bdd;
    

    }
    
    public function __get($attr) 
    {
        return $this->$attr;
    }

    public function __set($val, $attr)
    {
        $this->$attr = $val;
    }

    static function getAll($bdd)
    {
        $sql = "SELECT * FROM `users`";
        $data = $bdd->query($sql);
        return $data->fetchAll();
    }

    public function getInfoById($bdd){
        $sql = "SELECT * FROM users WHERE `user_nom` = ".$this->user_nom;
        $query = $bdd->query($sql);
        $data = $query->fetch();
        $this->user_nom = $data['user_nom'];
        $this->user_mdp = $data['user_mdp'];
       
    }


}

Database::disconnect();