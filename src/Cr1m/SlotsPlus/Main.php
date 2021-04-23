<?php

namespace Cr1m\SlotsPlus;

use pocketmine\event\server\QueryRegenerateEvent;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{

    /*
     * @return void
     */

    public function onEnable(): void
    {

        if (!is_file($this->getDataFolder() . "config.yml")) {
            $this->saveDefaultConfig();
        }

        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        if (!is_dir($this->getDataFolder())) {
            @mkdir($this->getDataFolder());
        }
    }

    public function slotsPlus(QueryRegenerateEvent $event)
    {

        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
        if ($config->get("unlimitedSlots") === true) {
            $event->setMaxPlayerCount($event->getPlayerCount() + 1);
        }

        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
        if ($config->get("fakePlayers") === true) {
            $fakeCount = $config->get("fakeSlots");
            $event->setPlayerCount($fakeCount);
        }
    }
}