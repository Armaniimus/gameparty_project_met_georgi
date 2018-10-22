<?php

/**
 *
 */
class TemplatingSystem {
    public $tplContent;

    public function __construct($tplUrl = false) {

        // $test if template is not empty or null
        if ($tplUrl == "" && $tplUrl == false) {
            $this->throwError("No string is given"); // "if No string is given";

        // test if the extension is tpl
        } else if (!preg_match("#(.+?).tpl#si", $tplUrl)) {
            $this->throwError("File Extention is wrong");// "if Wrong extention";

        // test if file exists
        } else if (!file_exists($tplUrl)) {
            $this->throwError("File doesn't Exist"); // "if file doesnt exists";
        }

        else {
            $this->tplContent = file_get_contents($tplUrl);
        }
    }

    // private function TestTemplate($template) {
    //
    // }

    public function setTemplateData($pattern, $replacement) {
        if ($this->readTemplateData() == false) {
            $this->readTemplateData(); // do it
        }
        $this->tplContent = preg_replace("#\{" . $pattern . "\}#si", $replacement, $this->tplContent); //{blabla changed to ..}
    }

    private function readTemplateData() {
        return $this->tplContent;
    }

    private function throwError($errorMessage) {
        echo "<pre>";
        throw new Exception("$errorMessage", 1);
        echo "</pre>";
    }

    public function getParsedTemplate() {
        return $this->tplContent;
    }

    // $template = new TemplatingSystem("view/default.tpl");
    // $template-> setTemplateData("hallo", "title of page",)
}

// $template = new TemplatateSystem("view/templates/template.tpl");

?>
