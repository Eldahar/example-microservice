<?php


namespace App\Handler;


use App\Interfaces\DailyWorkhourCalculationHandlerInterface;
use App\Message\DailyWorkhourCalculationQueueMessage;

class DailyWorkhourCalculationWithoutDayHandler extends AbstractDailyWorkhourCalculationHandler implements DailyWorkhourCalculationHandlerInterface
{

    public function handle(DailyWorkhourCalculationQueueMessage $message): void
    {
        $registrations = $this->registrationManager->findAllByCardID($message->getCardID());
        $this->logger->critical(json_encode($registrations));
    }
}