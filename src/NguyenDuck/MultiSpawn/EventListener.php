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
		$event->getPlayer()->teleport($event->getPlayer()->getServer()->getDefaultLevel()->getSafeSpawn());
	}
}