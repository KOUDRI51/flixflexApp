<?php

namespace App\Controller;


use App\Entity\Favorite;
use App\Entity\Movie;
use App\Entity\TvShow;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function register(Request $request, EntityManagerInterface $entityManager)
    {
        $data = json_decode($request->getContent(), true);
    
        $username = $data['username'];
        $password = $data['password'];
    
        // validate input
        if (empty($username) || empty($password)) {
            return new JsonResponse(['error' => 'Username and password are required'], 400);
        }
    
        // check if user already exists
        $existingUser = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
        if ($existingUser) {
            return new JsonResponse(['error' => 'Username already exists'], 400);
        }
    
        // create new user
        $user = new User();
        $user->setUsername($username);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT)); // hash password
    
        // save user to database
        $entityManager->persist($user);
        $entityManager->flush();
    
        return new JsonResponse(['success' => 'User registered successfully'], 201);
    }
    public function addFavorite(Request $request, EntityManagerInterface $entityManager)
    {
        $data = json_decode($request->getContent(), true);
        $itemId = $data['id'];
        $itemType = $data['type'];
        $token = $data['token'];

        // find user by token
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['token' => $token]);
        if (!$user) {
            return new JsonResponse(['error' => 'Unauthorized'], 401);
        }

        // find item by id and type
        $itemClass = $itemType === 'movie' ? Movie::class : TvShow::class;
        $item = $this->getDoctrine()->getRepository($itemClass)->find($itemId);
        if (!$item) {
            return new JsonResponse(['error' => 'Item not found'], 404);
        }

        
        $existingFavorite = $this->getDoctrine()->getRepository(Favorite::class)->findOneBy([
            'user' => $user,
            'item' => $item,
        ]);
        if ($existingFavorite) {
            return new JsonResponse(['error' => 'Item is already a favorite'], 400);
        }

        
        $favorite = new Favorite();
        $favorite->setUser($user);
        $favorite->setItem($item);

        // save favorite to database
        $entityManager->persist($favorite);
        $entityManager->flush();

        return new JsonResponse(['success' => 'Item added to favorites'], 201);
    }
}