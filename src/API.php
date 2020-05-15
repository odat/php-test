<?php

class API {

    private static $url = 'https://rickandmortyapi.com/api/';

    public static function getCharacters($params = array())
    {
        $query = http_build_query($params);
        $endpoint = self::$url . 'character/?' . $query;

        $response = self::request($endpoint);

        foreach($response['results'] as $k => $item)
        {
            $firstEpisode = reset($item['episode']);
            $episodeInfo = API::getEpisode($firstEpisode);
            $response['results'][$k]['firstSeenIn'] = $episodeInfo['name'];
        }

        return $response;
    }

    public static function getCharacterById($id)
    {
        $endpoint = self::$url . 'character/' . $id;

        $response = self::request($endpoint);

        return $response;
    }

    public static function getEpisode($endpoint)
    {
        $response = self::request($endpoint);

        return $response;

    }

    public static function request($endpoint, $data = [])
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($ch);

        curl_close($ch);

        $response = json_decode($result, true);

        return $response;
    }
}