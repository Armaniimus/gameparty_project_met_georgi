<?php
/**
 *
 */
class Scraper {
    private $publicUrl;
    private $data;
    private $localUrl;

    function __construct() {
        $this->publicUrl = 'https://kinepolis.nl/bioscopen/kinepolis-emmen/info';
        // $this->publicUrl = 'https://kinepolis.nl/bioscopen/kinepolis-den-bosch/info';
        $this->data = file_get_contents($this->publicUrl);

        $this->filter();
    }

    private function writeTest() {
        $my_file = 'resultpage/testFile.html';
        $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
        fwrite($handle, $this->data);
    }

    private function writeBiosInfo($data = "nothing") {
        $my_file = 'resultpage/BiosInfoFile.html';
        $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
        fwrite($handle, $data);
    }

    private function writeTarievenInfo($data = "nothing") {
        $tarieven = "(" . $data[0]["naam"] . ", " . $data[0]["prijs"] . ")";
        for ($i=1; $i < count($data); $i++) {
            $tarieven .= ",(" . $data[$i]["naam"] . ", " . $data[$i]["prijs"] . ")";
        }

        $my_file = 'resultpage/TarievenInfoFile.html';
        $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
        fwrite($handle, $tarieven);
    }

    private function removeStringPart($haystack, $startString, $endString) {
        $start = strpos($haystack , $startString);

        $end = strpos($haystack , $endString);
        $endLength = strlen($endString);
        $end = $end - $start + $endLength;

        $haystack = substr_replace($haystack, "", $start, $end);
        return $haystack;
    }

    private function returnSubString($haystack, $startString, $endString) {
        $start = strpos($haystack , $startString);
        $startLength = strlen($startString);
        $start = $start + $startLength;

        $end = strpos($haystack , $endString);
        $end = $end - $start;


        return substr($haystack, $start, $end);
    }

    public function filter() {
        $bioscoop = [];
        $bioscoop["naam"] = "naam zelf invullen";

        $tarieven = [];

        $toeslagen = [];

        $this->data = str_replace("<!DOCTYPE html>", "", $this->data);

        // remove comments
        while (strpos($this->data, "<!--") != False && strpos($this->data, "-->") != False) {
            $this->data = $this->removeStringPart($this->data, '<!--', '-->');
        }

        // remove top junk
        $this->data = $this->removeStringPart($this->data, '<html', '<div id="main">');

        // remove footer
        $this->data = $this->removeStringPart($this->data, '</table>', '</html>');

        // remove script
        while (strpos($this->data, "<script") != False && strpos($this->data, "</script>") != False) {
            $this->data = $this->removeStringPart($this->data, '<script', '</script>');
        }

        // remove iframe
        $this->data = $this->removeStringPart($this->data, '<iframe', '</iframe>');

        // remove tariff_seperator
        while (strpos($this->data, '<span class="tariff_seperator">') != False && strpos($this->data, "</span>") != False) {
            $start = strpos($this->data , '<span class="tariff_seperator">');
            $end = strpos($this->data, "</span>", $start) - $start + strlen('</span>');
            $this->data = substr_replace($this->data, "", $start, $end);
        }

        // remove first junkpart of main
        $this->data = $this->removeStringPart($this->data, '<div id="main">', '<div class="field-items">');

        // get biosInfo
        $bioscoop["information"] = $this->returnSubString($this->data, '<div class="field-item even">', '</div>');
        $this->data = $this->removeStringPart($this->data, '<div class="field-item even">', '</div>');

        // get tarieven
        $i = 0;
        while (strpos($this->data, '<span class="tariff_first_part">') != False && strpos($this->data, "</span>") != False) {
            $tarieven[$i] = [];

            $tarieven[$i]["prijs"] = $this->returnSubString($this->data, '<span class="tariff_first_part">', '</span>');
            $this->data = $this->removeStringPart($this->data, '<span class="tariff_first_part">', '</span>');

            $tarieven[$i]["naam"] = $this->returnSubString($this->data, '<span class="tariff_second_part">', '</span>');
            $this->data = $this->removeStringPart($this->data, '<span class="tariff_second_part">', '</span>');

            $i++;
        };

        // removeJunk
        $this->data = $this->removeStringPart($this->data, '</div>', '<div class="padding-fields field field-name-field-theater-parking-info field-type-text-long field-label-above" >');


        $bereikbaarheid = $this->returnSubString($this->data, '<h2', '<div id="content-bottom-first" class="region-max-width">');
        $bioscoop["auto"] = $this->returnSubString($bereikbaarheid, '<br /></strong>', '</p>');
        $bioscoop["openbaarvervoer"] = $this->returnSubString($bereikbaarheid, '<br /></strong>', '</p>');
        $bioscoop["fiets"] = $this->returnSubString($bereikbaarheid, '<br /></strong>', '</p>');
        $bioscoop["Rolstoeltoegankelijkheid"] = $this->returnSubString($bereikbaarheid, '<br /></strong>', '</p>');


        // dump the remainder into the test file
        $this->writeTest();

        $biosInfo = "(" . $bioscoop["naam"] . "," . $bioscoop["information"] . ")";
        $this->writeBiosInfo($biosInfo);


        $this->writeTarievenInfo($tarieven);
    }
}


$scraper = new Scraper();?>
