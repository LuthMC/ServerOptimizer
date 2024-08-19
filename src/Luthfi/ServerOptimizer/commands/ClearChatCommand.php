<?php

namespace Luthfi\ServerOptimizer\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use Luthfi\ServerOptimizer\Main;

class ClearChatCommand extends Command {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("serveroptimizer clearchat", "Clear the chat to reduce impact from spam", "/serveroptimizer clearchat", ["soclearchat"]);
        $this->plugin = $plugin;
        $this->setPermission("serveroptimizer.clearchat");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        if (!$this->testPermission($sender)) {
            return false;
        }

        for ($i = 0; $i < 100; $i++) {
            $sender->getServer()->broadcastMessage(" ");
        }

        $sender->sendMessage(TF::GREEN . "Chat has been cleared.");

        return true;
    }
}
