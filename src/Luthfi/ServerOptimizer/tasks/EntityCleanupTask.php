<?php

namespace Luthfi\ServerOptimizer\tasks;

use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;
use Luthfi\ServerOptimizer\Main;

class EntityCleanupTask extends Task {

    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun(int $currentTick) {
        $level = $this->plugin->getServer()->getLevels()[0];
        $count = 0;

        foreach ($level->getEntities() as $entity) {
            if (!$entity instanceof Player) {
                $entity->close();
                $count++;
            }
        }
        $this->plugin->getLogger()->info(TF::GREEN . "Cleared " . $count . " entities.");
    }
}
