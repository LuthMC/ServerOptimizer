<?php

namespace Luthfi\ServerOptimizer\tasks;

use pocketmine\scheduler\Task;
use Luthfi\ServerOptimizer\Main;

class ChunkUnloadTask extends Task {

    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun(): void {
        foreach ($this->plugin->getServer()->getLevels() as $level) {
            $level->unloadChunks(true);
        }
    }
}
