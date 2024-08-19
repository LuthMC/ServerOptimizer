<?php

namespace Luthfi\ServerOptimizer\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use Luthfi\ServerOptimizer\Main;

class ClearCommand extends Command {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("serveroptimizer clear", "Perform a quick lag cleanup", "/serveroptimizer clear", ["soclear"]);
        $this->plugin = $plugin;
        $this->setPermission("serveroptimizer.clear");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        if (!$this->testPermission($sender)) {
            return false;
        }

        $level = $this->plugin->getServer()->getLevels()[0];
        $count = 0;

        foreach ($level->getEntities() as $entity) {
            if (!$entity instanceof Player) {
                $entity->close();
                $count++;
            }
        }

        $sender->sendMessage(TF::GREEN . "Cleared " . $count . " entities.");

        return true;
    }
}
