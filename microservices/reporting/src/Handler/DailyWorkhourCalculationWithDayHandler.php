<?php


namespace App\Handler;


use App\Interfaces\DailyWorkhourCalculationHandlerInterface;
use App\Message\DailyWorkhourCalculationQueueMessage;

class DailyWorkhourCalculationWithDayHandler extends AbstractDailyWorkhourCalculationHandler implements DailyWorkhourCalculationHandlerInterface
{

    public function handle(DailyWorkhourCalculationQueueMessage $message): void
    {

    }
}