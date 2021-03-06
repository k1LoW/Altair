<?php
namespace Altair\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;

/**
 * Altair component
 * To convert special characters of variables to HTML entities
 * that is passeed to View object.
 * However, decode encoded text that will be input into a form
 */
class AltairComponent extends Component
{

    /**
     * An optional argument defining the encoding used when converting characters
     * default UTF-8
     *
     * @var string
     */
    private $_charset;
    private $_double;

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'charset' => null,
        'double' => true,
        'escape' => true
    ];

    /**
     * Initialize properties.
     *
     * @param array $config The config data.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->_charset = $this->_config['charset'];
        $this->_double = $this->_config['double'];
        $this->_escape = $this->_config['escape'];
        Configure::write('Altair.escape', $this->_config['escape']);
    }

    /*
     * start up
     * Set helpers in controller
     *
     * @param Event $event
     */
    public function startup($event)
    {
        $event->subject->helpers += [
            'Altair.Escape' => [
                'charset' => $this->_charset,
                'double' => $this->_double,
                'escape' => $this->_escape
            ]
        ];
    }

    /**
     * escap on/off
     *
     * @return
     */
    public function escape($enabled = true)
    {
        if (!is_bool($enabled)) {
            return false;
        }
        $this->_config['escape'] = $enabled;
        Configure::write('Altair.escape', $this->_config['escape']);
        return true;
    }
}
