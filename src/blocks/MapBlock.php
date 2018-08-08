<?php

namespace trk\uikit\blocks;

use Yii;
use trk\uikit\Module;
use trk\uikit\BaseUikitBlock;
use trk\uikit\blockgroups\MiscGroup;

/**
 * Map Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class MapBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    public $component = "map";

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return MiscGroup::class;
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('map');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'map';
    }

    /**
     * @inheritdoc
     */
    public function config()
    {
        return [
            'vars' => [
                [
                    'var' => 'address',
                    'label' => Module::t('map_address_label'),
                    'type' => self::TYPE_TEXT,
                    'placeholder' => 'Zephir Software Design AG, Tramstrasse 66, 4142 Münchenstein'
                ],
                [
                    'var' => 'zoom',
                    'label' => Module::t('map_zoom_label'),
                    'type' => self::TYPE_SELECT,
                    'initvalue' => '12',
                    'options' => [
                        ['value' => '0', 'label' => Module::t('map_zoom_entire')],
                        ['value' => '1', 'label' => '4000 km'],
                        ['value' => '2', 'label' => '2000 km (' . Module::t('map_zoom_world') . ')'],
                        ['value' => '3', 'label' => '1000 km'],
                        ['value' => '4', 'label' => '400 km (' . Module::t('map_zoom_continent') . ')'],
                        ['value' => '5', 'label' => '200 km'],
                        ['value' => '6', 'label' => '100 km (' . Module::t('map_zoom_country') . ')'],
                        ['value' => '7', 'label' => '50 km'],
                        ['value' => '8', 'label' => '30 km'],
                        ['value' => '9', 'label' => '15 km'],
                        ['value' => '10', 'label' => '8 km'],
                        ['value' => '11', 'label' => '4 km'],
                        ['value' => '12', 'label' => '2 km (' . Module::t('map_zoom_city') . ')'],
                        ['value' => '13', 'label' => '1 km'],
                        ['value' => '14', 'label' => '400 m (' . Module::t('map_zoom_district') . ')'],
                        ['value' => '15', 'label' => '200 m'],
                        ['value' => '16', 'label' => '100 m'],
                        ['value' => '17', 'label' => '50 m (' . Module::t('map_zoom_street') . ')'],
                        ['value' => '18', 'label' => '20 m'],
                        ['value' => '19', 'label' => '10 m'],
                        ['value' => '20', 'label' => '5 m (' . Module::t('map_zoom_house') . ')'],
                        ['value' => '21', 'label' => '2.5 m'],
                    ],
                ],
                [
                    'var' => 'maptype',
                    'label' => Module::t('map_maptype_label'),
                    'type' => self::TYPE_SELECT,
                    'options' => [
                        ['value' => 'm', 'label' => Module::t('map_maptype_roadmap')],
                        ['value' => 'k', 'label' => Module::t('map_maptype_satellitemap')],
                        ['value' => 'h', 'label' => Module::t('map_maptype_hybrid')],
                    ],
                ],
            ],
            'cfgs' => [
                ['var' => 'snazzymapsUrl', 'label' => Module::t('map_snazzymapsUrl_label'), 'type' => self::TYPE_TEXT]
            ]
        ];
    }
    public function getFieldHelp()
    {
        return [
            'snazzymapsUrl' => Module::t('map_snazzymapsUrl_help'),
        ];
    }
    /**
     * @inheritdoc
     */
    public function extraVars()
    {
        return [
            'embedUrl' => $this->generateEmbedUrl(),
        ];
    }
    /**
     * Generate the embed url based on localisation or whether its snazzy or not.
     * @since 1.0.2
     */
    public function generateEmbedUrl()
    {
        if (($snazzymapsUrl = $this->getCfgValue('snazzymapsUrl'))) {
            return $snazzymapsUrl;
        }

        if (empty($this->getVarValue('address'))) {
            return false;
        }

        $params = [
            'f' => 'q',
            'source' => 's_q',
            'hl' => Yii::$app->composition->langShortCode,
            'q' => $this->getVarValue('address', 'Armutalan Mahallesi, ALTI VE BIR BILISIM TEKNOLOJILERI, Marmaris/Muğla Province'),
            'z' => $this->getVarValue('zoom', 15),
            't' => $this->getVarValue('maptype', 'h'),
            'output' => 'embed',
        ];

        return 'https://maps.google.com/maps?' . http_build_query($params, null, '&', PHP_QUERY_RFC1738);
    }
    /**
     * @inheritdoc
     */
    public function admin()
    {
        return '{% if vars.address is not empty %}<div class="iframe-container"><iframe src="{{extras.embedUrl | raw}}"></iframe></div>{% else %}<span class="block__empty-text">' . Module::t('map_no_content') . '</span>{% endif %}';
    }
}
