<?php

namespace App\Controller;

use App\Service\ActionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ActionController extends AbstractController
{
    public function __construct(private ActionService $actionService)
    {
    }

    /**
     * @Route("/api/v1/actions", name="actions")
     */
    public function actions(): JsonResponse
    {
        return $this->json($this->actionService->actions());
    }

}
