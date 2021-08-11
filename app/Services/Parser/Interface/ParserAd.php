<?php


namespace App\Services\Parser\Interface;


interface ParserAd
{
    public function getContent($start = null, $end = null);
    public function onParser($urls);
    public function countPage($start = null, $end = null);
}
