<?php

class PhpUtilities {
    function __construct() {

    }

    /**
     * this method is used to specify how many decimals you want in a float equal to toFixed in JS
     * @param  float  $number   the number to cut to a specific decimal amount
     * @param  int    $decimals a number to use how many decimals you want
     * @return float            return the decimal number cut to a specified amount
     */
    public function toFixed($number, $decimals) {
        return number_format($number, $decimals, ".", "");
    }

    /***
    * $array expects an 2dimensional numeric array with assoc arrays in it
    * $key expects an string (is used as key for the inner assoc arrays)
    *
    * @Description
    * converts regular . to , and adds euro sighn in front */

    /**
     * this method is used to convert numbers in a 2d array from regular US standard to NL standard
     * @param  array  $array a 2darray to be able to loop through
     * @param  string $key   the key to be used to select how to loop through the array
     *
     * @return string        returns the converted array
     */
    public function convert_NormalToEuro_2DArray($array = NULL, $key = NULL) {
        // Convert to . to , with euro
        for ($i=0; $i < count($array); $i++) { // Loop and convert all shown data
            $array[$i]["$key"] = "&euro;" . $array[$i]["$key"];
            $array[$i]["$key"] = str_Replace(".", ",", $array[$i]["$key"]);
        }
        return $array;
    }

    /***
    * $array expects an 2dimensional numeric array with assoc arrays in it
    * $key expects an string (is used as key for the inner assoc arrays)
    *
    * @Description
    * converts regular . to , and adds euro sighn in front */
    public function convert_EuroToNormal_2DArray($array = NULL, $key = NULL) {
        // Convert to . to , with euro
        for ($i=0; $i < count($array); $i++) { // Loop and convert all shown data
            $array[$i]["$key"] = str_Replace(",", ".", $array[$i]["$key"]);
            $array[$i]["$key"] = str_Replace("&euro;", "", $array[$i]["$key"]);
            $array[$i]["$key"] = str_Replace("€", "", $array[$i]["$key"]);
        }
        return $array;
    }

    /***
    * $string expects an string with numbers + eurosign
    *
    * @Description
    * converts regular . to , and adds euro sighn in front */
    public function convert_NormalToEuro($string) {
        // Convert to . to , with euro
            $string = "&euro;" . $string;
            $string = str_Replace(".", ",", $string);

        return $string;
    }

    /***
    * $string expects an string with numbers + eurosign
    *
    * @Description
    * removes eurosign and converts , to .
    */
    public function convert_EuroToNormal($string) {
        // $data is a string
        $string = str_Replace(",", ".", $string);
        $string = str_Replace("&euro;", "", $string);
        $string = str_Replace("€", "", $string);

        return $string;
    }

    /****
    ** description -> Selects specified data from an array
    ** relies on methods -> Null

    ** Requires -> $array, $code
    ** string variables -> $code
    ** array variables -> $array
    ****/
    public function selectWithCodeFromArray($array, $code) {
        $splittedCode = str_split($code);
        $return = []; // <--- is used to store the output data
        $y=0; // <--- is used to count in which position the next datapiece needs to go

        for ($i=0; $i<count($array); $i++) {
            if ($splittedCode[$i] == 0) {

            }
            else if ($splittedCode[$i] == 1) {
                $return[$y] = $array[$i];
                $y++;
            }
            else if ($splittedCode[$i] == 2) {
                //runs till the end of the array and writes everything inside the array
                for ($i=$i; $i<count($array); $i++) {
                    $return[$y] = $array[$i];
                    $y++;
                }
            }
            else if ($splittedCode[$i] == 3) {
                //runs till the end of the array and writes nothings
                for ($i=$i; $i<count($array); $i++) {

                }
            }
        }
        return $return;
    }

    public function assocToNumericConversion($AssocArray) {
        $resultArray = [];
        $i = 0;
        foreach ($AssocArray as $key => $value) {
            $resultArray[$i] = $value;
            $i++;
        }

        return $resultArray;
    }

    public function selectFromAssoc($AssocArray, $code) {
        $i = 0;
        $y = 0;
        foreach ($AssocArray as $key => $value) {
            if ($code[$i] === "0") {

            }

            else if ($code[$i] === "1") {
                $resultArray[$key] = $value;
                $y++;
            }
            $i++;
        }

        return $resultArray;
    }
}
