<?php

/**
 * This is controller for movie. Controller correspondents with "movie" model
 *
 * PHP version 7.2
 *
 * @category   Movie_Controller
 * @package    Controller
 * @author     EdwardAJ <13517115@std.stei.itb.ac.id>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://localhost:8080/movie
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.0.0
 * @deprecated File will not be deprecated.
 */

class Home_Controller
{
    private function _getHeaderAuth()
    {
        foreach (getallheaders() as $name => $value) {
            if ($name === 'Authorization') {
                return $value;
            }
        }
    }

    public function getMovie($connection)
    {
        
    }

    public function render()
    {

    }
}
?>