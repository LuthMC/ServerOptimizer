<?php

namespace Luthfi\ServerOptimizer;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\entity\Entity;
use Luthfi\ServerOptimizer\commands\HelpCommand;
use Luthfi\ServerOptimizer\commands\CheckCommand;
use Luthfi\ServerOptimizer\commands\ClearCommand;
use Luthfi\ServerOptimizer\commands\ClearChatCommand;
use Luthfi\ServerOptimizer\tasks\MonitoringTask;
use Luthfi\ServerOptimizer\tasks\EntityCleanupTask;
use Luthfi\ServerOptimizer\tasks\ChunkUnloadTask;

class Main extends PluginBase {

    /** @var ConfigManager */
    private $configManager;

    /** @var TaskScheduler */
    private $taskScheduler;

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->configManager = new ConfigManager($this);

        $this->getServer()->getCommandMap()->registerAll("serveroptimizer", [
            new HelpCommand($this),
            new CheckCommand($this),
            new ClearCommand($this),
            new ClearChatCommand($this),
        ]);

        $this->scheduleTasks();
    }

    private function scheduleTasks(): void {
        $this->taskScheduler = $this->getScheduler();
        
        if ($this->configManager->isMonitoringEnabled()) {
            $this->taskScheduler->scheduleRepeatingTask(new MonitoringTask($this), 20 * 60); // 1 minute
        }
        
        if ($this->configManager->isEntityCleanupEnabled()) {
            $interval = $this->configManager->getEntityCleanupInterval();
            $this->taskScheduler->scheduleRepeatingTask(new EntityCleanupTask($this), 20 * $interval);
        }

        if ($this->configManager->isChunkUnloadEnabled()) {
            $interval = $this->configManager->getChunkUnloadInterval();
            $this->taskScheduler->scheduleRepeatingTask(new ChunkUnloadTask($this), 20 * $interval);
        }
    }

    public function getConfigManager(): ConfigManager {
        return $this->configManager;
    }
}
