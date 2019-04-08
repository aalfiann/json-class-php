<?php 
namespace aalfiann;
    /**
     * JSON Helper class
     *
     * @package    json-class-php
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/json-class-php/blob/master/LICENSE.md  MIT License
     */
    class JSONHelper {
        var $makesimple=false;

        /**
		 * Debugger to test json encode
		 * Note: 
		 * - Actualy this is hard to test json_encode in php way, you have to encode the string to another utf8 chars by yourself.
		 * - This is because if you do in php, json_encode function will auto giving backslash in your string if it contains invalid chars.
		 * - You have to create regex to convert char to invalid utf-8 for test in array
		 *
		 * @param string is the array or string value
		 *
		 * @return json string
		 */
		public function debug_encode($string,$options=0,$depth=512){
            if ($options==0){
                json_encode($string,JSON_UNESCAPED_UNICODE);
            } else {
                json_encode($string,$options,$depth);
            }
			$data = $this->errorMessage(json_last_error(),$string);
			return json_encode($data,JSON_PRETTY_PRINT);
		}
		
		/**
		 * Debugger to test json decode
		 *
		 * @param json is the json string
		 *
		 * @return json string
		 */
		public function debug_decode($json,$assoc=false,$depth=512,$options=0){
			$test = json_decode($json,$assoc,$depth,$options);
			if (!empty($test)) $json = $test;
			$data = $this->errorMessage(json_last_error(),$json);
			return json_encode($data,JSON_PRETTY_PRINT);
		}

		/**
		 * Case error message about json
		 * 
		 * @param jsonlasterror is the json_last_error() function
		 * @param content is the additional data about error in json
		 * 
		 * @return array
		 */
		public function errorMessage($jsonlasterror,$content){
			$data = array();
			switch ($jsonlasterror) {
				case JSON_ERROR_NONE:
					$msg = 'no errors found';
					if($this->makesimple){
						$data = ['status' => 'success','case' => 'json_error_none','message' => $msg];
					} else {
						$data = ['data'=> $content,'status' => 'success','case' => 'json_error_none','message' => $msg];
					}
					break;
				case JSON_ERROR_DEPTH:
					$msg = 'maximum stack depth exceeded';
					if($this->makesimple){
						$data = ['status' => 'error','case' => 'json_error_depth','message' => $msg];
					} else {
						$data = ['data'=> $content,'status' => 'error','case' => 'json_error_depth','message' => $msg];
					}
					break;
				case JSON_ERROR_STATE_MISMATCH:
					$msg = 'underflow or the modes mismatch';
					if($this->makesimple){
						$data = ['status' => 'error','case' => 'json_error_state_mismatch','message' => $msg];
					} else {
						$data = ['data'=> $content,'status' => 'error','case' => 'json_error_state_mismatch','message' => $msg];
					}
					break;
				case JSON_ERROR_CTRL_CHAR:
					$msg = 'unexpected control character found';
					if($this->makesimple){
						$data = ['status' => 'error','case' => 'json_error_ctrl_char','message' => $msg];
					} else {
						$data = ['data'=> $content,'status' => 'error','case' => 'json_error_ctrl_char','message' => $msg];
					}
					break;
				case JSON_ERROR_SYNTAX:
					$msg = 'syntax error, malformed json';
					if($this->makesimple){
						$data = ['status' => 'error','case' => 'json_error_syntax','message' => $msg];
					} else {
						$data = ['data'=> $content,'status' => 'error','case' => 'json_error_syntax','message' => $msg];
					}
					break;
				case JSON_ERROR_UTF8:
					$msg = 'malformed UTF-8 characters, possibly incorrectly encoded';
					if($this->makesimple){
						$data = ['status' => 'error','case' => 'json_error_utf8','message' => $msg];
					} else {
						$data = ['data'=> $content,'status' => 'error','case' => 'json_error_utf8','message' => $msg];
					}
					break;
				case JSON_ERROR_RECURSION:
					$msg = 'malformed one or more recursive references, possibly incorrectly encoded';
					if($this->makesimple){
						$data = ['status' => 'error','case' => 'json_error_recursion','message' => $msg];
					} else {
						$data = ['data'=> $content,'status' => 'error','case' => 'json_error_recursion','message' => $msg];
					}
					break;
				case JSON_ERROR_INF_OR_NAN:
					$msg = 'malformed NAN or INF, possibly incorrectly encoded';
					if($this->makesimple){
						$data = ['status' => 'error','case' => 'json_error_inf_or_nan','message' => $msg];
					} else {
						$data = ['data'=> $content,'status' => 'error','case' => 'json_error_inf_or_nan','message' => $msg];
					}
					break;
				case JSON_ERROR_UNSUPPORTED_TYPE:
					$msg = 'a value of a type that cannot be encoded was given';
					if($this->makesimple){
						$data = ['status' => 'error','case' => 'json_error_unsupported_type','message' => $msg];
					} else {
						$data = ['data'=> $content,'status' => 'error','case' => 'json_error_unsupported_type','message' => $msg];
					}
					break;
				case JSON_ERROR_INVALID_PROPERTY_NAME:
					$msg = 'a property name that cannot be encoded was given';
					if($this->makesimple){
						$data = ['status' => 'error','case' => 'json_error_invalid_property_name','message' => $msg];
					} else {
						$data = ['data'=> $content,'status' => 'error','case' => 'json_error_invalid_property_name','message' => $msg];
					}
					break;
				case JSON_ERROR_UTF16:
					$msg = 'malformed UTF-16 characters, possibly incorrectly encoded';
					if($this->makesimple){
						$data = ['status' => 'error','case' => 'json_error_utf16','message' => $msg];
					} else {
						$data = ['data'=> $content,'status' => 'error','case' => 'json_error_utf16','message' => $msg];
					}
					break;
				default:
					$msg = 'unknown error';
					if($this->makesimple){
						$data = ['status' => 'error','case' => 'unknown','message' => $msg];
					} else {
						$data = ['data'=> $content,'status' => 'error','case' => 'unknown','message' => $msg];
					}
					break;
			}
			return $data;
		}
		
		/**
		 * Trim to strip the whitespace (or other characters) from the beginning and end of a string
		 *
		 * @param string is the array string or value
		 *
		 * @return string
		 */
		public function trimValue($string){
			if (is_array($string)) {
				foreach ($string as $k => $v) {
					$string[$k] = $this->trimValue($v);
				}
			} else if (is_string ($string)) {
				return trim($string);
			}
			return $string;
		}

        /**
		 * Convert string to valid UTF8 chars (Faster but not support for ANSII)
		 *
		 * @param string is the array string or value
		 *
		 * @return string
		 */
		public function convertToUTF8($string){
			if (is_array($string)) {
				foreach ($string as $k => $v) {
					$string[$k] = $this->convertToUTF8($v);
				}
			} else if (is_string ($string)) {
				return utf8_encode($string);
			}
			return $string;
        }

        /**
		 * Convert string to valid UTF8 chars (slower but support ANSII)
		 *
		 * @param string is the array string or value
		 *
		 * @return string
		 */
		public function convertToUTF8Ansii($string){
			if (is_array($string)) {
				foreach ($string as $k => $v) {
					$string[$k] = $this->convertToUTF8Ansii($v);
				}
			} else if (is_string ($string)) {
				return mb_convert_encoding($string, "UTF-8", "Windows-1252");
			}
			return $string;
		}

		/**
		 * Most common fixed hidden control char in json string which made json decode fails.
		 * 
		 * @param string is the string or json string
		 * @return string
		 */
		public function fixControlChar($string){
			//Sanitize hidden control chars
			for ($i = 0; $i <= 9; ++$i) { 
				$string = str_replace(chr($i), "", $string); 
			}
			for ($i = 11; $i <= 12; ++$i) { 
				$string = str_replace(chr($i), "", $string); 
			}
			for ($i = 14; $i <= 31; ++$i) { 
				$string = str_replace(chr($i), "", $string); 
			}
			$string = str_replace(chr(127), "", $string);
			//Handle Byte Order Mark (BOM)
			if (0 === strpos(bin2hex($string), 'efbbbf')) {
				$string = substr($string, 3);
			}
			//Handle newline char
			$string = preg_replace("/[\r\n]+/", "\\n", $string);
			return $string;
		}
        
        /**
         * Modify json data string in some field array to be nice json data structure
		 * 
		 * Note:
		 * - When you put json into database, then you load it with using PDO:fetch() or PDO::fetchAll() it will be served as string inside some field array.
		 * - So this function is make you easier to modify the json string to become nice json data structure automatically.
		 * - This function is well tested at here >> https://3v4l.org/IWkjn
         * 
         * @param data is the data array
         * @param jsonfield is the field which is contains json string
         * @param setnewfield is to put the result of modified json string in new field
         * @return mixed array or string (if the $data is string then will return string)
         */
		public function modifyJsonStringInArray($data,$jsonfield,$setnewfield=""){
			if (is_array($data)){
				if (count($data) == count($data, COUNT_RECURSIVE)) {
					foreach($data as $value){
						if(!empty($setnewfield)){
							if (is_array($jsonfield)){
								for ($i=0;$i<count($jsonfield);$i++){
									if (isset($data[$jsonfield[$i]])){
										$data[$setnewfield[$i]] = json_decode($data[$jsonfield[$i]]);
									}
								}
							} else {
								if (isset($data[$jsonfield])){
									$data[$setnewfield] = json_decode($data[$jsonfield]);
								}
							}
						} else {
							if (is_array($jsonfield)){
								for ($i=0;$i<count($jsonfield);$i++){
									if (isset($data[$jsonfield[$i]])){
										if (is_string($data[$jsonfield[$i]])) {
                                            $decode = json_decode($data[$jsonfield[$i]]);
                                            if (!empty($decode)) $data[$jsonfield[$i]] = $decode;
                                        }
									}
								}
							} else {
								if (isset($data[$jsonfield])){
                                    $decode = json_decode($data[$jsonfield]);
                                    if (!empty($decode)) $data[$jsonfield] = $decode;
								}
							}
						}
					}
				} else {
					foreach($data as $key => $value){
						$data[$key] = $this->modifyJsonStringInArray($data[$key],$jsonfield,$setnewfield);
					}
				}
			}
			return $data;
		}

		/**
		 * Concatenate json data
		 * Example: https://3v4l.org/fXjhd
		 * 
		 * @param data is the json string or array value
		 * @param escape if set to false then json data will not escaped. Default is true.
		 * @param options is to set the options of json_encode (for data array only). Ex: JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE
		 * @param depth is to set the recursion depth. Default is 512.
		 * @return string
		 */
		public function concatenate($data,$escape=true,$options=0,$depth=512){
			if(!empty($data)){
				if(is_array($data)){
					if($escape) return addcslashes(json_encode($data,$options,$depth),"\"'\n");
					return json_encode($data,$options,$depth);
				}
				if($escape) return addcslashes($data,"\"'\n");
				return $data;
			}
			if($escape) return '';
			return '""';
		}

		/**
		 * Minify the json string
		 * 
		 * @param json is the json string
		 * @return string
		 */
		public function minify($json){
			$tokenizer = "/\"|(\/\*)|(\*\/)|(\/\/)|\n|\r/";
			$in_string = false;
			$in_multiline_comment = false;
			$in_singleline_comment = false;
			$tmp; $tmp2; $new_str = array(); $ns = 0; $from = 0; $lc; $rc; $lastIndex = 0;
			while (preg_match($tokenizer,$json,$tmp,PREG_OFFSET_CAPTURE,$lastIndex)){
				$tmp = $tmp[0];
				$lastIndex = $tmp[1] + strlen($tmp[0]);
				$lc = substr($json,0,$lastIndex - strlen($tmp[0]));
				$rc = substr($json,$lastIndex);
				if (!$in_multiline_comment && !$in_singleline_comment){
					$tmp2 = substr($lc,$from);
					if (!$in_string){
						$tmp2 = preg_replace("/(\n|\r|\s)*/","",$tmp2);
					}
					$new_str[] = $tmp2;
				}
				$from = $lastIndex;
				if ($tmp[0] == "\"" && !$in_multiline_comment && !$in_singleline_comment){
					preg_match("/(\\\\)*$/",$lc,$tmp2);
					if (!$in_string || !$tmp2 || (strlen($tmp2[0]) % 2) == 0){ // start of string with ", or unescaped " character found to end string
						$in_string = !$in_string;
					}
					$from--; // include " character in next catch
					$rc = substr($json,$from);
				} else if ($tmp[0] == "/*" && !$in_string && !$in_multiline_comment && !$in_singleline_comment){
					$in_multiline_comment = true;
				} else if ($tmp[0] == "*/" && !$in_string && $in_multiline_comment && !$in_singleline_comment){
					$in_multiline_comment = false;
				} else if ($tmp[0] == "//" && !$in_string && !$in_multiline_comment && !$in_singleline_comment){
					$in_singleline_comment = true;
				} else if (($tmp[0] == "\n" || $tmp[0] == "\r") && !$in_string && !$in_multiline_comment && $in_singleline_comment){
					$in_singleline_comment = false;
				} else if (!$in_multiline_comment && !$in_singleline_comment && !(preg_match("/\n|\r|\s/",$tmp[0]))){
					$new_str[] = $tmp[0];
				}
			}
			$new_str[] = $rc;
			return implode("",$new_str);
		}

    }