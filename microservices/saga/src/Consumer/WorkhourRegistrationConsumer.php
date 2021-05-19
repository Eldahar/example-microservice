<?php


namespace App\Consumer;


use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\HttpKernel\Log\Logger;
use Symfony\Component\Serializer\SerializerInterface;

class WorkhourRegistrationConsumer implements ConsumerInterface
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var ProducerInterface
     */
    private ProducerInterface $producer;

    /**
     * @param Logger $logger
     * @param SerializerInterface $serializer
     * @param ProducerInterface $producer
     */
    public function __construct(Logger $logger, SerializerInterface $serializer, ProducerInterface $producer)
    {
        $this->logger = $logger;
        $this->serializer = $serializer;
        $this->producer = $producer;
    }

    /**
     * @param AMQPMessage $msg
     * @return mixed|void
     */
    public function execute(AMQPMessage $msg)
    {
        $this->producer->publish($msg->getBody(), 'reporting_registration');
    }
}