<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Actions
 *
 * @ORM\Table(name="actions", indexes={@ORM\Index(name="actions_block_id_foreign", columns={"block_id"}), @ORM\Index(name="actions_chat_id_foreign", columns={"chat_id"})})
 * @ORM\Entity
 */
class Actions
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false, options={"comment"="название действия"})
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_always", type="boolean", nullable=false, options={"comment"="выбирать действие случайным образом или выбирать всегда"})
     */
    private $isAlways = '0';

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isIsAlways(): ?bool
    {
        return $this->isAlways;
    }

    public function setIsAlways(bool $isAlways): self
    {
        $this->isAlways = $isAlways;

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
