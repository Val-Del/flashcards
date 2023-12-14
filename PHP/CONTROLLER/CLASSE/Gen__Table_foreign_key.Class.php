<?php class Gen__Table_foreign_key
{

    /*****************Attributs***************** */
    private $_id_table_foreign_key;
    private $_id_table;
    private $_id_foreign_key;
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


     /**
     * Get the value of _parameters
     */ 
    public static function getAttributes()
    {
        return self::$_attributes;
    }  

    /**
     * Get the value of _id_table_foreign_key
     */ 
    public function getId_table_foreign_key()
    {
        return $this->_id_table_foreign_key;
    }

    /**
     * Get the value of _id_table
     */ 
    public function getId_table()
    {
        return $this->_id_table;
    }

    /**
     * Set the value of _id_table
     *
     * @return  self
     */ 
    public function setId_table($_id_table)
    {
        $this->_id_table = $_id_table;

        return $this;
    }

    /**
     * Set the value of _id_table_foreign_key
     *
     * @return  self
     */ 
    public function setId_table_foreign_key($_id_table_foreign_key)
    {
        $this->_id_table_foreign_key = $_id_table_foreign_key;

        return $this;
    }

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
}