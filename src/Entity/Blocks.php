<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Blocks
 *
 * @ORM\Table(name="blocks", indexes={@ORM\Index(name="blocks_chat_id_foreign", columns={"chat_id"}), @ORM\Index(name="blocks_block_type_id_foreign", columns={"block_type_id"})})
 * @ORM\Entity
 */
class Blocks
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
     * @ORM\Column(name="value", type="boolean", nullable=true)
     */
    private $value;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_regular", type="boolean", nullable=false, options={"default"="1","comment"="действие регулярное или одноразовое"})
     */
    private $isRegular = true;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="next_date", type="datetime", nullable=true, options={"comment"="дата и время следующего действия"})
     */
    private $nextDate;

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
     * @var \BlocksTypes
     *
     * @ORM\ManyToOne(targetEntity="BlocksTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="block_type_id", referencedColumnName="id")
     * })
     */
    private $blockType;

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

    public function isValue(): ?bool
    {
        return $this->value;
    }

    public function setValue(?bool $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function isIsRegular(): ?bool
    {
        return $this->isRegular;
    }

    public function setIsRegular(bool $isRegular): self
    {
        $this->isRegular = $isRegular;

        return $this;
    }

    public function getNextDate(): ?\DateTimeInterface
    {
        return $this->nextDate;
    }

    public function setNextDate(?\DateTimeInterface $nextDate): self
    {
        $this->nextDate = $nextDate;

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

    public function getBlockType(): ?BlocksTypes
    {
        return $this->blockType;
    }

    public function setBlockType(?BlocksTypes $blockType): self
    {
        $this->blockType = $blockType;

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
