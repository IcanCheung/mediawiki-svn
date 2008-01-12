<?php
/*
 * MV_Messages.php Created on Jan 8, 2008
 *
 * Internationalization file for MetavidWiki extension
 */

$messages = array();

/** English
 * @author Michael Dale
 */
$messages['en'] = array(
	'metavid'           => 'Metavid Page',
	'mv_missing_stream' => 'Missing Stream: $1',

	#stream/files key descriptions:
	'mv_ogg_low_quality'      => 'Web Streamable ogg theora, hosted on metavid',
	'mv_ogg_high_quality'     => 'High Quality ogg theora, hosted on metavid',
	'mv_archive_org_link'     => 'Links into Archive.org mpeg2 originals',

	'mv_error_stream_missing' => '<span class="error">Error: There is no video stream associated with this metadata.</span><br />Please report this to the site administrator.<br /><i>stream metadata interface is disabled</i>',

	#add/edit stream text:
	'mv_stream_meta'                => 'Stream Page',
	'mv_add_stream'                 => 'Metavd Add Stream',
	'mv_edit_stream'                => 'Metavid Edit Stream',
	'mv_add_stream_page'            => 'Mv Add Stream',
	'mv_edit_strea_docu'            => '<p>Edit stream <b>admin</b><br />for normal user view/edit see $1 page',
	'mv_add_stream_docu'            => '<p>Add a new Stream with the field below.</p><p>More information is given on the <a href="$1">help page for add stream</a>.</p>',
	'mv_add_stream_submit'          => 'Add stream',
	'mv_no_stream_files'            => 'No Existing Stream files',
	'mv_edit_stream_files'          => 'Edit stream files',
	'mv_path_type_url_anx'          => 'full media url',
	'mv_path_type_wiki_title'       => 'wiki media title',
	'mv_path_type_label'            => 'path type',
	'mv_base_offset_label'          => 'base offset',
	'mv_duration_label'             => 'duration',
	'mv_file_desc_label'            => 'stream desc msg',
	'mv_delete_stream_file'         => 'delete stream file reference',
	'mv_save_changes'               => 'Save Changes',
	'mv_file_with_same_desc'        => 'Error: stream file with same description key <i>$1</i> already present',
	'mv_updated_stream_files'       => 'Updated Stream Files Record',
	'mv_removed_file_stream'        => 'Removed Stream file: $1',
	'mv_missing_stream_text'        => 'The stream you requested <b>$1</b> is not available.<br />You may want to check the <a href="$2">Stream List</a><br />Or you many want to <a href="$3">Add The Stream</a>.',

	'mv_add_stream_file'            => 'Add Stream File',
	'mv_media_path'                 => 'media path',
	'mv_file_list'                  => 'Stream Files',
	'mv_label_stream_name'          => 'Stream Name',
	'mv_label_stream_desc'          => 'Stream Description',
	'add_stream_permission'         => 'You lack permission to add a new stream',
	'edit_stream_missing'           => 'Missing stream name',
	'mv_stream_already_exists'      => 'The stream <a href="$2">$1</a> already exists',
	'mv_summary_add_stream'         => 'stream added by form',
	'mv_error_stream_insert'        => 'failed to insert stream',
	'mv_redirect_and_delete_reason' => 'removed redirect page',
	'mv_remove_reason'              => 'Reason For deletion:',
	'mv_stream_delete_warrning'     => '<b>Removing this Stream will also remove $1 pieces of assocative metadata</b><br />',

	#stream type
	'mv_label_stream_type'     => 'Stream Type',
	'mv_metavid_file'          => 'Existing File on Server',
	'mv_metavid_live'          => 'Set Up Live Stream',
	'mv_upload_file'           => 'Upload file',
	'mv_external_file'         => 'External File',
	'mv_stream_delete_warning' => 'Deleting this Stream will additionally remove $1 pages of metadata',

	#tools
	'mv_tool_search'         => 'Search',
	'mv_tool_search_title'   => 'Search within this Stream',
	'mv_tool_navigate'       => 'Navigate',
	'mv_tool_navigate_title' => 'Navigate the full stream',
	'mv_tool_export'         => 'Export',
	'mv_tool_export_title'   => 'Export Stream Metadata',
	'mv_tool_embed'          => 'Embed',
	'mv_tool_embed_title'    => 'Embed options for the current requested segment',
	'mv_tool_overlay'        => 'Template Overlays',
	'mv_tool_overlay_title'  => 'Template based metadata Overlays',
	'mv_results_found_for'   => 'Search Results <b>$1</b> to <b>$2</b> of <b>$3</b> for:',

	#mvd types:
	'ht_en'        => 'Transcript',
	'ht_en_desc'   => 'English transcripts. This overlay type is for text which spoken in the video stream. Links can be added, but all text should be what is spoken in the video stream.',
	'anno_en'      => 'Annotations and Categories',
	'anno_en_desc' => 'English categorizations and annotations. This overlay can be used to \"tag\"/Categorize sections of video or to add annotative information that is not spoken text',

	'mv_data_page_title' => '$1 for $2 from $3',
	'mv_time_separator'  => '$1 to $2',

	# Messages for  Special List stream
	'mv_list_streams'      => 'Metavid List Streams',
	'mv_list_streams_page' => 'Mv List Streams',
	'mv_list_streams_docu' => 'The following streams exist:',
	'mv_list_streams_none' => 'No streams exist',

	#messages for metavid export feed:
	'mvvideofeed'        => 'Metavid Video Feed Export',
	'video_feed_cat'     => 'Video Feed for Category:',
	'mv_cat_search_note' => 'Note: Categories only lists top level categories, for all metadata in category ranges search for $1',

	# Messages for MV_DataPage
	'mv_mvd_linkback' => 'Part of stream $1 <br />Jump to Stream View: $2<br />',

	#messages for MVD pages
	'mvBadMVDtitle' => 'missing type, stream missing, or not valid time format',
	'mvMVDFormat'   => 'MVD title should be of format: mvd:type:stream_name/start_time/end_time',

	#messeges for interface mvd pages:
	'mv_play'                     => 'Play',
	'mv_edit'                     => 'Edit',
	'mv_history'                  => 'History',
	'mv_history_title'            => 'Edit and Video Alignment History',
	'mv_edit_title'               => 'Edit Text',
	'mv_edit_adjust_title'        => 'Edit Text and Video Alignment',
	'mv_remove'                   => 'remove',
	'mv_remove_title'             => 'remove this meta data segment',
	'mv_adjust'                   => 'adjust',
	'mv_adjust_submit'            => 'Save Adjustment',
	'mv_adjust_title'             => 'Adjust Start and End time',
	'mv_adjust_preview'           => 'Preview Adjustment',
	'mv_adjust_preview_stop'      => 'Stop Preview',
	'mv_adjust_default_reason'    => 'metavid interface adjust',
	'mv_adjust_old_title_missing' => 'The page you are tyring to move from ($1) does not exist',
	'mv_adjust_ok_move'           => 'Success, adjusting...',

	'mv_start_desc'               => 'Start Time',
	'mv_end_desc'                 => 'End Time',

	#search
	'mediasearch'                    => 'Media Search',
	'mv_search_sel_t'                => 'Select Search Type',
	'mv_run_search'                  => 'Run Search',
	'mv_add_filter'                  => 'Add Filter',
	'mv_search_match'                => 'Search Text',
	'mv_search_spoken_by'            => 'Spoken By',
	'mv_search_category'             => 'Category',
	'mv_search_smw_property'         => 'Semantic Properties',
	'mv_search_smw_property_numeric' => 'Numeric Semantic Value',
	'mv_search_and'                  => 'and',
	'mv_search_or'                   => 'or',
	'mv_search_not'                  => 'not',
	'mv_search_stream_name'          => 'Stream Name',
	'mv_stream_name'                 => 'stream name',

	'mv_match'     => 'match',
	'mv_spoken_by' => 'spoken by',
	'mv_category'  => 'category',

	'mv_search_no_results'        => 'No media matches',
	'mv_media_matches'            => 'Media matches',
	'mv_remove_filter'            => 'remove filter',
	'mv_advaced_search'           => 'Advanced Media Search',
	'mv_expand_play'              => 'Expand and Play in-line',
	'mv_view_in_stream_interface' => 'View in Stream Interface',
	'mv_view_wiki_page'           => 'View wiki page',
	'mv_error_mvd_not_found'      => 'Error mvd not found',
	'mv_match_text'               => '~  $1 matches',

	#sequence text:
	'mv_edit_sequence'            => 'Editing Sequence:$1',
	'mv_sequence_player_title'    => 'sequence player',

	'mv_save_sequence'            => 'Save Sequence',
	'mv_sequence_page_desc'       => 'Save The Current Sequence',
	'mv_sequence_add'             => 'Add clips',
	'mv_sequence_add_manual'      => 'Add By Name',
	'mv_sequence_add_manual_desc' => 'Add clips by Stream Name',
	'mv_sequence_add_search'      => 'Add By Search',
	'mv_sequence_add_search_desc' => 'Add clips by Media Search',
	'mv_seq_add_end'              => 'Add to End of Sequence',

	'mv_sequence_timeline'        => 'Sequence Timeline:',
	'mv_edit_sequence_desc_help'  => 'Sequence Description<br />',
	'mv_edithelpsequence'         => 'Help:Sequence_Editing',
	'mv_seq_summary'              => 'Sequence Edit Summary',
	'mv_add_clip_by_name'         => 'Add Clip By Name',

	#mv tools
	'mv_export_cmml'         => 'export cmml',
	'mv_search_stream'       => 'Search Stream',
	'mv_navigate_stream'     => 'Navigate Full Stream',
	'mv_embed_options'       => 'Embed Options',
	'mv_overlay'             => 'Overlay Controls',
	'mv_stream_tool_heading' => 'Stream Tools',
	'mv_tool_missing'        => 'tool request ($1) does not exist',
	'mv_bad_tool_request'    => 'bad tool line should be form: tool_name|tool_display_name',

	#msg for overlay interface:
	'mv_search_stream'       => 'Search Stream',
	'mv_search_stream_title' => 'Search the Current Stream',
	'mv_new_ht_en'           => 'New Transcript',
	'mv_new_anno_en'         => 'New Tag or Annotation',
);

/** Arabic (العربية)
 * @author Meno25
 */
$messages['ar'] = array(
	'metavid'                        => 'صفحة ميتافيد',
	'mv_missing_stream'              => 'ستريم مفقود: $1',
	'mv_ogg_low_quality'             => 'ثيورا أو جي جي، مستضاف على ميتافيد',
	'mv_ogg_high_quality'            => 'ثيورا أو جي جي ذو جودة عالية، مستضاف على ميتافيد',
	'mv_archive_org_link'            => 'يصل إلى Archive.org mpeg2 الأصلي',
	'mv_error_stream_missing'        => '<span class="error">خطأ: لا يوجد ستريم فيديو مصاحب لبيانات الميتا هذه.</span><br /> من فضلك أبلغ هذا إلى إداري الموقع.<br /> <i>واجهة ستريم بيانات الميتا معطلة</i>',
	'mv_stream_meta'                 => 'صفحة ستريم',
	'mv_add_stream'                  => 'أضف ستريم ميتافيد',
	'mv_edit_stream'                 => 'عدل ستريم ميتافيد',
	'mv_add_stream_page'             => 'أضف ستريم إم في',
	'mv_edit_strea_docu'             => '<p>عدل الستريم <b>إداري</b> <br /> للمستخدم العادي عرض/تعديل انظر صفحة $1',
	'mv_add_stream_docu'             => '<p>إضافة ستريم جديد بالحقل بالأسفل.</p><p> المزيد من المعلومات معطاة في <a href="$1">صفحة المساعدة لإضافة الستريم</a>.</p>',
	'mv_add_stream_submit'           => 'أضف ستريم',
	'mv_no_stream_files'             => 'لا ملفات ستريم موجودة',
	'mv_edit_stream_files'           => 'عدل ملفات الستريم',
	'mv_path_type_url_anx'           => 'مسار الميديا الكامل',
	'mv_path_type_wiki_title'        => 'عنوان الميديا على الويكي',
	'mv_path_type_label'             => 'نوع المسار',
	'mv_base_offset_label'           => 'أوف سيت الأساس',
	'mv_duration_label'              => 'المدة',
	'mv_file_desc_label'             => 'رسالة وصف الستريم',
	'mv_delete_stream_file'          => 'احذف مرجع ملف الستريم',
	'mv_save_changes'                => 'حفظ التغييرات',
	'mv_file_with_same_desc'         => 'خطأ: ملف ستريم بنفس مفتاح الوصف <i>$1</i> موجود بالفعل',
	'mv_updated_stream_files'        => 'سجل ملفات الستريم المحدث',
	'mv_removed_file_stream'         => 'أزال ملف الستريم: $1',
	'mv_missing_stream_text'         => 'الستريم الذي طلبته <b>$1</b> غير متوفر.<br />ربما تريد فحص <a href="$2">قائمة الستريم</a><br />أو ربما ترغب في <a href="$3">إضافة الستريم</a>.',
	'mv_add_stream_file'             => 'أضف ملف ستريم',
	'mv_media_path'                  => 'مسار الميديا',
	'mv_file_list'                   => 'ملفات الستريم',
	'mv_label_stream_name'           => 'اسم الستريم',
	'mv_label_stream_desc'           => 'وصف الستريم',
	'add_stream_permission'          => 'أنت لا تمتلك الصلاحية لإضافة ستريم جديد',
	'edit_stream_missing'            => 'اسم ستريم مفقود',
	'mv_stream_already_exists'       => 'الستريم <a href="$2">$1</a> موجود بالفعل',
	'mv_summary_add_stream'          => 'الستريم تمت إضافته بواسطة الاستمارة',
	'mv_error_stream_insert'         => 'فشل في إدراج الستريم',
	'mv_redirect_and_delete_reason'  => 'أزال صفحة التحويل',
	'mv_remove_reason'               => 'السبب للحذف:',
	'mv_stream_delete_warrning'      => '<b>إزالة هذا الستريم ستزيل أيضا $1 قطعة من بيانات الميتا المصاحبة</b><br />',
	'mv_label_stream_type'           => 'نوع الستريم',
	'mv_metavid_file'                => 'الملف الموجود على الخادم',
	'mv_metavid_live'                => 'ضبط ستريم حي',
	'mv_upload_file'                 => 'رفع ملف',
	'mv_external_file'               => 'ملف خارجي',
	'mv_stream_delete_warning'       => 'حذف هذا الستريم سيزيل أيضا $1 صفحة من بيانات الميتا',
	'mv_tool_search'                 => 'بحث',
	'mv_tool_search_title'           => 'ابحث في هذا الستريم',
	'mv_tool_navigate'               => 'إبحار',
	'mv_tool_navigate_title'         => 'تصفح الستريم الكامل',
	'mv_tool_export'                 => 'تصدير',
	'mv_tool_export_title'           => 'صدر بيانات ميتا الستريم',
	'mv_tool_embed'                  => 'إدراج',
	'mv_tool_embed_title'            => 'خيارات الإدراج للعامود المطلوب حاليا',
	'mv_tool_overlay'                => 'القالب يغطي',
	'mv_tool_overlay_title'          => 'تغطية بيانات ميتا بواسطة قوالب',
	'mv_results_found_for'           => 'نتائج البحث <b>$1</b> إلى <b>$2</b> ل <b>$3</b> ل:',
	'ht_en'                          => 'ترانسكريبت',
	'ht_en_desc'                     => 'ترانسكريبتات إنجليزية. نوع التغطية هذا للنص المنطوق في ستريم الفيديو. الوصلات يمكن إضافتها، لكن كل النص ينبغي أن يكون ما هو منطوق في ستريم الفيديو.',
	'anno_en'                        => 'الأنوتاشنات والتصنيفات',
	'anno_en_desc'                   => 'الأنوتاشنتات والتصنيفات الإنجليزية. هذه التغطية يمكن استخدامها ل \\"tag\\"/تصنيف أقسام من الفيديو أو لإضافة معلومات أنوتاشن ليست نصا منطوقا',
	'mv_data_page_title'             => '$1 ل$2 من $3',
	'mv_time_separator'              => '$1 إلى $2',
	'mv_list_streams'                => 'عرض ستريمات ميتافيد',
	'mv_list_streams_page'           => 'عرض ستريمات إم في',
	'mv_list_streams_docu'           => 'الستريمات التالية موجودة:',
	'mv_list_streams_none'           => 'لا ستريمات موجودة',
	'mvvideofeed'                    => 'تصدير تلقيم فيديو ميتافيد',
	'video_feed_cat'                 => 'تلقيم فيديو للتصنيف:',
	'mv_cat_search_note'             => 'ملاحظة: التصنيفات تعرض فقط التصنيفات العليا، لكل بيانات الميتا في بحث نطاقات التصنيف عن $1',
	'mv_mvd_linkback'                => 'جزء من الستريم $1 <br />القفز إلى عرض الستريم: $2<br />',
	'mvBadMVDtitle'                  => 'نوع مفقود، ستريم مفقود، أو صيغة وقت غير صحيحة',
	'mvMVDFormat'                    => 'عنوان إم في دي ينبغي أن يكون بالصيغة: mvd:نوع:اسم_الستريم/وقت_البداية/وقت_النهاية',
	'mv_play'                        => 'عرض',
	'mv_edit'                        => 'عدل',
	'mv_history'                     => 'تاريخ',
	'mv_history_title'               => 'تاريخ التعديل وترتيب الفيديو',
	'mv_edit_title'                  => 'عدل النص',
	'mv_edit_adjust_title'           => 'عدل ترتيب النص والفيديو',
	'mv_remove'                      => 'إزالة',
	'mv_remove_title'                => 'أزل عامود بيانات الميتا هذا',
	'mv_adjust'                      => 'ضبط',
	'mv_adjust_submit'               => 'حفظ الضبط',
	'mv_adjust_title'                => 'ضبط وقت البداية والنهاية',
	'mv_adjust_preview'              => 'عرض الضبط',
	'mv_adjust_preview_stop'         => 'إيقاف العرض المسبق',
	'mv_adjust_default_reason'       => 'ضبط واجهة ميتافيد',
	'mv_adjust_old_title_missing'    => 'الصفحة التي تحاول النقل منها ($1) غير موجودة',
	'mv_adjust_ok_move'              => 'نجاح، يتم الضبط...',
	'mv_start_desc'                  => 'وقت البداية',
	'mv_end_desc'                    => 'وقت النهاية',
	'mediasearch'                    => 'بحث الميديا',
	'mv_search_sel_t'                => 'اختر نوع البحث',
	'mv_run_search'                  => 'تنفيذ البحث',
	'mv_add_filter'                  => 'إضافة فلتر',
	'mv_search_match'                => 'بحث النص',
	'mv_search_spoken_by'            => 'قيل بواسطة',
	'mv_search_category'             => 'تصنيف',
	'mv_search_smw_property'         => 'خصائص سيمناتيك',
	'mv_search_smw_property_numeric' => 'قيمة سيمناتيك رقمية',
	'mv_search_and'                  => 'و',
	'mv_search_or'                   => 'أو',
	'mv_search_not'                  => 'ليس',
	'mv_search_stream_name'          => 'اسم الستريم',
	'mv_stream_name'                 => 'اسم الستريم',
	'mv_match'                       => 'مطابقة',
	'mv_spoken_by'                   => 'قيل بواسطة',
	'mv_category'                    => 'تصنيف',
	'mv_search_no_results'           => 'لا ميديا تطابق',
	'mv_media_matches'               => 'الميديا تطابق',
	'mv_remove_filter'               => 'إزالة الفلتر',
	'mv_advaced_search'              => 'بحث ميديا متقدم',
	'mv_expand_play'                 => 'تمديد وعرض',
	'mv_view_in_stream_interface'    => 'عرض في واجهة الستريم',
	'mv_view_wiki_page'              => 'عرض صفحة الويكي',
	'mv_error_mvd_not_found'         => 'خطأ إم في دي غير موجود',
	'mv_match_text'                  => '~  $1 مطابقة',
	'mv_edit_sequence'               => 'تعديل التتابع:$1',
	'mv_sequence_player_title'       => 'عرض التتابع',
	'mv_save_sequence'               => 'حفظ التتابع',
	'mv_sequence_page_desc'          => 'حفظ التتابع الحالي',
	'mv_sequence_add'                => 'إضافة كليبات',
	'mv_sequence_add_manual'         => 'إضافة بالاسم',
	'mv_sequence_add_manual_desc'    => 'إضافة الكليبات باسم الستريم',
	'mv_sequence_add_search'         => 'إضافة بالبحث',
	'mv_sequence_add_search_desc'    => 'إضافة الكليبات ببحث الميديا',
	'mv_seq_add_end'                 => 'إضافة إلى آخر التتابع',
	'mv_sequence_timeline'           => 'الخط الزمني للتتابع:',
	'mv_edit_sequence_desc_help'     => 'وصف التتابع<br />',
	'mv_edithelpsequence'            => 'Help:تعديل_التتابع',
	'mv_seq_summary'                 => 'ملخص تعديل التتابع',
	'mv_add_clip_by_name'            => 'إضافة الكليبات بالاسم',
	'mv_export_cmml'                 => 'صدر cmml',
	'mv_search_stream'               => 'بحث الستريم',
	'mv_navigate_stream'             => 'إبحار الستريم الكامل',
	'mv_embed_options'               => 'خيارات الإدراج',
	'mv_overlay'                     => 'التحكم بالتغطية',
	'mv_stream_tool_heading'         => 'أدوات الستريم',
	'mv_tool_missing'                => 'طلب الأداة ($1) غير موجود',
	'mv_bad_tool_request'            => 'سطر أداة سيء ينبغي أن يكون بالصيغة: اسم_الأداة|اسم_العرض_للأداة',
	'mv_search_stream_title'         => 'ابحث في الستريم الحالي',
	'mv_new_ht_en'                   => 'ترانسكريبت جديد',
	'mv_new_anno_en'                 => 'وسم أو أنوتاشن جديد',
);

/** Bulgarian (Български)
 * @author DCLXVI
 */
$messages['bg'] = array(
	'mv_duration_label'  => 'продължителност',
	'mv_save_changes'    => 'Съхранение на промените',
	'mv_remove_reason'   => 'Причина за изтриването:',
	'mv_upload_file'     => 'Качване на файл',
	'mv_external_file'   => 'Външен файл',
	'mv_tool_search'     => 'Търсене',
	'mv_tool_export'     => 'Изнасяне',
	'anno_en'            => 'Анотации и категории',
	'mv_data_page_title' => '$1 за $2 от $3',
	'mv_remove'          => 'премахване',
	'mv_remove_title'    => 'премахване на този сегмент от метаданни',
	'mv_start_desc'      => 'Начало',
	'mv_end_desc'        => 'Край',
	'mv_add_filter'      => 'Добавяне на филтър',
	'mv_search_category' => 'Категория',
	'mv_search_and'      => 'и',
	'mv_search_or'       => 'или',
	'mv_category'        => 'категория',
	'mv_remove_filter'   => 'премахване на филтър',
);

/** French (Français)
 * @author Grondin
 */
$messages['fr'] = array(
	'metavid'                        => 'Page metavid',
	'mv_missing_stream'              => 'Flux manquant : $1',
	'mv_ogg_low_quality'             => 'Flux ogg utilisable en ligne, hébergé sur metavid',
	'mv_ogg_high_quality'            => 'Flux ogg de haute qualité, hébergé sur metavid.',
	'mv_archive_org_link'            => 'Liens vers les originaux mpeg2 dans Archive.org',
	'mv_error_stream_missing'        => "<span class=\"error\">Erreur : il n'existe aucun flux vidéo associé avec cette metadonnée.</span><br /> Vous êtes prié de reporter ceci sur le site d'aministration.<br /> <i>L'interface de flux des métadonnées est désactivée</i>.",
	'mv_stream_meta'                 => 'Page de flux',
	'mv_add_stream'                  => "Ajout d'un flux metavid",
	'mv_edit_stream'                 => 'Modifier un flux metavid',
	'mv_add_stream_page'             => "Ajout d'un flux metavid",
	'mv_edit_strea_docu'             => "<b>Éditer l'administration des flux</b> <br /> pour qu'un utilisateur puisse voir ou éditer la page $1 de visualisation.",
	'mv_add_stream_docu'             => "<p>Ajouter un nouveau flux avec le champ ci-dessous.</p><p>Plus d'informations sont données sur <a href=\"\$1\">la page d'aide concernant l'ajout d'un flux.",
	'mv_add_stream_submit'           => 'Ajouter un flux',
	'mv_no_stream_files'             => 'Fichiers de flux inexistants.',
	'mv_edit_stream_files'           => 'Modifier les fichiers de flux',
	'mv_path_type_url_anx'           => 'Adresse internet complète du média',
	'mv_path_type_wiki_title'        => 'Titre wiki du media',
	'mv_path_type_label'             => 'type de chemin',
	'mv_base_offset_label'           => 'offset de base',
	'mv_duration_label'              => 'durée',
	'mv_file_desc_label'             => 'msg de desc du flux',
	'mv_delete_stream_file'          => 'référence du fichier de flux supprimé',
	'mv_save_changes'                => 'Sauvegarder les modifications',
	'mv_file_with_same_desc'         => 'Erreur : fichier de flux avec la même clef de description  <i>$1</i> déjà présente',
	'mv_updated_stream_files'        => 'Mise à jour des enregistrements des fichiers de flux',
	'mv_removed_file_stream'         => 'Fichier de flux retiré : $1',
	'mv_missing_stream_text'         => 'Le flux <b>$1</b> que vous avez demandé n\'est pas disponible.<br />Il vous est permis de consulter la <a href="$2">Liste des flux</a><br />Ou bien être autorisé à <a href="$3">Ajouter le flux</a>',
	'mv_add_stream_file'             => 'Ajouter un fichier de flux',
	'mv_media_path'                  => 'chemin du média',
	'mv_file_list'                   => 'Fichiers de flux',
	'mv_label_stream_name'           => 'Nom du flux',
	'mv_label_stream_desc'           => 'Description du flux',
	'add_stream_permission'          => "Il ne vous est pas permis d'ajouter un nouveau flux",
	'edit_stream_missing'            => 'Nom du flux manquant',
	'mv_stream_already_exists'       => 'Le flux <a href="$2">$1</a> existe déjà',
	'mv_summary_add_stream'          => 'flux ajouté par un formulaire',
	'mv_error_stream_insert'         => "échec pour l'insertion du flux",
	'mv_redirect_and_delete_reason'  => 'page de redirection enlevée',
	'mv_remove_reason'               => 'Motif de la suppression :',
	'mv_stream_delete_warrning'      => '<b>La suppression de ce flux enlèvera également $1 parties des métadonnées associées</b><br />',
	'mv_label_stream_type'           => 'Type de flux',
	'mv_metavid_file'                => 'Fichier existant sur le serveur',
	'mv_metavid_live'                => 'Installer le flux en direct',
	'mv_upload_file'                 => 'Télécharger le fichier',
	'mv_external_file'               => 'Fichier externe',
	'mv_stream_delete_warning'       => 'Supprimer ce flux enlèvera en plus $1 pages de métadonnées',
	'mv_tool_search'                 => 'Rechercher',
	'mv_tool_search_title'           => 'Rechercher dans ce flux',
	'mv_tool_navigate'               => 'Naviguer',
	'mv_tool_navigate_title'         => 'Naviguer dans le flux entier',
	'mv_tool_export'                 => 'Exporter',
	'mv_tool_export_title'           => 'Exporter les métadonnées du flux',
	'mv_tool_embed'                  => 'Inclure',
	'mv_tool_embed_title'            => "Inclure les options pour l'actuel segment demandé",
	'mv_tool_overlay'                => 'Présentations du modèle',
	'mv_tool_overlay_title'          => 'Présentations du modèle sur la base des métadonnées',
	'mv_results_found_for'           => 'Résultats de la recherche <b>$1</b> vers <b>$2</b> de <b>$3</b> pour :',
	'ht_en'                          => 'Transcrire',
	'ht_en_desc'                     => 'Transcriptions anglaises. Ce type de présentation est pour le texte qui est parlé avec le flux vidéo. Des liens peuvent êtres ajoutés, mais tout texte devrait être en corrélation avec ce qui est dit dans le flux vidéo.',
	'anno_en'                        => 'Annotations et catégories',
	'anno_en_desc'                   => 'Annotations et catégorisation anglaises. Cette présentation peut être utilisée pour « baliser »  ou catégoriser des sections de vidéo ou pour ajouter des annotations qui ne sont pas du texte parlé.',
	'mv_data_page_title'             => '$1 pour $2 à partir de $3',
	'mv_time_separator'              => '$1 vers $2',
	'mv_list_streams'                => 'Liste des flux de metavid',
	'mv_list_streams_page'           => 'Liste des flux de metavid',
	'mv_list_streams_docu'           => 'Le flux suivant existe :',
	'mv_list_streams_none'           => "Aucun flux n'existe",
	'mvvideofeed'                    => "Alimentation de l'export de la vidéo metavid",
	'video_feed_cat'                 => 'Alimentation de la vidéo pour la catégorie :',
	'mv_cat_search_note'             => 'Note : les catégories ne listent que celles du niveau le plus haut, pour toute recherche de métadonnées dans les groupes de catégories pour $1',
	'mv_mvd_linkback'                => 'Partie du flux $1 <br />Saut vers le visionnement du flux : $2<br />',
	'mvBadMVDtitle'                  => 'type manquant, flux manquant, ou format de durée non conforme.',
	'mvMVDFormat'                    => 'Le titre de metavid devrait être au format : mvd:type:nom_du_flux/durée_commencement/durée_fin',
	'mv_play'                        => 'Jouer',
	'mv_edit'                        => 'Modifier',
	'mv_history'                     => 'Historique',
	'mv_history_title'               => "Édition et historique de l'alignement vidéo",
	'mv_edit_title'                  => 'Modifier le texte',
	'mv_edit_adjust_title'           => "Modifier le texte et l'alignement vidéo",
	'mv_remove'                      => 'enlever',
	'mv_remove_title'                => 'enlever ce segment de métadonnées',
	'mv_adjust'                      => 'ajuster',
	'mv_adjust_submit'               => "Sauvegarder l'ajustement",
	'mv_adjust_title'                => 'Ajuster le début et la fin de la durée',
	'mv_adjust_preview'              => "Prévisualiser l'ajustement",
	'mv_adjust_preview_stop'         => 'Arrêter la prévisualisation',
	'mv_adjust_default_reason'       => "Ajustement de l'interface metavid",
	'mv_adjust_old_title_missing'    => "La page que vous êtes en train de déplacer depuis ($1) n'existe pas.",
	'mv_adjust_ok_move'              => 'Succès, ajustement...',
	'mv_start_desc'                  => 'Durée au départ',
	'mv_end_desc'                    => 'Durée à la fin',
	'mediasearch'                    => 'Recherche du média',
	'mv_search_sel_t'                => 'Choisir le mode de recherche',
	'mv_run_search'                  => 'Lancer la recherche',
	'mv_add_filter'                  => 'Ajouter un filtre',
	'mv_search_match'                => 'Rechercher le texte',
	'mv_search_spoken_by'            => 'Parlé par',
	'mv_search_category'             => 'Catégorie',
	'mv_search_smw_property'         => 'Propriété de Semantic',
	'mv_search_smw_property_numeric' => 'Valeur numéric de Semantic',
	'mv_search_and'                  => 'et',
	'mv_search_or'                   => 'ou',
	'mv_search_not'                  => 'non',
	'mv_search_stream_name'          => 'Nom du flux',
	'mv_stream_name'                 => 'nom du flux',
	'mv_match'                       => 'assortir',
	'mv_spoken_by'                   => 'parlé par',
	'mv_category'                    => 'catégorie',
	'mv_search_no_results'           => 'Aucun média assorti',
	'mv_media_matches'               => 'Médias assortis',
	'mv_remove_filter'               => 'enlever le filtre',
	'mv_advaced_search'              => 'Recherche avancée de médias',
	'mv_expand_play'                 => 'Développer et jouer en ligne',
	'mv_view_in_stream_interface'    => "Voir dans l'interface du flux",
	'mv_view_wiki_page'              => 'Voir la page wiki',
	'mv_error_mvd_not_found'         => 'Erreur, aucune metavid de trouvée',
	'mv_match_text'                  => '~ $1 similitudes',
	'mv_edit_sequence'               => 'Édition de la séquence : $1',
	'mv_sequence_player_title'       => 'lecteur de séquence',
	'mv_save_sequence'               => 'Sauvegarder la séquence',
	'mv_sequence_page_desc'          => 'Sauvegarder la séquence actuelle',
	'mv_sequence_add'                => 'Ajouter des clips',
	'mv_sequence_add_manual'         => 'Ajouter par nom',
	'mv_sequence_add_manual_desc'    => 'Ajouter des clips par nom de flux',
	'mv_sequence_add_search'         => 'Ajouter par recherche',
	'mv_sequence_add_search_desc'    => 'Ajouter des clips par recherche de médias',
	'mv_seq_add_end'                 => 'Ajouter à la fin de la séquence',
	'mv_sequence_timeline'           => 'Séquence chronologique :',
	'mv_edit_sequence_desc_help'     => 'Description de la séquence<br />',
	'mv_edithelpsequence'            => 'Aide:Édition_de_séquence',
	'mv_seq_summary'                 => 'Édition du sommaire de la séquence',
	'mv_add_clip_by_name'            => 'Ajouter un clip par nom',
	'mv_export_cmml'                 => 'exporter cmml',
	'mv_search_stream'               => 'Rechercher le flux',
	'mv_navigate_stream'             => 'Naviguer dans le flux entier',
	'mv_embed_options'               => "Option d'incrustation",
	'mv_overlay'                     => 'Controles de courverture',
	'mv_stream_tool_heading'         => 'Outils pour les flux',
	'mv_tool_missing'                => "la requête de l'outil ($1) n'existe pas",
	'mv_bad_tool_request'            => 'une mauvaise ligne de commande pourrait être formulée : nom_outil|affichage_nom_outil',
	'mv_search_stream_title'         => 'Rechercher le flux actuel',
	'mv_new_ht_en'                   => 'Nouvelle transcription',
	'mv_new_anno_en'                 => 'Nouvelle balise ou annotation',
);

/** Dutch (Nederlands)
 * @author Siebrand
 * @author SPQRobin
 */
$messages['nl'] = array(
	'metavid'                        => 'Metavid-pagina',
	'mv_missing_stream'              => 'Stream niet aanwezig: $1',
	'mv_ogg_low_quality'             => 'Via het web te streamen ogg theora, gehost op metavid',
	'mv_ogg_high_quality'            => 'Hoge kwaliteit ogg theora, gehost op metavid',
	'mv_archive_org_link'            => 'Links naar de originele mpeg2 op Archive.org',
	'mv_error_stream_missing'        => '<span class="error">Fout: Er is geen videostream gekoppeld aan deze metadata.</span><br />Rapporteer dit alstublieft aan de sitebeheerder.<br /><i>De streammetadatainterface is uitgeschakeld</i>',
	'mv_stream_meta'                 => 'Streampagina',
	'mv_add_stream'                  => 'Metavd stream toevoegen',
	'mv_edit_stream'                 => 'Metavid-stream bewerken',
	'mv_add_stream_page'             => 'Metavid-stream toevoegen',
	'mv_edit_strea_docu'             => '<p>Stream bewerken <b>beheerder</b><br />voor bekijken/bewerken als normale gebruikers, zie pagina $1',
	'mv_add_stream_docu'             => '<p>Voeg met het onderstaande veld een nieuwe stream toe.</p><p>Meer information staat op de <a href="$1">helppagina voor het toevoegen van een stream</a>.</p>',
	'mv_add_stream_submit'           => 'Stream toevoegen',
	'mv_no_stream_files'             => 'Er zijn geen streambestanden',
	'mv_edit_stream_files'           => 'Streambestanden bewerken',
	'mv_path_type_url_anx'           => 'volledige media-url',
	'mv_path_type_wiki_title'        => 'wiki medianaam',
	'mv_duration_label'              => 'duur',
	'mv_delete_stream_file'          => 'streambestandsreferentie verwijderen',
	'mv_save_changes'                => 'Wijzigingen opslaan',
	'mv_file_with_same_desc'         => 'Fout: er bestaat al een streambestand met dezelfde sleutel ($1)',
	'mv_removed_file_stream'         => 'Streambestand $1 is verwijderd',
	'mv_missing_stream_text'         => 'De stream die u heeft opgevraagd (<b>$1</b>) is niet beschikbaar.<br />U kunt de <a href="$2">streamlijst</a> bekijken of u kunt <a href="$3">de stream toevoegen</a>.',
	'mv_add_stream_file'             => 'Streambestand toevoegen',
	'mv_media_path'                  => 'medialocatie',
	'mv_file_list'                   => 'Streambestanden',
	'mv_label_stream_name'           => 'Streamnaam',
	'mv_label_stream_desc'           => 'Streambeschrijving',
	'add_stream_permission'          => 'U heeft geen rechten om een nieuwe stream toe te voegen',
	'edit_stream_missing'            => 'De streamname mist',
	'mv_stream_already_exists'       => 'De stream <a href="$2">$1</a> bestaat al',
	'mv_summary_add_stream'          => 'stream toegevoegd via formulier',
	'mv_error_stream_insert'         => 'de stream kon niet ingevoegd worden',
	'mv_redirect_and_delete_reason'  => 'de doorverwijspagina is verwijderd',
	'mv_remove_reason'               => 'Reden voor verwijdering:',
	'mv_stream_delete_warrning'      => '<b>Met het verwijderen van deze stream, worden ook $1 gerelateerde metadata-onderdelen verwijderd</b><br />',
	'mv_label_stream_type'           => 'Streamtype',
	'mv_metavid_file'                => 'Bestand bestaat op server',
	'mv_metavid_live'                => 'Livestream opzetten',
	'mv_upload_file'                 => 'Bestand uploaden',
	'mv_external_file'               => 'Extern bestand',
	'mv_stream_delete_warning'       => "Met deze stream worden ook $1 pagina's metadata verwijderd",
	'mv_tool_search'                 => 'Zoeken',
	'mv_tool_search_title'           => 'Binnen deze stream zoeken',
	'mv_tool_navigate'               => 'Navigatie',
	'mv_tool_navigate_title'         => 'Volledige stream navigeren',
	'mv_tool_export'                 => 'Exporteren',
	'mv_tool_export_title'           => 'Streammetadata exporteren',
	'mv_tool_overlay_title'          => 'Sjabloongebaseerde overlay voor metadata',
	'mv_results_found_for'           => 'Zoekresultaten <b>$1</b> tot <b>$2</b> van <b>$3</b> voor:',
	'ht_en_desc'                     => 'Engelstalige transcripties. Dit type overlay is voor gesproken tekst in een videastream. U kan links toevoegen, maar alle tekst moet gesproken worden in de videostream.',
	'anno_en'                        => 'Annotaties en categorieën',
	'anno_en_desc'                   => 'Engelstalige categorisatie en annotatie. Deze overlay is te gebruiken voor het \\"taggen\\"/categoriseren van delen van video\'s of om anootaties voor niet-gesproken tekst toe te voegen',
	'mv_data_page_title'             => '$1 voor $2 van $3',
	'mv_time_separator'              => '$1 naar $2',
	'mv_list_streams_docu'           => 'De volgende streams zijn beschikbaar:',
	'mv_list_streams_none'           => 'Er zijn geen streams',
	'mvvideofeed'                    => 'Metavid videofeed exporteren',
	'video_feed_cat'                 => 'Videofeed voor categorie:',
	'mv_cat_search_note'             => 'Let op: alleen ondercategorieën van het eerste niveau worden getoond. Zoek naar $1 om alle metadata in een reeks categorieën te bekijken.',
	'mv_mvd_linkback'                => 'Onderdeel van stream $1<br />Stream bekijken: $2<br />',
	'mvBadMVDtitle'                  => 'type of stream niet aanwezig, of onjuiste tijdsnotatie',
	'mv_play'                        => 'Afspelen',
	'mv_edit'                        => 'Bewerken',
	'mv_history'                     => 'Geschiedenis',
	'mv_edit_title'                  => 'Tekst bewerken',
	'mv_remove'                      => 'verwijderen',
	'mv_remove_title'                => 'dit metadatasegment verwijderen',
	'mv_adjust'                      => 'aanpassen',
	'mv_adjust_submit'               => 'Aanpassing opslaan',
	'mv_adjust_title'                => 'Begin- en eindtijd aanpassen',
	'mv_adjust_preview'              => 'Aanpassing bekijken',
	'mv_adjust_preview_stop'         => 'Proefvertoning afbreken',
	'mv_adjust_ok_move'              => 'Geslaagd. Bezig met aanpassen...',
	'mv_start_desc'                  => 'Begintijd',
	'mv_end_desc'                    => 'Eindtijd',
	'mediasearch'                    => 'Media zoeken',
	'mv_search_sel_t'                => 'Selecteer zoektype',
	'mv_run_search'                  => 'Zoekopdracht uitvoeren',
	'mv_add_filter'                  => 'Filter toevoegen',
	'mv_search_match'                => 'Tekst zoeken',
	'mv_search_spoken_by'            => 'Gesproken door',
	'mv_search_category'             => 'Categorie',
	'mv_search_smw_property'         => 'Semantische eigenschappen',
	'mv_search_smw_property_numeric' => 'Numerieke semantische waarde',
	'mv_search_and'                  => 'en',
	'mv_search_or'                   => 'of',
	'mv_search_not'                  => 'niet',
	'mv_search_stream_name'          => 'Streamnaam',
	'mv_stream_name'                 => 'streamnaam',
	'mv_spoken_by'                   => 'gesproken door',
	'mv_category'                    => 'categorie',
	'mv_search_no_results'           => 'Geen media gevonden',
	'mv_media_matches'               => 'Gevonden media',
	'mv_remove_filter'               => 'filter verwijderen',
	'mv_advaced_search'              => 'Media zoeken (uitgebreid)',
	'mv_view_wiki_page'              => 'Wikipagina bekijken',
	'mv_match_text'                  => '~ $1 resultaten',
	'mv_save_sequence'               => 'Reeks opslaan',
	'mv_sequence_page_desc'          => 'Huidige reeks opslaan',
	'mv_sequence_add'                => 'Clips toevoegen',
	'mv_sequence_add_manual'         => 'Op naam toevoegen',
	'mv_sequence_add_manual_desc'    => 'Clips toevoegen op streamnaam',
	'mv_sequence_add_search'         => 'Via zoeken toevoegen',
	'mv_sequence_add_search_desc'    => 'Clips toevoegen via een mediazoekopdracht',
	'mv_edit_sequence_desc_help'     => 'Beschrijving reeks<br />',
	'mv_seq_summary'                 => 'Bewerkingssamenvatting reeks',
	'mv_add_clip_by_name'            => 'Clip toevoegen op naam',
	'mv_search_stream'               => 'Stream zoeken',
	'mv_navigate_stream'             => 'Door volledige stream navigeren',
	'mv_embed_options'               => 'Embedinstellingen',
	'mv_overlay'                     => 'Overlay-instellingen',
	'mv_stream_tool_heading'         => 'Extra',
	'mv_search_stream_title'         => 'Zoeken in de huidige stream',
	'mv_new_ht_en'                   => 'Nieuwe transcriptie',
	'mv_new_anno_en'                 => 'Nieuwe tag of annotatie',
);

