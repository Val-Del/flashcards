<?php

class DAO
{

	public static function add($obj)
	{
		$db = DbConnect::getDb();
		$class = get_class($obj);
		$attributs = $class::getAttributes();
		
		$requ = "INSERT INTO " . $class . "(";
		$values = "";
		$bindValue = [];

		// for ($i = 1; $i < count($colonnes); $i++) {
		// 	var_dump($colonnes[$i]);
		// 	$methode = "get" . ucfirst($colonnes[$i]);
		// 	if ($obj->$methode() != null) {
		// 		$requ .= $colonnes[$i] . ",";
		// 		$values .= ":" . $colonnes[$i] . ",";
		// 	}
		// }
		foreach ($attributs as $attribut => $value) {
			// var_dump($attribut);
			if ($attribut != '_attributes') {
	
				$requ.= "`$attribut`, ";
			   
			}
			// $attributGet = substr($attribut,1);
			//     $attributGet = ucfirst($attributGet);
			//     $get = array($class, 'get'.$attributGet);
			//     $result = call_user_func($get);
			
		}
		$requ = substr($requ, 0,-2);
		$requ .= ') VALUES (';
		foreach ($attributs as $attribut => $value) {
			if ($attribut != '_attributes') {
				$attributGet = ucfirst(ltrim($attribut, '_'));
				$method = 'get' . $attributGet;
				
				if (is_callable([$obj, $method])) {
					$result = $obj->$method();
				} elseif (is_callable([$obj, 'get'.$attributGet])) {
					$result = $obj->{'get'.$attributGet}();
				} elseif (method_exists($obj, 'get'.$attributGet)) {

					$result = $obj->{'get'.$attributGet}();
				} else {
					var_dump($obj, $method);
					var_dump('null');
				}
				
				$requ .= "'$result',";
			}
		}
		$requ = substr($requ, 0,-2);
		$requ .= '\')';
			// var_dump($requ);
		$q = $db->prepare($requ);
		return $q->execute();
	}

	public static function update($obj)
	{
		$db = DbConnect::getDb();
		$class = get_class($obj);
		$colonnes = $class::getAttributes();
		// var_dump($colonnes);
		// var_dump($colonnes[0]);
		
		$requ = "UPDATE " . $class . " SET ";
		
		foreach ($colonnes as $key => $value) {
			if ($key != '_attributes') {
				$requ .= $key . "=:" . $key . ",";
			}
			// var_dump($value);
			// var_dump($requ);
		}
		
		// for ($i = 0; $i < count($colonnes); $i++) {
		// 	// $requ .= $colonnes[$i] . "=:" . $colonnes[$i] . ",";
		// 	var_dump($requ);
		// }
		$requ = substr($requ, 0, strlen($requ) - 1);
		// var_dump($requ);
		$c = 0;
		foreach ($colonnes as $key => $value) {
			if ($c == 0) {
				$requ .= " WHERE " . $key . "=:old" . $key;
			}
			$c++;
		}
		// $requ .= " WHERE " . $colonnes[0] . "=:" . $colonnes[0];
// var_dump($requ);
		$q = $db->prepare($requ);

		foreach ($colonnes as $key => $value) {
			if ($key != '_attributes') {
				$key = substr($key,1);
			$method = "get".ucfirst($key);
			// var_dump(":_" . $key, $obj->$method());
		 	$q->bindValue(":_" . $key, $obj->$method());

			}
			
				// $requ .= " WHERE " . $key . "=:" . $key;
	
		}
		$c = 0;
		foreach ($colonnes as $key => $value) {
			if ($c == 0) {
				
				$key = substr($key,1);
			$method = "get".ucfirst($key);
			// var_dump(":old_" . $key, $obj->$method());
		 	$q->bindValue(":old_" . $key, $obj->$method());
			}
			$c++;
		}

		// for ($i = 0; $i < count($colonnes); $i++) {
		// 	$methode = "get" . ucfirst($colonnes[$i]);
		// 	$q->bindValue(":" . $colonnes[$i], $obj->$methode());
		// }
		// var_dump()
		// $q->debugDumpParams();
		return $q->execute();
		
	}

	public static function delete($obj)
	{
		$db = DbConnect::getDb();
		$class = get_class($obj);
		$colonnes = $class::getAttributes();
		$methode = "get" . ucfirst($colonnes[0]);
		return $db->query("DELETE FROM " . $class . " WHERE " . $colonnes[0] . " = " . $obj->$methode());
	}

	/**
	 *
	 * @param array $nomColonnes => contient le noms des champs désirés dans la requête.
	 * Exemple :  [nomColonne1,nomColonne2] => "SELECT nomColonne1, nomColonne2"
	 *
	 * @param string $table => contient Nom de la table sur laquelle la requête sera effectuée.
	 * Exemple : nomTable => "FROM nomTable"
	 *
	 * @param array $conditions => null par défaut, attendu un tableau associatif 
	 * qui peut prendre plusieurs formes en fonction de la complexité des conditions.
	 *  Exemples : tableau associatif
	 *  [nomColonne => '1'] => "WHERE nomColonne = 1"
	 *  [nomColonne => ['1','3']] => "WHERE nomColonne in (1,3)"
	 *  [nomColonne => '%abcd%'] => "WHERE nomColonne like "abcd" "
	 *  [nomColonne => '1->5'] => "WHERE nomColonne BETWEEN 1 and 5 "
	 *  Si il y a plusieurs conditions alors :
	 *  [nomColonne1 => '1', nomColonne2 => '%abcd%' ] => "WHERE nomColonne1 = 1 AND nomColonne2 LIKE "%abcd%"
	 *
	 * @param string $orderBy => null par défaut, contient un string qui contient les noms de colonnes et le type de tri
	 * Exemple :"nomColonne1 , nomColonne2 DESC" => "Order By nomColonne1 , nomColonne2 DESC"
	 *
	 * @param string $limit  => null par défaut, contient un string pour donner la délimitations des enregistrements de la BDD
	 * Exemples :
	 * "1" => "LIMIT 1"
	 * "1,2"=> "LIMIT 1,2"
	 *
	 * @param boolean $api => false par défaut, mettre true si on souhaite recevoir la réponse sous forme de string sinon sous forme d'objets.
	 *
	 * @param bool $debug => contient faux par défaut mais s'il on le met a vrai, on affiche la requete qui est effectuée.
	 *
	 * @return [array ou object] $liste => résultat de la requête revoie false si la requête s'est mal passé sinon renvoie un tableau.
	 */
	public static function select(array $nomColonnes, string $table, array $conditions = null, string $orderBy = null, string $limit = null, bool $api = false, bool $debug = false, bool $noObj = false)
	{
		// if (is_null($nomColonnes)) {
		// 	# code...
		// }
		// var_dump($nomColonnes);
		$db = DbConnect::getDb();
		// var_dump($db);
		// if (is_null($nomColonnes)) {
		// 	// $nomColonnes = '*';
		// }
		$string = json_encode($nomColonnes) . $table . json_encode($conditions) . $orderBy . $limit . $api . $debug;
		if (strpos($string, ";")) {
			return false;
		} else if (!empty($nomColonnes)  && ($table != null && $table != "")) {

			$cols = self::elementSelect($nomColonnes);

			$t = " FROM " . $table;

			if ($conditions != null) {
				$conditions = self::conditionSelect($conditions);
			}
			if ($orderBy != null) {
				$orderBy = " ORDER BY " . $orderBy;
			}
			if ($limit != null) {
				$limit = " LIMIT " . $limit;
			}

// 			echo "Cols: $cols<br>";
// echo "Table: $t<br>";
// echo "Conditions: $conditions<br>";
// echo "OrderBy: $orderBy<br>";
// echo "Limit: $limit<br>";
			$q = $db->query($cols . $t . $conditions . $orderBy . $limit);
			if ($debug) // Si le debug est a true on affiche la requete qui est envoyée en base de données
			{
				var_dump($cols . $t . $conditions . $orderBy . $limit);
			}
			$liste = [];
			if (!$q) return false;
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) { // on récupère les enregistrements de la BDD
				if ($donnees != false) {
					if ($noObj) {
						return $donnees;
					}
					if ($api) { // On vérifie si api est a true, on renvoie un string sinon des objets liés a à la table donnée en paramètres.
						$liste[] = $donnees;
					} else {
						$liste[] = new $table($donnees);
					}
					
				}
			}

			return $liste;
		}
		return false;
	}

	/**
	 * Méthode privée qui sera appelée par la méthode select
	 *
	 * @param array $tab => Tableau de noms de colonnes ou agrégats de la BDD pour plus de détail allez voir la doc sur select.
	 * @return string => compose la partie SELECT de la méthode select
	 *
	 */
	private static function elementSelect($tab)
	{
		// var_dump($tab);
		$temp = "SELECT ";
		foreach ($tab as $uneCol) {
			if (!is_array($uneCol)) {
				$temp .= $uneCol . ", ";
			}
			
			
		}
		return substr($temp, 0, strlen($temp) - 2);
	}

	/**
	 * Méthode privée qui sera appelée par la méthode select
	 *
	 * @param array $conditions => tableaux qui contient les conditions pour plus de détail allez voir la doc sur select.
	 * @return string => compose la partie WHERE de la méthode select
	 *
	 */
	private static function conditionSelect($conditions)
	{
		$req = " WHERE ";
		foreach ($conditions as $nomColonne => $valeur) {
			// cas du in
			if (is_array($valeur)) {
				$req .= $nomColonne . " IN (" . implode(",", $valeur) . ") AND ";
			} else if (!(strpos($valeur, "%") === false)) { //cas like
				$req .= $nomColonne . ' LIKE "' . $valeur . '" AND ';
			} else if (strpos($valeur, "->")) { //cas between
				$tab = explode("->", $valeur);
				$req .= $nomColonne . " BETWEEN " . $tab[0] . " AND " . $tab[1] . " AND ";
			} else { //cas valeur simple
				$req .= $nomColonne . " = \"" . $valeur . "\" AND ";
			}
		}
		//On retire le dernier AND
		$req = substr($req, 0, strlen($req) - 4);
		return $req;
	}
    public static function createTable($obj)
{
    $db = DbConnect::getDb();
    $class = get_class($obj);
    // var_dump($class);
    $attributs = $class::getAttributes();
    // var_dump($attributs);
    $tableName = $class;
    $query = "CREATE TABLE `$tableName` (`";
    // var_dump(Parameters::getProjectName());
	$count = 0;
    foreach ($attributs as $attribut => $value) {
        // var_dump($attribut);
		if ($count == 0) {		
			$query .= $attribut.'` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,';
			$count++;
		}else {
			if ($attribut != '_attributes') {

            $query .= "`$attribut` VARCHAR(255),";
           
        }
		}
        
		// $attributGet = substr($attribut,1);
        //     $attributGet = ucfirst($attributGet);
        //     $get = array($class, 'get'.$attributGet);
        //     $result = call_user_func($get);
		
    }
	$query = substr($query,0,-2);
	$query .= '))ENGINE=InnoDB;';
	var_dump($query);
	// $query .= '))';
	// $query .= ')',;

		// var_dump($query);
		// foreach ($attributs as $attribut => $value) {
		// 	// var_dump($attribut);
		// 	if ($attribut != '_attributes') {

		// 		$attributGet = substr($attribut,1);
		// 	    $attributGet = ucfirst($attributGet);
		// 	    $get = array($class, 'get'.$attributGet);
		// 	    $result = call_user_func($get);
		// 		$query .= "`$result`,";
			   
		// 	}
			
			
		// }
		// var_dump($query);

	// var_dump($query);
    return $db->exec($query);
}
public static function dropTable($obj)
{
    $db = DbConnect::getDb();
    $class = get_class($obj);
    $tableName = $class;
    $query = "DROP TABLE IF EXISTS `$tableName`;";
    return $db->exec($query);
}
public static function getInfo($obj)
{
    $db = DbConnect::getDb();
	$sql = "SHOW TABLES FROM ".$obj->getNomBDD()."";
	$q = $db->prepare($sql);
	$q->execute();
	return $q->fetchAll(PDO::FETCH_ASSOC);
}
public static function getPrimaryKeys($tables, $dbName)
{
    $db = DbConnect::getDb();
    $primaryKeys = array();
    foreach ($tables as $table) {
        $tableName = $table['Tables_in_' . $dbName];
        $sql = "SHOW KEYS FROM " . $tableName . " WHERE Key_name = 'PRIMARY'";
        $q = $db->prepare($sql);
        $q->execute();
        $keys = $q->fetchAll(PDO::FETCH_COLUMN, 4);
        $primaryKeys[$tableName] = $keys;
    }

    return $primaryKeys;
}





public static function selectAll($tableName) {
	$db = DbConnect::getDb();
  
	// Build the SQL query
	$query = "SELECT * FROM $tableName";
	// var_dump($query);
  
	// Execute the query
	$result = $db->query($query);
  
	// Check if the query was successful
	if (!$result) {
	  return false;
	}
  
	// Fetch all rows from the result set
	$rows = $result->fetchAll(PDO::FETCH_ASSOC);
  
	// If there are no rows, return an empty array
	if (!$rows) {
	  return [];
	}
  
	// Create an array of objects representing the rows
	$objects = [];
	foreach ($rows as $row) {
		$newRow = array();
		foreach ($row as $key => $value) {
			if (strpos($key, '_') === 0) {
				$key = substr($key, 1);
			}
			$newRow[$key] = $value;
		}
		$object = new Gen__Tables($newRow);
		$objects[] = $object;
	}
  
	return $objects;
  }
  
}
