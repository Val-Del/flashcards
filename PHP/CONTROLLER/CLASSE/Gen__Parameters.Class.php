<?php class Gen__Parameters
{

    /*****************Attributs***************** */
    private static $_idParameter;
    private static $_projectName;
    private static $_userBdd;
    private static $_passBdd;
    private static $_portBdd;
    private static $_nomBdd;
    private static $_pathFramework;
    private static $_serverName;
    private static $_attributes = [];

    /*****************Accesseurs***************** */

    
    /*****************Constructeur***************** */

    public function __construct(array $options = [])
    {
        self::$_attributes = get_class_vars(get_class($this));
        if (!empty($options)) // empty : renvoi vrai si le tableau est vide
        {
            $this->hydrate($options);
        }
    }
    public function hydrate($data)
    {
        foreach ($data as $key => $value)
        {
            $methode = "set" . ucfirst($key); //ucfirst met la 1ere lettre en majuscule
            if (is_callable(([$this, $methode]))) // is_callable verifie que la methode existe
            {
                $this->$methode($value);
            }
        }
    }

    /*****************Autres Méthodes***************** */
    

    /**
     * Get the value of _projectName
     */ 
    public static function getProjectName()
    {
        return self::$_projectName;
    }

 

    /**
     * Get the value of _userBdd
     */ 
    public static function getUserBdd()
    {
        return self::$_userBdd;
    }



    /**
     * Get the value of _passBdd
     */ 
    public static function getPassBdd()
    {
        return self::$_passBdd;
    }

  

    /**
     * Get the value of _portBdd
     */ 
    public static function getPortBdd()
    {
        return self::$_portBdd;
    }


    /**
     * Get the value of _nomBdd
     */ 
    public static function getNomBdd()
    {
        return self::$_nomBdd;
    }


    /**
     * Get the value of _pathFramework
     */ 
    public static function getPathFramework()
    {
        return self::$_pathFramework;
    }



    /**
     * Get the value of _servername
     */ 
    public static function getServername()
    {
        return self::$_serverName;
    }


    /**
     * Set the value of _projectName
     *
     * @return  self
     */ 
    public static function setProjectName($_projectName)
    {
        self::$_projectName = $_projectName;

    }

    /**
     * Set the value of _userBdd
     *
     * @return  self
     */ 
    public function setUserBdd($_userBdd)
    {
        self::$_userBdd = $_userBdd;

    }

    /**
     * Set the value of _passBdd
     *
     * @return  self
     */ 
    public static function setPassBdd($_passBdd)
    {
        self::$_passBdd = $_passBdd;
    }


    /**
     * Set the value of _portBdd
     *
     * @return  self
     */ 
    public function setPortBdd($_portBdd)
    {
        self::$_portBdd = $_portBdd;
    }

    /**
     * Set the value of _nomBdd
     *
     * @return  self
     */ 
    public static function setNomBdd($_nomBdd)
    {
        self::$_nomBdd = $_nomBdd;

    }

    /**
     * Set the value of _pathFramework
     *
     * @return  self
     */ 
    public static function setPathFramework($_pathFramework)
    {
        self::$_pathFramework = $_pathFramework;

    }

    /**
     * Set the value of _servername
     *
     * @return  self
     */ 
    public static function setServername($_servername)
    {
        self::$_serverName = $_servername;
    }

    /**
     * Get the value of _parameters
     */ 
    public static function getAttributes()
    {
        return self::$_attributes;
    }  

    /**
     * Get the value of _id_parameter
     */ 
    public function getIdParameter()
    {
        return self::$_idParameter;
    }

    /**
     * Set the value of _id_parameter
     *
     * @return  self
     */ 
    public function setIdParameter($_id_parameter)
    {
        self::$_idParameter;
    }
}