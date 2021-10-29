<?php
Use App\Model\Message;
if(!defined('SESSION_LOCALE_KEY')){
	define('SESSION_LOCALE_KEY', 'locale');
}


if(!defined('SESSION_COUNTRY_KEY')){
	define('SESSION_COUNTRY_KEY', 'country_code');
}

if (! function_exists('pr')) {

	function pr($data=array()){
		echo "<pre>" ;
		print_r($data);
		echo "</pre>";
	}
}

if (! function_exists('getAlignment')) {
   function getAlignment($lang_code=null){
       if(empty($lang_code)){
           $lang_code=\App::getLocale();
       }
        $align_array = ["ar"=>"rtl","en"=>'ltr'];
        return $align_array[strtolower($lang_code)];
    }
}
if (! function_exists('getTextAlign')) {
    function getTextAlign($lang_code=null){
        if(empty($lang_code)){
            $lang_code=\App::getLocale();
        }
        $align_array = ["ar"=>"right","en"=>'left'];
        return $align_array[strtolower($lang_code)];
    }

}

if (! function_exists('getSelectedLocale')) {
    function getSelectedLocale(){
        return \App::getLocale();
    }
}
if (! function_exists('getFirstError')) {
    function getFirstError($errors){
        $errors = array_map('array_shift',$errors);
        return reset($errors);
    }
}
