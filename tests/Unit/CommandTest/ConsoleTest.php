<?php


namespace Tests\Unit\CommandTest;

use App\RacingCommand;
use PHPUnit\Framework\TestCase;

class ConsoleTest extends TestCase
{
    private RacingCommand $command;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->command = new RacingCommand();
        parent::__construct($name, $data, $dataName);
    }

    public function testMainMethod()
    {
        $mockCommand = $this->createMock(RacingCommand::class);
        $stubInput = $this->createStub(\Symfony\Component\Console\Input\InputInterface::class)
            ->method('getOption')->willReturn(0);
        $mockCommand->expects(self::once())->method('execute')->with('output')->will($stubInput);
        self::assertSame(0, $mockCommand);
    }

}
