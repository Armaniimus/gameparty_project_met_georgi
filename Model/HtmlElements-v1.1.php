<?php

Class HtmlElements {
    public function __Construct() {

    }

    /**
     * this method is used to generate a table with data contained in them
     * @param  array  $dataArray2d       2 dimensional array the outer being an assoc array and the inner being numbered
     * @param  string $htmlTableName     a name that is used as id for the html table
     *                                   also the following html classes are generated to be used in css
     *                                   $tablename, $tablename--thead, $tablename--tbody, $tablename--tr, $tablename--th, $tablename--td
     *
     * @param  array  $option            an array or string with booleans
     *                                   option[0] border?
     *                                   option[1] width 100%?
     *                                   option[2] future use
     *
     * @param  array  $extraColumnsArray an array with extra data can be used to extent functionality
     * @param  string $specialColumnName a column title for the extra collumns
     * @return
     */
    public function GenerateButtonedTable($dataArray2d, $htmlTableName, $option, $extraColumnsArray = NULL, $specialColumnName = NULL) {

        if (!empty($extraColumnsArray) ) {
            $extraLength = count($extraColumnsArray[0]);
        } else {
            $extraLength = 0;
        }

        $border = "";
        $width = "";

        if ($option[0] == "1") {
            $border = "border='1'";
        }

        if ($option[1] == "1") {
            $width = "width='100%'";
        }

        if ($option[2] == "1") {
            // select checkboxes
        }

        $table = "<table $border $width class='$htmlTableName' id='$htmlTableName'>" .
            $this->ButtonedTableHead($dataArray2d, $htmlTableName, $extraLength, $specialColumnName) .
            $this->ButtonedTableBody($dataArray2d, $htmlTableName,  $extraColumnsArray) .
        "</table>";

        return $table;
    }

    /**
     * This method is used to generate a form based on the inputs
     * @param string  $sendMethod           set if the send method is a post, put, get, etc
     * @param string  $targetUrl            set where the form info needs to be sended to
     * @param string  $formName             set a form name to be used for the css
     * @param array   $DB_data              an array with data from a DataBase
     * @param array   $DB_columnNames       an array with database columnNames
     * @param array   $DB_dataTypesArray    an array with database variableTypes used for frontend validation
     * @param array   $DB_requiredNullArray an array with database required fields
     * @param integer $option               option is used to generate slightly diffrent forms
     *                                      option 1 is used to generate a form with no data prefilled
     *                                      option 3 is used to hide the first item of the form
     */
    public function GenerateForm($sendMethod, $targetUrl, $formName, $DB_data, $DB_columnNames, $DB_dataTypesArray, $DB_requiredNullArray, $option = 0) {
        $headAndFoot = $this->SetHeadAndFootForm($formName, $targetUrl, $sendMethod);
        $main = $this->GenerateFormMainData($formName, $DB_data, $DB_columnNames, $DB_dataTypesArray, $DB_requiredNullArray, $option);
        return $this->CombineForm($headAndFoot["header"], $main, $headAndFoot["footer"]);
    }

    /**
     * This method is used to fill a single row table with the given data
     * @param  array  $generationData needs to be a numbered array
     * @param  string $tableName      a name to use in the html class of the table
     * @return string                 returns a simple 1 row table
     */
    public function GeneratePaginationTable($generationData, $tableName) {
        $table = "<table class='$tableName'><tr>";
        for ($i=0; $i<count($generationData); $i++) {
            $table .= "<td>" . $generationData[$i] . "</td>";
        }
        $table .= "</tr></table>";

        return $table;
    }

    /**
     * this method is used to generate the tableheads of all columns
     * @param array   $dataArray2d     2 dimensional array the outer being an assoc array and the inner being numbered
     *                                 such as is typicaly returned by the datahandler
     * @param string  $tablename       used to make the css classes tablename--thead, .tablename--tr, .tablename--th
     * @param integer $extraLength     used to define how much extra length is needed after the columns
     * @param string  $extraColumnName a string with a suitable name for this column
     */
    private function ButtonedTableHead($dataArray2d, $tablename, $extraLength = 0, $extraColumnName = NULL) {
        // table Collumn names
        $head = "<thead class='$tablename--thead'>";
            foreach ($dataArray2d as $key => $value) {
                $row = "<tr class='$tablename--tr'>";
                "<td></td>";
                    foreach ($value as $columnName => $v) {
                        $columnName[0] = strToUpper($columnName[0]);
                        $row .= "<th class='$tablename--th'>" . $columnName . "</th>";
                    }
                    if ($extraLength > 0) {
                        $extraColumnName[0] = strToUpper($extraColumnName[0]);
                        $row .= "<th class='$tablename--th' colspan='$extraLength'>$extraColumnName</th>";
                    }

                $row .= "</tr>";

                $head .= $row;
                break;
            }
        $head .= "</thead>";
        return $head;
    }

    /**
     * this method is used to generate the body of an html table
     * @param  array  $dataArray2d       2 dimensional array the outer being an assoc array and the inner being numbered
     *                                   such as is typicaly returned by the datahandler
     * @param  string $tablename         an name used to generate html class names for css styling names generated are .tablename--tbody, .tablename--tr, .tablename--td
     * @param  array  $extraColumnsArray a table with extra data to be added can be used to extent functionality
     * @return string                    the body of a html table
     */
    private function ButtonedTableBody($dataArray2d, $tablename, $extraColumnsArray) {
        // table Body
        $body = "<tbody class='$tablename--tbody'>";

            $i=0;
            foreach ($dataArray2d as $key => $value) {
                $row = "<tr class='$tablename--tr'>";
                    foreach ($value as $k => $v) {
                        $row .= "<td class='$tablename--td'>" . $value[$k] . "</td>";
                    }

                    for ($ii=0; $ii < count($extraColumnsArray[$i]) ; $ii++) {
                        $row .= $extraColumnsArray[$i][$ii];
                    }
                $row .= "</tr>";
                $body .= $row;
                $i++;
            }
        $body .= "</tbody>";
        return $body;
    }

    /**
     * the method is used to generate the innerpart of a form based on the following data
     * @param string  $formName          set a form name to be used for the css
     * @param array   $data              an array with data from a DataBase
     * @param array   $columnNames       an array with database columnNames
     * @param array   $dataTypesArray    an array with database variableTypes used for frontend validation
     * @param array   $requiredNullArray an array with database required fields
     * @param integer $option            option is used to generate slightly diffrent forms
     *                                   option 1 is used to generate a form with no data prefilled
     *                                   option 3 is used to hide the first item of the for
     *
     * @return string                    returns the main for content part of the form
     */
    private function GenerateFormMainData($formName, $data, $columnNames, $dataTypesArray, $requiredNullArray, $option) {
        $form = "";

        if ($option == 3) {
            $firstItem = 9;
        } else {
            $firstItem = 0;
        }

        $form .= $this->GenerateFormFieldWithLabel($formName, $data[$columnNames[0]], $columnNames[0], $dataTypesArray[0], $requiredNullArray[0], $firstItem);

        for ($i=1; $i < count($columnNames); $i++) {
            $form .= $this->GenerateFormFieldWithLabel($formName, $data[$columnNames[$i]], $columnNames[$i], $dataTypesArray[$i], $requiredNullArray[$i], $option);
        }

        return $form;
    }

    private function GenerateFormFieldWithLabel($formName, $data, $columnName, $dataType, $required, $option) {
        if ($option === 1) {
            $data = "";
        }

        if ($option === 9 || $option === "hidden") {
            $item = "<input class='$formName-input' id='$formName-$columnName-label' name='$columnName' value='$data' type='hidden'>";

        } else {
            $visibleColumnName = $columnName;
            $visibleColumnName[0] = strToUpper($columnName[0]);
            $item = "<label class='$formName-label' for='$formName-$columnName-label'>$visibleColumnName</label>";
            $item .= "<input class='$formName-input' id='$formName-$columnName-label' name='$columnName' value='$data' $dataType $required><span></span>";
        }

        return $item;
    }

    private function SetHeadAndFootForm($formName, $targetUrl, $method) {
        $openingLines = "<form class='$formName' id='$formName' name='$formName' action='$targetUrl' method='$method'>";

        $closingLines = "<input class='$formName-button' type='submit' value='submit'>";
        $closingLines .= "</form>";

        return ["header" => $openingLines, "footer" => $closingLines];
    }

    private function CombineForm($head, $main, $footer) {
        $form = $head . $main . $footer;
        return $form;
    }
}

?>
