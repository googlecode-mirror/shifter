<?php
/**
 * @desc Glider algorithm. Returns next/previous element position
 * @author Andrius Virbičianskas <andrius@virbicianskas.lt>
 * @copyright 2010, Andrius Virbičianskas
 * @package shifter
 * @subpackage classes
 * @license GNU GPL
 * @url http://www.virbicianskas.lt/
 * @version 0.1.0
 * @dependencies php5+
 */

/**
 * @desc Glider class
 * @package shifter
 * @subpackage classes
 */
class glider {
  /**
   * @desc Variable that should be changed when changing link's id in shifter.js.
   * Holds the information of the direction.
   * @var string
   * @access private
   */
  private $_forward = 'forward';

  /**
   * @desc Variable that should be changed when changing link's id in shifter.js.
   * Holds the information of the direction.
   * @var string
   * @access private
   */
  private $_backward = 'backward';

  /**
   * @desc The number of images preloaded on page load. Should not be changed.
   * @var integer
   * @access private
   */
  private $_preload_count = 5;

  /**
   * @desc The position of image to display on page load.
   * @var integer
   * @access private
   */
  private $_visible_position = null;

  /**
   * @desc To distinct when the images are preloaded and when not.
   * @var boolean
   * @access private
   */
  private $_preload = null;

  /**
   * @desc The direction from which request came.
   * @var string
   * @access private
   */
  private $_direction = null;

  /**
   * @desc Carousel constructor. Sets important variables. Resets positions after page reload.
   * @param boolean $preload If its preloading or not
   * @param string $direction The request direction
   * @param integer $visible_position Position to show at start
   * @access public
   */
  public function __construct($preload, $direction, $visible_position = 0) {
    $this->_visible_position = $visible_position;
    $this->_preload = $preload;
    $this->_direction = $direction;

    $this->_reset();
  }

  /**
   * @desc Resets frame positions after page reload. Nessecary, because sessions are used.
   * @access private
   */
  private function _reset() {
    if (!isset($_SESSION['current_l'])) {
      $_SESSION['current_l'] = $this->_visible_position - 1;
    }
    if (!isset($_SESSION['current_r'])) {
      $_SESSION['current_r'] = $this->_visible_position;
    }

    if (!isset($_SESSION['preload'])) {
      $_SESSION['preload'] = 0;
    }

    if ($this->_preload == 'true') {
      $_SESSION['preload']++;
    }

    if ($_SESSION['preload'] > $this->_preload_count) {
      $_SESSION['preload'] = 1;
      $_SESSION['current_l'] = $this->_visible_position - 1;
      $_SESSION['current_r'] = $this->_visible_position;
    }
  }

  /**
   * @desc Return element's new position
   * @return integer $position Element's position
   * @access public
   */
  public function getPosition() {
    /* Forward direction */
    if ($this->_direction == $this->_backward) {
      if ($this->_preload == 'false') {
        $_SESSION['current_r']--;
      }

      $position = $_SESSION['current_l'];
      $_SESSION['current_l']--;
    }

    /* Backward direction */
    if ($this->_direction == $this->_forward) {
      if ($this->_preload == 'false') {
        $_SESSION['current_l']++;
      }

      $position = $_SESSION['current_r'];
      $_SESSION['current_r']++;
    }

    return $position;
  }
}
?>