<?php


namespace App\Command;


use App\Entity\Registration;
use App\Manager\RegistrationManager;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CreateRegistrationCommand extends Command
{

    const TERMINAL_ID = 'terminal_id';
    const CARD_ID = 'card_id';
    const EVENT_TYPE = 'event_type';
    const TIME = 'time';
    private RegistrationManager $manager;
    private ProducerInterface $producer;
    private SerializerInterface $serializer;

    /**
     * @param string|null $name
     * @param RegistrationManager $manager
     */
    public function __construct(string $name = null, RegistrationManager $manager, ProducerInterface $producer, SerializerInterface $serializer)
    {
        parent::__construct($name);
        $this->manager = $manager;
        $this->producer = $producer;
        $this->serializer = $serializer;
    }

    protected function configure()
    {
        $this->setName('registration:create');
        $this->setDescription('Create Registration entity');
        $this->addArgument(self::TERMINAL_ID, InputArgument::REQUIRED, 'Terminal ID');
        $this->addArgument(self::CARD_ID, InputArgument::REQUIRED, 'Card ID');
        $this->addArgument(self::EVENT_TYPE, InputArgument::REQUIRED, 'Event Type');
        $this->addArgument(self::TIME, InputArgument::REQUIRED, 'Time');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $registration = new Registration();
        $registration->setTerminalID($input->getArgument(self::TERMINAL_ID));
        $registration->setCardID($input->getArgument(self::CARD_ID));
        $registration->setEventType($input->getArgument(self::EVENT_TYPE));
        $registration->setTime(new \DateTime($input->getArgument(self::TIME)));
        $this->manager->save($registration);
        $this->producer->publish(
            $this->serializer->serialize($registration, 'json'),
            'workhour_registration'
        );

        return 0;
    }

}