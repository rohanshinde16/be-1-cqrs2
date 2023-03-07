<?php

declare(strict_types=1);

namespace App\API;

use App\Post\Application\Command\CreatePostCommand;
use App\Shared\Domain\Bus\CommandBus;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;
use App\Post\Domain\PostRepository;
use App\Post\Domain\Post;



#[Route(path: '/posts/{id}', methods: ['GET'])]
class GetPostController
{
    public function __construct(
        private readonly PostRepository $repository
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        // Get id from the request
        $requestId = Uuid::fromString($request->get('id'));

        $data = $this->repository->find($requestId);

        // Get id
        $id = $data->getId();


        //Check if id is present or not in the database title starts with Qwerty
        if (!$id)
        {
             return new JsonResponse(
                Response::HTTP_NOT_FOUND,
            );    
        }    

        // Make array to response data
        $dataResponse = [
            'id' => $id,
            'title' => $data->getTitle(),
            'summary' => $data->getSummary(),
            'description' => $data->getDescription(),
        ];

        return new JsonResponse(
                $dataResponse,
            Response::HTTP_OK,
        );
    }
}
