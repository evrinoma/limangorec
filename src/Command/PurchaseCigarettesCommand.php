<?php

namespace App\Command;

use App\Exception\IncorrectInputException;
use App\Machine\CigaretteMachine;
use App\Machine\PurchaseTransaction;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CigaretteMachine
 *
 * @package App\Command
 */
class PurchaseCigarettesCommand extends Command
{
//region SECTION: Protected
    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('packs', InputArgument::REQUIRED, "How many packs do you want to buy?");
        $this->addArgument('amount', InputArgument::REQUIRED, "The amount in euro.");
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$output->writeln('php bin/console purchase-cigarettes 2 12.61');
        try {

            if (!($input->hasArgument('packs') && $input->hasArgument('amount'))) {
                throw new IncorrectInputException();
            }

            $itemCount = (int)$input->getArgument('packs');
            $amount    = (float)\str_replace(',', '.', $input->getArgument('amount'));

            // $cigaretteMachine = new CigaretteMachine();
            // ...
            $cigaretteMachine = new CigaretteMachine();
            $item             = $cigaretteMachine->execute(new PurchaseTransaction($itemCount, $amount));

            $output->writeln('You bought <info>'.$item->getItemQuantity().'</info> packs of cigarettes for <info>'.$item->getTotalAmount().'</info>, each for <info>'.CigaretteMachine::ITEM_PRICE.'</info>. ');
            $output->writeln('Your change is:');

            $table = new Table($output);
            $table
                ->setHeaders(array('Coins', 'Count'))
                ->setRows(
                    $item->getChange()
                )
//            ->setRows(array(
//                // ...
//                array('0.02', '0'),
//                array('0.01', '0'),
//            ))
            ;
            $table->render();
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }

    }
//endregion Protected
}