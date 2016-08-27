<?php
 
 /**
 * @package Spider Calendar lite
 * @author Web-Dorado
 * @copyright (C) 2011 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );

	 
$id=JRequest::getVar( "module_id");

$session =JFactory::getSession();

$select_menu_item=$session->get('select_menu_item'.$id);
if($select_menu_item=="")
$Itemid=JRequest::getVar( "Itemid","");
else
$Itemid=$select_menu_item;
$cat_id = JRequest::getVar('cat_id');
$cat_ids = JRequest::getVar('cat_ids');

$eventIDs=$this->eventIDs;



if($cat_ids=='')
$cat_ids .= $cat_id.',';
else
$cat_ids .= ','.$cat_id.',';

$cat_ids = substr($cat_ids, 0,-1);

function getelementcountinarray($array , $element)
{
  $t=0; 

  for($i=0; $i<count($array); $i++)
  {
    if($element==$array[$i])
	$t++;
  
  }
  
  
  return $t; 

}

function getelementindexinarray($array , $element)
{
 
		$t='';
		
	for($i=0; $i<count($array); $i++)
		{
			if($element==$array[$i])
			$t.=$i.',';
	
	    }
	
	return $t;


}
$cat_ids_array = explode(',',$cat_ids);
if($cat_id!='')
{

if(getelementcountinarray($cat_ids_array,$cat_id )%2==0)
{
$index_in_line = getelementindexinarray($cat_ids_array, $cat_id);
$index_array = explode(',' , $index_in_line);
array_pop ($index_array);
for($j=0; $j<count($index_array); $j++)
unset($cat_ids_array[$index_array[$j]]);
$cat_ids = implode(',',$cat_ids_array);
}
}
else
$cat_ids = substr($cat_ids, 0,-1);

//var_dump($cat_ids);

$bgid=$session->get('calendar_style'.$id);
$weekstart='mo';
		$titlescloud='1';


	 	  $bg='#005478';
		
		 $bgborder='#';
		
		 $color_arrow='#CED1D0';

		 $color_week_days='#2F647D';

		 $bg_color_selected='#005478';

		 $evented_color='#FBFFFE'; 
		 $evented_color_bg='#005478'; 
	
		 $sun_days='#989898';

		 $text_color_other_months='#939699';

		 $text_color_this_month_unevented='#989898';

		 $text_color_year='#';

		 $text_color_month='#FFFFFF';

		 $text_color_selected='#FFFFFF';

		 $border_day='#005478';
		 
		 $calendar_width='200';
		 
		  $calendar_bg='E1E1E1';
		 
		 $titlescloud_text_color='#000000';
		  
		  
		  $weekdays_bg_color='#D6D6D6';
		  
		  $weekday_su_bg_color='#B5B5B5';
		  
		  $cell_border_color='#D2D2D2';
		 
			$year_font_size='13px';
		  
		  $year_font_color='#ACACAC';
		  
		  $year_tabs_bg_color='rgb(236, 236, 236)';




		///////////////////////////////////////////////////
		 $calendar_id = JRequest::getVar('calendar');
		 
		
		 $border_day=$session->get( 'border_day'.$id);
		 
		 $groupid=$session->get( 'groupid'.$id);
		 
		 $cell_width=$calendar_width/7;
		
$db =JFactory::getDBO();

//$realtoday = getdate();
$uri = $_SERVER['HTTP_REFERER'];
$u =JURI::getInstance( $uri );
$date_REFERER=$u->getVar( "date".$id."",date("Y-m")); 
$year_REFERER=substr($date_REFERER,0,4); 
$month_REFERER=Month_name(substr( $date_REFERER,5,2)); 
$day_REFERER=substr( $date_REFERER,8,2); 



$date=JRequest::getVar( "date".$id."",date("Y-m")); 

$year=substr($date,0,4); 

$month=Month_name(substr( $date,5,2)); 

$day=substr( $date,8,2); 


echo '&nbsp;<style type="text/css">';
echo"
#calendar_".$id." table
{
border-collapse: initial;
border:0px;
}

#calendar_".$id." table td
 {
 padding: 0px;
vertical-align: none;
border-top:none;
line-height: none;
text-align: none;
 
 }
 
#calendar_".$id." .cell_body td
{
border:1px solid ".$cell_border_color.";
}
 
 
#calendar_".$id." p, ol, ul, dl, address
{
margin-bottom:0;

}


 #calendar_".$id." td,#calendar_".$id." tr,  #spiderCalendarTitlesList_".$id." td,  #spiderCalendarTitlesList_".$id." tr
 {
 border:none;
 }
 
 
 #calendar_".$id." .cala_arrow a:link, #calendar_".$id." .cala_arrow a:visited {
	color:".$color_arrow.";
	text-decoration:none !important;
	background:none;
	font-size:16px;
}
#calendar_".$id." .cala_arrow a:hover {
	color:".$color_arrow.";
	
	text-decoration:none;
	background:none;
}
#calendar_".$id." .cala_day a:link, #calendar_".$id." .cala_day a:visited {
	text-decoration:none !important;
	background:none;
	font-size:12px;
}
#calendar_".$id." .cala_day a:hover {
	font-size:14px;
	text-decoration:none !important;
	background:none;
}
#calendar_".$id." .calyear_table {
	border-spacing:0;
	width:100%;
}
#calendar_".$id." .calmonth_table {	
	border-spacing:0;
	width:100%;
}
#calendar_".$id." .calbg
{
	background-color:".$bg.";
	text-align:center;
}
#calendar_".$id." .caltext_color_other_months 
{
	color:".$text_color_other_months.";
}
#calendar_".$id." .caltext_color_this_month_unevented {
	color:".$text_color_this_month_unevented.";
}
#calendar_".$id." .calfont_year {
	font-family:".$session->get( 'calendar_font_year'.$id).";
	font-size:24px;
	font-weight:bold;
	color:".$text_color_year.";
}

#calendar_".$id." .calsun_days 
{
	color:".$sun_days.";
}


#calendar_".$id." .calborder_day
{
border: solid ".$border_day." 1px;
}

#spiderCalendarTitlesList_".$id."
{
display:none; width:331px; margin:0px; padding:0px; border:none; z-index:99;position:fixed;  color:#".$titlescloud_text_color.";
}

#spiderCalendarTitlesList_".$id." #sc1 
{
padding:0px; margin:0px; height:65px; background:url('".JURI::root(true)."/modules/mod_spidercalendar/images/TitleListBg1.png') no-repeat;
}
#spiderCalendarTitlesList_".$id." #sc2
{
padding:0px; margin:0px; background:url('".JURI::root(true)."/modules/mod_spidercalendar/images/TitleListBg2.png') repeat-y;

}
#spiderCalendarTitlesList_".$id." #sc3
{
padding:0px; margin:0px; height:32px; background:url('".JURI::root(true)."/modules/mod_spidercalendar/images/TitleListBg3.png') no-repeat;
}
#spiderCalendarTitlesList_".$id." p
{
margin:20px;
margin-top:0px;
text-align:left;
}
.categories p:last-child:first-letter
{
	color:#fff;
}

.categories p:last-child
{
	position:relative;
	left:-9px;
}
.categories p
{
	display:inline-block;
	cursor:pointer;
}


";

echo '</style>';








?>

<table cellpadding="0" cellspacing="0"  style="border-spacing:0; width:<?php echo $calendar_width; ?> px; height:190px; border:<?php echo $session->get( 'bg_border_color'.$id); ?> solid 0px; margin:0; padding:0;background-color:#<?php echo $calendar_bg; ?>">

    <tr>

        <td width="100%" style=" padding:0; margin:0">

            <form action="" method="get" style="background:none; margin:0; padding:0;">

              <table cellpadding="0" cellspacing="0" border="0" style="border-spacing:0; font-size:12px; margin:0; padding:0;" width="<?php echo $calendar_width; ?>" height="190">

                

                <tr  height="28px" style="width:<?php echo $calendar_width; ?>px">

                  <td class="calbg" colspan="7" style="background-image:url('components/com_spidercalendar/views/bigcalendar/images/Stver.png');margin:0; padding:0;background-repeat: no-repeat;background-size: 100% 100%;" >

                        <?php //MONTH TABLE ?>

                        <table cellpadding="0" cellspacing="0" border="0" align="center" class="calmonth_table"  style="width:100%; margin:0; padding:0">

                            <tr>

                                <td style="text-align:left; margin:0; padding:0; line-height:16px" class="cala_arrow" width="20%"><a  
                                href="javascript:showcalendar( 'calendar_<?php echo $id ?>','<?php  

                        if(Month_num($month)==1)
                        echo JRoute::_('index.php?option=com_spidercalendar&view=AJAXcalendar&calendar='.$calendar_id.'&module_id='.$id .'&cat_id=&cat_ids='.$cat_ids ).'&format=row&Itemid='.JRequest::getVar( "Itemid","").'&date'.$id.'='.($year-1).'-12';
	
                        else echo JRoute::_('index.php?option=com_spidercalendar&view=AJAXcalendar&calendar='.$calendar_id.'&module_id='.$id.'&cat_id=&cat_ids='.$cat_ids).'&format=row&Itemid='.JRequest::getVar( "Itemid","").'&date'.$id.'='.$year.'-'.add_0((Month_num($month)-1));

                ?>')">&#9668;</a></td>

                                <td width="60%" style="text-align:center; margin:0; padding:0" >

                                    <input type="hidden" name="month" readonly="" value="<?php echo $month?>"/>

       <span  style="font-size:<?php echo $year_font_size ?>px;font-family:<?php echo $session->get( 'calendar_font_month'.$id);?>; color:<?php echo $text_color_month;?>;"><?php echo JText::_($month)?></span></td>

                                <td style="text-align:right; margin:0; padding:0; line-height:16px"  class="cala_arrow" width="20%"><a href="javascript:showcalendar( 'calendar_<?php echo $id ?>','<?php  

                        if(Month_num($month)==12)
                        echo JRoute::_('index.php?option=com_spidercalendar&view=AJAXcalendar&calendar='.$calendar_id.'&module_id='.$id.'&cat_id=&cat_ids='.$cat_ids).'&format=row&Itemid='.JRequest::getVar( "Itemid","").'&date'.$id.'='.($year+1).'-01';
	
                        else echo JRoute::_('index.php?option=com_spidercalendar&view=AJAXcalendar&calendar='.$calendar_id.'&module_id='.$id.'&cat_id=&cat_ids='.$cat_ids).'&format=row&Itemid='.JRequest::getVar( "Itemid","").'&date'.$id.'='.$year.'-'.add_0((Month_num($month)+1));

                ?>')">&#9658;</a></td>

                            </tr>

                        </table>

                    </td>

                </tr>

                 <tr class="cell_body" align="center"  height="10%" style="background-color:<?php echo $weekdays_bg_color ?>;width:<?php echo $calendar_width; ?>px">

                   <?php if($weekstart=="su"){?>			 
					 
 <td style="background-color:<?php echo $weekday_su_bg_color ?>;width:<?php echo $cell_width; ?>px; font-family:<?php echo $session->get( 'calendar_font_weekday'.$id);?>;	color:<?php echo $color_week_days;?>; margin:0; padding:0">

                    	 <div class="calbottom_border" style="text-align:center; width:<?php echo $cell_width; ?>px; margin:0; padding:0;"><b> <?php echo JText::_( 'Su' ); ?> </b></div></td>
						 <?php } ?>

                    <td style="width:<?php echo $cell_width; ?>px; font-family:<?php echo $session->get( 'calendar_font_weekday'.$id);?>;	color:<?php echo $color_week_days;?>; margin:0; padding:0">

                    	 <div class="calbottom_border" style="text-align:center; width:<?php echo $cell_width; ?>px; margin:0; padding:0;"><b> <?php echo JText::_( 'Mo' ); ?> </b></div></td>

                    <td style="width:<?php echo $cell_width; ?>px; font-family:<?php echo $session->get( 'calendar_font_weekday'.$id);?>;	color:<?php echo $color_week_days;?>; margin:0; padding:0">

                   	 <div class="calbottom_border" style="text-align:center; width:<?php echo $cell_width; ?>px; margin:0; padding:0;"><b> <?php echo JText::_( 'Tu' ); ?> </b></div></td>

                    <td style="width:<?php echo $cell_width; ?>px; font-family:<?php echo $session->get( 'calendar_font_weekday'.$id);?>;	color:<?php echo $color_week_days;?>; margin:0; padding:0">

                   	 <div class="calbottom_border" style="text-align:center; width:<?php echo $cell_width; ?>px; margin:0; padding:0;"><b> <?php echo JText::_( 'We' ); ?> </b></div></td>

                    <td style="width:<?php echo $cell_width; ?>px; font-family:<?php echo $session->get( 'calendar_font_weekday'.$id);?>;	color:<?php echo $color_week_days;?>; margin:0; padding:0">

                    	 <div class="calbottom_border" style="text-align:center; width:<?php echo $cell_width; ?>px; margin:0; padding:0;"><b> <?php echo JText::_( 'Th' ); ?> </b></div></td>

					<td style="width:<?php echo $cell_width; ?>px; font-family:<?php echo $session->get( 'calendar_font_weekday'.$id);?>;	color:<?php echo $color_week_days;?>; margin:0; padding:0">

                   	 <div class="calbottom_border" style="text-align:center; width:<?php echo $cell_width; ?>px; margin:0; padding:0;"><b> <?php echo JText::_( 'Fr' ); ?> </b></div></td>
					 
                    <td style="width:<?php echo $cell_width; ?>px; font-family:<?php echo $session->get( 'calendar_font_weekday'.$id);?>;	color:<?php echo $color_week_days;?>; margin:0; padding:0">

                   	 <div class="calbottom_border" style="text-align:center; width:<?php echo $cell_width; ?>px; margin:0; padding:0;"><b> <?php echo JText::_( 'Sa' ); ?> </b></div></td>
	<?php if($weekstart=="mo"){?>			 
					 
 <td style="background-color:<?php echo $weekday_su_bg_color ?>;width:<?php echo $cell_width; ?>px; font-family:<?php echo $session->get( 'calendar_font_weekday'.$id);?>;	color:<?php echo $color_week_days;?>; margin:0; padding:0">

                    	 <div class="calbottom_border" style="text-align:center; width:<?php echo $cell_width; ?>px; margin:0; padding:0;"><b> <?php echo JText::_( 'Su' ); ?> </b></div></td>
						 <?php } ?>
                </tr>

                    <?php

//$today=$realtoday;

function add_0($month_num)
{
if($month_num<10)
	return '0'.$month_num;
	return $month_num;
}

function Month_num($month_name)

{
	for( $month_num=1; $month_num<=12; $month_num++ )
	
	{  
	    if (date( "F", mktime(0, 0, 0, $month_num, 1, 0 ) ) == $month_name)
	    
	    {  
		return $month_num;  
		
	    } 
	     
	}
	
};

function Month_name($month_num)

{

    $timestamp = mktime(0, 0, 0, $month_num, 1, 2005);
 
    return date("F", $timestamp); 
    
};



function getcategorycolor($ev_day, $ev_month,$ev_year,$i,$eventIDs)
{
	$db =JFactory::getDBO();
	$calendar_id = JRequest::getVar('calendar');
	$cat_id = JRequest::getVar('cat_id');
	$cat_ids = JRequest::getVar('cat_ids');

	if(isset($eventIDs[$i]))
	{
$ev_ids=explode('<br>',$eventIDs[$i]);


	array_pop($ev_ids);
	
$ev_ids_inline=implode(',',$ev_ids)	;
	

	if($cat_ids=='')
		$cat_ids .= $cat_id.',';
	else
		$cat_ids .= ','.$cat_id.',';

		$cat_ids = substr($cat_ids, 0,-1);



$cat_ids_array = explode(',',$cat_ids);
if($cat_id!='')
{

if(getelementcountinarray($cat_ids_array,$cat_id )%2==0)
{
$index_in_line = getelementindexinarray($cat_ids_array, $cat_id);
$index_array = explode(',' , $index_in_line);
array_pop ($index_array);
for($j=0; $j<count($index_array); $j++)
unset($cat_ids_array[$index_array[$j]]);
$cat_ids = implode(',',$cat_ids_array);
}
}
else
$cat_ids = substr($cat_ids, 0,-1);


	if($cat_ids!='')
		$query = "SELECT DISTINCT sec.color FROM #__spidercalendar_event AS se JOIN  
		#__spidercalendar_event_category AS sec ON se.category=sec.id  WHERE  se.published='1' AND sec.published='1' AND se.calendar=".$calendar_id." AND se.id IN (".$ev_ids_inline.") ";
    else
		$query = "SELECT DISTINCT sec.color FROM #__spidercalendar_event AS se JOIN  
		#__spidercalendar_event_category AS sec ON se.category=sec.id WHERE  se.published='1' AND sec.published='1' AND se.calendar=".$calendar_id." AND se.id IN (".$ev_ids_inline.")  ";

		
   $db->setQuery( $query );
	$rows = $db->loadObjectList();

	return $rows;
	}
}



$wi=1;
$rows = $this->rows;
$month_first_weekday = date("N", mktime(0, 0, 0, Month_num($month), 1, $year));
if($weekstart=="su"){
$month_first_weekday++;
if($month_first_weekday==8)
$month_first_weekday=1;
}

$month_days = date("t", mktime(0, 0, 0, Month_num($month), 1, $year));

$last_month_days = date("t", mktime(0, 0, 0, Month_num($month)-1, 1, $year));

$weekday_i=$month_first_weekday;

$last_month_days=$last_month_days-$weekday_i+2;

$percent=1;

$sum=$month_days-8+$month_first_weekday;

if($sum % 7 <> 0)

$percent = $percent + 1;

$sum = $sum - ( $sum % 7 );

$percent = $percent + ( $sum / 7 );


$percent=107/$percent;

$array_days=$this->array_days;
$array_days1=$this->array_days1;
$title=$this->title;

$categories=$this->categories;


//var_dump($title);
//var_dump($array_days);

echo '<tr class="cell_body" height="'.$percent.'px" style="font-family:'.$session->get( 'calendar_font_day'.$id).';line-height:'.$percent.'px">';

for($i=1; $i<$weekday_i; $i++)

{

echo '<td class="caltext_color_other_months" style="text-align:center;">'.$last_month_days.'</td>';

$last_month_days=$last_month_days+1;

}


for($i=1; $i<=$month_days; $i++)

{
if($titlescloud==1 and isset($title[$i]))
$dayevent='onMouseOver="showTitlesList(event,\''.addslashes(htmlspecialchars($title[$i])).'\')" onMouseOut="hideTitlesList();"';
else
$dayevent='';

	if(($weekday_i%7==0 and $weekstart=="mo") or ($weekday_i%7==1 and $weekstart=="su"))

	{
		if($i==$day_REFERER and $month==$month_REFERER and $year==$year_REFERER )
	
		{ 
			echo  '<td bgcolor="'.$bg_color_selected.'"  class="cala_day" style="text-align:center;padding:0; margin:0;line-height:inherit;"><div class="calborder_day" style="text-align:center; width:'.$cell_width.'px; margin:0; padding:0;"><a style="background:none;color:'.$text_color_selected.'; text-decoration:underline;" href="'.JRoute::_('index.php?option=com_spidercalendar&view=spidercalendar&calendar_id='.$calendar_id.'&module_id='.$id.'&date'.$id.'='.$year.'-'.add_0(Month_num($month)).'-'.$i).'&Itemid='.$Itemid.'" '.$dayevent.'><b>'.$i .'</b></a></td></div>';
	
		}
	
		else
		
		if($i==date('j') and $month==date('F') and $year==date('Y'))
		{
	
			if( in_array ($i,$array_days))
			{
				if($i-10<0)
					$event_day = '0'.$i;
				else
					$event_day = (string)$i;
					
				if( in_array ($i,$array_days1))
				{
					echo  '<td class="cala_day" style="background-color:'.$evented_color_bg.';text-align:center;padding:0; margin:0;line-height:inherit; border: 2px solid '.$border_day.'"><a style="background:none;color:'.$evented_color.';text-align:center;" href="'.JRoute::_('index.php?option=com_spidercalendar&view=spidercalendar&calendar_id='.$calendar_id.'&module_id='.$id.'&date'.$id.'='.$year.'-'.add_0(Month_num($month)).'-'.$i.'&cat_ids='.$cat_ids).'&Itemid='.$Itemid.'" '.$dayevent.'><b>'.$i.'</b></a>';

					echo '<table style="width:100%; border:0;"><tr>';
					if(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs))
					foreach(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs) as $color)
					{
						echo '<td id="cat_width"  style="border:0; border-top:2px solid #'.$color->color.'; display:table-cell;"></td>';
					}
					echo '</tr></table>';	
					echo '</td>';
				}
				else
				{
					echo  '<td class="cala_day" style="background-color:'.$evented_color_bg.';text-align:center;padding:0; margin:0;line-height:inherit; border: 2px solid '.$border_day.'"><a href="javascript:do_nothing();" style="background:none;color:'.$evented_color.';text-align:center;"  '.$dayevent.'><b>'.$i.'</b></a>';
					echo '<table style="width:100%; border:0;"><tr>';
					if(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs))
					foreach(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs) as $color)
					{
						echo '<td id="cat_width"  style="border:0; border-top:2px solid '.$color->color.'; display:table-cell;"></td>';
					}
					echo '</tr></table>';						
					echo '</td>';
	            }
	
			}
			else	
				echo  '<td class="calsun_days" style="text-align:center;padding:0; margin:0;line-height:inherit; border: 2px solid '.$border_day.'"><b>'.$i.'</b></td>';
	
		}

		else
		{
	
			if( in_array ($i,$array_days))
			{
				if($i-10<0)
					$event_day = '0'.$i;
				else
					$event_day = (string)$i;
					
				if( in_array ($i,$array_days1))
				{
					echo  '<td class="cala_day" style="background-color:'.$evented_color_bg.';text-align:center;padding:0; margin:0;line-height:inherit;"><a style="background:none;color:'.$evented_color.';text-align:center;" href="'.JRoute::_('index.php?option=com_spidercalendar&view=spidercalendar&calendar_id='.$calendar_id.'&module_id='.$id.'&date'.$id.'='.$year.'-'.add_0(Month_num($month)).'-'.$i.'&cat_ids='.$cat_ids).'&Itemid='.$Itemid.'" '.$dayevent.'><b>'.$i.'</b></a>';

			
					echo '<table style="width:100%; border:0;"><tr>';
					if(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs))
					foreach(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs) as $color)
					{
						echo '<td id="cat_width"  style="border:0; border-top:2px solid #'.$color->color.'; display:table-cell;"></td>';
					}
					echo '</tr></table>';

					echo '</td>';
				}
				
				else
				{
					echo  '<td class="cala_day" style="background-color:'.$evented_color_bg.';text-align:center;padding:0; margin:0;line-height:inherit;"><a href="javascript:do_nothing();" style="background:none;color:'.$evented_color.';text-align:center;"  '.$dayevent.'><b>'.$i.'</b></a>';
					echo '<table style="width:100%; border:0;"><tr>';
					if(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs))
					foreach(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs) as $color)
					{
						echo '<td id="cat_width"  style="border:0; border-top:2px solid #'.$color->color.'; display:table-cell;"></td>';
					}
					echo '</tr></table>';
					echo '</td>';
			    }
			
			}
	
			else
	
			echo  '<td class="calsun_days" style="text-align:center;padding:0; margin:0;line-height:inherit;"><b>'.$i.'</b></td>';
	
		}

	}
/////////////////////////////////////////////////////////////////////////mec else
	else

		if($i==$day_REFERER and $month==$month_REFERER and $year==$year_REFERER )
	
		{ 
				if($i-10<0)
				$event_day = '0'.$i;
				else
				$event_day = (string)$i;
			echo  '<td bgcolor="'.$bg_color_selected.'" class="cala_day" style="text-align:center;padding:0; margin:0;line-height:inherit;"><div class="calborder_day" style="text-align:center; width:'.$cell_width.'px; margin:0; padding:0;"><a style="background:none;color:'.$text_color_selected.'; " href="'.JRoute::_('index.php?option=com_spidercalendar&view=spidercalendar&calendar_id='.$calendar_id.'&module_id='.$id.'&date'.$id.'='.$year.'-'.add_0(Month_num($month)).'-'.$i.'&cat_ids='.$cat_ids).'&Itemid='.$Itemid.'" '.$dayevent.'><b>'.$i.'</b></a>';
			echo '<table style="width:100%; border:0;"><tr>';
					if(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs))
					foreach(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs) as $color)
					{
						echo '<td id="cat_width"  style="border:0; border-top:2px solid #'.$color->color.'; display:table-cell;"></td>';
					}
					echo '</tr></table>';
			
			echo '</div></td>';
	
		}

		else
	
		{
			if($i==date('j') and $month==date('F') and $year==date('Y'))
			
		{
				if( in_array ($i,$array_days))
				{
					if($i-10<0)
						$event_day = '0'.$i;
					else
						$event_day = (string)$i;
						
					if( in_array ($i,$array_days1))
		             {
						echo  '<td class="cala_day" style="background-color:'.$evented_color_bg.';text-align:center;padding:0; margin:0;line-height:inherit; border: 2px solid '.$border_day.'"><a style="background:none;color:'.$evented_color.'; text-align:center;" href="'.JRoute::_('index.php?option=com_spidercalendar&view=spidercalendar&calendar_id='.$calendar_id.'&module_id='.$id.'&date'.$id.'='.$year.'-'.add_0(Month_num($month)).'-'.$i .'&cat_ids='.$cat_ids).'&Itemid='.$Itemid.'" '.$dayevent.'><b>'.$i.'</b></a>';

					echo '<table style="width:100%; border:0;"><tr>';
					if(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs))
					foreach(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs) as $color)
					{
						echo '<td id="cat_width"  style="border:0; border-top:2px solid #'.$color->color.'; display:table-cell;"></td>';
					}
					echo '</tr></table>';

						echo '</td>';
					 }	
					else
					{
						echo  '<td class="cala_day" style="background-color:'.$evented_color_bg.';text-align:center;padding:0; margin:0;line-height:inherit; border: 2px solid '.$border_day.'"><a href="javascript:do_nothing();" style="background:none;color:'.$evented_color.'; text-align:center;"  '.$dayevent.'><b>'.$i.'</b></a>';
					echo '<table style="width:100%; border:0;"><tr>';
					if(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs))
					foreach(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs) as $color)
					{
						echo '<td id="cat_width"  style="border:0; border-top:2px solid #'.$color->color.'; display:table-cell;"></td>';
					}
					echo '</tr></table>';
						echo '</td>';
			        }
				}
		
				else		
					echo  '<td style="text-align:center; color:'.$text_color_this_month_unevented.';padding:0; margin:0; line-height:inherit; border: 2px solid '.$border_day.'"><b>'.$i.'</b></td>';
		
		}
	
	else
	///////////ajsetg
			if( in_array ($i,$array_days))
			{
				if($i-10<0)
					$event_day = '0'.$i;
				else
					$event_day = (string)$i;
					
				if( in_array ($i,$array_days1))
				{
					echo  '<td class="cala_day" style="background-color:'.$evented_color_bg.';text-align:center;padding:0; margin:0;line-height:inherit;">
					<a style="background:none;color:'.$evented_color.'; text-align:center;" href="'.JRoute::_('index.php?option=com_spidercalendar&view=spidercalendar&calendar_id='.$calendar_id.'&module_id='.$id.'&date'.$id.'='.$year.'-'.add_0(Month_num($month)).'-'.$i .'&cat_ids='.$cat_ids ).'&Itemid='.$Itemid.'" '.$dayevent.'><b>'.$i.'</b></a>';
					echo '<table style="width:100%; border:0;"><tr>';
					if(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs))
					foreach(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs) as $color)
					{
						echo '<td id="cat_width"  style="border:0; border-top:2px solid #'.$color->color.'; display:table-cell;"></td>';
					}
					echo '</tr></table>';
					
					echo'</td>';	
				}
				else
				{
					echo  '<td class="cala_day" style="background-color:'.$evented_color_bg.';text-align:center;padding:0; margin:0;line-height:inherit;"><a href="javascript:do_nothing();" style="background:none;color:'.$evented_color.'; text-align:center;" href="#" '.$dayevent.'><b>'.$i.'</b></a>';
					echo '<table style="width:100%; border:0;"><tr>';
					if(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs))
					foreach(getcategorycolor($event_day, add_0(Month_num($month)),$year,$i,$eventIDs) as $color)
					{
						echo '<td id="cat_width"  style="border:0; border-top:2px solid #'.$color->color.'; display:table-cell;"></td>';
					}
					echo '</tr></table>';
					echo '</td>';
			    }
			}
	
			else
	
			echo  '<td style="text-align:center; color:'.$text_color_this_month_unevented.';padding:0; margin:0; line-height:inherit;"><b>'.$i.'</b></td>';
	
			

	}

	if($weekday_i%7==0 && $i<>$month_days)

	{

	echo '</tr><tr class="cell_body" height="'.$percent.'px" style="font-family:'.$session->get( 'calendar_font_day'.$id).';line-height:'.$percent.'px">';

	$weekday_i=0;

	}

	$weekday_i=$weekday_i+1;

}

$weekday_i;

$next_i=1;

if($weekday_i!=1)

for($i=$weekday_i; $i<=7; $i++)

{

echo '<td class="caltext_color_other_months" style="text-align:center;">'.$next_i.'</td>';

$next_i=$next_i+1;

}

echo '</tr>';
?>

<tr>
<td colspan="2" onclick="showcalendar( 'calendar_<?php echo $id ?>','<?php echo JRoute::_('index.php?option=com_spidercalendar&view=AJAXcalendar&calendar='.$calendar_id.'&module_id='.$id.'&cat_id=&cat_ids='.$cat_ids).'&format=row&Itemid='.JRequest::getVar( "Itemid","").'&date'.$id.'='.($year-1).'-'.add_0((Month_num($month))); ?>')" style="cursor:pointer;font-size:<?php echo $year_font_size ?>px;color:<?php echo $year_font_color ?>;text-align: center;background-color:<?php echo $year_tabs_bg_color ?>">
<?php echo ($year-1) ?>
</td>
<td colspan="3" style="font-size:<?php echo $year_font_size+2 ?>px;color:<?php echo $year_font_color ?>;text-align: center;border-right:1px solid <?php echo $cell_border_color ?>;border-left:1px solid <?php echo $cell_border_color ?>">
<?php echo $year ?>
</td>
<td colspan="2" onclick="showcalendar( 'calendar_<?php echo $id ?>','<?php echo JRoute::_('index.php?option=com_spidercalendar&view=AJAXcalendar&calendar='.$calendar_id.'&module_id='.$id.'&cat_id=&cat_ids='.$cat_ids).'&format=row&Itemid='.JRequest::getVar( "Itemid","").'&date'.$id.'='.($year+1).'-'.add_0((Month_num($month))); ?>')" style="cursor:pointer;font-size:<?php echo $year_font_size ?>px;text-align: center;background-color:<?php echo $year_tabs_bg_color ?>;color:<?php echo $year_font_color ?>">
<?php echo ($year+1) ?>
</td>
</tr>

</table>




                    <input type="text" value="1" name="day" style="display:none" />

            </form>

               

        </td>

    </tr>

</table>

<?php

//reindex cat_ids_array
$re_cat_ids_array = array_values($cat_ids_array);

for($i=0; $i<count($re_cat_ids_array); $i++)
{
	echo'
	<style>
	#category'.$id.'-'.$re_cat_ids_array[$i].'{
	text-decoration:underline;
	cursor:pointer;
	}

	</style>';

}

?>

		<?php 
		 	if($cat_ids=='')
				$cat_ids='';
			foreach($categories as $category)
			{

			?>
				<div class="categories"><p style="background-color:#<?php echo $category->color;?>">&nbsp;&nbsp;&nbsp;&nbsp;</p><p  id="category<?php echo $id ?>-<?php echo $category->id ?>" style="color:#<?php echo $category->color?>" onclick=" showcalendar( 'calendar_<?php echo $id ?>','<?php echo JRoute::_('index.php?option=com_spidercalendar&view=AJAXcalendar&calendar='.$calendar_id.'&module_id='.$id.'&cat_id='.$category->id.'&cat_ids='.$cat_ids ).'&format=row&Itemid='.JRequest::getVar( "Itemid","").'&date'.$id.'='.($year).'-'.add_0((Month_num($month))); ?>')" > <?php echo  $category->title ?></p></div>

			<?php
			}
			?>





<?php 
$db		=JFactory::getDBO();
$query = "SELECT * FROM #__spidercalendar_calendar where id=".$calendar_id."";
	$db->setQuery( $query );
	
	$calendar = $db->loadObjectList();


$user =JFactory::getUser();

$userGroups = $user->get('groups');



$access=explode(',',$calendar[0]->gid);
$userGroups=array_merge(array(),$userGroups);
if(!$userGroups)
$userGroups=array(1);
foreach($userGroups as $key=>$value)
{

if (in_array($userGroups[$key],$access) ){
echo '<a href="index.php?option=com_spidercalendar&view=add_event&calendar='.$calendar_id.'&module_id='.$id.'">'.JText::_('ADD_EVENT').'</a> 
<a style="float:right" href="index.php?option=com_spidercalendar&view=show_events&calendar='.$calendar_id.'&module_id='.$id.'">'.JText::_('MANAGE_EVENTS').'</a>';
break;
}
}




