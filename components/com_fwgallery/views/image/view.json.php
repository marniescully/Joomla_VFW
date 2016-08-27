<?php
/**
 * FW Gallery 3.0
 * @copyright (C) 2014 Fastw3b
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.fastw3b.net/ Official website
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );

class fwGalleryViewImage extends JViewLegacy {
    function display($tmpl=null) {
        $model = $this->getModel();
        $row = $model->getObj();
		$buff = new stdclass;

		switch ($this->getLayout()) {
			case 'test' :
				$buff = $model->testGallery();
			break;
			case 'testUser' :
				$buff = $model->testUser();
			break;
			case 'getPlugins' :
				$buff->plugins = $model->getPlugins();
				$buff->msg = $model->getError();
			break;
			case 'save' :
				$buff->id = $model->save();
				$buff->msg = $model->getError();
			break;
			case 'delete' :
				$buff->result = $model->delete();
				$buff->msg = $model->getError();
			break;
			default:
				$buff->id = $row->id;
				$buff->project_id = $row->project_id;
				$buff->name = $row->name;
				$buff->created = $row->created;
				$buff->com_link = JRoute :: _('index.php?option=com_fwgallery&view=image&id='.$row->id.':'.JFilterOutput :: stringURLSafe($row->name));
				$buff->link = JURI :: root(false).JFHelper::getFileFilename($row);
				$buff->th_link = JURI :: root(false).JFHelper::getFileFilename($row, 'th');
				$buff->color = JFHelper :: getGalleryColor($row->project_id);
				$buff->_user_name = $row->_user_name;
		}

		echo json_encode($buff);
		die();
    }
}
?>
