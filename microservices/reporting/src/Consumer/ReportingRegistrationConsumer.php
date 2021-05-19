<?php


namespace App\Consumer;


use App\Entity\Registration;
use App\Manager\EmployeeManager;
use App\Manager\RegistrationManager;
use App\Message\DailyWorkhourCalculationQueueMessage;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\HttpKernel\Log\Logger;
use Symfony\Component\Serializer\SerializerInterface;

class ReportingRegistrationConsumer implements ConsumerInterface
{
    /**
     * @var Logger
     */
    protected $logger;
    private SerializerInterface $serializer;
    private RegistrationManager $manager;
    private ProducerInterface $producer;

    /**
     * @param Logger $logger
     * @param SerializerInterface $serializer
     * @param EmployeeManager $manager
     */
    public function __construct(
        Logger $logger,
        SerializerInterface $serializer,
        RegistrationManager $manager,
        ProducerInterface $producer
    )
    {
        $this->logger = $logger;
        $this->serializer = $serializer;
        $this->manager = $manager;
        $this->producer = $producer;
    }

    public function execute(AMQPMessage $msg)
    {
        $this->logger->critical(
            $msg->getBody()
        );
        /** @var Registration $registration */
        $registration = $this->serializer->deserialize(
            $msg->getBody(),
            Registration::class,
            'json'
        );
        $this->manager->save($registration);
        $recalculate = new DailyWorkhourCalculationQueueMessage();
        $recalculate->setCardID($registration->getCardID());
        $recalculate->setDay($registration->getTime());
        $this->producer->publish(
            $this->serializer->serialize($recalculate, 'json'),
            'daily_workhour_calculation'
        );
    }
}
