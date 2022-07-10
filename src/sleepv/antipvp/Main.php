<?php

namespace sleepv\antipvp;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener
{

    protected function onEnable(): void
    {
        $this->saveDefaultConfig();
    }

    public function onDamage(EntityDamageByEntityEvent $event): void
    {
        if($this->getConfig()->get("pvp.status") === "on"){
            $event->cancel();
        }
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if($command->getName() === "antipvp"){
            if($sender->hasPermission("use.antipvp.command")){
                $sender->sendMessage(TextFormat::colorize("&cYou Dont Have Permission"));
                return false;
            }
            if($args[0] === "on"){
                $this->getConfig()->set("pvp.status", "on");
                return true;
            }
            if($args[0] === "off"){
                $this->getConfig()->set("pvp.status", "off");
                return true;
            }
            $sender->sendMessage(TextFormat::colorize("&cUse: /antipvp [off | on]"));
            return true;
        }
        return true;
    }

    # no mas pa llegar a
    # 50 lineas xd
}