<?php
 
 /**



defined( '_JEXEC' ) or die( 'Restricted access' );



jimport( 'joomla.application.component.view');




class spidercalendarViewspidercalendarbig extends JViewLegacy
{

    function display($tpl = null)
		{

			$model = $this->getModel();

			$result = $model->showevent();
			$this->assignRef( 'row',	$result[0] );
			$this->assignRef( 'option',	$result[1] );
		
			
			
		

			parent::display($tpl);

		}

}

?>