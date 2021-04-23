<?php

namespace Cr1m\SlotsPlus;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\server\QueryRegenerateEvent;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{

    public $config;

    /*
     * @return void
     */

    public function onEnable(): void
    {

        if (!is_file($this->getDataFolder() . "config.yml")) {
            $this->saveDefaultConfig();
        }

        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
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
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()) {
            case "fakeplayers":
                if($sender->hasPermission("SlotsPlus.command.fakeplayers")) {
                    if(isset($args[0])) {
                        if (is_numeric($args[0])) {
                            $this->config->set("fakePlayers", true);
                            $this->config->set("fakeSlots", (int)$args[0]);

                            $sender->sendMessage("Enabled fake slots, with " . $args[0] . " slots");
                            if ($this->config->get("unlimitedSlots") === true) {
                                $this->config->set("unlimitedSlots", false);
                            }
                            $this->config->save();
                            break;
                        }
                        else{
                            $sender->sendMessage("Please only use an integer i.e. 7");
                            break;
                        }

                    }
                    else if ($this->config->get("fakePlayers") === true) {
                        $this->config->set("fakePlayers", false);
                        $sender->sendMessage("Disabled fake slots");
                        if($this->config->get("unlimitedSlots") === true) {
                            $this->config->set("unlimitedSlots", false);
                        }
                        $this->config->save();
                        break;
                    } else {
                        $sender->sendMessage("Something went wrong there");
                    }

                }
                break;
            case "unlimitedslots":
                if($sender->hasPermission("SlotsPlus.command.unlimitedslots")) {

                    if ($this->config->get("unlimitedSlots") === false) {

                        $this->config->set("unlimitedSlots", true);
                        $sender->sendMessage("Enabled unlimited slots");
                        if($this->config->get("fakePlayers") === true) {
                            $this->config->set("fakePlayers", false);
                        }
                        $this->config->save();
                        break;
                    }
                    if ($this->config->get("unlimitedSlots") === true) {
                        $this->config->set("unlimitedSlots", false);
                        $sender->sendMessage("Disabled unlimited slots");
                        if($this->config->get("fakePlayers") === true) {
                            $this->config->set("fakePlayers", false);
                        }
                        $this->config->save();
                        break;
                    }

                    }
                break;

                }
                return true;
        }
}
