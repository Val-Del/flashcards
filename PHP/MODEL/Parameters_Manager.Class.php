<?php

class Parameters_Manager
{

	public static function add(Gen__Parameters $obj)
	{
		return DAO::add($obj);
	}

	public static function update(Gen__Parameters $obj)
	{
		return DAO::update($obj);
	}

	public static function delete(Gen__Parameters $obj)
	{
		return DAO::delete($obj);
	}

	public static function findById($id)
	{
		return DAO::select(Gen__Parameters::getAttributes(), "Parameters", ["IdPanier" => $id])[0];
	}

	public static function getList(array $nomColonnes = null,  array $conditions = null, string $orderBy = null, string $limit = null, bool $api = false, bool $debug = false)
	{
		$nomColonnes = ($nomColonnes == null) ? Gen__Parameters::getAttributes() : $nomColonnes;
		return DAO::select($nomColonnes, "Parameters",   $conditions,  $orderBy,  $limit,  $api,  $debug);
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
	public static function getPrimaryKeys($tables,$name){
		return DAO::getPrimaryKeys($tables,$name);
	}
}