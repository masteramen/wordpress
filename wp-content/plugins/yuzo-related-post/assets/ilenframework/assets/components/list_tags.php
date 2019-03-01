<?php 
/**
 * Components: List Tags
 * @package ilentheme
 * 
 */

if ( !class_exists('ilenframework_component_list_tag') ) {

class ilenframework_component_list_tag{

	function __construct(){}
 

	function display( $id_name , $tagged = '', $args_options = array(), $is_widget = false, $id_widget = '' ){
		global $if_utils;
		$args = array(
			'public'       => true,
			'_builtin'     => false,
			'hierarchical' => false,
		); 
		$output    = ''; // or objects
		$output_js = ''; // js
		$output_jsw = ''; // js
		$operator  = 'and'; // 'and' or 'or'

		//$taxonomies_array[] = array('name'=>'tag','label'=>$args['lang_default']);
		$taxonomies_array = array();
		$taxonomies = get_taxonomies( $args, $output, $operator );
		if ( $taxonomies ) {

			//$option_taxonomy = $taxonomy;
			foreach ( $taxonomies  as $taxonomy ){
				if( $taxonomy->name != 'post_format' ){
					$taxonomies_array[] = array('name'=>$taxonomy->name,'label'=>$taxonomy->label);
				}
			}

		}
 

		$array_sano = array();
		if( $tagged && count($tagged) > 0 ){
			$array_sano = $if_utils->IF_fusion_array_under_the_same_key($tagged,",","|");
		}

		
 
		

		$i = 1;
		array_unshift( $taxonomies_array, array('name'=>'post_tag','label'=>$args_options['lang_default']) );
		$hash = substr(md5(rand(1,1000000)), 0, 8);
		if( $is_widget ){
			$id_name_generic = substr(md5(rand(1,1000000)), 0, 8);
			$output.="<div class='list_tags_wrap_$id_widget'><div class='list_tags_for_each_$id_name_generic'>";	
		}else{
			$output.="<div class='list_tags_wrap_$id_name'><div class='list_tags_for_each_$id_name'>";	
		}
		
		foreach ( $taxonomies_array  as $taxonomy_v ){

			$seleted_tageed = '';
			if( isset( $array_sano[$taxonomy_v["name"]] ) && is_array( $array_sano[$taxonomy_v["name"]] ) ){
				foreach ($array_sano[$taxonomy_v["name"]] as $tag_key => $tag_value) {
					$seleted_tageed .="{$tag_value}|{$taxonomy_v["name"]},";
				}
			}

			$output .= "<span style='padding: 4px 8px; margin-bottom: 10px; display: inline-block; border-bottom: 2px solid #D2D2D2; color: #8E8E8E;'>".$taxonomy_v['label']."</span>";
			if( ! $is_widget ){
				$output .= "<input type='text' id='{$id_name}_input_tax_tag_$i' class='input_tax_tag' value='$seleted_tageed' /> ";
			}else{
				$output .= "<input type='text' id='{$id_name}_input_tax_tag_$i' class='input_tax_tag ilen_tagw_{$id_widget} ilen_tagw_{$id_widget}_{$i}_{$hash} .ilen_tagw_{$id_name_generic}_{$i}' value='$seleted_tageed' /> ";	
			}
			
			if( ! $is_widget ){
				$output_js .= "$('#{$id_name}_input_tax_tag_$i').tagEditor({ 
							placeholder: '{$args_options["placeholder"]}',
							forceLowercase:false,
							onChange: function(field, editor, tags, tag, val) { 
								var text_val_tags = ''; 
								jQuery.each(jQuery('.list_tags_for_each_$id_name input[type=\"text\"]'), function (index, value) { 
									text_val_tags += ','+jQuery(this).val(); 
								});
								jQuery('#{$id_name}_values').val(text_val_tags);   
								jQuery('#{$id_name}_$i').val(tags);
								console.log( tags );    
							},
							beforeTagSave: function(field, editor, tags, tag, val) { return (val + '|{$taxonomy_v["name"]}').replace(',','');  } 
						});";
			}else{

				if( $is_widget ){
					$output_jsw .="
				
					$('.ilen_tagw_{$id_widget}_{$i}_{$hash}').tagEditor('destroy');
					widget.find( '.ilen_tagw_{$id_widget}_{$i}_{$hash}' ).tagEditor({
						placeholder: '{$args_options["placeholder"]}',
						forceLowercase:false,
						beforeTagSave: function(field, editor, tags, tag, val) { return (val + '|{$taxonomy_v["name"]}').replace(',','');  },
						onChange: function(field, editor, tags, tag, val) { 
							var text_val_tags = ''; 
							console.log( jQuery('.list_tags_wrap_{$id_widget} .list_tags_for_each_$id_name_generic .input_tax_tag').length );
							jQuery.each(jQuery('.list_tags_wrap_{$id_widget} .list_tags_for_each_$id_name_generic .input_tax_tag'), function (index, value) { 
								text_val_tags += ','+jQuery(this).val(); 
							}); 
							//console.log( text_val_tags );
							jQuery('.list_tags_wrap_$id_widget .ilen_tagw_{$id_name_generic}_{$i}_{$hash}').val(text_val_tags);   
							jQuery('.values_all_{$id_name_generic}_{$hash}').val(text_val_tags);
							jQuery('.values_all_{$id_name_generic}_{$hash}').attr('value',text_val_tags);
							//console.log( jQuery('.values_all_$id_name_generic').val() );    
						}
					});
				

				
						";
				}

			}
			if( !$is_widget ){
				$output.="<input id='{$id_name}_$i' style='display:none;' /> ";	
			}
			
			$i++;
		}


		$output_js .="

				function initTag_$hash( widget ) { $output_jsw }

				function onFormUpdate_tag_$hash( event, widget ) {
				  initTag_$hash( widget );
				}

				$( document ).on( 'widget-added widget-updated', onFormUpdate_tag_$hash );

				$( document ).ready( function() {
					$( '#widgets-right .widget:has(.ilen_tagw_$id_widget)' ).each( function () {
						initTag_$hash( $( this ) );
					});
				});";

		if( ! $is_widget ){
			$output.="<textarea id='{$id_name}_values' name='{$id_name}' style='display:none;'  >$tagged</textarea> ";
		}else{
			$output.="<textarea id='{$id_name}_values' name='{$id_name}' style='display:none;' class='values_all_{$id_name_generic}_{$hash}' >$tagged</textarea> ";
		}
		$output.="<script>jQuery(document).ready(function($){ $output_js }); </script></div></div>";

		echo $output;
	}
} // class

} // if


global $IF_COMPONENT;

$IF_COMPONENT['component_list_tag'] = new ilenframework_component_list_tag;





?>