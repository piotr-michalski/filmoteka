<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\GetMovies;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/movie', name: 'movie_')]
class MovieController extends AbstractController
{
    public function __construct(private readonly GetMovies $getMovies)
    {
    }

    #[Route('', methods: ['GET'])]
    #[OA\Get(
        path: '/api/movie',
        description: 'Returns a list of movies.',
        tags: ['Movies'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful response with list of movies',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(type: 'string')
                )
            ),
        ]
    )]
    #[OA\Parameter(
        name: 'filter',
        description: 'The field used to get movies, options: random, w, multiword, all',
        in: 'query',
        schema: new OA\Schema(type: 'string')
    )]
    public function list(
        #[MapQueryParameter(filter: \FILTER_VALIDATE_REGEXP, options: ['regexp' => '/^[a-zA-Z]+$/'])] string $filter = 'all',
    ): JsonResponse {
        return $this->json($this->getMovies->execute($filter));
    }

}