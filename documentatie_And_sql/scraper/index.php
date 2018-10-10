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
        $this->write();
    }
}

$scraper = new Scraper();








?>
