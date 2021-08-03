<?php

namespace App\Models\Parser;

use GuzzleHttp\Client;
use Sunra\PhpSimple\HtmlDomParser;

class ApartmentParser
{
    private $client;
    private $url;
    private $page;

    public function __construct()
    {
        $this->client = new Client();
        $this->url = 'https://realt.by/rent/flat-for-day';
        $this->page = '/?page=';
    }

    public function getPaginate($start = null, $end = null): array
    {
        if ($start == null) {
            $start = 1;
        }
        if ($end == null) {
            $end = $start;
        }
        for ($i = $start; $i <= $end; $i++) {
            $currentPage = $i - 1;
            if ($i == 1) {
                $urls[] = $this->url;
            }
            if ($currentPage !== 0) {
                $urls[] = $this->url . $this->page . $currentPage;
            }
        }
        return $urls;
    }

    public function getParserApartment($urls)
    {
        foreach ($urls as $url) {

            $response = $this->getResponse($url);

            $response_status_code = $response->getStatusCode();

            $html = $response->getBody()->getContents();

            if ($response_status_code == 200) {
                $dom = HtmlDomParser::str_get_html($html);
                $listing = $dom->find('div[class="listing-item"]');
                foreach ($listing as $list_item) {
                    //Get links to images
                    $imageInfo = $list_item->find('img[class="lazy"]');
                    foreach ($imageInfo as $src) {
                        $image[] = $src->attr['data-original'];
                    }
                    //Get price
                    $priceInfo = $list_item->find('div[class="desc-mini-bottom"]');
                    $patternPrice = '#\b\d+\s#';
                    foreach ($priceInfo as $item) {
                        if (preg_match($patternPrice, trim($item->text()), $matches)) {
                            foreach ($matches as $match) {
                                $price[] = $match;
                            }
                        }else{
                            $price[] = null;
                        }
                    }
                    //Get date
                    $dateInfo = $list_item->find('div[class="info-mini"]');
                    $patternDate = '#\d\d\.\d\d\.\d\d\d\d#';
                    foreach ($dateInfo as $item) {
                        if (preg_match($patternDate, $item->text(), $matchesDate)) {
                            foreach ($matchesDate as $match) {
                                $date[] = $match;
                            }
                        }
                    }
                    //Get apartment title and link
                    $titleHrefInfo = $list_item->find('a[class="teaser-title"]');
                    foreach ($titleHrefInfo as $item) {
                        $title[] = $item->attr['title'];
                        $href[] = $item->attr['href'];

                        //parse open ad
                        $responseOpen = $this->getResponse($item->attr['href']);
                        $response_status_code_open = $responseOpen->getStatusCode();
                        $htmlOpen = $responseOpen->getBody()->getContents();
                        if ($response_status_code_open == 200) {
                            $domOpen = HtmlDomParser::str_get_html($htmlOpen);
                            $ad = $domOpen->find('div[class="object-item"]');
                            foreach ($ad as $ad_table) {
                                $table = $ad_table->find('table');
                                $tableOne = $table[0];
                                $tableTwo = $table[1];
                                $patternArea = '#(?<=Район города).*\r*\n*.*\r*\n*.*(?=^)|((?<=Район города).*\r*\n*.*\r*\n*.*)(?=Метро)#m';
                                $patternMetro = '#(?<=Метро).*\r*.*\n*\r*.*\n*.*#';
                                $patternAppliances ='#(?<=Бытовая техника).*(?=Дополнительно)#';
                                //Get area
                                if(preg_match($patternArea, $tableOne->text(), $matchesArea)) {
                                    foreach ($matchesArea as $match) {
                                        $area[] = $match;
                                    }
                                }else {
                                    $area[] = null;
                                }
                                //Get metro
                                if (preg_match($patternMetro, $tableOne->text(), $matchesMetro)) {
                                    foreach ($matchesMetro as $match) {
                                        $metro[] = $match;
                                    }
                                }else {
                                    $metro[] = null;
                                }
                                //Get appliances
                                if (preg_match($patternAppliances, $tableTwo->text(), $matchesAppliances)) {
                                    foreach ($matchesAppliances as $match) {
                                        $appliances[] = $match;
                                    }
                                }else {
                                    $appliances[] = null;
                                }
                            }
                        }
                    }
                    //Get address
                    $addressInfo = $list_item->find('div[class="location"]');
                    foreach ($addressInfo as $item) {
                        $address[] = trim($item->text());
                    }
                    //get count room
                    $countRoomInfo = $list_item->find('div[class="info-large"]');
                    $pattern = '#^[1-9]+\b#';
                    foreach ($countRoomInfo as $item) {
                        if (preg_match($pattern, trim($item->text()), $matches)) {
                            foreach ($matches as $match) {
                                $room[] = $match + 0;
                            }
                        } else {
                            $room[] = null;
                        }
                    }
                    //Get description
                    $descInfo = $list_item->find('div[class="info-text"]');
                    foreach ($descInfo as $item) {
                        $d = $item->find('p');
                        if (!empty($d[0])) {
                            $description[] = $d[0]->text();
                        } else {
                            $description[] = null;
                        }
                    }
                }
            }
        }
        $result = [
            'url' => $this->url,
            'name' => 'Apartment',
            'image' => $image,
            'price' => $price,
            'date' => $date,
            'title' => $title,
            'href' => $href,
            'address' => $address,
            'room' => $room,
            'description' => $description,
            'area' => $area,
            'metro' => $metro,
            'appliances' => $appliances,
        ];
        return $result;
    }

    /**
     * Info Url
     */
    private function getResponse($url)
    {
        $response = $this->client->request(
            'GET',
            $url
        );
        return $response;
    }
}
