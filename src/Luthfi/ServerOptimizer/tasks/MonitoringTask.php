<?php

namespace Luthfi\ServerOptimizer\tasks;

use pocketmine\scheduler\Task;
use Luthfi\ServerOptimizer\Main;

class MonitoringTask extends Task {

    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun(): void {
        $server = $this->plugin->getServer();
        $cpuUsage = $this->getCpuUsage();
        $ramUsage = $this->getRamUsage();
        $tps = $server->getTicksPerSecond();

        if ($cpuUsage > $this->plugin->getConfigManager()->getCpuThreshold()) {
            $this->alertAdmins("High CPU usage detected: {$cpuUsage}%");
        }

        if ($ramUsage > $this->plugin->getConfigManager()->getRamThreshold()) {
            $this->alertAdmins("High RAM usage detected: {$ramUsage}%");
        }

        if ($tps < $this->plugin->getConfigManager()->getTpsThreshold()) {
            $this->alertAdmins("Low TPS detected: {$tps}");
        }
    }

    private function alertAdmins(string $message): void {
        $prefix = $this->plugin->getConfig()->get("prefix");
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
            if ($player->hasPermission("serveroptimizer.alert")) {
                $player->sendMessage($prefix . " " . $message);
            }
        }
    }

    private function getCpuUsage(): int {
        return 0;
    }

    private function getRamUsage(): int {
        return 0;
    }
}
