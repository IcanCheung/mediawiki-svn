<?
# See search.doc

class SearchEngine {
	/* private */ var $mUsertext, $mSearchterms;
	/* private */ var $mTitlecond, $mTextcond;

	function SearchEngine( $text )
	{
		$this->mUsertext = $text;
		$this->mSearchterms = array();
	}

	function showResults()
	{
		global $wgUser, $wgTitle, $wgOut, $wgLang;
		global $wgServer, $wgScript;
		global $offset, $limit;
		$fname = "SearchEngine::showResults";

		$wgOut->setPageTitle( wfMsg( "searchresults" ) );
		$q = str_replace( "$1", $this->mUsertext,
		  wfMsg( "searchquery" ) );
		$wgOut->setSubtitle( $q );
		$wgOut->setArticleFlag( false );

		$this->parseQuery();
		if ( "" == $this->mTitlecond || "" == $this->mTextcond ) {
			$wgOut->addHTML( "<h2>" . wfMsg( "badquery" ) . "</h2>\n" .
			  "<p>" . wfMsg( "badquerytext" ) );
			return;
		}
		if ( ! isset( $limit ) ) {
			$limit = $wgUser->getOption( "searchlimit" );
			if ( ! $limit ) { $limit = 20; }
		}
		if ( ! $offset ) { $offset = 0; }

		$sql = "SELECT cur_id,cur_namespace,cur_title," .
		  "cur_text FROM cur " .
		  "WHERE {$this->mTitlecond} AND (cur_namespace=0) " .
		  "LIMIT {$offset}, {$limit}";
		$res1 = wfQuery( $sql, $fname );

		$sql = "SELECT cur_id,cur_namespace,cur_title," .
		  "cur_text FROM cur " .
		  "WHERE {$this->mTextcond} AND (cur_namespace=0) " .
		  "LIMIT {$offset}, {$limit}";
		$res2 = wfQuery( $sql, $fname );

		$top = str_replace( "$1", $limit, wfMsg( "showingmatches" ) );
		$top = str_replace( "$2", $offset+1, $top );
		$wgOut->addHTML( "<p>{$top}\n" );

		$prev = str_replace( "$1", $limit, wfMsg( "searchprev" ) );
		$next = str_replace( "$1", $limit, wfMsg( "searchnext" ) );

		$sk = $wgUser->getSkin();
		if ( 0 != $offset ) {
			$po = $offset - $limit;
			$plink = "<a href=\"$wgServer$wgScript?search={$this->mUsertext}" .
			  "&amp;limit={$limit}&amp;offset={$po}\">{$prev}</a>";
		} else { $plink = $prev; }
		$no = $offset + $limit;
		$nlink = "<a href=\"$wgServer$wgScript?search={$this->mUsertext}" .
		  "&amp;limit={$limit}&amp;offset={$no}\">{$next}</a>";

		$sl = str_replace( "$1", $plink, wfMsg( "searchlinks" ) );
		$sl = str_replace( "$2", $nlink, $sl );
		$wgOut->addHTML( "<br>{$sl}\n" );

		$foundsome = false;
		if ( 0 == wfNumRows( $res1 ) ) {
			$wgOut->addHTML( "<h2>" . wfMsg( "notitlematches" ) . "</h2>\n" );
		} else {
			$foundsome = true;
			$off = $offset + 1;
			$wgOut->addHTML( "<h2>" . wfMsg( "titlematches" ) . "</h2>\n" .
			  "<ol start='{$off}'>" );
			while ( $row = wfFetchObject( $res1 ) ) {
				$this->showHit( $row );
			}
			wfFreeResult( $res1 );
			$wgOut->addHTML( "</ol>\n" );
		}
		if ( 0 == wfNumRows( $res2 ) ) {
			$wgOut->addHTML( "<h2>" . wfMsg( "notextmatches" ) . "</h2>\n" );
		} else {
			$foundsome = true;
			$off = $offset + 1;
			$wgOut->addHTML( "<h2>" . wfMsg( "textmatches" ) . "</h2>\n" .
			  "<ol start='{$off}'>" );
			while ( $row = wfFetchObject( $res2 ) ) {
				$this->showHit( $row );
			}
			wfFreeResult( $res2 );
			$wgOut->addHTML( "</ol>\n" );
		}
		if ( ! $foundsome ) {
			$wgOut->addHTML( "<p>" . wfMsg( "nonefound" ) . "\n" );
		}
		$wgOut->addHTML( "<p>{$sl}\n" );
	}

	function legalSearchChars()
	{
		$lc = "A-Za-z_'0-9\\x90-\\xFF\\-";
		return $lc;
	}

	function parseQuery()
	{
		$lc = SearchEngine::legalSearchChars() . "()";
		$q = preg_replace( "/[^{$lc}]/", " ", $this->mUsertext );
		$q = preg_replace( "/([()])/", " \\1 ", $q );
		$q = preg_replace( "/\\s+/", " ", $q );
		$w = explode( " ", strtolower( trim( $q ) ) );

		$last = $cond = "";
		foreach ( $w as $word ) {
			if ( "and" == $word || "or" == $word || "not" == $word
			  || "(" == $word || ")" == $word ) {
				$cond .= " {$word}";
				$last = "";
			} else {
				if ( "" != $last ) { $cond .= " and"; }
				$cond .= " (match (##field##) against ('" .
				  wfStrencode( $word ). "'))";
				$last = $word;
				array_push( $this->mSearchterms, "\\b" . $word . "\\b" );
			}
		}
		$this->mTitlecond = "(" . str_replace( "##field##",
		  "cur_ind_title", $cond ) . " )";

		$this->mTextcond = "(" . str_replace( "##field##",
		  "cur_ind_text", $cond ) . " AND (cur_is_redirect=0) )";
	}

	function showHit( $row )
	{
		global $wgUser, $wgOut;

		$t = Title::makeName( $row->cur_namespace, $row->cur_title );
		$sk = $wgUser->getSkin();

		$link = $sk->makeKnownLink( $t, "" );
		$wgOut->addHTML( "<li>{$link}" );

		$lines = explode( "\n", $row->cur_text );
		$pat1 = "/(.*)(" . implode( "|", $this->mSearchterms ) . ")(.*)/i";
		$lineno = 0;

		foreach ( $lines as $line ) {
			++$lineno;
			if ( ! preg_match( $pat1, $line, $m ) ) { continue; }

			$pre = $m[1];
			if ( strlen( $pre ) > 60 ) {
				$pre = "..." . substr( $pre, -60 );
			}
			$pre = wfEscapeHTML( $pre );

			if ( count( $m ) < 3 ) { $post = ""; }
			else { $post = $m[3]; }
			if ( strlen( $post ) > 60 ) {
				$post = substr( $post, 0, 60 ) . "...";
			}
			$post = wfEscapeHTML( $post );
			$found = wfEscapeHTML( $m[2] );

			$line = "{$pre}{$found}{$post}";
			$pat2 = "/(" . implode( "|", $this->mSearchterms ) . ")/i";
			$line = preg_replace( $pat2,
			  "<font color='red'>\\1</font>", $line );

			$wgOut->addHTML( "<br><small>{$lineno}: {$line}</small>\n" );
		}
		$wgOut->addHTML( "</li>\n" );
	}
}

