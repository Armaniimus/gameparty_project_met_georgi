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
        $this->data = file_get_contents($this->publicUrl);
        $this->localUrl = 'resultpage/file.html';

        $this->filter();
    }

    public function write() {
        $my_file = $this->localUrl;
        $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
        fwrite($handle, $this->data);
    }

    public function filter() {
        $this->data = str_replace("<!DOCTYPE html>", "", $this->data);

        // remove comments
        while (strpos($this->data, "<!--") != False && strpos($this->data, "-->") != False) {
            $start = strpos($this->data , "<!--");
            $end = strpos($this->data, "-->", $start) - $start +3;
            $this->data = substr_replace($this->data, "", $start, $end);
        }

        // remove top junk
        $start = strpos($this->data , '<html');
        $end = strpos($this->data, '<div id="main">', $start) - $start;
        $this->data = substr_replace($this->data, "", $start, $end);

        // remove footer
        // $start = strpos($this->data , '<div id="content-bottom-second"');
        $start = strpos($this->data , '</table>') +8;
        $end = strpos($this->data, "</html>", $start) - $start+7;
        $this->data = substr_replace($this->data, "", $start, $end);

        // remove script
        while (strpos($this->data, "<script") != False && strpos($this->data, "</script>") != False) {
            $start = strpos($this->data , "<script");
            $end = strpos($this->data, "</script>", $start) - $start +9;
            $this->data = substr_replace($this->data, "", $start, $end);
        }

        // remove iframe
        $start = strpos($this->data , '<iframe');
        $end = strpos($this->data, "</iframe>", $start) - $start;
        $this->data = substr_replace($this->data, "", $start, $end);

        // remove tariff_seperator
        while (strpos($this->data, '<span class="tariff_seperator">') != False && strpos($this->data, "</span>") != False) {
            $start = strpos($this->data , '<span class="tariff_seperator">');
            $end = strpos($this->data, "</span>", $start) - $start +7;
            $this->data = substr_replace($this->data, "", $start, $end);
        }




        $this->write();
    }
}

$scraper = new Scraper();








?>
