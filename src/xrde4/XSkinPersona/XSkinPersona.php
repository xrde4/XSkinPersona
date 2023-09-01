<?php

/**
 * GNU LESSER GENERAL PUBLIC LICENSE v3.0
 
██╗░░██╗██████╗░██████╗░███████╗██╗░░░██╗
╚██╗██╔╝██╔══██╗██╔══██╗██╔════╝██║░░░██║
░╚███╔╝░██████╔╝██║░░██║█████╗░░╚██╗░██╔╝
░██╔██╗░██╔══██╗██║░░██║██╔══╝░░░╚████╔╝░
██╔╝╚██╗██║░░██║██████╔╝███████╗░░╚██╔╝░░
╚═╝░░╚═╝╚═╝░░╚═╝╚═════╝░╚══════╝░░░╚═╝░░░
 
 If you find my plugin helpful, could you please consider giving it a star on my profile? 
 Your support means a lot to me! 🌟 Thank you! (https://github.com/xrde4)
 Special thanks to presentkim for their PM3 and PM4.
 */

declare(strict_types=1);

namespace xrde4\XSkinPersona;

use pocketmine\entity\Skin;
use pocketmine\plugin\PluginBase;
use pocketmine\network\mcpe\convert\SkinAdapter;
use pocketmine\network\mcpe\convert\SkinAdapterSingleton;
use pocketmine\network\mcpe\convert\TypeConverter;
use pocketmine\network\mcpe\convert\LegacySkinAdapter;
use pocketmine\network\mcpe\protocol\types\skin\SkinData;


class XSkinPersona extends PluginBase{

    public function onEnable() : void{
        TypeConverter::getInstance()->setSkinAdapter(new CustomSkin());
    }

}

 class CustomSkin extends LegacySkinAdapter {
    private array $personaSkinData = [];

    public function fromSkinData(SkinData $data) : Skin{
        $skin = parent::fromSkinData($data);

        if($data->isPersona()){
            $this->personaSkinData[spl_object_id($skin)] = $data;
        }
        return $skin;
    }

    public function toSkinData(Skin $skin) : SkinData{
        return $this->personaSkinData[spl_object_id($skin)] ?? parent::toSkinData($skin);
    }
} 
