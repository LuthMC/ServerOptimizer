<?php

namespace Luthfi\ServerOptimizer\tasks;

use pocketmine\scheduler\Task;
use Luthfi\ServerOptimizer\Main;
use pocketmine\entity\Entity;

class EntityCleanupTask extends Task {

    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun(): void {
        $entitiesRemoved = 0;
        foreach ($this->plugin->getServer()->getLevels() as $level) {
            foreach ($level->getEntities() as $entity) {
                if (!$this->isNPC($entity) && $this->isRemovable($entity)) {
                    $entity->close();
                    $entitiesRemoved++;
                }
            }
        }

        $prefix = $this->plugin->getConfig()->get("prefix");
        $this->plugin->getServer()->broadcastMessage($prefix . " Removed {$entitiesRemoved} entities.");
    }

    private function isNPC(Entity $entity): bool {
        return false;
    }

    private function isRemovable(Entity $entity): bool {
        return !($entity instanceof Human);
    }
}
