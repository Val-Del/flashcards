<?php class Gen__Tables
{

    /*****************Attributs***************** */
    private $_id_table;
    private $_name;
    private $_foreign_key;
    private $_url;
    private $_back;
    private $_generation;
    
    private $_nom_id;
    private $_primary_key;
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
     * Get the value of _name
     */ 
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Set the value of _name
     *
     * @return  self
     */ 
    public function setName($_name)
    {
        $this->_name = $_name;

        return $this;
    }

    /**
     * Get the value of _foreign_key
     */ 
    public function getForeign_key()
    {
        return $this->_foreign_key;
    }

    /**
     * Set the value of _foreign_key
     *
     * @return  self
     */ 
    public function setForeign_key($_foreign_key)
    {
        $this->_foreign_key = $_foreign_key;

        return $this;
    }

    /**
     * Get the value of _url
     */ 
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * Set the value of _url
     *
     * @return  self
     */ 
    public function setUrl($_url)
    {
        $this->_url = $_url;

        return $this;
    }

    /**
     * Get the value of _back
     */ 
    public function getBack()
    {
        return $this->_back;
    }

    /**
     * Set the value of _back
     *
     * @return  self
     */ 
    public function setBack($_back)
    {
        $this->_back = $_back;

        return $this;
    }
    public static function getAttributes()
    {
        self::$_attributes = get_class_vars(static::class);
        return self::$_attributes;
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
     * Get the value of _id_table
     */ 
    public function getGeneration()
    {
        return $this->_generation;
    }

    /**
     * Set the value of _id_table
     *
     * @return  self
     */ 
    public function setGeneration($_id_table)
    {
        $this->_generation = $_id_table;

        return $this;
    }

    /**
     * Get the value of _nom_id
     */ 
    public function getNom_id()
    {
        return $this->_nom_id;
    }

    /**
     * Set the value of _nom_id
     *
     * @return  self
     */ 
    public function setNom_id($_nom_id)
    {
        $this->_nom_id = $_nom_id;

        return $this;
    }

    /**
     * Get the value of _primary_key
     */ 
    public function getPrimary_key()
    {
        return $this->_primary_key;
    }

    /**
     * Set the value of _primary_key
     *
     * @return  self
     */ 
    public function setPrimary_key($_primary_key)
    {
        $this->_primary_key = $_primary_key;

        return $this;
    }
}