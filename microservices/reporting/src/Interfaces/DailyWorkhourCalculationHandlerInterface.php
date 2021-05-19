<?php


namespace App\Interfaces;


use App\Message\DailyWorkhourCalculationQueueMessage;

interface DailyWorkhourCalculationHandlerInterface
{
    /**
     * @param DailyWorkhourCalculationQueueMessage $message
     */
    public function handle(DailyWorkhourCalculationQueueMessage $message): void;
}