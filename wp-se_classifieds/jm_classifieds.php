<?php
/*
Plugin Name: Social Engine Public Classifieds 
Plugin URI: http://2cq.it/
Description: This plugin/widget retrieves the Last X SE Public Classifieds and display them in your Wordpress Sidebar. To show your SE classifieds in the other pages of your wp, simply put the code <code>&lt;?php joomood_classifieds(); ?&gt;</code> where you want in your template.
Author: JooMood
Version: 1.0
Author URI: http://2cq.it/

	Copyright 2009, JooMOod
	-----------------------

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
	
*/

function joomood_classifieds_install() {

	$newoptions = get_option('joomood_classifieds_options');
	
    $newoptions['title']					='JooMood SE Classifieds';
    $newoptions['numOfGroup']				='6';
    $newoptions['how_many_groups']			='1';
    $newoptions['data_type']				='2';
    $newoptions['image_border']				='0';
    $newoptions['image_bordercolor']		='#333333';
    $newoptions['go_profile_text']			='See the classified';
    $newoptions['show_owner']				='1';
    $newoptions['empty_image_url']			='images/nophoto.gif';
    $newoptions['pic_dim_width']			='50';
    $newoptions['pic_dim_height']			='50';
    $newoptions['nametype']					='2';
	$newoptions['mainbox_border_style']		='0';
	$newoptions['mainbox_border_color']		='#333333';
	$newoptions['mainbox_border_dim']		='1';
	$newoptions['mainbox_bg_color']			='#ededed';
	$newoptions['box_border_style']			='0';
	$newoptions['box_border_color']			='#333333';
	$newoptions['box_border_dim']			='1';
	$newoptions['box_bg_color']				='#f7f7f7';
	$newoptions['outer_cellspacing']		='4';
	$newoptions['outer_cellpadding']		='2';
	$newoptions['inner_cellspacing']		='4';
	$newoptions['inner_cellpadding']		='2';
	$newoptions['cut_off']					='100';
	$newoptions['show_stat']				='yes';
	$newoptions['hide_desc']				='no';
	$newoptions['split_stat']				='no';

	add_option('joomood_classifieds_options', $newoptions);

}


// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

// add the admin page
function joomood_classifieds_add_pages() {
	add_options_page('SE Classifieds', 'SE Classifieds', 8, __FILE__, 'joomood_classifieds_options');
}

// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


function joomood_classifieds() {

  $newoptions = get_option("joomood_classifieds_options");

  	echo $before_widget;
    echo $before_title;
    echo "<h3>";

    echo $newoptions['title'];
    
    $title		 				= $newoptions['title'];
    $numOfGroup 				= $newoptions['numOfGroup'];
    $how_many_groups 			= $newoptions['how_many_groups'];
    $data_type 					= $newoptions['data_type'];
    $image_border 				= $newoptions['image_border'];
    $image_bordercolor 			= $newoptions['image_bordercolor'];
    $go_profile_text 			= $newoptions['go_profile_text'];
    $show_owner		 			= $newoptions['show_owner'];
    $empty_image_url 			= $newoptions['empty_image_url'];
    $pic_dim_width 				= $newoptions['pic_dim_width'];
    $pic_dim_height 			= $newoptions['pic_dim_height'];
    $nametype 					= $newoptions['nametype'];
	$mainbox_border_style		= $newoptions['mainbox_border_style'];
	$mainbox_border_color		= $newoptions['mainbox_border_color'];
	$mainbox_border_dim			= $newoptions['mainbox_border_dim'];
	$mainbox_bg_color			= $newoptions['mainbox_bg_color'];
	$box_border_style			= $newoptions['box_border_style'];
	$box_border_color			= $newoptions['box_border_color'];
	$box_border_dim				= $newoptions['box_border_dim'];
	$box_bg_color				= $newoptions['box_bg_color'];
	$outer_cellspacing			= $newoptions['outer_cellspacing'];
	$outer_cellpadding			= $newoptions['outer_cellpadding'];
	$inner_cellspacing			= $newoptions['inner_cellspacing'];
	$inner_cellpadding			= $newoptions['inner_cellpadding'];
	$cut_off					= $newoptions['cut_off'];
	$show_stat					= $newoptions['show_stat'];
	$hide_desc					= $newoptions['hide_desc'];
	$split_stat					= $newoptions['split_stat'];
	    
    
    echo $after_title;
    echo"</h3><br />";

	
	// Load main file
	
    include(ABSPATH.'wp-content/plugins/wp-se_classifieds/main/se_classifieds.php');

    echo $after_widget;
    echo "<br /><br />";

} // End of se_classifieds function



// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


	function joomood_classifieds_options() {

	$options = $newoptions = get_option('joomood_classifieds_options');

	if ( $_POST["myclassifieds_submit"] ) {

    $newoptions['title'] =htmlspecialchars($_POST['title']);
    $newoptions['numOfGroup'] = $_POST['numOfGroup'];
    $newoptions['how_many_groups'] = $_POST['how_many_groups'];
    $newoptions['data_type'] = $_POST['data_type'];
    $newoptions['image_border'] = $_POST['image_border'];
    $newoptions['image_bordercolor'] = $_POST['image_bordercolor'];
    $newoptions['go_profile_text'] = htmlspecialchars($_POST['go_profile_text']);
    $newoptions['show_owner'] = $_POST['show_owner'];
    $newoptions['empty_image_url'] = $_POST['empty_image_url'];
    $newoptions['pic_dim_width'] = $_POST['pic_dim_width'];
    $newoptions['pic_dim_height'] = $_POST['pic_dim_height'];
    $newoptions['nametype'] = $_POST['nametype'];
	$newoptions['mainbox_border_style'] = $_POST['mainbox_border_style'];
	$newoptions['mainbox_border_color'] = $_POST['mainbox_border_color'];
	$newoptions['mainbox_border_dim'] = $_POST['mainbox_border_dim'];
	$newoptions['mainbox_bg_color'] = $_POST['mainbox_bg_color'];
	$newoptions['box_border_style'] = $_POST['box_border_style'];
	$newoptions['box_border_color'] = $_POST['box_border_color'];
	$newoptions['box_border_dim'] = $_POST['box_border_dim'];
	$newoptions['box_bg_color'] = $_POST['box_bg_color'];
	$newoptions['outer_cellspacing'] = $_POST['outer_cellspacing'];
	$newoptions['outer_cellpadding'] = $_POST['outer_cellpadding'];
	$newoptions['inner_cellspacing'] = $_POST['inner_cellspacing'];
	$newoptions['inner_cellpadding'] = $_POST['inner_cellpadding'];
	$newoptions['cut_off'] = $_POST['cut_off'];
	$newoptions['show_stat'] = $_POST['show_stat'];
	$newoptions['split_stat'] = $_POST['split_stat'];
	$newoptions['hide_desc'] = $_POST['hide_desc'];


	}
	
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('joomood_classifieds_options', $options);
	}


	echo '<form method="post">';
	echo "<div class=\"wrap\"><h2>JooMood Social Engine Classifieds - Display Options</h2>";
	echo '<table class="form-table">';

	echo '<tr valign="top">';
	echo '<th scope="row">Title of the block</th><td><input name="title" type="text" value="'.$options['title'].'" /></td></tr>';

	echo '<tr valign="top">';
	echo '<th scope="row">How many Classifieds you want to display?</th><td><input name="numOfGroup" type="text" value="'.$options['numOfGroup'].'" /></td></tr>';

	echo '<tr valign="top">';
	echo '<th scope="row">How many Classifieds in every line?</th><td><input name="how_many_groups" type="text" value="'.$options['how_many_groups'].'" /></td></tr>';

	echo '<tr valign="top">';
	echo '<th scope="row">Type of Date</th><td><select name="data_type" id="data_type">
      <option ';
      if($options['data_type'] == "1"){ echo ' selected '; } echo 'value="1">Short Date</option>
      <option ';
      if($options['data_type'] == "2"){ echo ' selected '; } echo 'value="2">Full Date</option>
	  </select>
	</td>
	</tr>

	<tr valign="top">
	<th scope="row">Image Width</th><td><input name="pic_dim_width" type="text" value="'.$options['pic_dim_width'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Image Height</th><td><input name="pic_dim_height" type="text" value="'.$options['pic_dim_height'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Image Border (in pixel)</th><td><input name="image_border" type="text" value="'.$options['image_border'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Image Border Color</th><td><input name="image_bordercolor" type="text" value="'.$options['image_bordercolor'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Classified Link Title</th><td><input name="go_profile_text" type="text" value="'.$options['go_profile_text'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">SE Empty Image</th><td><input name="empty_image_url" type="text" value="'.$options['empty_image_url'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Type of Name</th><td>
    <select name="nametype" id="nametype">
      <option ';
      if($options['nametype'] == "1"){ echo ' selected '; } echo 'value="1">Username</option>
      <option ';
      if($options['nametype'] == "2"){ echo ' selected '; } echo 'value="2">Full Name</option>
    </select>
	</td>
	</tr>

	<tr valign="top">
	<th scope="row">Mainbox Border Style</th><td>
    <select name="mainbox_border_style" id="mainbox_border_style">
      <option ';
      if($options['mainbox_border_style'] == "0"){ echo ' selected '; } echo 'value="0">No Border</option>
      <option ';
      if($options['mainbox_border_style'] == "1"){ echo ' selected '; } echo 'value="1">Dotted Border</option>
      <option ';
      if($options['mainbox_border_style'] == "2"){ echo ' selected '; } echo 'value="2">Solid Border</option>
    </select>
	</td>
	</tr>

	<tr valign="top">
	<th scope="row">Mainbox Border Color</th><td><input name="mainbox_border_color" type="text" value="'.$options['mainbox_border_color'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Mainbox Border Thickness</th><td><input name="mainbox_border_dim" type="text" value="'.$options['mainbox_border_dim'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Mainbox Background Color</th><td><input name="mainbox_bg_color" type="text" value="'.$options['mainbox_bg_color'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Inner box Border Style</th><td>
    <select name="box_border_style" id="box_border_style">
      <option ';
      if($options['box_border_style'] == "0"){ echo ' selected '; } echo 'value="0">No Border</option>
      <option ';
      if($options['box_border_style'] == "1"){ echo ' selected '; } echo 'value="1">Dotted Border</option>
      <option ';
      if($options['box_border_style'] == "2"){ echo ' selected '; } echo 'value="2">Solid Border</option>
    </select>
	</td>
	</tr>

	<tr valign="top">
	<th scope="row">Inner box Border Color</th><td><input name="box_border_color" type="text" value="'.$options['box_border_color'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Inner box Border Thickness</th><td><input name="box_border_dim" type="text" value="'.$options['box_border_dim'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Inner box Background Color</th><td><input name="box_bg_color" type="text" value="'.$options['box_bg_color'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Mainbox Cellspacing</th><td><input name="outer_cellspacing" type="text" value="'.$options['outer_cellspacing'].'" /></td>
	</tr>
	
	<tr valign="top">
	<th scope="row">Mainbox Cellpadding</th><td><input name="outer_cellpadding" type="text" value="'.$options['outer_cellpadding'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Inner box Cellspacing</th><td><input name="inner_cellspacing" type="text" value="'.$options['inner_cellspacing'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Inner Cellpadding</th><td><input name="inner_cellpadding" type="text" value="'.$options['inner_cellpadding'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Cut Description after X Chars</th><td><input name="cut_off" type="text" value="'.$options['cut_off'].'" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Show Stats</th>
	<td>
    <select name="show_stat" id="show_stat">
      <option ';
      if($options['show_stat'] == "yes"){ echo ' selected '; } echo 'value="yes">Yes</option>
      <option ';
      if($options['show_stat'] == "no"){ echo ' selected '; } echo 'value="no">No</option>
    </select>
	</td>
	</tr>

	<tr valign="top">
	<th scope="row">Split Stats in 2 Lines?</th><td>
    <select name="split_stat" id="split_stat">
      <option ';
      if($options['split_stat'] == "yes"){ echo ' selected '; } echo 'value="yes">Yes</option>
      <option ';
      if($options['split_stat'] == "no"){ echo ' selected '; } echo 'value="no">No</option>
    </select>
	</td>
	</tr>

	<tr valign="top">
	<th scope="row">Hide the Description?</th><td>
    <select name="hide_desc" id="hide_desc">
      <option ';
      if($options['hide_desc'] == "yes"){ echo ' selected '; } echo 'value="yes">Yes</option>
      <option ';
      if($options['hide_desc'] == "no"){ echo ' selected '; } echo 'value="no">No</option>
    </select>
	</td>
	</tr>

	<tr valign="top">
	<th scope="row">Show a link to the classified owner?</th><td>
    <select name="show_owner" id="show_owner">
      <option ';
      if($options['show_owner'] == "1"){ echo ' selected '; } echo 'value="1">Yes</option>
      <option ';
      if($options['show_owner'] == "0"){ echo ' selected '; } echo 'value="0">No</option>
    </select>
	</td>
	</tr>

	<input type="hidden" name="myclassifieds_submit" value="true">

	</table>

	<p class="submit"><input type="submit" value="Update Options &raquo;"></input></p>

	</div>

	</form>';


	} // End of se_groups_options function


// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


function widget_SeClassified($args) {
  extract($args);

  $options = get_option("widget_SeClassified");
  if (!is_array( $options ))
        {
                $options = array(
      'title' => 'JooMood SE Classifieds',
      'numOfGroup' => '3',
      'how_many_groups'=>'1',
      'data_type'=>'1',
      'image_border'=>'0',
      'image_bordercolor'=>'#333333',
      'go_profile_text'=>'See the classified',
      'show_owner'=>'1',
      'empty_image_url'=>'images/nophoto.gif',
      'pic_dim_width'=>'30',
      'pic_dim_height'=>'30',
      'nametype'=>'2',
      'mainbox_width'=>'100',
      'mainbox_border_style'=>'0',
      'mainbox_border_color'=>'#333333',
      'mainbox_border_dim'=>'1',
      'mainbox_bg_color'=>'#ededed',
      'box_border_style'=>'0',
      'box_border_color'=>'#333333',
      'box_border_dim'=>'1',
      'box_bg_color'=>'#f7f7f7',
      'outer_cellspacing'=>'4',
      'outer_cellpadding'=>'2',
      'inner_cellspacing'=>'4',
      'inner_cellpadding'=>'2',
      'cut_off'=>'100',
      'show_stat'=>'yes',
      'split_stat'=>'no',
      'hide_desc'=>'no'
      );
  }      

  	echo $before_widget;
    echo $before_title;

    echo $options['title'];
    
    $title		 				= $options['title'];
    $numOfGroup 				= $options['numOfGroup'];
    $how_many_groups 			= $options['how_many_groups'];
    $data_type 					= $options['data_type'];
    $image_border 				= $options['image_border'];
    $image_bordercolor 			= $options['image_bordercolor'];
    $go_profile_text 			= $options['go_profile_text'];
    $show_owner		 			= $options['show_owner'];
    $empty_image_url 			= $options['empty_image_url'];
    $pic_dim_width 				= $options['pic_dim_width'];
    $pic_dim_height 			= $options['pic_dim_height'];
    $nametype 					= $options['nametype'];
	$mainbox_width				= $options['mainbox_width'];
	$mainbox_border_style		= $options['mainbox_border_style'];
	$mainbox_border_color		= $options['mainbox_border_color'];
	$mainbox_border_dim			= $options['mainbox_border_dim'];
	$mainbox_bg_color			= $options['mainbox_bg_color'];
	$box_border_style			= $options['box_border_style'];
	$box_border_color			= $options['box_border_color'];
	$box_border_dim				= $options['box_border_dim'];
	$box_bg_color				= $options['box_bg_color'];
	$outer_cellspacing			= $options['outer_cellspacing'];
	$outer_cellpadding			= $options['outer_cellpadding'];
	$inner_cellspacing			= $options['inner_cellspacing'];
	$inner_cellpadding			= $options['inner_cellpadding'];
	$cut_off					= $options['cut_off'];
	$show_stat					= $options['show_stat'];
	$hide_desc					= $options['hide_desc'];
	$split_stat					= $options['split_stat'];
	    
    
    echo $after_title;

	
	// Load main file
	
    include(ABSPATH.'wp-content/plugins/wp-se_classifieds/main/se_classifieds.php');

    echo $after_widget;

} // End of widget_SeClassified function


// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


function SeClassified_control()
{
  $options = get_option("widget_SeClassified");
  if (!is_array( $options ))
        {
                $options = array(
      'title' => 'JooMood SE Classifieds',
      'numOfGroup' => '3',
      'how_many_groups'=>'1',
      'data_type'=>'1',
      'image_border'=>'0',
      'image_bordercolor'=>'#333333',
      'go_profile_text'=>'See the classified',
      'show_owner'=>'1',
      'empty_image_url'=>'images/nophoto.gif',
      'pic_dim_width'=>'30',
      'pic_dim_height'=>'30',
      'nametype'=>'2',
      'mainbox_width'=>'100',
      'mainbox_border_style'=>'0',
      'mainbox_border_color'=>'#333333',
      'mainbox_border_dim'=>'1',
      'mainbox_bg_color'=>'#ededed',
      'box_border_style'=>'0',
      'box_border_color'=>'#333333',
      'box_border_dim'=>'1',
      'box_bg_color'=>'#f7f7f7',
      'outer_cellspacing'=>'4',
      'outer_cellpadding'=>'2',
      'inner_cellspacing'=>'4',
      'inner_cellpadding'=>'2',
      'cut_off'=>'100',
      'show_stat'=>'yes',
      'split_stat'=>'no',
      'hide_desc'=>'no'
      );
  }    

  if ($_POST['SeClassified-Submit'])
  {
    	
    $options['numOfGroup'] = $_POST['SeClassified-numOfGroup'];
    if($options['numOfGroup']=="") {
    $options['numOfGroup']="3";
    }

    $options['title'] = htmlspecialchars($_POST['SeClassified-WidgetTitle']);
    if($options['title']=="") {
    $options['title']="Last ".$options['numOfGroup']." SE Public Classifieds";
    }
 
    $options['how_many_groups'] = $_POST['SeClassified-how_many_groups'];
    if($options['how_many_groups']=="") {
    $options['how_many_groups']="1";
    }
 
    $options['data_type'] = $_POST['SeClassified-data_type'];
    if ($options['data_type']=="") {
    $options['data_type']="2";
    }
 
    $options['image_border'] = $_POST['SeClassified-image_border'];
    if($options['image_border']=="") {
    $options['image_border']="0";
    }
 
    $options['image_bordercolor'] = $_POST['SeClassified-image_bordercolor'];
     if($options['image_bordercolor']=="") {
    $options['image_bordercolor']="#333333";
    }

    $options['go_profile_text'] = htmlspecialchars($_POST['SeClassified-go_profile_text']);
    if($options['go_profile_text']=="") {
    $options['go_profile_text']="";
    }
 
    $options['show_owner'] = $_POST['SeClassified-show_owner'];
    if($options['show_owner']=="") {
    $options['show_owner']="1";
    }
 
    $options['empty_image_url'] = $_POST['SeClassified-empty_image_url'];
    if($options['empty_image_url']=="") {
    $options['empty_image_url']="images/nophoto.gif";
    }
    
    $options['pic_dim_width'] = $_POST['SeClassified-pic_dim_width'];
    if($options['pic_dim_width']=="") {
    $options['pic_dim_width']="30";
    }

    $options['pic_dim_height'] = $_POST['SeClassified-pic_dim_height'];
    if($options['pic_dim_height']=="") {
    $options['pic_dim_height']="30";
    }

    $options['nametype'] = $_POST['SeClassified-nametype'];
    if ($options['nametype']=="") {
    $options['nametype']="2";
    }

	$options['mainbox_width'] = $_POST['SeClassified-mainbox_width'];
    if ($options['mainbox_width']=="") {
    $options['mainbox_width']="100";
    }

	$options['mainbox_border_style'] = $_POST['SeClassified-mainbox_border_style'];
    if ($options['mainbox_border_style']=="") {
    $options['mainbox_border_style']="0";
    }

	$options['mainbox_border_color'] = $_POST['SeClassified-mainbox_border_color'];
    if ($options['mainbox_border_color']=="") {
    $options['mainbox_border_color']="#333333";
    }

	$options['mainbox_border_dim'] = $_POST['SeClassified-mainbox_border_dim'];
    if ($options['mainbox_border_dim']=="") {
    $options['mainbox_border_dim']="1";
    }
    
	$options['mainbox_bg_color'] = $_POST['SeClassified-mainbox_bg_color'];
    if ($options['mainbox_bgcolor']=="") {
    $options['mainbox_bgcolor']="#ededed";
    }

	$options['box_border_style'] = $_POST['SeClassified-box_border_style'];
    if ($options['box_border_style']=="") {
    $options['box_border_style']="0";
    }

	$options['box_border_color'] = $_POST['SeClassified-box_border_color'];
    if ($options['box_border_color']=="") {
    $options['box_border_color']="#333333";
    }

	$options['box_border_dim'] = $_POST['SeClassified-box_border_dim'];
    if ($options['box_border_dim']=="") {
    $options['box_border_dim']="1";
    }
    
	$options['box_bg_color'] = $_POST['SeClassified-box_bg_color'];
    if ($options['box_bg_color']=="") {
    $options['box_bg_color']="#f7f7f7";
    }

	$options['outer_cellspacing'] = $_POST['SeClassified-outer_cellspacing'];
    if ($options['outer_cellspacing']=="") {
    $options['outer_cellspacing']="4";
    }

	$options['outer_cellpadding'] = $_POST['SeClassified-outer_cellpadding'];
    if ($options['outer_cellpadding']=="") {
    $options['outer_cellpadding']="2";
    }

	$options['inner_cellspacing'] = $_POST['SeClassified-inner_cellspacing'];
    if ($options['inner_cellspacing']=="") {
    $options['inner_cellspacing']="4";
    }

	$options['inner_cellpadding'] = $_POST['SeClassified-inner_cellpadding'];
    if ($options['inner_cellpadding']=="") {
    $options['inner_cellpadding']="2";
    }

	$options['cut_off'] = $_POST['SeClassified-cut_off'];

	$options['show_stat'] = $_POST['SeClassified-show_stat'];
    if ($options['show_stat']=="") {
    $options['show_stat']="yes";
    }

	$options['split_stat'] = $_POST['SeClassified-split_stat'];
    if ($options['split_stat']=="") {
    $options['split_stat']="no";
    }

	$options['hide_desc'] = $_POST['SeClassified-hide_desc'];
    if ($options['hide_desc']=="") {
    $options['hide_desc']="no";
    }

    update_option("widget_SeClassified", $options);
  }

?>
    <p><label for="SeClassified-WidgetTitle">Widget Title: </label>
    <input class="widefat"  type="text" id="SeClassified-WidgetTitle" name="SeClassified-WidgetTitle" value="<?php echo $options['title'];?>" /></p>
    <p><label for="SeClassified-numOfGroup">Total Classifieds: </label>
    <input class="widefat"  type="text" id="SeClassified-numOfGroup" name="SeClassified-numOfGroup" value="<?php echo $options['numOfGroup'];?>" /></p>
    <p><label for="SeClassified-how_many_groups">Classifieds per Line: </label>
    <input class="widefat"  type="text" id="SeClassified-how_many_groups" name="SeClassified-how_many_groups" value="<?php echo $options['how_many_groups'];?>" /></p>
    <p><label for="SeClassified-data_type">Date Type: </label>
  	<select name="SeClassified-data_type" id="SeClassified-data_type">
    <option <?php if($options['data_type'] == "1"){ echo ' selected '; } ?>value="1">Short</option>
    <option <?php if($options['data_type'] == "2"){ echo ' selected '; } ?>value="2">Full</option>
      </select>  </p>
    <p><label for="SeClassified-image_border">Image Border: </label>
    <input class="widefat"  type="text" id="SeClassified-image_border" name="SeClassified-image_border" value="<?php echo $options['image_border'];?>" /></p>
    <p><label for="SeClassified-image_bordercolor">Image Border Color: </label>
    <input class="widefat"  type="text" id="SeClassified-image_bordercolor" name="SeClassified-image_bordercolor" value="<?php echo $options['image_bordercolor'];?>" /></p>
    <p><label for="SeClassified-go_profile_text">Classified Link Title: </label>
    <input class="widefat"  type="text" id="SeClassified-go_profile_text" name="SeClassified-go_profile_text" value="<?php echo $options['go_profile_text'];?>" /></p>
    <p><label for="SeClassified-empty_image_url">SE Empty Image: </label>
    <input class="widefat"  type="text" id="SeClassified-empty_image_url" name="SeClassified-empty_image_url" value="<?php echo $options['empty_image_url'];?>" /></p>
    <p><label for="SeClassified-pic_dim_width">Pic Width (in pixel): </label>
    <input class="widefat"  type="text" id="SeClassified-pic_dim_width" name="SeClassified-pic_dim_width" value="<?php echo $options['pic_dim_width'];?>" /></p>
    <p><label for="SeClassified-pic_dim_height">Pic Width (in pixel): </label>
    <input class="widefat"  type="text" id="SeClassified-pic_dim_height" name="SeClassified-pic_dim_height" value="<?php echo $options['pic_dim_height'];?>" /></p>
    <p><label for="SeClassified-nametype">Preferred Names: </label>
    <select name="SeClassified-nametype" id="SeClassified-nametype">
    <option <?php if($options['nametype'] == "1"){ echo ' selected '; } ?>value="1">Username</option>
    <option <?php if($options['nametype'] == "2"){ echo ' selected '; } ?>value="2">Full Name</option>
      </select>  </p>
    <p><label for="SeClassified-mainbox_width">Mainbox Width (in %): </label>
    <input class="widefat"  type="text" id="SeClassified-mainbox_width" name="SeClassified-mainbox_width" value="<?php echo $options['mainbox_width'];?>" /></p>
    <p><label for="SeClassified-mainbox_border_style">Mainbox Border Style: </label>
    <select name="SeClassified-mainbox_border_style" id="SeClassified-mainbox_border_style">
    <option <?php if($options['mainbox_border_style'] == "0"){ echo ' selected '; } ?>value="0">No Border</option>
    <option <?php if($options['mainbox_border_style'] == "1"){ echo ' selected '; } ?>value="1">Dotted Border</option>
    <option <?php if($options['mainbox_border_style'] == "2"){ echo ' selected '; } ?>value="2">Solid Border</option>
      </select>  </p>
    <p><label for="SeClassified-mainbox_border_color">Mainbox Border Color: </label>
    <input class="widefat"  type="text" id="SeClassified-mainbox_border_color" name="SeClassified-mainbox_border_color" value="<?php echo $options['mainbox_border_color'];?>" /></p>
    <p><label for="SeClassified-mainbox_border_dim">Mainbox Border Thickness (in px): </label>
    <input class="widefat"  type="text" id="SeClassified-mainbox_border_dim" name="SeClassified-mainbox_border_dim" value="<?php echo $options['mainbox_border_dim'];?>" /></p>
    <p><label for="SeClassified-mainbox_bg_color">Mainbox Background Color: </label>
    <input class="widefat"  type="text" id="SeClassified-mainbox_bg_color" name="SeClassified-mainbox_bg_color" value="<?php echo $options['mainbox_bg_color'];?>" /></p>
    <p><label for="SeClassified-box_border_style">Inner box Border Style: </label>
    <select name="SeClassified-box_border_style" id="SeClassified-box_border_style">
    <option <?php if($options['box_border_style'] == "0"){ echo ' selected '; } ?>value="0">No Border</option>
    <option <?php if($options['box_border_style'] == "1"){ echo ' selected '; } ?>value="1">Dotted Border</option>
    <option <?php if($options['box_border_style'] == "2"){ echo ' selected '; } ?>value="2">Solid Border</option>
      </select>  </p>
    <p><label for="SeClassified-box_border_color">Inner box Border Color: </label>
    <input class="widefat"  type="text" id="SeClassified-box_border_color" name="SeClassified-box_border_color" value="<?php echo $options['box_border_color'];?>" /></p>
    <p><label for="SeClassified-box_border_dim">Inner box Border Thickness (in px): </label>
    <input class="widefat"  type="text" id="SeClassified-box_border_dim" name="SeClassified-box_border_dim" value="<?php echo $options['box_border_dim'];?>" /></p>
    <p><label for="SeClassified-box_bg_color">Inner box Background Color: </label>
    <input class="widefat"  type="text" id="SeClassified-box_bg_color" name="SeClassified-box_bg_color" value="<?php echo $options['box_bg_color'];?>" /></p>
    <p><label for="SeClassified-outer_cellspacing">Mainbox Cellspacing: </label>
    <input class="widefat"  type="text" id="SeClassified-outer_cellspacing" name="SeClassified-outer_cellspacing" value="<?php echo $options['outer_cellspacing'];?>" /></p>
    <p><label for="SeClassified-outer_cellpadding">Mainbox Cellpadding: </label>
    <input class="widefat"  type="text" id="SeClassified-outer_cellpadding" name="SeClassified-outer_cellpadding" value="<?php echo $options['outer_cellpadding'];?>" /></p>
    <p><label for="SeClassified-inner_cellspacing">Inner box Cellspacing: </label>
    <input class="widefat"  type="text" id="SeClassified-inner_cellspacing" name="SeClassified-inner_cellspacing" value="<?php echo $options['inner_cellspacing'];?>" /></p>
    <p><label for="SeClassified-inner_cellpadding">Inner box Cellpadding: </label>
    <input class="widefat"  type="text" id="SeClassified-inner_cellpadding" name="SeClassified-inner_cellpadding" value="<?php echo $options['inner_cellpadding'];?>" /></p>

    <p><label for="SeClassified-cut_off">Cut the Description after X Chars (leave it blank for no-cut): </label>
    <input class="widefat"  type="text" id="SeClassified-cut_off" name="SeClassified-cut_off" value="<?php echo $options['cut_off'];?>" /></p>
    <p><label for="SeClassified-show_stat">Show the Stats? </label>
    <select name="SeClassified-show_stat" id="SeClassified-show_stat">
    <option <?php if($options['show_stat'] == "yes"){ echo ' selected '; } ?>value="yes">Yes</option>
    <option <?php if($options['show_stat'] == "no"){ echo ' selected '; } ?>value="no">No</option>
      </select>  </p>
    <p><label for="SeClassified-split_stat">Split the Stats in 2 lines? </label>
    <select name="SeClassified-split_stat" id="SeClassified-split_stat">
    <option <?php if($options['split_stat'] == "yes"){ echo ' selected '; } ?>value="yes">Yes</option>
    <option <?php if($options['split_stat'] == "no"){ echo ' selected '; } ?>value="no">No</option>
      </select>  </p>
    <p><label for="SeClassified-hide_desc">Hide the Description? </label>
    <select name="SeClassified-hide_desc" id="SeClassified-hide_desc">
    <option <?php if($options['hide_desc'] == "yes"){ echo ' selected '; } ?>value="yes">Yes</option>
    <option <?php if($options['hide_desc'] == "no"){ echo ' selected '; } ?>value="no">No</option>
      </select>  </p>
    
    <p><label for="SeClassified-show_owner">Show a link to the classified owner? </label>
    <select name="SeClassified-show_owner" id="SeClassified-show_owner">
    <option <?php if($options['show_owner'] == "1"){ echo ' selected '; } ?>value="1">Yes</option>
    <option <?php if($options['show_owner'] == "0"){ echo ' selected '; } ?>value="0">No</option>
      </select>  </p>

    <input type="hidden" id="SeClassified-Submit" name="SeClassified-Submit" value="1" />
<?php
}


//-----------------------------------------------------------------------------
//			ACTIONS
//-----------------------------------------------------------------------------


//uninstall all options
function SeClassified_uninstall () {
	delete_option('widget_SeClassified');
}

function joomood_classifieds_uninstall () {
	delete_option('joomood_classifieds_options');
}

function SeClassified_init()
{
  register_sidebar_widget(__('JooMood SE Classifieds'), 'widget_SeClassified');
  register_widget_control(   'JooMood SE Classifieds', 'SeClassified_control', 300, 200 );    
}

add_action("plugins_loaded", "SeClassified_init");
add_action('admin_menu', 'joomood_classifieds_add_pages');

register_activation_hook( __FILE__, 'joomood_classifieds_install' );
register_deactivation_hook( __FILE__, 'joomood_classifieds_uninstall' );


?>