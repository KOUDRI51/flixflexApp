<?php

namespace App\Controller;
use App\Repository\MovieRepository;
use App\Repository\TvShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\SerializerInterface;

class MovieController extends AbstractController
{
    public function index(Request $request): JsonResponse
    {
        $apiKey = '4bb07248e8d38144e13c5476cc2a7576';
        $client = HttpClient::create();
        $page = $request->query->getInt('page', 1); // get the page number from the request, default to page 1 if not provided
        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/popular', [
            'query' => [
                'api_key' => $apiKey,
                'page' => $page,
            ],
        ]);
        $movies = json_decode($response->getContent());

        return new JsonResponse($movies);
    }
    /**
     * @Route("/movies/search", name="search_movies")
     */

     public function search(Request $request, SerializerInterface $serializer, MovieRepository $movieRepository)
     {
         $q = $request->query->get('q');
     
         if ($q !== null) {
             $apiKey = '4bb07248e8d38144e13c5476cc2a7576';
             $client = HttpClient::create();
             $response = $client->request('GET', 'https://api.themoviedb.org/3/search/movie', [
                 'query' => [
                     'api_key' => $apiKey,
                     'language' => 'en-US',
                     'page' => 1,
                     'query' => $q,
                     'include_adult' => false,
                 ],
             ]);
             $movies = json_decode($response->getContent());
     
             $moviesFromDb = $movieRepository->search($q);
            
     
             $data = [
                 'movies' => $serializer->normalize(array_merge($movies->results, $moviesFromDb), null, ['groups' => ['default']]),
                
             ];
     
             return new JsonResponse($data);
         }
     
         return new JsonResponse([]);
     }

public function show(int $id, SerializerInterface $serializer)
 {
    $apiKey = '4bb07248e8d38144e13c5476cc2a7576';
    $client = HttpClient::create();
    
    // Get the details for the movie or series with the given ID
    $response = $client->request('GET', "https://api.themoviedb.org/3/movie/{$id}", [
        'query' => [
            'api_key' => $apiKey,
        ],
    ]);
    $data = json_decode($response->getContent());
    
    // Return the details as a JSON response
    return new JsonResponse($serializer->normalize($data, null, ['groups' => ['default']]));
}

}
