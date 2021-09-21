<?php

declare(strict_types=1);

namespace NguyenDuck\MultiSpawn;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\command\{
	Command,
	CommandExcutor,
	CommandSender,
	PluginCommand
};
use pocketmine\utils\TextFormat;
use pocketmine\level\Position;
use function count;

class Main extends PluginBase
{
	public function onEnable()
	{
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
	}

	public function onCommand(CommandSender $sender, Command $command, $label, array $args) : bool
	{
		switch ($command) {
			case "hub":
				if ($sender instanceof Player) {
					$sender->teleport($sender->getServer()->getDefaultLevel()->getSafeSpawn(), 0.0, 0.0);
				} else {
					$sender->sendMessage("Bạn chỉ có thể sử dụng lệnh này trong game");
				}
				return true;
			
			case "spawn":
				if ($sender instanceof Player) {
					$sender->teleport($sender->getLevel()->getSafeSpawn(), 0.0, 0.0);
				} else {
					$sender->sendMessage("Bạn chỉ có thể sử dụng lệnh này trong game");
				}
				return true;
			
			case "setspawn":
				if (!count($args)) {
					$world = $sender->getLevel();
					$position = $sender->getPosition();

					$world->setSpawnLocation($position);
					$sender->sendMessage("§l§e[MultiSpawn] §aĐã đặt §bspawn §atại vị trí §bcủa bạn§r");
					return true;
				}

				if (count($args) == 3) {
					$world = $sender->getLevel();
					$position = new Position(floatval($args[0]), floatval($args[1]), floatval($args[2]));

					$world->setSpawnLocation($position);
					$sender->sendMessage("§l§e[MultiSpawn] §aĐã đặt §bspawn §atại vị trí §b".$args[0]." ".$args[1]." ".$args[2]."§r");
					return true;
				}

				if (count($args) == 4) {
					$world = $sender->getServer()->getLevelByName($args[0]);
					$position = new Position(floatval($args[1]), floatval($args[2]), floatval($args[3]));

					if (!$this->world) {
						$sender->sendMessage("§l§e[MultiSpawn] §cKhông Tìm Thấy Thế Giới §r".$args[0]);
					}

					$world->setSpawnLocation($position);
					$sender->sendMessage("§l§e[MultiSpawn] §aĐã đặt §bspawn §a của thế giới §r.$args[0]. §atại vị trí §b".$args[1]." ".$args[2]." ".$args[3]."§r");
					return true;
				}
			
			case "sethub":
				$sender->sendMessage("§l§e[MultiSpawn] §cHiện tại chưa thể sử dụng lệnh này do ad lười, chưa viết!");
				return true;
			
			default:
				return false;
		}
		return true;
	}
}
