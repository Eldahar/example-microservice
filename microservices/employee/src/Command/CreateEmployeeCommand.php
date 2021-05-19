<?php


namespace App\Command;


use App\Entity\Employee;
use App\Manager\EmployeeManager;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CreateEmployeeCommand extends Command
{
    const FIRST_NAME = 'firstName';
    const LAST_NAME = 'lastName';
    const CARD_ID = 'cardID';
    private EmployeeManager $employeeManager;
    private ProducerInterface $producer;
    private SerializerInterface $serializer;

    /**
     * @param string|null $name
     * @param EmployeeManager $employeeManager
     */
    public function __construct(string $name = null, EmployeeManager $employeeManager, ProducerInterface $producer, SerializerInterface $serializer)
    {
        parent::__construct($name);
        $this->employeeManager = $employeeManager;
        $this->producer = $producer;
        $this->serializer = $serializer;
    }

    protected function configure()
    {
        $this->setName('employee:create');
        $this->setDescription('Create Employee entity');
        $this->addArgument(self::FIRST_NAME, InputArgument::REQUIRED, 'First Name');
        $this->addArgument(self::LAST_NAME, InputArgument::REQUIRED, 'Last Name');
        $this->addArgument(self::CARD_ID, InputArgument::REQUIRED, 'Card ID');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $employee = new Employee();
        $employee->setFirstName($input->getArgument(self::FIRST_NAME));
        $employee->setLastName($input->getArgument(self::LAST_NAME));
        $employee->setCardID($input->getArgument(self::CARD_ID));
        $this->employeeManager->save($employee);
        $this->producer->publish(
            $this->serializer->serialize($employee, 'json'),
            'hrbase_employee'
        );

        return 0;
    }

}