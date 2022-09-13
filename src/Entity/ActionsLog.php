<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * ActionsLog
 *
 * @ORM\Table(name="actions_log", indexes={@ORM\Index(name="actions_log_chat_id_foreign", columns={"chat_id"}), @ORM\Index(name="actions_log_block_id_foreign", columns={"block_id"}), @ORM\Index(name="actions_log_action_id_foreign", columns={"action_id"})})
 * @ORM\Entity
 */
class ActionsLog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_done", type="boolean", nullable=true, options={"comment"="активно (null), выполнено (1) или не выполнено (0)"})
     */
    private $isDone;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="action_date", type="datetime", nullable=true, options={"comment"="когда наступило действие"})
     */
    private $actionDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \Actions
     *
     * @ORM\ManyToOne(targetEntity="Actions")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $action;

    /**
     * @var \Blocks
     *
     * @ORM\ManyToOne(targetEntity="Blocks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="block_id", referencedColumnName="id")
     * })
     */
    private $block;

    /**
     * @var \TelegraphChats
     *
     * @ORM\ManyToOne(targetEntity="TelegraphChats")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chat_id", referencedColumnName="id")
     * })
     */
    private $chat;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function isIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(?bool $isDone): self
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getActionDate(): ?\DateTimeInterface
    {
        return $this->actionDate;
    }

    public function setActionDate(?\DateTimeInterface $actionDate): self
    {
        $this->actionDate = $actionDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAction(): ?Actions
    {
        return $this->action;
    }

    public function setAction(?Actions $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getBlock(): ?Blocks
    {
        return $this->block;
    }

    public function setBlock(?Blocks $block): self
    {
        $this->block = $block;

        return $this;
    }

    public function getChat(): ?TelegraphChats
    {
        return $this->chat;
    }

    public function setChat(?TelegraphChats $chat): self
    {
        $this->chat = $chat;

        return $this;
    }


}
