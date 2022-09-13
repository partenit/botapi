<?php

namespace App\Service;

use App\Entity\ActionsLog;
use App\Model\Action;
use App\Repository\ActionLogRepository;
use App\Repository\ActionRepository;
use Doctrine\Common\Collections\Criteria;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActionService
{
    public function __construct(
        private ActionRepository $actionRepository,
        private ActionLogRepository $actionsLogRepository,
        private LoggerInterface $logger
    )
    {
    }

    /**
     * @return Action[]
     */
    public function actions(Request $request): array
    {
        $request_data = $request->query->all();
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

    public function actionToLog(Request $request)
    {
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
    }

    public function actionDelete(Request $request)
    {
        $action = $this->actionRepository->findOneBy([
            'name' => $request->get('name'),
            'chat' => $request->get('chat')
        ]);

        if (is_object($action)) {
            $this->actionRepository->remove($action, true);

            return [
                'status' => Response::HTTP_OK,
                'message' => 'Action is deleted'
            ];
        }

        return [
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => 'Unable to delete Action'
        ];
    }
}