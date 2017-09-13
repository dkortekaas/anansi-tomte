<?php

    $themename = "";
    $shortname = "wlc";

    /* functions to andale the options array  */
	
    function mnt_get_formatted_page_array() {
        global $suffusion_pages_array;
        if (isset($suffusion_pages_array) && $suffusion_pages_array != null) {
            return $suffusion_pages_array;
        }
        $ret = array();
        $pages = get_pages('sort_column=menu_order');
        if ($pages != null) {
            foreach ($pages as $page) {
                if (is_null($suffusion_pages_array)) {
                    $ret[$page->ID] = array ("title" => $page->post_title, "depth" => count(get_ancestors($page->ID, 'page')));
                }
            }
        }
        if ($suffusion_pages_array == null) {
            $suffusion_pages_array = $ret;
            return $ret;
        }
        else {
            return $suffusion_pages_array;
        }
    }

	function mnt_get_category_array() {
		global $suffusion_category_array;
		if (isset($suffusion_category_array) && $suffusion_category_array != null) {
			return $suffusion_category_array;
		}
		$ret = array();
		$args = array(
	  'orderby' => 'name',
	  'parent' => 0
	  );
	$categories = get_categories( $args );
	if($categories != null){
		foreach ($categories as $category) {
				if (is_null($suffusion_category_array)) {
					$ret[$category->cat_ID] = array ("name" => $category->name, "number" => $category->count);
				}
			}
		}
		
		if ($suffusion_category_array == null) {
			$suffusion_category_array = $ret;
			return $ret;
		}
		else {
			return $suffusion_category_array;
		}
	 }
	
	function create_opening_tag($value) {
		$group_class = "";
        echo '<tr>';
		if (isset($value['grouping'])) {
			$group_class = "suf-grouping-rhs";
		}
		echo '<div class="postbox">';
		if ($group_class != "") {
			echo "<div class='$group_class fix'>";
		}
		if (isset($value['name'])) {
			echo "<h3 class='hndle'><span>" . $value['name'] . "</span></h3><table><tbody>";
		}
		if (isset($value['desc']) && !(isset($value['type']) && $value['type'] == 'checkbox')) {
			echo '<th>'.$value['desc'].'</th>';
		}
		if (isset($value['note'])) {
			echo "<span class=\"note\">".$value['note']."</span>";
		}
	 }

	function create_closing_tag($value) {
		if ($group_class != "") {
			echo "</div>";
		}
		if (isset($value['name'])) {
			echo "</tbody></table>";
        }
		echo '</div>';
        echo '</tr>';
    }

    function create_group($value) { echo '<div class="postbox">'; }
    function end_group($value) { echo '</tbody></table></div></div>'; }
	function create_suf_header_2($value) { echo '<h2>'.$value['name']."</h2>"; }
    function create_suf_header_3($value) { echo '<h3>'.$value['name']."</h3><div class='inside'><table class='form-table'><tbody>"; }
	function create_section_for_text($value) {
		create_opening_tag($value);
		$text = "";
		if (get_option($value['id']) === FALSE) {
			$text = $value['std'];
		}
		else {
			$text = get_option($value['id']);
		}
	 
		echo '<tr><td><input type="text" id="'.$value['id'].'" name="'.$value['id'].'" value="'.$text.'" /></td></tr>';
		create_closing_tag($value);
	 }

	function create_section_for_textarea($value) {
		create_opening_tag($value);
        echo '<tr>';
		echo '<td><textarea name="'.$value['id'].'" type="textarea" cols="46" rows="5">';
		if ( get_option( $value['id'] ) != "") {
			echo get_option( $value['id'] );
		}
		else {
			echo $value['std'];
		}
		echo '</textarea></td>';
        echo '</tr>';
		create_closing_tag($value);
	 }

	function create_section_for_color_picker($value) {
		create_opening_tag($value);
		$color_value = "";
		if (get_option($value['id']) === FALSE) {
			$color_value = $value['std'];
		}
		else {
			$color_value = get_option($value['id']);
		}
	 
		echo '<div class="color-picker">';
		echo '<input type="text" id="'.$value['id'].'" name="'.$value['id'].'" value="'.$color_value.'" class="color" />';
		echo ' � Click to select color<br/>';
		echo "<strong>Default: <font color='".$value['std']."'> ".$value['std']."</font></strong>";
		echo " (You can copy and paste this into the box above)";
		echo "</div>";
		create_closing_tag($value);
	 }

	function create_section_for_radio($value) {
		create_opening_tag($value);
		foreach ($value['options'] as $option_value => $option_text) {
            echo '<tr>';
			$checked = ' ';
			if (get_option($value['id']) == $option_value) {
				$checked = ' checked="checked" ';
			}
			else if (get_option($value['id']) === FALSE && $value['std'] == $option_value){
				$checked = ' checked="checked" ';
			}
			else {
				$checked = ' ';
			}

			echo '<td><input type="radio" name="'.$value['id'].'" value="'.
				$option_value.'" '.$checked."/>".$option_text."</td>";
            echo '</tr>';
		}
		create_closing_tag($value);
	 }

	function create_section_for_checkbox($value) {
		create_opening_tag($value);
        echo '<tr>';
            echo '<td><input type="checkbox" name="'.$value['id'].'" id="'.$value['id'].'" value="'.$value['name'].'" '.$checked."/>".$value['name']."</td>";
		echo '</tr>';
		create_closing_tag($value);
	 }

    function create_section_for_multi_select($value) {
        create_opening_tag($value);
        echo '<ul class="mnt-checklist" id="'.$value['id'].'" >';
        foreach ($value['options'] as $option_value => $option_list) :
            $checked = " ";
            if (get_option($value['id']."_".$option_value)) :
                $checked = " checked='checked' ";
            endif;
			echo "<li>";
			    echo '<input type="checkbox" name="'.$value['id']."_".$option_value.'" value="true" '.$checked.' class="depth-'.($option_list['depth']+1).'" />'.$option_list['title'];
            echo "</li>";
		endforeach;
        echo "</ul>";
        create_closing_tag($value);
    }

	function create_section_for_category_select($page_section,$value) {
		create_opening_tag($value);
		$all_categoris='';
			echo '<div class="wrap" id="'.$value['id'].'" >';
			echo '<h2>Theme Options</h2>
				<p><strong>'.$page_section.':</strong></p>';
				echo "<select id='".$value['id']."' class='post_form' name='".$value['id']."' value='true'>";
				echo "<option id='all' value=''>All</option>";
			foreach ($value['options'] as $option_value => $option_list) {
				$checked = ' ';
				echo 'value_id=' . $value['id'] .' value_id=' . get_option($value['id']) . ' options_value=' . $option_value;
			if (get_option($value['id']) == $option_value) {
				$checked = ' checked="checked" ';
			}
			else if (get_option($value['id']) === FALSE && $value['std'] == $option_value){
				$checked = ' checked="checked" ';
			}
			else {
				$checked = '';
			}
				echo '<option value="'.$option_list['name'].'" class="level-0" '.$checked.' number="'.($option_list['number']).'" />'.$option_list['name']."</option>";
				//$all_categoris .= $option_list['name'] . ',';
			}	
			echo "</select></div>";
			//echo '<script>jQuery("#all").val("'.$all_categoris.'")</\script>';
		create_closing_tag($value);
	 }

	$options = array( 
		array("name" => __('Footer', 'anansi-tomte'),
				"type" => "sub-section-2",
				"category" => "footer-setup"),                
		array("name" => __('Footer image URL', 'anansi-tomte'),
				"desc" => __('Enter URL for Footer image', 'anansi-tomte'),
				"id" => $shortname."_footer_image",
                "type" => "text",
				"parent" => "sub-section-2",
				"std" => ""),
		array("name" => __('Social Media', 'anansi-tomte'),
				"type" => "sub-section-2",
				"category" => "social-media-setup"),
		array("name" => __('Facebook', 'anansi-tomte'),
				"desc" => __('Enter your Facebook profile URL.', 'anansi-tomte'),
				"id" => $shortname."_social_facebook_url",
				"type" => "text",
				"parent" => "sub-section-2",
				"std" => ""),
		array("name" => __('Twitter', 'anansi-tomte'),
				"desc" => __('Enter your Twitter profile URL.', 'anansi-tomte'),
				"id" => $shortname."_social_twitter_url",
				"type" => "text",
				"parent" => "sub-section-2",
				"std" => ""),
		array("name" => __('LinkedIn', 'anansi-tomte'),
				"desc" => __('Enter your LinkedIn profile URL.', 'anansi-tomte'),
				"id" => $shortname."_social_linkedin_url",
				"type" => "text",
				"parent" => "sub-section-2",
				"std" => ""),
		array("name" => __('Google+', 'anansi-tomte'),
				"desc" => __('Enter your Google+ profile URL.', 'anansi-tomte'),
				"id" => $shortname."_social_googleplus_url",
				"type" => "text",
				"parent" => "sub-section-2",
				"std" => ""),
		array("name" => __('Pinterest', 'anansi-tomte'),
				"desc" => __('Enter your Pinterest profile URL.', 'anansi-tomte'),
				"id" => $shortname."_social_pinterest_url",
				"type" => "text",
				"parent" => "sub-section-2",
				"std" => ""),
		array("name" => __('Instagram', 'anansi-tomte'),
				"desc" => __('Enter your Instagram profile URL.', 'anansi-tomte'),
				"id" => $shortname."_social_instagram_url",
				"type" => "text",
				"parent" => "sub-section-2",
				"std" => ""),
		array("name" => __('Youtube', 'anansi-tomte'),
				"desc" => __('Enter your Youtube profile URL.', 'anansi-tomte'),
				"id" => $shortname."_social_youtube_url",
				"type" => "text",
				"parent" => "sub-section-2",
				"std" => "")
    );
	
    function create_form($options) { ?>
        <form id="options_form" method="post" name="form">
            <div class="metabox-holder">
            <?php foreach ($options as $value) {
			switch ( $value['type'] ) {
				case "start-group":
					create_group($value);
					break;
				case "end-group":
					end_group($value);
					break;
				case "sub-section-2":
					create_suf_header_2($value);
					break;
				case "sub-section-3":
					create_suf_header_3($value);
					break;
				case "text";
					create_section_for_text($value);
					break;
				case "textarea":
					create_section_for_textarea($value);
					break;
				case "multi-select":
					create_section_for_multi_select($value);
					break;
                case "checkbox":
                    create_section_for_checkbox($value);
	                break;
				case "radio":
					create_section_for_radio($value);
					break;
				case "color-picker":
					create_section_for_color_picker($value);
					break;
				case "select":
					create_section_for_category_select('first section',$value);
					break;
				case "select-2":
					create_section_for_category_select('second section',$value);
					break;
			}
		}

		?>
		    <input name="save" type="button" value="Save" class="button-primary" onclick="submit_form(this, document.forms['form'])" />
		    <input name="reset_all" type="button" value="Reset to default values" class="button" onclick="submit_form(this, document.forms['form'])" />
		    <input type="hidden" name="formaction" value="default" />
            <script>
                function submit_form(element, form){ 
                    form['formaction'].value = element.name;
                    form.submit();
                }
            </script>
        </div>
    </form>
	<?php }
