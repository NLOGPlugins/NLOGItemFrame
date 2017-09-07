<?php

namespace nlog\NLOGItemFrame;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\ItemFrameDropItemEvent;
use ifteam\SimpleArea\database\area\AreaProvider;
use ifteam\SimpleArea\database\area\AreaSection;

class Main extends PluginBase implements Listener{
	
	const TAG = "§b§o[ Info ] §7";
	public $area;
	
 	 public function onEnable(){
    	$this->getServer()->getPluginManager()->registerEvents($this, $this);
    	
    	if ($this->getServer()->getPluginManager()->getPlugin("SimpleArea") === null) {
    		$this->getLogger()->notice("SimpleArea가 없습니다. SimpleArea 호환 모드를 종료합니다.");
    		$this->getLogger()->notice("SimpleArea doesn't exist. SimpleArea compatibility mode turn off.");
    		$this->area = false;
    	}else{
    		$this->area = true;
    	}
    	
    	if ($this->getServer()->getLanguage()->getLang() === "kor") {
    		$this->getLogger()->info("액자 아이템 드랍 금지 플러그인");
    	}else{
    		$this->getLogger()->info("Block Item Frame Plugin");
    	}
    	$this->getLogger()->info("Made by NLOG (nlog.kro.kr)");
 	 }
 	 
 	 public function onDropItem (ItemFrameDropItemEvent $ev) {
 	 	
 	 	if (!$ev->getPlayer()->isOp()) {
 	 		if ($this->area) {
 	 			$areaSection = AreaProvider::getInstance()->getArea($ev->getBlock()->getLevel(), $ev->getBlock()->x, $ev->getBlock()->z);
 	 			if ($areaSection instanceof AreaSection) {
 	 				if(!$areaSection->isResident($ev->getPlayer()->getName())) {
 	 					$ev->setCancelled(true);
 	 					if ($this->getServer()->getLanguage()->getLang() === "kor") {
 	 						$ev->getPlayer()->sendMessage(self::TAG."액자 내의 아이템을 뺄 수 없습니다.");
 	 					}else{
 	 						$ev->getPlayer()->sendMessage(self::TAG."You can't get item from item frame");
 	 					}
 	 				}
 	 			}else{
 	 				$ev->setCancelled(true);
 	 				if ($this->getServer()->getLanguage()->getLang() === "kor") {
 	 					$ev->getPlayer()->sendMessage(self::TAG."액자 내의 아이템을 뺄 수 없습니다.");
 	 				}else{
 	 					$ev->getPlayer()->sendMessage(self::TAG."You can't get item from item frame");
 	 				}
 	 			}
 	 		}else{
 	 			$ev->setCancelled(true);
 	 			if ($this->getServer()->getLanguage()->getLang() === "kor") {
 	 				$ev->getPlayer()->sendMessage(self::TAG."액자 내의 아이템을 뺄 수 없습니다.");
 	 			}else{
 	 				$ev->getPlayer()->sendMessage(self::TAG."You can't get item from item frame");
 	 			}
 	 		}
 	 	}
 	 	
 	 }
 	 
  }
?>
