<?php

namespace Luthfi\ServerOptimizer;

use pocketmine\plugin\Plugin;

class ConfigManager {

    private $plugin;

    public function __construct(Plugin $plugin) {
        $this->plugin = $plugin;
    }

    public function isMonitoringEnabled(): bool {
        return $this->plugin->getConfig()->get("monitoring")["enabled"];
    }

    public function getCpuThreshold(): int {
        return $this->plugin->getConfig()->get("monitoring")["cpu_threshold"];
    }

    public function getRamThreshold(): int {
        return $this->plugin->getConfig()->get("monitoring")["ram_threshold"];
    }

    public function getTpsThreshold(): int {
        return $this->plugin->getConfig()->get("monitoring")["tps_threshold"];
    }

    public function isEntityCleanupEnabled(): bool {
        return $this->plugin->getConfig()->get("features")["entity_cleanup"]["enabled"];
    }

    public function getEntityCleanupInterval(): int {
        return $this->plugin->getConfig()->get("tasks")["entity_cleanup_interval"];
    }

    public function isChunkUnloadEnabled(): bool {
        return $this->plugin->getConfig()->get("features")["chunk_unload"]["enabled"];
    }

    public function getChunkUnloadInterval(): int {
        return $this->plugin->getConfig()->get("tasks")["chunk_unload_interval"];
    }
}
