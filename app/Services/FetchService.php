<?php


namespace App\Services;
use DOMDocument;


class FetchService {

    public $cities = [];
    public $temps = [];

    public function fetchWeatherInfo() {
        $url = "http://serbianmeteo.com/ams/";
        $contents = file_get_contents($url);
        $htmlDoc = new DOMDocument();
        libxml_use_internal_errors(true);
        $htmlDoc->loadHTMLFile($url);
        $xpath = new \DOMXPath($htmlDoc);

        $cities = $xpath->query('.//td[contains(@class, "focus1")]');
        foreach ($cities as $item) {
            $this->cities[] = $item->nodeValue;
        }

        $temps = $xpath->query('.//td[contains(@class, "focus2")]');
        foreach ($temps as $item) {
            $this->temps[] = $item->nodeValue;
        }
//        dd($this->cities, $this->temps);

        $data = [];
        $i = 0;
        for ($i = 0; $i < count($this->cities); $i++) {
            $data[$this->cities[$i]] = $this->temps[$i];
        }
        dd($data);

    }

}
