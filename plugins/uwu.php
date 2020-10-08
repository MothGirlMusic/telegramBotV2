<?php
class uwu
{
	
	function __construct() //init
		{
		$data = "{'name' : 'uwu', 'description' : 'OwO!', 'commandDescriptions' : []}";
		return $data;
		}
	
	function handelEvent($event, $data, $obj)
	{
		switch ($event) {
		case "messageRecived":
			// Do something with the Data
			$received_message = $data->{'message'}->{'text'};
			if ((preg_match('/^((.)* )?u.?w.?u.?( (.)*)?$/i', $received_message)) == 1) {
				$answer = "replay|OwO";
				return $answer;
			}
			break;
		default:
			// Don't handle the event Type
		}
	
	}
}


?>
