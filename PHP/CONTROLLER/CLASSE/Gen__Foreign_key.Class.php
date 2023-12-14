<?php class Gen__Foreign_key
{

    /*****************Attributs***************** */
    private $_id_foreign_key;
    private $_name_table;
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
     * Get the value of _id_foreign_key
     */ 
    public function getId_foreign_key()
    {
        return $this->_id_foreign_key;
    }

    /**
     * Set the value of _id_foreign_key
     *
     * @return  self
     */ 
    public function setId_foreign_key($_id_foreign_key)
    {
        $this->_id_foreign_key = $_id_foreign_key;

        return $this;
    }

    /**
     * Get the value of _name_table
     */ 
    public function getName_table()
    {
        return $this->_name_table;
    }

    /**
     * Set the value of _name_table
     *
     * @return  self
     */ 
    public function setName_table($_name_table)
    {
        $this->_name_table = $_name_table;

        return $this;
    }
       /**
     * Get the value of _parameters
     */ 
    public static function getAttributes()
    {
        return self::$_attributes;
    }  
}