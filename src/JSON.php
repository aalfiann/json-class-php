<?php
namespace aalfiann;
	/**
     * A class for handle json in a better way
	 * 
	 * Note:
	 *  - Chars in JSON Standard is require Unicode UTF-8, But sometimes chars returned from input, submit or fetch from
     *    database are contains unicode characters. So is best to use this class for prevent any error on data json.
	 *  - This class is good to handle json from other resource or for experimental purpose.
     *
     * @package    json-class-php
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/json-class-php/blob/master/LICENSE.md  MIT License
     */
	class JSON extends JSONHelper implements JSONInterface {

        var $withlog=false,$sanitize=false,$ansii=false,$debug=false,$makesimple=false,$trim=false;

        /**
         * Trim to remove whitespace or any character consider to blank value
         * 
         * @param trim if set to true then data value will be trimmed. Default is true.
         * @return this for chaining purpose
         */
        public function withTrim($trim=true){
            $this->trim = $trim;
            return $this;
        }
        
        /**
         * Sanitize to prevent json encode
         * 
         * @param sanitize if set to true then data will sanitized before encoding. Default is true.
         * @return this for chaining purpose
         */
        public function withSanitizer($sanitize=true){
            $this->sanitize = $sanitize;
            return $this;
        }

        /**
         * Json Logger
         * 
         * @param withlog if set to true then your data will appended with log. Default is true.
         * @return this for chaining purpose
         */
        public function withLog($withlog=true){
            $this->withlog = $withlog;
            return $this;
        }

        /**
         * Support ANSII chars for sanitize
         * 
         * @param ansii if set to true then sanitize will support for ANSII chars. Default is true.
         * @return this for chaining purpose
         */
        public function setAnsii($ansii=true){
            if ($this->sanitize) $this->ansii = $ansii;
            return $this;
        }

        /**
         * For debugging json
         * 
         * @param debug if set to true then will show the data debug json. Default is true.
         * @return this for chaining purpose
         */
        public function setDebug($debug=true){
            $this->debug = $debug;
            return $this;
        }

        /**
         * This will make debug output simpler.
         * 
         * @param makesimple if set to true will hide the additional data about error in json. Default is true.
         * @return this for chaining purpose
         */
        public function makeSimple($makesimple=true){
            if($this->debug) $this->makesimple = $makesimple;
            return $this;
        }

        /**
		 * Encode Array or string value to json (faster with no any conversion to utf8)
		 *
		 * @param data is the array or string value
		 * @param options is to set the options of json_encode. Ex: JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS
		 * @param depth is to set the recursion depth. Default is 512.
		 *
		 * @return json string
		 */
        public function encode($data,$options=0,$depth=512){
            if($this->debug) return $this->debug_encode($data,$options,$depth);
            if($this->trim) $data = $this->trimValue($data);
			if($this->withlog && is_array($data)) $data['logger'] = ['timestamp' => date('Y-m-d H:i:s', time()),'uniqid'=>uniqid()];
            if ($this->sanitize) {
                return json_encode((($this->ansii)?$this->convertToUTF8Ansii($data):$this->convertToUTF8($data)),$options,$depth);
            }
            return json_encode($data,$options,$depth);
		}

		/**
		 * Decode json string (if fail will return null)
		 *
		 * @param json is the json string
		 * @param assoc if set to true then will return as array()
		 * @param depth is to set the recursion depth. Default is 512.
		 * @param options is to set the options of json_decode. Ex: JSON_BIGINT_AS_STRING|JSON_OBJECT_AS_ARRAY
		 *
		 * @return mixed stdClass/array
		 */
		public function decode($json,$assoc=false,$depth=512,$options=0){
            if($this->debug) return $this->debug_decode($json,$assoc,$depth,$options);
            if($this->trim) {
                $json = json_encode($this->trimValue(json_decode($json,1,$depth)));
                return json_decode($json,$assoc,$depth,$options);
            }
			return json_decode($json,$assoc,$depth,$options);
		}

		/**
		 * Determine is valid json or not
		 *
		 * @param json is the json string
		 *
		 * @return bool
		 */
		public function isValid($json=null) {
			if (empty($json) || ctype_space($json)) return false;
			json_decode($json);
			return (json_last_error() === JSON_ERROR_NONE);
		}

    }