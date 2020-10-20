<?php

include('include/dice-roller/Factory.php');

class diceroller
{
	
	function __construct() //init
		{
		$data = "{'name' : 'ping', 'description' : 'Ping? PONG!', 'commandDescriptions' : []}";
		return $data;
		}
	
	function handelEvent($event, $data, $obj)
	{
		switch ($event) {
		case "messageRecived":
			// Do something with the Data
			$received_message = $data->{'message'}->{'text'};
			if ($received_message == 'roll') {
                                $factory = new Factory();
                                $pool = $factory->newInstance('2D6+3');
                                $note = $pool->notation();    // returns 2D6+3
                                $dieroll = $pool->roll()->value(); // returns 6
				$answer = "replay|".$note." = ".$dieroll;
				return $answer;
			}
			break;
		default:
			// Don't handle the event Type
		}
	
	}
}



?>