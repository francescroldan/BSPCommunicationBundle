<?php

namespace BSP\CommunicationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SendCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('bsp:communication:send')
            ->setDescription('Try to send a communication')
            ->addArgument(
                'communicationId',
                InputArgument::REQUIRED,
                'Communication id'
            )
            ->addOption(
               'types',
               't',
               InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
               'Do you want send only communications whith this type?'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $communication = $input->getArgument('communication');
        $manipulator = $this->getContainer()->get('bsp.communication.manipulator');

        $types = $input->getOption('types');
        
        $manipulator->sendCommunication( $communication, $types );

        $output->writeln('Try to send ' . $communication . ' communication.');
    }
}