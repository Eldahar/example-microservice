<?php


namespace App\Entity;


use App\Interfaces\EntityInterface;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity()
 */
class DailyWorkhourCalculation implements EntityInterface
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="date")
     */
    protected $day;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $employeeID;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $lastName;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $cardID;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $dailyHour;

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
     * @return \DateTime
     */
    public function getDay(): \DateTime
    {
        return $this->day;
    }

    /**
     * @param \DateTime $day
     */
    public function setDay(\DateTime $day): void
    {
        $this->day = $day;
    }

    /**
     * @return int
     */
    public function getEmployeeID(): int
    {
        return $this->employeeID;
    }

    /**
     * @param int $employeeID
     */
    public function setEmployeeID(int $employeeID): void
    {
        $this->employeeID = $employeeID;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
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
     * @return int
     */
    public function getDailyHour(): int
    {
        return $this->dailyHour;
    }

    /**
     * @param int $dailyHour
     */
    public function setDailyHour(int $dailyHour): void
    {
        $this->dailyHour = $dailyHour;
    }
}