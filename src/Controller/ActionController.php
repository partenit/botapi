<?php

namespace App\Controller;

use App\Service\ActionService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ActionController extends AbstractController
{
    public function __construct(
        private ActionService $actionService,
        protected LoggerInterface $logger
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/api/v1/actions', 'actions', methods: ['GET'])]
    public function actions(Request $request): JsonResponse
    {
        return $this->json($this->actionService->actions($request));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/api/v1/action_to_log', 'action_to_log', methods: ['POST'])]
    public function actionToLog(Request $request): JsonResponse
    {
        $response = $this->actionService->actionToLog($request);

        return $this->json($response, $response['status']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/api/v1/action', 'action_delete', methods: ['DELETE'])]
    public function actionDelete(Request $request): JsonResponse
    {
        $response = $this->actionService->actionDelete($request);

        return $this->json($response, $response['status']);
    }

}
