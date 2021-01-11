<?php
function config($configPath)
{
	$pathArray   = explode(".", $configPath);
	$configArray = [];
	if (reset($pathArray)) {
		$configArray = require_once(__DIR__ . DIRECTORY_SEPARATOR . reset($pathArray) . ".php");
		if (!!array_slice($pathArray, 1, count($pathArray))) {
			return getConfigValues($pathArray, $configArray);
		}

		return $configArray;
	}

	return [];
}

function getConfigValues($path, $configArray)
{


	return $configArray;
}