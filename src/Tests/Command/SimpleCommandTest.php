<?php

namespace App\Tests\Command;

use App\Command\PurchaseCigarettesCommand;
use PHPUnit\Framework\Constraint\RegularExpression;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class SimpleCommandTest extends TestCase
{
//region SECTION: Public
    public function testExecute()
    {
        $application = new Application();

        $application->setAutoExit(false);

        $application->add(new PurchaseCigarettesCommand('purchase-cigarettes'));
        $command       = $application->find('purchase-cigarettes');
        $commandTester = new CommandTester($command);
        $exitCode      = $commandTester->execute(
            [
                'packs'  => '2',
                'amount' => '12.61',
            ]
        );

        $this->assertSame(0, $exitCode, 'Returns 0 in case of success');
    }
//endregion Public
}