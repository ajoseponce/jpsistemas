<?php 

/**
* @package PHP Framework
* @copyright Copyright (C) 2009. All rights reserved.
* @version 1.1
*/

/*
 * LEVEL
 */
define("LEVEL_ERROR_FATAL",  "fatal");
define("LEVEL_ERROR_WARNING", "warning");
define("LEVEL_ERROR_NOTICE", "notice");
define("LEVEL_SUCCESSFULLY", "successfully");

/*
 * CODE
 */
define("CODE_ERROR_LENGTH", "M0001");
define("CODE_ERROR_NOT_FOUND_FOREIGN_KEY", "M0002");
define("CODE_ERROR_USER_NOT_VALID_MSG", "M0002");
define("CODE_ERROR_TYPE", "M0003");
define("CODE_ERROR_EMPTY", "M0004");
define("CODE_ERROR_UNIQUE", "M0005");
define("CODE_ERROR_NOT_VALID", "M0006");
define("CODE_ERROR_SHORT_PASSWORD", "M0007");
define("CODE_ERROR_PASSWORD_AND_CONFIRM_ARE_DIFFERENT", "M0008");
define("CODE_ERROR_FILE_DONT_EXIST", "M0009");
define("CODE_ERROR_YOU_HAVENT_PERMISSIONS", "M0010");

	class Error {
		
	    protected $error_array=array();
	    
	    protected $error_temp=array();
	    
	    /**
	     * @author Long, Sebastian
	     * @param <string> $field
	     * @param <string> $type
	     * @param <int> $level
	     * @param <string> $default_message
	     * @version 1.0
	     */
	    public function setTemporalError($field, $level, $message, $code='',$popup='') {
	        $error["field"]		= $field;
	        $error["code"]		= $code;
	        $error["level"]		= $level;
	        $error["message"]	= $message;
	        $error["popup"]=$popup;
	        $this->error_temp[]	= $error;
	    }
	    
	    public function getTemporalError() {
	        $result= $this->error_temp;
	        $this->error_temp=array();
	        return $result;
	    }
	
	    /**
	     * @author Long, Sebastian
	     * @param <string> $field
	     * @param <string> $type
	     * @param <int> $level
	     * @param <string> $default_message
	     * @version 1.0
	     */
	    public function add($field, $level, $message, $code='', $popup='') {
	        $error["field"]=$field;
	        $error["code"]=$code;
	        $error["level"]=$level;
            $error["popup"]=$popup;
	        $error["message"]=$message;
	        $this->error_array[]=$error;
	        $_SESSION['errorArray'][] = $error;
	    }
	
	    /**
	     * @author Long, Sebastian
	     * @version 1.0
	     * @return <array>
	     */
	    public function getLastErrorValidation(){
	        if(is_array($this->error_array) && count($this->error_array)>0)
	            return $this->error_array[count($this->error_array)];
	        return false;
	    }
	
	    /**
	     * @author Long, Sebastian
	     * @version 1.0
	     * @return <array of array>
	     */
	    public function getArrayErrorValidation(){
	        return $this->error_array;
	    }
		public function getArrayErrorValidationSession(){
	        return $_SESSION['errorArray'];
	    }	    
	
	    /**
	     * @author Long, Sebastian
	     * @version 1.0
	     * @return <array of array>
	     */
	    public function getArrayErrorValidationPriority(){
	        $error_array=$this->error_array;
	        $amount=count($error_array);
	        $amount2=$amount-1;
	        foreach($error_array as $k => $v) {
	            for($i=$k+1; $i<$amount2; ++$i) {
	                if($v["level"]<$error_array[$i]["level"]) {
	                    $error_array[$k]["level"]=$error_array[$i]["level"];
	                    $error_array[$i]["level"]=$v;
	                }
	            }
	        }
	        return $error_array;
	    }
	
	    /**
	     * @author Long, Sebastian
	     * @version 1.0
	     * @return <array of array>
	     */
	    public function getArrayErrorValidationAndEmpty(){
	        $aux= $this->error_array;
	        $this->error_array=array();
	        return $aux;
	    }
	
	    /**
	     * @author Long, Sebastian
	     * @version 1.0
	     */
	    public function emptyArrayErrorValidation(){
	        $this->error_array=array();
	    }

		public function emptyArrayErrorValidationSession(){
	        $_SESSION['errorArray'] = array();;
	    }
	    
		/**
	     * @author Long, Sebastian
	     * @version 1.0
	     */
	    public function existErrors(){
	        return (count($this->error_array)>0);
	    }
	    
	    public function updateTempToError() {
	    	$this->error_array = $this->error_temp;
                $this->error_temp=array();
	    }
	    
		public function existTemporalErrors(){
	        return (count($this->error_temp)>0);
	    }
	    
	    function showError(){
	    	$result = $this->getArrayErrorValidationSession();
	    	$warning = '';
	    	$fatal = '';
	    	$notice = '';
	    	$successfully = '';
	    	if ($result){
	    		foreach ($result AS $k => $value){
	    			switch ($value['level']){
	    				case 'warning':
	    					$warning .= $value['message']."<br />";
	    				break;
	    				case 'fatal':
	    					$fatal .= $value['message']."<br />";
	    				break;
	    				case 'notice':
	    					$notice .= $value['message']."<br />";
	    				break;
	    				case 'successfully':
	    					$successfully .= $value['message']."<br />";
	    				break;	    					    					    				
	    			}
	    		}	    			    		
	    	}
			if($warning!=''){
				echo "<div class='error_warning_jose'>".$warning."</div>";
			}
	    	if($fatal!=''){
				echo "<div class='error_fatal'>".$fatal."</div>";
			}
	    	if($notice!=''){
				echo "<div class='error_notice'>".$notice."</div>";
			}
	    	if($successfully!=''){
				echo "<div class='message_succesfully'>".$successfully."</div>";
			}												
	    }
	    
	    /*function showError(){
	    	if(isset($_SESSION['error_message']) && $_SESSION['error_message']!=''){
	    		echo $_SESSION['error_message'];
	    		$_SESSION['error_message'] = '';
	    	}
	    }*/
	    
	}

?>