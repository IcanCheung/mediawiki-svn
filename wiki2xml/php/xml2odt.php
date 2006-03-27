<?php

class TextStyle {
	var $name = "" ;
	var $bold = false ;
	var $italics = false ;
	var $underline = false ;
	var $count = 0 ;
}

class XML2ODT {
	var $tags ;
	var $textstyle_current ;
	var $textstyles = array () ;
	var $listcode = "" ;
	var $list_is_open = false ;
	var $list_list = array () ;
	var $list_item_name = array () ;
	var $image_counter = 0 ;
	var $image_frames = array () ;
	
	function XML2ODT () {
		$this->textstyle_current = new TextStyle ;
		$this->textstyle_current->name = "T0" ;
		$this->textstyles['T0'] = $this->textstyle_current ;
		$this->tags = array () ;
	}
	
	function get_url ( $title ) {
		global $xmlg ;
		$url = "http://" . $xmlg["site_base_url"] . "/index.php?title=" . urlencode ( $title ) ;
		return $url ;
	}
	
	function get_image_frames () {
		$ret = "" ;
		foreach ( $this->image_frames AS $f ) {
			$name = $f->name ;
			$align = $f->align ;
			$ret .= '<style:style style:name="' . $name . '" style:family="graphic" style:parent-style-name="Graphics">' .
			'<style:graphic-properties style:run-through="foreground" style:wrap="parallel" style:number-wrapped-paragraphs="no-limit" ' .
			'style:wrap-contour="false" style:vertical-pos="top" style:vertical-rel="paragraph" style:horizontal-pos="' . 
			$align . '" style:horizontal-rel="paragraph" ' .
			'style:mirror="none" fo:clip="rect(0cm 0cm 0cm 0cm)" draw:luminance="0%" draw:contrast="0%" draw:red="0%" draw:green="0%" draw:blue="0%" ' .
			'draw:gamma="100%" draw:color-inversion="false" draw:image-opacity="100%" draw:color-mode="standard"/></style:style>' ;
		}
		return $ret ;
	}
	
	function get_image_frame ( $align ) {
		$i = "fr" . $this->image_counter ;
		$o->name = $i ;
		$o->align = $align ;
		$this->image_frames[$i] = $o ;
		return $i ;
	}
	
	function ensure_list_open () {
		if ( $this->list_is_open ) return "" ;
		$this->list_is_open = true ;
		if ( substr ( $this->listcode , -1 ) == '#' ) $o->type = 'numbered' ;
		else $o->type = 'bullet' ;
		$o->depth = strlen ( $this->listcode ) ;
		$o->number = count ( $this->list_list ) + 1 ;
		$this->list_list[] = $o ;
		while ( count ( $this->list_item_name ) <= $o->depth ) $this->list_item_name[] = "" ;
		$this->list_item_name[$o->depth] = 'PL' . $o->number ;
		return '<text:list text:style-name="L' . $o->number . '">' ;
	}
	
	function ensure_list_closed () {
		if ( !$this->list_is_open ) return "" ;
		$this->list_is_open = false ;
		$ret = "" ;
		$ot = $this->tags ;
		do {
			$x = array_pop ( $this->tags ) ;
			$ret .= "</{$x}>" ;
		} while ( $x != "text:list-item" && count ( $this->tags ) > 0 ) ;
		if ( $x != "text:list-item" ) {
			$ret = "" ;
			$this->tags = $ot ;
		}
		$ret .= "</text:list>" ;
		return $ret ;
	}
	
	function get_text_style ( $find ) {
		$found = "" ;
		foreach ( $this->textstyles AS $k => $ts ) {
			if ( $ts->bold != $find->bold ) continue ;
			if ( $ts->italics != $find->italics ) continue ;
			if ( $ts->underline != $find->underline ) continue ;
			$this->textstyles[$k]->count++ ;
			return $ts ;
		}
		
		# Create new style
		$found = "T" . count ( $this->textstyles ) ;
		$find->name = $found ;
		$find->count = 1 ;
		$this->textstyles[$found] = $find ;
		return $find ;
	}

	function get_styles_xml () {
		$ret = '<office:automatic-styles>' ;
		
		# Text styles
		foreach ( $this->textstyles AS $ts ) {
			if ( $ts->count == 0 ) continue ; # Skip, style never used
			$ret .= '<style:style style:name="' . $ts->name . '" style:family="text">' ;
			$ret .= '<style:text-properties' ;
			if ( $ts->italics ) $ret .= ' fo:font-style="italic" style:font-style-asian="italic" style:font-style-complex="italic"' ;
			if ( $ts->bold ) $ret .= ' fo:font-weight="bold" style:font-weight-asian="bold" style:font-weight-complex="bold"' ;
			if ( $ts->underline ) {
				$ret .= ' style:text-underline-style="solid" style:text-underline-width="auto" style:text-underline-color="font-color"' ;
			}
			$ret .= '/>' ;
			$ret .= '</style:style>' ;
		}
		
		# List styles
		$cm = 0.3 ;
		foreach ( $this->list_list AS $list ) {
			$l = "L" . $list->number ;
			$p = "PL" . $list->number ;
			$ret .= '<style:style style:name="'.$p.'" style:family="paragraph" style:parent-style-name="Standard" style:list-style-name="'.$l.'">' ;
			if ( $list->depth > 1 ) {
				$off = $cm * $list->depth ;
				$ret .= '<style:paragraph-properties fo:margin-left="' .
				$off .
				'cm" fo:margin-right="0cm" fo:text-indent="0cm" style:auto-text-indent="false"/>' ;
			}
			$ret .= '</style:style>' ;
			$ret .= '<text:list-style style:name="' . $l . '">' ;
			$off = 0 ;
			for ( $depth = 1 ; $depth <= 10 ; $depth++ ) {
				$off += $cm ;
				if ( $list->type == 'numbered' ) {
					$ret .= '<text:list-level-style-number text:level="' .
							$depth .
							'" text:style-name="Numbering_20_Symbols" style:num-suffix="." style:num-format="1">' .
							'<style:list-level-properties text:space-before="' .
							$off . 'cm" text:min-label-width="' . $cm . 'cm"/>' .
							'</text:list-level-style-number>' ;
				} else  {
					$ret .= '<text:list-level-style-bullet text:level="' .
							$depth . 
							'" text:style-name="Bullet_20_Symbols" style:num-suffix="." text:bullet-char="*">' .
							'<style:list-level-properties text:space-before="' .
							$off . 'cm" text:min-label-width="' . $cm . 'cm"/>' .
							'<style:text-properties style:font-name="StarSymbol"/>' .
							'</text:list-level-style-bullet>' ;
				}
			}
			$ret .= '</text:list-style>' ;
		}
		
		$ret .= $this->get_image_frames () ;
		
		$ret .= '</office:automatic-styles>' ;
		
		return $ret ;
	}
	
	function get_odt_start () {
		$ret = "" ;
		
		$ret .= '<office:document-content xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0" xmlns:style="urn:oasis:names:tc:opendocument:xmlns:style:1.0" xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0" xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0" xmlns:draw="urn:oasis:names:tc:opendocument:xmlns:drawing:1.0" xmlns:fo="urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:meta="urn:oasis:names:tc:opendocument:xmlns:meta:1.0" xmlns:number="urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0" xmlns:svg="urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0" xmlns:chart="urn:oasis:names:tc:opendocument:xmlns:chart:1.0" xmlns:dr3d="urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0" xmlns:math="http://www.w3.org/1998/Math/MathML" xmlns:form="urn:oasis:names:tc:opendocument:xmlns:form:1.0" xmlns:script="urn:oasis:names:tc:opendocument:xmlns:script:1.0" xmlns:ooo="http://openoffice.org/2004/office" xmlns:ooow="http://openoffice.org/2004/writer" xmlns:oooc="http://openoffice.org/2004/calc" xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xforms="http://www.w3.org/2002/xforms" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" office:version="1.0">' ;

		
		$ret .= '<office:scripts/>
<office:font-face-decls>
<style:font-face style:name="Tahoma1" svg:font-family="Tahoma"/>
<style:font-face style:name="Lucida Sans Unicode" svg:font-family="&apos;Lucida Sans Unicode&apos;" style:font-pitch="variable"/>
<style:font-face style:name="Tahoma" svg:font-family="Tahoma" style:font-pitch="variable"/>
<style:font-face style:name="Times New Roman" svg:font-family="&apos;Times New Roman&apos;" style:font-family-generic="roman" style:font-pitch="variable"/>
<style:font-face style:name="Arial" svg:font-family="Arial" style:font-family-generic="swiss" style:font-pitch="variable"/>
</office:font-face-decls>' ;

		$ret .= $this->get_styles_xml () ;
		return $ret ;
	}

}



class element {
	var $name = '';
	var $attrs = array ();
	var $children = array ();

	# Temporary variables for link tags
	var $link_target = "" ;
	var $link_trail = "" ;
	var $link_parts = array () ;


	/**
	 * Parse the children ... why won't anybody think of the children?
	 */
	function sub_parse(& $tree) {
		$ret = '' ;
		$temp = "" ;
		foreach ($this->children as $key => $child) {
			if (is_string($child)) {
				$temp .= $child ;
			} elseif ($child->name != 'ATTRS') {
				$ret .= $this->add_temp_text ( $temp )  ;
				$sub = $child->parse ( $tree , "" , $this ) ;
				if ( $this->name == 'LINK' ) {
					if ( $child->name == 'TARGET' ) $this->link_target = $sub ;
					else if ( $child->name == 'PART' ) $this->link_parts[] = $sub ;
					else if ( $child->name == 'TRAIL' ) $this->link_trail = $sub ;
				}
				$ret .= $sub ;
			}
		}
		return $ret . $this->add_temp_text ( $temp ) ;
	}
	
	function fix_text ( $s ) {
/*		$s = html_entity_decode ( $s ) ;
		filter_named_entities ( $s ) ;
		$s = str_replace ( "&" , "&amp;" , $s ) ;
		$s = str_replace ( "<" , "&lt;" , $s ) ;
		$s = str_replace ( ">" , "&gt;" , $s ) ;
		return utf8_decode ( $s ) ;*/
		filter_named_entities ( $s ) ;
		return $s ;
	}

	function add_temp_text ( &$temp ) {
		$s = $temp ;
		$temp = "" ;
		return $this->fix_text ( $s ) ;
	}
	
	function push_tag ( $tag , $params = "" ) {
		global $xml2odt ;
		$n = "<" . $tag ;
		if ( $params != "" ) $n .= " " . $params ;
		$n .= ">" ;
		$xml2odt->tags[] = $tag ;
		return $n ;
	}
	
	function pop_tag () {
		global $xml2odt ;
		if ( count ( $xml2odt->tags ) == 0 ) return "" ;
		$x = array_pop ( $xml2odt->tags ) ;
		return "</{$x}>" ;
	}
	
	function top_tag () {
		global $xml2odt ;
		if ( count ( $xml2odt->tags ) == 0 ) return "" ;
		$x = array_pop ( $xml2odt->tags ) ;
		$xml2odt->tags[] = $x ;
		return $x ;
	}

	function handle_link ( &$tree ) {
		# <text:a xlink:type="simple" xlink:href="http://www.google.de/">http://www.google.de</text:a>
		global $content_provider , $xml2odt , $xmlg ;
#		$ot = $tree->opentags ;
		$sub = $this->sub_parse ( $tree ) ;
#		$tree->opentags = $ot ;
		$link = "" ;
		if ( isset ( $this->attrs['TYPE'] ) AND strtolower ( $this->attrs['TYPE'] ) == 'external' ) { # External link
			$href = htmlentities ( $this->attrs['HREF'] ) ;
			if ( trim ( $sub ) == "" ) {
				$sub = $href ;
				$sub = explode ( '://' , $sub , 2 ) ;
				$sub = explode ( '/' , array_pop ( $sub ) , 2 ) ;
				$sub = array_shift ( $sub ) ;
			}
			$sub = $this->fix_text ( $sub ) ;
			$link = '<text:a xlink:type="simple" xlink:href="' . $href . '/">' . $sub . '</text:a>' ;
		} else { # Internal link
			$link = "LINK" ;
			if ( count ( $this->link_parts ) > 0 ) {
				$link = array_pop ( $this->link_parts ) ;
				array_push ( $this->link_parts , $link ) ; # Compensating array_pop
			}
			$link_text = $link ;
			if ( $link == "" ) $link = $this->link_target ;
			$link .= $this->link_trail ;
			
			$ns = $content_provider->get_namespace_id ( $this->link_target ) ;
			
			
			if ( $ns == 6 ) { # Image
				$nstext = explode ( ":" , $this->link_target , 2 ) ;
				$target = array_pop ( $nstext ) ;
				$nstext = array_shift ( $nstext ) ;
				
				$text = array_pop ( $this->link_parts ) ;
				
				$href = $content_provider->get_image_url ( $target ) ;
				$xml2odt->image_counter++ ;
				$image_file = $content_provider->copyimagefromwiki ( $target , $href ) ;
				$image_file_full = $xmlg['image_destination'] . "/" . $image_file ;
				$image_file = "Pictures/" . $image_file ;

				# Dimensions
				list($i_width, $i_height, $i_type, $i_attr) = @getimagesize($image_file_full);
#				$arr = getimagesize($image_file_full);
#				$i_width = $arr[0] ;
#				$i_height = $arr[1] ;
				if ( $i_width <= 0 ) { # Paranoia
					$i_width = 100 ;
					$i_height = 100 ;
				}


				$is_thumb = false ;
				$align = '' ;
				$width = '' ;
				foreach ( $this->link_parts AS $s ) {
					$s = trim ( $s ) ;
					if ( $s == 'thumb' ) {
						$is_thumb = true ;
						if ( $align == '' ) $align = 'right' ;
						if ( $width == '' ) $width = '400' ;
					} else if ( substr ( trim ( strtolower ( $s ) ) , -2 ) == 'px' ) {
						$s = trim ( strtolower ( $s ) ) ;
						$s = trim ( substr ( $s , 0 , strlen ( $s ) - 2 ) ) ;
						$width = $s * 2 ;
					}
				}
				if ( $width == '' ) $width = $i_width ;
				if ( $align == '' ) $align = 'left' ;
				
				$page_width = 1000 ; # Arbitary: page width = 1000 px
				if ( $width > $page_width ) $width = $page_width ;
				$width = $width / 100 ;
				$height = ( $i_height * $width ) / $i_width ;
				$width .= "cm" ;
				$height .= "cm" ;
#				print "{$i_width}x{$i_height} : {$width}x{$height}<br/>" ;
				
				$fr = $xml2odt->get_image_frame ( $align ) ;
				$link = '<draw:frame draw:style-name="' . $fr . '" draw:name="Figure'.
						$xml2odt->image_counter .
						'" text:anchor-type="paragraph" svg:width="' . $width . '" svg:height="' . $height . '" draw:z-index="0">' .
						'<draw:image xlink:href="' . $image_file . 
						'" xlink:type="simple" xlink:show="embed" xlink:actuate="onLoad"/>' .
						'</draw:frame>' ;
				
			} else if ( $ns == -9 ) { # Interlanguage link
				$sub = $this->link_target ;
				$nstext = explode ( ":" , $sub , 2 ) ;
				$name = array_pop ( $nstext ) ;
				$nstext = array_shift ( $nstext ) ;
				$sub = utf8_encode ( $sub ) ;
				$href = "http://{$nstext}.wikipedia.org/wiki/" . urlencode ( $name ) ;
				$link = '<text:a xlink:type="simple" xlink:href="' . $href . '/">' . $sub . '</text:a>' ;
			} else if ( $ns == -8 ) { # Category link
				if ( $link_text == "!" || $link_text == '*' ) $link = "" ;
				else if ( $link_text != $this->link_target ) $link = " ({$link_text})" ;
				else $link = "" ;
				$link = "" . $this->link_target . $link . "" ;
			} else {
				if ( $content_provider->is_an_article ( $this->link_target ) ) {
					$link = "SEITEN-INTERNER LINK" ;
/*					$lt = $this->internal_id ( trim ( $this->link_target ) ) ;
					$lt = str_replace ( "+" , "_" , $lt ) ;
					$link = "<link linkend='{$lt}'>{$link}</link>" ;*/
				} else {
					$href = $xml2odt->get_url ( $this->link_target ) ;
					if ( count ( $this->link_parts ) == 0 ) $text = $this->link_target ;
					else $text = array_pop ( $this->link_parts ) ;
					$link = '<text:a xlink:type="simple" xlink:href="' . $href . '">' . $text . '</text:a>' ;
#					$link = "INTERNER LINK" ;
					#$link = "<link linkend='{$lt}'>{$link}</link>" ;
				}
			}
		}
		return $link ;


#		return "LINK" ;
	}

	function parse ( &$tree ) {
		global $xml2odt ;
		$ret = '';
		$tag = $this->name; # Shortcut

		$old_text_style = $xml2odt->textstyle_current ;
		$tag_count = count ( $xml2odt->tags ) ;

		# Open tag
		if ( $tag == "SPACE" ) {
			return " " ;
		} else if ( $tag == "BOLD" || $tag == "XHTML:B" || $tag == "XHTML:STRONG" ) {
			$xml2odt->textstyle_current->bold = true ;
			$xml2odt->textstyle_current = $xml2odt->get_text_style ( $xml2odt->textstyle_current ) ;
			$ret .= $this->push_tag ( "text:span" , "text:style-name=\"" . $xml2odt->textstyle_current->name . "\"" ) ;
		} else if ( $tag == "XHTML:U" ) {
			$xml2odt->textstyle_current->underline = true ;
			$xml2odt->textstyle_current = $xml2odt->get_text_style ( $xml2odt->textstyle_current ) ;
			$ret .= $this->push_tag ( "text:span" , "text:style-name=\"" . $xml2odt->textstyle_current->name . "\"" ) ;
		} else if ( $tag == "ITALICS" || $tag == "XHTML:I" || $tag == "XHTML:EM" ) {
			$xml2odt->textstyle_current->italics = true ;
			$xml2odt->textstyle_current = $xml2odt->get_text_style ( $xml2odt->textstyle_current ) ;
			$ret .= $this->push_tag ( "text:span" , "text:style-name=\"" . $xml2odt->textstyle_current->name . "\"" ) ;
		} else if ( $tag == "PARAGRAPH" || $tag == "XHTML:P" ) {
			if ( $this->top_tag() != "text:p" )
				$ret .= $this->push_tag ( "text:p" , 'text:style-name="Standard"' ) ;
		} else if ( $tag == "LIST" || $tag == "XHTML:OL" || $tag == "XHTML:UL" ) {
			$is_list = true ;
			$ret .= $xml2odt->ensure_list_closed () ;
			if ( $this->top_tag() == "text:p" ) {
				$reopen_p = true ;
				$ret .= $this->pop_tag () ;
			}
			if ( $tag == "LIST" ) $type = strtolower ( $this->attrs['TYPE'] ) ;
			else $type = "" ;
			if ( $type == 'numbered' || $tag == 'XHTML:OL' ) $xml2odt->listcode .= "#" ;
			else $xml2odt->listcode .= "*" ;
		} else if ( $tag == "LINK" ) {
			return $this->handle_link ( $tree ) ;
		} else if ( $tag == "LISTITEM" || $tag == "XHTML:LI" ) {
			$ret .= $xml2odt->ensure_list_open () ;
			$tag_count = count ( $xml2odt->tags ) ;
			$p = $xml2odt->list_item_name[strlen($xml2odt->listcode)] ;
			$ret .= $this->push_tag ( "text:list-item" ) ;
			$ret .= $this->push_tag ( "text:p" , 'text:style-name="' . $p . '"' ) ;
		}

		# Children
		$ret .= $this->sub_parse ( $tree ) ;

		# Close tag
		$xml2odt->textstyle_current = $old_text_style ;
		
		while ( $tag_count < count ( $xml2odt->tags ) ) {
			$x = array_pop ( $xml2odt->tags ) ;
			$ret .= "</{$x}>" ;
		}

		if ( isset ( $is_list ) ) {
			$ret .= $xml2odt->ensure_list_closed () ;
			$xml2odt->listcode = substr ( $xml2odt->listcode , 0 , strlen ( $xml2odt->listcode ) - 1 ) ;
		}
		
		if ( isset ( $reopen_p ) ) {
			$ret .= $this->push_tag ( "text:p" , 'text:style-name="Standard"' ) ;
		}

		return $ret ;
	}
}

require_once ( "./xml2tree.php" ) ; # Uses the "element" class defined above

?>
