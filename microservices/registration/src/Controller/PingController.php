<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends AbstractController
{
    public function pingAction()
    {
        return new Response('pong');
    }
}