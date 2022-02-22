<?php

namespace YTBJero\Blood;

use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;

use pocketmine\world\particle\BlockBreakParticle;

use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class Main extends PluginBase implements Listener {

	public function onEnable(): void
	{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDamage(EntityDamageEvent $event) {
        $player = $event->getEntity();
        $cause = $event->getCause();
        if($cause === EntityDamageEvent::CAUSE_ENTITY_ATTACK) {
            if($event instanceof EntityDamageByEntityEvent) {
                $damager = $event->getDamager();
                $entity = $event->getEntity();
                if($damager instanceof Player and $entity instanceof Player) {
                    $entity->getPosition()->getWorld()->addParticle($entity->getPosition()->add(0, 0, 0), new BlockBreakParticle(BlockFactory::getInstance()->get(152, 0)));
                }
            }
        }
    }
}