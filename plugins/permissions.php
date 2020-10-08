<?php

class permissions
{
	var $pluginName = 'permissions';
	var $description = '';
	var $commandDescriptions = '[]';
	
	function setData($file, $name, $value)
	{
		$root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
		
		if(!is_dir('./plugins/pluginDatas/'.$this->pluginName.'/'))	{ mkdir('./plugins/pluginDatas/'.$this->pluginName.'/', 0755, true); }
		if(!is_file('./plugins/pluginDatas/'.$this->pluginName.'/'.$file))	{ file_put_contents('./plugins/pluginDatas/'.$this->pluginName.'/'.$file, ''); }
		$rawData = file_get_contents('./plugins/pluginDatas/'.$this->pluginName.'/'.$file);
		$jsonData = json_decode($rawData);
		
		ob_start();
		var_dump($jsonData);
		$result = ob_get_clean();
		
		$jsonData[$name] = $value;
		
		$rawData = json_encode($jsonData);
		
		file_put_contents('./plugins/pluginDatas/'.$this->pluginName.'/'.$file, $rawData);
	}
	
	function getData($file, $name)
	{
		$rawData = file_get_contents('./plugins/pluginDatas/'.$this->pluginName.'/'.$file);
		$jsonData = json_decode($rawData);
		
		ob_start();
		var_dump($jsonData);
		$result = ob_get_clean();
		
		if (strpos($rawData, $name) === false) {
			return false;
		}
		$value = $jsonData->{$name};
		
		return $value;
	}
	
	function checkPermission($userID, $groupID, $permission)
	{
		$name = $userID.'|'.$groupID;
		$result = getData('permissions.txt', $name);
		
		if ($result) {
			if ($result >= $permission) { return true; }
		}
		
		return false;
	}
	
	function changePermission($userID, $groupID, $permission)
	{
		$name = $userID.'|'.$groupID;
		
		setData('permissions.txt', $name, $permission);
	}
	
	function __construct() //init
		{
		$data = "{'pluginName' : '".$this->pluginName."', 'description' : '".$this->description."', 'commandDescriptions' : ".$this->commandDescriptions."}";
		return $data;
		}
	
	function handelEvent($event, $data, $obj)
	{
		switch ($event) {
		case "customeEvent":
			$dataArray = explode('|', $data);
			$eventType = $dataArray[0];
			switch ($eventType) {
				case 'checkPermission':
					$userID = $dataArray[1];
					$groupID = $dataArray[2];
					$permission = $dataArray[3];
					$result = checkPermission($userID, $groupID, $permission);
					return 'answer|'.$result;
					break;
				case 'changePermission':
					$userID = $dataArray[1];
					$groupID = $dataArray[2];
					$permission = $dataArray[3];
					$result = changePermission($userID, $groupID, $permission);
					return 'answer|'.$result;
					break;
				default:
					// Don't handle the event Type
			}
			break;
		default:
			// Don't handle the event Type
		}
	
	}
}



?>