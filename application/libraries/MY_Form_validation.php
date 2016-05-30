<?php

	class MY_Form_Validation extends CI_Form_validation {

		public function __construct()
    	{
        	parent::__construct();
    	}

    	
		public function alpha($str)
		{
		  return ( ! preg_match("/^([a-z áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜâêîôûÂÊÎÔÛãõÃÕåÅñÑ])+$/i", $str)) ? FALSE : TRUE;
		}

		public function alpha_numeric($str)
		{
		  return ( ! preg_match("/^([a-z 0-9 áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜâêîôûÂÊÎÔÛãõÃÕåÅñÑ])+$/i", $str)) ? FALSE : TRUE;
		}

	}

?>