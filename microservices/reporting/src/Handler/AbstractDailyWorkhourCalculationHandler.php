<?php


namespace App\Handler;


use App\Manager\DailyWorkhourCalculationManager;
use App\Manager\EmployeeManager;
use App\Manager\RegistrationManager;
use Symfony\Component\HttpKernel\Log\Logger;

abstract class AbstractDailyWorkhourCalculationHandler
{
    /**
     * @var RegistrationManager
     */
    protected $registrationManager;

    /**
     * @var Logger
     */
    protected Logger $logger;

    /**
     * @var DailyWorkhourCalculationManager
     */
    protected DailyWorkhourCalculationManager $calculationManager;

    /**
     * @var EmployeeManager
     */
    protected EmployeeManager $employeeManager;

    /**
     * @param RegistrationManager $registrationManager
     */
    public function __construct(
        RegistrationManager $registrationManager,
        DailyWorkhourCalculationManager $calculationManager,
        EmployeeManager $employeeManager,
        Logger $logger
    )
    {
        $this->registrationManager = $registrationManager;
        $this->logger = $logger;
        $this->calculationManager = $calculationManager;
        $this->employeeManager = $employeeManager;
    }

}