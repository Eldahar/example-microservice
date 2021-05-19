<?php


namespace App\Entity;

use App\Interfaces\EntityInterface;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity()
 */
class Employee implements EntityInterface
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
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
}