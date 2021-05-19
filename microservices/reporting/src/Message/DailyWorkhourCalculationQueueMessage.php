<?php


namespace App\Message;


class DailyWorkhourCalculationQueueMessage
{
    /**
     * @var int
     */
    protected $cardID;

    /**
     * @var \DateTime|null
     */
    protected $day;

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
     * @return \DateTime|null
     */
    public function getDay(): ?\DateTime
    {
        return $this->day;
    }

    /**
     * @param \DateTime|null $day
     */
    public function setDay(?\DateTime $day): void
    {
        $this->day = $day;
    }

    /**
     * @return bool
     */
    public function hasDay(): bool
    {
        return NULL !== $this->day;
    }
}