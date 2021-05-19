<?php


namespace App\Consumer;


use App\Entity\Employee;
use App\Manager\EmployeeManager;
use App\Message\DailyWorkhourCalculationQueueMessage;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\HttpKernel\Log\Logger;
use Symfony\Component\Serializer\SerializerInterface;

class ReportingEmployeeConsumer implements ConsumerInterface
{
    /**
     * @var Logger
     */
    protected $logger;
    private SerializerInterface $serializer;
    private EmployeeManager $employeeManager;
    private ProducerInterface $producer;

    /**
     * @param Logger $logger
     * @param SerializerInterface $serializer
     * @param EmployeeManager $employeeManager
     */
    public function __construct(
        Logger $logger,
        SerializerInterface $serializer,
        EmployeeManager $employeeManager,
        ProducerInterface $producer
    )
    {
        $this->logger = $logger;
        $this->serializer = $serializer;
        $this->employeeManager = $employeeManager;
        $this->producer = $producer;
    }

    public function execute(AMQPMessage $msg)
    {
        /** @var Employee $employee */
        $employee = $this->serializer->deserialize(
            $msg->getBody(),
            Employee::class,
            'json'
        );
        $this->employeeManager->save($employee);
        $recalculate = new DailyWorkhourCalculationQueueMessage();
        $recalculate->setCardID($employee->getCardID());
        $this->producer->publish(
            $this->serializer->serialize($recalculate, 'json'),
            'daily_workhour_calculation'
        );
    }
}