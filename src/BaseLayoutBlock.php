<?php

namespace trk\uikit;

/**
 * Base block for all uikit blocks
 *
 * The BaseUikitBlock helps to allocate the view files for the blocks without using an alias.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
abstract class BaseLayoutBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "row";

    /**
     * @var array $widths of row columns
     */
    public $layout_types = [
        'whole' => [
            'cols' => ['first' => 12],
            'widths' => [['1-1']]
        ],
        'halves' => [
            'cols' => ['first' => 6, 'second' => 6],
            'widths' => [['expand'], ['expand']]
        ],
        'thirds' => [
            'cols' => ['first' => 4, 'second' => 4, 'third' => 4],
            'widths' => [['expand'], ['expand'], ['expand']]
        ],
        'quarters' => [
            'cols' => ['first' => 3, 'second' => 3, 'third' => 3, 'fourth' => 3],
            'widths' => [['fixed', '1-2'], ['fixed', '1-2'], ['fixed', '1-2'], ['fixed', '1-2']]
        ],
        'thirds-2-1' => [
            'cols' => ['first' => 7, 'second' => 5],
            'widths' => [['2-3'], ['expand']]
        ],
        'thirds-1-2' => [
            'cols' => ['first' => 5, 'second' => 7],
            'widths' => [['expand'], ['2-3']]
        ],
        'quarters-3-1' => [
            'cols' => ['first' => 8, 'second' => 4],
            'widths' => [['3-4'], ['expand']]
        ],
        'quarters-1-3' => [
            'cols' => ['first' => 4, 'second' => 8],
            'widths' => [['expand'], ['3-4']]
        ],
        'quarters-2-1-1' => [
            'cols' => ['first' => 6, 'second' => 3, 'third' => 3],
            'widths' => [['1-2'], ['expand'], ['expand']]
        ],
        'quarters-1-1-2' => [
            'cols' => ['first' => 3, 'second' => 3, 'third' => 6],
            'widths' => [['expand'], ['expand'], ['1-2']]
        ],
        'quarters-1-2-1' => [
            'cols' => ['first' => 3, 'second' => 6, 'third' => 3],
            'widths' => [['expand'], ['1-2'], ['expand']]
        ],
        'fixed-left' => [
            'cols' => ['first' => 4, 'second' => 8],
            'widths' => [['large'], ['expand']]
        ],
        'fixed-right' => [
            'cols' => ['first' => 8, 'second' => 4],
            'widths' => [['expand'], ['fixed']]
        ],
        'fixed-inner' => [
            'cols' => ['first' => 4, 'second' => 4, 'third' => 4],
            'widths' => [['expand'], ['fixed'], ['expand']]
        ],
        'fixed-outer' => [
            'cols' => ['first' => 4, 'second' => 4, 'third' => 4],
            'widths' => [['fixed'], ['expand'], ['fixed']]
        ]
    ];

    /**
     * @var array $widths of row columns
     */
    public $layouts = [];

    /**
     * Initialize
     */
    public function init() {
        parent::init();
        $this->setLayouts();
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'view_column';
    }

    /**
     * Set layouts
     */
    public function setLayouts() {
        foreach ($this->availableLayouts() as $i => $name) {
            if($layout = Uikit::element($name, $this->layout_types)) {
                $this->layouts[$name] = $layout;
            }
        }
    }

    /**
     * @return array
     */
    public function availableLayouts() {
        return [];
    }

    /**
     * @return string
     */
    public function defaultLayout() {
        return "";
    }

    /**
     * Get selected layout name
     *
     * @return mixed
     */
    public function getLayoutName() {
        return $this->getVarValue('layout', $this->defaultLayout());
    }

    /**
     * Return selected layout data
     *
     * @return mixed
     */
    public function getLayout() {
        $name = $this->getLayoutName();
        $layout = $this->layouts[$name];
        $layout['name'] = $name;
        return $layout;
    }

    public function getLayoutConfig() {
        $options = [];
        foreach ($this->layouts as $name => $layout) {
            $options[] = [
                'value' => $name,
                'label' => Module::t($name)
            ];
        }
        return [
            'var' => 'layout',
            'label' => Module::t('layout'),
            'type' => self::TYPE_SELECT,
            'initvalue' => $this->getLayoutName(),
            'options' => $options
        ];
    }

    /**
     * Return placeholders data
     *
     * @return array
     */
    public function getPlaceholders() {
        $layout = $this->getLayout();
        $placeholders = [];
        foreach ($layout['cols'] as $name => $width) {
            $placeholders[0][] = [
                'var' => $name,
                'cols' => $width
            ];
        }

        return $placeholders;
    }

    /**
     * @inheritdoc
     */
    public function config()
    {
        $configs = parent::config();
        // Set layouts
        $vars = $configs['vars'];
        array_unshift($vars, $this->getLayoutConfig());
        $configs['vars'] = $vars;
        // Set columns
        $column = $this->getComponentConfigs('column');
        $columnConfigs = [];
        if($column['vars']) {
            $layout = $this->getLayout();
            foreach ($layout['cols'] as $name => $width) {
                foreach ($column['vars'] as $i => $field) {
                    $field['var'] = $name . $field['var'];
                    $field['label'] = Module::t($name) . $field['label'];
                    $columnConfigs[] = $field;
                }
            }
        }
        $configs['cfgs'] = $columnConfigs;
        return $configs;
    }

    /**
     * @inheritdoc
     */
    public function frontend(array $params = array(), $viewFile = "")
    {
        $layout = $this->getLayout();

        $i = 0;
        $nbItems = count($layout['cols']);
        $data = $this->getValues();
        $data['columns'] = $nbItems;
        $items = [];
        foreach ($layout['cols'] as $name => $col) {
            $index = $i++;
            $items[$name]['index'] = $index;
            $items[$name]['name'] = $name;
            $items[$name]['hasNext'] = $index == $nbItems ? false : true;
            $items[$name]['widths'] = Uikit::element($index, $layout['widths'], ['expand']);
            foreach ($data as $var => $value) {
                if(strpos($var, $name) === FALSE) continue;
                $rename = str_replace($name, '', $var);
                $items[$name][$rename] = $value;
                unset($data[$var]);
            }
            $items[$name]['content'] = $this->getPlaceholderValue($name);
            $items[$name] = Uikit::configs($items[$name]);
        }
        $data = Uikit::configs($data);
        $data['items'] = $items;

        return $this->view->render("BaseLayoutBlock", ['data' => $data], $this);
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        return '';
    }
}