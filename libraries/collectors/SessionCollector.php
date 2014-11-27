<?php
/**
 * CodeIgniter PHP Debug Bar
 *
 * @package		CodeIgniter PHP Debug Bar
 * @author		Anthony Tansens <atansens@gac-technology.com>
 * @license     http://opensource.org/licenses/MIT MIT
 * @link		http://www.gac-technology.com
 * @since		Version 1.0
 * @filesource
 */ 
defined('BASEPATH') OR exit('No direct script access allowed');

use DebugBar\DataCollector\DataCollector;
use DebugBar\DataCollector\DataCollectorInterface;
use DebugBar\DataCollector\Renderable;

/**
 * Description of SessionCollector
 *
 * @package		CodeIgniter PHP Debug Bar
 * @subpackage	Libraries
 * @category	Collectors
 * @author      Anthony Tansens <atansens@gac-technology.com>
 */
class SessionCollector extends DataCollector implements DataCollectorInterface, Renderable
{
    /**  
     * @var  CI_Session $session 
     */
    protected $session;

    /**
     * 
     * @param CI_Session $session
     */
    public function setSession(CI_Session $session)
    {
        $this->session = $session;
    }

    /** 
     * @return CI_Session 
     */
    public function getSession()
    {
        return $this->session;
    }

    public function collect()
    {
        $data = array();

        foreach ($this->getSession()->userdata() as $key => $value) {
            $data[$key] = is_string($value) ? $value : $this->formatVar($value);
        }
        return $data;
    }

    public function getName()
    {
        return 'session';
    }

    public function getWidgets()
    {
        return array(
            "session" => array(
                "icon" => "archive",
                "widget" => "PhpDebugBar.Widgets.VariableListWidget",
                "map" => "session",
                "default" => "{}"
            )
        );
    }
}

/* End of file SessionCollector.php */
/* Location: ./codeigniter-debugbar/librairies/collectors/SessionCollector.php */