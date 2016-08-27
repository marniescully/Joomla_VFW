<?php
/**
 * FW Gallery 3.0
 * @copyright (C) 2014 Fastw3b
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.fastw3b.net/ Official website
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );

class JHTMLfwgGrid {
    static function selected(&$row, $i, $imgY = 'tick.png', $imgX = 'publish_x.png', $prefix='') {
        $img    = $row->selected ? $imgY : $imgX;
        $task   = $row->selected ? 'unselect' : 'select';
        $alt    = JText::_($row->selected ?'selected':'Unselected');
        $action = JText::_($row->selected ?'Unselect Item':'Select item');

        $href = '
        <a class="btn btn-micro hasTooltip'.($row->selected?' active':'').'" href="javascript:void(0);" onclick="return listItemTask(\'cb'. $i .'\',\''. $prefix.$task .'\')" title="'. $action .'">
        <i class="icon-star'.($row->selected ?'':'-empty').'"></i></a>'
        ;

        return $href;
    }
	static function published( &$row, $i, $imgY = 'tick.png', $imgX = 'publish_x.png', $prefix='' )
	{
		$img 	= $row->published ? $imgY : $imgX;
		$task 	= $row->published ? 'unpublish' : 'publish';
		$alt 	= $row->published ? JText::_( 'Published' ) : JText::_( 'Unpublished' );
		$action = $row->published ? JText::_( 'Unpublish Item' ) : JText::_( 'Publish item' );

		$href = '
		<a class="btn btn-micro hasTooltip'.($row->published?' active':'').'" href="javascript:void(0);" onclick="return listItemTask(\'cb'. $i .'\',\''. $prefix.$task .'\')" title="'. $action .'">
		<i class="icon-'.($row->published?'':'un').'publish"></i></a>'
		;

		return $href;
	}
	static function defaultTemplate($item, $selected, $num) {
		$action = JText::_($selected ?'':'Make this tempate default');
		$href = '
        <a class="btn btn-micro hasTooltip'.($selected?' active':'').'" href="javascript:void(0);" onclick="return listItemTask(\'cb'. $num .'\',\'save\')" title="'. $action .'">
        <i class="icon-star'.($selected ?'':'-empty').'"></i></a>'
		;

		return $href;
	}
}
?>