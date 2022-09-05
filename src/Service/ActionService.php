<?php

namespace App\Service;

use App\Entity\ActionsLog;
use App\Model\Action;
use App\Repository\ActionLogRepository;
use App\Repository\ActionRepository;
use App\Request\ActionRequest;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\Response;

class ActionService
{
    public function __construct(
        private ActionRepository $actionRepository,
        private ActionLogRepository $actionsLogRepository,
    )
    {
    }

    /**
     * @return Action[]
     */
    public function actions(ActionRequest $request): array
    {
        $request_data = $request->getRequest()->query->all();
        $keys = ['chat', 'block'];
        $search_criterias = [];

        foreach ($request_data as $key => $value) {

            if (in_array($key, $keys)) {
                $search_criterias[$key] = $value;
            }
        }

        return array_map(
            fn ($action) => new Action(
                $action->getId(),
                $action->getName(),
                $action->getChat(),
                $action->getBlock()),
            $this->actionRepository->findBy($search_criterias, ['block' => Criteria::ASC])
        );
    }

    public function actionToLog(ActionRequest $request)
    {
        $request = $request->getRequest();
        $action = $this->actionRepository->find($request->get('id'));

        if (is_object($action)) {
            $block = $action->getBlock();
            $actionsLog = new ActionsLog();
            $actionsLog->setAction($action);
            $actionsLog->setChat($action->getChat());
            $actionsLog->setBlock($block);
            $actionsLog->setActionDate($block->getNextDate());
            $actionsLog->setCreatedAt(new \DateTimeImmutable('now'));
            $actionsLog->setUpdatedAt(new \DateTimeImmutable('now'));

            $this->actionsLogRepository->add($actionsLog, true);
            return [
                'status' => Response::HTTP_CREATED,
                'actionLogId' => $actionsLog->getId()
            ];
        }

        return [
            'status' => Response::HTTP_NOT_FOUND,
            'message' => 'Action not found'
        ];

/*        return array_map(
            fn ($action) => new Action(
                $action->getId(),
                $action->getName(),
                $action->getChat(),
                $action->getBlock()),
            $this->actionRepository->findBy($search_criterias, ['block' => Criteria::ASC])
        );*/
    }
}