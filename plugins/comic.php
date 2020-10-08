<?php
	include('include/xkcd.php'); //Load the wrapper
        //$xkcd = new xkcd();
class comic
{
	function __construct() //init
		{
		$data = "{'name' : 'comic', 'description' : 'Random XKCD Comic', 'commandDescriptions' : []}";
		return $data;
		}
	
	function handelEvent($event, $data, $obj)
	{
		switch ($event) {
		case "command":
			$chat_ID = $data->{'message'}->{'chat'}->{'id'};
			$received_message = $data->{'message'}->{'text'};
			$dataArray = explode(' ', $data->{'command'});
			$command = $dataArray[0];
			// Do something with the Data
			$from = $data->{'message'}->{'from'}->{'id'};
			if ($command == '/xkcd') {
				$xkcd = new xkcd();
                                $comic = $xkcd->random();
				$answer = "replay|".$comic->{'img'}."\nXKCD #".$comic->{'num'}." \"".$comic->{'title'}."\"\n".$comic->{'alt'};
				//$answer = "replay|This is under construction.";
				return $answer;
			}
			break;
		default:
			// Don't handle the event Type
		}
	
	}
}



?>
