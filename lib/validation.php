<?php 
class Validation_class{

/*###################################################################*/
	function check_email($s)
/*###################################################################*/
	{
		if(preg_match("/\w+([.-_]\w+)*@\w+([.-_]\w+)*\.\w{2,4}/", $s)):
			return true;
		else:
			return false;
		endif;
	}


/*###################################################################*/
	function check_url($s)
/*###################################################################*/
	{
		if(preg_match("/https?:(\/\/)?(www\.)?([a-zA-Z0-9_%]*)\b\.[a-z]{2,4}(\.[a-z]{2})?/", $s)):
			return true;
		else:
			return false;
		endif;
	}

	
/*###################################################################*/
	function check_is_number($integer)
/*###################################################################*/
	{
		if(preg_match("/^[0-9]+$/",$integer)):
			return true;
		else:
			return false;
		endif;
	}

	
/*###################################################################*/
	function check_text($s, $allow = '')
/*###################################################################*/
	{
		$char = '';
		if ($allow != '') {
			$allowed_chars = self::explodeEachChar($allow);
			foreach ($allowed_chars as $allowed_char) {
				$char .= '\\'.$allowed_char;
			}
		}
		if(preg_match("/^[a-zA-Z\s" . $char . "]+$/", $s)):
			return true;
		else:
			return false;
		endif;	
	}
	
	
/*###################################################################*/
	function check_text_nospace($s)
/*###################################################################*/
	{
		if(preg_match("/^[a-zA-Z]+$/", $s)):
			return true;
		else:
			return false;
		endif;	
	}

	
/*###################################################################*/
	function check_alphanumeric($s)
/*###################################################################*/
	{
		if(preg_match("/^[0-9a-zA-Z\s]+$/", $s)):
			return true;
		else:
			return false;
		endif;	
	}
	
	
/*###################################################################*/
	function check_string_length($s, $max = 0, $min = 0)
/*###################################################################*/
	{
		if($max == 0 && $min == 0):
			return true;
		else:
			$length = strlen($s);
			if($length < $min):
				return false;
			endif;
			if($length > $max):
				return false;
			endif;
			return true;
		endif;	
	}
  
/*###################################################################*/
	function xss_filter($s)
/*###################################################################*/
	{
		$string = addslashes($s);
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');	
	}

/*###################################################################*/
	function check_valid_year($s)
/*###################################################################*/
	{
		if(preg_match("/^[0-9]{4}$/", $s)):
			return true;
		else:
			return false;
		endif;	
	}
	
	/**
	 * function to split every charachter of a string
	 *
	 * @return void
	 * @author Christophe Debruel
	 **/
	public function explodeEachChar($x) {
	    $c = array();
	    while (strlen($x) > 0) {
	        $c[] = substr($x,0,1);
	        $x = substr($x,1);
	    }
	    return $c;
	}



}//end of class Validation_class