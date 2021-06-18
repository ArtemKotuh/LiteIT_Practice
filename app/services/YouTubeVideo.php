<?php

namespace app\services;

use Google_Client;
use Google_Service_YouTube;

class YouTubeVideo
{
    public $id; //id видео
    private $apiKey = 'AIzaSyDqQuLQa4p78rEYP204t2uNT66Zxa5MjNQ';
    private $youtube;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setDeveloperKey($this->apiKey);
        $this->youtube = new Google_Service_YouTube($client);
    }
    // Поиск видео по фразе
    public function search(string $q, int $maxResults = 4, string $lang = 'ru')
    {
        $response = $this->youtube->search->listSearch(
            'snippet',
            array(
                'q' => $q,
                'maxResults' => $maxResults,
                'relevanceLanguage' => $lang,
                'type' => 'video'
            )
        );
        return $response;
    }
}
