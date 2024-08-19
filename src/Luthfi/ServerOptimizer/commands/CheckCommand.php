<?php

namespace Luthfi\ServerOptimizer\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use Luthfi\ServerOptimizer\Main;

class CheckCommand extends Command {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("serveroptimizer check", "Analyze current lag sources", "/serveroptimizer check", ["socheck"]);
        $this->plugin = $plugin;
        $this->setPermission("serveroptimizer.check");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        if (!$this->testPermission($sender)) {
            return false;
        }

        $tps = $this->plugin->getServer()->getTicksPerSecond();
        $load = $this->plugin->getServer()->getTickUsage();
        $entities = count($this->plugin->getServer()->getLevels()[0]->getEntities());

        $sender->sendMessage(TF::AQUA . "Server Performance:");
        $sender->sendMessage(TF::YELLOW . "TPS: " . TF::WHITE . $tps);
        $sender->sendMessage(TF::YELLOW . "Load: " . TF::WHITE . number_format($load, 2) . "%");
        $sender->sendMessage(TF::YELLOW . "Entities: " . TF::WHITE . $entities);

        return true;
    }
}
