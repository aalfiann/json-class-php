<?php
namespace aalfiann;
    interface JSONInterface {
        /**
		 * Encode Array or string value to json (faster with no any conversion to utf8)
		 *
		 * @param data is the array or string value
		 * @param options is to set the options of json_encode. Ex: JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS
		 * @param depth is to set the recursion depth. Default is 512.
		 *
		 * @return json string
		 */
        public function encode($data,$options=0,$depth=512);

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
        public function decode($json,$assoc=false,$depth=512,$options=0);
}