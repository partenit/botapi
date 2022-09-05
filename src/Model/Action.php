<?php

namespace App\Model;

use App\Entity\Blocks;
use App\Entity\TelegraphChats;
use JetBrains\PhpStorm\Pure;

class Action
{
    public function __construct(
        private int $id,
        private string $name,
        private TelegraphChats $chat,
        private ?Blocks $block
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getChatId(): int
    {
        return $this->chat->getId();
    }

    public function getBlockId(): int
    {
        return $this->block?->getId();
    }

    public function getBlockLabel(): string
    {
        return $this->block?->getBlockType()->getLabel();
    }
}