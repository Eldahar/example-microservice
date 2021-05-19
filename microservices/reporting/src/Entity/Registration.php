<?php


namespace App\Entity;


use App\Interfaces\EntityInterface;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity()
 */
class Registration implements EntityInterface
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $terminalID;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $cardID;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $eventType;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $time;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getTerminalID(): int
    {
        return $this->terminalID;
    }

    /**
     * @param int $terminalID
     */
    public function setTerminalID(int $terminalID): void
    {
        $this->terminalID = $terminalID;
    }

    /**
     * @return int
     */
    public function getCardID(): int
    {
        return $this->cardID;
    }

    /**
     * @param int $cardID
     */
    public function setCardID(int $cardID): void
    {
        $this->cardID = $cardID;
    }

    /**
     * @return string
     */
    public function getEventType(): string
    {
        return $this->eventType;
    }

    /**
     * @param string $eventType
     */
    public function setEventType(string $eventType): void
    {
        $this->eventType = $eventType;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime(\DateTime $time): void
    {
        $this->time = $time;
    }
}