<?php
function ChargerClasse($classe)
{
	if (file_exists("PHP/CONTROLLER/CLASSE/" . $classe . ".Class.php")) {
		require "PHP/CONTROLLER/CLASSE/" . $classe . ".Class.php";
	}
	if (file_exists("PHP/MODEL/" . $classe . ".Class.php")) {
		require "PHP/MODEL/" . $classe . ".Class.php";
	}
}
spl_autoload_register("ChargerClasse");


function deleteDirectory($dir)
{
	if (!is_dir($dir)) {
		return;
	}

	$files = scandir($dir);
	foreach ($files as $file) {
		if ($file != "." && $file != "..") {
			if (is_dir("$dir/$file")) {
				deleteDirectory("$dir/$file");
			} else {
				unlink("$dir/$file");
			}
		}
	}
	rmdir($dir);
}
function createGestion($obj)
{
	global $pathGestion;
	$name = $pathGestion . '/gestion_' . $obj->getName() . '.php';
	// var_dump($name);
	$gestion = fopen($name, 'w');
}
function createManager($obj)
{
	global $pathManager;
	$name = $pathManager . '/' . ucfirst($obj->getName()) . '_manager.Class.php';
	// var_dump($name);
	$manager = fopen($name, 'w');
}
function createClass($obj)
{
	global $pathClass;
	$name = $pathClass . '/' . ucfirst($obj->getName()) . '.Class.php';
	// $content = 'test';
	// var_dump($name);
	$class = fopen($name, 'w');
}
function contentManager($obj)
{
	// var_dump($obj);
	$content = '<?php
	class ' . ucfirst($obj->getName()) . '_manager extends Db_manager
	{
	
		public function __construct()
		{
			parent::set_table(\'' . $obj->getName() . '\');
			parent::set_default_id(\'' . $obj->getPrimary_key() . '\');
		}
	
	}';
	global $pathManager;
	$name = $pathManager . '/' . ucfirst($obj->getName()) . '_manager.Class.php';
	$manager = fopen($name, 'a');
	fwrite($manager, $content);
	fclose($manager);
}
function contentClass($obj)
{
	// var_dump($obj);
	$content = '<?php
class ' . ucfirst($obj->getName()) . '
{
	';

	// var_dump($obj);
	$table = DAO::select(['*'], $obj->getName(), null, null, 1, false, false, true);
	foreach ($table as $key => $value) {
		$content .= 'private $_'.$key.';
	';
	}
	//remove l'indentation en trop
	$content = substr($content,0,-1);
	$content .= '
    /**Accesseurs**/';
	foreach ($table as $key => $value) {
		$content .= '
	public function get_'.$key.'()
	{
		return $this->_'.$key.';
	}
	public function set_'.$key.'($'.$key.')
	{
		$this->_'.$key.' = $'.$key.';
		return $this;
	}';
	}
	$content .= '
	/**Constructeur**/
	public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }
    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $methode = "set_" . $key;
            if (is_callable(([$this, $methode]))) {
                $this->$methode($value);
            }
        }
    }
	/**Autres méthodes**/

    /**
     * Renvoi vrai si l\'objet en paramètre est égal à l\'objet appelant
     *
     * @param [type] $obj
     * @return bool
     */
    public function equals_to($obj)
    {
        return true;
    }

    /**
     * Compare 2 objets
     * Renvoi 1 si le 1er est >
     * 0 si ils sont égaux
     * -1 si le 1er est <
     *
     * @param [type] $obj1
     * @param [type] $obj2
     * @return int
     */
    public static function compare_to($obj1, $obj2)
    {
        return 0;
    }

}';
	// var_dump($content);
	global $pathClass;
	$name = $pathClass . '/' . ucfirst($obj->getName()) . '.Class.php';
	$classFile = fopen($name, 'a');
	fwrite($classFile, $content);
	fclose($classFile);
}
