<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class TvShowController extends AbstractController
{
    public function index(Request $request): JsonResponse
    {
        $apiKey = '4bb07248e8d38144e13c5476cc2a7576';
        $client = HttpClient::create();
        $page = $request->query->getInt('page', 1); // get the page number from the request, default to page 1 if not provided
        $response = $client->request('GET', 'https://api.themoviedb.org/3/tv/popular', [
            'query' => [
                'api_key' => $apiKey,
                'page' => $page,
            ],
        ]);
        $tvShows = json_decode($response->getContent());

        return new JsonResponse($tvShows);
    }
}
