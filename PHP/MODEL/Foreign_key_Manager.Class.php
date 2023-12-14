<?php

class Foreign_key_Manager
{

	public static function add(Foreign_key $obj)
	{
		return DAO::add($obj);
	}

	public static function update(Foreign_key $obj)
	{
		return DAO::update($obj);
	}

	public static function delete(Foreign_key $obj)
	{
		return DAO::delete($obj);
	}

	public static function findById($id)
	{
		return DAO::select(Foreign_key::getAttributes(), "Foreign_key", ["IdPanier" => $id])[0];
	}

	public static function getList(array $nomColonnes = null,  array $conditions = null, string $orderBy = null, string $limit = null, bool $api = false, bool $debug = false)
	{
		$nomColonnes = ($nomColonnes == null) ? Foreign_key::getAttributes() : $nomColonnes;
		return DAO::select($nomColonnes, "Foreign_key",   $conditions,  $orderBy,  $limit,  $api,  $debug);
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
}