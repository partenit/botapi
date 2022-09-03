<?php

namespace App\Service;

use App\Model\Action;
use App\Repository\ActionRepository;

class ActionService
{
    public function __construct(private ActionRepository $actionRepository)
    {
    }

    /**
     * @return Action[]
     */
    public function actions(): array
    {
        //dd($this->actionRepository->findBy([]));

        return array_map(
            fn ($action) => new Action($action->getId(), $action->getName()),
            $this->actionRepository->findBy([])
        );
    }
}