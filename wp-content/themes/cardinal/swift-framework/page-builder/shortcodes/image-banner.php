<?php

class SwiftPageBuilderShortcode_spb_image_banner extends SwiftPageBuilderShortcode {

    public function content( $atts, $content = null ) {

        $el_class = $width = $image_size = $animation = $image_link = $link_target = $el_position = $el_class = $image = $img_url = '';

        extract( shortcode_atts( array(
            'title'           => '',
            'width'           => '1/1',
            'image'           => $image,
            'image_size'      => '',
            'content_pos'	  => 'center',
            'content_textalign' => 'center',
            'animation' => 'none',
            'animation_delay' => '200',
            'image_link'      => '',
            'link_target'     => '',
            'el_position'     => '',
            'el_class'        => ''
        ), $atts ) );

        if ( $image_size == "" ) {
            $image_size = "large";
        }

        $output = '';
        $img      = spb_getImageBySize( array(
            'attach_id'  => preg_replace( '/[^\d]/', '', $image ),
            'thumb_size' => $image_size
        ) );
        $img_object  = wp_get_attachment_image_src( $image, 'large' );
        if ( is_array( $img_object ) && !empty( $img_object ) ) {
        	$img_url = $img_object[0];
        }
        $el_class = $this->getExtraClass( $el_class );
        $width    = spb_translateColumnWidthToSpan( $width );

        $output .= "\n\t" . '<div class="spb_content_element spb_image ' . $frame . ' ' . $width . $el_class . '">';
        $output .= "\n\t\t" . '<div class="spb-asset-content">';
        $output .= "\n\t\t" . do_shortcode( '[sf_imagebanner image="'.$img_url.'" animation="'.$animation.'" contentpos="'.$content_pos.'" textalign="'.$content_textalign.'" href="'.$image_link.'" target="'.$link_target.'"]'.$content.'[/sf_imagebanner]' );
        $output .= "\n\t\t" . '</div>';
        $output .= "\n\t" . '</div> ' . $this->endBlockComment( $width );

        if ( $fullwidth ) {
            $output = $this->startRow( $el_position, '', true ) . $output . $this->endRow( $el_position, '', true );
        } else {
            $output = $this->startRow( $el_position ) . $output . $this->endRow( $el_position );
        }

        return $output;
    }

    public function singleParamHtmlHolder( $param, $value ) {
        $output = '';
        // Compatibility fixes
        $old_names = array(
            'yellow_message',
            'blue_message',
            'green_message',
            'button_green',
            'button_grey',
            'button_yellow',
            'button_blue',
            'button_red',
            'button_orange'
        );
        $new_names = array(
            'alert-block',
            'alert-info',
            'alert-success',
            'btn-success',
            'btn',
            'btn-info',
            'btn-primary',
            'btn-danger',
            'btn-warning'
        );
        $value     = str_ireplace( $old_names, $new_names, $value );

        $param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
        $type       = isset( $param['type'] ) ? $param['type'] : '';
        $class      = isset( $param['class'] ) ? $param['class'] : '';

        if ( isset( $param['holder'] ) == false || $param['holder'] == 'hidden' ) {
            $output .= '<input type="hidden" class="spb_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';
            if ( ( $param['type'] ) == 'attach_image' ) {
                $img = spb_getImageBySize( array(
                    'attach_id'  => (int) preg_replace( '/[^\d]/', '', $value ),
                    'thumb_size' => 'thumbnail'
                ) );
                $output .= ( $img ? $img['thumbnail'] : '<img width="150" height="150" src="' . SwiftPageBuilder::getInstance()->assetURL( 'img/blank_f7.gif' ) . '" class="attachment-thumbnail" alt="" title="" />' ) . '<a href="#" class="column_edit_trigger' . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '"><i class="spb-icon-single-image"></i>' . __( 'No image yet! Click here to select it now.', 'swift-framework-admin' ) . '</a>';
            }
        } else {
            $output .= '<' . $param['holder'] . ' class="spb_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
        }

        return $output;
    }
}

SPBMap::map( 'spb_image_banner', array(
    "name"   => __( "Image Banner", "swift-framework-admin" ),
    "base"   => "spb_image_banner",
    "class"  => "spb_image_banner_widget",
    "icon"   => "spb-icon-image-banner",
    "params" => array(
        array(
            "type"        => "attach_image",
            "heading"     => __( "Image", "swift-framework-admin" ),
            "param_name"  => "image",
            "value"       => "",
            "description" => ""
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __( "Image Size", "swift-framework-admin" ),
            "param_name"  => "image_size",
            "value"       => array(
                __( "Full", "swift-framework-admin" )               => "full",
                __( "Large", "swift-framework-admin" )              => "large",
                __( "Medium", "swift-framework-admin" )             => "medium",
                __( "Thumbnail", "swift-framework-admin" )          => "thumbnail",
                __( "Small 4/3 Cropped", "swift-framework-admin" )  => "thumb-image",
                __( "Medium 4/3 Cropped", "swift-framework-admin" ) => "thumb-image-twocol",
                __( "Large 4/3 Cropped", "swift-framework-admin" )  => "thumb-image-onecol",
                __( "Large 1/1 Cropped", "swift-framework-admin" )  => "large-square",
            ),
            "description" => __( "Select the source size for the image (NOTE: this doesn't affect it's size on the front-end, only the quality).", "swift-framework-admin" )
        ),
        array(
            "type"        => "textarea_html",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __( "Text", "swift-framework-admin" ),
            "param_name"  => "content",
            "value"       => '',
            //"value" => __("<p>This is a text block. Click the edit button to change this text.</p>", "swift-framework-admin"),
            "description" => __( "Enter your content.", "swift-framework-admin" )
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __( "Content Position", "swift-framework-admin" ),
            "param_name"  => "content_pos",
            "value"       => array(
                __( "Left", "swift-framework-admin" )               => "full",
                __( "Center", "swift-framework-admin" )              => "large",
                __( "Right", "swift-framework-admin" )             => "medium",
            ),
            "description" => __( "Choose the alignment for the content.", "swift-framework-admin" )
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __( "Content Text Align", "swift-framework-admin" ),
            "param_name"  => "content_textalign",
            "value"       => array(
                __( "Left", "swift-framework-admin" )               => "full",
                __( "Center", "swift-framework-admin" )              => "large",
                __( "Right", "swift-framework-admin" )             => "medium",
            ),
            "description" => __( "Choose the alignment for the text within the content.", "swift-framework-admin" )
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __( "Animation", "swift-framework-admin" ),
            "param_name"  => "animation",
            "value"       => array(
                __( "None", "swift-framework-admin" )             => "none",
                __( "Fade In", "swift-framework-admin" )          => "fade-in",
                __( "Fade From Left", "swift-framework-admin" )   => "fade-from-left",
                __( "Fade From Right", "swift-framework-admin" )  => "fade-from-right",
                __( "Fade From Bottom", "swift-framework-admin" ) => "fade-from-bottom",
                __( "Move Up", "swift-framework-admin" )          => "move-up",
                __( "Grow", "swift-framework-admin" )             => "grow",
                __( "Fly", "swift-framework-admin" )              => "fly",
                __( "Helix", "swift-framework-admin" )            => "helix",
                __( "Flip", "swift-framework-admin" )             => "flip",
                __( "Pop Up", "swift-framework-admin" )           => "pop-up",
                __( "Spin", "swift-framework-admin" )             => "spin",
                __( "Flip X", "swift-framework-admin" )           => "flip-x",
                __( "Flip Y", "swift-framework-admin" )           => "flip-y"
            ),
            "description" => __( "Select an intro animation for the content that will show it when it appears within the viewport.", "swift-framework-admin" )
        ),
        array(
            "type"        => "textfield",
            "heading"     => __( "Animation Delay", "swift-framework-admin" ),
            "param_name"  => "animation_delay",
            "value"       => "200",
            "description" => __( "If you wish to add a delay to the animation, then you can set it here (default 200) (ms).", "swift-framework-admin" )
        ),
        array(
            "type"        => "textfield",
            "heading"     => __( "Add link to image", "swift-framework-admin" ),
            "param_name"  => "image_link",
            "value"       => "",
            "description" => __( "If you would like the image to link to a URL, then enter it here. NOTE: this will override the lightbox functionality if you have enabled it.", "swift-framework-admin" )
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __( "Link opens in new window?", "swift-framework-admin" ),
            "param_name"  => "link_target",
            "value"       => array(
                __( "Self", "swift-framework-admin" )       => "_self",
                __( "New Window", "swift-framework-admin" ) => "_blank"
            ),
            "description" => __( "Select if you want the link to open in a new window", "swift-framework-admin" )
        ),
        array(
            "type"        => "textfield",
            "heading"     => __( "Extra class name", "swift-framework-admin" ),
            "param_name"  => "el_class",
            "value"       => "",
            "description" => __( "If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin" )
        )
    )
) );