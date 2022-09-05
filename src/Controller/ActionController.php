<?php

namespace App\Controller;

use App\Request\ActionRequest;
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
     * @param ActionRequest $request
     * @return JsonResponse
     */
    public function actions(ActionRequest $request): JsonResponse
    {
        return $this->json($this->actionService->actions($request));
    }

    /**
     * @param ActionRequest $request
     * @return JsonResponse
     */
    #[Route('/api/v1/action_to_log', methods: ['POST'])]
    public function actionToLog(ActionRequest $request): JsonResponse
    {
        $response = $this->actionService->actionToLog($request);

        return $this->json($response, $response['status']);
    }

}
