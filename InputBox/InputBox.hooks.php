<?php
/**
 * Hooks for InputBox extension
 *
 * @file
 * @ingroup Extensions
 */

// InputBox hooks
class InputBoxHooks {

	/* Functions */

	// Initialization
	public static function register( &$parser ) {
		// Register the hook with the parser
		$parser->setHook( 'inputbox', array( 'InputBoxHooks', 'render' ) );

		// Continue
		return true;
	}

	// Render the input box
	public static function render( $input, $args, $parser ) {
		// Create InputBox
		$inputBox = new InputBox( $parser );

		// Configure InputBox
		$inputBox->extractOptions( $parser->replaceVariables( $input ) );

		// Return output
		return $inputBox->render();
	}
	
	/**
	 * <inputbox type=create...> sends requests with action=edit, and 
	 * possibly a &prefix=Foo.  So we pick that up here, munge prefix 
	 * and title together, and redirect back out to the real page
	 * @param $output OutputPage
	 * @param $article Article
	 * @param $title Title
	 * @param $user User
	 * @param $request WebRequest 
	 * @param $wiki MediaWiki
	 * @return True
	 */
	public static function onMediaWikiPerformAction( 
		$output, 
		$article, 
		$title, 
		$user, 
		$request, 
		$wiki )
	{
		$action = $wiki->getVal( 'Action' );
		if( $action !== 'edit' ){
			# not our problem
			return true;
		}
		if( $request->getText( 'prefix', '' ) === '' ){
			# Fine
			return true;
		}
		
		$params = $request->getValues();
		$title = $params['prefix'] . @$params['title'];
		unset( $params['prefix'] );
		unset( $params['title'] );
		$url = "?title=$title";
		foreach( $params as $key => $value ){
			if( $key ){
				$url .= "&{$key}={$value}";
			}
		}
		
		global $wgScript;
		$output->redirect( $wgScript . $url, '301' );
		return false;
	}
}
