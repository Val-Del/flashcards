<?php

class Tables_Manager
{

	public static function add(Gen__Tables $obj)
	{
		return DAO::add($obj);
	}

	public static function update(Gen__Tables $obj)
	{
		return DAO::update($obj);
	}

	public static function delete(Gen__Tables $obj)
	{
		return DAO::delete($obj);
	}

	public static function findById($id)
	{
		// return DAO::select(Tables::getAttributes(), "Tables", ["IdPanier" => $id])[0];
	}

	public static function getList(array $nomColonnes = null,  array $conditions = null, string $orderBy = null, string $limit = null, bool $api = false, bool $debug = false)
	{
        // var_dump(Tables::getAttributes());
		$nomColonnes = ($nomColonnes == null) ? Gen__Tables::getAttributes() : $nomColonnes;
		return DAO::select($nomColonnes, "Tables",   $conditions,  $orderBy,  $limit,  $api,  $debug);
	}
	public static function createTable($obj)
	{
		return DAO::createTable($obj);
	}
	public static function dropTable($obj)
	{
		return DAO::dropTable($obj);
	}
    public static function getInfo($obj)
	{
		return DAO::getInfo($obj);
	}
    public static function selectAll()
	{
		return DAO::selectAll('Gen__Tables');
	}
}