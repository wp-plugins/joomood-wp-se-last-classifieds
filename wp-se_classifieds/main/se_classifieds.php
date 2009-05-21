<?php

//  Description: JooMood WP Plugins - Retrieve Last X SE Classifieds
//	Author: JooMood
//	Version: 1.0
//	Author URI: http://2cq.it/

//	Copyright 2009, JooMOod
//	-----------------------

//	This program is free software: you can redistribute it and/or modify
//	it under the terms of the GNU General Public License as published by
//	the Free Software Foundation, either version 3 of the License, or
//	(at your option) any later version.

//	This program is distributed in the hope that it will be useful,
//	but WITHOUT ANY WARRANTY; without even the implied warranty of
//	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//	GNU General Public License for more details.

//	You should have received a copy of the GNU General Public License
//	along with this program.  If not, see <http://www.gnu.org/licenses/>.


// ----------------------------------------------------------------------------------------------------------------------------------------------------------
//					JOOMOOD START PLAYING
// ----------------------------------------------------------------------------------------------------------------------------------------------------------

// SHOW LAST SE X PUBLIC CLASSIFIEDS

    include(ABSPATH.'wp-content/plugins/giggi_functions/giggi_database.php');
    require_once(ABSPATH.'wp-content/plugins/giggi_functions/giggi_functions.php');


// Check some data...

if($show_owner=="0" OR $show_owner=="1") {
$showownerz=$show_owner;
} else {
$showownerz="0";
}

		// Check for hidden description
		
		$hiddesc=strtolower($hide_desc);
		if($hiddesc=="yes") {
		$hide_desc="yes";
		} else {
		$hide_desc="no";
		}


        // Check the classified description cut-off point
        
        if (preg_match ("/^([0-9.,-]+)$/", $cut_off)) {
        $cut="1";
        } else {
        $cut="0";  // vuol dire che l'utente non ha inserito un numero!
        }


		// Check for Splitted Stats
		
		$split_stat=strtolower($split_stat);
		if($split_stat=="yes") {
		$split="1";
		} else {
		$split="0";
		}


		// Check if Stats are Showed
		
		$show_stat=strtolower($show_stat);
		if($show_stat=="yes") {
		$shows="1";
		} else {
		$shows="0";
		}


		// Check personal width & height...

        if (preg_match ("/^([0-9.,-]+)$/", $pic_dim_width)) {
        $my_w="1";
        } else {
        $my_w="0";  // vuol dire che l'utente non ha inserito un numero!
        }
        if (preg_match ("/^([0-9.,-]+)$/", $pic_dim_height)) {
        $my_h="1";
        } else {
        $my_h="0";  // vuol dire che l'utente non ha inserito un numero!
        }

        if($pic_dim_width=="0" OR $pic_dim_height=="0" OR $pic_dim_width=="" OR $pic_dim_height=="" OR $my_w=="0" OR $my_h=="0") {
        $pic_dimensions="0";
        } else {
        $pic_dimensions="1";
        }

        if($pic_dimensions =="1") {
		
		$mywidth=$pic_dim_width;
		$myheight=$pic_dim_height;
		
		} else {
		$mywidth="60";
		$myheight="60";
		
		}

		// Check Num of Classifieds...

		if($numOfGroup<0) {
		$numOfGroup=1;
		}

		if($how_many_groups>$numOfGroup) {
		$how_many_groups=$numOfGroup;
		}
		
// ---------------------------------------------------------

		$mainbox_width=$mainbox_width."%";


		// Check Main Box border style
		
		if ($mainbox_border_style=="0" OR $mainbox_border_style=="1" OR $mainbox_border_style=="2") {
		$mainbox_border_res="1";
		} else {
		$mainbox_border_res="0";
		}

		// Check Main Box border color
		
		if ($mainbox_border_color!=='') {
		$mainbox_bordercol_res="1";
		} else {
		$mainbox_bordercol_res="0";
		}

		
		// Substitute empty or wrong fields
		
		if ($mainbox_border_res=="0") {
		$mainboxbord="0px solid";
		} 
		
		if ($mainbox_border_style=="1") {
		$mainboxbord="{$mainbox_border_dim}px dotted";
		} 
		
		if ($mainbox_border_style=="2") {
		$mainboxbord="{$mainbox_border_dim}px solid";
		} 
		

		if ($mainbox_bordercol_res=="0") {
		$mainboxbordcol="#ffffff";
		} else {
		$mainboxbordcol=$mainbox_border_color;
		}
		
		$mainboxbgcol=$mainbox_bg_color;


// ---------------------------------------------------------

		
		
		// Check Inner Box border style
		
		if ($box_border_style=="0" OR $box_border_style=="1" OR $box_border_style=="2") {
		$box_border_res="1";
		} else {
		$box_border_res="0";
		}

		// Check box border color
		
		if ($box_border_color!=='') {
		$box_bordercol_res="1";
		} else {
		$box_bordercol_res="0";
		}

		
		// Substitute empty or wrong fields
		
		if ($box_border_res=="0") {
		$boxbord="0px solid";
		} 
		
		if ($box_border_style=="1") {
		$boxbord="{$box_border_dim}px dotted";
		} 
		
		if ($box_border_style=="2") {
		$boxbord="{$box_border_dim}px solid";
		} 
		

		if ($box_bordercol_res=="0") {
		$boxbordcol="#ffffff";
		} else {
		$boxbordcol=$box_border_color;
		}
		
		$boxbgcol=$box_bg_color;
		
		
		// Build Full Style Variables
		
		$mystyle="style=\"border:".$boxbord." ".$boxbordcol."; background-color: ".$boxbgcol.";\"";
		$mymainstyle="style=\"border:".$mainboxbord." ".$mainboxbordcol."; background-color: ".$mainboxbgcol.";\"";
		$titlestyle="padding: 0px 5px 5px 0px; border-bottom: 1px solid #CCCCCC; margin-bottom: 5px;";
		$bodystyle="margin-bottom: 5px;";
		$statstyle="font-size: 7pt; color: #777777; font-weight: normal;";



// ----------------------------------------------------------------------------------------------------------------------------------------------------------
//					LET'S START QUERY TO RETRIEVE OUR DATA
// ----------------------------------------------------------------------------------------------------------------------------------------------------------


$query  = "SELECT p.*, t.*, FROM_UNIXTIME((t.classified_date), '%d/%m/%y') as created,
FROM_UNIXTIME((t.classified_dateupdated), '%H:%i') as updated
FROM se_classifieds t LEFT JOIN se_classifiedcats p ON (p.classifiedcat_id=t.classified_id)
WHERE t.classified_privacy='63' OR t.classified_privacy='127'
ORDER by t.classified_date DESC limit ".$numOfGroup."";

$result = mysql_query($query);

$i=0;

while($row = mysql_fetch_array($result, MYSQL_ASSOC))

{
	
if($data_type=="1") {
$miovalore= giggitime($row['classified_date'], $num_times=1).' ago';
$miovalore1= giggitime($row['classified_dateupdated'], $num_times=1).' ago, at '.$row['updated'];
} else {
$miovalore= giggitime2($row['classified_date'], $num_times=1).' ago';
$miovalore1= giggitime2($row['classified_dateupdated'], $num_times=1).' ago, at '.$row['updated'];
}

// Choose a name or a username...

if ($nametypez=="2") {
$mynome=$row['user_displayname'];
} else {
$mynome=$row['user_username'];
}


// Cut a little bit the classified text...

$mydesc = $row['classified_body'];

// Format the classified desc

$mydesc = htmlspecialchars_decode($mydesc, ENT_QUOTES);

if($cut=="0" OR $cut_off=="0" OR $cut_off=="") {
$shortdesc=$mydesc;
} else {
$shortdesc = substr($mydesc,0,$cut_off)."...";
}

if ($hide_desc=="yes") {
$shortdesc="";
}

// Comment-Comments? View-Views?

if($row['classified_totalcomments']>1 && $row['classified_comments']=="63") {
$comment="<a href=\"{$socialdir}/classified.php?user_id={$row['classified_user_id']}&amp;classified_id=".$row['classified_id']."\" title=\"".$go_profile_text.": {$row['classified_title']}\"><b>{$row['classified_totalcomments']}</b> Comments</a>";
} else 
if($row['classified_totalcomments']==1 && $row['classified_comments']=="63") {
$comment="<a href=\"{$socialdir}/classified.php?user_id={$row['classified_user_id']}&amp;classified_id=".$row['classified_id']."\" title=\"".$go_profile_text.": {$row['classified_title']}\"><b>1</b> Comment</a>";
} else {
$comment="No Comment";
}
if($row['classified_views']>1) {
$view="{$row['classified_views']} Views";
} else 
if($row['classified_views']==1) {
$view="1 View";
} else {
$view="No View";
}

$mydir=$wpdir."/wp-content/plugins/wp-se_classifieds";

if ($row['classified_photo']!='') {

// Creates a thumbnail based on your personal dims (width/height), without stretching the original pic

$mypic="<img src=\"{$mydir}/image.php/{$row['classified_photo']}?width={$mywidth}&amp;height={$myheight}&amp;cropratio=1:1&amp;quality=100&amp;image={$socialdir}/uploads_classified/1000/{$row['classified_id']}/{$row['classified_photo']}\" style=\"border:".$image_border."px solid ".$image_bordercolor."\" alt=\"".$myn."\" />";
} else {
$mypic="<img src=\"{$mydir}/image.php/nophoto.gif?width={$mywidth}&amp;height={$myheight}&amp;cropratio=1:1&amp;quality=100&amp;image={$socialdir}/{$empty_image_url}\" style=\"border:".$image_border."px ".$image_bordercolor." solid\" alt=\"".$myn."\" />";
}


// Create a link to the group

$mylink="<a href=\"".$socialdir."/classified.php?user_id=".$row['classified_user_id']."&amp;classified_id=".$row['classified_id']."\" title=\"".$go_profile_text.": {$row['classified_title']}\">";



// Create a link to the group leader

if($showownerz=="1") {
$mylink1="<a href=\"".$socialdir."/profile.php?user_id=".$row['classified_user_id']."\">";
$my_own_string="<span style=\"{$statstyle}\">- ({$mylink1}Author Profile</a>)</span>";
} else {
$my_own_string="";
}



// Splitted or not-splitted Stats? This is the question...

if ($split=="1") {
$line1="<div style=\"{$statstyle}\">Created {$miovalore} - Updated {$miovalore1}<br />
{$view}, {$comment} {$my_own_string}</div>";
$mystats=$line1;
} else {
$line1="<div style=\"{$statstyle}\">Created {$miovalore} - Updated {$miovalore1} | {$view}, {$comment}</div>";
$mystats=$line1;
}

// Hide or Show the body stats

if($shows!=="1") {
$mystats="";
}


if($i<$how_many_groups) {

$rows .= "
<td align=\"left\" valign=\"top\">
<table width=\"100%\" cellspacing=\"{$inner_cellspacing}\" cellpadding=\"{$inner_cellpadding}\" ".$mystyle.">
<tr>
<td width=\"".$mywidth."\" align=\"left\" valign=\"top\" scope=\"row\">{$mylink}{$mypic}</a></td>
<td align=\"left\" valign=\"top\" scope=\"row\"><div style=\"{$titlestyle}\">{$mylink}{$row['classified_title']}</a> {$my_own_string}</div>
<div style=\"{$bodystyle}\">{$shortdesc}</div>
{$mystats}
</td>
</tr>
</table>
</td>
";

} else {

$rows .= "
</tr><tr><td align=\"left\" valign=\"top\">
<table width=\"100%\" cellspacing=\"{$inner_cellspacing}\" cellpadding=\"{$inner_cellpadding}\" ".$mystyle.">
<tr>
<td width=\"".$mywidth."\" align=\"left\" valign=\"top\" scope=\"row\">{$mylink}{$mypic}</a></td>
<td align=\"left\" valign=\"top\" scope=\"row\"><div style=\"{$titlestyle}\">{$mylink}{$row['classified_title']}</a> {$my_own_string}</div>
<div style=\"{$bodystyle}\">{$shortdesc}</div>
{$mystats}
</td>
</tr>
</table>
</td>
";
$i=0;
}

$i++;

}

$content .="<table width=\"{$mainbox_width}\" cellspacing=\"{$outer_cellspacing}\" cellpadding=\"{$outer_cellpadding}\" {$mymainstyle}><tr>";
$content .="{$rows}";
$content .="</tr></table>";

echo $content;


// ----------------------------------------------------------------------------------------------------------------------------------------------------------
//					END OF JOOMOOD FUNNY TOY
// ----------------------------------------------------------------------------------------------------------------------------------------------------------

?>