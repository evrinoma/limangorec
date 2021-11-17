<?php

namespace App\Tests\Command;

use App\Command\PurchaseCigarettesCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class SimpleCommandTest extends TestCase
{
    public function testExecute()
    {
        $application = new Application();

        $application->setAutoExit(false);

        $application->add(new PurchaseCigarettesCommand('purchase-cigarettes'));
        $command = $application->find('purchase-cigarettes');
        $commandTester = new CommandTester($command);


    }
}