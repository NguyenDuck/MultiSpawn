<?php

declare(strict_types=1);

namespace NguyenDuck\MultiSpawn;

use pocketmine\Player;
use pocketmine\event\{
	Listener,
	player\PlayerJoinEvent,
	player\PlayerRespawnEvent
};
use pocketmine\level\Position;
use pocketmine\utils\TextFormat;

class EventListener implements Listener
{
	private $plugin;

	public function __construct(Main $plugin)
	{
		$this->plugin = $plugin;
	}

	public function onPlayerRespawn(PlayerRespawnEvent $event)
	{
		$event->setRespawnPosition($event->getPlayer()->getLevel()->getSafeSpawn());
	}

	public function onPlayerJoin(PlayerJoinEvent $event)
	{
		$level = $event->getPlayer()->getServer()->getDefaultLevel();
		$spawn = $level->getSafeSpawn();
		$x = round($spawn->x) + 0.5;
		$y = round($spawn->y);
		$z = round($spawn->z) + 0.5;
		$spawn = new Position($x, $y, $z, $level);
		$event->getPlayer()->teleport($spawn, 0, 0);
	}
}