<?php
require_once "traits/ValidatePHP_ID.php";
class DataValidator {
    private $dataTypesArray;
    private $nullDataArray;
    private $columnNames;

    public function __construct($columnNames = NULL, $dataTypesArray = NULL, $nullDataArray = NULL) {
        $this->dataTypesArray = $dataTypesArray;
        $this->nullDataArray = $nullDataArray;
        $this->columnNames = $columnNames;
    }

    ####################
    #included trait
    use ValidatePHP_ID;

    ####################
    #front-end methods

    /**
     * This method is used to generate valid frontend validation based on the columnTypes in a mysql database
     * @param  array $dataTypesArray     an array of valid sql datatypes is needed
     * @return array                     an array of valid frontend validation
     */
    public function GetHtmlValidateData($dataTypesArray = NULL) {
        if ($dataTypesArray == NULL) {
            $dataTypesArray = $this->dataTypesArray;
        }
        // return Html Validation shizzle

        for ($i=0; $i<count($dataTypesArray); $i++) {

            // int tests
            if (strpos($dataTypesArray[$i], 'int') !== false) {
                if (strpos($dataTypesArray[$i], 'tinyint') !== false) {
                    $dataTypesArray[$i] = $this->ValidateHTMLInt($dataTypesArray[$i], 'tiny');

                } else if (strpos($dataTypesArray[$i], 'smallint') !== false) {
                    $dataTypesArray[$i] = $this->ValidateHTMLInt($dataTypesArray[$i], 'small');

                } else if (strpos($dataTypesArray[$i], 'mediumint') !== false) {
                    $dataTypesArray[$i] = $this->ValidateHTMLInt($dataTypesArray[$i], 'medium');

                } else if (strpos($dataTypesArray[$i], 'bigint') !== false) {
                    $dataTypesArray[$i] = $this->ValidateHTMLInt($dataTypesArray[$i], 'big');

                } else if (strpos($dataTypesArray[$i], 'int') !== false) {
                    $dataTypesArray[$i] = $this->ValidateHTMLInt($dataTypesArray[$i], '');
                }
            }

            // StringTests
             else if (strpos($dataTypesArray[$i], 'varchar') !== false) {
                $dataTypesArray[$i] = $this-> ValidateHTMLVarchar($dataTypesArray[$i]);
            }

            // Double/decimal Number Tests
            else if (strpos($dataTypesArray[$i], 'decimal') !== false) {
                $dataTypesArray[$i] = $this->ValidateHTMLDecimal($dataTypesArray[$i]);
            }

            // Date/time tests
             else if (strpos($dataTypesArray[$i], 'date') !== false) {
                $dataTypesArray[$i] = $this->ValidateHTMLDate();
            }
        }
        return $dataTypesArray;
    }

    /**
     * a method to get a frontend validation for a varchar field in mysql
     * @param  string  $data   needs something like "varchar([int])"
     * @return string  returns a valid piece of html to use in a input element
     */
    private function ValidateHTMLVarchar($data) {
        $data = $this->PrepValidateVarchar($data);
        $data = "type='text' maxlength='$data' pattern='[^\s$][A-Za-z0-9!@#$%\^&*\s.,:;+-()]*'";

        return $data;
    }

    /**
     * Method to select which integervalidation method needs to be used,
     * then call it and generate the frontend validation with its results
     * @param  string $data   a string of the sqlDataType
     * @param  string $option a string with a valid integersize
     * @return string         a string of valid html to use in a input element
     */
    private function ValidateHTMLInt($data, $option = '') {

        if ($option === 'tiny') {
            $data = $this->PrepValidateTinyInt($data);

        } else if ($option === 'small') {
            $data = $this->PrepValidateSmallInt($data);

        } else if ($option === 'medium') {
            $data = $this->PrepValidateMediumInt($data);

        } else if ($option === '') {
            $data = $this->PrepValidateInt($data);

        } else if ($option === 'big') {
            $data = $this->PrepValidateBigInt($data);
        }

        // set min and max
        $min = $data["min"];
        $max = $data["max"];

        $data = "type='number' step='1' min='$min' max='$max'";
        return $data;
    }

    /**
     * this method is used to create frontend validation based on a mysqlType
     * @param  string $data needs a string with a valid decimal mysql type
     * @return string       method return html that can be used in a inputElement
     */
    private function ValidateHTMLDecimal($data) {
        // get numericData
        $data = $this->prepValidateDecimal($data);

        // set decimal and max
        $decimal = $data["decimal"];
        $max = $data["max"];

        $data = "type='number' max='$max' step='$decimal'";
        return $data;

    }

    /**
     * this method is used to create frontend validation based on a mysqlType
     * @return string       method returns html that can be used in a inputElement
     */
    private function ValidateHTMLDate() {
        $data = "type='date'";
        return $data;
    }

    /**
     * this method is used to generated frontend validation
     * and specigicly to say if a field is required or is optional
     * also some fields from the array can be leftout if required
     * @param array  $nullDataArray     expects an array with nullvalues in them
     * @param string $selectionCode     expects an string with the numbers 0123
     *                                  0 for don't get the data on this position
     *                                  1 for get the data on this position
     *                                  2 for get data on this position and all after it
     *                                  3 for dont get this data or any after it
     *
     * @return array                    returns an array with html strings which can be used in inputElements
     */
    public function ValidateHTMLNotNull($nullDataArray = NULL, $selectCode = NULL) {

        if ($nullDataArray == NULL) {
            $nullDataArray = $this->nullDataArray;
        }

        if ($selectCode !== NULL) {
            $nullDataArray = $this->SelectWithCodeFromArray($nullDataArray, $selectCode);
        }

        for ($i=0; $i < count($nullDataArray); $i++) {
            if (strpos($nullDataArray[$i], 'YES') !== false) {
                $nullDataArray[$i] = "";

            } else if (strpos($nullDataArray[$i], 'NO') !== false) {
                $nullDataArray[$i] = "required";
            }
        }

        return $nullDataArray;
    }

    ####################
    #back-end methods

    /**
     * this method is used to check if all fields that are required are correctly filled in the backend
     * this is checked based on a nullvalues array that can be supplied by the dataHandler
     * @param array  $assocArray        array with data from a $_POST or $_GET for example
     * @param array  $nullDataArray     array with nullvalues to be used
     * @param array  $columnNames       array with columnNames
     * @param string $selectionCode     expects an string with the numbers 0123
     *                                  0 for don't get the data on this position
     *                                  1 for get the data on this position
     *                                  2 for get data on this position and all after it
     *                                  3 for dont get this data or any after it
     *
     * @return bool                     true, false
     */
    public function ValidatePHPRequired($assocArray, $nullDataArray = NULL, $columnNames = NULL, $selectCode = NULL) {
        if ($nullDataArray == NULL) {
            $nullDataArray = $this->nullDataArray;
        }

        if ($columnNames == NULL) {
            $columnNames = $this->columnNames;
        }

        if ($selectCode !== NULL) {
            $columnNames = $this->SelectWithCodeFromArray($columnNames, $selectCode);
            $nullDataArray = $this->SelectWithCodeFromArray($nullDataArray, $selectCode);
        }

        for ($i=0; $i<count($columnNames); $i++) {
            // test each columnName inside assoc array one at a time

            if ($nullDataArray[$i] == "YES") {
                continue;
            }

            else if ($nullDataArray[$i] == "NO") {
                if (!isset($assocArray[$columnNames[$i]])) {
                    return FALSE;
                }
                $test = $this->TestIfNotEmpty( $assocArray[$columnNames[$i]] );

                // if one of the tests fails return false
                if ($test == FALSE) {
                    return FALSE;
                }
            }
        }
        return TRUE;
    }

    /**
     * this method is used to check if the minimal amount of character in the string has been reached
     * @param int       $length a integer
     * @param string    $string a valid string
     *
     * @return bool     true, false
     */
    private function TestMinimalLength($length, $string = "") {
        if (strlen($string) < $length) {
            return FALSE;

        } else {
            return TRUE;
        }
    }

    /**
     * this method is used to see if the string has less characters than the maximum given length
     * @param int       $length a integer
     * @param string    $string a valid string
     *
     * @return bool     true, false
     */
    private function TestMaximumLength($length, $string = "") {
        if (strlen($string) > $length) {
            return FALSE;

        } else {
            return TRUE;
        }
    }

    /**
     * this method returns true or false based
     * on if given value is a string and has only numbers in it or is a double or integer
     * @param  any      $val    a double, integer, array, or string can be supplied
     *
     * @return bool             true,false
     */
    private function ValidatePHPFloat_Double($val) {
        return is_numeric($val);
    }

    /**
     * this method is used to validate that the supplied val is equal to the supplied mysql decimal type.
     * @param  any    $val    the value to be tested
     * @param  string $data   an sql decimalType like Decimal(5,2) for a number like 999.99
     *
     * @return bool          true,false
     */
    private function ValidatePHPDecimal($val, $data) {
        if (is_numeric($val) ) {
            // get numericData
            $data = $this->prepValidateDecimal($data);

            // set decimal and max
            $decimal = $data["decimal"];
            $max = $data["max"];

            if (!($string < $max)) {
                return FALSE;

            } else if ( !(($val*1) == round($val, 2)) ) {
                return FALSE;

            } else {
                return TRUE;
            }

        } else {
            return FALSE;
        }
    }

    /**
     * this method is used to validate if a value can be succesfully validated as a integer
     * @param  any   $val   this is the value to be tested
     *
     * @return bool         true, false
     */
    private function ValidatePHPInt($val) {
        if (is_numeric($val) && floor($val) == $val) {
            return TRUE;

        } else {
            return FALSE;
        }
    }

    private function ValidatePHPBoolean($string) {
        if ($string == '1' || $string == 1 || $string === TRUE ||
        $string == '0' || $string == 0 || $string === FALSE) {
            return TRUE;

        } else {
            return FALSE;
        }
    }

    private function TestIfEmail() {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
          return TRUE;

        } else {
          return FALSE;
        }
    }

    private function TestIfNotEmpty($string) {
        $string = trim($string);

        if ( !isset($string) || $string == "" ) {
            return FALSE;

        } else {
            return TRUE;
        }

    }

    private function TestIfNoHtmlChars($string, $option = 0) {
        // forbid htmlChars
        if ($option == 0) {
            if (htmlspecialchars($string) == $string) {
                return TRUE;

            } else {
                return FALSE;
            }

        // convert HtmlChars
        } else if ($option == 1) {
            return htmlspecialchars($string);

        // allow html chars Not recomended
        } else if ($option == 2) {
            return $string;

        // if a wrong option is selected
        } else {
            throw new Exception("Wrong option selected in HtmlSpecialChars", $option);

        }
    }

    ####################
    #essential methods
    private function prepValidateDecimal($data) {
        $data = str_replace("decimal(", "", $data);
        $data = str_replace(")", "", $data);
        $splittedData = explode(",", $data);

        // set decimal
        $decimal = 0.1 ** $splittedData[1];

        // set max
        $multiplier = $splittedData[0]-$splittedData[1];
        $max = 10 ** $multiplier;
        $max = $max - $decimal;

        return ['decimal' => $decimal, 'max'=> $max];
    }

    private function PrepValidateVarchar($data) {
        $data = str_replace("varchar(", "", $data);
        $data = str_replace(")", "", $data);
        return $data;
    }

    private function PrepValidateChar($data) {
        $data = str_replace("char(", "", $data);
        $data = str_replace(")", "", $data);
        return $data;
    }

    private function PrepValidateTinyInt($data) {
        if (strpos($data, 'unsigned') !== false){
            $max = 255;
            $min = 0;
        } else {
            $max = 	127;
            $min = -128;
        }

        return ['min' => $min,'max'=> $max];
    }

    private function PrepValidateSmallInt($data) {
        if (strpos($data, 'unsigned') !== false){
            $max = 65535;
            $min = 0;
        } else {
            $max = 	32767;
            $min = -32768;
        }

        return ['min' => $min,'max'=> $max];
    }

    private function PrepValidateMediumInt($data) {
        if (strpos($data, 'unsigned') !== false){
            $max = 16777215;
            $min = 0;
        } else {
            $max = 	8388607;
            $min = -8388608;
        }

        return ['min' => $min,'max'=> $max];
    }

    private function PrepValidateInt($data) {
        if (strpos($data, 'unsigned') !== false){
            $max = 4294967295;
            $min = 0;
        } else {
            $max = 	2147483647;
            $min = -2147483648;
        }

        return ['min' => $min,'max'=> $max];
    }

    private function PrepValidateBigInt($data) {
        if (strpos($data, 'unsigned') !== false){
            $max = (2 ** 64)-1;
            $min = 0;
        } else {
            $max = 	(2 ** 63)-1;
            $min = (-2 ** 63);
        }

        return ['min' => $min,'max'=> $max];
    }
}
?>
