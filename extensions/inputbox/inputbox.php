<?php

/**
 * This file contains the main include file for the Inputbox extension of 
 * MediaWiki. 
 *
 * Usage: require_once("path/to/inputbox.php"); in LocalSettings.php
 *
 * This extension requires MediaWiki 1.5 or higher.
 *
 * @author Erik Moeller <moeller@scireview.de>
 *  namespaces search improvements partially by
 *  Leonardo Pimenta <leo.lns@gmail.com> 
 * @copyright Public domain
 * @license Public domain
 * @version 0.1.1
 */
 
/**
 * Register the Inputbox extension with MediaWiki
 */ 
$wgExtensionFunctions[] = 'registerInputboxExtension';
$wgExtensionCredits['parserhook'][] = array(
	'name' => 'Inputbox',
	'author' => 'Erik Moeller',
	'url' => 'http://meta.wikimedia.org/wiki/Help:Inputbox',
	'description' => 'Allow inclusion of predefined HTML forms.',
);

/**
 * Sets the tag that this extension looks for and the function by which it
 * operates
 */
function registerInputboxExtension()
{
    global $wgParser;
    $wgParser->setHook('inputbox', 'renderInputbox');
}

function renderInputbox( $input, $params, $parser ) {
	$inputbox = new Inputbox( $parser );
	$inputbox->extractOptions( $parser->replaceVariables( $input ) );
	$html = $inputbox->render();
	// FIXME: Won't somebody please think of the i18n people!?
	return $html
		? $html
		: '<div><strong class="error">Input box: Type not defined.</strong></div>';
}

class Inputbox {
	var $type,$width,$preload,$editintro, $br;
	var $defaulttext,$bgcolor,$buttonlabel,$searchbuttonlabel;
	var $hidden;
	
	function InputBox( &$parser ) {
		$this->parser =& $parser;
	}
	
	function render() {
		if($this->type=='create' || $this->type=='comment') {
			return $this->getCreateForm();		
		} elseif($this->type=='search') {
			return $this->getSearchForm();
		} elseif($this->type=='search2') {
			return $this->getSearchForm2();
		} else {
			return false;
		}	
	}
	function getSearchForm() {
		global $wgUser, $wgContLang;
		
		$sk=$wgUser->getSkin();
		$searchpath = $sk->escapeSearchLink();		
		if(!$this->buttonlabel) {
			$this->buttonlabel = wfMsgHtml( 'tryexact' );
		}
		if(!$this->searchbuttonlabel) {
			$this->searchbuttonlabel = wfMsgHtml( 'searchfulltext' );
		}


		$type = $this->hidden ? 'hidden' : 'text';
		$searchform=<<<ENDFORM
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
		<td align="center" bgcolor="{$this->bgcolor}">
		<form name="searchbox" action="$searchpath" class="searchbox">
		<input class="searchboxInput" name="search" type="{$type}"
		value="{$this->defaulttext}" size="{$this->width}" />{$this->br}
ENDFORM;

		// disabled when namespace filter active
		$gobutton=<<<ENDGO
<input type='submit' name="go" class="searchboxGoButton" value="{$this->buttonlabel}" />&nbsp;
ENDGO;
		// Determine namespace checkboxes
		$namespaces = $wgContLang->getNamespaces();
		$namespacesarray = explode(",",$this->namespaces);

		// Test if namespaces requested by user really exist
		$searchform2 = '';
		if ($this->namespaces) {
			foreach ($namespacesarray as $usernamespace) {
				$checked = '';
				// Namespace needs to be checked if flagged with "**" or if it's the only one
				if (strstr($usernamespace,'**') || count($namespacesarray)==1) {
                                        $usernamespace = str_replace("**","",$usernamespace);
                                        $checked =" checked";
                                }
				foreach ( $namespaces as $i => $name ) {
					if ($i < 0){
						continue;
					}elseif($i==0) {
						$name='Main';
					}
					if ($usernamespace == $name) {
						$searchform2 .= "<input type=\"checkbox\" name=\"ns{$i}\" value=\"1\"{$checked}>{$usernamespace}";
					}
				}
			}
			//Line feed 
			$searchform2 .= $this->br;		
			//If namespaces are defined remove the go button 
			//because go button doesn't accept namespaces parameters 
			$gobutton='';
		} 
		$searchform3=<<<ENDFORM2
		{$gobutton}
		<input type='submit' name="fulltext" class="searchboxSearchButton" value="{$this->searchbuttonlabel}" />
		</form>
		</td>
		</tr>
		</table>
ENDFORM2;
		//Return form values
		return $searchform . $searchform2 . $searchform3;
	}

	function getSearchForm2() {
		global $wgUser;
		
		$sk=$wgUser->getSkin();
		$searchpath = $sk->escapeSearchLink();		
		if(!$this->buttonlabel) {
			$this->buttonlabel = wfMsgHtml( 'tryexact' );
		}

		$output = $this->parser->parse( $this->labeltext,
			$this->parser->getTitle(), $this->parser->getOptions(), false, false );
		$this->labeltext = $output->getText();
		$this->labeltext = str_replace('<p>', '', $this->labeltext);
		$this->labeltext = str_replace('</p>', '', $this->labeltext);
		
		$type = $this->hidden ? 'hidden' : 'text';
		$searchform=<<<ENDFORM
<form action="$searchpath" class="bodySearch" id="bodySearch{$this->id}"><div class="bodySearchWrap"><label for="bodySearchIput{$this->id}">{$this->labeltext}</label><input type="{$type}" name="search" size="{$this->width}" class="bodySearchIput" id="bodySearchIput{$this->id}" /><input type="submit" name="go" value="{$this->buttonlabel}" class="bodySearchBtnGo" />
ENDFORM;

		if ( !empty( $this->fulltextbtn ) ) // this is wrong...
			$searchform .= '<input type="submit" name="fulltext" class="bodySearchBtnSearch" value="{$this->searchbuttonlabel}" />';

		$searchform .= '</div></form>';

		return $searchform;
	}

	
	function getCreateForm() {
		global $wgScript;	
		
		$action = htmlspecialchars( $wgScript );		
		if($this->type=="comment") {
			$comment='<input type="hidden" name="section" value="new" />';
			if(!$this->buttonlabel) {
				$this->buttonlabel = wfMsgHtml( "postcomment" );
			}
		} else {
			$comment='';
			if(!$this->buttonlabel) {			
				$this->buttonlabel = wfMsgHtml( "createarticle" );
			}
		}		
		$type = $this->hidden ? 'hidden' : 'text';
		$createform=<<<ENDFORM
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tr>
<td align="center" bgcolor="{$this->bgcolor}">
<form name="createbox" action="$action" method="get" class="createbox">
	<input type='hidden' name="action" value="edit" />
	<input type="hidden" name="preload" value="{$this->preload}" />
	<input type="hidden" name="editintro" value="{$this->editintro}" />
	{$comment}
	<input class="createboxInput" name="title" type="{$type}"
	value="{$this->defaulttext}" size="{$this->width}" />{$this->br}
	<input type='submit' name="create" class="createboxButton"
	value="{$this->buttonlabel}" />
</form>
</td>
</tr>
</table>
ENDFORM;
		return $createform;
	}

	function lineBreak() {
		# Should we be inserting a <br /> tag?
		$cond = ( strtolower( $this->br ) == "no" );
		$this->br = $cond ? '' : '<br />';
	}

	/**
	 * If the width is not supplied, set it to 50
	 */
	function checkWidth() {
		if( !$this->width || trim( $this->width ) == '' )
			$this->width = 50;
	}
	
	/**
	 * Extract options from a blob of text
	 *
	 * @param string $text Tag contents
	 */
	public function extractOptions( $text ) {
		wfProfileIn( __METHOD__ );
	
		// Parse all possible options
		$values = array();
		foreach( explode( "\n", $text ) as $line ) {
			if( strpos( $line, '=' ) === false )
				continue;
			list( $name, $value ) = explode( '=', $line, 2 );
			$values[ strtolower( trim( $name ) ) ] = trim( $value );
		}

		// Go through and set all the options we found
		$options = array(
			'type' => 'type',
			'width' => 'width',
			'preload' => 'preload',
			'editintro' => 'editintro',
			'default' => 'defaulttext',
			'bgcolor' => 'bgcolor',
			'buttonlabel' => 'buttonlabel',
			'searchbuttonlabel' => 'searchbuttonlabel',
			'namespaces' => 'namespaces',
			'id' => 'id',
			'labeltext' => 'labeltext',
			'break' => 'br',
			'hidden' => 'hidden',
		);
		foreach( $options as $name => $var ) {
			if( isset( $values[$name] ) )
				$this->$var = $values[$name];
		}
		
		// Some special-case fix-ups
		$this->lineBreak();
		$this->checkWidth();
		
		wfProfileOut( __METHOD__ );	
	}
	
}