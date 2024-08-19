<?php

namespace Luthfi\ServerOptimizer\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use Luthfi\ServerOptimizer\Main;

class HelpCommand extends Command {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("serveroptimizer", "ServerOptimizer Commands", "/serveroptimizer help", ["so"]);
        $this->plugin = $plugin;
        $this->setPermission("serveroptimizer.help");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if (isset($args[0]) && strtolower($args[0]) === "help") {
            $this->sendHelpMessage($sender);
        } else {
            $sender->sendMessage(TF::RED . "Usage: /serveroptimizer help");
        }

        return true;
    }

    private function sendHelpMessage(CommandSender $sender): void {
        $prefix = $this->plugin->getConfig()->get("prefix");
        $sender->sendMessage(TF::AQUA . $prefix . " ServerOptimizer Commands:");
        $sender->sendMessage(TF::YELLOW . "/serveroptimizer help" . TF::WHITE . " - Show this help message");
        $sender->sendMessage(TF::YELLOW . "/serveroptimizer check" . TF::WHITE . " - Analyze current lag sources");
        $sender->sendMessage(TF::YELLOW . "/serveroptimizer clear" . TF::WHITE . " - Perform a quick lag cleanup");
        $sender->sendMessage(TF::YELLOW . "/serveroptimizer clearchat" . TF::WHITE . " - Clear the chat to reduce impact from spam");
        $sender->sendMessage(TF::YELLOW . "/serveroptimizer reload" . TF::WHITE . " - Reload the plugin configuration");
    }
}
