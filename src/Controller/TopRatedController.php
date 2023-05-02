<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;


class TopRatedController extends AbstractController
{
    public function getTopRatedMovies()
    {
        $apiKey = '4bb07248e8d38144e13c5476cc2a7576';
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/top_rated', [
            'query' => [
                'api_key' => $apiKey,
                'language' => 'en-US'
            ]
        ]);
        $movies = json_decode($response->getContent());
        
        return new JsonResponse($movies->results);
    }
    
    public function getTopRatedTvShows()
    {
        $apiKey = '4bb07248e8d38144e13c5476cc2a7576';
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.themoviedb.org/3/tv/top_rated', [
            'query' => [
                'api_key' => $apiKey,
                'language' => 'en-US'
            ]
        ]);
        $tvShows = json_decode($response->getContent());
        
        return new JsonResponse($tvShows->results);
    }
}
