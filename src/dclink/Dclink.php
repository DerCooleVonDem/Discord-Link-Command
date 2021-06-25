<?php

namespace dclink;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

class Dclink extends PluginBase{

    public function onEnable()
    {
        $this->saveDefaultConfig();
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        $cfg = $this->getConfig();
        if($command->getName() === "discord"){
            $sender->sendMessage($cfg->get("discord-link-message"));

            if(!$sender instanceof Player) return true;

            $player = $this->getServer()->getPlayer($sender->getName());
            $level = $player->getLevel();
            $level->addSound(new EndermanTeleportSound($player->asVector3()));
        }
        return true;
    }


}