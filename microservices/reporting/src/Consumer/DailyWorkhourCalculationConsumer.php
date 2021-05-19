<?php


namespace App\Consumer;


use App\Interfaces\DailyWorkhourCalculationHandlerInterface;
use App\Manager\DailyWorkhourCalculationManager;
use App\Message\DailyWorkhourCalculationQueueMessage;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\HttpKernel\Log\Logger;
use Symfony\Component\Serializer\SerializerInterface;

class DailyWorkhourCalculationConsumer implements ConsumerInterface
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
     * @var DailyWorkhourCalculationManager
     */
    private DailyWorkhourCalculationManager $manager;

    /**
     * @var DailyWorkhourCalculationHandlerInterface
     */
    private DailyWorkhourCalculationHandlerInterface $calculationWithDay;

    /**
     * @var DailyWorkhourCalculationHandlerInterface
     */
    private DailyWorkhourCalculationHandlerInterface $calculationWithoutDay;

    /**
     * @param Logger $logger
     * @param SerializerInterface $serializer
     * @param DailyWorkhourCalculationManager $manager
     */
    public function __construct(
        Logger $logger,
        SerializerInterface $serializer,
        DailyWorkhourCalculationManager $manager,
        DailyWorkhourCalculationHandlerInterface $calculationWithDay,
        DailyWorkhourCalculationHandlerInterface $calculationWithoutDay
    )
    {
        $this->logger = $logger;
        $this->serializer = $serializer;
        $this->manager = $manager;
        $this->calculationWithDay = $calculationWithDay;
        $this->calculationWithoutDay = $calculationWithoutDay;
    }
    public function execute(AMQPMessage $msg)
    {
        $this->logger->critical($msg->getBody());
        /** @var DailyWorkhourCalculationQueueMessage $message */
        $message = $this->serializer->deserialize(
            $msg->getBody(),
            DailyWorkhourCalculationQueueMessage::class,
            'json'
        );

        if($message->hasDay()) {
            $handler = $this->calculationWithDay;
        } else {
            $handler = $this->calculationWithoutDay;
        }
        $handler->handle($message);

        throw new \Exception('stop');
    }

}