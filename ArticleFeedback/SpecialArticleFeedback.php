<?php
/**
 * SpecialPage for ArticleFeedback extension
 * 
 * @file
 * @ingroup Extensions
 */

class SpecialArticleFeedback extends SpecialPage {

	/* Methods */

	public function __construct() {
		parent::__construct( 'ArticleFeedback' );
	}

	public function execute( $par ) {
		global $wgUser, $wgOut, $wgRequest, $wgArticleFeedbackDashboard;

		$wgOut->addModules( 'ext.articleFeedback.dashboard' );
		$this->setHeaders();
		if ( $wgArticleFeedbackDashboard ) {
			$this->renderDailyHighsAndLows();
			$this->renderWeeklyMostChanged();
			$this->renderRecentLows();
		} else {
			$wgOut->addWikiText( 'This page has been disabled.' );
		}
	}

	/* Protected Methods */

	/**
	 * Returns an HTML table containing data from a given two dimensional array.
	 * 
	 * @param $headings Array: List of rows, each a list of column data (values will be escaped)
	 * @param $rows Array: List of rows, each a list of either calss/column data pairs (values will
	 * be escaped), or arrays containing attr, text and html fields, used to set attributes, text or
	 * HTML content of the cell
	 * @param $attribs Array: List of HTML attributes to apply to the table
	 * @return String: HTML table code
	 */
	protected function renderTable( $caption, array $headings, array $rows, $id = null ) {
		global $wgOut;

		$table = Html::openElement( 'table', array(
			'class' => 'articleFeedback-table sortable', 'id' => $id
		) );
		// Caption
		$table .= Html::element( 'caption', array(), $caption );
		// Head
		$table .= Html::openElement( 'thead' );
		$table .= Html::openElement( 'tr' );
		foreach ( $headings as $heading ) {
			$table .= Html::element( 'th', array(), $heading );
		}
		$table .= Html::closeElement( 'tr' );
		$table .= Html::closeElement( 'thead' );
		// Body
		$table .= Html::openElement( 'tbody' );
		foreach ( $rows as $row ) {
			$table .= Html::openElement( 'tr' );
			foreach ( $row as $class => $column ) {
				$attr = is_string( $class )
					? array( 'class' => 'articleFeedback-table-column-' . $class ) : array();
				if ( is_array( $column ) ) {
					if ( isset( $column['attr'] ) ) {
						$attr = array_merge( $attr, $column['attr'] );
					}
					if ( isset( $column['text'] ) ) {
						$table .= Html::element( 'td', $attr, $column['text'] );
					} else if ( isset( $column['html'] ) ) {
						$table .= Html::rawElement( 'td', $attr, $column['html'] );
					} else {
						$table .= Html::element( 'td', $attr );
					}
				} else {
					$table .= Html::rawElement( 'td', $attr, $column );
				}
			}
			$table .= Html::closeElement( 'tr' );
		}
		$table .= Html::closeElement( 'tbody' );
		$table .= Html::closeElement( 'table' );
		$wgOut->addHtml( $table );
	}

	/**
	 * Renders daily highs and lows
	 * 
	 * @return String: HTML table of daily highs and lows
	 */
	protected function renderDailyHighsAndLows() {
		global $wgOut, $wgArticleFeedbackRatings;

		$rows = array();
		foreach ( $this->getDailyHighsAndLows() as $page ) {
			$row = array();
			$pageTitle = Title::newFromText( $page['page'] );
			$row['page'] = Linker::link( $pageTitle, $pageTitle->getPrefixedText() );
			foreach ( $page['ratings'] as $id => $value ) {
				$row['rating-' . $id] = $value;
			}
			$row['average'] = $page['average'];
			$rows[] = $row;
		}
		$this->renderTable(
			wfMsg( 'articleFeedback-table-caption-dailyhighsandlows' ),
			array_merge(
				array( wfMsg( 'articleFeedback-table-heading-page' ) ),
				self::getCategories(),
				array( wfMsg( 'articleFeedback-table-heading-average' ) )
			),
			$rows,
			'articleFeedback-table-highsandlows'
		);
	}

	/**
	 * Renders weekly most changed
	 * 
	 * @return String: HTML table of weekly most changed
	 */
	protected function renderWeeklyMostChanged() {
		global $wgOut;

		$rows = array();
		foreach ( $this->getWeeklyMostChanged() as $page ) {
			$row = array();
			$pageTitle = Title::newFromText( $page['page'] );
			$row['page'] = Linker::link( $pageTitle, $pageTitle->getPrefixedText() );
			foreach ( $page['changes'] as $id => $value ) {
				$row['rating-' . $id] = $value;
			}
			$rows[] = $row;
		}
		$this->renderTable(
			wfMsg( 'articleFeedback-table-caption-weeklymostchanged' ),
			array_merge(
				array( wfMsg( 'articleFeedback-table-heading-page' ) ),
				self::getCategories()
			),
			$rows,
			'articleFeedback-table-weeklymostchanged'
		);
	}

	/**
	 * Renders recent lows
	 * 
	 * @return String: HTML table of recent lows
	 */
	protected function renderRecentLows() {
		global $wgOut, $wgArticleFeedbackRatings;

		$rows = array();
		foreach ( $this->getRecentLows() as $page ) {
			$row = array();
			$pageTitle = Title::newFromText( $page['page'] );
			$row['page'] = Linker::link( $pageTitle, $pageTitle->getPrefixedText() );
			foreach ( $wgArticleFeedbackRatings as $category ) {
				$row[] = array(
					'attr' => in_array( $category, $page['categories'] )
						? array(
							'class' => 'articleFeedback-table-cell-bad',
							'data-sort-value' => 0
						)
						: array(
							'class' => 'articleFeedback-table-cell-good',
							'data-sort-value' => 1
						),
					'html' => '&nbsp;'
				);
			}
			$rows[] = $row;
		}
		$this->renderTable(
			wfMsg( 'articleFeedback-table-caption-recentlows' ),
			array_merge(
				array( wfMsg( 'articleFeedback-table-heading-page' ) ),
				self::getCategories()
			),
			$rows,
			'articleFeedback-table-recentlows'
		);
	}

	/**
	 * Gets a list of articles which were rated exceptionally high or low.
	 * 
	 * - Based on average of all rating categories
	 * - Gets 50 highest rated and 50 lowest rated
	 * - Only consider articles with 10+ ratings in the last 24 hours
	 * 
	 * This data should be updated daily, ideally though a scheduled batch job
	 */
	protected function getDailyHighsAndLows() {
		return array(
			array(
				'page' => 'Main Page',
				// List of ratings as the currently stand
				'ratings' => array(
					1 => 4,
					2 => 3,
					3 => 2,
					4 => 1,
				),
				// Current average (considering historic averages of each rating)
				'average' => 2.5
			),
			array(
				'page' => 'Test Article',
				'ratings' => array(
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
				),
				'average' => 2.5
			)
		);
	}

	/**
	 * Gets a list of articles which have quickly changing ratings.
	 * 
	 * - Based on any rating category
	 * - Gets 50 most improved and 50 most worsened
	 * - Only consider articles with 100+ ratings in the last 7 days
	 * 
	 * This data should be updated daily, ideally though a scheduled batch job
	 */
	protected function getWeeklyMostChanged() {
		return array(
			array(
				'page' => 'Main Page',
				// List of differences for each rating in the past 7 days
				'changes' => array(
					1 => 1,
					2 => 2,
					3 => 0,
					4 => 0,
				),
			),
			array(
				'page' => 'Test Article',
				'changes' => array(
					1 => 0,
					2 => 0,
					3 => 1,
					4 => 2,
				),
			)
		);
	}

	/**
	 * Gets a list of articles which have recently recieved exceptionally low ratings.
	 * 
	 * - Based on any rating category
	 * - Gets up to 100 most recently poorly rated articles
	 * - Only consider articles which were rated lower than 3 for 7 out of the last 10 ratings
	 * 
	 * This data should be updated whenever article ratings are changed, ideally through a hook
	 */
	protected function getRecentLows() {
		return array(
			array(
				'page' => 'Main Page',
				// List of rating IDs that qualify as recent lows
				'categories' => array( 1, 4 ),
			),
			array(
				'page' => 'Test Article 1',
				'categories' => array( 1, 3 ),
			),
			array(
				'page' => 'Test Article 2',
				'categories' => array( 2, 3 ),
			),
			array(
				'page' => 'Test Article 3',
				'categories' => array( 3, 4 ),
			),
			array(
				'page' => 'Test Article 4',
				'categories' => array( 1, 2 ),
			)
		);
	}

	/* Protected Static Members */

	protected static $categories;

	/* Protected Static Methods */

	protected function getCategories() {
		global $wgArticleFeedbackRatings;

		if ( !isset( self::$categories ) ) {
			$dbr = wfGetDB( DB_SLAVE );
			$res = $dbr->select(
				'article_feedback_ratings',
				array( 'aar_id', 'aar_rating' ),
				array( 'aar_id' => $wgArticleFeedbackRatings )
			);
			self::$categories = array();
			foreach ( $res as $row ) {
				self::$categories[$row->aar_id] = wfMsg( $row->aar_rating );
			}
		}
		return self::$categories;
	}
}
