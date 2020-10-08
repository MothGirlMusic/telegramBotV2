<?php

class owo
{
	
	function __construct() //init
		{
		$data = "{'name' : 'owo', 'description' : 'UwU!', 'commandDescriptions' : []}";
		return $data;
		}
	
	function handelEvent($event, $data, $obj)
	{
		switch ($event) {
		case "messageRecived":
			// Do something with the Data
			$received_message = $data->{'message'}->{'text'};
			if ((preg_match('/^((.)* )?o.?w.?o.?( (.)*)?$/i', $received_message)) == 1) {
				$answer = "replay|UwU";
				return $answer;
			} elseif ((preg_match('/^((.)* )?u.?w.?u.?( (.)*)?$/i', $received_message)) == 1) {
				$answer = "replay|OwO";
				return $answer;
			} elseif ((preg_match('/^((.)* )?r.?i.?p.?( (.)*)?$/i', $received_message)) == 1) {
				$answer = "replay|❀◟(ó ̯ ò, )";
				return $answer;
			}
			break;
		default:
			// Don't handle the event Type
		}
	
	}
}
?>
