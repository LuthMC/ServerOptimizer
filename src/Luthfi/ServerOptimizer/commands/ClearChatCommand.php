<?php

namespace Luthfi\ServerOptimizer\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Server;

class ClearChatCommand extends Command {

    public function __construct() {
        parent::__construct("serveroptimizer clearchat", "Clear the chat to reduce impact from spam", "/serveroptimizer clearchat", ["soclearchat"]);
        $this->setPermission("serveroptimizer.clearchat");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        if (!$this->testPermission($sender)) {
            return false;
        }

        $server = Server::getInstance();
        for ($i = 0; $i < 100; $i++) {
            $server->broadcastMessage(" ");
        }

        $sender->sendMessage(TF::GREEN . "Chat has been cleared.");

        return true;
    }
}
