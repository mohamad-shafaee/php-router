<?php

include_once 'IRequest.php';

class Request implements IRequest{

	/*public function __call($method, $args){

		echo  "    method "
		. "$method "  
		.  "with args: "  .  " $args[2]";
	}*/


	function __construct(){

		$this->bootstrapSelf();
	}

	private function bootstrapSelf(){

		foreach ($_SERVER as $key => $value) {
			
			// definin variables this way is interesting!
			$this->{$this->toCamelCase($key)} = $value;

			//echo  "key is: ". $key . " <br> " . "value is: " . $value . "<br><br><br>";


		}
	}

	private function toCamelCase($string){
		
		$result = strtolower($string);

		preg_match_all('/_[a-z]/', $result, $matches);

		foreach($matches[0] as $match){

			$c = str_replace('_', '', strtoupper($match));
			$result = str_replace($match, $c, $result);

		}

		return $result;
	}

	public function getBody(){
		
		if($this->requestMethod === 'GET'){
			return;
		}

		$body = array();

		if($this->requestMethod === 'POST'){

			foreach($_POST as $key => $value){

				//$body[$key] = $value;
				$body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
			}

			return $body;

		}
	}

	/*public function test2(){

		$dadi = "uu54";

         $myMet = $this->{strtolower($dadi)};
         //$myMet['glad'] = "ttt";
		//echo " Why " . "{$myMet['glad']}";
	}*/
}

/*$req1 = new Request;
echo "{$req1->temp} is a value and also ** {$req1->appPoolId}";

$req1->test1(10, 100, 1000, 10000);

$req1->test2();*/





?>