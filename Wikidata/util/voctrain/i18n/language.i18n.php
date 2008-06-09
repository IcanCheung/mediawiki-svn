<?php

# messages for voctrain
# now mediawiki style -ish

# Words starting with '%' (ie %action, or %questions_total) are
# "variable names", for use by the program. Don't translate those!

$fallback=array(
	"en"=>false,
	"nl"=>"en",
	"fi"=>"en",
	"nap"=>"en"
);

$messages=array();

/** English */
$messages['en'] = array(
	"voctrain_Hello_World"=>"HELLO WIKI!",
	"voctrain_Permission_Denied"=>"Permission Denied",
	"voctrain_try_again_"=>"try again?",
	"voctrain_Action_unknown"=>"Action unknown",
	"voctrain_I_don_t_know_what_to_do_with_action_" =>
		"I don't know what to do with '%action'.",
	"voctrain_User_added" => "User added",
	"voctrain_Hello_username_welcome_to_the_omega_language_trainer" => 
		"Hello, %username, welcome to the omega language trainer",
	"voctrain_continue"=>"continue",
	"voctrain_hello_place"=>"hello there %place",
	"voctrain_bye"=>"goodbye",
	"voctrain_Set_up_your_exercise"=>"Set up your exercise",
	"voctrain_Number_of_questions"=>"Number of questions",
	"voctrain_Languages"=>"Languages",
	"voctrain_Please_specify_the_languages_you_want_to_test_in"=>"Please specify the languages you want to test in",
	"voctrain_eg_eng_for_English_deu_for_Deutch_German_"=>"(eg, eng for English, deu for German).",
	"voctrain_Depending_on_your_test_set_some_combinations_might_work_better_than_others_"=>"Depending on your test set, some combinations might work better than others.",
	"voctrain_Questions"=>"Questions",
	"voctrain_Answers"=>"Answers",
	"voctrain_start_exercise"=>"start exercise",
	"voctrain_collection"=>"collection",
	"voctrain_ISO_639_3_format"=>"ISO-639-3 format",
	"voctrain_There_are_questions_remaining_questions_remaining_out_of_a_total_of_questions_total_"=>"There are %questions_remaining questions remaining, out of a total of %questions_total.",
	"voctrain_Definition"=>"Definition",
	"voctrain_Dictionary_definition_to_help_you"=>"Dictionary definition to help you",
	"voctrain_Word"=>"Word",
	"voctrain_Please_type_your_answer_here"=>"Please type your answer here",
	"voctrain_submit_answer"=>"submit answer",
	"voctrain_peek"=>"peek",
	"voctrain_skip"=>"skip",
	"voctrain_I_know_it_do_not_ask_again"=>"I know it/do not ask again",
	"voctrain_abort_exercise"=>"abort exercise",
	"voctrain_list_answers"=>"list answers",
	"voctrain_Question"=>"Question",
	"voctrain_The_word_to_translate"=>"The word to translate",
	"voctrain_Answer"=>"Answer",
	"voctrain_one_of"=>"one of",
	"voctrain_list_of_questions_and_answers"=>"list of questions and answers",
	"voctrain_Answer_s_"=>"Answer(s)",
	"voctrain_logout"=>"logout",
	"voctrain_Powered_by"=>"Powered by",
	"voctrain_Omegawiki"=>"Omegawiki",
	"voctrain_Exercise_complete"=>"Exercise complete",
	"voctrain_Exercise_terminated"=>"Exercise terminated",
	"voctrain_Start_a_new_exercise"=>"Start a new exercise",
	"voctrain_User_name"=>"User name",
	"voctrain_Password"=>"Password",
	"voctrain_Login"=>"Login",
	"voctrain_Create_new_user"=>"Create new user",
	"voctrain_Switch_language"=>"Switch language",
	"voctrain_Language"=>"Language",
	"voctrain_Log_in"=>"Log in",
	"voctrain_Omegawiki_vocabulary_trainer"=>"Omegawiki vocabulary trainer",
	"voctrain_Definitions"=>"Definitions",
	"voctrain_Could_not_create_new_user"=>"Could not create new user",
	"voctrain_Type_a_username_and_optional_password_or_try_a_different_username_"=>"Type a username and optional password, (or try a different username)"
);

/** Message documentation */

$messages['qqq'] = array(
	"voctrain_Hello_World"=>"Test message",
	"voctrain_Permission_Denied"=>"login: access is denied",
	"voctrain_try_again_"=>"An operation failed, link back to normal voctrainer (used in multiple locations)",
	"voctrain_Action_unknown"=>"Action unknown: Page title",
	"voctrain_I_don_t_know_what_to_do_with_action_" =>
		"Action unknown: body text of page (don't translate %action).",
	"voctrain_User_added" => "login: title of User added page",
	"voctrain_Hello_username_welcome_to_the_omega_language_trainer" => 
		"login: Greeting when user created. (Don't translate %username)",
	"voctrain_continue"=>"continue operation (used in multiple locations)",
	"voctrain_hello_place"=>"Test message (don't translate %place)",
	"voctrain_bye"=>"Test message",
	"voctrain_Set_up_your_exercise"=>"setup: Page title",
	"voctrain_Number_of_questions"=>"setup: subheading",
	"voctrain_Languages"=>"Languages",
	"voctrain_Please_specify_the_languages_you_want_to_test_in"=>"Setup:text the in refers to '...in iso-693-3 format'",
	"voctrain_eg_eng_for_English_deu_for_Deutch_German_"=>"Setup:text",
	"voctrain_Depending_on_your_test_set_some_combinations_might_work_better_than_others_"=>"setup:text",
	"voctrain_Questions"=>"Questions",
	"voctrain_Answers"=>"Answers",
	"voctrain_start_exercise"=>"button:start exercise",
	"voctrain_collection"=>"a wikidata collection",
	"voctrain_ISO_639_3_format"=>"ISO-639-3 format",
	"voctrain_There_are_questions_remaining_questions_remaining_out_of_a_total_of_questions_total_"=>"exercise: status at top of page (don't translate %questions_remaining and %questions_total)",
	"voctrain_Definition"=>"exercise: subheading",
	"voctrain_Dictionary_definition_to_help_you"=>"exercise: text",
	"voctrain_Word"=>"exercise: subheading",
	"voctrain_Please_type_your_answer_here"=>"exercise: text",
	"voctrain_submit_answer"=>"exercise: button: Button by which the user submits their answer, which will be checked (and scored).",
	"voctrain_peek"=>"exercise: button",
	"voctrain_skip"=>"exercise: button",
	"voctrain_I_know_it_do_not_ask_again"=>"exercise: button",
	"voctrain_abort_exercise"=>"exercise: button",
	"voctrain_list_answers"=>"exercise: button",
	"voctrain_Question"=>"Question",
	"voctrain_The_word_to_translate"=>"The word to translate",
	"voctrain_Answer"=>"Answer",
	"voctrain_one_of"=>"one of",
	"voctrain_list_of_questions_and_answers"=>"list: heading",
	"voctrain_Answer_s_"=>"list: table header",
	"voctrain_logout"=>"logout button on all pages",
	"voctrain_Powered_by"=>"footer: Powered by",
	"voctrain_Omegawiki"=>"footer: Omegawiki",
	"voctrain_Exercise_complete"=>"end exercise: page heading",
	"voctrain_Exercise_terminated"=>"end exercise: page heading",
	"voctrain_Start_a_new_exercise"=>"end exercise: Start a new exercise",
	"voctrain_User_name"=>"login: User name",
	"voctrain_Password"=>"login: Password",
	"voctrain_Login"=>"login: button",
	"voctrain_Create_new_user"=>"login: button",
	"voctrain_Switch_language"=>"login: button",
	"voctrain_Language"=>"login: label",
	"voctrain_Log_in"=>"login: header",
	"voctrain_Omegawiki_vocabulary_trainer"=>"login: header"
);

/** Finnish (Suomi) */
$messages['fi'] = array(
	'voctrain_Languages' => 'Kielet',
);

/** Neapolitan (Nnapulitano) */
$messages['nap'] = array(
	'voctrain_Hello_World'                                                                          => 'SALUTAMMO!',
	'voctrain_Permission_Denied'                                                                    => "Nun tieni 'e diritte",
	'voctrain_try_again_'                                                                           => "vuò pruvà n'ata vota?",
	'voctrain_Action_unknown'                                                                       => 'Azzione nun è canasciuta',
	'voctrain_I_don_t_know_what_to_do_with_action_'                                                 => "Nun saccio c'aggio fà cu '%action'.",
	'voctrain_User_added'                                                                           => 'Utente aggiunto',
	'voctrain_Hello_username_welcome_to_the_omega_language_trainer'                                 => "Bemmenuto %username 'o Omega Language Trainer.",
	'voctrain_continue'                                                                             => 'va annanz',
	'voctrain_hello_place'                                                                          => 'salutammo %place',
	'voctrain_bye'                                                                                  => 'statte bbuono',
	'voctrain_Set_up_your_exercise'                                                                 => "Prugramma chillo che tiene 'a ffà",
	'voctrain_Number_of_questions'                                                                  => "Número 'e dumanne",
	'voctrain_Languages'                                                                            => 'Lengue',
	'voctrain_Please_specify_the_languages_you_want_to_test_in'                                     => "Nzerisce 'e lengue che vô mparà",
	'voctrain_eg_eng_for_English_deu_for_Deutch_German_'                                            => '(asempio: eng pe English (ngrese), deu per Deutsch (germanese))',
	'voctrain_Depending_on_your_test_set_some_combinations_might_work_better_than_others_'          => "Secunno 'e lengue ca vô mparà nce stanno coppie 'e lengue ca funzionano meglio 'e ll'ate.",
	'voctrain_Questions'                                                                            => 'Dumanne',
	'voctrain_Answers'                                                                              => 'Risposte',
	'voctrain_start_exercise'                                                                       => "Ncummincia 'e mparà",
	'voctrain_collection'                                                                           => 'collezzióne',
	'voctrain_ISO_639_3_format'                                                                     => 'Furmato ISO-639-3',
	'voctrain_There_are_questions_remaining_questions_remaining_out_of_a_total_of_questions_total_' => "Tieni 'e ffà ncora %questions_remaining dumanne 'e cumpressivamiente %questions_total dumanne.",
	'voctrain_Definition'                                                                           => 'Definizzióne',
	'voctrain_Dictionary_definition_to_help_you'                                                    => 'Definizzióne d&#39;&#39;o dizzionario pe te aiutà',
	'voctrain_Word'                                                                                 => 'Paróla',
	'voctrain_Please_type_your_answer_here'                                                         => "Nzerisce 'a respuosta toja ccà",
	'voctrain_submit_answer'                                                                        => "Cunferma 'a respuosta",
	'voctrain_peek'                                                                                 => "Guarda 'a respuosta",
	'voctrain_skip'                                                                                 => 'passa annanz',
	'voctrain_I_know_it_do_not_ask_again'                                                           => "'O cunosco/num me dummanà cciù.",
	'voctrain_abort_exercise'                                                                       => "firnisce 'e mparà",
	'voctrain_list_answers'                                                                         => "Fa vedè a lista 'e respuoste",
	'voctrain_Question'                                                                             => 'Dumanna',
	'voctrain_The_word_to_translate'                                                                => "'A pparola ca s'ha ddà traducere",
	'voctrain_Answer'                                                                               => 'Respuosta',
	'voctrain_one_of'                                                                               => "uno 'e",
	'voctrain_list_of_questions_and_answers'                                                        => "lista 'e dumanne e rispuoste",
	'voctrain_Answer_s_'                                                                            => 'Rispuosta/e',
	'voctrain_logout'                                                                               => 'jésce',
	'voctrain_Powered_by'                                                                           => "Cu suppuorto 'e",
	'voctrain_Omegawiki'                                                                            => 'OmegaWiki',
	'voctrain_Exercise_complete'                                                                    => 'Dumanne cumprete',
	'voctrain_Exercise_terminated'                                                                  => 'Dumanne fernute',
	'voctrain_Start_a_new_exercise'                                                                 => "Mpara n'ata vota cu ate dumanne",
	'voctrain_User_name'                                                                            => 'Nomme utente',
	'voctrain_Password'                                                                             => 'Parola cchiave',
	'voctrain_Login'                                                                                => 'Trase',
	'voctrain_Create_new_user'                                                                      => "Cria n'utente nuovo",
	'voctrain_Switch_language'                                                                      => 'Cagna lengua',
	'voctrain_Language'                                                                             => 'Lengua',
	'voctrain_Log_in'                                                                               => 'Trase',
	'voctrain_Omegawiki_vocabulary_trainer'                                                         => 'Prugramma pe mparà e vucabbole - OmegaWiki',
	'voctrain_Definitions'                                                                          => 'Definizzione',
	'voctrain_Could_not_create_new_user'                                                            => "Nun putevo crià n'utente nuovo",
	'voctrain_Type_a_username_and_optional_password_or_try_a_different_username_'                   => "Nzerisci nu nomme pe utente e na pparola cchiave (o ppruva 'e trasere cu nu nomme utente deverzo)",
);

/** Dutch (Nederlands) */
$messages['nl'] = array(
	'voctrain_Hello_World'                                                                          => 'HALLO WIKI!',
	'voctrain_Permission_Denied'                                                                    => 'Toestemming geweigerd',
	'voctrain_try_again_'                                                                           => 'opnieuw proberen?',
	'voctrain_Action_unknown'                                                                       => 'Actie onbekend',
	'voctrain_I_don_t_know_what_to_do_with_action_'                                                 => "Het is niet duidelijk wat te doen met '%action'.",
	'voctrain_User_added'                                                                           => 'Gebruiker toegevoegd',
	'voctrain_Hello_username_welcome_to_the_omega_language_trainer'                                 => 'Hallo, %username. Welkom bij de omega taaltrainer',
	'voctrain_continue'                                                                             => 'doorgaan',
	'voctrain_hello_place'                                                                          => 'hallo daar %place',
	'voctrain_bye'                                                                                  => 'tot ziens',
	'voctrain_Set_up_your_exercise'                                                                 => 'Uw oefening opstellen',
	'voctrain_Number_of_questions'                                                                  => 'Aantal vragen',
	'voctrain_Languages'                                                                            => 'Talen',
	'voctrain_Please_specify_the_languages_you_want_to_test_in'                                     => 'Geef alstublieft de talen op waarin u wilt oefenen',
	'voctrain_eg_eng_for_English_deu_for_Deutch_German_'                                            => '(bijvoorbeeld eng voor het Engels en deu voor Duits).',
	'voctrain_Depending_on_your_test_set_some_combinations_might_work_better_than_others_'          => 'Afhankelijk van uw testset, werken sommige combinaties beter dan anderen.',
	'voctrain_Questions'                                                                            => 'Vragen',
	'voctrain_Answers'                                                                              => 'Antwoorden',
	'voctrain_start_exercise'                                                                       => 'oefening starten',
	'voctrain_collection'                                                                           => 'collectie',
	'voctrain_ISO_639_3_format'                                                                     => 'ISO-639-3 formaat',
	'voctrain_There_are_questions_remaining_questions_remaining_out_of_a_total_of_questions_total_' => 'Er zijn nog %questions_remaining vragen over, uit een totaal van %questions_total.',
	'voctrain_Definition'                                                                           => 'Definitie',
	'voctrain_Dictionary_definition_to_help_you'                                                    => 'Woordenboekdefinitie om u te helpen',
	'voctrain_Word'                                                                                 => 'Woord',
	'voctrain_Please_type_your_answer_here'                                                         => 'Geef hier uw antwoord in.',
	'voctrain_submit_answer'                                                                        => 'antwoord controleren',
	'voctrain_peek'                                                                                 => 'spieken',
	'voctrain_skip'                                                                                 => 'overslaan',
	'voctrain_I_know_it_do_not_ask_again'                                                           => 'Ik weet dit antwoord/vraag niet nogmaals',
	'voctrain_abort_exercise'                                                                       => 'Oefening afbreken',
	'voctrain_list_answers'                                                                         => 'antwoordlijst',
	'voctrain_Question'                                                                             => 'Vraag',
	'voctrain_The_word_to_translate'                                                                => 'Het te vertalen woord',
	'voctrain_Answer'                                                                               => 'Antwoord',
	'voctrain_one_of'                                                                               => 'een van',
	'voctrain_list_of_questions_and_answers'                                                        => 'lijst van vragen en antwoorden',
	'voctrain_Answer_s_'                                                                            => 'Antwoord(en)',
	'voctrain_logout'                                                                               => 'uitloggen',
	'voctrain_Powered_by'                                                                           => 'Aangedreven door',
	'voctrain_Exercise_complete'                                                                    => 'Oefening voltooid',
	'voctrain_Exercise_terminated'                                                                  => 'Oefening afgebroken',
	'voctrain_Start_a_new_exercise'                                                                 => 'Nieuwe oefening starten',
	'voctrain_User_name'                                                                            => 'Gebruikersnaam',
	'voctrain_Password'                                                                             => 'Wachtwoord',
	'voctrain_Login'                                                                                => 'Aanmelden',
	'voctrain_Create_new_user'                                                                      => 'Nieuwe gebruiker aanmaken',
	'voctrain_Switch_language'                                                                      => 'Taal wijzigen',
	'voctrain_Language'                                                                             => 'Taal',
	'voctrain_Log_in'                                                                               => 'Aanmelden',
	'voctrain_Omegawiki_vocabulary_trainer'                                                         => 'OmegaWiki woordenschat trainer',
	'voctrain_Definitions'                                                                          => 'Definities',
	'voctrain_Could_not_create_new_user'                                                            => 'Kon geen nieuwe gebruiker aanmaken',
	'voctrain_Type_a_username_and_optional_password_or_try_a_different_username_'                   => 'Typ een gebruikersnaam en (facultatief) paswoord, (of probeer een andere gebruikersnaam)',
);

