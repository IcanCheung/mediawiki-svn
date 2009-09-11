<?php
/**
 * OpenID.i18n.php -- Interface messages for OpenID for MediaWiki
 * Copyright 2006,2007 Internet Brands (http://www.internetbrands.com/)
 * Copyright 2007,2008 Evan Prodromou <evan@prodromou.name>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @author Evan Prodromou <evan@prodromou.name>
 * @addtogroup Extensions
 */

$messages = array();

/** English
 * @author Evan Prodromou <evan@prodromou.name>
 */
$messages['en'] = array(
	'openid-desc' => 'Login to the wiki with an [http://openid.net/ OpenID], and login to other OpenID-aware web sites with a wiki user account',
	'openidlogin' => 'Login with OpenID',
	'openidfinish' => 'Finish OpenID login',
	'openidserver' => 'OpenID server',
	'openidxrds' => 'Yadis file',
	'openidconvert' => 'OpenID converter',
	'openiderror' => 'Verification error',
	'openiderrortext' => 'An error occured during verification of the OpenID URL.',
	'openidconfigerror' => 'OpenID configuration error',
	'openidconfigerrortext' => 'The OpenID storage configuration for this wiki is invalid.
Please consult an [[Special:ListUsers/sysop|administrator]].',
	'openidpermission' => 'OpenID permissions error',
	'openidpermissiontext' => 'The OpenID you provided is not allowed to login to this server.',
	'openidcancel' => 'Verification cancelled',
	'openidcanceltext' => 'Verification of the OpenID URL was cancelled.',
	'openidfailure' => 'Verification failed',
	'openidfailuretext' => 'Verification of the OpenID URL failed. Error message: "$1"',
	'openidsuccess' => 'Verification succeeded',
	'openidsuccesstext' => 'Verification of the OpenID URL succeeded.',
	'openidusernameprefix' => 'OpenIDUser',
	'openidserverlogininstructions' => 'Enter your password below to log in to $3 as user $2 (user page $1).',
	'openidtrustinstructions' => 'Check if you want to share data with $1.',
	'openidallowtrust' => 'Allow $1 to trust this user account.',
	'openidnopolicy' => 'Site has not specified a privacy policy.',
	'openidpolicy' => 'Check the <a target="_new" href="$1">privacy policy</a> for more information.',
	'openidoptional' => 'Optional',
	'openidrequired' => 'Required',
	'openidnickname' => 'Nickname',
	'openidfullname' => 'Fullname',
	'openidemail' => 'E-mail address',
	'openidlanguage' => 'Language',
	'openidnotavailable' => 'Your preferred nickname ($1) is already in use by another user.',
	'openidnotprovided' => 'Your OpenID server did not provide a nickname (either because it cannot, or because you told it not to).',
	'openidchooseinstructions' => 'All users need a nickname;
you can choose one from the options below.',
	'openidchoosefull' => 'Your full name ($1)',
	'openidchooseurl' => 'A name picked from your OpenID ($1)',
	'openidchooseauto' => 'An auto-generated name ($1)',
	'openidchoosemanual' => 'A name of your choice:',
	'openidchooseexisting' => 'An existing account on this wiki:',
	'openidchoosepassword' => 'password:',
	'openidconvertinstructions' => 'This form lets you change your user account to use an OpenID URL.',
	'openidconvertsuccess' => 'Successfully converted to OpenID',
	'openidconvertsuccesstext' => 'You have successfully converted your OpenID to $1.',
	'openidconvertyourstext' => 'That is already your OpenID.',
	'openidconvertothertext' => 'That is someone else\'s OpenID.',
	'openidalreadyloggedin' => "'''You are already logged in, $1!'''

If you want to use OpenID to log in in the future, you can [[Special:OpenIDConvert|convert your account to use OpenID]].",
	'openidnousername' => 'No username specified.',
	'openidbadusername' => 'Bad username specified.',
	'openidautosubmit' => 'This page includes a form that should be automatically submitted if you have JavaScript enabled.
If not, try the "Continue" button.',
	'openidclientonlytext' => 'You cannot use accounts from this wiki as OpenIDs on another site.',
	'openidloginlabel' => 'OpenID URL',
	'openidlogininstructions' => '{{SITENAME}} supports the [http://openid.net/ OpenID] standard for single signon between Web sites.
OpenID lets you log into many different Web sites without using a different password for each.
(See [http://en.wikipedia.org/wiki/OpenID Wikipedia\'s OpenID article] for more information.)

If you already have an account on {{SITENAME}}, you can [[Special:UserLogin|log in]] with your username and password as usual.
To use OpenID in the future, you can [[Special:OpenIDConvert|convert your account to OpenID]] after you have logged in normally.

There are many [http://openid.net/get/ OpenID providers], and you may already have an OpenID-enabled account on another service.',
	'openidupdateuserinfo' => 'Update my personal information',
	'prefs-openid' => 'OpenID',
	'openid-prefstext' => '[http://openid.net/ OpenID] preferences',
	'openid-pref-hide' => 'Hide your OpenID URL on your user page, if you log in with OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Update my information from OpenID persona every time I login',
	'openidsigninorcreateaccount' => 'Sign-in or Create New Account',
	'openid-provider-label-openid' => 'Enter your OpenID URL',
	'openid-provider-label-google' => 'Login using your Google account',
	'openid-provider-label-yahoo' => 'Login using your Yahoo account',
	'openid-provider-label-aol' => 'Enter your AOL screenname',
	'openid-provider-label-other-username' => 'Enter your $1 username',
);

/** Message documentation (Message documentation)
 * @author Fryed-peach
 * @author Jon Harald Søby
 * @author Purodha
 * @author Raymond
 * @author Siebrand
 */
$messages['qqq'] = array(
	'openid-desc' => 'Short description of the Openid extension, shown in [[Special:Version]]. Do not translate or change links.',
	'openidtrustinstructions' => '* $1 is a trust root. A trust root looks much like a normal URL, but is used to describe a set of URLs. Trust roots are used by OpenID to verify that a user has approved the OpenID enabled website.',
	'openidoptional' => '{{Identical|Optional}}',
	'openidemail' => '{{Identical|E-mail address}}',
	'openidlanguage' => '{{Identical|Language}}',
	'openidchoosepassword' => '{{Identical|Password}}',
	'openidalreadyloggedin' => '$1 is a user name.',
	'prefs-openid' => '{{optional}}
OpenID preferences tab title',
	'openid-prefstext' => 'OpenID preferences tab text above the list of preferences',
	'openid-pref-hide' => 'OpenID preference label (Hide your OpenID URL on your user page, if you log in with OpenID)',
	'openid-pref-update-userinfo-on-login' => 'OpenID preference label for updating fron OpenID persona upon login',
);

/** Faeag Rotuma (Faeag Rotuma)
 * @author Jose77
 */
$messages['rtm'] = array(
	'openidchoosepassword' => 'ou password:',
);

/** Niuean (ko e vagahau Niuē)
 * @author Jose77
 */
$messages['niu'] = array(
	'openidchoosepassword' => 'kupu fufu:',
);

/** Afrikaans (Afrikaans)
 * @author Arnobarnard
 * @author Naudefj
 */
$messages['af'] = array(
	'openidoptional' => 'Opsioneel',
	'openidrequired' => 'Verpligtend',
	'openidemail' => 'E-pos adres',
	'openidlanguage' => 'Taal',
	'openidchoosepassword' => 'wagwoord:',
);

/** Amharic (አማርኛ)
 * @author Codex Sinaiticus
 */
$messages['am'] = array(
	'openidemail' => 'የኢ-ሜል አድራሻ',
	'openidlanguage' => 'ቋንቋ',
);

/** Arabic (العربية)
 * @author IAlex
 * @author Meno25
 * @author OsamaK
 */
$messages['ar'] = array(
	'openid-desc' => 'سجل الدخول للويكي [http://openid.net/ بهوية مفتوحة]، وسجل الدخول لمواقع ويب أخرى تعرف الهوية المفتوحة بحساب مستخدم ويكي',
	'openidlogin' => 'تسجيل الدخول بالهوية المفتوحة',
	'openidfinish' => 'إنهاء دخول الهوية المفتوحة',
	'openidserver' => 'خادم الهوية المفتوحة',
	'openidxrds' => 'ملف ياديس',
	'openidconvert' => 'محول الهوية المفتوحة',
	'openiderror' => 'خطأ تأكيد',
	'openiderrortext' => 'حدث خطأ أثناء التأكد من مسار الهوية المفتوحة.',
	'openidconfigerror' => 'خطأ ضبط الهوية المفتوحة',
	'openidconfigerrortext' => 'ضبط تخزين الهوية المفتوحة لهذا الويكي غير صحيح.
من فضلك استشر [[Special:ListUsers/sysop|إداريا]].',
	'openidpermission' => 'خطأ سماحات الهوية المفتوحة',
	'openidpermissiontext' => 'الهوية المفتوحة التي وفرتها غير مسموح لها بتسجيل الدخول إلى هذا الخادم.',
	'openidcancel' => 'التأكيد تم إلغاؤه',
	'openidcanceltext' => 'التحقق من مسار الهوية المفتوحة تم إلغاؤه.',
	'openidfailure' => 'التأكيد فشل',
	'openidfailuretext' => 'التحقق من مسار الهوية المفتوحة فشل. رسالة خطأ: "$1"',
	'openidsuccess' => 'التأكيد نجح',
	'openidsuccesstext' => 'التحقق من مسار الهوية المفتوحة نجح.',
	'openidusernameprefix' => 'مستخدم الهوية المفتوحة',
	'openidserverlogininstructions' => 'أدخل كلمة سرك بالأسفل لتسجيل الدخول إلى $3 كمستخدم $2 (صفحة مستخدم $1).',
	'openidtrustinstructions' => 'تأكد مما إذا كنت ترغب في مشاركة البيانات مع $1.',
	'openidallowtrust' => 'السماح ل$1 بالوثوق بحساب هذا المستخدم.',
	'openidnopolicy' => 'الموقع لا يمتلك سياسة محددة للخصوصية.',
	'openidpolicy' => 'تحقق من <a target="_new" href="$1">سياسة الخصوصية</a> لمزيد من المعلومات.',
	'openidoptional' => 'اختياري',
	'openidrequired' => 'مطلوب',
	'openidnickname' => 'اللقب',
	'openidfullname' => 'الاسم الكامل',
	'openidemail' => 'عنوان البريد الإلكتروني',
	'openidlanguage' => 'اللغة',
	'openidnotavailable' => 'لقبك المفضل ($1) قيد الاستخدام بالفعل بواسطة مستخدم آخر.',
	'openidnotprovided' => 'خادم هويتك المفتوحة لم يوفر لقبا (إما لأنه لا يستطيع، أو لأنك أخبرته ألا يفعل).',
	'openidchooseinstructions' => 'كل المستخدمين يحتاجون إلى لقب؛
يمكنك أن تختار واحدا من الخيارات بالأسفل.',
	'openidchoosefull' => 'اسمك الكامل ($1)',
	'openidchooseurl' => 'اسم مختار من هويتك المفتوحة ($1)',
	'openidchooseauto' => 'اسم مولد تلقائيا ($1)',
	'openidchoosemanual' => 'اسم من اختيارك:',
	'openidchooseexisting' => 'حساب موجود في هذه الويكي:',
	'openidchoosepassword' => 'كلمة السر:',
	'openidconvertinstructions' => 'هذه الاستمارة تسمح لك بتغيير حساب مستخدمك ليستعمل مسار هوية مفتوحة.',
	'openidconvertsuccess' => 'تم التحول بنجاح إلى الهوية المفتوحة',
	'openidconvertsuccesstext' => 'أنت حولت بنجاح هويتك المفتوحة إلى $1.',
	'openidconvertyourstext' => 'هذه بالفعل هويتك المفتوحة.',
	'openidconvertothertext' => 'هذه هي الهوية المفتوحة لشخص آخر.',
	'openidalreadyloggedin' => "'''أنت مسجل الدخول بالفعل، $1!'''

لو كنت تريد استخدام الهوية المفتوحة لتسجيل الدخول في المستقبل، يمكنك [[Special:OpenIDConvert|تحويل حسابك لاستخدام الهوية المفتوحة]].",
	'openidnousername' => 'لا اسم مستخدم تم تحديده.',
	'openidbadusername' => 'اسم المستخدم المحدد سيء.',
	'openidautosubmit' => 'هذه الصفحة تحتوي على استمارة ينبغي أن يتم إرسالها تلقائيا لو أنك لديك الجافاسكريبت مفعلة.
لو لا، جرب زر \\"Continue\\".',
	'openidclientonlytext' => 'أنت لا يمكنك استخدام الحسابات من هذا الويكي كهوية مفتوحة على موقع آخر.',
	'openidloginlabel' => 'مسار الهوية المفتوحة',
	'openidlogininstructions' => '{{SITENAME}} تدعم معيار [http://openid.net/ الهوية المفتوحة] للدخول الفردي بين مواقع الويب.
الهوية المفتوحة تسمح لك بتسجيل الدخول إلى مواقع ويب عديدة مختلفة بدون استخدام كلمة سر مختلفة لكل موقع.
(انظر [http://en.wikipedia.org/wiki/OpenID مقالة الهوية المفتوحة في يويكيبيديا] لمزيد من المعلومات.)

لو أنك لديك بالفعل حساب في {{SITENAME}}، يمكنك [[Special:UserLogin|تسجيل الدخول]] باسم مستخدمك وكلمة السر الخاصة بك كالمعتاد.
لاستخدام الهوية المفتوحة في المستقبل، يمكنك [[Special:OpenIDConvert|تحويل حسابك إلى الهوية المفتوحة]] بعد تسجيل دخولك بشكل عادي.

يوجد العديد من [http://wiki.openid.net/Public_OpenID_providers موفري الهوية المفتوحة العلنيين]، وربما يكون لديك حسابك بهوية مفتوحة على خدمة أخرى.',
	'openidupdateuserinfo' => 'تحديث معلوماتي الشخصية',
	'prefs-openid' => 'هوية مفتوحة',
	'openid-prefstext' => 'تفضيلات [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'أخف هويتك هويتك المفتوحة على صفحتك الشخصية، لو سجلت الدخول بالهوية المفتوحة.',
	'openid-pref-update-userinfo-on-login' => 'حدث معلوماتي من شخصية الهوية المفتوحة كل مرة أسجل الدخول',
	'openidsigninorcreateaccount' => 'سجل الدخول أو أنشئ حسابا جديدا',
	'openid-provider-label-openid' => 'أدخل مسار هويتك المفتوحة',
	'openid-provider-label-google' => 'سجل الدخول باستخدام حساب جوجل الخاص بك',
	'openid-provider-label-yahoo' => 'سجل الدخول باستخدام حساب ياهو الخاص بك',
	'openid-provider-label-aol' => 'أدخل اسم شاشة AOL الخاص بك',
	'openid-provider-label-other-username' => 'أدخل اسم مستخدم $1 الخاص بك',
);

/** Egyptian Spoken Arabic (مصرى)
 * @author Ghaly
 * @author IAlex
 * @author Meno25
 */
$messages['arz'] = array(
	'openid-desc' => 'سجل الدخول للويكى [http://openid.net/ بهوية مفتوحة]، وسجل الدخول لمواقع ويب أخرى تعرف الهوية المفتوحة بحساب مستخدم ويكي',
	'openidlogin' => 'تسجيل الدخول بالهوية المفتوحة',
	'openidfinish' => 'إنهاء دخول الهوية المفتوحة',
	'openidserver' => 'خادم الهوية المفتوحة',
	'openidxrds' => 'ملف ياديس',
	'openidconvert' => 'محول الهوية المفتوحة',
	'openiderror' => 'خطأ تأكيد',
	'openiderrortext' => 'حدث خطأ أثناء التأكد من مسار الهوية المفتوحة.',
	'openidconfigerror' => 'خطأ ضبط الهوية المفتوحة',
	'openidconfigerrortext' => 'ضبط تخزين الهوية المفتوحة لهذا الويكى غير صحيح.
من فضلك استشر [[Special:ListUsers/sysop|إداريا]].',
	'openidpermission' => 'خطأ سماحات الهوية المفتوحة',
	'openidpermissiontext' => 'الهوية المفتوحة التى وفرتها غير مسموح لها بتسجيل الدخول إلى هذا الخادم.',
	'openidcancel' => 'التأكيد تم إلغاؤه',
	'openidcanceltext' => 'التحقق من مسار الهوية المفتوحة تم إلغاؤه.',
	'openidfailure' => 'التأكيد فشل',
	'openidfailuretext' => 'التحقق من مسار الهوية المفتوحة فشل. رسالة خطأ: "$1"',
	'openidsuccess' => 'التأكيد نجح',
	'openidsuccesstext' => 'التحقق من مسار الهوية المفتوحة نجح.',
	'openidusernameprefix' => 'مستخدم الهوية المفتوحة',
	'openidserverlogininstructions' => 'أدخل كلمة سرك بالأسفل لتسجيل الدخول إلى $3 كمستخدم $2 (صفحة مستخدم $1).',
	'openidtrustinstructions' => 'تأكد مما إذا كنت ترغب فى مشاركة البيانات مع $1.',
	'openidallowtrust' => 'السماح ل$1 بالوثوق بحساب هذا المستخدم.',
	'openidnopolicy' => 'الموقع لا يمتلك سياسة محددة للخصوصية.',
	'openidpolicy' => 'تحقق من <a target="_new" href="$1">سياسة الخصوصية</a> لمزيد من المعلومات.',
	'openidoptional' => 'اختياري',
	'openidrequired' => 'مطلوب',
	'openidnickname' => 'اللقب',
	'openidfullname' => 'الاسم الكامل',
	'openidemail' => 'عنوان البريد الإلكتروني',
	'openidlanguage' => 'اللغة',
	'openidnotavailable' => 'لقبك المفضل ($1) قيد الاستخدام بالفعل بواسطة مستخدم آخر.',
	'openidnotprovided' => 'خادم هويتك المفتوحة لم يوفر لقبا (إما لأنه لا يستطيع، أو لأنك أخبرته ألا يفعل).',
	'openidchooseinstructions' => 'كل المستخدمين يحتاجون إلى لقب؛
يمكنك أن تختار واحدا من الخيارات بالأسفل.',
	'openidchoosefull' => 'اسمك الكامل ($1)',
	'openidchooseurl' => 'اسم مختار من هويتك المفتوحة ($1)',
	'openidchooseauto' => 'اسم مولد تلقائيا ($1)',
	'openidchoosemanual' => 'اسم من اختيارك:',
	'openidchooseexisting' => 'حساب موجود فى هذه الويكي:',
	'openidchoosepassword' => 'كلمة السر:',
	'openidconvertinstructions' => 'هذه الإستمارة تسمح لك بتغيير حساب مستخدمك ليستعمل مسار هوية مفتوحة.',
	'openidconvertsuccess' => 'تم التحول بنجاح إلى الهوية المفتوحة',
	'openidconvertsuccesstext' => 'أنت حولت بنجاح هويتك المفتوحة إلى $1.',
	'openidconvertyourstext' => 'هذه بالفعل هويتك المفتوحة.',
	'openidconvertothertext' => 'هذه هى الهوية المفتوحة لشخص آخر.',
	'openidalreadyloggedin' => "'''أنت مسجل الدخول بالفعل، $1!'''

لو كنت تريد استخدام الهوية المفتوحة لتسجيل الدخول فى المستقبل، يمكنك [[Special:OpenIDConvert|تحويل حسابك لاستخدام الهوية المفتوحة]].",
	'openidnousername' => 'مافيش اسم يوزر تم تحديده.',
	'openidbadusername' => 'اسم المستخدم المحدد سيء.',
	'openidautosubmit' => 'هذه الصفحة تحتوى على إستمارة ينبغى أن يتم إرسالها تلقائيا لو أنك لديك الجافاسكريبت مفعلة.
لو لا، جرب زر \\"Continue\\".',
	'openidclientonlytext' => 'أنت لا يمكنك استخدام الحسابات من هذا الويكى كهوية مفتوحة على موقع آخر.',
	'openidloginlabel' => 'مسار الهوية المفتوحة',
	'openidlogininstructions' => "{{SITENAME}} تدعم معيار [http://openid.net/ الهوية المفتوحة] للدخول الفردى بين مواقع الويب.
الهوية المفتوحة تسمح لك بتسجيل الدخول إلى مواقع ويب عديدة مختلفة بدون استخدام كلمة سر مختلفة لكل موقع.
(انظر [http://en.wikipedia.org/wiki/OpenID مقالة الهوية المفتوحة فى يويكيبيديا] لمزيد من المعلومات.)

لو أنك لديك بالفعل حساب فى {{SITENAME}}، يمكنك [[Special:UserLogin|تسجيل الدخول]] باسم مستخدمك وكلمة السر الخاصة بك كالمعتاد.
لاستخدام الهوية المفتوحة فى المستقبل، يمكنك [[Special:OpenIDConvert|تحويل حسابك إلى الهوية المفتوحة]] بعد تسجيل دخولك بشكل عادي.

يوجد العديد من [http://wiki.openid.net/Public_OpenID_providers موفرى الهوية المفتوحة العلنيين]، وربما يكون لديك حسابك بهوية مفتوحة على خدمة أخرى.

; الويكيات الأخرى : لو أنك لديك حساب على ويكى مفعل الهوية المفتوحة، مثل [http://wikitravel.org/ ويكى ترافيل]، [http://www.wikihow.com/ ويكى هاو]، [http://vinismo.com/ فينيزمو]، [http://aboutus.org/ أبوت أس] أو [http://kei.ki/ كيكي]، يمكنك تسجيل الدخول إلى {{SITENAME}} بواسطة إدخال '''المسار الكامل''' لصفحة مستخدمك على هذا الويكى الآخر فى الصندوق بالأعلى. على سبيل المثال، ''<nowiki>http://kei.ki/en/User:Evan</nowiki>''.
; [http://openid.yahoo.com/ ياهو!] : إذا لديك حساب مع ياهو!، يمكنك تسجيل الدخول إلى هذا الموقع بواسطة إدخال هويتك المفتوحة الموفرة بواسطة ياهو! فى الصندوق بالأعلى. مسارات هوية ياهو! المفتوحة تأخذ الصيغة ''<nowiki>https://me.yahoo.com/yourusername</nowiki>''.
; [http://dev.aol.com/aol-and-63-million-openids إيه أو إل] : لو لديك حساب مع [http://www.aol.com/ إيه أو إل]، مثل حساب [http://www.aim.com/ إيه أى إم]، يمكنك تسجيل الدخول إلى {{SITENAME}} بواسطة إدخال هويتك المفتوحة الموفرة بواسطة AOL فى الصندوق بالأعلى. مسارات هوية AOL المفتوحة تأخذ الصيغة ''<nowiki>http://openid.aol.com/yourusername</nowiki>''. اسم مستخدمك ينبغى أن يكون كله حروفا صغيرة، لا مسافات.
; [http://bloggerindraft.blogspot.com/2008/01/new-feature-blogger-as-openid-provider.html بلوجر], [http://faq.wordpress.com/2007/03/06/what-is-openid/ وورد بريس دوت كوم]، [http://www.livejournal.com/openid/about.bml ليف جورنال]، [http://bradfitz.vox.com/library/post/openid-for-vox.html فوكس] : لو لديك مدونة على أى من هذه الخدمات، أدخل مسار مدونتك فى الصندوق بالأعلى. على سبيل المثال، ''<nowiki>http://yourusername.blogspot.com/</nowiki>''، ''<nowiki>http://yourusername.wordpress.com/</nowiki>''، ''<nowiki>http://yourusername.livejournal.com/</nowiki>''، أو ''<nowiki>http://yourusername.vox.com/</nowiki>''.",
	'openid-pref-hide' => 'أخف هويتك هويتك المفتوحة على صفحتك الشخصية، لو سجلت الدخول بالهوية المفتوحة.',
);

/** Asturian (Asturianu)
 * @author Esbardu
 */
$messages['ast'] = array(
	'openidlanguage' => 'Llingua',
);

/** Belarusian (Taraškievica orthography) (Беларуская (тарашкевіца))
 * @author EugeneZelenko
 * @author Jim-by
 */
$messages['be-tarask'] = array(
	'openid-desc' => 'Уваход ў {{GRAMMAR:вінавальны|{{SITENAME}}}} з дапамогай [http://openid.net/ OpenID], а так сама ў іншыя сайты, якія падтрымліваюць OpenID з вікі-рахунка',
	'openidlogin' => 'Уваход у сыстэму з дапамогай OpenID',
	'openidfinish' => 'Скончыць уваход у сыстэму з дапамогай OpenID',
	'openidserver' => 'Сэрвэр OpenID',
	'openidxrds' => 'Файл Yadis',
	'openidconvert' => 'Канвэртар OpenID',
	'openiderror' => 'Памылка праверкі',
	'openiderrortext' => 'Пад час праверкі адрасу OpenID узьнікла памылка.',
	'openidconfigerror' => 'Памылка ў канфігурацыі OpenID',
	'openidconfigerrortext' => 'Канфігурацыя сховішча OpenID у {{GRAMMAR:месны|{{SITENAME}}}} — няслушная.
Калі ласка, зьвярніцеся да [[Special:ListUsers/sysop|адміністратараў]].',
	'openidpermission' => 'Памылка правоў доступу OpenID',
	'openidpermissiontext' => 'Пазначаны Вамі OpenID не дазваляе ўвайсьці на гэты сэрвэр.',
	'openidcancel' => 'Праверка адменена',
	'openidcanceltext' => 'Праверка адрасу OpenID была скасавана.',
	'openidfailure' => 'Праверка не атрымалася',
	'openidfailuretext' => 'Праверка адрасу OpenID не атрымалася. Паведамленьне пра памылку: «$1»',
	'openidsuccess' => 'Праверка прайшла пасьпяхова',
	'openidsuccesstext' => 'Праверка адрасу OpenID прайшла пасьпяхова.',
	'openidusernameprefix' => 'КарыстальнікOpenID',
	'openidserverlogininstructions' => 'Увядзіце Ваш пароль ніжэй, каб увайсьці на $3 як {{GENDER:$2|удзельнік|удзельніца}} $2 (старонка {{GENDER:$2|ўдзельніка|удзельніцы}} $1).',
	'openidtrustinstructions' => 'Пазначце, калі Вы жадаеце даць доступ да зьвестак для $1.',
	'openidallowtrust' => 'Дазволіць $1 давераць гэтаму рахунку.',
	'openidnopolicy' => 'Сайт ня мае правілаў адносна прыватнасьці.',
	'openidpolicy' => 'Глядзіце дадатковую інфармацыю ў <a target="_new" href="$1">правілах адносна прыватнасьці</a>.',
	'openidoptional' => 'Неабавязковае',
	'openidrequired' => 'Абавязковае',
	'openidnickname' => 'Мянушка',
	'openidfullname' => 'Поўнае імя',
	'openidemail' => 'Адрас электроннай пошты',
	'openidlanguage' => 'Мова',
	'openidnotavailable' => 'Пазначаная Вамі мянушка ($1) ужо выкарыстоўваецца.',
	'openidnotprovided' => 'Ваш сэрвэр OpenID не даслаў мянушку (магчыма, таму што ня можа, альбо Вы загадалі гэтага не рабіць).',
	'openidchooseinstructions' => 'Кожны ўдзельнік павінен мець мянушку;
Вы можаце выбраць адну з пададзеных ніжэй.',
	'openidchoosefull' => 'Ваша поўнае імя ($1)',
	'openidchooseurl' => 'Імя атрыманае ад Вашага сэрвэра OpenID ($1)',
	'openidchooseauto' => 'Аўтаматычна створанае імя ($1)',
	'openidchoosemanual' => 'Імя на Ваш выбар:',
	'openidchooseexisting' => 'Існуючы рахунак у {{GRAMMAR:месны|{{SITENAME}}}}:',
	'openidchoosepassword' => 'пароль:',
	'openidconvertinstructions' => 'Гэта форма дазваляе зьмяніць Ваш рахунак на выкарыстаньне адрасу OpenID.',
	'openidconvertsuccess' => 'Пасьпяховае пераўтварэньне ў OpenID',
	'openidconvertsuccesstext' => 'Вы пасьпяхова пераўтварылі Ваш OpenID у $1.',
	'openidconvertyourstext' => 'Гэта ўжо Ваш OpenID.',
	'openidconvertothertext' => 'Гэта ня Ваш OpenID.',
	'openidalreadyloggedin' => "'''Вы ўжо ўвайшлі, $1!'''

Калі Вы жадаеце выкарыстоўваць OpenID для ўваходаў у будучыні, Вы можаце [[Special:OpenIDConvert|пераўтварыць Ваш рахунак на выкарыстаньне OpenID]].",
	'openidnousername' => 'Не пазначана імя ўдзельніка.',
	'openidbadusername' => 'Пазначана няслушнае імя ўдзельніка.',
	'openidautosubmit' => 'Гэта старонка ўтрымлівае форму, якая павінна быць аўтаматычна адпраўлена, калі ў Вас уключаны JavaScript.
Калі гэтага не адбылася, паспрабуйце націснуць кнопку «Працягнуць».',
	'openidclientonlytext' => 'Вы ня можаце выкарыстоўваць рахункі {{GRAMMAR:родны|{{SITENAME}}}} як OpenID на іншых сайтах.',
	'openidloginlabel' => 'Адрас OpenID',
	'openidlogininstructions' => "{{SITENAME}} падтрымлівае стандарт [http://openid.net/ OpenID], які дазваляе выкарыстоўваць адзіны уліковы запіс для ўваходу ў розныя сайты без выкарыстаньня розных пароляў для кожнага зь іх.
(Глядзіце падрабязнасьці на [http://en.wikipedia.org/wiki/OpenID Wikipedia's OpenID article].)

Калі Вы ўжо маеце рахунак у {{GRAMMAR:месны|{{SITENAME}}}}, Вы можаце [[Special:UserLogin|ўвайсьці]] з Вашым імем і паролем як звычайна.
Каб выкарыстоўваць OpenID у будучыні, Вы можаце [[Special:OpenIDConvert|пераўтварыць Ваш рахунак у OpenID]] пасьля таго, як увайшлі звычайным чынам.

Існуе шмат [http://openid.net/get/ OpenID сэрвісаў], у Вы, магчыма, ужо маеце OpenID рахунак у іншым сэрвісе.",
	'openidupdateuserinfo' => 'Абнавіць маю асабістую інфармацыю',
	'openid-prefstext' => 'Устаноўкі [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Хаваць Ваш адрас OpenID на Вашай старонцы ўдзельніка, калі Вы ўвайшлі з дапамогай OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Абнаўляць маю інфармацыю з OpenID кожны раз калі я уваходжу ў сыстэму',
	'openidsigninorcreateaccount' => 'Увайсьці альбо стварыць новы рахунак',
	'openid-provider-label-openid' => 'Увядзіце Ваш адрас OpenID',
	'openid-provider-label-google' => 'Увайсьці з дапамогай Вашага рахунку ў Google',
	'openid-provider-label-yahoo' => 'Увайсьці з дапамогай Вашага рахунку ў Yahoo',
	'openid-provider-label-aol' => 'Увядзіце назву Вашага рахунку ў AOL',
	'openid-provider-label-other-username' => 'Увядзіце Вашае імя ўдзельніка $1',
);

/** Bulgarian (Български)
 * @author DCLXVI
 * @author IAlex
 */
$messages['bg'] = array(
	'openidlogin' => 'Влизане с OpenID',
	'openidfinish' => 'Приключване на OpenID влизането',
	'openidserver' => 'OpenID сървър',
	'openidxrds' => 'Yadis файл',
	'openidconvert' => 'Конвертор за OpenID',
	'openiderror' => 'Грешка при потвърждението',
	'openidconfigerror' => 'OpenID грешка при конфигурирането',
	'openidpermissiontext' => 'На предоставеното OpenID не е позволено да влиза на този сървър.',
	'openidcancel' => 'Потвърждението беше прекратено',
	'openidcanceltext' => 'Потвърждението на OpenID URL беше прекратено.',
	'openidfailure' => 'Потвърждението беше неуспешно',
	'openidfailuretext' => 'Потвърждението на OpenID URL беше неуспешно. Грешка: „$1“',
	'openidsuccess' => 'Потвърждението беше успешно',
	'openidsuccesstext' => 'Потвърждението на OpenID URL беше успешно.',
	'openidserverlogininstructions' => 'Въведете паролата си по-долу за да влезете в $3 като потребител $2 (потребителска страница $1).',
	'openidnopolicy' => 'Сайтът няма уточнена политика за защита на личните данни.',
	'openidpolicy' => 'За повече информация вижте политиката за <a target="_new" href="$1">защита на личните данни</a>.',
	'openidoptional' => 'Незадължително',
	'openidrequired' => 'Изисква се',
	'openidnickname' => 'Псевдоним',
	'openidfullname' => 'Име',
	'openidemail' => 'Електронна поща',
	'openidlanguage' => 'Език',
	'openidnotavailable' => 'Избраното потребителско име ($1) вече се използва от друг потребител.',
	'openidchooseinstructions' => 'Всички потребители трябва да имат потребителско име;
можете да изберете своето от предложенията по-долу.',
	'openidchoosefull' => 'Вашето пълно име ($1)',
	'openidchooseauto' => 'Автоматично генерирано име ($1)',
	'openidchoosemanual' => 'Име по избор:',
	'openidchooseexisting' => 'Съществуваща сметка в това уики:',
	'openidchoosepassword' => 'парола:',
	'openidconvertinstructions' => 'Този формуляр позволява да се промени потребителската сметка да използва OpenID URL.',
	'openidconvertsuccess' => 'Преобразуването в OpenID беше успешно',
	'openidconvertsuccesstext' => 'Успешно преобразувахте вашият OpenID в $1.',
	'openidconvertyourstext' => 'Това вече е вашият OpenID.',
	'openidconvertothertext' => 'Това е OpenID на някой друг.',
	'openidalreadyloggedin' => "'''Вече сте влезли в системата, $1!'''

Ако желаете да използвате OpenID за бъдещи влизания, можете да [[Special:OpenIDConvert|преобразувате сметката си да използва OpenID]].",
	'openidnousername' => 'Не е посочено потребителско име.',
	'openidbadusername' => 'Беше посочено невалидно име.',
	'openidautosubmit' => 'Тази страница включва формуляр, който би трябвало да се изпрати автоматично ако Джаваскриптът е разрешен.
Ако не е, можете да използвате бутона \\"Продължаване\\".',
	'openidclientonlytext' => 'Не можете да използвате сметки от това уики като OpenID за друг сайт.',
	'openidloginlabel' => 'OpenID Адрес',
	'openidlogininstructions' => "{{SITENAME}} поддържа [http://openid.net/ OpenID] стандарта за single signon between Web sites.
OpenID позволява влизането в много различни сайтове без да е необходимо да се регистрирате за всеки поотделно.
(Вижте [http://en.wikipedia.org/wiki/OpenID статията за OpenID в Уикипедия] за повече информация.)

Ако вече имате сметка в {{SITENAME}}, можете [[Special:UserLogin|да влезете]] с потребителското си име и парола, както обикновено.
Ако желаете да използвате OpenID, можете [[Special:OpenIDConvert|да преобразувате сметката си в OpenID]] след като влезете в системата.

Налични са много [http://wiki.openid.net/Public_OpenID_providers обществени доставчици на OpenID] и е възможно вече да имате сметка, която поддържа OpenID в друг сайт.

; Други уикита: Ако имате сметка в уики, което поддържа OpenID като [http://wikitravel.org/ Wikitravel], [http://www.wikihow.com/ wikiHow], [http://vinismo.com/ Vinismo], [http://aboutus.org/ AboutUs] или [http://kei.ki/ Keiki], можете да влезете в {{SITENAME}} като въведете в кутията по-горе '''пълния адрес''' към потребителската си страница в другото уикиo, напр. ''<nowiki>http://kei.ki/en/User:Evan</nowiki>''.
; [http://openid.yahoo.com/ Yahoo!]: Ако имате сметка в Yahoo!, можете да влезете в този сайт като в кутията по-горе въведете вашето Yahoo! OpenID. Yahoo! OpenID адресите са от вида ''<nowiki>https://me.yahoo.com/yourusername</nowiki>''.
; [http://dev.aol.com/aol-and-63-million-openids AOL]: Ако притежавате сметка в [http://www.aol.com/ AOL], напр. в [http://www.aim.com/ AIM], можете да влезете в {{SITENAME}} като въведете в кутията по-горе вашето AOL OpenID. AOL OpenID адресите са от вида ''<nowiki>http://openid.aol.com/yourusername</nowiki>''. Потребителското име се изписва само с малки букви и без интервали.
; [http://bloggerindraft.blogspot.com/2008/01/new-feature-blogger-as-openid-provider.html Blogger], [http://faq.wordpress.com/2007/03/06/what-is-openid/ Wordpress.com], [http://www.livejournal.com/openid/about.bml LiveJournal], [http://bradfitz.vox.com/library/post/openid-for-vox.html Vox] : Ако имате блог в някоя от тези услуги, въведете адреса на блога си в кутията по-горе, напр. ''<nowiki>http://yourusername.blogspot.com/</nowiki>'', ''<nowiki>http://yourusername.wordpress.com/</nowiki>'', ''<nowiki>http://yourusername.livejournal.com/</nowiki>'' или ''<nowiki>http://yourusername.vox.com/</nowiki>''.",
	'openid-pref-hide' => 'Скриване на OpenID от потребителската страница ако влезете чрез OpenID.',
);

/** Bosnian (Bosanski)
 * @author CERminator
 * @author IAlex
 */
$messages['bs'] = array(
	'openid-desc' => 'Prijava na wiki sa [http://openid.net/ OpenID] i prijava na druge stranice koje podržavaju OpenID sa wiki korisničkim računom',
	'openidlogin' => 'Prijava sa OpenID',
	'openidfinish' => 'Završi OpenID prijavu',
	'openidserver' => 'OpenID server',
	'openidxrds' => 'Yadis datoteka',
	'openidconvert' => 'OpenID pretvarač',
	'openiderror' => 'Greška pri provjeri',
	'openiderrortext' => 'Desila se greška pri provjeri OpenID URL adrese.',
	'openidconfigerror' => 'Greška OpenID postavki',
	'openidconfigerrortext' => 'OpenID konfiguracija spremanja za ovaj wiki je nevaljana. 
Molimo konsultujte se sa [[Special:ListUsers/sysop|administratorom]].',
	'openidpermission' => 'Greška kod OpenID dopuštenja',
	'openidpermissiontext' => 'OpenID koji ste naveli nije dopušteno da se prijavi na ovaj server.',
	'openidcancel' => 'Provjera poništena',
	'openidcanceltext' => 'Provjera OpenID URL-a je otkazana.',
	'openidfailure' => 'Potvrda nije uspjela',
	'openidfailuretext' => 'Provjera URL-a za OpenID nije uspjela. Poruka greške: "$1"',
	'openidsuccess' => 'Provjera uspješna',
	'openidsuccesstext' => 'Provjera URL-a za OpenID je uspjela.',
	'openidusernameprefix' => 'OpenIDKorisnik',
	'openidserverlogininstructions' => 'Unesite ispod Vašu šifru da biste se prijavili na $3 kao korisnik $2 (korisnička stranica $1).',
	'openidtrustinstructions' => 'Provjerite da li želite dijeliti podatke sa $1.',
	'openidallowtrust' => 'Omogući $1 da vjeruje ovom korisničkom računu.',
	'openidnopolicy' => 'Sajt nema napisana pravila privatnosti.',
	'openidpolicy' => 'Provjerite <a target="_new" href="$1">politiku privatnosti</a> za više informacija.',
	'openidoptional' => 'opcionalno',
	'openidrequired' => 'obavezno',
	'openidnickname' => 'Nadimak',
	'openidfullname' => 'Puno ime',
	'openidemail' => 'E-mail adresa',
	'openidlanguage' => 'Jezik',
	'openidnotavailable' => 'Vaš odabrani nadimak ($1) je već upotrijebio drugi korisnik.',
	'openidnotprovided' => 'Vaš OpenID server nije poslao nadimak (bilo da ne može ili da ste ga Vi spriječili).',
	'openidchooseinstructions' => 'Svi korisnici trebaju imati nadimak;
možete odabrati jedan sa opcijama ispod.',
	'openidchoosefull' => 'Vaše puno ime ($1)',
	'openidchooseurl' => 'Ime uzeto sa Vašeg OpenID ($1)',
	'openidchooseauto' => 'Automatski generisano ime ($1)',
	'openidchoosemanual' => 'Naziv po Vašem izboru:',
	'openidchooseexisting' => 'Postojeći račun na ovoj wiki:',
	'openidchoosepassword' => 'šifra:',
	'openidconvertinstructions' => 'Ovaj obrazac Vam omogućuje da promijeniti Vaš korisnički račun za upotrebu URL OpenID.',
	'openidconvertsuccess' => 'Uspješno prevedeno u OpenID',
	'openidconvertsuccesstext' => 'Uspješno ste pretvorili Vaš OpenID u $1.',
	'openidconvertyourstext' => 'To je već Vaš OpenID.',
	'openidconvertothertext' => 'To je OpenID koji pripada nekom drugom.',
	'openidalreadyloggedin' => "'''Vi ste već prijavljeni, $1!'''

Ako želite da koristite OpenID za buduće prijave, možete [[Special:OpenIDConvert|promijeniti Vaš račun za upotrebu OpenID]].",
	'openidnousername' => 'Nije navedeno korisničko ime.',
	'openidbadusername' => 'Navedeno loše korisničko ime.',
	'openidautosubmit' => 'Ova stranica uključuje obrazac koji bi se trebao automatski poslati ako je kod Vas omogućena JavaScript. Ako nije, pokušajte nastaviti dalje putem dugmeta \\"Continue\\".',
	'openidclientonlytext' => 'Ne možete koristiti račune sa ove wiki kao OpenID na drugom sajtu.',
	'openidloginlabel' => 'OpenID URL adresa',
	'openidlogininstructions' => '{{SITENAME}} podržava [http://openid.net/ OpenID] standard za jedinstvenu prijavu između web sajtova.
OpenID omogućuje da se prijavite na mnoge različite web stranice bez korištenja različitih šifri za svaku od njih.
(Pogledajte [http://en.wikipedia.org/wiki/OpenID članak na Wikipediji o OpenID-u] za više informacija.)

Ako već imate račun na {{SITENAME}}, možete se [[Special:UserLogin|prijaviti]] sa vašim korisničkim imenom i šifrom kao i uvijek.
Da bi koristili OpenID u buduće, možete [[Special:OpenIDConvert|pretvoriti vaš račun u OpenID]] nakon što se normalno prijavite.

Postoji mnogo [http://wiki.openid.net/Public_OpenID_providers javnih provajdera za OpenID], i možda već imate neki račun na drugom servisu koji podržava OpenID.',
	'openidupdateuserinfo' => 'Ažuriraj moje lične informacije',
	'openid-prefstext' => '[http://openid.net/ OpenID] postavke',
	'openid-pref-hide' => 'Sakrij Vaš OpenID na Vašoj korisničkoj stranici, ako ste prijavljeni sa OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Ažuriraj moje informacije sa OpenID identiteta svaki put kad se prijavim',
	'openidsigninorcreateaccount' => 'Prijavite se ili napravite novi račun',
	'openid-provider-label-openid' => 'Unesite Vaš OpenID URL',
	'openid-provider-label-google' => 'Prijava putem Vašeg Google računa',
	'openid-provider-label-yahoo' => 'Prijava putem Vašeg Yahoo računa',
	'openid-provider-label-aol' => 'Unesite svoj AOL nadimak',
	'openid-provider-label-other-username' => 'Unesite Vaše $1 korisničko ime',
);

/** Catalan (Català)
 * @author Solde
 * @author Toniher
 */
$messages['ca'] = array(
	'openid-desc' => 'Inicieu una sessió al wiki amb un [http://openid.net/ OpenID], i inicieu una sessió a qualsevol lloc web compatible amb OpenID amb el vostre compte wiki',
	'openidlogin' => 'Inicia una sessió amb OpenID',
	'openidfinish' => 'Finalitza la sessió amb OpenID',
	'openidserver' => 'Servidor OpenID',
	'openidxrds' => 'Fitxer Yadis',
	'openidconvert' => 'Conversor OpenID',
	'openiderror' => 'Error de verificació',
	'openidusernameprefix' => 'Usuari OpenID',
	'openidoptional' => 'Opcional',
	'openidrequired' => 'Requerit',
	'openidnickname' => 'Sobrenom',
	'openidfullname' => 'Nom complet',
	'openidemail' => 'Adreça de correu electrònic',
	'openidlanguage' => 'Idioma',
	'openidchooseinstructions' => 'Tots els usuaris cal que tinguin un sobrenom;
podeu triar-ne un de les opcions a continuació.',
	'openidchoosefull' => 'El vostre nom complet ($1)',
	'openidchooseexisting' => 'Un compte existent en aquest wiki:',
	'openidchoosepassword' => 'contrassenya:',
	'openid-provider-label-other-username' => "Introdueixi el seu $1 nom d'usuari",
);

/** Czech (Česky)
 * @author IAlex
 * @author Matěj Grabovský
 * @author Mormegil
 */
$messages['cs'] = array(
	'openid-desc' => 'Přihlašování se na wiki pomocí [http://openid.net/ OpenID] a přihlašování se na jiné stránky podporující OpenID pomocí uživatelského účtu z wiki',
	'openidlogin' => 'Přihlášení pomocí OpenID',
	'openidfinish' => 'Dokončit přihlášení pomocí OpenID',
	'openidserver' => 'OpenID server',
	'openidxrds' => 'Soubor Yadis',
	'openidconvert' => 'OpenID konvertor',
	'openiderror' => 'Chyba při ověřování',
	'openiderrortext' => 'Při ověřování URL OpenID se vyskytla chyba.',
	'openidconfigerror' => 'Chyba konfigurace OpenID',
	'openidconfigerrortext' => 'Konfigurace OpenID této wiki je neplatná.
Prosím, poraďte se se [[Special:ListUsers/sysop|správcem]].',
	'openidpermission' => 'Chyba oprávnění OpenID',
	'openidpermissiontext' => 'OpenID, který jste poskytli, nemá oprávnění příhlásit se k tomuto serveru.',
	'openidcancel' => 'Ověřování bylo zrušeno',
	'openidcanceltext' => 'Ověřování URL OpenID bylo zrušeno.',
	'openidfailure' => 'Ověřování zrušeno',
	'openidfailuretext' => 'Ověřování URL OpenID selhalo. Chybová zpráva: „$1“',
	'openidsuccess' => 'Ověřování bylo úspěšné',
	'openidsuccesstext' => 'Ověření URL OpenID bylo úspěšné.',
	'openidusernameprefix' => 'Uživatel OpenID',
	'openidserverlogininstructions' => 'Do formuláře níže zadejte heslo pro přihlášení na $3 jako uživatel $2 (uživatelská stránka $1).',
	'openidtrustinstructions' => 'Zkontrolujte, jestli chcete sdílet data s uživatelem $1.',
	'openidallowtrust' => 'Povolit $1 důvěřovat tomuto uživatelskému účtu.',
	'openidnopolicy' => 'Lokalita nespecifikovala pravidla ochrany osobních údajů.',
	'openidpolicy' => 'Více informací na stránce <a target="_new" href="$1">Ochrana osobních údajoů</a>.',
	'openidoptional' => 'Volitelné',
	'openidrequired' => 'Požadované',
	'openidnickname' => 'Přezdívka',
	'openidfullname' => 'Celé jméno',
	'openidemail' => 'E-mailová adresa:',
	'openidlanguage' => 'Jazyk',
	'openidnotavailable' => 'Vaši preferovanou přezdívku ($1) už používá jiný uživatel.',
	'openidnotprovided' => 'Váš OpenID server neposkytnul přezdívku (buď protože nemůže, nebo protože jste mu určili aby ji neposkytoval).',
	'openidchooseinstructions' => 'Kyždý uživatel musí mít přezdívku; můžete si vybrat z níže uvedených možností.',
	'openidchoosefull' => 'Vaše celé jméno ($1)',
	'openidchooseurl' => 'Jméno na základě vašeho OpenID ($1)',
	'openidchooseauto' => 'Automaticky vytvořené jméno ($1)',
	'openidchoosemanual' => 'Jméno, které si vyberete:',
	'openidchooseexisting' => 'Existující účet na této wiki:',
	'openidchoosepassword' => 'heslo:',
	'openidconvertinstructions' => 'Tento formulář vám umožňuje změnit váš učet, aby používal OpenID URL.',
	'openidconvertsuccess' => 'Úspěšně převedeno na OpenID',
	'openidconvertsuccesstext' => 'Úspěšně jste převedli váš OpenID na $1.',
	'openidconvertyourstext' => 'To už je váš OpenID.',
	'openidconvertothertext' => 'To je OpenID někoho jiného.',
	'openidalreadyloggedin' => "'''Už jste přihlášený, $1!'''

Pokud chcete pro přihlašování v budoucnu používat OpenID, můžete [[Special:OpenIDConvert|převést váš účet na OpenID]].",
	'openidnousername' => 'Nebylo zadáno uživatelské jméno.',
	'openidbadusername' => 'Bylo zadáno chybné uživatelské jméno.',
	'openidautosubmit' => 'Tato stránka obsahuje formulář, který by měl být automaticky odeslán pokud máte zapnutý JavaScript.
Pokud ne, zkuste tlačátko „Pokračovat“.',
	'openidclientonlytext' => 'Nemůžete používat účty z této wiki jako OpenID na jinýh webech.',
	'openidloginlabel' => 'OpenID URL',
	'openidlogininstructions' => "{{SITENAME}} podporuje standard [http://openid.net/ OpenID] pro sjednocené přihlašování na webové stránky.
OpenID vám umožňuje přihlašovat se na množství různých webových stránek bez nutnosti používat pro každou jiné heslo. (Přečtěte si [http://en.wikipedia.org/wiki/OpenID článek o OpenID na Wikipedii])

Pokud už máte na {{GRAMMAR:6sg|{{SITENAME}}}} učet, můžete se [[Special:UserLogin|přihlásit]] pomocí uživatelského jména a heslo jako obvykle. Pokud chcete v budoucnosti pouívat OpenID, můžete po normálním přihlášení [[Special:OpenIDConvert|převést svůj účet na OpenID]].

Existuje množství [http://wiki.openid.net/Public_OpenID_providers veřejných poskytovatelů OpenID] a možná už máte učet s podporou OpenID u jiného poskytovatele.

; Jiné wiki: Pokud máte účet na wiki s podporou OpenID, jako např. [http://wikitravel.org/ Wikitravel], [http://www.wikihow.com/ wikiHow], [http://vinismo.com/ Vinismo], [http://aboutus.org/ AboutUs] nebo [http://kei.ki/ Keiki], můžete se přihlásit na {{GRAMMAR:4sg|{{SITENAME}}}}
; [http://openid.yahoo.com/ Yahoo!]: Pokud máte učet Yahoo!, můžete se na tuto wiki přihlásit zadáním vašeho OpenID, které poskytuje Yahoo!, do pole výše. Yahoo! OpenID URL bývají ve tvaru ''<nowiki>https://me.yahoo.com/uzivatelskejmeno</nowiki>''.
; [http://dev.aol.com/aol-and-63-million-openids AOL]: Pokud máte účet [http://www.aol.com/ AOL], jako například účet [http://www.aim.com/ AIM], můžete se přihlásit na {{GRAMMAR:4sg|{{SITENAME}}}} zadáním vaeho OpenID, které poskytuje AOL, do pole výše. AOL OpenID URL bývají ve tvaru ''<nowiki>http://openid.aol.com/uzivatelskejmeno</nowiki>''. Vaše uživatelské jméno by mělo mít jen malá písmena a žádné mezery.
; [http://bloggerindraft.blogspot.com/2008/01/new-feature-blogger-as-openid-provider.html Blogger], [http://faq.wordpress.com/2007/03/06/what-is-openid/ Wordpress.com], [http://www.livejournal.com/openid/about.bml LiveJournal], [http://bradfitz.vox.com/library/post/openid-for-vox.html Vox]: Pokud máte blog na některé z této služeb, zadejte do pole výše URL svého blogu. Například ''<nowiki>http://uzivatelskejmeno.blogspot.com/</nowiki>'', ''<nowiki>http://uzivatelskejmeno.wordpress.com/</nowiki>'', ''<nowiki>http://uzivatelskejmeno.livejournal.com/</nowiki>'' nebo ''<nowiki>http://uzivatelskejmeno.vox.com/</nowiki>''.",
	'openid-pref-hide' => 'Nezobrazovat váš OpenID na vaší uživatelské stránce pokud se přihlašujete pomocí OpenID.',
);

/** Church Slavic (Словѣ́ньскъ / ⰔⰎⰑⰂⰡⰐⰠⰔⰍⰟ)
 * @author ОйЛ
 */
$messages['cu'] = array(
	'openidlanguage' => 'ѩꙁꙑ́къ',
);

/** Danish (Dansk)
 * @author Jon Harald Søby
 */
$messages['da'] = array(
	'openidnickname' => 'Kaldenavn',
	'openidlanguage' => 'Sprog',
	'openidchoosepassword' => 'adgangskode:',
);

/** German (Deutsch)
 * @author ChrisiPK
 * @author Church of emacs
 * @author IAlex
 * @author Leithian
 * @author Umherirrender
 */
$messages['de'] = array(
	'openid-desc' => 'Anmeldung an dieses Wiki mit einer [http://openid.net/ OpenID] und anmelden an anderen Websites, die OpenID unterstützen, mit einem Wiki-Benutzerkonto.',
	'openidlogin' => 'Anmelden mit OpenID',
	'openidfinish' => 'OpenID-Anmeldung abschließen',
	'openidserver' => 'OpenID-Server',
	'openidxrds' => 'Yadis-Datei',
	'openidconvert' => 'OpenID-Konverter',
	'openiderror' => 'Überprüfungsfehler',
	'openiderrortext' => 'Ein Fehler ist während der Überprüfung der OpenID-URL aufgetreten.',
	'openidconfigerror' => 'OpenID-Konfigurationsfehler',
	'openidconfigerrortext' => 'Die OpenID-Speicherkonfiguarion für dieses Wiki ist fehlerhaft.
Bitte benachrichtige einen [[Special:ListUsers/sysop|Administrator]].',
	'openidpermission' => 'OpenID-Berechtigungsfehler',
	'openidpermissiontext' => 'Die angegebene OpenID berechtigt nicht zur Anmeldung an diesem Server.',
	'openidcancel' => 'Überprüfung abgebrochen',
	'openidcanceltext' => 'Die Überprüfung der OpenID-URL wurde abgebrochen.',
	'openidfailure' => 'Überprüfungsfehler',
	'openidfailuretext' => 'Die Überprüfung der OpenID-URL ist fehlgeschlagen. Fehlermeldung: „$1“',
	'openidsuccess' => 'Überprüfung erfolgreich beendet',
	'openidsuccesstext' => 'Die Überprüfung der OpenID-URL war erfolgreich.',
	'openidusernameprefix' => 'OpenID-Benutzer',
	'openidserverlogininstructions' => 'Gib dein Passwort unten ein, um dich als Benutzer $2 an $3 anzumelden (Benutzerseite $1).',
	'openidtrustinstructions' => 'Prüfe, ob du Daten mit $1 teilen möchtest.',
	'openidallowtrust' => 'Erlaube $1, diesem Benutzerkonto zu vertrauen.',
	'openidnopolicy' => 'Die Seite hat keine Datenschutzrichtlinie angegeben.',
	'openidpolicy' => 'Prüfe die <a target="_new" href="$1">Datenschutzrichtlinie</a> für weitere Informationen.',
	'openidoptional' => 'Optional',
	'openidrequired' => 'Pflicht',
	'openidnickname' => 'Benutzername',
	'openidfullname' => 'Vollständiger Name',
	'openidemail' => 'E-Mail-Adresse:',
	'openidlanguage' => 'Sprache',
	'openidnotavailable' => 'Dein bevorzugter Benutzername ($1) wird bereits von einem anderen Benutzer verwendet.',
	'openidnotprovided' => 'Dein OpenID-Server unterstützt keine Nicknamen (entweder, weil er es nicht kann, oder weil du es ihm nicht erlaubt hast).',
	'openidchooseinstructions' => 'Alle Benutzer benötigen einen Benutzernamen;
du kannst einen aus der untenstehenden Liste auswählen.',
	'openidchoosefull' => 'Dein vollständiger Name ($1)',
	'openidchooseurl' => 'Ein Name aus deiner OpenID ($1)',
	'openidchooseauto' => 'Ein automatisch erzeugter Name ($1)',
	'openidchoosemanual' => 'Ein Name deiner Wahl:',
	'openidchooseexisting' => 'Ein existierendes Benutzerkonto in diesem Wiki:',
	'openidchoosepassword' => 'Passwort:',
	'openidconvertinstructions' => 'Mit diesem Formular kannst du dein Benutzerkonto zur Benutzung einer OpenID-URL freigeben.',
	'openidconvertsuccess' => 'Erfolgreich nach OpenID konvertiert',
	'openidconvertsuccesstext' => 'Du hast die Konvertierung deiner OpenID nach $1 erfolgreich durchgeführt.',
	'openidconvertyourstext' => 'Dies ist bereits deine OpenID.',
	'openidconvertothertext' => 'Dies ist die OpenID von jemand anderem.',
	'openidalreadyloggedin' => "'''Du bist bereits angemeldet, $1!'''

Wenn du OpenID für künftige Anmeldevorgänge nutzen möchtest, kannst du [[Special:OpenIDConvert|dein Benutzerkonto nach OpenID konvertieren]].",
	'openidnousername' => 'Kein Benutzername angegeben.',
	'openidbadusername' => 'Falscher Benutzername angegeben.',
	'openidautosubmit' => 'Diese Seite enthält ein Formular, das automatisch übertragen wird, wenn JavaSkript aktiviert ist. Falls nicht, klicke bitte auf „Weiter“.',
	'openidclientonlytext' => 'Du kannst keine Benutzerkonten aus diesem Wiki als OpenID für andere Seiten verwenden.',
	'openidloginlabel' => 'OpenID-URL',
	'openidlogininstructions' => '{{SITENAME}} unterstützt den [http://openid.net/ OpenID]-Standard für eine einheitliche Anmeldung für mehrere Websites.
OpenID meldet dich bei vielen unterschiedlichen Webseiten an, ohne dass du für jede ein anderes Passwort verwenden musst.
(Mehr Informationen bietet der [http://de.wikipedia.org/wiki/OpenID Wikipedia-Artikel zu OpenID].)

Falls du bereits ein Benutzerkonto bei {{SITENAME}} hast, kannst du dich ganz normal mit Benutzername und Passwort [[Special:UserLogin|anmelden]].
Wenn du in Zukunft OpenID verwenden möchtest, kannst du [[Special:OpenIDConvert|deinen Account zu OpenID konvertieren]], nachdem du dich normal eingeloggt hast.

Es gibt viele [http://openid.net/get/ OpenID-Provider] und möglicherweise hast du bereits ein Benutzerkonto mit aktiviertem OpenID bei einem anderen Anbieter.',
	'openidupdateuserinfo' => 'Persönliche Daten aktualisieren',
	'openid-prefstext' => '[http://openid.net/ OpenID]-Einstellungen',
	'openid-pref-hide' => 'Verstecke deine OpenID auf deiner Benutzerseite, wenn du dich mit OpenID anmeldest.',
	'openid-pref-update-userinfo-on-login' => 'Meine Daten anhand des OpenID-Kontos bei jeder Anmeldung aktualisieren',
	'openidsigninorcreateaccount' => 'Anmelden oder ein neues Benutzerkonto erstellen',
	'openid-provider-label-openid' => 'Gib deine OpenID-URL an',
	'openid-provider-label-google' => 'Mit deinem Google-Benutzerkonto anmelden',
	'openid-provider-label-yahoo' => 'Mit deinem Yahoo-Benutzerkonto anmelden',
	'openid-provider-label-aol' => 'Gib deinen AOL-Namen an',
	'openid-provider-label-other-username' => 'Gib deinen „$1“-Benutzernamen an',
);

/** German (formal address) (Deutsch (Sie-Form))
 * @author Umherirrender
 */
$messages['de-formal'] = array(
	'openid-provider-label-openid' => 'Geben Sie Ihre OpenID-URL an',
	'openid-provider-label-google' => 'Mit Ihrem Google-Benutzerkonto anmelden',
	'openid-provider-label-yahoo' => 'Mit Ihrem Yahoo-Benutzerkonto anmelden',
	'openid-provider-label-aol' => 'Geben Sie Ihren AOL-Namen an',
	'openid-provider-label-other-username' => 'Geben Sie Ihren „$1“-Benutzernamen an',
);

/** Lower Sorbian (Dolnoserbski)
 * @author IAlex
 * @author Michawiki
 */
$messages['dsb'] = array(
	'openid-desc' => 'Pśizjawjenje pla wikija z [http://openid.net/ OpenID] a pśizjawjenje pla drugich websedłow, kótarež pódpěraju OpenID z wikijowym wužywarskim kontom',
	'openidlogin' => 'Pśizjawjenje z OpenID',
	'openidfinish' => 'Pśizjawjenje OpenID dokóńcyś',
	'openidserver' => 'Serwer OpenID',
	'openidxrds' => 'Yadis-dataja',
	'openidconvert' => 'Konwerter OpenID',
	'openiderror' => 'Pśeglědańska zmólka',
	'openiderrortext' => 'Zmólka jo nastała pśi pśeglědowanju URL OpenID.',
	'openidconfigerror' => 'Konfiguraciska zmólka OpenID',
	'openidconfigerrortext' => 'Konfiguracija składowaka OpenID za toś ten wiki jo njepłaśiwy.
Pšosym staj se z [[Special:ListUsers/sysop|administratorom]] do zwiska.',
	'openidpermission' => 'Zmólka pšawow OpenID',
	'openidpermissiontext' => 'OpenID, kótaryž sy pódał, njedowólujo pśizjawjenje pla toś togo serwera.',
	'openidcancel' => 'Pśeglědanje pśetergnjone',
	'openidcanceltext' => 'Pśeglědanje URL OpenID jo se pśetergnuło.',
	'openidfailure' => 'Pséglědanje jo se njeraźiło',
	'openidfailuretext' => 'Pśeglědanje URL OpenID je so njeraźiło. Zmólkowa powěźeńka: "$1"',
	'openidsuccess' => 'Pśeglědanje wuspěšne',
	'openidsuccesstext' => 'Pśeglědanje URL OpenID jo wuspěšnje było.',
	'openidusernameprefix' => 'Wužywaŕ OpenID',
	'openidserverlogininstructions' => 'Zapódaj swójo gronidło dołojce, aby se ako wužywaŕ $2 pla $3 pśizjawił (wužywarski bok $1).',
	'openidtrustinstructions' => 'Kontrolěruj, lěc coš daty z $1 źěliś.',
	'openidallowtrust' => '$1 dowóliś, toś tomu wužywarskemu kontoju dowěriś.',
	'openidnopolicy' => 'Sedło njejo pódało zasady priwatnosći.',
	'openidpolicy' => 'Kontrolěruj <a target="_new" href="$1">zasady priwatnosći</a> za dalšne informacije.',
	'openidoptional' => 'Opcionalny',
	'openidrequired' => 'Trěbny',
	'openidnickname' => 'Pśimě',
	'openidfullname' => 'Dopołne mě',
	'openidemail' => 'E-mailowa adresa:',
	'openidlanguage' => 'Rěc',
	'openidnotavailable' => 'Twójo preferěrowane pśimě ($1) se južo wužywa wót drugego wužywarja.',
	'openidnotprovided' => 'Twój server OpenID njejo dodał pśimě (pak, dokulaž njamóžo, pak, dokulaž njejsy jo jomu k wěsći dał).',
	'openidchooseinstructions' => 'Wše wužywarje trjebaju pśimě;
móžoš jadno ze slědujucych opcijow wubraś.',
	'openidchoosefull' => 'Twójo dopołne mě ($1)',
	'openidchooseurl' => 'Mě z twójogo OpenID ($1)',
	'openidchooseauto' => 'Awtomatiski napórane mě ($1)',
	'openidchoosemanual' => 'Mě twójogo wuzwólenja:',
	'openidchooseexisting' => 'Eksistěrujuce konto w toś tom wikiju:',
	'openidchoosepassword' => 'gronidło:',
	'openidconvertinstructions' => 'Z toś tym formularom móžoš swójo wužywarske konto změniś, aby wužywało URL OpenID.',
	'openidconvertsuccess' => 'Wuspěšnje do OpenID konwertěrowany',
	'openidconvertsuccesstext' => 'Sy wuspěšnje konwertěrował twój OpenID do $1.',
	'openidconvertyourstext' => 'To jo južo twój OpenID.',
	'openidconvertothertext' => 'Toś ten OpenID słuša někomu drugemu.',
	'openidalreadyloggedin' => "'''Sy južo pśizjawjony, $1!'''

Jolic pśichodnje coš OpenID wužywaś, aby se pśizjawił, móžoš [[Special:OpenIDConvert|swójo konto za wužiwanje OpenID konwertěrowaś]].",
	'openidnousername' => 'Žedne wužywarske mě pódane.',
	'openidbadusername' => 'Wopacne wužywarske mě pódane.',
	'openidautosubmit' => 'Toś ten bok wopśimujo formular, kótaryž se awtmatiski wótpósćeła, jolic JavaScript jo zmóžnjony. Jolic nic, klikni na tłocašk "Dalej".',
	'openidclientonlytext' => 'Njamóžoš konta z toś togo wikija ako OpneID na drugem sedle wužywaś.',
	'openidloginlabel' => 'URL OpenID',
	'openidlogininstructions' => '{{SITENAME}} pódpěra standard [http://openid.net/ OpenID] za jadnotliwe pśizjawjenja mjazy websedłami.
OpenID śi zmóžnja se pla rozdźělnych websedłow pśizjawiś, bźez togo až musyš rozdźělne gronidła wužywaś.
(Glědaj [http://en.wikipedia.org/wiki/OpenID nastawk OpenID we Wikipediji] za dalšne informacije.)

Jolic maš južo konto na {{GRAMMAR:lokatiw|{{SITENAME}}}}, móžoš se ze swójim wužywarskim mjenim a gronidłom ako pśecej [[Special:UserLogin|pśizjawiś]].
Aby wužywał OpenID w pśichoźe, móžoš [[Special:OpenIDConvert|swójo konto do OpenID konwertěrowaś]], za tym až sy se normalnje pśizjawił.

Jo wjele [http://openid.net/get/ póbitowarjow OpenID] a snaź maš južo konto z OpenID pla drugeje słužby.',
	'openidupdateuserinfo' => 'Móje wósobinske informacije aktualizěrowaś',
	'openid-prefstext' => 'Nastajenja [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Schowaj swój OpenID na swójom wužywarskem boku, jolic se pśizjawjaś z OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Kuždy raz, gaž se pízjawjam, móje informacije z identity OpenID aktualizěrowaś',
	'openidsigninorcreateaccount' => 'Pśizjawiś se abo nowe konto załožyś',
	'openid-provider-label-openid' => 'Zapódaj swój URL OpenID',
	'openid-provider-label-google' => 'Z pomocu twójogo konta Google se pśizjawiś',
	'openid-provider-label-yahoo' => 'Z pomocu twójogo konta Yahoo se pśizjawiś',
	'openid-provider-label-aol' => 'Zapódaj swójo wužywarske mě AOL',
	'openid-provider-label-other-username' => 'Zapódaj swójo wužywarske mě $1',
);

/** Greek (Ελληνικά)
 * @author Consta
 * @author Crazymadlover
 * @author Omnipaedista
 */
$messages['el'] = array(
	'openidoptional' => 'Προαιρετικός',
	'openidrequired' => 'Απαιτημένος',
	'openidnickname' => 'Παρωνύμιο',
	'openidfullname' => 'ονοματεπώνυμο',
	'openidemail' => 'Διεύθυνση ηλεκτρονικού ταχυδρομείου',
	'openidlanguage' => 'Γλώσσα',
	'openidchoosefull' => 'Το πλήρες όνομά σας ($1)',
	'openidchoosemanual' => 'Ένα όνομα της επιλογής σας:',
	'openidchoosepassword' => 'κωδικός:',
);

/** Esperanto (Esperanto)
 * @author IAlex
 * @author Yekrats
 */
$messages['eo'] = array(
	'openid-desc' => 'Ensaluti la vikion kun [http://openid.net/ identigo OpenID], kaj ensaluti aliajn retejon uzantajn OpenID kun vikia uzula konto',
	'openidlogin' => 'Ensaluti kun OpenID',
	'openidfinish' => 'Elsaluti kun OpenID',
	'openidserver' => 'Servilo OpenID',
	'openidxrds' => 'dosiero Yadis',
	'openidconvert' => 'OpenID konvertilo',
	'openiderror' => 'Atestada eraro',
	'openiderrortext' => 'Eraro okazis dum atestado de la OpenID URL-o.',
	'openidconfigerror' => 'Konfigurada eraro de OpenID',
	'openidconfigerrortext' => 'La konfiguro de la OpenID-identigujo por ĉi tiu vikio estas nevalida.
Bonvolu konsulti [[Special:ListUsers/sysop|administranton]].',
	'openidpermission' => 'OpenID rajt-eraro',
	'openidpermissiontext' => 'La OpenID kiun vi provizis ne estas permesita ensaluti ĉi tiun servilon.',
	'openidcancel' => 'Atestado nuliĝis',
	'openidcanceltext' => 'Atestado de la URL-o OpenID estis nuligita.',
	'openidfailure' => 'Atestado malsukcesis',
	'openidfailuretext' => 'Atestado de la URL-o OpenID malsukcesis. Erara mesaĝo: "$1"',
	'openidsuccess' => 'Atestado sukcesis.',
	'openidsuccesstext' => 'Atestado de la OpenID URL-o sukcesis.',
	'openidusernameprefix' => 'OpenID-Uzanto',
	'openidserverlogininstructions' => 'Enigu vian pasvorton suben por ensaluti al $3 kiel uzanto $2 (uzulpaĝo $1).',
	'openidtrustinstructions' => 'Kontroli se vi volas kunpermesigi datenojn kun $1.',
	'openidallowtrust' => 'Rajtigi $1 fidi ĉi tiun uzulan konton.',
	'openidnopolicy' => 'Retejo ne specifigis regularon pri privateco.',
	'openidpolicy' => 'Kontroli la <a target="_new" href="$1">regularon pri privateco</a> pri plua informo.',
	'openidoptional' => 'Nedeviga',
	'openidrequired' => 'Deviga',
	'openidnickname' => 'Kaŝnomo',
	'openidfullname' => 'Plena nomo',
	'openidemail' => 'Retadreso',
	'openidlanguage' => 'Lingvo',
	'openidnotavailable' => 'Via preferata kromnomo ($1) jam estas uzata de alia uzanto.',
	'openidnotprovided' => 'Via OpenID-a servilo ne provizis kromnomo (ĉar aŭ ĝi ne eblis, aŭ tial vi malpermesigis ĝin).',
	'openidchooseinstructions' => 'Ĉiuj uzantoj bezonas kromnomo;
vi povas selekti el unu la jenaj opcioj.',
	'openidchoosefull' => 'Via plena nomo ($1)',
	'openidchooseurl' => 'Nomo eltenita de via OpenID ($1)',
	'openidchooseauto' => 'Automate generita nomo ($1)',
	'openidchoosemanual' => 'Nomo de via elekto:',
	'openidchooseexisting' => 'Ekzistanta konto en ĉi tiu vikio:',
	'openidchoosepassword' => 'pasvorto:',
	'openidconvertinstructions' => 'Ĉi tiu paĝo permesas al vi ŝanĝi vian uzulan konton por uzi URL-on OpenID.',
	'openidconvertsuccess' => 'Sukcese konvertis al OpenID',
	'openidconvertsuccesstext' => 'Vi sukcese konvertis vian identigon OpenID al $1.',
	'openidconvertyourstext' => 'Tio jam estas via OpenID.',
	'openidconvertothertext' => 'Tio estas OpenID de alia persono.',
	'openidalreadyloggedin' => "'''Vi jam ensalutis, $1!'''

Se vi volas utiligi OpenID por ensaluti estontece, vi povas [[Special:OpenIDConvert|konverti vian konton por uzi OpenID]].",
	'openidnousername' => 'Neniu salutnomo estis donita.',
	'openidbadusername' => 'Fuŝa salutnomo donita.',
	'openidautosubmit' => 'Ĉi tiu paĝo inkluzivas kamparo kiu estos aŭtomate enigita se vi havas JavaScript-on ŝaltan.
Se ne, klaku la butonon \\"Daŭri\\".',
	'openidclientonlytext' => 'Vi ne povas uzi kontojn de ĉi tiu vikio kiel OpenID-ojn en alia retejo.',
	'openidloginlabel' => 'URL-o OpenID',
	'openidupdateuserinfo' => 'Ĝisdatigi mian personan informon',
	'openid-prefstext' => '[http://openid.net/ OpenID]-agordoj',
	'openid-pref-hide' => 'Kaŝi viajn identigon OpenID en via uzula paĝo, se vi ensalutas kun OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Ĝisdatigi mian informon de OpenID-konto ĉiam mi ensalutos',
);

/** Spanish (Español)
 * @author Crazymadlover
 * @author Drini
 * @author IAlex
 * @author Imre
 * @author Sanbec
 */
$messages['es'] = array(
	'openid-desc' => 'Ingresa a la wiki con un [http://openid.net OpenID] e ingresa a los otros sitios que aceptan OpenID con una cuenta de usuario wiki.',
	'openidlogin' => 'Conectarse con OpenID',
	'openidfinish' => 'Termina el ingreso OpenID',
	'openidserver' => 'servidor OpenID',
	'openidxrds' => 'Archivo Yadis',
	'openidconvert' => 'Convertidor OpenID',
	'openiderror' => 'Error de verificación',
	'openiderrortext' => 'Un error ocurrió durante la verificación del URL OpenID.',
	'openidconfigerror' => 'Error de configuración OpenID',
	'openidconfigerrortext' => 'La configuración de almacenamiento OpenID de esta wiki es inválido.
Por favor consulte a un [[Special:ListUsers/sysop|administrador]].',
	'openidpermission' => 'Error de permiso OpenID',
	'openidpermissiontext' => 'El OpenID que indicaste no tiene permiso de ingresar a este servidor.',
	'openidcancel' => 'Verificación cancelada',
	'openidcanceltext' => 'Verificación del URL OpenID fue cancelada.',
	'openidfailure' => 'Verificación fracasada',
	'openidfailuretext' => 'Verificación del OpenID fracasó. Mensaje de error: "$1".',
	'openidsuccess' => 'Verificación fue un éxito',
	'openidsuccesstext' => 'Verificación del URL OpenID fue un éxito.',
	'openidusernameprefix' => 'OpenIDUser',
	'openidserverlogininstructions' => 'Ingresa tu password debajo para ingresar a $3 como el usuario $2 (página de usuario $1)',
	'openidtrustinstructions' => 'Verifique si usted desea compartir información con $1.',
	'openidallowtrust' => 'Permitir a $1 confiar en esta cuenta de usuario.',
	'openidnopolicy' => 'El sitio no ha especificado una política de privacidad.',
	'openidpolicy' => 'Verifique la <a target="_new" href="$1">política de privacidad</a> para mayor información.',
	'openidoptional' => 'Opcional',
	'openidrequired' => 'Necesario',
	'openidnickname' => 'Sobrenombre',
	'openidfullname' => 'Nombre completo',
	'openidemail' => 'Dirección de correo electrónico',
	'openidlanguage' => 'Idioma',
	'openidnotavailable' => 'Tu sobrenombre preferido ($1) se encuentra ocupado por otro usuario.',
	'openidnotprovided' => 'Tu servidor de OpenID no proporcionó un sobrenombre (porque no puede o porque indicaste que no lo hiciera).',
	'openidchooseinstructions' => 'Todos los usuarios necesitan un sobrenombre;
puedes escoger uno de las opciones debajo.',
	'openidchoosefull' => 'Su nombre completo ($1)',
	'openidchooseurl' => 'Un nombre escogido a partir de tu OpenID ($1)',
	'openidchooseauto' => 'Un nombre autogenerado ($1)',
	'openidchoosemanual' => 'Un nombre de su preferencia:',
	'openidchooseexisting' => 'Una cuenta existente en este wiki:',
	'openidchoosepassword' => 'contraseña:',
	'openidconvertinstructions' => 'Este formulario permite cambiar tu cuenta de usuario para que use una URL de OpenID.',
	'openidconvertsuccess' => 'Convertido exitosamente a OpenID',
	'openidconvertsuccesstext' => 'Usted ha convertido exitosamente su OpenID a $1.',
	'openidconvertyourstext' => 'Esto ya es su OpenID.',
	'openidconvertothertext' => 'Esto es el OpenID de alguien más.',
	'openidalreadyloggedin' => "'''¡Ya has ingresado al sistema, $1!'''

Si quieres usar OpenID para ingresar en el futuro, puedes [[Special:OpenIDConvert|convertir tu cuenta a OpenID]].",
	'openidnousername' => 'Ningún nombre de usuario especificado.',
	'openidbadusername' => 'Nombre de usuario mal especificado.',
	'openidautosubmit' => 'Esta página incluye un formulario que será automáticamnte enviado si dispones de JavaScript.
De lo contrario, usa el botón \\"Continuar\\".',
	'openidclientonlytext' => 'No puede usar cuentas de este wiki como OpenID en otro sitio.',
	'openidloginlabel' => 'URL OpenID',
	'openidlogininstructions' => '{{SITENAME}} acepta el estándar [http://openid.net/ OpenID] para ingreso único entre múltiples sitios web.
OpenID te permite ingresar en varios sitios web sin necesidad de usar un password diferente para cada uno.
(Ver [http://es.wikipedia.org/wiki/OpenID el artículo en Wikipedia] para más información)

Si ya dispones de una cuenta en {{SITENAME}} puedes [[Special:UserLogin|ingresar]] con tu usuario y password usuales. Para usar OpenID en el futuro, puedes [[Special:OpenIDConvert|convertir tu cuenta a OpenID]] después de haber ingresado.

Hay muchos [http://openid.net/get proveedores de OpenID] y quizás ya dispongas de una cuenta OpenID en otro servicio.',
	'openidupdateuserinfo' => 'Actualizar mi información personal',
	'openid-prefstext' => 'Preferencias de [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Ocultar su OpenID en su página de usuario, si usted ingresa con OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Actualizar mi información desde mi perfil OpenID cada vez que ingreso.',
	'openidsigninorcreateaccount' => 'Ingresar o Crear una nueva cuenta',
	'openid-provider-label-openid' => 'Ingresar tu URL OpenID',
	'openid-provider-label-google' => 'Iniciar sesión usando tu cuenta Google',
	'openid-provider-label-yahoo' => 'Iniciar sesión usando tu cuenta Yahoo',
	'openid-provider-label-aol' => 'Ingrese su nombre screen de AOL',
	'openid-provider-label-other-username' => 'Ingresar tu nombre de usuario $1',
);

/** Estonian (Eesti)
 * @author Avjoska
 */
$messages['et'] = array(
	'openidoptional' => 'Valikuline',
	'openidrequired' => 'Nõutav',
	'openidnickname' => 'Hüüdnimi',
	'openidfullname' => 'Täisnimi',
	'openidemail' => 'E-posti aadress',
	'openidlanguage' => 'Keel',
	'openidnotavailable' => 'Sinu eelistatud hüüdnimi ($1) on juba kasutuses.',
	'openidchoosefull' => 'Sinu täisnimi ($1)',
	'openidchoosemanual' => 'Sinu valitud nimi:',
	'openidchooseexisting' => 'Olemasolev konto siin vikis:',
	'openidchoosepassword' => 'parool:',
	'openidconvertyourstext' => 'See on juba Sinu avatud ID.',
	'openidconvertothertext' => 'See on kellegi teise avatud ID.',
	'openidalreadyloggedin' => "'''Sa oled juba sisse logitud, $1!'''

Kui soovid kasutada avatud ID-d tulevikus sisselogimiseks, võid [[Special:OpenIDConvert|konvertida oma konto, kasutamaks avatud ID-d]].",
);

/** Basque (Euskara)
 * @author Theklan
 */
$messages['eu'] = array(
	'openidoptional' => 'Aukerazkoa',
	'openidrequired' => 'Nahitaezkoa',
	'openidnickname' => 'Ezizena',
	'openidfullname' => 'Izen osoa',
	'openidemail' => 'E-posta helbidea',
	'openidlanguage' => 'Hizkuntza',
	'openidnotavailable' => 'Nahi duzun ezizena ($1) beste lankide batek erabiltzen du jada.',
);

/** Finnish (Suomi)
 * @author Crt
 * @author IAlex
 * @author Mobe
 * @author Nike
 * @author Silvonen
 * @author Str4nd
 * @author Vililikku
 */
$messages['fi'] = array(
	'openid-desc' => 'Kirjaudu wikiin [http://openid.net/ OpenID:llä] ja muille OpenID-tuetuille sivustoille wiki-käyttäjätilillä',
	'openidlogin' => 'Kirjaudu OpenID:llä',
	'openidfinish' => 'Lopeta OpenID-kirjautuminen',
	'openidserver' => 'OpenID-palvelin',
	'openidxrds' => 'Yadis-tiedosto',
	'openidconvert' => 'OpenID-muunnin',
	'openiderror' => 'Todennusvirhe',
	'openiderrortext' => 'Tapahtui virhe OpenID-osoitteen todentamisen aikana.',
	'openidconfigerror' => 'OpenID-asetusvirhe',
	'openidconfigerrortext' => 'OpenID-varaston määritykset ovat epäkelvolliset tässä wikissä.
Ota yhteyttä [[Special:ListUsers/sysop|ylläpitäjään]].',
	'openidpermission' => 'OpenID-oikeusvirhe',
	'openidpermissiontext' => 'Tarjoamallasi OpenID:llä ei ole luvallista kirjautua tälle palvelimelle.',
	'openidcancel' => 'Todennus peruutettiin',
	'openidcanceltext' => 'OpenID-osoitteen todentaminen peruutettiin.',
	'openidfailure' => 'Todennus epäonnistui',
	'openidfailuretext' => 'OpenID-osoitteen todentaminen epäonnistui. Virheilmoitus: ”$1”',
	'openidsuccess' => 'Todennus onnistui',
	'openidsuccesstext' => 'OpenID-osoitteen todennus onnistui.',
	'openidusernameprefix' => 'OpenID-käyttäjä',
	'openidserverlogininstructions' => 'Kirjaudu sisään sivustolle $3 käyttäjänä $2 (käyttäjäsivu $1) syöttämällä salasana alle.',
	'openidtrustinstructions' => 'Tarkista, haluatko jakaa tietoja kohteen $1 kanssa.',
	'openidnopolicy' => 'Sivusto ei ole määritellyt yksityisyyskäytäntöä.',
	'openidpolicy' => 'Lisää tietoa on <a target="_new" href="$1">yksityisyyskäytännöissä</a>.',
	'openidoptional' => 'Valinnainen',
	'openidrequired' => 'Vaadittu',
	'openidnickname' => 'Nimimerkki',
	'openidfullname' => 'Koko nimi',
	'openidemail' => 'Sähköpostiosoite',
	'openidlanguage' => 'Kieli',
	'openidnotavailable' => 'Toinen käyttäjä käyttää jo haluamaasi nimimerkkiä ($1).',
	'openidnotprovided' => 'OpenID-palvelimesi ei tarjoa nimimerkkiä (joko se ei osaa, tai olet kieltänyt sen).',
	'openidchooseinstructions' => 'Kaikki käyttäjät tarvitsevat nimimerkin.
Voit valita omasi alla olevista vaihtoehdoista.',
	'openidchoosefull' => 'Koko nimesi ($1)',
	'openidchooseurl' => 'OpenID:stäsi poimittu nimi ($1)',
	'openidchooseauto' => 'Automaattisesti luotu nimi ($1)',
	'openidchoosemanual' => 'Omavalintainen nimi',
	'openidchooseexisting' => 'Olemassa oleva tunnus tässä wikissä',
	'openidchoosepassword' => 'salasana:',
	'openidconvertinstructions' => 'Tällä lomakkeella voit muuttaa käyttäjätilisi käyttämään OpenID-osoitetta.',
	'openidconvertsuccess' => 'Muutettiin onnistuneesti OpenID:hen.',
	'openidconvertyourstext' => 'Tämä on jo OpenID:si.',
	'openidconvertothertext' => 'Tämä on jonkun muun OpenID.',
	'openidalreadyloggedin' => "'''Olet jo kirjautuneena sisään, $1!'''

Jos haluat käyttää OpenID:tä kirjautumiseen jatkossa, voit [[Special:OpenIDConvert|muuntaa tunnuksesi käyttämään OpenID:tä]].",
	'openidnousername' => 'Käyttäjätunnus puuttuu.',
	'openidbadusername' => 'Käyttäjätunnus on virheellinen.',
	'openidautosubmit' => 'Tämä sivu sisältää lomakkeen, joka lähettää itse itsensä, jos JavaScript käytössä.
Muussa tapauksessa valitse <code>Jatka</code>.',
	'openidclientonlytext' => 'Et voi käyttää tämän wikin käyttäjätunnuksia OpenID-tunnuksina muilla sivustoilla.',
	'openidloginlabel' => 'OpenID-URL',
	'openid-pref-hide' => 'Piilota OpenID:si käyttäjäsivultani, jos kirjaudun sisään OpenID-tunnuksilla.',
);

/** French (Français)
 * @author Crochet.david
 * @author Grondin
 * @author IAlex
 * @author McDutchie
 * @author Zetud
 */
$messages['fr'] = array(
	'openid-desc' => 'Se connecter au wiki avec [http://openid.net/ OpenID] et se connecter à d’autres sites internet OpenID avec un compte utilisateur du wiki.',
	'openidlogin' => 'Se connecter avec OpenID',
	'openidfinish' => 'Finir la connection OpenID',
	'openidserver' => 'Serveur OpenID',
	'openidxrds' => 'Fichier Yadis',
	'openidconvert' => 'Convertisseur OpenID',
	'openiderror' => 'Erreur de vérification',
	'openiderrortext' => 'Une erreur est intervenue pendant la vérification de l’adresse OpenID.',
	'openidconfigerror' => 'Erreur de configuration de OpenID',
	'openidconfigerrortext' => 'Le stockage de la configuration OpenID pour ce wiki est incorrecte.
Veuillez vous mettre en rapport avec un [[Special:ListUsers/sysop|administrateur]] de ce site.',
	'openidpermission' => 'Erreur de permission OpenID',
	'openidpermissiontext' => 'L’OpenID que vous avez fournie n’est pas autorisée à se connecter sur ce serveur.',
	'openidcancel' => 'Vérification annulée',
	'openidcanceltext' => 'La vérification de l’adresse OpenID a été annulée.',
	'openidfailure' => 'Échec de la vérification',
	'openidfailuretext' => 'La vérification de l’adresse OpenID a échouée. Message d’erreur : « $1 »',
	'openidsuccess' => 'Vérification réussie',
	'openidsuccesstext' => 'Vérification de l’adresse OpenID réussie.',
	'openidusernameprefix' => 'Utilisateur OpenID',
	'openidserverlogininstructions' => "Entrez votre mot de passe ci-dessous pour vous connecter sur $3 comme utilisateur '''$2''' (page utilisateur $1).",
	'openidtrustinstructions' => 'Cochez si vous désirez partager les données avec $1.',
	'openidallowtrust' => 'Autorise $1 à faire confiance à ce compte utilisateur.',
	'openidnopolicy' => 'Le site n’a pas indiqué une politique des données personnelles.',
	'openidpolicy' => 'Vérifier la <a target="_new" href="$1">Politique des données personnelles</a> pour plus d’information.',
	'openidoptional' => 'Facultatif',
	'openidrequired' => 'Exigé',
	'openidnickname' => 'Surnom',
	'openidfullname' => 'Nom en entier',
	'openidemail' => 'Adresse courriel',
	'openidlanguage' => 'Langue',
	'openidnotavailable' => 'Votre surnom préféré ($1) est déjà utilisé par un autre utilisateur.',
	'openidnotprovided' => 'Votre serveur OpenID n’a pas pu fournir un surnom (soit il ne le peut pas, soit vous lui avez demandé de ne pas le faire).',
	'openidchooseinstructions' => 'Tous les utilisateurs ont besoin d’un surnom ; vous pouvez en choisir un à partir du choix ci-dessous.',
	'openidchoosefull' => 'Votre nom entier ($1)',
	'openidchooseurl' => 'Un nom a été choisi depuis votre OpenID ($1)',
	'openidchooseauto' => 'Un nom créé automatiquement ($1)',
	'openidchoosemanual' => 'Un nom de votre choix :',
	'openidchooseexisting' => 'Un compte existant sur ce wiki :',
	'openidchoosepassword' => 'Mot de passe :',
	'openidconvertinstructions' => 'Ce formulaire vous laisse changer votre compte utilisateur pour utiliser une adresse OpenID.',
	'openidconvertsuccess' => 'Converti avec succès vers OpenID',
	'openidconvertsuccesstext' => 'Vous avez converti avec succès votre OpenID vers $1.',
	'openidconvertyourstext' => 'C’est déjà votre OpenID.',
	'openidconvertothertext' => 'Ceci est l’OpenID de quelqu’un d’autre.',
	'openidalreadyloggedin' => "'''Vous êtes déjà connecté{{GENDER:||e|(e)}}, $1 !'''

Vous vous désirez utiliser votre OpenID pour vous connecter ultérieurement, vous pouvez [[Special:OpenIDConvert|convertir votre compte pour utiliser OpenID]].",
	'openidnousername' => 'Aucun nom d’utilisateur n’a été indiqué.',
	'openidbadusername' => 'Un mauvais nom d’utilisatteur a été indiqué.',
	'openidautosubmit' => 'Cette page comprend un formulaire qui pourrait être envoyé automatiquement si vous avez activé JavaScript.
Si tel n’était pas le cas, essayez le bouton « Continuer ».',
	'openidclientonlytext' => 'Vous ne pouvez utiliser des comptes depuis ce wiki en tant qu’OpenID sur d’autres sites.',
	'openidloginlabel' => 'Adresse OpenID',
	'openidlogininstructions' => '{{SITENAME}} supporte le standard [http://openid.net/ OpenID] pour une seule signature entre des sites Internet.
OpenID vous permet de vous connecter sur plusieurs sites différents sans à avoir à utiliser un mot de passe différent pour chacun d’entre eux.
(Voyez [http://fr.wikipedia.org/wiki/OpenID l’article de Wikipédia] pour plus d’informations.)

Si vous avez déjà un compte sur {{SITENAME}}, vous pouvez vous [[Special:UserLogin|connecter]] avec votre nom d’utilisateur et son mot de pas comme d’habitude. Pour utiliser OpenID, à l’avenir, vous pouvez [[Special:OpenIDConvert|convertir votre compte en OpenID]] après que vous vous soyez connecté normallement.

Il existe plusieurs [http://openid.net/get/ fournisseur d’OpenID], et vous pouvez déjà obtenir un compte OpenID activé sur un autre service.',
	'openidupdateuserinfo' => 'Mettre à jour mes données personnelles',
	'openid-prefstext' => 'Préférences de [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Cacher votre OpenID sur votre page utilisateur, si vous vous connectez avec OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Mettre à jour mes données personnelles depuis OpenID à chaque fois que je me connecte',
	'openidsigninorcreateaccount' => 'Se connecter ou créer un nouveau compte',
	'openid-provider-label-openid' => 'Entrez votre URL OpenID',
	'openid-provider-label-google' => 'Vous connecter en utilisant votre compte Google',
	'openid-provider-label-yahoo' => 'Vous connecter en utilisant votre compte Yahoo',
	'openid-provider-label-aol' => 'Entrez votre nom AOL',
	'openid-provider-label-other-username' => 'Entrez votre nom d’utilisateur $1',
);

/** Irish (Gaeilge)
 * @author Alison
 */
$messages['ga'] = array(
	'openidpermission' => 'Earráid ceadúnais OpenID',
);

/** Galician (Galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'openid-desc' => 'Acceder ao sistema do wiki cun [http://openid.net/ OpenID] e acceder a outras páxinas web OpenID cunha conta de usuario dun wiki',
	'openidlogin' => 'Acceder ao sistema co OpenID',
	'openidfinish' => 'Saír do sistema OpenID',
	'openidserver' => 'Servidor do OpenID',
	'openidxrds' => 'Ficheiro Yadis',
	'openidconvert' => 'Transformador OpenID',
	'openiderror' => 'Erro de verificación',
	'openiderrortext' => 'Ocorreu un erro durante a verificación do URL do OpenID.',
	'openidconfigerror' => 'Erro na configuración do OpenID',
	'openidconfigerrortext' => 'A configuración do almacenamento no OpenID deste wiki é inválido.
Por favor, consúlteo cun [[Special:ListUsers/sysop|administrador]] do sitio.',
	'openidpermission' => 'Erro de permisos OpenID',
	'openidpermissiontext' => 'O OpenID que proporcionou non ten permitido o acceso a este servidor.',
	'openidcancel' => 'A verificación foi cancelada',
	'openidcanceltext' => 'A verificación do enderezo URL do OpenID foi cancelada.',
	'openidfailure' => 'Fallou a verificación',
	'openidfailuretext' => 'Fallou a verificación da dirección URL do OpenID. Mensaxe de erro: "$1"',
	'openidsuccess' => 'A verificación foi un éxito',
	'openidsuccesstext' => 'A verificación da dirección URL do OpenID foi un éxito.',
	'openidusernameprefix' => 'Usuario do OpenID',
	'openidserverlogininstructions' => 'Insira o seu contrasinal embaixo para acceder a $3 como o usuario $2 (páxina de usuario $1).',
	'openidtrustinstructions' => 'Comprobe se quere compartir datos con $1.',
	'openidallowtrust' => 'Permitir que $1 revise esta conta de usuario.',
	'openidnopolicy' => 'O sitio non especificou unha política de privacidade.',
	'openidpolicy' => 'Comprobe a <a target="_new" href="$1">política de privacidade</a> para máis información.',
	'openidoptional' => 'Opcional',
	'openidrequired' => 'Necesario',
	'openidnickname' => 'Alcume',
	'openidfullname' => 'Nome completo',
	'openidemail' => 'Enderezo de correo electrónico',
	'openidlanguage' => 'Lingua',
	'openidnotavailable' => 'O seu alcume preferido ($1) xa está sendo usado por outro usuario.',
	'openidnotprovided' => 'O servidor do seu OpenID non proporcionou un alcume (porque non pode ou porque vostede lle dixo que non o fixera).',
	'openidchooseinstructions' => 'Todos os usuarios precisan un alcume; pode escoller un de entre as opcións de embaixo.',
	'openidchoosefull' => 'O seu nome completo ($1)',
	'openidchooseurl' => 'Un nome tomado do seu OpenID ($1)',
	'openidchooseauto' => 'Un nome autoxerado ($1)',
	'openidchoosemanual' => 'Un nome da súa escolla:',
	'openidchooseexisting' => 'Unha conta existente neste wiki:',
	'openidchoosepassword' => 'contrasinal:',
	'openidconvertinstructions' => 'Este formulario permítelle cambiar a súa conta de usuario para usar un enderezo URL de OpenID.',
	'openidconvertsuccess' => 'Convertiuse con éxito a OpenID',
	'openidconvertsuccesstext' => 'Converteu con éxito o seu OpenID a $1.',
	'openidconvertyourstext' => 'Ese xa é o seu OpenID.',
	'openidconvertothertext' => 'Ese é o OpenID de alguén.',
	'openidalreadyloggedin' => "'''Está dentro do sistema, $1!'''

Se quere usar OpenID para acceder ao sistema no futuro, pode [[Special:OpenIDConvert|converter a súa conta para usar OpenID]].",
	'openidnousername' => 'Non foi especificado ningún nome de usuario.',
	'openidbadusername' => 'O nome de usuario especificado é incorrecto.',
	'openidautosubmit' => 'Esta páxina inclúe un formulario que debería ser enviado automaticamente se ten o JavaScript permitido.
Se non é así, probe a premer no botón \\"Continuar\\".',
	'openidclientonlytext' => 'Non pode usar contas deste wiki como OpenIDs noutro sitio.',
	'openidloginlabel' => 'Dirección URL do OpenID',
	'openidlogininstructions' => '{{SITENAME}} soporta o  [http://openid.net/ OpenID] estándar para unha soa sinatura entre os sitios web.
OpenID permítelle rexistrarse en diferentes sitios web sen usar un contrasinal diferente para cada un.
(Consulte o [http://en.wikipedia.org/wiki/OpenID artigo sobre o OpenID na Wikipedia en inglés] para obter máis información.)

Se xa ten unha conta en {{SITENAME}}, pode [[Special:UserLogin|acceder ao sistema]] co seu nome de usuario e contrasinal como o fai habitualmente.
Para usar o OpenID no futuro, pode [[Special:OpenIDConvert|converter a súa conta en OpenID]] tras ter accedido ao sistema como fai normalmente.

Hai moitos [http://openid.net/get/ proveedores públicos de OpenID] e xa pode ter unha conta co OpenID activado noutro servizo.',
	'openidupdateuserinfo' => 'Actualizar a miña información persoal',
	'openid-prefstext' => 'Preferencias do [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Agoche o enderezo URL do seu OpenID na súa páxina de usuario, se accede ao sistema con OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Actualizar a miña información persoal do OpenID cada vez que acceda ao sistema',
	'openidsigninorcreateaccount' => 'Acceder ou crear unha conta nova',
	'openid-provider-label-openid' => 'Insira o enderezo URL do seu OpenID',
	'openid-provider-label-google' => 'Acceder usando a súa conta do Google',
	'openid-provider-label-yahoo' => 'Acceder usando a súa conta do Yahoo',
	'openid-provider-label-aol' => 'Insira o seu nome AOL',
	'openid-provider-label-other-username' => 'Insira o seu nome de usuario $1',
);

/** Ancient Greek (Ἀρχαία ἑλληνικὴ)
 * @author Crazymadlover
 * @author Omnipaedista
 */
$messages['grc'] = array(
	'openidoptional' => 'Προαιρετικόν',
	'openidnickname' => 'Ψευδώνυμον',
	'openidemail' => 'Ἡλεκτρονικὴ διεύθυνσις',
	'openidlanguage' => 'Γλῶττα',
	'openidchoosepassword' => 'σύνθημα:',
);

/** Swiss German (Alemannisch)
 * @author Als-Holder
 * @author IAlex
 */
$messages['gsw'] = array(
	'openid-desc' => 'Mit eme Wiki-Benutzerkonto in däm Wiki mit ere [http://openid.net/ OpenID] aamälde un bi andere Netzsyte aamälde, wu OpenID unterstitze',
	'openidlogin' => 'Aamälde mit OpenID',
	'openidfinish' => 'OpenID-Aamäldig abschliesse',
	'openidserver' => 'OpenID-Server',
	'openidxrds' => 'Yadis-Datei',
	'openidconvert' => 'OpenID-Konverter',
	'openiderror' => 'Iberpriefigsfähler',
	'openiderrortext' => 'S het e Fähle gee derwyylscht d OpenID-URL iberprieft woren isch.',
	'openidconfigerror' => 'OpenID-Konfigurationsfähler',
	'openidconfigerrortext' => 'D OpenID-Spycherkonfiguarion fir des Wiki isch fählerhaft.
Bitte gib eme [[Special:ListUsers/sysop|Ammann]] e Nochricht.',
	'openidpermission' => 'OpenID-Berächtigungsfähler',
	'openidpermissiontext' => 'D OpenID, wu Du aagee hesch, berächtigt nit zue dr Aamäldig bi däm Server.',
	'openidcancel' => 'Iberpriefig abbroche',
	'openidcanceltext' => 'D Iberpriefig vu dr OpenID-URL isch abbroche wore.',
	'openidfailure' => 'Iberpriefigsfähler',
	'openidfailuretext' => 'D Iberpriefig vu dr OpenID-URL isch fählgschlaa. Fählermäldig: „$1“',
	'openidsuccess' => 'Erfolgryych iberprieft',
	'openidsuccesstext' => 'D Iberpriefig vu dr OpenID-URL isch erfolgryych gsi.',
	'openidusernameprefix' => 'OpenID-Benutzer',
	'openidserverlogininstructions' => 'Gib Dyy Passwort unten yy go Di as Benutzer $2 an $3 aazmälde (Benutzersyte $1).',
	'openidtrustinstructions' => 'Prief, eb Du Date mit $1 wit teile.',
	'openidallowtrust' => 'Erlaub $1, däm Benutzerkonto z vertröue.',
	'openidnopolicy' => 'D Syte het kei Dateschutzrichtlinie aagee.',
	'openidpolicy' => 'Prief d <a target="_new" href="$1">Dateschutzrichtlinie</a> fir wyteri Informatione.',
	'openidoptional' => 'Optional',
	'openidrequired' => 'Pflicht',
	'openidnickname' => 'Benutzername',
	'openidfullname' => 'Vollständiger Name',
	'openidemail' => 'E-Mail-Adräss:',
	'openidlanguage' => 'Sproch',
	'openidnotavailable' => 'Dyy bevorzugte Benutzername ($1) wird scho vun eme andere Benutzer verwändet.',
	'openidnotprovided' => 'Dyy OpenID-Server unterstitzt kei Nicknäme (wel er s nit cha oder wel Du s ihm nit erlaubt hesch).',
	'openidchooseinstructions' => 'Alli Benutzer bruuche ne Benutzername;
Du chasch us däre Lischt ein uussueche.',
	'openidchoosefull' => 'Dyy vollständige Name ($1)',
	'openidchooseurl' => 'E Name us Dyynere OpenID ($1)',
	'openidchooseauto' => 'E automatisch aagleite Name ($1)',
	'openidchoosemanual' => 'E vu Dir gwehlte Name:',
	'openidchooseexisting' => 'E Benutzerkonto, wu s in däm Wiki git:',
	'openidchoosepassword' => 'Passwort:',
	'openidconvertinstructions' => 'Mit däm Formular chasch Dyy Benutzerkonto frejgee fir d Benutzig vun ere OpenID-URL.',
	'openidconvertsuccess' => 'Erfolgryych no OpenID konvertiert',
	'openidconvertsuccesstext' => 'Du hesch d Konvertierig vu Dyynere OpenID no $1 erfolgryych durgfiert.',
	'openidconvertyourstext' => 'Des isch scho Dyyni OpenID.',
	'openidconvertothertext' => 'Des isch d OpenID vu eber anderem.',
	'openidalreadyloggedin' => "'''Du bisch scho aagmäldet, $1!'''

Wänn Du OpenID fir s Aamälde in Zuechumft wit nutze, no chasch [[Special:OpenIDConvert|Dyy Benutzerkonto no OpenID konvertiere]].",
	'openidnousername' => 'Kei Benutzername aagee.',
	'openidbadusername' => 'Falsche Benutzername aagee.',
	'openidautosubmit' => 'Uf däre Syte het s e Formular, wu automatisch ibertrait wird, wänn JavaSkript aktiviert isch. Wänn nit, no druck bitte uf „Wyter“.',
	'openidclientonlytext' => 'Du chasch kei Benutzerkonte us däm Wiki as OpenID fir anderi Syte verwände.',
	'openidloginlabel' => 'OpenID-URL',
	'openidlogininstructions' => '{{SITENAME}} unterstitzt dr [http://openid.net/ OpenID]-Standard zum sich fir mehreri Websites aazmälde.
OpenID mäldet Di bi vyyle unterschidlige Netzsyte aa, ohni ass Du fir jedi e ander Passwort muesch verwände.
(Meh Informatione bietet dr [http://de.wikipedia.org/wiki/OpenID dytsch Wikipedia-Artikel zue dr OpenID].)

Wänn Du imfall scho ne Benutzerkonto bi {{SITENAME}} hesch, no chasch Di ganz normal mit em Benutzername un em Passwort [[Special:UserLogin|aamälde]].
Wänn Du in Zuechumft OpenID mechtsch verwände, chasch [[Special:OpenIDConvert|Dyy Account zue OpenID konvertiere]], wänn Di normal aagmäldet hesch.

S git vyyl [http://wiki.openid.net/Public_OpenID_providers effentligi OpenID-Provider] un villicht hesch scho ne  Benutzerkonto mit aktiviertem OpenID bin eme andere Aabieter.',
	'openidupdateuserinfo' => 'Myni persenlige Date aktualisiere',
	'openid-prefstext' => '[http://openid.net/ OpenID] Yystellige',
	'openid-pref-hide' => 'Versteck Dyyni OpenID uf Dyynere Benutzersyte, wänn Di mit OpenID aamäldsch.',
	'openid-pref-update-userinfo-on-login' => 'Myyni Date mit em OpenID-Konto bi jedere Aamäldig aktualisiere',
	'openidsigninorcreateaccount' => 'Aamälde oder nej Benutzerkonto aalege',
	'openid-provider-label-openid' => 'Gib Dyy OpenID URL yy',
	'openid-provider-label-google' => 'Mäld Di aa mit Dyynem Google-Konto',
	'openid-provider-label-yahoo' => 'Mäld Di aa mit Dyynme Yahoo-Konto',
	'openid-provider-label-aol' => 'Gib Dyy AOL-Benutzername yy',
	'openid-provider-label-other-username' => 'Gib Dyy $1-Benutzername yy',
);

/** Manx (Gaelg)
 * @author MacTire02
 */
$messages['gv'] = array(
	'openidemail' => 'Enmys post-L',
	'openidlanguage' => 'Çhengey',
	'openidchoosepassword' => 'fockle yn arrey:',
);

/** Hawaiian (Hawai`i)
 * @author Kalani
 */
$messages['haw'] = array(
	'openidlanguage' => 'ʻŌlelo',
	'openidchoosepassword' => 'ʻōlelo hūnā:',
);

/** Hebrew (עברית)
 * @author IAlex
 * @author Rotemliss
 * @author YaronSh
 */
$messages['he'] = array(
	'openid-desc' => 'כניסה לחשבון בוויקי באמצעות [http://openid.net/ OpenID], והתחברות לאתרים נוספים הפועלים עם OpenID באמצעות חשבון משתמש בוויקי',
	'openidlogin' => 'כניסה לחשבון עם OpenID',
	'openidfinish' => 'יציאה מהחשבון עם OpenID',
	'openidserver' => 'שרת OpenID',
	'openidxrds' => 'קובץ Yadis',
	'openidconvert' => 'ממיר OpenID',
	'openiderror' => 'שגיאת אימות',
	'openiderrortext' => 'אירעה שגיאה במהלך אימות כתובת ה־OpenID.',
	'openidconfigerror' => 'שגיאה בתצורת OpenID',
	'openidconfigerrortext' => 'תצורת איחסון ה־OpenID עבור ויקי זה אינה תקינה.
אנא התייעצו עם אחד מ[[Special:ListUsers/sysop|מפעילי המערכת]].',
	'openidpermission' => 'שגיאת הרשאות OpenID',
	'openidpermissiontext' => 'ה־OpenID שסיפקתם אינו מורשה להתחבר לשרת זה.',
	'openidcancel' => 'האימות בוטל',
	'openidcanceltext' => 'אימות כתובת ה־OpenID בוטל.',
	'openidfailure' => 'האימות נכשל',
	'openidfailuretext' => 'אימות כתובת ה־OpenID נכשל. הודעת השגיאה: "$1"',
	'openidsuccess' => 'האימות הושלם בהצלחה',
	'openidsuccesstext' => 'אימות כתובת ה־OpenID הושלם בהצלחה.',
	'openidusernameprefix' => 'משתמשOpenID',
	'openidserverlogininstructions' => 'כתבו את סיסמתכם להלן כדי להיכנס לחשבון באתר $3 בתור המשתמש $2 (דף המשתמש: $1).',
	'openidtrustinstructions' => 'סמנו אם ברצונכם לשתף מידע עם $1.',
	'openidallowtrust' => 'מתן האפשרות ל־$1 לבטוח בחשבון משתמש זה.',
	'openidnopolicy' => 'האתר לא ציין מדיניות פרטיות.',
	'openidpolicy' => 'בדקו את <a target="_new" href="$1">מדיניות הפרטיות</a> למידע נוסף.',
	'openidoptional' => 'אופציונאלי',
	'openidrequired' => 'נדרש',
	'openidnickname' => 'כינוי',
	'openidfullname' => 'שם מלא',
	'openidemail' => 'כתובת דוא"ל',
	'openidlanguage' => 'שפה',
	'openidnotavailable' => 'הכינוי המועדף עליכם ($1) כבר נמצא בשימוש של משתמש אחר.',
	'openidnotprovided' => 'שרת ה־OpenID לא סיפק כינוי (או בגלל שאינו יכול, או בגלל שכך הוריתם לו).',
	'openidchooseinstructions' => 'כל המשתמשים זקוקים לכינוי;
תוכלו לבחור אחת מהאפשרויות שלהלן.',
	'openidchoosefull' => 'שמכם המלא ($1)',
	'openidchooseurl' => 'שם שנבחר מה־OpenID שלכם ($1)',
	'openidchooseauto' => 'שם שנוצר אוטומטית ($1)',
	'openidchoosemanual' => 'השם הנבחר:',
	'openidchooseexisting' => 'חשבון קיים בוויקי זה:',
	'openidchoosepassword' => 'סיסמה:',
	'openidconvertinstructions' => 'טופס זה מאפשר לכם לשנות את חשבון המשתמשים שלכם לשימוש בכתובת OpenID.',
	'openidconvertsuccess' => 'הומר בהצלחה ל־OpenID',
	'openidconvertsuccesstext' => 'המרתם בהצלחה את ה־OpenID שלכם ל־$1.',
	'openidconvertyourstext' => 'זהו כבר ה־OpenID שלכם.',
	'openidconvertothertext' => 'זהו ה־OpenID של מישהו אחר.',
	'openidalreadyloggedin' => "'''הינכם כבר מחוברים לחשבון, $1!'''

אם ברצונכם להשתמש ב־OpenID כדי להתחבר בעתיד, תוכלו [[Special:OpenIDConvert|להמיר את חשבונכם לשימוש ב־OpenID]].",
	'openidnousername' => 'לא צוין שם משתמש.',
	'openidbadusername' => 'שם המשתמש שצוין אינו תקין.',
	'openidautosubmit' => 'דף זה מכיל טופס שאמור להשלח אוטומטית אם יש לכם JavaScript פעיל.
אם זה לא פועל, נסו את הכפתור \\"המשך\\".',
	'openidclientonlytext' => 'אינכם יכולים להשתמש בחשבונות משתמש מוויקי זה כזהויות OpenID באתר אחר.',
	'openidloginlabel' => 'כתובת OpenID',
	'openidlogininstructions' => 'ב{{grammar:תחילית|{{SITENAME}}}} מותקנת תמיכה בתקן ה־[http://openid.net/ OpenID] לחשבון משתמש מאוחד בין אתרי אינטרנט.
OpenID מאפשר לכם להיכנס לחשבון במגוון אתרים מבלי להשתמש בסיסמה שונה עבור כל אחד מהם.
(עיינו ב[http://he.wikipedia.org/wiki/OpenID ערך על OpenID בוויקיפדיה העברית] למידע נוסף.)

אם כבר יש ברשותכם חשבון במערכת {{SITENAME}}, תוכלו [[Special:UserLogin|להיכנס לחשבון]] עם שם המשתמש והסיסמה שלכם כרגיל.
על מנת להשתמש ב־OpenID בעתיד, תוכלו [[Special:OpenIDConvert|להמיר את חשבונכם ל־OpenID]] לאחר שנכנסתם לחשבון באופן הרגיל.

ישנם [http://wiki.openid.net/Public_OpenID_providers ספקי OpenID ציבוריים] רבים, ויתכן שכבר יש לכם חשבון התומך ב־OpenID בשירות אחר.',
	'openidupdateuserinfo' => 'עדכון המידע האישי שלי',
	'openid-prefstext' => 'העדפות [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'הסתרת כתובת ה־OpenID בדף המשתמש, במקרה של כניסה לחשבון עם OpenID.',
	'openid-pref-update-userinfo-on-login' => 'עדכון המידע שלי מכרטיס ה־OpenID עם כל כניסה לחשבון',
	'openidsigninorcreateaccount' => 'כניסה או יצירת חשבון חדש',
	'openid-provider-label-openid' => 'הזינו את כתובת ה־OpenID שלכם',
	'openid-provider-label-google' => 'היכנסו באמצעות חשבונכם ב־Google',
	'openid-provider-label-yahoo' => 'היכנסו באמצעות חשבונכם ב־Yahoo',
	'openid-provider-label-aol' => 'כתבו את כינוי המסך שלכם ב־AOL',
	'openid-provider-label-other-username' => 'כתבו את שם המשתמש שלכם ב־$1',
);

/** Hindi (हिन्दी)
 * @author IAlex
 * @author Kaustubh
 */
$messages['hi'] = array(
	'openidlogin' => 'OpenID से लॉग इन करें',
	'openidfinish' => 'OpenID लॉग इन पूरा करें',
	'openidserver' => 'OpenID सर्वर',
	'openidxrds' => 'Yadis फ़ाइल',
	'openidconvert' => 'OpenID कन्वर्टर',
	'openiderror' => 'प्रमाणिकरण गलती',
	'openiderrortext' => 'OpenID URL के प्रमाणिकरण में समस्या आई हैं।',
	'openidconfigerror' => 'OpenID व्यवस्थापन समस्या',
	'openidpermission' => 'OpenID अनुमति समस्या',
	'openidpermissiontext' => 'आपने दिये ओपनID से इस सर्वरपर लॉग इन नहीं किया जा सकता हैं।',
	'openidcancel' => 'प्रमाणिकरण रद्द कर दिया',
	'openidcanceltext' => 'ओपनID URL प्रमाणिकरण रद्द कर दिया गया हैं।',
	'openidfailure' => 'प्रमाणिकरण पूरा नहीं हुआ',
	'openidfailuretext' => 'ओपनID URL प्रमाणिकरण पूरा नहीं हो पाया। समस्या: "$1"',
	'openidsuccess' => 'प्रमाणिकरण पूर्ण',
	'openidsuccesstext' => 'ओपनID URL प्रमाणिकरण पूरा हो गया।',
	'openidusernameprefix' => 'OpenIDसदस्य',
	'openidserverlogininstructions' => '$3 पर $2 नामसे (सदस्य पृष्ठ $1) लॉग इन करनेके लिये अपना कूटशब्द नीचे दें।',
	'openidtrustinstructions' => 'आप $1 के साथ डाटा शेअर करना चाहते हैं इसकी जाँच करें।',
	'openidallowtrust' => '$1 को इस सदस्य खातेपर भरोसा रखने की अनुमति दें।',
	'openidnopolicy' => 'साइटने गोपनियता नीति नहीं बनाई हैं।',
	'openidoptional' => 'वैकल्पिक',
	'openidrequired' => 'आवश्यक',
	'openidnickname' => 'उपनाम',
	'openidfullname' => 'पूरानाम',
	'openidemail' => 'इ-मेल एड्रेस',
	'openidlanguage' => 'भाषा',
	'openidchoosefull' => 'आपका पूरा नाम ($1)',
	'openidchooseurl' => 'आपके OpenID से लिया एक नाम ($1)',
	'openidchooseauto' => 'एक अपनेआप बनाया नाम ($1)',
	'openidchoosemanual' => 'आपके पसंद का नाम:',
	'openidchooseexisting' => 'इस विकिपर पहले से होने वाला खाता:',
	'openidchoosepassword' => 'कूटशब्द:',
	'openidconvertsuccess' => 'ओपनID में बदल दिया गया हैं',
	'openidconvertsuccesstext' => 'आपने आपका ओपनID $1 में बदल दिया हैं।',
	'openidconvertyourstext' => 'यह आपका ही ओपनID हैं।',
	'openidconvertothertext' => 'यह किसी औरका ओपनID हैं।',
	'openidnousername' => 'सदस्यनाम दिया नहीं हैं।',
	'openidbadusername' => 'गलत सदस्यनाम दिया हैं।',
	'openidclientonlytext' => 'इस विकिपर खोले गये खाते आप अन्य साइटपर ओपनID के तौर पर इस्तेमाल नहीं कर सकतें हैं।',
	'openidloginlabel' => 'ओपनID URL',
	'openid-pref-hide' => 'अगर आपने ओपनID का इस्तेमाल करके लॉग इन किया हैं, तो आपके सदस्यपन्नेपर आपका ओपनID छुपायें।',
);

/** Hiligaynon (Ilonggo)
 * @author Jose77
 */
$messages['hil'] = array(
	'openidchoosepassword' => 'kontra-senyas:',
);

/** Croatian (Hrvatski)
 * @author Dalibor Bosits
 */
$messages['hr'] = array(
	'openidchoosepassword' => 'lozinka:',
);

/** Upper Sorbian (Hornjoserbsce)
 * @author IAlex
 * @author Michawiki
 */
$messages['hsb'] = array(
	'openid-desc' => 'Přizjewjenje pola wikija z [http://openid.net/ OpenID], a přizjewjenje pola druhich websydłow, kotrež OpenID podpěruja, z wikijowym wužiwarskim kontom',
	'openidlogin' => 'Přizjewjenje z OpenID',
	'openidfinish' => 'Přizjewjenje OpenID skónčić',
	'openidserver' => 'Serwer OpenID',
	'openidxrds' => 'Yadis-dataja',
	'openidconvert' => 'Konwerter OpenID',
	'openiderror' => 'Pruwowanski zmylk',
	'openiderrortext' => 'Zmylk je při pruwowanju URL OpenID wustupił.',
	'openidconfigerror' => 'OpenID konfiguraciski zmylk',
	'openidconfigerrortext' => 'Składowanska konfiguracija OpenID zu tutón wiki je njepłaćiwy. Prošu skonsultuj administratora tutoho sydła.',
	'openidpermission' => 'Zmylk w prawach OpenID',
	'openidpermissiontext' => 'OpenID, kotryž sy podał, njesmě so za přizjewjenje pola tutoho serwera wužiwać.',
	'openidcancel' => 'Přepruwowanje přetorhnjene',
	'openidcanceltext' => 'Přepruwowanje URL OpenID bu přetorhnjene.',
	'openidfailure' => 'Přepruwowanje njeporadźiło',
	'openidfailuretext' => 'Přepruwowanje URL OpenID je so njeporadźiło. Zmylkowa zdźělenka: "$1"',
	'openidsuccess' => 'Přepruwowanje poradźiło',
	'openidsuccesstext' => 'Přepruwowanje URL OpenID je so poradźiło.',
	'openidusernameprefix' => 'Wužiwar OpenID',
	'openidserverlogininstructions' => 'Zapodaj deleka swoje hesło, zo by so pola $3 jako wužiwar $2 přizjewił (wužiwarska strona $1).',
	'openidtrustinstructions' => 'Pruwuj, hač chceš z $1 daty dźělić.',
	'openidallowtrust' => '$1 dowolić, zo by so tutomu wužiwarskemu konće dowěriło.',
	'openidnopolicy' => 'Sydło njeje zasady za priwatnosć podało.',
	'openidpolicy' => 'Pohladaj do <a target="_new" href="$1">zasadow priwatnosće</a> za dalše informacije.',
	'openidoptional' => 'Opcionalny',
	'openidrequired' => 'Trěbny',
	'openidnickname' => 'Přimjeno',
	'openidfullname' => 'Dospołne mjeno',
	'openidemail' => 'E-mejlowa adresa',
	'openidlanguage' => 'Rěč',
	'openidnotavailable' => 'Twoje preferowane přimjeno ($1) so hižo wot druheho wužiwarja wužiwa.',
	'openidnotprovided' => 'Twój serwer OpenID njedoda přimjeno (pak dokelž njemóže pak dokelž njejsy je jemu zdźělił).',
	'openidchooseinstructions' => 'Wšitcy wužiwarjo trjebaja přimjeno; móžěs jedne z opcijow deleka wuzwolić.',
	'openidchoosefull' => 'Twoje dospołne mjeno ($1)',
	'openidchooseurl' => 'Mjeno wzate z twojeho OpenID ($1)',
	'openidchooseauto' => 'Awtomatisce wutworjene mjeno ($1)',
	'openidchoosemanual' => 'Mjeno twojeje wólby:',
	'openidchooseexisting' => 'Eksistowace konto na tutym wikiju:',
	'openidchoosepassword' => 'hesło:',
	'openidconvertinstructions' => 'Tutón formular ći dowola swoje wužiwarske konto zmňić, zo by URL OpenID wužiwał.',
	'openidconvertsuccess' => 'Wuspěšnje do OpenID konwertowany.',
	'openidconvertsuccesstext' => 'Sy swój OpenID wuspěšnje do $1 konwertował.',
	'openidconvertyourstext' => 'To je hižo twój OpenID.',
	'openidconvertothertext' => 'To je OpenID někoho druheho.',
	'openidalreadyloggedin' => "'''Sy hižo přizjewjeny, $1!'''

Jeli chceš OpenID wužiwać, hdyž přichodnje přizjewiš, móžeš [[Special:OpenIDConvert|swoje konto za wužiwanje OpenID konwertować]].",
	'openidnousername' => 'Žane wužiwarske mjeno podate.',
	'openidbadusername' => 'Wopačne wužiwarske mjeno podate.',
	'openidautosubmit' => 'Tuta strona wobsahuje formular, kotryž měł so awtomatisce wotpósłać, jeli sy JavaScript zmóžnił. Jeli nic, spytaj tłóčatko "Dale".',
	'openidclientonlytext' => 'Njemóžeš konta z tutoho wikija jako OpenID na druhim sydle wužiwać.',
	'openidloginlabel' => 'URL OpenID',
	'openidlogininstructions' => '{{SITENAME}} podpěruje standard [http://openid.net/ OpenID] za jednotliwe přizjewjenje mjez websydłami. OpenID ći zmóžnja so pola wjele rozdźělnych websydłow prizjewić, bjeztoho zo dyrbiš rozdźělne hesła wužiwać. (Hlej [http://en.wikipedia.org/wiki/OpenID nastawk OpenID wikipedije] za dalše informacije.)

Jeli maš hižo konto na {{GRAMMAR:lokatiw|{{SITENAME}}}}, móžeš so ze swojim wužiwarskim mjenjom a hesłom kaž přeco [[Special:UserLogin|přizjewić]].
Zo by OpenID w přichodźe wužiwał, móžeš [[Special:OpenIDConvert|swóje konto do OpenID konwertować]], po tym zo sy so normalnje přizjewił.

Je wjele [http://openid.net/get/ poskićowarjow OpenID], snano maš hižo konto z OpenID pola druheje słužby.',
	'openidupdateuserinfo' => 'Moje wosobinske informacije aktualizować',
	'openid-prefstext' => 'Nastajenja [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Twój OpenID na twojej wužiwarskej stronje schować, jeli so z OpenID přizjewješ.',
	'openid-pref-update-userinfo-on-login' => 'Kóždy raz, hdyž so přizjawjam, moje informacije z identity OpenID aktualizować',
	'openidsigninorcreateaccount' => 'Přizjewić so abo nowe konto załožić',
	'openid-provider-label-openid' => 'Zapodaj swój URL OpenID',
	'openid-provider-label-google' => 'Z pomocu twojeho konta Google so přizjewić',
	'openid-provider-label-yahoo' => 'Z pomocu twojeho konta Yahoo so přizjewić',
	'openid-provider-label-aol' => 'Zapodaj swoje wužiwarske mjeno AOL',
	'openid-provider-label-other-username' => 'Zapodaj swoje wužiwarske mjeno $1',
);

/** Hungarian (Magyar)
 * @author Dani
 * @author IAlex
 * @author Tgr
 */
$messages['hu'] = array(
	'openid-desc' => 'Bejelentkezés [http://openid.net/ OpenID] azonosítóval, és más OpenID-kompatibilis weboldalak használata a wikis azonosítóval',
	'openidlogin' => 'Bejelentkezés OpenID-vel',
	'openidfinish' => 'OpenID bejelentkezés befejezése',
	'openidserver' => 'OpenID szerver',
	'openidxrds' => 'Yadis fájl',
	'openidconvert' => 'OpenID konverter',
	'openiderror' => 'Hiba az ellenőrzés során',
	'openiderrortext' => 'Az OpenID URL elenőrzése nem sikerült.',
	'openidconfigerror' => 'OpenID konfigurációs hiba',
	'openidconfigerrortext' => 'A wiki OpenID tárhelyének beállítása érvénytelen.
Lépj kapcsolatba egy [[Special:ListUsers/sysop|adminisztrátorral]].',
	'openidpermission' => 'OpenID jogosultság hiba',
	'openidpermissiontext' => 'Ezzel az OpenID-vel nem vagy jogosult belépni erre a wikire.',
	'openidcancel' => 'Ellenőrzés visszavonva',
	'openidcanceltext' => 'Az OpenID URL ellenőrzése vissza lett vonva.',
	'openidfailure' => 'Ellenőrzés sikertelen',
	'openidfailuretext' => 'Az OpenID URL ellenőrzése nem sikerült. A kapott hibaüzenet: „$1”',
	'openidsuccess' => 'Sikeres ellenőrzés',
	'openidsuccesstext' => 'Az OpenID URL ellenőrzése sikerült.',
	'openidusernameprefix' => 'OpenID-s szerkesztő',
	'openidserverlogininstructions' => 'Add meg a jelszót a(z) $3 oldalra való bejelentkezéshez $2 néven (userlap: $1).',
	'openidtrustinstructions' => 'Adatok megosztása a(z) $1 oldallal.',
	'openidallowtrust' => '$1 megbízhat ebben a felhasználóban.',
	'openidnopolicy' => 'Az oldalnak nincsen adatvédelmi szabályzata.',
	'openidpolicy' => 'További információkért lásd az <a target="_new" href="$1">adatvédelmi szabályzatot</a>.',
	'openidoptional' => 'Opcionális',
	'openidrequired' => 'Kötelező',
	'openidnickname' => 'Felhasználónév',
	'openidfullname' => 'Teljes név',
	'openidemail' => 'Email-cím',
	'openidlanguage' => 'Nyelv',
	'openidnotavailable' => 'Az alapértelmezett felhasználónevedet ($1) már használja valaki.',
	'openidnotprovided' => 'Az OpenID szervered nem adta meg a felhasználónevedet (vagy azért, mert nem tudja, vagy mert nem engedted neki).',
	'openidchooseinstructions' => 'Mindenkinek választania kell egy felhasználónevet; választhatsz egyet az alábbi opciókból.',
	'openidchoosefull' => 'A teljes neved ($1)',
	'openidchooseurl' => 'Az OpenID-dből vett név ($1)',
	'openidchooseauto' => 'Egy automatikusan generált név ($1)',
	'openidchoosemanual' => 'Egy általad megadott név:',
	'openidchooseexisting' => 'Egy létező felhasználónév erről a wikiről:',
	'openidchoosepassword' => 'jelszó:',
	'openidconvertinstructions' => 'Ezzel az űrlappal átállíthatod a felhasználói fiókodat, hogy egy OpenId URL-t használjon.',
	'openidconvertsuccess' => 'Sikeres átállás OpenID-re',
	'openidconvertsuccesstext' => 'Sikeresen átállítottad az OpenID-det erre: $1.',
	'openidconvertyourstext' => 'Ez az OpenID már a tiéd.',
	'openidconvertothertext' => 'Ez az OpenID másvalakié.',
	'openidalreadyloggedin' => "'''Már be vagy jelentkezve, $1!'''

Ha ezentúl az OpenID-del akarsz bejelentkezni, [[Special:OpenIDConvert|konvertálhatod a felhasználói fiókodat OpenID-re]].",
	'openidnousername' => 'Nem adtál meg felhasználónevet.',
	'openidbadusername' => 'Rossz felhasználónevet adtál meg.',
	'openidautosubmit' => 'Az ezen az oldalon lévő űrlap automatikusan elküldi az adatokat, ha a JavaScript engedélyezve van. Ha nem, használd a \\"Tovább\\" gombot.',
	'openidclientonlytext' => 'Az itteni felhasználónevedet nem használhatod OpenID-ként más weboldalon.',
	'openidloginlabel' => 'OpenID URL',
	'openidlogininstructions' => "A(z) {{SITENAME}} támogatja az [http://openid.net/ OpenID]-alapú bejelentkezést.
A OpenID lehetővé teszi, hogy számos különböző weboldalra jelentkezz be úgy, hogy csak egyszer kell megadnod a jelszavadat. (Lásd [http://hu.wikipedia.org/wiki/OpenID a Wikipédia OpenID cikkét] további információkért.)

Ha már regisztráltál korábban, [[Special:UserLogin|bejelentkezhetsz]] a felhasználóneveddel és a jelszavaddal, ahogy eddig is. Ha a továbbiakban OpenID-t akarsz használni, [[Special:OpenIDConvert|állítsd át a felhasználói fiókodat OpenID-re]], miután bejelentkeztél.

Számos [http://wiki.openid.net/Public_OpenID_providers nyilvános OpenID szolgáltató] van, lehetséges, hogy van már OpenID-fiókod egy másik weboldalon.

; Más wikik: ha regisztráltál egy OpenID-kompatibilis wikin, mint a [http://wikitravel.org/ Wikitravel], a [http://www.wikihow.com/ wikiHow], a [http://vinismo.com/ Vinismo], az [http://aboutus.org/ AboutUs] vagy a [http://kei.ki/ Keiki], bejelentkezhetsz ide az ottani felhasználói lapod '''teljes címének''' megadásával. (Például ''<nowiki>http://kei.ki/en/User:Evan</nowiki>''.)
; [http://openid.yahoo.com/ Yahoo!] :  ha van Yahoo! azonosítód, bejelentkezhetsz a Yahoo! OpenID-d megadásával. A Yahoo! OpenID-k ''<nowiki>https://me.yahoo.com/felhasználónév</nowiki>'' alakúak.
; [http://dev.aol.com/aol-and-63-million-openids AOL] : Ha van valamilyen [http://www.aol.com/ AOL] azonosítód, például egy [http://www.aim.com/ AIM] felhasználónév, bejelentkezhetsz az AOL OpenID-del. Az AOL OpenID-k ''<nowiki>http://openid.aol.com/felhasználónév</nowiki>'' alakúak (a felhasználónév csupa kisbetűvel, szóköz nélkül).
; [http://bloggerindraft.blogspot.com/2008/01/new-feature-blogger-as-openid-provider.html Blogger], [http://faq.wordpress.com/2007/03/06/what-is-openid/ Wordpress.com], [http://www.livejournal.com/openid/about.bml LiveJournal], [http://bradfitz.vox.com/library/post/openid-for-vox.html Vox] : ezek a blogszolgáltatók mind biztosítanak OpenID-t, a következő formákban: ''<nowiki>http://felhasználónév.blogspot.com/</nowiki>'', ''<nowiki>http://felhasználónév.wordpress.com/</nowiki>'', ''<nowiki>http://felhasználónév.livejournal.com/</nowiki>'', or ''<nowiki>http://felhasználónév.vox.com/</nowiki>''.",
	'openid-pref-hide' => 'Az OpenID-d elrejtése a felhasználói lapodon, amikor OpenID-vel jelentkezel be.',
);

/** Interlingua (Interlingua)
 * @author IAlex
 * @author Malafaya
 * @author McDutchie
 */
$messages['ia'] = array(
	'openid-desc' => 'Aperir un session in le wiki con [http://openid.net/ OpenID], e aperir un session in altere sitos web usante OpenID con un conto de usator del wiki',
	'openidlogin' => 'Aperir un session con OpenID',
	'openidfinish' => 'Completar le session OpenID',
	'openidserver' => 'Servitor OpenID',
	'openidxrds' => 'File Yadis',
	'openidconvert' => 'Convertitor de OpenID',
	'openiderror' => 'Error de verification',
	'openiderrortext' => 'Un error occurreva durante le verification del adresse URL de OpenID.',
	'openidconfigerror' => 'Error de configuration de OpenID',
	'openidconfigerrortext' => 'Le configuration de immagazinage OpenID pro iste wiki es invalide.
Per favor contacta un [[Special:ListUsers/sysop|administrator]].',
	'openidpermission' => 'Error de permissiones OpenID',
	'openidpermissiontext' => 'Le OpenID que tu forniva non ha le permission de aperir sessiones in iste servitor.',
	'openidcancel' => 'Verification cancellate',
	'openidcanceltext' => 'Le verification del adresse URL OpenID ha essite cancellate.',
	'openidfailure' => 'Verification fallite',
	'openidfailuretext' => 'Le verification del adresse URL de OpenID ha fallite. Message de error: "$1"',
	'openidsuccess' => 'Verification succedite',
	'openidsuccesstext' => 'Le verification del adresse URL de OpenID ha succedite.',
	'openidusernameprefix' => 'Usator OpenID',
	'openidserverlogininstructions' => 'Entra tu contrasigno in basso pro aperir un session in $3 como le usator $2 (pagina de usator: $1).',
	'openidtrustinstructions' => 'Controla si tu vole repartir datos con $1.',
	'openidallowtrust' => 'Permitte que $1 se fide a iste conto de usator.',
	'openidnopolicy' => 'Le sito non ha specificate un politica de confidentialitate.',
	'openidpolicy' => 'Consulta le <a target="_new" href="$1">politica de confidentialitate</a> pro plus informationes.',
	'openidoptional' => 'Optional',
	'openidrequired' => 'Requirite',
	'openidnickname' => 'Pseudonymo',
	'openidfullname' => 'Nomine integre',
	'openidemail' => 'Adresse de e-mail',
	'openidlanguage' => 'Lingua',
	'openidnotavailable' => 'Tu pseudonymo preferite ($1) ja es in uso per un altere usator.',
	'openidnotprovided' => 'Tu servitor OpenID non forniva un pseudonymo (o proque illo non lo pote, o proque tu lo diceva de non facer lo).',
	'openidchooseinstructions' => 'Tote le usatores require un pseudonymo;
tu pote seliger un del optiones in basso.',
	'openidchoosefull' => 'Tu nomine integre ($1)',
	'openidchooseurl' => 'Un nomine seligite de tu OpenID ($1)',
	'openidchooseauto' => 'Un nomine automaticamente generate ($1)',
	'openidchoosemanual' => 'Un nomine de tu preferentia:',
	'openidchooseexisting' => 'Un conto existente in iste wiki:',
	'openidchoosepassword' => 'contrasigno:',
	'openidconvertinstructions' => 'Iste formulario te permitte cambiar tu conto de usator pro usar un adresse URL de OpenID.',
	'openidconvertsuccess' => 'Conversion a OpenID succedite',
	'openidconvertsuccesstext' => 'Tu ha convertite con successo tu OpenID a $1.',
	'openidconvertyourstext' => 'Isto es ja tu OpenID.',
	'openidconvertothertext' => 'Isto es le OpenID de alcuno altere.',
	'openidalreadyloggedin' => "'''Tu es ja identificate, $1!'''

Si tu vole usar OpenID pro aperir un session in le futuro, tu pote [[Special:OpenIDConvert|converter tu conto pro usar OpenID]].",
	'openidnousername' => 'Nulle nomine de usator specificate.',
	'openidbadusername' => 'Mal nomine de usator specificate.',
	'openidautosubmit' => 'Iste pagina include un formulario que debe esser submittite automaticamente si tu ha JavaScript activate.
Si non, prova le button \\"Continuar\\".',
	'openidclientonlytext' => 'Tu non pote usar contos ab iste wiki como contos OpenID in un altere sito.',
	'openidloginlabel' => 'Adresse URL de OpenID',
	'openidlogininstructions' => '{{SITENAME}} supporta le standard [http://openid.net/ OpenID] pro contos unificate inter sitos web.
OpenID te permitte aperir un session in multe diverse sitos web sin usar un differente contrasigno pro cata un.
(Vide [http://ia.wikipedia.org/wiki/OpenID le articulo super OpenID in Wikipedia] pro plus informationes.)

Si tu possede ja un conto in {{SITENAME}}, tu pote [[Special:UserLogin|aperir un session]] con tu nomine de usator e contrasigno como normal.
Pro usar OpenID in le futuro, tu pote [[Special:OpenIDConvert|converter tu conto a OpenID]] post que tu ha aperite un session normal.

Il ha multe [http://openid.net/get/ providitores de OpenID], e tu pote ja disponer de un conto con capacitate OpenID in un altere servicio.',
	'openidupdateuserinfo' => 'Actualisar mi informationes personal',
	'openid-prefstext' => 'Prreferentias de [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Celar tu OpenID in tu pagina de usator, si tu aperi un session con OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Actualisar mi informationes ab mi personage OpenID cata vice que io aperi un session',
	'openidsigninorcreateaccount' => 'Aperir session o crear nove conto',
	'openid-provider-label-openid' => 'Entra le URL de tu OpenID',
	'openid-provider-label-google' => 'Aperir session con tu conto de Google',
	'openid-provider-label-yahoo' => 'Aperir session con tu conto de Yahoo',
	'openid-provider-label-aol' => 'Entra tu pseudonymo de AOL',
	'openid-provider-label-other-username' => 'Entra tu nomine de usator de $1',
);

/** Indonesian (Bahasa Indonesia)
 * @author IAlex
 * @author Rex
 */
$messages['id'] = array(
	'openid-desc' => 'Masuk log ke wiki dengan sebuah [http://openid.net/ OpenID], dan masuk log ke situs web lain yang berbasis OpenID dengan sebuah akun pengguna wiki',
	'openidlogin' => 'Masuk log dengan OpenID',
	'openidfinish' => 'Selesai masuk log dengan OpenID',
	'openidserver' => 'Server OpenID',
	'openidxrds' => 'berkas Yadis',
	'openidconvert' => 'Konverter OpenID',
	'openiderror' => 'Verifikasi gagal',
	'openiderrortext' => 'Sebuah kesalahan terjadi ketika melakukan verifikasi atas URL OpenID.',
	'openidconfigerror' => 'Kesalahan konfigurasi OpenID',
	'openidconfigerrortext' => 'Konfigurasi penyimpanan OpenID di wiki ini tidak sah.
Silakan hubungi salah satu [[Special:ListUsers/sysop|administrator]].',
	'openidpermission' => 'Izin OpenID tidak sah',
	'openidpermissiontext' => 'OpenID yang Anda berikan tidak diperbolehkan untuk mengakses server ini.',
	'openidcancel' => 'Verifikasi dibatalkan',
	'openidcanceltext' => 'Verifikasi URL OpenID tersebut dibatalkan.',
	'openidfailure' => 'Verifikasi gagal',
	'openidfailuretext' => 'Verifikasi dari URL OpenID tersebut gagal.
Pesan kesalahan: "$1"',
	'openidsuccess' => 'Verifikasi berhasil',
	'openidsuccesstext' => 'Verifikasi dari URL OpenID tersebut berhasil.',
	'openidusernameprefix' => 'PenggunaOpenID',
	'openidserverlogininstructions' => 'Masukkan kata sandi Anda di bawah ini untuk masuk log ke $3 sebagai pengguna $2 (halaman pengguna $1).',
	'openidtrustinstructions' => 'Berikan tanda cek jika Anda ingin berbagi data dengan $1.',
	'openidallowtrust' => 'Izinkan $1 untuk mempercayai akun pengguna ini.',
	'openidnopolicy' => 'Situs ini tidak memiliki kebijakan privasi.',
	'openidpolicy' => 'Lihat <a target="_new" href="$1">kebijakan privasi</a> untuk informasi lebih lanjut.',
	'openidoptional' => 'Opsional',
	'openidrequired' => 'Diperlukan',
	'openidnickname' => 'Nama panggilan',
	'openidfullname' => 'Nama lengkap',
	'openidemail' => 'Alamat surat-e',
	'openidlanguage' => 'Bahasa',
	'openidnotavailable' => 'Nama panggilan yang Anda masukkan ($1) sudah digunakan oleh pengguna lain.',
	'openidnotprovided' => 'Server OpenID Anda tidak menyediakan nama panggilan (entah karena server tersebut tidak bisa, atau Anda telah menspesifikasikan untuk tidak menyediakannya).',
	'openidchooseinstructions' => 'Semua pengguna memerlukan sebuah nama panggilan;
Anda dapat memilih dari salah satu opsi berikut.',
	'openidchoosefull' => 'Nama lengkap Anda ($1)',
	'openidchooseurl' => 'Sebuah nama diambil dari OpenID Anda ($1)',
	'openidchooseauto' => 'Nama yang dibuat secara otomatis ($1)',
	'openidchoosemanual' => 'Nama pilihan Anda:',
	'openidchooseexisting' => 'Akun telah ada di wiki ini:',
	'openidchoosepassword' => 'kata sandi:',
	'openidconvertinstructions' => 'Form ini mengizinkan Anda untuk mengubah akun pengguna Anda menjadi menggunakan sebuah URL OpenID.',
	'openidconvertsuccess' => 'Berhasil dikonversi menjadi OpenID',
	'openidconvertsuccesstext' => 'Anda telah berhasil mengkonversi OpenID Anda menjadi $1.',
	'openidconvertyourstext' => 'Sudah merupakan OpenID Anda.',
	'openidconvertothertext' => 'Itu adalah OpenID orang lain.',
	'openidalreadyloggedin' => "'''Anda telah masuk log, $1!'''

Jika Anda ingin menggunakan OpenID untuk masuk log di masa yang akan datang, Anda dapat [[Special:OpenIDConvert|mengkonversi akun Anda menjadi OpenID]].",
	'openidnousername' => 'Tidak ada nama pengguna diberikan.',
	'openidbadusername' => 'Nama pengguna salah.',
	'openidautosubmit' => 'Dalam halaman ini terdapat formulir yang akan dikirimkan secara otomatis jika Anda mengaktifkan JavaScript.
Jika tidak, coba tombol \\"Lanjutkan\\".',
	'openidclientonlytext' => 'Anda tidak dapat menggunakan akun dari wiki ini sebagai OpenID di situs lain.',
	'openidloginlabel' => 'URL OpenID',
	'openidlogininstructions' => '{{SITENAME}} ini mendukung standar [http://openid.net/ OpenID] untuk masuk log lintas situs Web.
OpenID mengizinkan Anda untuk masuk log di berbagai situs Web tanpa harus memasukkan kata sandi yang berbeda.
(Lihat [http://id.wikipedia.org/wiki/OpenID artikel Wikipedia mengenai OpenID] untuk informasi lebih lanjut.)

Jika Anda telah memiliki akun di {{SITENAME}}, Anda dapat [[Special:UserLogin|masuk log]] dengan nama pengguna dan kata sandi Anda seperti biasa.
Untuk menggunakan OpenID di masa yang akan datang, Anda dapat [[Special:OpenIDConvert|mengkonversi akun Anda menjadi OpenID]] setelah Anda masuk log seperti biasa.

Ada banyak [http://openid.net/get penyedia OpenID], dan Anda mungkin telah memiliki akun OpenID di salah satu layanan situs lain.',
	'openid-pref-hide' => 'Sembunyikan URL OpenID Anda di halaman pengguna Anda, jika Anda masuk log dengan OpenID.',
);

/** Icelandic (Íslenska)
 * @author S.Örvarr.S
 */
$messages['is'] = array(
	'openidchoosepassword' => 'lykilorð:',
);

/** Italian (Italiano)
 * @author BrokenArrow
 * @author Darth Kule
 * @author IAlex
 * @author McDutchie
 * @author Nemo bis
 * @author Pietrodn
 * @author Stefano-c
 */
$messages['it'] = array(
	'openid-desc' => 'Effettua il login alla wiki con [http://openid.net/ OpenID] e agli altri siti web che utilizzano OpenID con un account wiki',
	'openidlogin' => 'Login con OpenID',
	'openidfinish' => 'Completa il login OpenID',
	'openidserver' => 'server OpenID',
	'openidxrds' => 'file Yadis',
	'openidconvert' => 'convertitore OpenID',
	'openiderror' => 'Errore di verifica',
	'openiderrortext' => "Si è verificato un errore durante la verifica dell'URL OpenID.",
	'openidconfigerror' => 'Errore nella configurazione OpenID',
	'openidconfigerrortext' => 'La configurazione della memorizzazione di OpenID per questa wiki non è valida.
Per favore consulta un [[Special:ListUsers/sysop|amministratore]].',
	'openidpermission' => 'Errore nei permessi OpenID',
	'openidpermissiontext' => "L'accesso a questo server non è consentito all'OpenID indicato.",
	'openidcancel' => 'Verifica annullata',
	'openidcanceltext' => "La verifica dell'URL OpenID è stata annullata.",
	'openidfailure' => 'Verifica fallita',
	'openidfailuretext' => 'La verifica dell\'URL OpenID è fallita. Messaggio di errore: "$1"',
	'openidsuccess' => 'Verifica effettuata',
	'openidsuccesstext' => "La verifica dell'URL OpenID è stata effettuata con successo.",
	'openidusernameprefix' => 'Utente OpenID',
	'openidserverlogininstructions' => 'Inserisci di seguito la tua password per effettuare il login a $3 come utente $2 (pagina utente $1).',
	'openidtrustinstructions' => 'Controlla se desideri condividere i dati con $1.',
	'openidallowtrust' => 'Permetti a $1 di fidarsi di questo account utente.',
	'openidnopolicy' => 'Il sito non ha specificato una politica relativa alla privacy.',
	'openidpolicy' => 'Controlla la <a target="_new" href="$1">politica relativa alla privacy</a> per maggiori informazioni.',
	'openidoptional' => 'Opzionale',
	'openidrequired' => 'Richiesto',
	'openidnickname' => 'Nickname',
	'openidfullname' => 'Nome completo',
	'openidemail' => 'Indirizzo e-mail',
	'openidlanguage' => 'Lingua',
	'openidnotavailable' => 'Il tuo nickname preferito ($1) è già utilizzato da un altro utente.',
	'openidnotprovided' => 'Il tuo server OpenID non ha fornito un nickname (o perché non ha potuto o perché hai detto di non farlo).',
	'openidchooseinstructions' => 'Tutti gli utenti hanno bisogno di un nickname;
puoi sceglierne uno dalle opzioni seguenti.',
	'openidchoosefull' => 'Il tuo nome completo ($1)',
	'openidchooseurl' => 'Un nome scelto dal tuo OpenID ($1)',
	'openidchooseauto' => 'Un nome auto-generato ($1)',
	'openidchoosemanual' => 'Un nome di tua scelta:',
	'openidchooseexisting' => 'Un account esistente su questa wiki:',
	'openidchoosepassword' => 'password:',
	'openidconvertinstructions' => 'Questo modulo ti permette di cambiare il tuo account per usare un URL OpenID.',
	'openidconvertsuccess' => 'Convertito con successo a OpenID',
	'openidconvertsuccesstext' => 'Il tuo OpenID è stato convertito con successo a $1.',
	'openidconvertyourstext' => 'Questo è già il tuo OpenID.',
	'openidconvertothertext' => "Questo è l'OpenID di qualcun altro.",
	'openidalreadyloggedin' => "'''Hai già effettuato il login, $1!'''

Se desideri usare OpenID per effettuare il login in futuro, puoi [[Special:OpenIDConvert|convertire il tuo account per utilizzare OpenID]].",
	'openidnousername' => 'Nessun nome utente specificato.',
	'openidbadusername' => 'Nome utente specificato errato.',
	'openidautosubmit' => 'Questa pagina include un modulo che dovrebbe essere inviato automaticamente se hai JavaScript attivato. Se non lo è, prova a premere il pulsante \\"Continue\\".',
	'openidclientonlytext' => 'Non puoi usare gli account di questa wiki come OpenID su un altro sito.',
	'openidloginlabel' => 'URL OpenID',
	'openidlogininstructions' => '{{SITENAME}} supporta lo standard [http://openid.net/ OpenID] per il login unico sui siti web.
OpenID consente di effettuare la registrazione su molti siti web senza dover utilizzare una password diversa per ciascuno.
(Leggi la [http://it.wikipedia.org/wiki/OpenID voce di Wikipedia su OpenID] per maggiori informazioni.)

Chi possiede già un account su {{SITENAME}} può effettuare il [[Special:UserLogin|login]] con il proprio nome utente e la propria password come al solito. Per utilizzare OpenID in futuro, si può [[Special:OpenIDConvert|convertire il proprio account a OpenID]] dopo aver effettuato normalmente il login.

Esistono molti [http://openid.net/get/ Provider OpenID]; è possibile che tu abbia già un account abilitato a OpenID su un altro servizio.',
	'openidupdateuserinfo' => 'Aggiorna le mie informazioni personali',
	'openid-prefstext' => 'Preferenze [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Nascondi il tuo OpenID sulla tua pagina utente, se effettui il login con OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Aggiorna le mie informazioni dalla persona OpenID a ogni accesso',
	'openidsigninorcreateaccount' => 'Entra o crea un nuovo account',
	'openid-provider-label-openid' => "Inserisci l'URL del tuo OpenID",
	'openid-provider-label-google' => 'Accedi utilizzando il tuo account Google',
	'openid-provider-label-yahoo' => 'Accedi utilizzando il tuo account Yahoo',
	'openid-provider-label-aol' => 'Inserisci il tuo screenname AOL',
	'openid-provider-label-other-username' => 'Inserisci il tuo $1 nome utente',
);

/** Japanese (日本語)
 * @author Fievarsty
 * @author Fryed-peach
 * @author Hosiryuhosi
 * @author IAlex
 */
$messages['ja'] = array(
	'openid-desc' => '[http://openid.net/ OpenID]によるウィキへのログインを可能にし、ウィキユーザーアカウントを他のOpenID対応サイトにログインすることを可能にする。',
	'openidlogin' => 'OpenIDでログイン',
	'openidfinish' => 'OpenIDでのログインが完了しました。',
	'openidserver' => 'OpenID サーバー',
	'openidxrds' => 'Yadis ファイル',
	'openidconvert' => 'OpenID コンバーター',
	'openiderror' => '検証エラー',
	'openiderrortext' => 'OpenID URLの検証中にエラーが発生しました。',
	'openidconfigerror' => 'OpenID設定エラー',
	'openidconfigerrortext' => 'このウィキの OpenID 格納設定は無効です。[[Special:ListUsers/sysop|管理者]]に相談してください。',
	'openidpermission' => 'OpenID パーミッション・エラー',
	'openidpermissiontext' => 'あなたが与えた OpenID はこのサーバーにログインすることを許可されていません。',
	'openidcancel' => '検証中止',
	'openidcanceltext' => 'OpenID URLの検証は中止されました。',
	'openidfailure' => '検証失敗',
	'openidfailuretext' => 'OpenID URLの検証は失敗しました。エラーメッセージ: "$1"',
	'openidsuccess' => '検証成功',
	'openidsuccesstext' => 'OpenID URLの検証は成功しました。',
	'openidusernameprefix' => 'OpenIDユーザー',
	'openidserverlogininstructions' => '$3 に利用者 $2 (利用者ページ $1) としてログインするには以下にパスワードを入力してください。',
	'openidtrustinstructions' => '$1 とデータを共有したいか確認してください。',
	'openidallowtrust' => '$1 がこの利用者アカウントを信用するのを許可する。',
	'openidnopolicy' => 'サイトはプライバシーに関する方針を明記していません。',
	'openidpolicy' => 'より詳しくは<a target="_new" href="$1">プライバシーに関する方針</a>を確認してください。',
	'openidoptional' => '任意',
	'openidrequired' => '必須',
	'openidnickname' => 'ニックネーム',
	'openidfullname' => 'フルネーム',
	'openidemail' => '電子メールアドレス',
	'openidlanguage' => '言語',
	'openidnotavailable' => 'あなたが選んだニックネーム ($1) は既に他の利用者が使っています。',
	'openidnotprovided' => 'あなたの OpenID サーバーはニックネームを提供していません（提供できない場合と、提供しないようあなたが指示している場合とがあります）。',
	'openidchooseinstructions' => 'すべての利用者はニックネームが必要です。以下の選択肢から1つを選ぶことができます。',
	'openidchoosefull' => 'あなたのフルネーム ($1)',
	'openidchooseurl' => 'あなたの OpenID から選んだ名前 ($1)',
	'openidchooseauto' => '自動生成された名前 ($1)',
	'openidchoosemanual' => '名前を別に設定する:',
	'openidchooseexisting' => 'このウィキに存在するアカウント:',
	'openidchoosepassword' => 'パスワード:',
	'openidconvertinstructions' => 'このフォームを使うとあなたの利用者アカウントが OpenID URLを使うように変更できます。',
	'openidconvertsuccess' => 'OpenID への変換に成功しました',
	'openidconvertsuccesstext' => 'あなたは OpenID の $1 への変換に成功しました。',
	'openidconvertyourstext' => 'これは既にあなたの OpenID です。',
	'openidconvertothertext' => 'これは他の誰かの OpenID です。',
	'openidalreadyloggedin' => "'''$1 さん、あなたは既にログインしています!'''

将来は OpenID を使ってログインしたい場合は、[[Special:OpenIDConvert|あなたのアカウントを OpenID を使うように変換する]]ことができます。",
	'openidnousername' => '利用者名が指定されていません。',
	'openidbadusername' => '利用者名の指定が不正です。',
	'openidautosubmit' => 'このページにあるフォームはあなたが JavaScript を有効にしていれば自動的に送信されるはずです。そうならない場合は、「続ける」ボタンを試してください。',
	'openidclientonlytext' => 'あなたはこのウィキのアカウントを他のサイトで OpenID として使うことができません。',
	'openidloginlabel' => 'OpenID URL',
	'openidlogininstructions' => '{{SITENAME}} はウェブサイト間でのシングルサインオンのための [http://openid.net/ OpenID] 規格に対応しています。OpenID によって、個別のパスワードを使うことなく、たくさんの様々なウェブサイトにログインできるようになります（より詳しい情報は[http://ja.wikipedia.org/wiki/OpenID ウィキペディアの OpenID についての記事]を参照してください）。

あなたが既に {{SITENAME}} でアカウントをもっている場合は、いつもどおりに利用者名とパスワードで[[Special:UserLogin|ログイン]]できます。将来、OpenID を使うためには、通常のログインをした後で[[Special:OpenIDConvert|あなたのアカウントを OpenID に変換する]]ことができます。

多くの [http://openid.net/get/ OpenID プロバイダー]が存在し、あなたは既に別のサービスで OpenID が有効となったアカウントを保持しているかもしれません。',
	'openidupdateuserinfo' => '自分の個人情報を更新',
	'openid-prefstext' => '[http://openid.net/ OpenID] の設定',
	'openid-pref-hide' => 'OpenID でログインしている場合に、あなたの OpenID をあなたの利用者ページで表示しない。',
	'openid-pref-update-userinfo-on-login' => 'ログインするたびに、自分の情報を OpenID のペルソナから更新する',
	'openidsigninorcreateaccount' => 'サインインあるいは新規アカウントの作成',
	'openid-provider-label-openid' => 'あなたの OpenID URL を入力します',
	'openid-provider-label-google' => 'あなたの Google アカウントを用いてログインする',
	'openid-provider-label-yahoo' => 'あなたの Yahoo アカウントを用いてログインする',
	'openid-provider-label-aol' => 'あなたの AOL スクリーンネームを入力します',
	'openid-provider-label-other-username' => 'あなたの $1 での利用者名を入力します',
);

/** Javanese (Basa Jawa)
 * @author Meursault2004
 */
$messages['jv'] = array(
	'openidxrds' => 'Berkas Yadis',
	'openiderror' => 'Kaluputan vérifikasi',
	'openidcancel' => 'Vérifikasi dibatalaké',
	'openidfailure' => 'Vérifikasi gagal',
	'openidtrustinstructions' => 'Mangga dipriksa yèn panjenengan péngin mbagi data karo $1.',
	'openidallowtrust' => 'Marengaké $1 percaya karo rékening panganggo iki.',
	'openidnopolicy' => 'Situs iki durung spésifikasi kawicaksanan privasi.',
	'openidoptional' => 'Opsional',
	'openidrequired' => 'Diperlokaké',
	'openidnickname' => 'Jeneng sesinglon',
	'openidfullname' => 'Jeneng jangkep',
	'openidemail' => 'Alamat e-mail',
	'openidlanguage' => 'Basa',
	'openidchooseinstructions' => 'Kabèh panganggo prelu jeneng sesinglon;
panjenengan bisa milih salah siji saka opsi ing ngisor iki.',
	'openidchoosefull' => 'Jeneng pepak panjenengan ($1)',
	'openidchooseauto' => 'Jeneng ($1) sing digawé sacara otomatis',
	'openidchoosemanual' => 'Jeneng miturut pilihan panjenengan:',
	'openidchoosepassword' => 'tembung sandhi:',
);

/** Khmer (ភាសាខ្មែរ)
 * @author IAlex
 * @author Lovekhmer
 * @author T-Rithy
 * @author Thearith
 * @author គីមស៊្រុន
 */
$messages['km'] = array(
	'openidconvert' => 'កម្មវិធីបម្លែងOpenID',
	'openiderror' => 'កំហុស​ក្នុងការផ្ទៀងផ្ទាត់',
	'openidcancel' => 'ការផ្ទៀងផ្ទាត់​ត្រូវបានលុបចោល',
	'openidfailure' => 'ការផ្ទៀងផ្ទាត់បរាជ័យ',
	'openidsuccess' => 'ផ្ទៀងផ្ទាត់ដោយជោគជ័យ',
	'openidtrustinstructions' => 'ចូរ​ពិនិត្យ ប្រសិនបើ​អ្នក​ចង់​ចែករំលែក​ទិន្នន័យ​ជាមួយ $1​។',
	'openidoptional' => 'ជាជម្រើស',
	'openidrequired' => 'ត្រូវការជាចាំបាច់',
	'openidnickname' => 'ឈ្មោះហៅក្រៅ',
	'openidfullname' => 'ឈ្មោះពេញ',
	'openidemail' => 'អាសយដ្ឋានអ៊ីមែល',
	'openidlanguage' => 'ភាសា',
	'openidnotavailable' => 'ឈ្មោះហៅក្រៅ​ដែលអ្នកពេញចិត្ត ($1) ត្រូវបានប្រើដោយ​អ្នកប្រើប្រាស់​ម្នាក់​ផ្សេងទៀតហើយ។',
	'openidchooseinstructions' => 'អ្នកប្រើប្រាស់ទាំងត្រូវការឈ្មោះហៅក្រៅ

អ្នកអាចជ្រើសរើសពីក្នុងជម្រើសខាងក្រោម។',
	'openidchoosefull' => 'ឈ្មោះពេញ​របស់អ្នក ($1)',
	'openidchoosemanual' => 'ឈ្មោះនៃជម្រើសរបស់អ្នក:',
	'openidchooseexisting' => 'គណនីមាននៅក្នុងវិគីនេះ:',
	'openidchoosepassword' => 'ពាក្យសំងាត់៖',
	'openidconvertsuccess' => 'បានបម្លែងទៅ OpenID ដោយជោគជ័យ',
	'openidconvertyourstext' => 'វាជាOpenIDរបស់អ្នករួចហើយ។',
	'openidconvertothertext' => 'វាជាOpenIDរបស់អ្នកដទៃ។',
	'openidalreadyloggedin' => "'''អ្នកបានឡុកអ៊ីនរួចហើយ $1!'''
ប្រសិនបើអ្នកចង់់ប្រើ OpenID ដើម្បីឡុកអ៊ីននាពេលអនាគត អ្នកអាច[[Special:OpenIDConvert|បម្លែងគណនីរបស់អ្នកដើម្បីប្រើ OpenID]]។",
	'openidnousername' => 'មិនមានឈ្មោះអ្នកប្រើប្រាស់បានបញ្ជាក់ទេ។',
	'openidbadusername' => 'ឈ្មោះមិនត្រឹមត្រូវត្រូវបានបញ្ជាក់',
	'openid-pref-hide' => 'លាក់OpenIDរបស់អ្នកនៅលើទំព័រអ្នកប្រើប្រាស់របស់អ្នក ប្រសិនបើអ្នកឡុកអ៊ីនដោយប្រើOpenID។',
);

/** Korean (한국어)
 * @author Ficell
 * @author Kwj2772
 */
$messages['ko'] = array(
	'openidlogin' => 'OpenID로 로그인',
	'openidserver' => 'OpenID 서버',
	'openidconvert' => 'OpenID 변환기',
	'openidconfigerror' => 'OpenID 설정 오류',
	'openidpermission' => 'OpenID 권한 오류',
	'openidemail' => '이메일 주소',
	'openidlanguage' => '언어',
	'openidchoosepassword' => '비밀번호:',
	'openidloginlabel' => 'OpenID URL',
);

/** Ripoarisch (Ripoarisch)
 * @author IAlex
 * @author Purodha
 */
$messages['ksh'] = array(
	'openid-desc' => 'Hee em Wiki met ener [http://openid.net/ OpenID] enlogge, un angerschwoh mer OpenID kennt met enem Metmaacher-Name fum Wiki enlogge.',
	'openidlogin' => 'Met OpenID enlogge',
	'openidfinish' => 'Et Enlogge met OpenID afschleeße',
	'openidserver' => 'OpenID Server',
	'openidxrds' => 'Yadis-Dattei',
	'openidconvert' => 'OpenID Ömsetzer',
	'openiderror' => 'Fähler beim Pröfe',
	'openiderrortext' => 'Ene Fähler es opjetrodde beim Pröfe fun de OpenID URL.',
	'openidconfigerror' => 'Fähler en dä Aat, wi OpenID opjesaz es',
	'openidconfigerrortext' => 'Dem OpenID sing Enstellung för Date affzelääje es nit en Odenung.
Beß esu joot un don enem [[Special:ListUsers/sysop|Wiki-Köbes]] dofun verzälle.',
	'openidpermission' => 'Fähler mem Rääsch en OpenID',
	'openidpermissiontext' => 'Met de aanjejovve OpenID darrfs de hee ävver nit enlogge.',
	'openidcancel' => 'Övverpröfung affjebroche',
	'openidcanceltext' => 'De Övverpröfung fun dä OpenID URL woht affjebroche.',
	'openidfailure' => 'Övverpröfung jingk donevve',
	'openidfailuretext' => 'De Pröfung fun de OpenID URL es donevve jejange.
Dä Fähler wohr: „$1“',
	'openidsuccess' => 'De Pröfung hät jeflupp',
	'openidsuccesstext' => 'De Pröfung fun dä OpenID URL hät jot jejange.',
	'openidusernameprefix' => 'OpenID Metmaacher',
	'openidserverlogininstructions' => 'Donn Ding Passwoot onge enjävve, öm als dä Metmaacher $2 op $3 enzelogge — de Metmaacher-Sigg es $1.',
	'openidtrustinstructions' => 'Loor, ov De de Date met $1 deile wells.',
	'openidallowtrust' => 'Donn däm $1 zojestonn, däm Metmaacher ze verdraue.',
	'openidnopolicy' => 'Die Websait udder dä Server hät nix aanjejovve övver der Schotz fun private Date.',
	'openidpolicy' => 'Loor Der de <a target="_new" href="$1">Räjele för der Schotz fun private Date</a> aan, wann De mieh do drövver wesse wels.',
	'openidoptional' => 'Nit nüdesch',
	'openidrequired' => 'Nüdesch',
	'openidnickname' => 'Spetznam',
	'openidfullname' => 'Der janze Name',
	'openidemail' => 'De e-mail Address',
	'openidlanguage' => 'Sproch',
	'openidnotavailable' => 'Dinge leevste Spetznam, „$1“, es ald beleesch,
un enen anderen Metmaacher es dä am bruche.',
	'openidnotprovided' => 'Dinge OpenID Server hät keine Spetzname aanjejovve. Künnt sin, hä kann dat nit, künnt sin, Do häss_et imm verbodde.',
	'openidchooseinstructions' => 'Jede Metmaacher bruch enne Spetznam,
Do kannß Der der Dinge unge druß üßsöke.',
	'openidchoosefull' => 'Dinge komplätte Name ($1)',
	'openidchooseurl' => 'Enne Name uß Dinge OpenID eruß jejreffe ($1)',
	'openidchooseauto' => 'Enne automattesch zerääsch jemaate Name ($1)',
	'openidchoosemanual' => 'Ene Name, dä De Der sellver ußjedaach un jejovve häs:',
	'openidchooseexisting' => 'Ene Metmaachername, dä et alld jitt op däm Wiki hee:',
	'openidchoosepassword' => 'Paßwoot:',
	'openidconvertinstructions' => 'He kanns De Ding Aanmeldung als ene Metmaacher esu aanpasse, dat De en OpenID URL bruche kanns.',
	'openidconvertsuccess' => 'De Aanpassung aan OpenID hät jeklapp',
	'openidconvertsuccesstext' => 'Do häß Ding OpenID jez ömjewandelt noh $1.',
	'openidconvertyourstext' => 'Dat es ald Ding OpenID.',
	'openidconvertothertext' => 'Dat wämm anders sing OpenID.',
	'openidalreadyloggedin' => "'''Leeven $1, Do bes all enjelogg.'''

Wann De OpenID zom Enlogge bruche wells, spääder, dann kanns De
[[Special:OpenIDConvert|Ding Aanmeldung op OpenID ömstelle]] jonn.",
	'openidnousername' => 'Keine Metmaacher-Name aanjejovve.',
	'openidbadusername' => 'Ene kapodde Metmaacher-Name aanjejovve.',
	'openidautosubmit' => 'Di Sigg enthääld_e Fomulaa för Ennjave, wat automattesch afjeschek weed, wann de Javaskrip enjeschalldt häs.
Wann nit, donn dä \\"Wigger\\" Knopp nemme.',
	'openidclientonlytext' => 'Do kann de Aanmelldunge fun hee dämm Wiki nit als <span lang="en">OpenIDs</span> op annder Webßöövere nämme.',
	'openidloginlabel' => 'OpenID URL',
	'openidlogininstructions' => 'De {{SITENAME}} ongerstöz der <span lang="en">[http://openid.net/ OpenID]</span> Standat för et eijfache un eijmoolije Enlogge zwesche diverse Websigge.
<span lang="en">OpenID</span> määd_et müjjesch, dat mer op ongerscheedlijje Websigge enlogge kann, oohne dat mer övverall en annder Paßwoot bruch.
Loor Der [http://ksh.wikipedia.org/wiki/OpenID der Wikipedia ier Atikkel övver <span lang="en">OpenID</span>] aan, do steit noch mieh dren.

Wann de alld aanjemeldt bes op de {{SITENAME}}, dann kanns De met Dingem Metmaacher-Name un Paßwoot [[Special:UserLogin|enlogge]] wi sönß och.
Öm spääder och <span lang="en">OpenID</span> ze bruche, kann noh_m nomaale Enlogge Ding Aanmeldungsdate [[Special:OpenIDConvert|op <span lang="en">OpenID</span> ömstelle]].

Et jitt en jruuße Zahl [http://wiki.openid.net/Public_OpenID_providers <span lang="en">OpenID Provider</span> för de Öffentleschkeit], un et künnt joot sin, dat De alld ene <span lang="en">OpenID</span>-fä\'ijje Zojang häß, op däm eine udder andere Server.
<!--
; Annder Wikis : Wann De op enem Wiki aanjemelldt bes, wat <span lang="en">OpenID</span> ongerschtöz, zem Beispöll [http://wikitravel.org/ Wikitravel], [http://www.wikihow.com/ wikiHow], [http://vinismo.com/ Vinismo], [http://aboutus.org/ AboutUs] udder [http://kei.ki/ Keiki], kanns de hee op de {{SITENAME}} enlogge, indämm dat De de komplätte URL fun Dinge Metmaacher-Sigg op däm aandere Wiki hee bovve endrähß. Zem Beispöll esu jät wi: \'\'<nowiki>http://kei.ki/en/User:Evan</nowiki>\'\'.
; [http://openid.yahoo.com/ Yahoo!] : Wann De bei <span lang="en">Yahoo!</span> aanjemelldt bes, kanns de hee op de {{SITENAME}} enlogge, indämm dat De de Ding <span lang="en">OpenID URL</span> bovve aanjiß, di De fun <span lang="en">Yahoo!</span> bekumme häß. Di <span lang="en">OpenID URLs</span> sinn uß wi zem Beispöll: \'\'<nowiki>https://me.yahoo.com/DingeMetmaacherName</nowiki>\'\'.
; [http://dev.aol.com/aol-and-63-million-openids AOL] : Wann de ene zohjang op [http://www.aol.com/ AOL] häß, esu jet wie ennen Zojang zom [http://www.aim.com/ AIM], do kanns de Desch hee op de {{SITENAME}} enlogge, indämm dat De de Ding <span lang="en">OpenID</span> bovve enjiß. De <span lang="en">OpenID URLs</span> fun AOL sen opjebout wi \'\'<nowiki>http://openid.aol.com/dingemetmaachername</nowiki>\'\'. Dinge Metmaacher-Name sullt uß luuter Kleinbochstave bestonn, kein Zwescheräum.
; [http://bloggerindraft.blogspot.com/2008/01/new-feature-blogger-as-openid-provider.html Blogger], [http://faq.wordpress.com/2007/03/06/what-is-openid/ Wordpress.com], [http://www.livejournal.com/openid/about.bml LiveJournal], [http://bradfitz.vox.com/library/post/openid-for-vox.html Vox] : Wann de e <span lang="en">Blog</span> op einem fun dä Söövere häß, dann draach der Url fu Dingem <span lang="en">Blog</span> bovve en. Zem Beispöll: \'\'<nowiki>http://dingeblogname.blogspot.com/</nowiki>\'\', \'\'<nowiki>http://dingeblogname.wordpress.com/</nowiki>\'\', \'\'<nowiki>http://dingeblogname.livejournal.com/</nowiki>\'\', udder \'\'<nowiki>http://dingeblogname.vox.com/</nowiki>\'\'.
<!-- -->',
	'openidupdateuserinfo' => 'Donn ming päsöönlijje Enstellunge op der neuste Stand bränge',
	'openid-prefstext' => '[http://openid.net/ OpenID] Enstellunge',
	'openid-pref-hide' => 'Versteich Ding OpenID op Dinge Metmaacher-Sigg, wann de met <span lang="en">OpenID</span> enloggs.',
	'openid-pref-update-userinfo-on-login' => 'Donn ming Enfomazjuhne vun OpenID jedesmol op der neuste Stand bränge, wann_esch hee enlogge donn',
	'openidsigninorcreateaccount' => 'Donn enlogge udder Desh neu aanmellde',
	'openid-provider-label-openid' => 'Donn Ding <i lang="en">OpenID</i> URL aanjevve',
	'openid-provider-label-google' => 'Donn met Dingem <i lang="en">Google account</i> enlogge',
	'openid-provider-label-yahoo' => 'Donn met Dinge <i lang="en">Yahoo</i> Kennung enlogge',
	'openid-provider-label-aol' => 'Donn met Dingem <i lang="en">AOL</i>-Name enlogge',
	'openid-provider-label-other-username' => 'Donn Dinge Metmaachername vun $1 aanjevve',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author IAlex
 * @author Robby
 */
$messages['lb'] = array(
	'openid-desc' => "Sech an d'Wiki matt enger [http://openid.net/ OpenID] aloggen, a sech op aneren Internetsiten, déi OpenID ënerstetzen, matt engem Wiki-Benotzerkont aloggen.",
	'openidlogin' => 'Umellen mat OpenID',
	'openidfinish' => "D'Aloggen mat OpenID ofschléissen",
	'openidserver' => 'OpenID-Server',
	'openidxrds' => 'Yadis Fichier',
	'openidconvert' => 'OpenID-Ëmwandler',
	'openiderror' => 'Feeler bäi der Iwwerpréifung',
	'openiderrortext' => 'Beim Iwwerpréifen vun der OpenID URL ass e Feeler geschitt.',
	'openidconfigerror' => 'OpenId-Konfiguratiounsfeeler',
	'openidconfigerrortext' => "D'OpenID-Späicherastellung fir dës Wiki ass falsch.
Kontaktéiert w.e.g. een [[Special:ListUsers/sysop|Administrateur]].",
	'openidpermission' => 'OpenID-Autorisatiounsfeeler',
	'openidpermissiontext' => "D'OpeniD déi Dir uginn hutt ass net erlaabt fir sech op dëse Server anzeloggen.",
	'openidcancel' => 'Iwwerpréifung ofgebrach',
	'openidcanceltext' => "D'Iwwerpréifung vun der OpenID-URL gouf ofgebrach",
	'openidfailure' => 'Feeler bei der Iwwerpréifung',
	'openidfailuretext' => 'D\'iwwerpréifung vun der OpeniD URL huet net fonctionnéiert. Feeler Message: "$1"',
	'openidsuccess' => 'Iwwerpréifung huet geklappt',
	'openidsuccesstext' => "D'Iwwerpréifung vun der OpenID-URL huet geklappt.",
	'openidusernameprefix' => 'OpenIDBenotzer',
	'openidserverlogininstructions' => 'Gitt ärt Passwuert hei ënnendrënner an, fir iech als Benotzer $2 op $3 unzemellen (Benotzersäit $1).',
	'openidtrustinstructions' => 'Klickt un wann Dir Donnéeën mat $1 deele wellt.',
	'openidallowtrust' => 'Erlaabt $1 fir dësem Benotzerkont ze vertrauen.',
	'openidnopolicy' => 'De Site huet keng Richtlinne fir den Dateschutz uginn.',
	'openidpolicy' => 'Fir méi Informatiounen <a target="_new" href="$1">kuckt d\'Dateschutzrichtlinnen</a>.',
	'openidoptional' => 'Facultatif',
	'openidrequired' => 'Obligatoresch',
	'openidnickname' => 'Spëtznumm',
	'openidfullname' => 'Ganze Numm',
	'openidemail' => 'E-Mailadress',
	'openidlanguage' => 'Sprooch',
	'openidnotavailable' => 'De Spëtznumm deen Dir wollt hun ($1) gëtt scho vun engem anere Benotzer benotzt.',
	'openidnotprovided' => 'Ären OpenID-Server huet kee Spëtznumm ginn (entweder well en dat net kann, oder well Dir him gesot huet dat ne t ze maachen).',
	'openidchooseinstructions' => 'All Benotzer brauchen e Spëtznumm; Dir kënnt iech ee vun de Méiglechkeeten ënnendrënner auswielen.',
	'openidchoosefull' => 'Äre ganze Numm ($1)',
	'openidchooseurl' => 'En Numm gouf vun ärer OpenID ($1) geholl',
	'openidchooseauto' => 'Een Numm deen automatesch generéiert gouf ($1)',
	'openidchoosemanual' => 'E Numm vun ärer Wiel:',
	'openidchooseexisting' => 'E Benotzerkont den et op dëser Wiki scho gëtt:',
	'openidchoosepassword' => 'Passwuert:',
	'openidconvertinstructions' => 'Mat dësem Formaulaire kënnt dir Äre Benotzerkont ännere fir eng OpenID URL ze benotzen.',
	'openidconvertsuccess' => 'An en OpenID-Benotzerkont ëmgewandelt',
	'openidconvertsuccesstext' => 'Dir hutt Är OpenID op $1 ëmgewandelt.',
	'openidconvertyourstext' => 'Dat ass schon är OpenID.',
	'openidconvertothertext' => 'Dëst ass engem anere seng OpenID.',
	'openidalreadyloggedin' => "'''Dir sidd schonn ageloggt, $1!'''

Wann Dir OpenID benotze wëllt fir Iech an Zukunft anzeloggen, da kënnt Dir [[Special:OpenIDConvert|Äre Benotzerkont an en OpenID-Benotzerkont ëmwandelen]].",
	'openidnousername' => 'Kee Benotzernumm uginn.',
	'openidbadusername' => 'Falsche Benotzernumm uginn.',
	'openidautosubmit' => 'Op dëser Säit gëtt et e Formulaire deen automatesch soll verschéckt ginn wann Dir JavaScript ageschalt hutt.
Wann net, da verich et mam Knäppche "Weider"',
	'openidclientonlytext' => 'Dir kënnt keng Benotzerkonten aus dëser Wiki als OpendIDen op anere Site benotzen.',
	'openidloginlabel' => 'URL vun der OpenID',
	'openidlogininstructions' => '{{SITENAME}} ënnerstetzt den [http://openid.net/ OpenID]-Standard fir eng eenheetlech Umeldung fir méi Websiten.
OpenID mellt Iech bäi ville verschiddene Websäiten un, ouni datt Dir fir jidfer Siten een anert Passwuert gebrauche musst.
(Méi Informatiounen fannt Dir am [http://de.wikipedia.org/wiki/OpenID Wikipedia-Artikel iwwer OpenID].)

Wann Dir schonn e Benotzerkont op {{SITENAME}} hutt, kënnt Dir Iech ganz normal mat ärem Benotzernumm a Passwuert [[Special:UserLogin|aloggen]].
Fir an Zukunft OpenID ze benotzen, kënnt Dir [[Special:OpenIDConvert|äre Benotzerkont op OpenID ëmwandelen]], nodeem Dir Iech normal ageloggt huet.

Et gëtt vill [http://openid.net/get/ OpenID-Provider] a méiglecherweis hutt Dir schonn e Benotzerkont mat aktivéierter OpenID bäi engem aneren Ubidder.',
	'openidupdateuserinfo' => 'Meng perséinlech Informatiounen aktualiséieren',
	'openid-prefstext' => '[http://openid.net/ OpenID]-Astellungen',
	'openid-pref-hide' => 'Verstoppt Är OpenID op ärer Benotzersäit, wann dir Iech mat OpenID aloggt.',
	'openid-pref-update-userinfo-on-login' => 'Meng Informatiounen vu mengem OpenID-Kont all Kéier aktualiséiere wann ech mech aloggen',
	'openidsigninorcreateaccount' => 'Loggt Iech an oder Maacht en neie Benotzerkont op',
	'openid-provider-label-openid' => 'Gitt Är OpenID URL un',
	'openid-provider-label-google' => 'Loggt Iech mat Ärem Goggle-Benotzerkont an',
	'openid-provider-label-yahoo' => 'Loggt Iech mat Ärem Yahoo-Benotzerkont an',
	'openid-provider-label-aol' => 'Gitt Ären AOL Numm un',
	'openid-provider-label-other-username' => 'Gitt Äre(n) $1 Benotzernumm  un',
);

/** Limburgish (Limburgs)
 * @author Ooswesthoesbes
 */
$messages['li'] = array(
	'openidchoosepassword' => 'wachwaord:',
);

/** Lithuanian (Lietuvių)
 * @author Garas
 * @author Hugo.arg
 */
$messages['lt'] = array(
	'openiderror' => 'Tikrinimo klaida',
	'openidnickname' => 'Slapyvardis',
	'openidfullname' => 'Visas vardas',
	'openidemail' => 'El. pašto adresas',
	'openidlanguage' => 'Kalba',
	'openidchoosepassword' => 'slaptažodis:',
);

/** Eastern Mari (Олык Марий)
 * @author Сай
 */
$messages['mhr'] = array(
	'openidchoosepassword' => 'шолыпмут:',
);

/** Malayalam (മലയാളം)
 * @author Shijualex
 */
$messages['ml'] = array(
	'openidlogin' => 'ഓപ്പണ്‍ ഐഡി ഉപയോഗിച്ച് ലോഗിന്‍ ചെയ്യുക',
	'openidserver' => 'OpenID സെര്‍‌വര്‍',
	'openidcancel' => 'സ്ഥിരീകരണം റദ്ദാക്കിയിരിക്കുന്നു',
	'openidfailure' => 'സ്ഥിരീകരണം പരാജയപ്പെട്ടു',
	'openidsuccess' => 'സ്ഥിരീകരണം വിജയിച്ചു',
	'openidusernameprefix' => 'ഓപ്പണ്‍ ഐഡി ഉപയോക്താവ്',
	'openidserverlogininstructions' => '$3യിലേക്ക് $2 എന്ന ഉപയോക്താവായി (ഉപയോക്തൃതാള്‍ $1) ലോഗിന്‍ ചെയ്യുവാന്‍ താങ്കളുടെ രഹസ്യവാക്ക് താഴെ രേഖപ്പെടുത്തുക.',
	'openidtrustinstructions' => '$1 താങ്കളുടെ ഡാറ്റ പങ്കുവെക്കണമോ എന്ന കാര്യം പരിശോധിക്കുക.',
	'openidnopolicy' => 'സൈറ്റ് സ്വകാര്യതാ നയം കൊടുത്തിട്ടില്ല.',
	'openidoptional' => 'നിര്‍ബന്ധമില്ല',
	'openidrequired' => 'അത്യാവശ്യമാണ്‌',
	'openidnickname' => 'ചെല്ലപ്പേര്',
	'openidfullname' => 'പൂര്‍ണ്ണനാമം',
	'openidemail' => 'ഇമെയില്‍ വിലാസം',
	'openidlanguage' => 'ഭാഷ',
	'openidnotavailable' => 'താങ്കള്‍ തിരഞ്ഞെടുത്ത വിളിപ്പേര്‌ ($1) മറ്റൊരാള്‍ ഉപയോഗിക്കുന്നതാണ്‌.',
	'openidchooseinstructions' => 'എല്ലാ ഉപയോക്താക്കള്‍ക്കും ഒരു വിളിപ്പേരു ആവശ്യമാണ്‌. താഴെ കൊടുത്തിരിക്കുന്നവയില്‍ നിന്നു ഒരെണ്ണം നിങ്ങള്‍ക്ക് തിരഞ്ഞെടുക്കാവുന്നതാണ്‌.',
	'openidchoosefull' => 'താങ്കളുടെ പൂര്‍ണ്ണനാമം ($1)',
	'openidchooseurl' => 'താങ്കളുടെ ഓപ്പണ്‍‌ഐഡിയില്‍ നിന്നു തിരഞ്ഞെടുത്ത ഒരു പേര്‌ ($1)',
	'openidchooseauto' => 'യാന്ത്രികമായി ഉണ്ടാക്കിയ പേര്‌ ($1)',
	'openidchoosemanual' => 'താങ്കള്‍ക്ക് ഇഷ്ടമുള്ള ഒരു പേര്‌:',
	'openidchooseexisting' => 'ഈ വിക്കിയില്‍ നിലവിലുള്ള അക്കൗണ്ട്:',
	'openidchoosepassword' => 'രഹസ്യവാക്ക്:',
	'openidconvertsuccess' => 'ഓപ്പണ്‍ ഐഡിയിലേക്ക് വിജയകരമായി പരിവര്‍ത്തനം ചെയ്തിരിക്കുന്നു',
	'openidconvertsuccesstext' => 'താങ്കളുടെ ഓപ്പണ്‍‌ഐഡി $1ലേക്കു വിജയകരമായി പരിവര്‍ത്തനം ചെയ്തിരിക്കുന്നു.',
	'openidconvertyourstext' => 'ഇതു ഇപ്പോള്‍ തന്നെ നിങ്ങളുടെ ഓപ്പണ്‍‌ഐഡിയാണ്‌.',
	'openidconvertothertext' => 'ഇതു മറ്റാരുടേയോ ഓപ്പണ്‍‌ഐഡിയാണ്‌.',
	'openidnousername' => 'ഉപയോക്തൃനാമം തിരഞ്ഞെടുത്തിട്ടില്ല.',
	'openidbadusername' => 'അസാധുവായ ഉപയോക്തൃനാമമാണു തിരഞ്ഞെടുത്തിരിക്കുന്നത.',
	'openidloginlabel' => 'ഓപ്പണ്‍‌ഐഡി വിലാസം',
);

/** Marathi (मराठी)
 * @author IAlex
 * @author Kaustubh
 */
$messages['mr'] = array(
	'openid-desc' => 'विकिवर [http://openid.net/ ओपनID] वापरून प्रवेश करा, तसेच कुठल्याही इतर ओपनID संकेतस्थळावर विकि सदस्य नाम वापरून प्रवेश करा',
	'openidlogin' => 'ओपनID वापरून प्रवेश करा',
	'openidfinish' => 'ओपनID प्रवेश प्रक्रिया पूर्ण करा',
	'openidserver' => 'ओपनID सर्व्हर',
	'openidxrds' => 'Yadis संचिका',
	'openidconvert' => 'ओपनID कन्व्हर्टर',
	'openiderror' => 'तपासणी त्रुटी',
	'openiderrortext' => 'ओपनID URL च्या तपासणीमध्ये त्रुटी आढळलेली आहे.',
	'openidconfigerror' => 'ओपनID व्यवस्थापन त्रुटी',
	'openidconfigerrortext' => 'या विकिसाठीचे ओपनID जतन व्यवस्थापन चुकीचे आहे.
कृपया प्रबंधकांशी संपर्क करा.',
	'openidpermission' => 'ओपनID परवानगी त्रुटी',
	'openidpermissiontext' => 'आपण दिलेल्या ओपनID या सर्व्हरवर प्रवेश करता येणार नाही.',
	'openidcancel' => 'तपासणी रद्द',
	'openidcanceltext' => 'ओपनID URL ची तपासणी रद्द केलेली आहे.',
	'openidfailure' => 'तपासणी पूर्ण झाली नाही',
	'openidfailuretext' => 'ओपनID URL ची तपासणी पूर्ण झालेली नाही. त्रुटी संदेश: "$1"',
	'openidsuccess' => 'तपासणी पूर्ण',
	'openidsuccesstext' => 'ओपनID URL ची तपासणी पूर्ण झालेली आहे.',
	'openidusernameprefix' => 'ओपनIDसदस्य',
	'openidserverlogininstructions' => '$3 वर $2 या नावाने (सदस्य पान $1) प्रवेश करण्यासाठी आपला परवलीचा शब्द खाली लिहा.',
	'openidtrustinstructions' => 'तुम्ही $1 बरोबर डाटा शेअर करू इच्छिता का याची तपासणी करा.',
	'openidallowtrust' => '$1 ला ह्या सदस्य खात्यावर विश्वास ठेवण्याची अनुमती द्या.',
	'openidnopolicy' => 'संकेतस्थळावर गोपनियता नीती दिलेली नाही.',
	'openidpolicy' => 'अधिक माहितीसाठी <a target="_new" href="$1">गुप्तता नीती</a> तपासा.',
	'openidoptional' => 'वैकल्पिक',
	'openidrequired' => 'आवश्यक',
	'openidnickname' => 'टोपणनाव',
	'openidfullname' => 'पूर्णनाव',
	'openidemail' => 'इमेल पत्ता',
	'openidlanguage' => 'भाषा',
	'openidnotavailable' => 'तुम्ही दिलेले टोपणनाव ($1) अगोदरच दुसर्‍या सदस्याने वापरलेले आहे.',
	'openidnotprovided' => 'तुमच्या ओपनID सर्व्हरने टोपणनाव दिले नाही (कदाचित तो देऊ शकत नसेल किंवा तुम्ही देण्यास मनाई केली असेल).',
	'openidchooseinstructions' => 'सर्व सदस्यांना टोपणनाव असणे आवश्यक आहे;
तुम्ही खाली दिलेल्या नावांमधून एक निवडू शकता.',
	'openidchoosefull' => 'तुमचे पूर्ण नाव ($1)',
	'openidchooseurl' => 'तुमच्या ओपनID मधून घेतलेले नाव ($1)',
	'openidchooseauto' => 'एक आपोआप तयार झालेले नाव ($1)',
	'openidchoosemanual' => 'तुमच्या आवडीचे नाव:',
	'openidchooseexisting' => 'या विकिवरील अस्तित्वात असलेले सदस्य खाते:',
	'openidchoosepassword' => 'परवलीचा शब्द:',
	'openidconvertinstructions' => 'हा अर्ज तुम्हाला ओपनID URL वापरण्यासाठी तुमचे सदस्यनाव बदलण्याची परवानगी देतो.',
	'openidconvertsuccess' => 'ओपनID मध्ये बदल पूर्ण झालेले आहेत',
	'openidconvertsuccesstext' => 'तुम्ही तुमचा ओपनID $1 मध्ये यशस्वीरित्या बदललेला आहे.',
	'openidconvertyourstext' => 'हा तुमचाच ओपनID आहे.',
	'openidconvertothertext' => 'हा दुसर्‍याचा ओपनID आहे.',
	'openidalreadyloggedin' => "'''$1, तुम्ही अगोदरच प्रवेश केलेला आहे!'''

जर तुम्ही भविष्यात ओपनID वापरून प्रवेश करू इच्छित असाल, तर तुम्ही [[Special:OpenIDConvert|तुमचे खाते ओपनID साठी बदलू शकता]].",
	'openidnousername' => 'सदस्यनाव दिले नाही.',
	'openidbadusername' => 'चुकीचे सदस्यनाव दिले आहे.',
	'openidautosubmit' => 'या पानावरील अर्ज जर तुम्ही जावास्क्रीप्ट वापरत असाल तर आपोआप पाठविला जाईल. जर तसे झाले नाही, तर \\"पुढे\\" कळीवर टिचकी मारा.',
	'openidclientonlytext' => 'या विकिवरील खाती तुम्ही इतर संकेतस्थळांवर ओपनID म्हणून वापरू शकत नाही.',
	'openidloginlabel' => 'ओपनID URL',
	'openidlogininstructions' => "{{SITENAME}} [http://openid.net/ ओपनID] वापरून विविध संकेतस्थळांवर प्रवेश करण्याची अनुमती देते.
ओपनID वापरुन तुम्ही एकाच परवलीच्या शब्दाने विविध संकेतस्थळांवर प्रवेश करू शकता.
(अधिक माहिती साठी [http://en.wikipedia.org/wiki/OpenID विकिपीडिया वरील ओपनID लेख] पहा.)

जर {{SITENAME}} वर अगोदरच तुमचे खाते असेल, तुम्ही नेहमीप्रमाणे तुमचे सदस्यनाव व परवलीचा शब्द वापरून [[Special:UserLogin|प्रवेश करा]].
भविष्यात ओपनID वापरण्यासाठी, तुम्ही प्रवेश केल्यानंतर [[Special:OpenIDConvert|तुमचे खाते ओपनID मध्ये बदला]].

अनेक [http://wiki.openid.net/Public_OpenID_providers Public ओपनID वितरक] आहेत, व तुम्ही अगोदरच ओपनID चे खाते उघडले असण्याची शक्यता आहे.

; इतर विकि : जर तुमच्याकडे ओपनID वापरणार्‍या विकिवर खाते असेल, जसे की [http://wikitravel.org/ विकिट्रॅव्हल], [http://www.wikihow.com/ विकिहाऊ], [http://vinismo.com/ विनिस्मो], [http://aboutus.org/ अबाउट‍अस] किंवा [http://kei.ki/ कैकी], तुम्ही {{SITENAME}} वर तुमच्या त्या विकिवरील सदस्य पानाची '''पूर्ण URL''' वरील पृष्ठपेटीमध्ये देऊन प्रवेश करू शकता. उदाहरणार्थ, ''<nowiki>http://kei.ki/en/User:Evan</nowiki>''.
; [http://openid.yahoo.com/ याहू!] : जर तुमच्याकडे याहू! चे खाते असेल, तर तुम्ही वरील पृष्ठपेटीमध्ये याहू! ने दिलेल्या ओपनID चा वापर करून प्रवेश करू शकता. याहू! ओपनID URL ची रुपरेषा ''<nowiki>https://me.yahoo.com/तुमचेसदस्यनाव</nowiki>'' अशी आहे.
; [http://dev.aol.com/aol-and-63-million-openids एओएल] : जर तुमच्याकडे [http://www.aol.com/ एओएल]चे खाते असेल, जसे की [http://www.aim.com/ एम] खाते, तुम्ही {{SITENAME}} वर वरील पृष्ठपेटीमध्ये एओएल ने दिलेल्या ओपनID चा वापर करून प्रवेश करू शकता. एओएल ओपनID URL ची रुपरेषा ''<nowiki>http://openid.aol.com/तुमचेसदस्यनाव</nowiki>'' अशी आहे. तुमच्या सदस्यनावात अंतर (space) चालणार नाही.
; [http://bloggerindraft.blogspot.com/2008/01/new-feature-blogger-as-openid-provider.html ब्लॉगर], [http://faq.wordpress.com/2007/03/06/what-is-openid/ वर्डप्रेस.कॉम], [http://www.livejournal.com/openid/about.bml लाईव्ह जर्नल], [http://bradfitz.vox.com/library/post/openid-for-vox.html वॉक्स] : जर यापैकी कुठेही तुमचा ब्लॉग असेल, तर वरील पृष्ठपेटीमध्ये तुमच्या ब्लॉगची URL भरा. उदाहरणार्थ, ''<nowiki>http://yourusername.blogspot.com/</nowiki>'', ''<nowiki>http://yourusername.wordpress.com/</nowiki>'', ''<nowiki>http://yourusername.livejournal.com/</nowiki>'', किंवा ''<nowiki>http://yourusername.vox.com/</nowiki>''.",
	'openid-pref-hide' => 'जर तुम्ही ओपनID वापरून प्रवेश केला, तर तुमच्या सदस्यपानावरील तुमचा ओपनID लपवा.',
);

/** Malay (Bahasa Melayu)
 * @author Aviator
 * @author Diagramma Della Verita
 */
$messages['ms'] = array(
	'openidlogin' => 'Log masuk dengan OpenID',
	'openidserver' => 'Pelayan OpenID',
	'openidxrds' => 'Fail Yadis',
	'openidconvert' => 'Penukar OpenID',
	'openiderror' => 'Ralat pengesahan',
	'openiderrortext' => 'Berlaku ralat ketika pengesahan URL OpenID.',
	'openidconfigerror' => 'Ralat konfigurasi OpenID',
	'openidconfigerrortext' => 'Konfigurasi storan OpenID bagi wiki ini tidak sah.
Sila hubungi [[Special:ListUsers/sysop|pentadbir]].',
	'openidpermission' => 'Ralat keizinan OpenID',
	'openidcancel' => 'Pengesahan telah dibatalkan',
	'openidcanceltext' => 'Pengesahan URL OpenID telah dibatalkan.',
	'openidoptional' => 'Pilihan',
	'openidrequired' => 'Wajib',
	'openidnickname' => 'Nama ringkas',
	'openidfullname' => 'Nama penuh',
	'openidemail' => 'Alamat e-mel',
	'openidlanguage' => 'Bahasa',
	'openidchoosefull' => 'Nama penuh anda ($1)',
	'openidchooseurl' => 'Nama yang dipilih daripada OpenID anda ($1)',
	'openidchooseauto' => 'Nama janaan automatik ($1)',
	'openidchoosemanual' => 'Nama pilihan anda:',
	'openidchoosepassword' => 'kata laluan:',
	'openidconvertinstructions' => 'Gunakan borang ini untuk menukar akaun anda untuk menggunakan OpenID URL.',
	'openidconvertsuccess' => 'Berjaya ditukar ke OpenID',
	'openidconvertsuccesstext' => 'Anda telah berjaya menukar OpenID ke $1.',
	'openidconvertyourstext' => 'OpenID anda seperti yang tertera.',
	'openidconvertothertext' => 'OpenID tersebut merupakan milik orang lain.',
	'openidalreadyloggedin' => "'''Anda telah log masuk, $1!'''

Sekiranya anda inign menggunakan OpenID untuk log masuk pada masa hadapan, sila [[Special:OpenIDConvert|tukar akaun anda untuk menggunakan OpenID]].",
	'openidnousername' => 'Nama pengguna tidak dinyatakan.',
	'openidbadusername' => 'Nama pengguna yang dinyatakan tidak sah.',
	'openidloginlabel' => 'URL OpenID',
);

/** Maltese (Malti)
 * @author Roderick Mallia
 */
$messages['mt'] = array(
	'openidlanguage' => 'Lingwa',
);

/** Erzya (Эрзянь)
 * @author Botuzhaleny-sodamo
 */
$messages['myv'] = array(
	'openidlanguage' => 'Кель',
	'openidchoosepassword' => 'совамо валось:',
);

/** Nahuatl (Nāhuatl)
 * @author Fluence
 */
$messages['nah'] = array(
	'openidemail' => 'E-mailcān',
	'openidlanguage' => 'Tlahtōlli',
	'openidchoosepassword' => 'tlahtōlichtacāyōtl:',
);

/** Dutch (Nederlands)
 * @author IAlex
 * @author Siebrand
 */
$messages['nl'] = array(
	'openid-desc' => 'Aanmelden bij de wiki met een [http://openid.net/ OpenID] en aanmelden bij andere websites die OpenID ondersteunen met een wikigebruiker',
	'openidlogin' => 'Aanmelden met OpenID',
	'openidfinish' => 'Aanmelden met OpenID afronden',
	'openidserver' => 'OpenID-server',
	'openidxrds' => 'Yadis-bestand',
	'openidconvert' => 'OpenID-convertor',
	'openiderror' => 'Verificatiefout',
	'openiderrortext' => 'Er is een fout opgetreden tijdens de verificatie van de OpenID URL.',
	'openidconfigerror' => 'Fout in de installatie van OpenID',
	'openidconfigerrortext' => "De instellingen van de opslag van OpenID's voor deze wiki kloppen niet.
Raadpleeg een  [[Special:ListUsers/sysop|beheerder]].",
	'openidpermission' => 'Fout in de rechten voor OpenID',
	'openidpermissiontext' => 'Met de OpenID die u hebt opgegeven kunt u niet aanmelden bij deze server.',
	'openidcancel' => 'Verificatie geannuleerd',
	'openidcanceltext' => 'De verificatie van de OpenID URL is geannuleerd.',
	'openidfailure' => 'Verificatie mislukt',
	'openidfailuretext' => 'De verificatie van de OpenID URL is mislukt. Foutmelding: "$1"',
	'openidsuccess' => 'Verificatie uitgevoerd',
	'openidsuccesstext' => 'De OpenID-URL is geverifieerd.',
	'openidusernameprefix' => 'OpenIDGebruiker',
	'openidserverlogininstructions' => 'Voer uw wachtwoord hieronder in om aan te melden bij $3 als gebruiker $2 (gebruikerspagina $1).',
	'openidtrustinstructions' => 'Controleer of u gegevens wilt delen met $1.',
	'openidallowtrust' => 'Toestaan dat $1 deze gebruiker vertrouwt.',
	'openidnopolicy' => 'De site heeft geen privacybeleid.',
	'openidpolicy' => 'Lees het <a target="_new" href="$1">privacybeleid</a> voor meer informatie.',
	'openidoptional' => 'Optioneel',
	'openidrequired' => 'Verplicht',
	'openidnickname' => 'Nickname',
	'openidfullname' => 'Volledige naam',
	'openidemail' => 'E-mailadres',
	'openidlanguage' => 'Taal',
	'openidnotavailable' => 'Uw voorkeursnaam ($1) wordt al gebruikt door een andere gebruiker.',
	'openidnotprovided' => 'Uw OpenID-server heeft geen gebruikersnaam opgegeven (omdat het niet wordt ondersteund of omdat u dit zo hebt opgegeven).',
	'openidchooseinstructions' => 'Alle gebruikers moeten een gebruikersnaam kiezen. U kunt er een kiezen uit de onderstaande opties.',
	'openidchoosefull' => 'Uw volledige naam ($1)',
	'openidchooseurl' => 'Een naam uit uw OpenID ($1)',
	'openidchooseauto' => 'Een automatisch samengestelde naam ($1)',
	'openidchoosemanual' => 'Een te kiezen naam:',
	'openidchooseexisting' => 'Een bestaande gebruiker op deze wiki:',
	'openidchoosepassword' => 'wachtwoord:',
	'openidconvertinstructions' => 'Met dit formulier kunt u uw gebruiker als OpenID URL gebruiken.',
	'openidconvertsuccess' => 'Omzetten naar OpenID is uitgevoerd',
	'openidconvertsuccesstext' => 'Uw OpenID is omgezet naar $1.',
	'openidconvertyourstext' => 'Dat is al uw OpenID.',
	'openidconvertothertext' => 'Iemand anders heeft die OpenID al in gebruik.',
	'openidalreadyloggedin' => "'''U bent al aangemeld, $1!'''

Als u in de toekomst uw OpenID wilt gebruiken om aan te melden, [[Special:OpenIDConvert|zet uw gebruiker dan om naar OpenID]].",
	'openidnousername' => 'Er is geen gebruikersnaam opgegeven.',
	'openidbadusername' => 'De opgegeven gebruikersnaam is niet toegestaan.',
	'openidautosubmit' => 'Deze pagina bevat een formulier dat automatisch wordt verzonden als JavaScript is ingeschaked.
Als dat niet werkt, klik dan op de knop "Doorgaan".',
	'openidclientonlytext' => 'U kunt gebruikers van deze wiki niet als OpenID gebruiken op een andere site.',
	'openidloginlabel' => 'OpenID URL',
	'openidlogininstructions' => '{{SITENAME}} ondersteunt de standaard [http://openid.net/ OpenID] voor maar een keer hoeven aanmelden voor meerdere websites.
Met OpenID kunt u aanmelden bij veel verschillende websites zonder voor iedere site opnieuw een wachtwoord te moeten opgeven.
Zie het [http://nl.wikipedia.org/wiki/OpenID Wikipedia-artikel over OpenID] voor meer informatie.

Als u al een gebruiker hebt op {{SITENAME}}, dan kunt u aanmelden met uw gebruikersnaam en wachtwoord zoals u normaal doet. Om in de toekomst OpenID te gebruiken, kunt u uw [[Special:OpenIDConvert|gebruiker naar OpenID omzetten]] nadat u hebt aangemeld.

Er zijn veel [http://wiki.openid.net/Public_OpenID_providers publieke OpenID-providers], en wellicht hebt u al een gebruiker voor OpenID bij een andere dienst.',
	'openidupdateuserinfo' => 'Mijn persoonlijke gegevens bijwerken',
	'openid-prefstext' => 'Voorkeuren [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Bij aanmelden met OpenID, uw OpenID op uw gebruikerspagina verbergen.',
	'openid-pref-update-userinfo-on-login' => 'Mijn informatie van mijn OpenID-persona elke keer als ik aanmeld bijwerken',
	'openidsigninorcreateaccount' => 'Aanmelden of nieuwe gebruiker aanmaken',
	'openid-provider-label-openid' => 'Voer de URL van uw OpenID in',
	'openid-provider-label-google' => 'Aanmelden met uw Google-gebruiker',
	'openid-provider-label-yahoo' => 'Aanmelden met uw Yahoo-gebruiker',
	'openid-provider-label-aol' => 'Aanmelden met uw AOL-gebruiker',
	'openid-provider-label-other-username' => 'Geef uw gebruikersnaam bij $1 in',
);

/** Norwegian Nynorsk (‪Norsk (nynorsk)‬)
 * @author Gunnernett
 * @author Harald Khan
 * @author IAlex
 * @author Jon Harald Søby
 */
$messages['nn'] = array(
	'openid-desc' => 'Logg inn på wikien med ein [http://openid.net/ OpenID] og logg inn på andre sider som bruker OpenID med kontoen herifrå',
	'openidlogin' => 'Logg inn med OpenID',
	'openidfinish' => 'Fullfør OpenID-innlogging',
	'openidserver' => 'OpenID-tenar',
	'openidxrds' => 'Yadis-fil',
	'openidconvert' => 'OpenID-konvertering',
	'openiderror' => 'Feil under stadfesting',
	'openiderrortext' => 'Ein feil oppstod under stadfesting av OpenID-adressa.',
	'openidconfigerror' => 'Konfigurasjonsfeil med OpenID',
	'openidconfigerrortext' => 'Lagreoppsettet for OpenID på denne wikien er ugyldig.
Kontakt ein [[Special:ListUsers/sysop|administrator]].',
	'openidpermission' => 'Tilgjengefeil med OpenID',
	'openidpermissiontext' => 'Du kan ikkje logga deg inn på denne tenaren med OpenID-en du oppgav.',
	'openidcancel' => 'Stadfesting avbrote',
	'openidcanceltext' => 'Stadfestinga av OpenID-adressa blei avbrote.',
	'openidfailure' => 'Stadfesting mislukkast',
	'openidfailuretext' => 'Stadfestinga av OpenID-adressa mislukkast. Feilmelding: «$1»',
	'openidsuccess' => 'Stadfestinga lukkast',
	'openidsuccesstext' => 'Stadfestinga av OpenID-adressa lukkast.',
	'openidusernameprefix' => 'OpenID-brukar',
	'openidserverlogininstructions' => 'Skriv inn passordet ditt nedanfor for å logga deg inn på $3 som $2 (brukarsida $1).',
	'openidtrustinstructions' => 'Sjekk om du ynskjer å dela data med $1.',
	'openidallowtrust' => 'Lat $1 stola på denne kontoen.',
	'openidnopolicy' => 'Sida har inga personvernerklæring.',
	'openidpolicy' => 'Sjekk <a href="_new" href="$1">personvernerklæringa</a> for meir informasjon.',
	'openidoptional' => 'Valfri',
	'openidrequired' => 'Påkravd',
	'openidnickname' => 'Kallenamn',
	'openidfullname' => 'Fullt namn',
	'openidemail' => 'E-postadressa',
	'openidlanguage' => 'Språk',
	'openidnotavailable' => 'Føretrukke kallenamn ($1) blir allereie nytta av ein annan brukar.',
	'openidnotprovided' => 'OpenID-tenaren din oppgav ikkje eit kallenamn (anten med di han ikkje kunne det, eller med di du har sagt at han ikkje skal gjera det).',
	'openidchooseinstructions' => 'All brukarar må ha eit kallenamn; du kan velja mellom vala nedanfor.',
	'openidchoosefull' => 'Fullt namn ($1)',
	'openidchooseurl' => 'Eit namn teke frå OpenID-en din ($1)',
	'openidchooseauto' => 'Eit automatisk oppretta namn ($1)',
	'openidchoosemanual' => 'Eit valfritt namn:',
	'openidchooseexisting' => 'Ein konto på denne wikien som finst frå før:',
	'openidchoosepassword' => 'passord:',
	'openidconvertinstructions' => 'Dette skjemaet lèt deg endra brukarkontoen din slik at han kan nytta ei OpenID-adressa.',
	'openidconvertsuccess' => 'Konverterte til OpenID',
	'openidconvertsuccesstext' => 'Du har konvertert din OpenID til $1.',
	'openidconvertyourstext' => 'Det er allereie din OpenID.',
	'openidconvertothertext' => 'Den OpenID-en tilhøyrer einkvan annan.',
	'openidalreadyloggedin' => "'''Du er allereie innlogga, $1.'''

Om du ynskjer å nytta OpenID i framtida, kan du [[Special:OpenIDConvert|konvertera kontoen din til å nytta OpenID]].",
	'openidnousername' => 'Du oppgav ingen brukarnamn.',
	'openidbadusername' => 'Du oppgav eit ugyldig brukarnamn.',
	'openidautosubmit' => 'Denne sida inneheld eit skjema som blir levert automatisk om du har JavaSvript slege på. Dersom ikkje, trykk på «Hald fram».',
	'openidclientonlytext' => 'Du kan ikkje nytta kontoar frå denne wikien som OpenID på ei onnor sida.',
	'openidloginlabel' => 'OpenID-adressa',
	'openidlogininstructions' => '{{SITENAME}} støttar [http://openid.net/ OpenID]-standarden for einskapleg innlogging på forskjellige nettstader. OpenID lèt deg logga inn på mange forskjellige nettsider utan at du må nytta forskjellige passord på kvar. (Sjå [http://nn.wikipedia.org/wiki/OpenID Wikipedia-artikkelen om OpenID] for meir informasjon.)

Om du allereie har ein konto på {{SITENAME}}, kan du [[Special:UserLogin|logga på]] som vanleg med brukarnamnet og passordet ditt. For å nytta OpenID i framtida, kan du [[Special:OpenIDConvert|konvertera kontoen din til OpenID]] etter at du har logga inn på vanleg vis.

Det er mange [http://wiki.openid.net/Public_OpenID_providers leverandørar av OpenID], og du kan allereie ha ein OpenID-aktivert konto ein annan stad.',
	'openidupdateuserinfo' => 'Oppdatér min personlege informasjon',
	'openid-prefstext' => '[http://openid.net/ OpenID] instillingar',
	'openid-pref-hide' => 'Gøym OpenID på brukarsida di om du loggar inn med ein.',
	'openid-pref-update-userinfo-on-login' => 'Oppdatér informasjonen min frå OpenID-persona kvar gong eg loggar inn',
	'openidsigninorcreateaccount' => 'Logg inn eller lag ein ny konto',
	'openid-provider-label-openid' => 'Skriv inn din OpenID URL',
	'openid-provider-label-google' => 'Logg inn ved bruk av di Google-konto',
	'openid-provider-label-yahoo' => 'Logg inn ved å bruka din Yahoo-konto',
	'openid-provider-label-aol' => 'Skriv inn til AOL skjermnamn',
	'openid-provider-label-other-username' => 'Skriv inn $1-brukarnamnet ditt',
);

/** Norwegian (bokmål)‬ (‪Norsk (bokmål)‬)
 * @author IAlex
 * @author Jon Harald Søby
 * @author Nghtwlkr
 */
$messages['no'] = array(
	'openid-desc' => 'Logg inn på wikien med en [http://openid.net/ OpenID] og logg inn på andre sider som bruker OpenID med kontoen herfra',
	'openidlogin' => 'Logg inn med OpenID',
	'openidfinish' => 'Fullfør OpenID-innlogging',
	'openidserver' => 'OpenID-tjener',
	'openidxrds' => 'Yadis-fil',
	'openidconvert' => 'OpenID-konvertering',
	'openiderror' => 'Bekreftelsesfeil',
	'openiderrortext' => 'En feil oppsto under bekrefting av OpenID-adressen.',
	'openidconfigerror' => 'Oppsettsfeil med OpenID',
	'openidconfigerrortext' => 'Lagringsoppsettet for OpenID på denne wikien er ugyldig.
Vennligst kontakt en [[Special:ListUsers/sysop|administrator]].',
	'openidpermission' => 'Tillatelsesfeil med OpenID',
	'openidpermissiontext' => 'Du kan ikke logge inn på denne tjeneren med OpenID-en du oppga.',
	'openidcancel' => 'Bekreftelse avbrutt',
	'openidcanceltext' => 'Bekreftelsen av OpenID-adressen ble avbrutt.',
	'openidfailure' => 'Bekreftelse mislyktes',
	'openidfailuretext' => 'Bekreftelse av OpenID-adressen mislyktes. Feilbeskjed: «$1»',
	'openidsuccess' => 'Bekreftelse lyktes',
	'openidsuccesstext' => 'Bekreftelse av OpenID-adressen lyktes.',
	'openidusernameprefix' => 'OpenID-bruker',
	'openidserverlogininstructions' => 'Skriv inn passordet ditt nedenfor for å logge på $3 som $2 (brukerside $1).',
	'openidtrustinstructions' => 'Sjekk om du ønsker å dele data med $1.',
	'openidallowtrust' => 'La $1 stole på denne kontoen.',
	'openidnopolicy' => 'Siden har ingen personvernerklæring.',
	'openidpolicy' => 'Sjekk <a href="_new" href="$1">personvernerklæringen</a> for mer informasjon.',
	'openidoptional' => 'Valgfri',
	'openidrequired' => 'Påkrevd',
	'openidnickname' => 'Kallenavn',
	'openidfullname' => 'Fullt navn',
	'openidemail' => 'E-postadresse',
	'openidlanguage' => 'Språk',
	'openidnotavailable' => 'Foretrukket kallenavn ($1) brukes allerede av en annen bruker.',
	'openidnotprovided' => 'OpenID-tjeneren din oppga ikke et kallenavn (enten fordi den ikke kunne det, eller fordi du har sagt at den ikke skal gjøre det).',
	'openidchooseinstructions' => 'Alle brukere må ha et kallenavn; du kan velge blant valgene nedenfor.',
	'openidchoosefull' => 'Fullt navn ($1)',
	'openidchooseurl' => 'Et navn tatt fra din OpenID ($1)',
	'openidchooseauto' => 'Et automatisk opprettet navn ($1)',
	'openidchoosemanual' => 'Et valgfritt navn:',
	'openidchooseexisting' => 'En eksisterende konto på denne wikien:',
	'openidchoosepassword' => 'passord:',
	'openidconvertinstructions' => 'Dette skjemaet lar deg endre brukerkontoen din til å bruke en OpenID-adresse.',
	'openidconvertsuccess' => 'Konverterte til OpenID',
	'openidconvertsuccesstext' => 'Du har konvertert din OpenID til $1.',
	'openidconvertyourstext' => 'Det er allerede din OpenID.',
	'openidconvertothertext' => 'Den OpenID-en tilhører noen andre.',
	'openidalreadyloggedin' => "'''$1, du er allerede logget inn.'''

Om du ønsker å bruke OpenID i framtiden, kan du [[Special:OpenIDConvert|konvertere kontoen din til å bruke OpenID]].",
	'openidnousername' => 'Intet brukernavn oppgitt.',
	'openidbadusername' => 'Ugyldig brukernavn oppgitt.',
	'openidautosubmit' => 'Denne siden inneholder et skjema som vil leveres automatisk om du har JavaScript slått på. Om ikke, trykk på «Fortsett».',
	'openidclientonlytext' => 'Du kan ikke bruke kontoer fra denne wikien som OpenID på en annen side.',
	'openidloginlabel' => 'OpenID-adresse',
	'openidlogininstructions' => '{{SITENAME}} støtter [http://openid.net/ OpenID]-standarden for enhetlig innlogging på forskjellige nettsteder.
OpenID lar deg logge inn på mange forskjellige nettsider uten at du må bruke forskjellige passord på hver.
(Se [http://nn.wikipedia.org/wiki/OpenID Wikipedia-artikkelen om OpenID] for mer informasjon.)

Om du allerede har en konto på {{SITENAME}}, kan du [[Special:UserLogin|logga på]] som vanlig med brukarnavnet og passordet ditt.
For å bruke OpenID i fremtiden, kan du [[Special:OpenIDConvert|konvertere kontoen din til OpenID]] etter at du har logget inn på vanlig måte.

Det er mange [http://wiki.openid.net/Public_OpenID_providers leverandører av OpenID], og du kan allerede ha en OpenID-aktivert konto et annet sted.',
	'openidupdateuserinfo' => 'Oppdater min personlige informasjon',
	'openid-prefstext' => '[http://openid.net/ OpenID] innstillinger',
	'openid-pref-hide' => 'Skjul OpenID på brukersiden din om du logger inn med en.',
	'openid-pref-update-userinfo-on-login' => 'Oppdater min informasjon fra OpenID-persona hver gang jeg logger inn',
	'openidsigninorcreateaccount' => 'Logg inn eller lag en ny konto',
	'openid-provider-label-openid' => 'Skriv inn din OpenID-nettadresse',
	'openid-provider-label-google' => 'Logg inn med din Google-konto',
	'openid-provider-label-yahoo' => 'Logg inn med din Yahoo-konto',
	'openid-provider-label-aol' => 'Skriv inn ditt AOL-skjermnavn',
	'openid-provider-label-other-username' => 'Skriv inn ditt $1-brukernavn',
);

/** Occitan (Occitan)
 * @author Cedric31
 * @author IAlex
 */
$messages['oc'] = array(
	'openid-desc' => "Se connecta al wiki amb [http://openid.net/ OpenID] e se connecta a d'autres sits internet OpenID amb un wiki utilizant un compte d'utilizaire.",
	'openidlogin' => 'Se connectar amb OpenID',
	'openidfinish' => 'Acabar la connexion OpenID',
	'openidserver' => 'Servidor OpenID',
	'openidxrds' => 'Fichièr Yadis',
	'openidconvert' => 'Convertisseire OpenID',
	'openiderror' => 'Error de verificacion',
	'openiderrortext' => "Una error es intervenguda pendent la verificacion de l'adreça OpenID.",
	'openidconfigerror' => 'Error de configuracion de OpenID',
	'openidconfigerrortext' => "L'estocatge de la configuracion OpenID per aqueste wiki es incorrècte.
Metetz-vos en rapòrt amb l’[[Special:ListUsers/sysop|administrator]].",
	'openidpermission' => 'Error de permission OpenID',
	'openidpermissiontext' => "L’OpenID qu'avètz provesida es pas autorizada a se connectar sus aqueste servidor.",
	'openidcancel' => 'Verificacion anullada',
	'openidcanceltext' => 'La verificacion de l’adreça OpenID es estada anullada.',
	'openidfailure' => 'Fracàs de la verificacion',
	'openidfailuretext' => 'La verificacion de l’adreça OpenID a fracassat. Messatge d’error : « $1 »',
	'openidsuccess' => 'Verificacion capitada',
	'openidsuccesstext' => 'Verificacion de l’adreça OpenID capitada.',
	'openidusernameprefix' => 'Utilizaire OpenID',
	'openidserverlogininstructions' => "Picatz vòstre senhal çaijós per vos connectar sus $3 coma utilizaire '''$2''' (pagina d'utilizaire $1).",
	'openidtrustinstructions' => 'Marcatz se desiratz partejar las donadas amb $1.',
	'openidallowtrust' => "Autoriza $1 a far fisança a aqueste compte d'utilizaire.",
	'openidnopolicy' => 'Lo sit a pas indicat una politica de las donadas personnalas.',
	'openidpolicy' => 'Verificar la <a target="_new" href="$1">Politica de las donadas personalas</a> per mai d’entresenhas.',
	'openidoptional' => 'Facultatiu',
	'openidrequired' => 'Exigit',
	'openidnickname' => 'Escais',
	'openidfullname' => 'Nom complet',
	'openidemail' => 'Adreça de corrièr electronic',
	'openidlanguage' => 'Lenga',
	'openidnotavailable' => 'Vòstre escais preferit ($1) ja es utilizat per un autre utilizaire.',
	'openidnotprovided' => "Vòstre servidor OpenID a pas pogut provesir un escais (siá o pòt pas, siá li avètz demandat d'o far pas mai).",
	'openidchooseinstructions' => "Totes los utilizaires an besonh d'un escais ; ne podètz causir un a partir de la causida çaijós.",
	'openidchoosefull' => 'Vòstre nom complet ($1)',
	'openidchooseurl' => 'Un nom es estat causit dempuèi vòstra OpenID ($1)',
	'openidchooseauto' => 'Un nom creat automaticament ($1)',
	'openidchoosemanual' => "Un nom qu'avètz causit :",
	'openidchooseexisting' => 'Un compte existent sus aqueste wiki :',
	'openidchoosepassword' => 'Senhal :',
	'openidconvertinstructions' => "Aqueste formulari vos daissa cambiar vòstre compte d'utilizaire per utilizar una adreça OpenID.",
	'openidconvertsuccess' => 'Convertit amb succès cap a OpenID',
	'openidconvertsuccesstext' => 'Avètz convertit amb succès vòstra OpenID cap a $1.',
	'openidconvertyourstext' => 'Ja es vòstra OpenID.',
	'openidconvertothertext' => "Aquò es quicòm d'autre qu'una OpenID.",
	'openidalreadyloggedin' => "'''Ja sètz connectat, $1 !'''

Se desiratz utilizar vòstra OpenID per vos connectar ulteriorament, podètz [[Special:OpenIDConvert|convertir vòstre compte per utilizar OpenID]].",
	'openidnousername' => 'Cap de nom d’utilizaire es pas estat indicat.',
	'openidbadusername' => 'Un nom d’utilizaire marrit es estat indicat.',
	'openidautosubmit' => "Aquesta pagina conten un formulari que poiriá èsser mandat automaticament s'avètz activat JavaScript.
S’èra pas lo cas, ensajatz lo boton « Contunhar ».",
	'openidclientonlytext' => 'Podètz pas utilizar de comptes dempuèi aqueste wiki en tant qu’OpenID sus d’autres sits.',
	'openidloginlabel' => 'Adreça OpenID',
	'openidlogininstructions' => "{{SITENAME}} supòrta lo format [http://openid.net/ OpenID] estandard per una sola signatura entre de sits Internet.
OpenID vos permet de vos connectar sus maites sits diferents sens aver d'utilizar un senhal diferent per cadun d’entre eles.
(Vejatz [http://en.wikipedia.org/wiki/OpenID Wikipedia's OpenID article] per mai d'entresenhas.)

S'avètz ja un compte sus {{SITENAME}}, vos podètz [[Special:UserLogin|connectar]] amb vòstre nom d'utilizaire e son senhal coma de costuma. Per utilizar OpenID, a l’avenidor, podètz [[Special:OpenIDConvert|convertir vòstre compte en OpenID]] aprèp vos èsser connectat normalament.

Existís maites [http://wiki.openid.net/Public_OpenID_providers provesidors d'OpenID publicas], e podètz ja obténer un compte OpenID activat sus un autre servici.",
	'openidupdateuserinfo' => 'Metre a jorn mas donadas personalas',
	'openid-prefstext' => 'Preferéncias de [http://openid.net/ OpenID]',
	'openid-pref-hide' => "Amaga vòstra OpenID sus vòstra pagina d'utilizaire, se vos connectaz amb OpenID.",
	'openid-pref-update-userinfo-on-login' => 'Metre a jorn mas donadas personalas dempuèi OpenID a cada còp que me connecti',
	'openidsigninorcreateaccount' => 'Se connectar o crear un compte novèl',
	'openid-provider-label-openid' => 'Picatz vòstra URL OpenID',
	'openid-provider-label-google' => 'Vos connectar en utilizant vòstre compte Google',
	'openid-provider-label-yahoo' => 'Vos connectar en utilizant vòstre compte Yahoo',
	'openid-provider-label-aol' => 'Picatz vòstre nom AOL',
	'openid-provider-label-other-username' => "Picatz vòstre nom d'utilizaire $1",
);

/** Ossetic (Иронау)
 * @author Amikeco
 */
$messages['os'] = array(
	'openidnickname' => 'Фæсномыг',
	'openidlanguage' => 'Æвзаг',
	'openidchoosepassword' => 'пароль:',
);

/** Plautdietsch (Plautdietsch)
 * @author Slomox
 */
$messages['pdt'] = array(
	'openidchoosepassword' => 'Passwuat:',
);

/** Polish (Polski)
 * @author Maikking
 * @author Sp5uhe
 */
$messages['pl'] = array(
	'openid-desc' => 'Logowanie się do wiki z użyciem [http://openid.net/ OpenID], oraz logowanie się do innych witryn używających OpenID z użyciem konta użytkownika z wiki',
	'openidlogin' => 'Zaloguj używając OpenID',
	'openidfinish' => 'Zakończ zalogowanie z użyciem OpenID',
	'openidserver' => 'Serwer OpenID',
	'openidxrds' => 'Plik Yadis',
	'openidconvert' => 'Obsługa OpenID',
	'openiderror' => 'Błąd weryfikacji',
	'openiderrortext' => 'Wystąpił błąd podczas weryfikacji adresu URL OpenID.',
	'openidconfigerror' => 'Błąd konfiguracji OpenID',
	'openidconfigerrortext' => 'Konfiguracja przechowywania w OpenID dla tej wiki jest nieprawidłowa.
Skonsultuj to z [[Special:ListUsers/sysop|administratorem]].',
	'openidpermission' => 'Błąd uprawnień OpenID',
	'openidpermissiontext' => 'OpenID, które podałeś nie ma uprawnień do logowania na ten serwer.',
	'openidcancel' => 'Weryfikacja anulowana',
	'openidcanceltext' => 'Weryfikacja adresu URL OpenID została przerwana.',
	'openidfailure' => 'Weryfikacja nie powiodła się',
	'openidfailuretext' => 'Weryfikacja adresu URL OpenID nie powiodła się. Komunikat o błędzie – „$1”',
	'openidsuccess' => 'Weryfikacja udana',
	'openidsuccesstext' => 'Zweryfikowano adres URL OpenID.',
	'openidusernameprefix' => 'UżytkownikOpenID',
	'openidserverlogininstructions' => 'Wpisz swoje hasło, aby zalogować się do $3 jako użytkownik $2 (strona użytkownika $1).',
	'openidtrustinstructions' => 'Sprawdź, czy chcesz wymieniać informacje z $1.',
	'openidallowtrust' => 'Zezwól $1 na użycie tego konta użytkownika.',
	'openidnopolicy' => 'Witryna nie ma określonej polityki prywatności.',
	'openidpolicy' => 'Zapoznaj się z <a target="_new" href="$1">polityką prywatności</a> aby uzyskać więcej informacji.',
	'openidoptional' => 'Opcjonalnie',
	'openidrequired' => 'Wymagane',
	'openidnickname' => 'Nazwa użytkownika',
	'openidfullname' => 'Imię i nazwisko',
	'openidemail' => 'Adres e‐mail',
	'openidlanguage' => 'Język',
	'openidnotavailable' => 'Wybrana nazwa użytkownika „$1” jest już zajęta.',
	'openidnotprovided' => 'Twój serwer OpenID nie dostarczył pseudonimu (dlatego że nie mógł albo mu zabroniłeś).',
	'openidchooseinstructions' => 'Wszyscy użytkownicy muszą mieć pseudonim.
Możesz wybrać spośród propozycji podanych poniżej.',
	'openidchoosefull' => 'Twoje imię i nazwisko ($1)',
	'openidchooseurl' => 'Nazwa wybrana spośród OpenID ($1)',
	'openidchooseauto' => 'Automatycznie utworzono nazwę użytkownika ($1)',
	'openidchoosemanual' => 'Nazwa użytkownika wybrana przez Ciebie',
	'openidchooseexisting' => 'Istniejące konto na tej wiki',
	'openidchoosepassword' => 'hasło',
	'openidconvertinstructions' => 'Formularz umożliwia przystosowanie konta użytkownika do korzystania z adresu URL OpenID.',
	'openidconvertsuccess' => 'Przełączone na korzystanie z OpenID',
	'openidconvertsuccesstext' => 'Zmieniłeś swoje OpenID na $1.',
	'openidconvertyourstext' => 'Już masz swój OpenID.',
	'openidconvertothertext' => 'To jest OpenID należące do kogoś innego.',
	'openidalreadyloggedin' => "'''Jesteś już zalogowany jako $1!'''

Jeśli chcesz w przyszłości używać OpenID do logowania się, możesz [[Special:OpenIDConvert|przełączyć konto na korzystanie z OpenID]].",
	'openidnousername' => 'Nie wybrano żadnej nazwy użytkownika.',
	'openidbadusername' => 'Wybrano nieprawidłową nazwę użytkownika.',
	'openidautosubmit' => 'Strona zawiera formularz, który powinien zostać automatycznie przesłany jeśli masz włączoną obsługę JavaScript.
Jeśli nie spróbuj wcisnąć klawisz „Kontynuuj”.',
	'openidclientonlytext' => 'Nie można korzystać z kont tej wiki jako OpenID w innych witrynach.',
	'openidloginlabel' => 'Adres URL OpenID',
	'openidlogininstructions' => '{{SITENAME}} korzysta ze standardu [http://openid.net/ OpenID] dla zapewnienia jednolitego uwierzytelnienia pomiędzy różnymi witrynami w sieci Web.
OpenID pozwala na zalogowanie się do wielu różnych witryn sieci Web bez użycia osobnego hasła dla każdej witryny. 
(Zobacz [http://pl.wikipedia.org/wiki/OpenID artykuł o OpenID w Wikipedii] jeśli chcesz uzyskać więcej informacji.)

Jeśli masz już konto w {{GRAMMAR:MS.lp|{{SITENAME}}}}, możesz [[Special:UserLogin|zalogować się]] jak zwykle używając nazwy użytkownika i hasła. 
Jeśli chcesz w przyszłości używać OpenID do logowania się, możesz [[Special:OpenIDConvert|przełączyć konto na korzystanie z OpenID]] po normalnym zalogowaniu się.

Jest wielu [http://openid.net/get/ operatorów usługi OpenID] i możesz mieć już konto przełączone na korzystanie z OpenID innego usługodawcy.',
	'openidupdateuserinfo' => 'Uaktualnij moje dane',
	'openid-prefstext' => 'Preferencje [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Ukryj mój adres URL OpenID na stronie użytkownika, jeśli zaloguję się za pomocą OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Aktualizuj informacje o mnie z OpenID za każdym razem w czasie logowania',
	'openidsigninorcreateaccount' => 'Zaloguj się lub utwórz nowe konto',
	'openid-provider-label-openid' => 'Wprowadź adres OpenID',
	'openid-provider-label-google' => 'Zaloguj się korzystając z konta Google',
	'openid-provider-label-yahoo' => 'Zaloguj się korzystając z konta Yahoo',
	'openid-provider-label-aol' => 'Wprowadź nazwę wyświetlaną AOL',
	'openid-provider-label-other-username' => 'Wprowadź swoją nazwę użytkownika $1',
);

/** Pashto (پښتو)
 * @author Ahmed-Najib-Biabani-Ibrahimkhel
 */
$messages['ps'] = array(
	'openidnickname' => 'کورنی نوم',
	'openidfullname' => 'بشپړ نوم',
	'openidemail' => 'برېښليک پته',
	'openidlanguage' => 'ژبه',
	'openidchooseinstructions' => 'ټولو کارونکيو ته د يوه کورني نوم اړتيا شته؛
تاسو يو نوم د لاندينيو خوښو نه ځانته ټاکلی شی.',
	'openidchoosefull' => 'ستاسو بشپړ نوم ($1)',
	'openidchoosemanual' => 'ستاسو د خوښې يو نوم:',
	'openidchoosepassword' => 'پټنوم:',
	'openidnousername' => 'هېڅ يو کارن-نوم نه دی ځانګړی شوی.',
	'openidbadusername' => 'يو ناسم کارن-نوم مو ځانګړی کړی.',
);

/** Portuguese (Português)
 * @author IAlex
 * @author Lijealso
 * @author Malafaya
 * @author Waldir
 */
$messages['pt'] = array(
	'openid-desc' => 'Autentique-se no wiki com um [http://openid.net/ OpenID], e autentique-se noutros sítios que usem OpenID com uma conta de utilizador wiki',
	'openidlogin' => 'Autenticação com OpenID',
	'openidfinish' => 'Terminar autenticação OpenID',
	'openidserver' => 'Servidor OpenID',
	'openidxrds' => 'Ficheiro Yadis',
	'openidconvert' => 'Conversor de OpenID',
	'openiderror' => 'Erro de verificação',
	'openiderrortext' => 'Ocorreu um erro durante a verificação da URL OpenID.',
	'openidconfigerror' => 'Erro de Configuração do OpenID',
	'openidconfigerrortext' => 'A configuração de armazenamento OpenID para este wiki é inválida.
Por favor, consulte um [[Special:ListUsers/sysop|administrator]].',
	'openidpermission' => 'Erro de permissões OpenID',
	'openidpermissiontext' => 'O OpenID fornecido não está autorizado a autenticar-se neste servidor.',
	'openidcancel' => 'Verificação cancelada',
	'openidcanceltext' => 'A verificação da URL OpenID foi cancelada.',
	'openidfailure' => 'Verificação falhou',
	'openidfailuretext' => 'A verificação da URL OpenID falhou. Mensagem de erro: "$1"',
	'openidsuccess' => 'Verificação com sucesso',
	'openidsuccesstext' => 'A verificação da URL OpenID foi bem sucedida.',
	'openidusernameprefix' => 'UtilizadorOpenID',
	'openidserverlogininstructions' => 'Introduza a sua palavra-chave abaixo para se autenticar em $3 como utilizador $2 (página de utilizador $1).',
	'openidtrustinstructions' => 'Verifique se pretender partilhar dados com $1.',
	'openidallowtrust' => 'Permitir que $1 confie nesta conta de utilizador.',
	'openidnopolicy' => 'O sítio não especificou uma política de privacidade.',
	'openidpolicy' => 'Consulte a <a target="_new" href="$1">política de privacidade</a> para mais informações.',
	'openidoptional' => 'Opcional',
	'openidrequired' => 'Requerido',
	'openidnickname' => 'Alcunha',
	'openidfullname' => 'Nome completo',
	'openidemail' => 'Endereço de e-mail',
	'openidlanguage' => 'Língua',
	'openidnotavailable' => 'A sua alcunha preferida ($1) já está em uso por outro utilizador.',
	'openidnotprovided' => 'O seu servidor OpenID não forneceu uma alcunha (ou porque não pôde, ou porque você lhe disse para não o fazer).',
	'openidchooseinstructions' => 'Todos os utilizadores precisam de uma alcunha;
pode escolher uma das opções abaixo.',
	'openidchoosefull' => 'O seu nome completo ($1)',
	'openidchooseurl' => 'Um nome escolhido a partir do seu OpenID ($1)',
	'openidchooseauto' => 'Um nome gerado automaticamente ($1)',
	'openidchoosemanual' => 'Um nome à sua escolha:',
	'openidchooseexisting' => 'Uma conta existente neste wiki:',
	'openidchoosepassword' => 'palavra-chave:',
	'openidconvertinstructions' => 'Este formulário permite-lhe alterar a sua conta de utilizador para usar uma URL OpenID.',
	'openidconvertsuccess' => 'Convertido para OpenID com sucesso',
	'openidconvertsuccesstext' => 'Você converteu com sucesso o seu OpenID para $1.',
	'openidconvertyourstext' => 'Esse já é o seu OpenID.',
	'openidconvertothertext' => 'Esse é o OpenID de outra pessoa.',
	'openidalreadyloggedin' => "'''Você já se encontra autenticado, $1!'''

Se de futuro pretender usar OpenID para se autenticar, pode [[Special:OpenIDConvert|converter a sua conta para usar OpenID]].",
	'openidnousername' => 'Nenhum nome de utilizador especificado.',
	'openidbadusername' => 'Nome de utilizador especificado inválido.',
	'openidautosubmit' => 'Esta página inclui um formulário que deverá ser automaticamente submetido se tiver JavaScript activado.
Caso contrário, utilize o botão \\"Continuar\\".',
	'openidclientonlytext' => 'Você pode usar contas deste wiki como OpenIDs noutro sítio.',
	'openidloginlabel' => 'URL do OpenID',
	'openidlogininstructions' => '{{SITENAME}} suporta o padrão [http://openid.net/ OpenID] para autenticação única entre sítios Web.
O OpenID permite-lhe autenticar-se em diversos sítios Web sem usar uma palavra-chave diferente em cada um.
(Veja [http://pt.wikipedia.org/wiki/OpenID o artigo OpenID na Wikipédia] para mais informação.)

Se já possui uma conta em {{SITENAME}}, pode [[Special:UserLogin|autenticar-se]] com o seu nome de utilizador e palavra-chave como habitualmente.
Para utilizar o OpenID no futuro, pode [[Special:OpenIDConvert|converter a sua conta em OpenID]] após autenticar-se normalmente.

Existems vários [http://wiki.openid.net/Public_OpenID_providers fornecederes de OpenID], e você poderá já ter uma conta ativada para OpenID noutro serviço.',
	'openidupdateuserinfo' => 'Atualizar a minha informação pessoal',
	'openid-prefstext' => 'Preferências do [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Esconder o seu OpenID na sua página de utilizador, se se autenticar com OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Atualizar a minha informação a partir da minha "persona" OpenID cada vez que me autentico',
	'openidsigninorcreateaccount' => 'Entrar ou Criar Nova Conta',
	'openid-provider-label-openid' => 'Introduza a sua URL OpenID',
	'openid-provider-label-google' => 'Entrar usando a sua conta do Google',
	'openid-provider-label-yahoo' => 'Entrar usando a sua conta do Yahoo',
	'openid-provider-label-aol' => 'Digite seu nome de utilizador AOL',
	'openid-provider-label-other-username' => 'Introduza o seu nome de utilizador $1',
);

/** Brazilian Portuguese (Português do Brasil)
 * @author Eduardo.mps
 * @author IAlex
 */
$messages['pt-br'] = array(
	'openid-desc' => 'Autentique-se no wiki com um [http://openid.net/ OpenID], e autentique-se em outros sítios que usem OpenID com uma conta de utilizador wiki',
	'openidlogin' => 'Autenticação com OpenID',
	'openidfinish' => 'Terminar autenticação OpenID',
	'openidserver' => 'Servidor OpenID',
	'openidxrds' => 'Arquivo Yadis',
	'openidconvert' => 'Conversor de OpenID',
	'openiderror' => 'Erro de verificação',
	'openiderrortext' => 'Ocorreu um erro durante a verificação da URL OpenID.',
	'openidconfigerror' => 'Erro de Configuração do OpenID',
	'openidconfigerrortext' => 'A configuração de armazenamento OpenID para este wiki é inválida.
Por favor, consulte um [[Special:ListUsers/sysop|administrator]].',
	'openidpermission' => 'Erro de permissões OpenID',
	'openidpermissiontext' => 'O OpenID fornecido não está autorizado a autenticar-se neste servidor.',
	'openidcancel' => 'Verificação cancelada',
	'openidcanceltext' => 'A verificação da URL OpenID foi cancelada.',
	'openidfailure' => 'Verificação falhou',
	'openidfailuretext' => 'A verificação da URL OpenID falhou. Mensagem de erro: "$1"',
	'openidsuccess' => 'Verificação com sucesso',
	'openidsuccesstext' => 'A verificação da URL OpenID foi bem sucedida.',
	'openidusernameprefix' => 'UtilizadorOpenID',
	'openidserverlogininstructions' => 'Introduza a sua palavra-chave abaixo para se autenticar em $3 como utilizador $2 (página de utilizador $1).',
	'openidtrustinstructions' => 'Verifique se pretende compartilhar dados com $1.',
	'openidallowtrust' => 'Permitir que $1 confie nesta conta de utilizador.',
	'openidnopolicy' => 'O sítio não especificou uma política de privacidade.',
	'openidpolicy' => 'Consulte a <a target="_new" href="$1">política de privacidade</a> para mais informações.',
	'openidoptional' => 'Opcional',
	'openidrequired' => 'Requerido',
	'openidnickname' => 'Apelido',
	'openidfullname' => 'Nome completo',
	'openidemail' => 'Endereço de e-mail',
	'openidlanguage' => 'Língua',
	'openidnotavailable' => 'O seu apelido preferido ($1) já está em uso por outro utilizador.',
	'openidnotprovided' => 'O seu servidor OpenID não forneceu um apelido(ou porque não pôde, ou porque você lhe disse para não o fazer).',
	'openidchooseinstructions' => 'Todos os utilizadores precisam de um apelido;
pode escolher uma das opções abaixo.',
	'openidchoosefull' => 'O seu nome completo ($1)',
	'openidchooseurl' => 'Um nome escolhido a partir do seu OpenID ($1)',
	'openidchooseauto' => 'Um nome gerado automaticamente ($1)',
	'openidchoosemanual' => 'Um nome à sua escolha:',
	'openidchooseexisting' => 'Uma conta existente neste wiki:',
	'openidchoosepassword' => 'palavra-chave:',
	'openidconvertinstructions' => 'Este formulário lhe permite alterar a sua conta de utilizador para usar uma URL OpenID.',
	'openidconvertsuccess' => 'Convertido para OpenID com sucesso',
	'openidconvertsuccesstext' => 'Você converteu com sucesso o seu OpenID para $1.',
	'openidconvertyourstext' => 'Esse já é o seu OpenID.',
	'openidconvertothertext' => 'Esse é o OpenID de outra pessoa.',
	'openidalreadyloggedin' => "'''Você já se encontra autenticado, $1!'''

Se no futuro pretender usar OpenID para se autenticar, pode [[Special:OpenIDConvert|converter a sua conta para usar OpenID]].",
	'openidnousername' => 'Nenhum nome de utilizador especificado.',
	'openidbadusername' => 'Nome de utilizador especificado inválido.',
	'openidautosubmit' => 'Esta página inclui um formulário que deverá ser automaticamente submetido se tiver JavaScript ativado.
Caso contrário, utilize o botão \\"Continuar\\".',
	'openidclientonlytext' => 'Você pode usar contas deste wiki como OpenIDs em outro sítio.',
	'openidloginlabel' => 'URL do OpenID',
	'openidlogininstructions' => '{{SITENAME}} suporta o padrão [http://openid.net/ OpenID] para autenticação única entre sítios Web.
O OpenID lhe permite autenticar-se em diversos sítios Web sem usar uma palavra-chave diferente em cada um.
(Veja [http://pt.wikipedia.org/wiki/OpenID o artigo OpenID na Wikipédia] para mais informação.)

Se já possui uma conta em {{SITENAME}}, pode [[Special:UserLogin|autenticar-se]] com o seu nome de utilizador e palavra-chave como habitualmente.
Para utilizar o OpenID no futuro, pode [[Special:OpenIDConvert|converter a sua conta em OpenID]] após autenticar-se normalmente.

Existem vários [http://wiki.openid.net/Public_OpenID_providers fornecederes de OpenID], e você poderá já ter uma conta ativada para OpenID em outro serviço.',
	'openidupdateuserinfo' => 'Atualizar a minha informação pessoal',
	'openid-prefstext' => 'Preferências do [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Esconder o seu OpenID na sua página de utilizador, caso se autentique com OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Atualizar a minha informação a partir da minha "persona" OpenID cada vez que me autentico',
	'openidsigninorcreateaccount' => 'Entrar ou Criar Nova Conta',
	'openid-provider-label-openid' => 'Introduza a sua URL OpenID',
	'openid-provider-label-google' => 'Entrar usando a sua conta do Google',
	'openid-provider-label-yahoo' => 'Entrar usando a sua conta do Yahoo',
	'openid-provider-label-aol' => 'Digite seu nome de utilizador AOL',
	'openid-provider-label-other-username' => 'Introduza o seu nome de utilizador $1',
);

/** Romanian (Română)
 * @author KlaudiuMihaila
 */
$messages['ro'] = array(
	'openidcancel' => 'Verificare anulată',
	'openidfailure' => 'Verificare eşuată',
	'openidsuccess' => 'Verificare cu succes',
	'openidoptional' => 'Opţional',
	'openidemail' => 'Adresă e-mail',
	'openidlanguage' => 'Limbă',
	'openidchoosemanual' => 'Un nume la alegere:',
	'openidchooseexisting' => 'Un cont existent pe acest wiki:',
	'openidchoosepassword' => 'parolă:',
);

/** Tarandíne (Tarandíne)
 * @author Joetaras
 */
$messages['roa-tara'] = array(
	'openidxrds' => 'File Yadis',
	'openidoptional' => 'Opzionele',
	'openidrequired' => 'Richieste',
	'openidemail' => 'Indirizze e-mail',
	'openidlanguage' => 'Lènghe',
	'openidchoosepassword' => 'password:',
);

/** Russian (Русский)
 * @author Aleksandrit
 * @author Ferrer
 * @author IAlex
 * @author Александр Сигачёв
 */
$messages['ru'] = array(
	'openid-desc' => 'Вход в вики с помощью [http://openid.net/ OpenID], а также вход на другие сайты поддерживающие OpenID с помощью учётной записи в вики',
	'openidlogin' => 'Вход с помощью OpenID',
	'openidfinish' => 'Завершить вход OpenID',
	'openidserver' => 'Сервер OpenID',
	'openidxrds' => 'Файл Yadis',
	'openidconvert' => 'Преобразователь OpenID',
	'openiderror' => 'Ошибка проверки полномочий',
	'openiderrortext' => 'Во время проверки адреса OpenID произошла ошибка.',
	'openidconfigerror' => 'Ошибка настройки OpenID',
	'openidconfigerrortext' => 'Настройка хранилища OpenID для этой вики ошибочна.
Пожалуйста, обратитесь к [[Special:ListUsers/sysop|администратору сайта]].',
	'openidpermission' => 'Ошибка прав доступа OpenID',
	'openidpermissiontext' => 'Указанный OpenID не позволяет войти на этот сервер.',
	'openidcancel' => 'Проверка отменена',
	'openidcanceltext' => 'Проверка адреса OpenID была отменена.',
	'openidfailure' => 'Проверка неудачна',
	'openidfailuretext' => 'Проверка адреса OpenID завершилась неудачей. Сообщение об ошибке: «$1»',
	'openidsuccess' => 'Проверка прошла успешно',
	'openidsuccesstext' => 'Проверка адреса OpenID прошла успешно.',
	'openidusernameprefix' => 'УчастникOpenID',
	'openidserverlogininstructions' => 'Введите ниже ваш пароль, чтобы войти на $3 как пользователь $2 (личная страница $1).',
	'openidtrustinstructions' => 'Отметьте, если вы хотите предоставить доступ к данным для $1.',
	'openidallowtrust' => 'Разрешить $1 доверять этой учётной записи.',
	'openidnopolicy' => 'Сайт не указал политику конфиденциальности.',
	'openidpolicy' => 'Дополнительную информацию см. в <a target="_new" href="$1">политике конфиденциальности</a>.',
	'openidoptional' => 'необязательное',
	'openidrequired' => 'обязательное',
	'openidnickname' => 'Псевдоним',
	'openidfullname' => 'Полное имя',
	'openidemail' => 'Адрес эл. почты',
	'openidlanguage' => 'Язык',
	'openidnotavailable' => 'Указанный вами псевдоним ($1) уже используется другим участником.',
	'openidnotprovided' => 'Ваш сервер OpenID не предоставил псевдоним (либо потому, что он не может, либо потому, что вы указали не делать этого)',
	'openidchooseinstructions' => 'Каждый участник должен иметь псевдоним;
вы можете выбрать один из представленных ниже.',
	'openidchoosefull' => 'Ваше полное имя ($1)',
	'openidchooseurl' => 'Имя, полученное из вашего OpenID ($1)',
	'openidchooseauto' => 'Автоматически созданное имя ($1)',
	'openidchoosemanual' => 'Имя на ваш выбор:',
	'openidchooseexisting' => 'Существующая учётная запись на этой вики:',
	'openidchoosepassword' => 'пароль:',
	'openidconvertinstructions' => 'Эта форма позволяет вам сменить использование учётной записи на использование адреса OpenID.',
	'openidconvertsuccess' => 'Успешное преобразование в OpenID',
	'openidconvertsuccesstext' => 'Вы успешно преобразовали ваш OpenID в $1.',
	'openidconvertyourstext' => 'Это уже ваш OpenID.',
	'openidconvertothertext' => 'Это чужой OpenID.',
	'openidalreadyloggedin' => "'''Вы уже вошли, $1!'''

Если вы желаете использовать в будущем вход через OpenID, вы можете [[Special:OpenIDConvert|преобразовать вашу учётную запись для использования в OpenID]].",
	'openidnousername' => 'Не указано имя участника.',
	'openidbadusername' => 'Указано неверное имя участника.',
	'openidautosubmit' => 'Эта страница содержит форму, которая должна быть автоматически отправлена, если у вас включён JavaScript.
Если этого не произошло, попробуйте нажать на кнопку «Продолжить».',
	'openidclientonlytext' => 'Вы не можете использовать учётные записи с этой вики, как OpenID на другом сайте.',
	'openidloginlabel' => 'Адрес OpenID',
	'openidlogininstructions' => '{{SITENAME}} поддерживает стандарт [http://openid.net/ OpenID], позволяющий использовать одну учётную запись для входа на различные веб-сайты.
OpenID позволяет вам заходить на различные веб-сайты без указания разных паролей для них
(подробнее см. [http://ru.wikipedia.org/wiki/OpenID статью об OpenID в Википедии]).

Если вы уже имеете учётную запись на {{SITENAME}}, вы можете [[Special:UserLogin|войти]] как обычно, используя  ваши имя пользователя и пароль.
Чтобы использовать в дальнейшем OpenID, вы можете [[Special:OpenIDConvert|преобразовать вашу учётную запись в  OpenID]], после того, как вы вошли обычным образом.

Существует множество [http://wiki.openid.net/Public_OpenID_providers общедоступных провайдеров OpenID], возможно, вы уже имеете учётную запись OpenID на другом сайте.',
	'openidupdateuserinfo' => 'Обновить мою личную информацию',
	'openid-prefstext' => 'Параметры [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Скрывать ваш OpenID на вашей странице участника, если вы вошли с помощью OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Обновлять информацию обо мне через OpenID каждый раз, когда я представляюсь системе',
	'openidsigninorcreateaccount' => 'Представиться системе или создать новую учётную запись',
	'openid-provider-label-openid' => 'Введите URL вашего OpenID',
	'openid-provider-label-google' => 'Представиться, используя учётную запись Google',
	'openid-provider-label-yahoo' => 'Представиться, используя учётную запись Yahoo',
	'openid-provider-label-aol' => 'Введите ваше имя в AOL',
	'openid-provider-label-other-username' => 'Введите ваше имя участника $1',
);

/** Sicilian (Sicilianu)
 * @author IAlex
 * @author Santu
 */
$messages['scn'] = array(
	'openid-desc' => "Fai lu login a la wiki cu [http://openid.net/ OpenID] r a l'àutri siti web ca non ùsanu OpenID cu n'account wiki",
	'openidlogin' => 'Login cu OpenID',
	'openidfinish' => 'Cumpleta lu login OpenID',
	'openidserver' => 'server OpenID',
	'openidxrds' => 'file Yadis',
	'openidconvert' => 'cunvirtituri OpenID',
	'openiderror' => 'Sbàgghiu di virìfica',
	'openiderrortext' => "Ci fu n'erruri ntô mentri dâ virìfica di l'URL OpenID.",
	'openidconfigerror' => 'Sbàgghiu ntâ cunfigurazzioni OpenID',
	'openidconfigerrortext' => 'La cunfigurazzioni dâ mimurizzazzioni di OpenID pi sta wiki non è vàlida.
Pi favuri addumanna cunzigghiu a nu [[Special:ListUsers/sysop|amministraturi]].',
	'openidpermission' => 'Sbàgghiu nna li pirmessi OpenID',
	'openidpermissiontext' => "Non vinni pirmuttutu di fari lu login a stu server a l'OpenID ca dasti.",
	'openidcancel' => 'Virìfica scancillata',
	'openidcanceltext' => "La virìfica di l'URL OpenID vinni scancillata.",
	'openidfailure' => 'Virìfica falluta',
	'openidfailuretext' => 'La virìfica di l\'URL OpenID fallìu. Missaggiu di erruri: "$1"',
	'openidsuccess' => 'Virìfica fatta',
	'openidsuccesstext' => "La virìfica di l'URL OpenID vinni fatta cu successu.",
	'openidusernameprefix' => 'Utenti OpenID',
	'openidserverlogininstructions' => 'Nzirisci di sècutu la tò password pi fari lu  login a  $3 comu utenti $2 (pàggina utenti  $1).',
	'openidtrustinstructions' => 'Cuntrolla si disìi cunnivìdiri li dati cu $1.',
	'openidallowtrust' => "Pirmetti a $1 di fidàrisi di st'account utenti.",
	'openidnopolicy' => "Lu situ non pricisau na pulìtica supr'a la privacy.",
	'openidpolicy' => 'Cuntrolla la  <a target="_new" href="$1">pulìtica supr\'a la privacy</a> pi chiossai nfurmazzioni.',
	'openidoptional' => 'Facultativu',
	'openidrequired' => 'Addumannatu',
	'openidnickname' => 'Nickname',
	'openidfullname' => 'Nomu cumpretu',
	'openidemail' => 'Nnirizzu e-mail',
	'openidlanguage' => 'Lingua',
	'openidnotavailable' => "Lu tò nickname favuritu ($1) ci l'havi già n'àutru utenti.",
	'openidnotprovided' => 'Lu tò server OpenID non desi nu nickname (o picchi non potti o picchi ci dicisti di non fàrilu).',
	'openidchooseinstructions' => "Tutti l'utenti hannu di bisognu di nu nickname;
ni poi pigghiari unu di chisti ccà di sècutu.",
	'openidchoosefull' => 'Lu tò nomu cumpretu ($1)',
	'openidchooseurl' => 'Nu nomu scigghiutu dû tò OpenID ($1)',
	'openidchooseauto' => 'Nu nomu giniràtusi sulu ($1)',
	'openidchoosemanual' => 'Nu nomu scigghiutu di tia:',
	'openidchooseexisting' => "N'account ca ggià c'è nti sta wiki:",
	'openidchoosepassword' => 'password:',
	'openidconvertinstructions' => 'Stu mòdulu ti duna lu pirmessu di canciari lu tò account pi usari nu URL OpenID.',
	'openidconvertsuccess' => 'Canciatu cu successu a OpenID',
	'openidconvertsuccesstext' => 'Lu tò OpenID canciau cu sucessu a $1.',
	'openidconvertyourstext' => 'Chistu è ggià lu tò  OpenID.',
	'openidconvertothertext' => "Chistu è l'OpenID di n'àutru.",
	'openidalreadyloggedin' => "'''Facisti ggià lu login, $1!'''

Si disìi usari OpenID pi fari lu login ntô futuru, poi [[Special:OpenIDConvert|canciari lu tò account pi utilizzari OpenID]].",
	'openidnousername' => 'Nuddu nomu utenti spicificatu.',
	'openidbadusername' => 'Nomu utenti spicificatu sbagghiatu.',
	'openidautosubmit' => 'Sta pàggina havi nu mòdulu c\'avissi èssiri mannatu autumàticamenti si JavaScript ci l\'hai attivatu. Si, mmeci, nun è accuddì, prova a mùnciri lu buttuni \\"Continue\\".',
	'openidclientonlytext' => "Non poi usari li account di sta wiki comu OpenID supra a n'àutru situ.",
	'openidloginlabel' => 'URL OpenID',
	'openidlogininstructions' => "{{SITENAME}} susteni lu standard [http://openid.net/ OpenID] pô login ùnicu supr'a li siti web.
OpenID ti pirmetti di riggistràriti nni assai siti web senza utilizzari na password diffirenti pi ognidunu d'iddi.
(Leggi la [http://en.wikipedia.org/wiki/OpenID vuci di Wikipedia supr'a l'OpenID] pi cchiossai nfurmazzioni.)

Si n'account ci l'hai gìa supr'a {{SITENAME}}, poi fari lu [[Special:UserLogin|login]] cu lu tò nomu utentu e la tò password comu ô sòlitu.
Pi utilizzari OpenID ntô futuru, poi [[Special:OpenIDConvert|canciari lu tò account a OpenID]] doppu ca hà fattu lu login comu ô sòlitu.

Ci sunnu assai [http://wiki.openid.net/Public_OpenID_providers Provider OpenID pùbbrichi], e tu putissi aviri già n'account abbilitatu a l'OpenID supra a n'àutru sirvizu.

; Àutri wiki : Si pussedi n'account supra a na wiki abbilitata a l'OpenID, comu [http://wikitravel.org/ Wikitravel], [http://www.wikihow.com/ wikiHow], [http://vinismo.com/ Vinismo], [http://aboutus.org/ AboutUs] o [http://kei.ki/ Keiki], poi fari lu login a {{SITENAME}} nzirennu l<nowiki>'</nowiki>'''URL cumpretu''' dâ tò pàggina utenti nti ss'àutra wiki ntô box misu susu. P'asèmpiu, ''<nowiki>http://kei.ki/en/User:Evan</nowiki>''.
; [http://openid.yahoo.com/ Yahoo!] : Si pussedi n'account cu Yahoo!, poi fari lu login a stu situ nzirennu lu tò OpenID Yahoo! ntô box currispunnenti. Li URL OpenID Yahoo! pussèdunu la furma ''<nowiki>https://me.yahoo.com/yourusername</nowiki>''.
; [http://dev.aol.com/aol-and-63-million-openids AOL] : Si pussedi n'account cu [http://www.aol.com/ AOL], comu a n'account [http://www.aim.com/ AIM], poi fari lu login a {{SITENAME}} nzirennu lu tò OpenID AOL ntô box curripunnenti. Li URL OpenID AOL pussèdunu la furma ''<nowiki>http://openid.aol.com/yourusername</nowiki>''. Lu tò nomu utenti avissi a èssiri tuttu paru 'n caràttiri nichi, senza spàzii.
; [http://bloggerindraft.blogspot.com/2008/01/new-feature-blogger-as-openid-provider.html Blogger], [http://faq.wordpress.com/2007/03/06/what-is-openid/ Wordpress.com], [http://www.livejournal.com/openid/about.bml LiveJournal], [http://bradfitz.vox.com/library/post/openid-for-vox.html Vox] : Si pussedi nu blog supr'a unu di sti siti, nzirisci l'URL dû blog ntô box currispunnenti. P'asèmpiu, ''<nowiki>http://yourusername.blogspot.com/</nowiki>'', ''<nowiki>http://yourusername.wordpress.com/</nowiki>'', ''<nowiki>http://yourusername.livejournal.com/</nowiki>'', o ''<nowiki>http://yourusername.vox.com/</nowiki>''.",
	'openid-pref-hide' => "Ammuccia lu tò OpenID supr'a tò pàggina utenti, si fai lu login cu OpenID.",
);

/** Sinhala (සිංහල)
 * @author Asiri wiki
 */
$messages['si'] = array(
	'openidlanguage' => 'භාෂාව',
);

/** Slovak (Slovenčina)
 * @author Helix84
 * @author IAlex
 */
$messages['sk'] = array(
	'openid-desc' => 'Prihlásenie sa na wiki pomocou [http://openid.net/ OpenID] a prihlásenie na iné stránky podporujúce OpenID pomocou používateľského účtu wiki',
	'openidlogin' => 'Prihlásiť sa pomocou OpenID',
	'openidfinish' => 'Dokončiť prihlásenie pomocou OpenID',
	'openidserver' => 'OpenID server',
	'openidxrds' => 'Súbor Yadis',
	'openidconvert' => 'OpenID konvertor',
	'openiderror' => 'Chyba pri overovaní',
	'openiderrortext' => 'Počas overovania OpenID URL sa vyskytla chyba.',
	'openidconfigerror' => 'Chyba konfigurácie OpenID',
	'openidconfigerrortext' => 'Konfigurácia OpenID tejto wiki je neplatná.
Prosím, poraďte sa so [[Special:ListUsers/sysop|správcom]] tejto webovej lokality.',
	'openidpermission' => 'Chyba oprávnení OpenID',
	'openidpermissiontext' => 'OpenID, ktorý ste poskytli, nemá oprávnenie prihlásiť sa k tomuto serveru',
	'openidcancel' => 'Overovanie bolo zrušené',
	'openidcanceltext' => 'Overovanie OpenID URL bolo zrušené.',
	'openidfailure' => 'Overovanie bolo zrušené',
	'openidfailuretext' => 'Overovanie OpenID URL zlyhalo. Chybová správa: „$1“',
	'openidsuccess' => 'Overenie bolo úspešné',
	'openidsuccesstext' => 'Overenie OpenID URL bolo úspešné.',
	'openidusernameprefix' => 'PoužívateľOpenID',
	'openidserverlogininstructions' => 'Dolu zadajte heslo pre prihlásenie na $3 ako používateľ $2 (používateľská stránka $1).',
	'openidtrustinstructions' => 'Skontrolujte, či chcete zdieľať dáta s používateľom $1.',
	'openidallowtrust' => 'Povoliť $1 dôverovať tomuto používateľskému účtu.',
	'openidnopolicy' => 'Lokalita nešpecifikovala politiku ochrany osobných údajov.',
	'openidpolicy' => 'Viac informácií na stránke <a target="_new" href="$1">Ochrana osobných údajov</a>',
	'openidoptional' => 'Voliteľné',
	'openidrequired' => 'Požadované',
	'openidnickname' => 'Prezývka',
	'openidfullname' => 'Plné meno',
	'openidemail' => 'Emailová adresa',
	'openidlanguage' => 'Jazyk',
	'openidnotavailable' => 'Vašu preferovanú prezývku ($1) už používa iný používateľ.',
	'openidnotprovided' => 'Váš OpenID server neposkytol prezývku (buď preto, že nemôže alebo preto, že ste mu povedali aby ju neposkytoval).',
	'openidchooseinstructions' => 'Každý používateľ musí mať prezývku; môžete si vybrať z dolu uvedených možností.',
	'openidchoosefull' => 'Vaše plné meno ($1)',
	'openidchooseurl' => 'Meno na základe vášho OpenID ($1)',
	'openidchooseauto' => 'Automaticky vytvorené meno ($1)',
	'openidchoosemanual' => 'Meno, ktoré si vyberiete:',
	'openidchooseexisting' => 'Existujúci účet na tejto wiki:',
	'openidchoosepassword' => 'heslo:',
	'openidconvertinstructions' => 'Tento formulár vám umožňuje zmeniť váš učet, aby používal OpenID URL.',
	'openidconvertsuccess' => 'Úspešne prevedené na OpenID',
	'openidconvertsuccesstext' => 'Úspešne ste previedli váš OpenID na $1.',
	'openidconvertyourstext' => 'To už je váš OpenID.',
	'openidconvertothertext' => 'To je OpenID niekoho iného.',
	'openidalreadyloggedin' => "'''Už ste prihlásený, $1!'''

Ak chcete na prihlasovanie v budúcnosti využívať OpenID, môžete [[Special:OpenIDConvert|previesť váš účet na OpenID]].",
	'openidnousername' => 'Nebolo zadané používateľské meno.',
	'openidbadusername' => 'Bolo zadané chybné používateľské meno.',
	'openidautosubmit' => 'Táto stránka obsahuje formulár, ktorý by mal byť automaticky odoslaný ak máte zapnutý JavaScript.
Ak nie, skúste tlačidlo „Pokračovať“.',
	'openidclientonlytext' => 'Nemôžete používať účty z tejto wiki ako OpenID na iných weboch.',
	'openidloginlabel' => 'OpenID URL',
	'openidlogininstructions' => '{{SITENAME}} podporuje štandard [http://openid.net/ OpenID] na zjednotené prihlasovanie na webstránky.
OpenID vám umožňuje prihlasovať sa na množstvo rozličných webstránok bez nutnosti používať pre každú odlišné heslo. (Pozri [http://sk.wikipedia.org/wiki/OpenID Článok o OpenID na Wikipédii])

Ak už máte účet na {{GRAMMAR:lokál|{{SITENAME}}}}, môžete sa [[Special:UserLogin|prihlásiť]] pomocou používateľského mena a hesla ako zvyčajne. Ak chcete v budúcnosti používať OpenID, môžete po normálnom prihlásení [[Special:OpenIDConvert|previesť svoj účet na OpenID]].

Existuje množstvo [http://wiki.openid.net/Public_OpenID_providers Verejných poskytovateľov OpenID] a možno už máte účet s podporou OpenID u iného poskytovateľa.',
	'openidupdateuserinfo' => 'Aktualizovať moje používateľské informácie',
	'openid-prefstext' => 'Nastavenia [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Nezobrazovať váš OpenID na vašej používateľskej stránke ak sa prihlasujete pomocou OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Aktualizovať moje informácie z OpenID identity pri každom prihlásení',
	'openidsigninorcreateaccount' => 'Prihlásiť sa alebo vytvoriť nový účet',
	'openid-provider-label-openid' => 'Zadajte URL svojho OpenID',
	'openid-provider-label-google' => 'Prihlásiť sa pomocou účtu Google',
	'openid-provider-label-yahoo' => 'Prihlásiť sa pomocou účtu Yahoo',
	'openid-provider-label-aol' => 'Prihlásiť sa pomocou účtu AOL',
	'openid-provider-label-other-username' => 'Zadajte svoje prihlasovacie meno na $1',
);

/** Serbian Cyrillic ekavian (ћирилица)
 * @author Sasa Stefanovic
 * @author Михајло Анђелковић
 */
$messages['sr-ec'] = array(
	'openidfinish' => 'Заврши OpenID логовање',
	'openidserver' => 'OpenID сервер',
	'openidconvert' => 'OpenID конвертор',
	'openiderror' => 'Грешка приликом верификације',
	'openiderrortext' => 'Дошло је до грешке приликом верификације OpenID URL-а.',
	'openidconfigerror' => 'Грешка око конфигурације OpenID-а',
	'openidpermission' => 'Грешка око OpenID права приступа',
	'openidpermissiontext' => 'OpenID-у кога сте навели није дозвољено да се улогује на овај сервер.',
	'openidcancel' => 'Верификација поништена',
	'openidcanceltext' => 'Верификација OpenID URL-а је поништена.',
	'openidfailure' => 'Верификација није прошла',
	'openidfailuretext' => 'Верификација OpenID URL-a није прошла. Порука грешке: "$1"',
	'openidsuccess' => 'Верификација успешна',
	'openidsuccesstext' => 'Верификација OpenID URL-а је била успешна.',
	'openidoptional' => 'Необавезно',
	'openidrequired' => 'Обавезно',
	'openidnickname' => 'Надимак',
	'openidfullname' => 'Пуно име',
	'openidemail' => 'Е-пошта',
	'openidlanguage' => 'Језик',
	'openidchooseinstructions' => 'Сваки корисник треба да има надимак;
Можете да изаберете једну од опција испод.',
	'openidchoosefull' => 'Важе пуно име ($1)',
	'openidchooseurl' => 'Име преузето од вашег OpenID ($1)',
	'openidchooseauto' => 'Аутоматски генерисано корисничко име ($1)',
	'openidchoosemanual' => 'Изаберите корисничко име:',
	'openidchooseexisting' => 'Постојећи налог на овој Вики:',
	'openidchoosepassword' => 'лозинка:',
	'openidconvertsuccess' => 'Конверзија ка OpenID је успешна',
	'openidconvertsuccesstext' => 'Успешно сте прменили свој OpenID на $1.',
	'openidconvertyourstext' => 'Тај OpenID је већ ваш.',
	'openidconvertothertext' => 'То је туђ OpenID.',
	'openidnousername' => 'Није наведено корисничко име.',
	'openidbadusername' => 'Задато неисправно корисничко име.',
	'openidclientonlytext' => 'Ви не можете да користите налоге са овог Викија као OpenID-ове на другим сајтовима.',
	'openidloginlabel' => 'OpenID URL',
	'openidupdateuserinfo' => 'Актуализуј моје личне податке',
	'openid-prefstext' => '[http://openid.net/ OpenID] подешавања',
	'openid-pref-hide' => 'Сакријте свој OpenID URL са корисничке стране, ако се са њим логујете.',
	'openid-pref-update-userinfo-on-login' => 'Актуализуј моје информације са OpenID личност сваки пут кад се улогујем',
);

/** Seeltersk (Seeltersk)
 * @author IAlex
 * @author Pyt
 */
$messages['stq'] = array(
	'openid-desc' => 'Anmeldenge an dit Wiki mäd ne [http://openid.net/ OpenID] un anmäldje an uur Websites, do der OpenID unnerstutsje, mäd een Wiki-Benutserkonto.',
	'openidlogin' => 'Anmäldje mäd OpenID',
	'openidfinish' => 'OpenID-Anmäldenge ousluute',
	'openidserver' => 'OpenID-Server',
	'openidxrds' => 'Yadis-Doatäi',
	'openidconvert' => 'OpenID-Konverter',
	'openiderror' => 'Wröige-Failer',
	'openiderrortext' => 'Aan Failer is unner ju Wröige fon ju OpenID-URL aptreeden.',
	'openidconfigerror' => 'OpenID-Konfigurationsfailer',
	'openidconfigerrortext' => 'Ju OpenID-Spiekerkonfiguration foar dit Wiki ist failerhaft.
Täl n [[Special:ListUsers/sysop|Administrator]] Bescheed.',
	'openidpermission' => 'OpenID-Begjuchtigengsfailer',
	'openidpermissiontext' => 'Ju anroate OpenID begjuchtiget nit tou Anmäldenge an dissen Server.',
	'openidcancel' => 'Wröige oubreeken',
	'openidcanceltext' => 'Ju Wröige fon ju OpenID-URL wuud oubreeken.',
	'openidfailure' => 'Wröige-Failer',
	'openidfailuretext' => 'Ju Wröige fon ju OpenID-URL is failsloain. Failermäldenge: "$1"',
	'openidsuccess' => 'Wröige mäd Ärfoulch be-eended',
	'openidsuccesstext' => 'Ju Wröige fon ju Open-ID hied Ärfoulch.',
	'openidusernameprefix' => 'OpenID-Benutser',
	'openidserverlogininstructions' => 'Reek dien Paaswoud unner ien, uum die as Benutser $2 an $3 antoumäldjen (Benutsersiede $1).',
	'openidtrustinstructions' => 'Wröich, of du Doaten mäd $1 deele moatest.',
	'openidallowtrust' => 'Ferlööwje $1, dissen Benutserkonto tou tjouen.',
	'openidnopolicy' => 'Ju Siede häd neen Doatenschuts-Gjuchtlienje anroat.',
	'openidpolicy' => 'Wröich ju <a target="_new" href="$1">Doatenschuts-Gjuchtlienje</a> foar moor Informatione.',
	'openidoptional' => 'Optionoal',
	'openidrequired' => 'Plicht',
	'openidnickname' => 'Benutsernoome',
	'openidfullname' => 'Fulboodigen Noome',
	'openidemail' => 'E-Mail-Adresse:',
	'openidlanguage' => 'Sproake',
	'openidnotavailable' => 'Die Noome ($1), dän du dät ljooste hääst, wäd al fon n uur Benutser ferwoand.',
	'openidnotprovided' => 'Dien OpenID-Server unnerstutset neen Spitsnoomen (äntweeder, wil hie et nit kon, of deeruum dät du et him nit ferlööwed hääst).',
	'openidchooseinstructions' => 'Aal Benutsere benöödigje n Benutsernoome;
du koast aan uut ju unnerstoundene Lieste uutwääle.',
	'openidchoosefull' => 'Din fulboodigen Noome ($1)',
	'openidchooseurl' => 'N Noome uut dien OpenID ($1)',
	'openidchooseauto' => 'N automatisk moakeden Noome ($1)',
	'openidchoosemanual' => 'N Noome fon dien Woal:',
	'openidchooseexisting' => 'N existierend Benutserkonto in dit Wiki:',
	'openidchoosepassword' => 'Paaswoud:',
	'openidconvertinstructions' => 'Mäd dit Formular koast du dien Benutserkonto tou Benutsenge fon n OpenID-URL fräireeke.',
	'openidconvertsuccess' => 'Mäd Ärfoulch ätter OpenID konvertierd',
	'openidconvertsuccesstext' => 'Du hääst ju Konvertierenge fon dien OpenID ätter $1 mäd Ärfoulch truchfierd.',
	'openidconvertyourstext' => 'Dit is al dien OpenID.',
	'openidconvertothertext' => 'Dit is ju OpenID fon uurswäl.',
	'openidalreadyloggedin' => "'''Du bäst al anmälded, $1!'''

Wan du OpenID foar kuumende Anmäldefoargonge nutsje moatest, koast du [[Special:OpenIDConvert|dien Benutserkonto ätter OpenID konvertierje]].",
	'openidnousername' => 'Naan Benutsernoome anroat.',
	'openidbadusername' => 'Falsken Benutsernoome anroat.',
	'openidautosubmit' => 'Disse Siede änthaalt n Formular, dät automatisk uurdrain wäd, wan JavaSkript aktivierd is. Fals nit, klik ap „Fääre“.',
	'openidclientonlytext' => 'Du koast neen Benutserkonten uut dissen Wiki as OpenID foar uur Sieden ferweende.',
	'openidloginlabel' => 'OpenID-URL',
	'openidlogininstructions' => "{{SITENAME}} unnerstutset dän [http://openid.net/ OpenID]-Standoard foar ne Anmäldenge foar moorere Websites.
OpenID mäldet die bie fuul unnerscheedelke Websieden an, sunner dät du foar älke Siede n uur Paaswoud ferweende moast.
(Moor Informatione bjut die [http://de.wikipedia.org/wiki/OpenID Wikipedia-Artikkel tou OpenID].)

Fals du al n Benutserkonto bie {{SITENAME}} hääst, koast du die gans normoal mäd Benutsernoome un Paaswoud [[Special:UserLogin|anmäldje]].
Wan du in n Toukumst OpenID ferweende moatest, koast du [[Special:OpenIDConvert|dien Account tou OpenID konvertierje]], ätter dät du die normoal ienlogged hääst.

Dät rakt fuul [http://wiki.openid.net/Public_OpenID_providers eepentelke OpenID-Providere] un muugelkerwiese hääst du al n Benutserkonto mäd aktivierden OpenID bie n uur Anbjooder.

; Uur Sites: Wan du al n Benutserkonto ap n Wiki mäd aktivierde OpenID hääst, as biespilswiese [http://wikitravel.org/ Wikitravel], [http://www.wikihow.com/ wikiHow], [http://vinismo.com/ Vinismo], [http://aboutus.org/ AboutUs] of [http://kei.ki/ Keiki], koast du die bie {{SITENAME}} anmäldje, wan du ju '''komplette URL''' fon dien Benutsersiede ap dän uur Wiki in dät Textfäild hierbuppe ienrakst. Biespilswiese ''<nowiki>http://kei.ki/en/User:Evan</nowiki>''.
; [http://openid.yahoo.com/ Yahoo!]: Wan du n Yahoo!-Konto hääst, koast du die mäd ju fon Yahoo! anroate OpenID in dät Textfäild hierbuppe anmäldje. Yahoo!-OpenIDs hääbe ju Foarm ''<nowiki>https://me.yahoo.com/dienbenutsernoome</nowiki>''.
; [http://dev.aol.com/aol-and-63-million-openids AOL]: Wan du n [http://www.aol.com/ AOL]-Konto hääst, biespilswiese n [http://www.aim.com/ AIM]-Benutserkonto, koast du die bie {{SITENAME}} anmäldje, wan du ju fon AOL anroate OpenID in dät Textfäild hierbuppe ienrakst. AOL-OpenIDs hääbe ju Foarm ''<nowiki>http://openid.aol.com/dienbenutsernoome</nowiki>''. Dien Benutsernoome schuul bloot uut litje Bouksteeuwen bestounde un neen Loosteekene änthoolde.
; [http://bloggerindraft.blogspot.com/2008/01/new-feature-blogger-as-openid-provider.html Blogger], [http://faq.wordpress.com/2007/03/06/what-is-openid/ Wordpress.com], [http://www.livejournal.com/openid/about.bml LiveJournal], [http://bradfitz.vox.com/library/post/openid-for-vox.html Vox]: Wan du ap disse Sieden n Blog hääst, reek ju URL fon dien Blog in dät Textfäild hierbuppe ien. Biespilswiese ''<nowiki>http://deinbenutzername.blogspot.com/</nowiki>'', ''<nowiki>http://deinbenutzername.wordpress.com/</nowiki>'', ''<nowiki>http://deinbenutzername.livejournal.com/</nowiki>'', of ''<nowiki>http://deinbenutzername.vox.com/</nowiki>''.",
	'openidupdateuserinfo' => 'Persöönelke Doaten aktualisierje',
	'openid-prefstext' => '[http://openid.net/ OpenID] Ienstaalengen',
	'openid-pref-hide' => 'Fersteet dien OpenID ap dien Benutsersiede, wan du die mäd OpenID anmäldest.',
	'openid-pref-update-userinfo-on-login' => 'Mien Doaten anhound fon dät OpenID-Konto bie älke Login aktualisierje',
);

/** Sundanese (Basa Sunda)
 * @author Irwangatot
 */
$messages['su'] = array(
	'openidnickname' => 'Landihan',
	'openidlanguage' => 'Basa',
	'openidchoosepassword' => 'sandi:',
);

/** Swedish (Svenska)
 * @author Boivie
 * @author IAlex
 * @author Jon Harald Søby
 * @author Lokal Profil
 * @author M.M.S.
 * @author Najami
 */
$messages['sv'] = array(
	'openid-desc' => 'Logga in på wikin med en [http://openid.net/ OpenID] och logga in på andra sidor som använder OpenID med konton härifrån',
	'openidlogin' => 'Logga in med OpenID',
	'openidfinish' => 'Fullfölj OpenID-inloggning',
	'openidserver' => 'OpenID-server',
	'openidxrds' => 'Yadis-fil',
	'openidconvert' => 'OpenID-konvertering',
	'openiderror' => 'Bekräftelsefel',
	'openiderrortext' => 'Ett fel uppstod under bekräftning av OpenID-adressen.',
	'openidconfigerror' => 'Konfigurationsfel med OpenID',
	'openidconfigerrortext' => 'Lagringkonfigurationen för OpenID på den här wikin är ogiltig.
Var god konsultera en [[Special:ListUsers/sysop|administratör]].',
	'openidpermission' => 'Tillåtelsefel med OpenID',
	'openidpermissiontext' => 'Du kan inte logga in på den här servern med den OpenID du angedde.',
	'openidcancel' => 'Bekräftning avbruten',
	'openidcanceltext' => 'Bekräftningen av OpenID-adressen avbrytes.',
	'openidfailure' => 'Bekräftning misslyckades',
	'openidfailuretext' => 'Bekräftning av OpenID-adressen misslyckades. Felmeddelande: "$1"',
	'openidsuccess' => 'Bekräftning lyckades',
	'openidsuccesstext' => 'Bekräftning av OpenID-adressen lyckades.',
	'openidusernameprefix' => 'OpenID-användare',
	'openidserverlogininstructions' => 'Skriv in ditt lösenord nedan för att logga in på $3 som $2 (användarsida $1).',
	'openidtrustinstructions' => 'Kolla om du vill dela data med $1.',
	'openidallowtrust' => 'Tillåter $1 att förlita sig på detta användarkonto.',
	'openidnopolicy' => 'Sajten har inga riktlinjer för personlig integritet.',
	'openidpolicy' => 'Kolla <a href="_new" href="$1">riktlinjer för personlig integritet</a> för mer information.',
	'openidoptional' => 'Valfri',
	'openidrequired' => 'Behövs',
	'openidnickname' => 'Smeknamn',
	'openidfullname' => 'Fullt namn',
	'openidemail' => 'E-postadress',
	'openidlanguage' => 'Språk',
	'openidnotavailable' => 'Ditt framförda användarnamn ($1) används redan av en annan användare.',
	'openidnotprovided' => 'Din OpenID-server uppgav inte ett användarnamn (antingen för att den inte kan, eller för att du har sagt till den att den inte ska göra det).',
	'openidchooseinstructions' => 'Alla användare måste ha ett användarnamn;
du kan välja ett från alternativen nedan.',
	'openidchoosefull' => 'Fullt namn ($1)',
	'openidchooseurl' => 'Ett namn taget från din OpenID ($1)',
	'openidchooseauto' => 'Ett automatiskt genererat namn ($1)',
	'openidchoosemanual' => 'Ett valfritt namn:',
	'openidchooseexisting' => 'Ett existerande konto på denna wiki:',
	'openidchoosepassword' => 'lösenord:',
	'openidconvertinstructions' => 'Detta formulär låter dig ändra dina användarkonton till att använda en OpenID-adress.',
	'openidconvertsuccess' => 'Konverterade till OpenID',
	'openidconvertsuccesstext' => 'Du har konverterat din OpenID till $1.',
	'openidconvertyourstext' => 'Det är redan din OpenID.',
	'openidconvertothertext' => 'Den OpenID tillhör någon annan.',
	'openidalreadyloggedin' => "'''Du är redan inloggad, $1!'''

Om du vill använda OpenID att logga in i framtiden, kan du [[Special:OpenIDConvert|konvertera dina konton till att använda OpenID]].",
	'openidnousername' => 'Inget användarnamn angivet.',
	'openidbadusername' => 'Ogiltigt användarnamn angivet.',
	'openidautosubmit' => 'Denna sida innehåller ett formulär som kommer levereras automatiskt om du har slagit på JavaScript. Om inte, tryck på "Fortsätt".',
	'openidclientonlytext' => 'Du kan inte använda konton från denna wikin som OpenID på en annan sida.',
	'openidloginlabel' => 'OpenID-adress',
	'openidlogininstructions' => '{{SITENAME}} stödjer [http://openid.net/ OpenID]-standarden för enhetlig inlogging på många webbsidor.
OpenID låter dig logga in på många webbsidor utan att använda olika lösenord för varje. 
(Se [http://en.wikipedia.org/wiki/OpenID Wikipedia-artikeln om OpenID] för mer information.)

Om du redan har ett konto på {{SITENAME}}, kan du [[Special:UserLogin|logga in]] som vanligt med ditt användarnamn och lösenord.
För att använda OpenID i framtiden kan du [[Special:OpenIDConvert|konvertera ditt konton till OpenID]] efter att du har loggat in på normalt sätt.

Det finns många [http://openid.net/get/ leverantörer av OpenID], och du kan redan ha ett OpenID-aktiverat konto på en annan plats.',
	'openidupdateuserinfo' => 'Uppdatera min personliga information',
	'openid-prefstext' => '[http://openid.net/ OpenID] inställningar',
	'openid-pref-hide' => 'Dölj OpenID på din användarsida, om du loggar in med OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Uppdatera min informationen från OpenID-persona varje gång jag loggar in',
	'openidsigninorcreateaccount' => 'Logga in eller skapa ett nytt konto',
	'openid-provider-label-openid' => 'Skriv in din OpenID-URL',
	'openid-provider-label-google' => 'Logga in genom att använda ditt Google-konto',
	'openid-provider-label-yahoo' => 'Logga in genom att använda ditt Yahoo-konto',
	'openid-provider-label-aol' => 'Skriv in ditt AOL-skärmnamn',
	'openid-provider-label-other-username' => 'Skriv in ditt $1-användarnamn',
);

/** Telugu (తెలుగు)
 * @author Veeven
 */
$messages['te'] = array(
	'openidpermission' => 'ఓపెన్ఐడీ అనుమతుల పొరపాటు',
	'openidcancel' => 'తనిఖీ రద్దయింది',
	'openidfailure' => 'తనిఖీ విఫలమైంది',
	'openidsuccess' => 'తనిఖీ విజయవంతమైంది',
	'openidoptional' => 'ఐచ్చికం',
	'openidrequired' => 'తప్పనిసరి',
	'openidnickname' => 'ముద్దుపేరు',
	'openidfullname' => 'పూర్తిపేరు',
	'openidemail' => 'ఈ-మెయిల్ చిరునామా',
	'openidlanguage' => 'భాష',
	'openidchoosefull' => 'మీ పూర్తి పేరు ($1)',
	'openidchoosemanual' => 'మీరు ఎన్నుకున్న పేరు:',
	'openidchooseexisting' => 'ఈ వికీలో ఇప్పటికే ఉన్న ఖాతా:',
	'openidchoosepassword' => 'సంకేతపదం:',
	'openidconvertyourstext' => 'అది ఇప్పటికే మీ ఓపెన్ఐడీ.',
	'openidnousername' => 'వాడుకరిపేరు ఇవ్వలేదు.',
);

/** Tetum (Tetun)
 * @author MF-Warburg
 */
$messages['tet'] = array(
	'openidnickname' => "Naran uza-na'in",
	'openidfullname' => 'Naran kompletu',
	'openidemail' => 'Diresaun korreiu eletróniku',
	'openidlanguage' => 'Lian',
);

/** Tajik (Cyrillic) (Тоҷикӣ (Cyrillic))
 * @author Ibrahim
 */
$messages['tg-cyrl'] = array(
	'openid-desc' => 'Ба вики бо [http://openid.net/ OpenID] вуруд кунед, ва ба дигар сомонаҳои OpenID бо ҳисоби корбарии вики вуруд кунед',
	'openidlogin' => 'Бо OpenID вуруд кунед',
	'openidfinish' => 'Хотима додан вурудшавии OpenID',
	'openidserver' => 'Хидматгузори OpenID',
	'openidxrds' => 'Парвандаи Yadis',
	'openidconvert' => 'Табдилкунандаи OpenID',
	'openiderror' => 'Хатои тасдиқ',
	'openiderrortext' => 'Дар ҳолати тасдиқи нишонаи OpenID хатое рух дод.',
	'openidconfigerror' => 'Хатои Танзимоти OpenID',
	'openidconfigerrortext' => 'Танзимоти захирасозии OpenID барои ин вики номӯътабар аст.
Лутфан бо мудири сомона тамос бигиред.',
	'openidoptional' => 'Ихтиёрӣ',
	'openidemail' => 'Нишонаи почтаи электронӣ',
	'openidlanguage' => 'Забон',
	'openidchoosepassword' => 'гузарвожа:',
);

/** Thai (ไทย)
 * @author Passawuth
 */
$messages['th'] = array(
	'openidemail' => 'อีเมล',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 * @author IAlex
 */
$messages['tl'] = array(
	'openid-desc' => 'Lumagda sa wiki na may [http://openid.net/ OpenID], at lumagda sa iba pang mga websayt na nakakaalam sa/nakababatid ng OpenID na may kuwenta/akawnt na pang-wiki',
	'openidlogin' => 'Lumagda na may OpenID',
	'openidfinish' => 'Tapusin na ang paglagdang pang-OpenID',
	'openidserver' => 'Serbidor ng OpenID',
	'openidxrds' => 'Talaksang Yadis',
	'openidconvert' => 'Tagapagpalit ng OpenID',
	'openiderror' => 'Kamalian sa pagpapatunay',
	'openiderrortext' => 'Naganap ang isang kamalian habang pinatototohanan ang URL ng OpenID.',
	'openidconfigerror' => 'Kamalian sa pagkakaayos ng OpenID',
	'openidconfigerrortext' => 'Hindi tanggap ang kaayusang pangtaguan ng OpenID para sa wiking ito.
Makipagugnayan po lamang sa isang [[Special:ListUsers/sysop|tagapangasiwa]].',
	'openidpermission' => 'May kamalian sa mga kapahintulutang pang-OpenID',
	'openidpermissiontext' => 'Hindi pinapahintulutang makalagda sa serbidor na ito ang ibinigay mong OpenID.',
	'openidcancel' => 'Hindi itinuloy ang pagpapatotoo',
	'openidcanceltext' => 'Hindi itinuloy ang pagpapatotoo sa URL ng OpenID.',
	'openidfailure' => 'Nabigo ang pagpapatotoo',
	'openidfailuretext' => 'Nabigo ang pagpapatoo sa URL ng OpenID.  Mensaheng pangkamalian: "$1"',
	'openidsuccess' => 'Nagtagumpay ang pagpapatotoo',
	'openidsuccesstext' => 'Nagtagumpay ang pagpapatotoo sa URL ng OpenID.',
	'openidusernameprefix' => 'Tagagamit ng OpenID',
	'openidserverlogininstructions' => 'Ipasok (ilagay) ang iyong hudyat sa ibaba upang makalagda patungo sa $3 bilang si tagagamit na  $2 (pahina ng tagagamit na $1).',
	'openidtrustinstructions' => 'Pakisuri kung nais mong isalo ang dato kay $1.',
	'openidallowtrust' => 'Pahintulutan si $1 na pagkatiwalaan ang kuwenta ng tagagamit na ito.',
	'openidnopolicy' => 'Hindi tumukoy ang sityo (sayt) ng isang patakaran sa paglilihim na pansarili.',
	'openidpolicy' => 'Suriin ang <a target="_new" href="$1">patakaran sa paglilihim na pansarili</a> para sa mas marami pang kabatiran.',
	'openidoptional' => 'Opsyonal (hindi talaga kailangan/maaaring wala nito)',
	'openidrequired' => 'Kinakailangan',
	'openidnickname' => 'Bansag',
	'openidfullname' => 'Buong pangalan',
	'openidemail' => 'Adres ng e-liham',
	'openidlanguage' => 'Wika',
	'openidnotavailable' => 'Ang ninanais mong bansag na ($1) ay ginagamit na ng ibang tagagamit.',
	'openidnotprovided' => 'Hindi nagbigay ng isang bansag ang iyong serbidor ng OpenID (maaaring hindi niya ito maibigay, o dahil sinabi mo sa kaniyang huwag gawin ito).',
	'openidchooseinstructions' => 'Lahat ng mga tagagamit ay kinakailangang may bansag;
makakapili ka mula sa mga pagpipiliang nasa ibaba.',
	'openidchoosefull' => 'Ang buong pangalan mo ($1)',
	'openidchooseurl' => 'Isang pangalang napulot (napili/nakuha) mula sa iyong OpenID ($1)',
	'openidchooseauto' => 'Isang pangalang kusang nalikha ($1)',
	'openidchoosemanual' => 'Isang pangalang ikaw ang pumili:',
	'openidchooseexisting' => 'Isang umiiral na kuwenta sa wiking ito:',
	'openidchoosepassword' => 'hudyat:',
	'openidconvertinstructions' => 'Nagpapahintulot ang pormularyong ito upang mabago mo ang iyong kuwenta ng tagagamit para magamit ang isang URL ng OpenID.',
	'openidconvertsuccess' => 'Matagumpay na napalitan (nabago) upang maging OpenID',
	'openidconvertsuccesstext' => 'Matagumpay mong napalitan/nabago ang iyong OpenID para maging $1.',
	'openidconvertyourstext' => 'Iyan na mismo ang iyong OpenID.',
	'openidconvertothertext' => 'Iyan ay isa nang OpenID ng ibang tao.',
	'openidalreadyloggedin' => "'''Nakalagda ka na, $1!'''

Kung nais mong gumamit ng OpenID upang makalagda sa hinaharap, maaari mong [[Special:OpenIDConvert|palitan ang kuwenta mo para magamit ang OpenID]].",
	'openidnousername' => 'Walang tinukoy na pangalan ng tagagamit.',
	'openidbadusername' => 'Masama ang tinukoy na pangalan ng tagagamit.',
	'openidautosubmit' => 'Kabilang/kasama sa pahinang ito ang isang pormularyo na dapat na kusang maipasa/maipadala kapag hindi pinaandar (pinagana) ang JavaScript.
Kung hindi, subukin ang pindutang \\"Magpatuloy\\".',
	'openidclientonlytext' => 'Hindi mo magagamit ang mga kuwenta mula sa wiking ito bilang mga OpenID sa iba pang sityo/sayt.',
	'openidloginlabel' => 'URL ng OpenID',
	'openidlogininstructions' => "Tinatangkilik ng {{SITENAME}} ang pamantayang [http://openid.net/ OpenID] para sa mga isahang paglagda sa pagitan ng mga sayt ng Web.
Hinahayaan ka ng OpenID na makalagda sa maraming iba't ibang mga sityo ng Web na hindi gumagamit ng isang iba pang hudyat para sa bawat isa.
(Tingnan ang [http://en.wikipedia.org/wiki/OpenID lathalaing OpenID ng Wikipedia] para sa mas marami pang kabatiran.)

Kung mayroon ka nang kuwenta sa {{SITENAME}}, maaari kang [[Special:UserLogin|lumagdang papasok]] sa pamamagitan ng iyong pangalan ng tagagamit at hudyat sa karaniwang paraan.
Upang makagamit ng OpenID sa hinaharap, maaari mong [[Special:OpenIDConvert|palitan ang iyong akawnt upang maging OpenID]] pagkatapos mong lumagda sa karaniwang paraan.

Maraming mga [http://wiki.openid.net/Public_OpenID_providers tagapagbigay ng OpenID], at maaaring mayroon ka nang isang kuwentang pinagana ng OpenID na nasa iba pang palingkuran.",
	'openidupdateuserinfo' => 'Isapanahon ang aking pansariling kabatiran',
	'openid-prefstext' => 'Mga kagustuhang pang-[http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Itago ang OpenID mo sa ibabaw ng iyong pahina ng tagagamit, kapag lumagda ka sa pamamagitan ng OpenID.',
	'openid-pref-update-userinfo-on-login' => 'Isapahaon ang aking kabatiran mula sa katauhang pang-OpenID sa bawat pagkakataong lalagda akong papasok',
);

/** Turkish (Türkçe)
 * @author Joseph
 */
$messages['tr'] = array(
	'openid-desc' => 'Vikiye bir [http://openid.net/ OpenID] ile giriş yapın, ve diğer OpenID kullanan web sitelerine bir viki kullanıcı hesabıyla giriş yapın.',
	'openidlogin' => 'OpenID ile giriş yapın',
	'openidfinish' => 'OpenID girişini tamamlayın',
	'openidserver' => 'OpenID sunucusu',
	'openidxrds' => 'Yadis dosyası',
	'openidconvert' => 'OpenID çeviricisi',
	'openiderror' => 'Doğrulama hatası',
	'openiderrortext' => 'OpenID adresi doğrulanırken bir hata oluştu.',
	'openidconfigerror' => 'OpenID yapılandırma hatası',
	'openidconfigerrortext' => 'Bu viki için OpenID depolama yapılandırması geçersiz.
Lütfen bir [[Special:ListUsers/sysop|yöneticiye]] danışın.',
	'openidpermission' => 'OpenID izinleri hatası',
	'openidpermissiontext' => "Sağladığınız OpenID'nin bu sunucuya oturum açmasına izin verilmiyor.",
	'openidcancel' => 'Doğrulama iptal edildi',
	'openidcanceltext' => 'OpenID URL doğrulaması iptal edildi.',
	'openidfailure' => 'Doğrulama başarısız',
	'openidfailuretext' => 'OpenID URL doğrulaması başarısız oldu. Hata iletisi: "$1"',
	'openidsuccess' => 'Doğrulama başarılı',
	'openidsuccesstext' => 'OpenID URL doğrulaması başarılı.',
	'openidusernameprefix' => 'OpenIDKullanıcısı',
	'openidserverlogininstructions' => '$3 sitesine $2 kullanıcısı (kullanıcı sayfası $1) olarak oturum açmak için parolanızı aşağıya girin.',
	'openidtrustinstructions' => '$1 ile veri paylaşmak istediğinizi kontrol edin.',
	'openidallowtrust' => "Bu kullanıcı hesabına güvenmek için $1'e izin ver.",
	'openidnopolicy' => 'Site bir gizlilik ilkesi belirtmemiş.',
	'openidpolicy' => 'Daha fazla bilgi için <a target="_new" href="$1">gizlilik ilkesine</a> bakın.',
	'openidoptional' => 'İsteğe Bağlı',
	'openidrequired' => 'Gerekli',
	'openidnickname' => 'Kullanıcı adı',
	'openidfullname' => 'Tam ad',
	'openidemail' => 'E-posta adresi',
	'openidlanguage' => 'Dil',
	'openidnotavailable' => 'Tercih ettiğiniz kullanıcı adı ($1) zaten başka bir kullanıcı tarafından kullanımda.',
	'openidnotprovided' => 'OpenID sunucunuz bir kullanıcı adı sağlamadı (ya bunu yapamadığı için, ya da yapmamasını söylediğiniz için).',
	'openidchooseinstructions' => 'Tüm kullanıcılar için bir kullanıcı adı gereklidir;
aşağıdaki seçeneklerden birini seçebilirsiniz.',
	'openidchoosefull' => 'Tam adınız ($1)',
	'openidchooseurl' => "OpenID'nizden bir isim alındı ($1)",
	'openidchooseauto' => 'Otomatik oluşturulan bir isim ($1)',
	'openidchoosemanual' => 'Tercihinizden bir isim:',
	'openidchooseexisting' => 'Bu vikide mevcut bir hesap:',
	'openidchoosepassword' => 'parola:',
	'openidconvertinstructions' => 'Bu form bir OpenID URLsi kullanmak için kullanıcı hesabınızı değiştirmenizi sağlar.',
	'openidconvertsuccess' => 'OpenIDye başarıyla dönüştürüldü',
	'openidconvertsuccesstext' => "OpenIDnizi başarıyla $1'e dönüştürdünüz.",
	'openidconvertyourstext' => 'Bu zaten sizin OpenIDniz.',
	'openidconvertothertext' => 'Bu bir başkasının OpenIDsi.',
	'openidalreadyloggedin' => "'''Zaten oturum açtınız, $1!'''

Eğer gelecekte de oturum açmak için OpenID kullanmak isterseniz, [[Special:OpenIDConvert|hesabınızı OpenID kullanmak için dönüştürebilirsiniz]].",
	'openidnousername' => 'Herhangi bir kullanıcı adı belirtilmedi.',
	'openidbadusername' => 'Kötü bir kullanıcı adı belirtildi.',
	'openidautosubmit' => 'Bu sayfa, JavaScript etkin ise otomatik olarak gönderilmesi gereken bir form içeriyor.
Eğer değilse, \\"Devam\\" düğmesini deneyin.',
	'openidclientonlytext' => 'Bu vikideki hesapları başka sitelerde OpenID olarak kullanamazsınız.',
	'openidloginlabel' => 'OpenID URLsi',
	'openidlogininstructions' => "{{SITENAME}}, web sitelerinde tekli giriş için [http://openid.net/ OpenID] standartını desteklemektedir.
OpenID, herbirine farklı şifre kullanmadan birçok web sitesine giriş yapmanıza izin verir.
(Daha fazla bilgi için [http://en.wikipedia.org/wiki/OpenID Vikipedideki OpenID maddesine bakın].)

Eğer {{SITENAME}} sitesinde mevcut bir hesabınız varsa, her zamanki gibi kullanıcı adınız ve şifrenizle [[Special:UserLogin|giriş yapabilirsiniz]].
İleride OpenID kullanmak için, normal giriş yaptıktan sonra [[Special:OpenIDConvert|hesabınızı OpenID'ye çevirebilirsiniz]].

Birçok [http://openid.net/get/ OpenID sağlayıcısı] vardır, ve bir başka serviste halihazırda bir OpenID-etkin hesabınız olabilir.",
	'openidupdateuserinfo' => 'Kişisel bilgimi güncelle',
	'openid-prefstext' => '[http://openid.net/ OpenID] tercihleri',
	'openid-pref-hide' => 'Eğer OpenID ile giriş yaparsanız, kullanıcı sayfanızda OpenID URLnizi gizle.',
	'openid-pref-update-userinfo-on-login' => 'Her oturum açışımda OpenID karakterinden bilgilerimi güncelle',
	'openidsigninorcreateaccount' => 'Oturum açın ya da Yeni Hesap Oluşturun',
	'openid-provider-label-openid' => 'OpenID URLnizi girin',
	'openid-provider-label-google' => 'Google hesabınızı kullanarak giriş yapın',
	'openid-provider-label-yahoo' => 'Yahoo hesabınızı kullanarak giriş yapın',
	'openid-provider-label-aol' => 'AOL ekran-adınızı girin',
	'openid-provider-label-other-username' => '$1 kullanıcı adınızı girin',
);

/** ئۇيغۇرچە (ئۇيغۇرچە)
 * @author Alfredie
 */
$messages['ug-arab'] = array(
	'openidlanguage' => 'تىل',
);

/** Uighur (Latin) (Uyghurche‎ / ئۇيغۇرچە (Latin))
 * @author Jose77
 */
$messages['ug-latn'] = array(
	'openidlanguage' => 'Til',
);

/** Ukrainian (Українська)
 * @author AS
 * @author Aleksandrit
 * @author IAlex
 */
$messages['uk'] = array(
	'openid-desc' => 'Вхід у вікі за допомогою [http://openid.net/ OpenID], а також вхід на інші сайти, що підтримують OpenID за допомогою акаунта в вікі',
	'openidlogin' => 'Вхід з допомогою OpenID',
	'openidserver' => 'Сервер OpenID',
	'openidxrds' => 'Файл Yadis',
	'openidconvert' => 'Перетворювач OpenID',
	'openiderror' => 'Помилка перевірки повноважень',
	'openiderrortext' => 'Під час перевірки адреси OpenID сталася помилка.',
	'openidconfigerror' => 'Помилка налаштування OpenID',
	'openidconfigerrortext' => 'Налаштування сховища OpenID для цієї вікі помилкова.
Будь-ласка, зверніться до [[Special:ListUsers/sysop|адміністратору сайту]].',
	'openidpermission' => 'Помилка прав доступу OpenID',
	'openidpermissiontext' => 'Вказаний OpenID не дозволяє увійти на цей сервер.',
	'openidcancel' => 'Перевірку скасовано',
	'openidcanceltext' => 'Перевірка адреси OpenID була скасована.',
	'openidfailure' => 'Перевірка невдала',
	'openidfailuretext' => 'Перевірка адреси OpenID завершилася невдачею. Повідомлення про помилку: «$1»',
	'openidsuccess' => 'Перевірка пройшла успішно',
	'openidsuccesstext' => 'Перевірка адреси OpenID пройшла успішно.',
	'openidusernameprefix' => 'Користувач OpenID',
	'openidserverlogininstructions' => 'Введіть нижче ваш пароль, щоб увійти на $3 як користувач $2 (особиста сторінка $1).',
	'openidtrustinstructions' => 'Відзначте, якщо ви хочете надати доступ до даних для $1.',
	'openidallowtrust' => 'Дозволити $1 довіряти цьому акаунту.',
	'openidnopolicy' => 'Сайт не вказав політику конфіденційності.',
	'openidpolicy' => 'Додаткову інформацію можна дізнатися в <a target="_new" href="$1">політиці конфіденційності</a>.',
	'openidoptional' => "необов'язкове",
	'openidrequired' => "обов'язкове",
	'openidnickname' => 'Псевдонім',
	'openidfullname' => "Повне ім'я",
	'openidemail' => 'Адреса ел. пошти',
	'openidlanguage' => 'Мова',
	'openidnotavailable' => 'Зазначений вами псевдонім ($1) вже використовується іншим учасником.',
	'openidnotprovided' => 'Ваш сервер OpenID не надав псевдонім (чи тому, що він не може, чи тому, що ви вказали не робити цього).',
	'openidchooseinstructions' => 'Кожен користувач повинен мати псевдонім;
ви можете вибрати один з представлених нижче.',
	'openidchoosefull' => "Ваше повне ім'я ($1)",
	'openidchooseurl' => 'Ім`я, отримане з вашого OpenID ($1)',
	'openidchooseauto' => "Автоматично створене ім'я ($1)",
	'openidchoosemanual' => "Ім'я на ваш вибір:",
	'openidchooseexisting' => 'Існуючий акаунт на цій вікі:',
	'openidchoosepassword' => 'пароль:',
	'openidconvertinstructions' => 'Ця форма дозволяє вам змінити використання акаунту на використання адреси OpenID.',
	'openidconvertsuccess' => 'Успішне перетворення в OpenID',
	'openidconvertsuccesstext' => 'Ви успішно перетворили ваш OpenID в $1.',
	'openidconvertyourstext' => 'Це вже ваш OpenID.',
	'openidconvertothertext' => 'Це чужий OpenID.',
	'openidalreadyloggedin' => "'''Ви вже ввійшли, $1!'''

Якщо ви бажаєте використовувати в майбутньому вхід через OpenID, ви можете [[Special:OpenIDConvert|перетворити ваш акаунт для використання в OpenID]].",
	'openidnousername' => "Не вказано ім'я користувача.",
	'openidbadusername' => "Зазначено невірне ім'я користувача.",
	'openidautosubmit' => 'Ця сторінка містить форму, яка повинна бути автоматично відправлена, якщо у вас включений JavaScript.
Якщо цього не сталося, спробуйте натиснути на кнопку «Продовжити».',
	'openidclientonlytext' => 'Ви не можете використовувати акаунти з цієї вікі, як OpenID на іншому сайті.',
	'openidloginlabel' => 'Адреса OpenID',
	'openid-pref-hide' => 'Приховувати ваш OpenID на вашій сторінці користувача, якщо ви ввійшли з допомогою OpenID.',
);

/** Vèneto (Vèneto)
 * @author Candalua
 * @author IAlex
 */
$messages['vec'] = array(
	'openid-desc' => "Entra con [http://openid.net/ OpenID] in te la wiki, e entra in tei altri siti web che dòpara OpenID co' na utensa wiki",
	'openidlogin' => 'Acesso con OpenID',
	'openidfinish' => "Conpleta l'acesso OpenID",
	'openidserver' => 'server OpenID',
	'openidxrds' => 'file Yadis',
	'openidconvert' => 'convertidor OpenID',
	'openiderror' => 'Eròr ne la verifica',
	'openiderrortext' => "Se gà verificà un eròr durante la verifica de l'URL OpenID.",
	'openidconfigerror' => 'Eròr in te la configurassion OpenID',
	'openidconfigerrortext' => 'La configurassion de la memorixassion de OpenID par sta wiki no la xe mia valida.
Par piaser consulta un [[Special:ListUsers/sysop|aministrador]].',
	'openidpermission' => 'Eròr in tei parmessi OpenID',
	'openidpermissiontext' => "A l'OpenID che ti gà fornìo no xe mia parmesso de entrar su sto server.",
	'openidcancel' => 'Verifica anulà',
	'openidcanceltext' => "La verifica de l'URL OpenID le stà scancelà.",
	'openidfailure' => 'Verifica mia riussìa',
	'openidfailuretext' => 'La verifica de l\'URL OpenID la xe \'ndà mal. El messajo de eròr el xe: "$1"',
	'openidsuccess' => 'Verifica efetuà',
	'openidsuccesstext' => "La verifica de l'URL OpenID la xe stà fata coretamente.",
	'openidusernameprefix' => 'Utente OpenID',
	'openidserverlogininstructions' => 'Scrivi qua la to password par entrar su $3 come utente $2 (pàxena utente  $1).',
	'openidtrustinstructions' => 'Contròla se te vol dal bon condivìdar i dati con $1.',
	'openidallowtrust' => 'Parméti a $1 de fidarse de sta utensa.',
	'openidnopolicy' => "El sito no'l gà indicà na polìtega relativa a la privacy.",
	'openidpolicy' => 'Contròla la <a target="_new" href="$1">polìtega relativa a la privacy</a> par savérghene piessè.',
	'openidoptional' => 'Opzional',
	'openidrequired' => 'Obligatorio',
	'openidnickname' => 'Soranòme',
	'openidfullname' => 'Nome par intiero',
	'openidemail' => 'Indirisso de posta eletronica',
	'openidlanguage' => 'Lengoa',
	'openidnotavailable' => "El to soranòme preferìo ($1) el xe xà doparà da n'antro utente.",
	'openidnotprovided' => "El to server OpenID no'l gà fornìo un soranòme (o parché no'l gà podesto, o parché ti ti gà dito de no farlo).",
	'openidchooseinstructions' => 'Tuti i utenti i gà da verghe un soranòme;
te pol tórghene uno da le opzioni seguenti.',
	'openidchoosefull' => 'El to nome par intiero ($1)',
	'openidchooseurl' => 'Un nome sielto dal to OpenID ($1)',
	'openidchooseauto' => 'Un nome generà automaticamente ($1)',
	'openidchoosemanual' => 'Un nome a sielta tua:',
	'openidchooseexisting' => 'Na utensa esistente su sta wiki:',
	'openidchoosepassword' => 'password:',
	'openidconvertinstructions' => 'Sto modulo el te parmete de canbiar la to utensa par doparar un URL OpenID.',
	'openidconvertsuccess' => 'Convertìo con successo a OpenID',
	'openidconvertsuccesstext' => 'El to OpenID el xe stà convertìo a $1.',
	'openidconvertyourstext' => 'Sto chì el xe xà el to OpenID.',
	'openidconvertothertext' => "Sto chì el xe l'OpenID de calchidun altro.",
	'openidalreadyloggedin' => "'''Te sì xà entrà, $1!'''

Se ti vol doparar OpenID par entrar in futuro, te pol [[Special:OpenIDConvert|convertir la to utensa par doparar OpenID]].",
	'openidnousername' => 'Nissun nome utente indicà.',
	'openidbadusername' => "El nome utente indicà no'l xe mia valido.",
	'openidautosubmit' => 'Sta pàxena la include un modulo che\'l dovarìa èssar invià automaticamente se ti gà JavaScript ativà. Se no, próa a strucar el boton \\"Continua\\".',
	'openidclientonlytext' => 'No te podi doparar le utense de sta wiki come OpenID su de un altro sito.',
	'openidloginlabel' => 'URL OpenID',
	'openidlogininstructions' => "{{SITENAME}} el suporta el standard [http://openid.net/ OpenID] par el login unico sui siti web.
OpenID el te permete de registrarte in molti siti web sensa doparar na password difarente par ognuno.
(Lèzi la [http://en.wikipedia.org/wiki/OpenID voce de Wikipedia su l'OpenID] par savérghene piassè.)

Se te ghè zà un account su {{SITENAME}}, te podi far el [[Special:UserLogin|login]] col to nome utente e la to password come al solito.
Par doparar OpenID in futuro, te podi [[Special:OpenIDConvert|convertir el to account a OpenID]] dopo che te ghè fato normalmente el login.

Ghe xe molti [http://openid.net/get/ Provider OpenID], e te podaressi verghe zà un account abilità a l'OpenID su un altro servissio.",
	'openidupdateuserinfo' => 'Ajorna le me informassion personài',
	'openid-prefstext' => '[http://openid.net/ OpenID] preferense',
	'openid-pref-hide' => 'Scondi el to OpenID su la to pàxena utente, se te fè el login con OpenID.',
	'openid-pref-update-userinfo-on-login' => "Ajorna le me informassion da l'utensa de OpenID ogni olta che me conéto",
	'openidsigninorcreateaccount' => 'Entra o crèa na utensa nova',
	'openid-provider-label-openid' => "Inserissi l'URL del to OpenID",
	'openid-provider-label-google' => 'Entra doparando la to utensa Google',
	'openid-provider-label-yahoo' => 'Entra doparando la to utensa Yahoo',
	'openid-provider-label-aol' => 'Inserissi el to screenname AOL',
	'openid-provider-label-other-username' => 'Inserissi el to nome utente $1',
);

/** Veps (Vepsan kel')
 * @author Игорь Бродский
 */
$messages['vep'] = array(
	'openidoptional' => 'Opcionaline',
	'openidemail' => 'E-počtan adres',
	'openidlanguage' => "Kel'",
);

/** Vietnamese (Tiếng Việt)
 * @author IAlex
 * @author Minh Nguyen
 * @author Vinhtantran
 */
$messages['vi'] = array(
	'openid-desc' => 'Đăng nhập vào wiki dùng [http://openid.net/ OpenID] và đăng nhập vào các website nhận OpenID dùng tài khoản wiki',
	'openidlogin' => 'Đăng nhập dùng OpenID',
	'openidfinish' => 'Đăng nhập dùng OpenID xong',
	'openidserver' => 'Dịch vụ OpenID',
	'openidxrds' => 'Tập tin Yadis',
	'openidconvert' => 'Chuyển đổi ID Mở',
	'openiderror' => 'Lỗi thẩm tra',
	'openiderrortext' => 'Có lỗi khi thẩm tra địa chỉ OpenID.',
	'openidconfigerror' => 'Lỗi thiết lập OpenID',
	'openidconfigerrortext' => 'Cấu hình nơi lưu trữ OpenID cho wiki này không hợp lệ.
Xin hãy liên lạc với [[Special:ListUsers/sysop|quản lý viên]].',
	'openidpermission' => 'Lỗi quyền OpenID',
	'openidpermissiontext' => 'Địa chỉ OpenID của bạn không được phép đăng nhập vào dịch vụ này.',
	'openidcancel' => 'Đã hủy bỏ thẩm tra',
	'openidcanceltext' => 'Đã hủy bỏ việc thẩm tra địa chỉ OpenID.',
	'openidfailure' => 'Không thẩm tra được',
	'openidfailuretext' => 'Không thể thẩm tra địa chỉ OpenID. Lỗi: “$1”',
	'openidsuccess' => 'Đã thẩm tra thành công',
	'openidsuccesstext' => 'Đã thẩm tra địa chỉ OpenID thành công.',
	'openidusernameprefix' => 'Thành viên ID Mở',
	'openidserverlogininstructions' => 'Hãy cho vào mật khẩu ở dưới để đăng nhập vào $3 dùng tài khoản $2 (trang thảo luận $1).',
	'openidtrustinstructions' => 'Hãy kiểm tra hộp này nếu bạn muốn cho $1 biết thông tin cá nhân của bạn.',
	'openidallowtrust' => 'Để $1 tin cậy vào tài khoản này.',
	'openidnopolicy' => 'Website chưa xuất bản chính sách về sự riêng tư.',
	'openidpolicy' => 'Hãy đọc <a target="_new" href="$1">chính sách về sự riêng tư</a> để biết thêm chi tiết.',
	'openidoptional' => 'Tùy ý',
	'openidrequired' => 'Bắt buộc',
	'openidnickname' => 'Tên hiệu',
	'openidfullname' => 'Tên đầy đủ',
	'openidemail' => 'Địa chỉ thư điện tử',
	'openidlanguage' => 'Ngôn ngữ',
	'openidnotavailable' => 'Tên hiệu mà bạn muốn sử dụng, “$1”, đã được sử dụng bởi người khác.',
	'openidnotprovided' => 'Dịch vụ OpenID của bạn chưa cung cấp tên hiệu, hoặc vì nó không có khả năng này, hoặc bạn đã tắt tính năng tên hiệu.',
	'openidchooseinstructions' => 'Mọi người dùng cần có tên hiệu; bạn có thể chọn tên hiệu ở dưới.',
	'openidchoosefull' => 'Tên đầy đủ của bạn ($1)',
	'openidchooseurl' => 'Tên bắt nguồn từ OpenID của bạn ($1)',
	'openidchooseauto' => 'Tên tự động ($1)',
	'openidchoosemanual' => 'Tên khác:',
	'openidchooseexisting' => 'Một tài khoản hiện có trên wiki này:',
	'openidchoosepassword' => 'mật khẩu:',
	'openidconvertinstructions' => 'Mẫu này cho phép bạn thay đổi tài khoản người dùng của bạn để sử dụng một địa chỉ URL ID Mở.',
	'openidconvertsuccess' => 'Đã chuyển đổi sang ID Mở thành công',
	'openidconvertsuccesstext' => 'Bạn đã chuyển đổi ID Mở của bạn sang $1 thành công.',
	'openidconvertyourstext' => 'Đó đã là ID Mở của bạn.',
	'openidconvertothertext' => 'Đó là ID Mở của một người nào khác.',
	'openidalreadyloggedin' => "'''Bạn đã đăng nhập rồi, $1!'''

Nếu bạn muốn sử dụng ID Mở để đăng nhập vào lần sau, bạn có thể [[Special:OpenIDConvert|chuyển đổi tài khoản của bạn để dùng ID Mở]].",
	'openidnousername' => 'Chưa chỉ định tên người dùng.',
	'openidbadusername' => 'Tên người dùng không hợp lệ.',
	'openidautosubmit' => 'Trang này có một mẫu sẽ tự động đăng lên nếu bạn kích hoạt JavaScript.
Nếu không, hãy thử nút \\"Tiếp tục\\".',
	'openidclientonlytext' => 'Bạn không thể sử dụng tài khoản tại wiki này như ID Mở tại trang khác.',
	'openidloginlabel' => 'Địa chỉ OpenID',
	'openidlogininstructions' => '{{SITENAME}} hỗ trợ chuẩn [http://openid.net/ OpenID] để đăng nhập một lần giữa các trang web.
OpenID cho phép bạn đăng nhập vào nhiều trang web khác nhau mà không phải sử dụng mật khẩu khác nhau tại mỗi trang.
(Xem [http://en.wikipedia.org/wiki/OpenID bài viết về OpenID của Wikipedia] để biết thêm chi tiết.)

Nếu bạn đã có một tài khoản tại {{SITENAME}}, bạn có thể [[Special:UserLogin|đăng nhập]] bằng tên người dùng và mật khẩu của bạn như thông thường.
Để dùng OpenID vào lần sau, bạn có thể [[Special:OpenIDConvert|chuyển đổi tài khoản của bạn sang ID Mở]] sau khi đã đăng nhập bình thường.

Có nhiều [http://wiki.openid.net/Public_OpenID_providers nhà cung cấp OpenID Công cộng], và có thể bạn đã có một tài khoản kích hoạt OpenID tại dịch vụ khác.',
	'openidupdateuserinfo' => 'Cập nhật thông tin cá nhân của tôi',
	'openid-prefstext' => 'Tùy chỉnh [http://openid.net/ OpenID]',
	'openid-pref-hide' => 'Ẩn ID Mở của bạn khỏi trang thành viên, nếu bạn đăng nhập bằng ID Mở.',
	'openid-pref-update-userinfo-on-login' => 'Cập nhật thông tin của tôi từ OpenID persona mỗi khi tôi đăng nhập',
	'openidsigninorcreateaccount' => 'Đăng nhập hay mở tài khoản mới',
	'openid-provider-label-openid' => 'Ghi vào URL OpenID của bạn',
	'openid-provider-label-google' => 'Đăng nhập dùng tài khoản Google',
	'openid-provider-label-yahoo' => 'Đăng nhập dùng tài khoản Yahoo!',
	'openid-provider-label-aol' => 'Ghi vào tên màn hình AOL',
	'openid-provider-label-other-username' => 'Ghi vào tên người dùng $1',
);

/** Volapük (Volapük)
 * @author Malafaya
 * @author Smeira
 */
$messages['vo'] = array(
	'openiderror' => 'Kontrolamapöl',
	'openidoptional' => 'No peflagon',
	'openidrequired' => 'Peflagon',
	'openidnickname' => 'Näinem',
	'openidfullname' => 'Nem lölik',
	'openidemail' => 'Ladet leäktronik',
	'openidlanguage' => 'Pük',
	'openidchooseinstructions' => 'Gebans valik neodons näinemi;
kanol välön bali sökölas.',
	'openidchoosefull' => 'Nem lölik ola ($1)',
	'openidchooseauto' => 'Nem itjäfidiko pejaföl ($1)',
	'openidchoosemanual' => 'Nem fa ol pevälöl:',
	'openidchooseexisting' => 'Kal in vük at dabinöl:',
	'openidchoosepassword' => 'letavöd:',
	'openidnousername' => 'Gebananem nonik pegivon.',
	'openidbadusername' => 'Gebananem no lonöföl pegivon.',
);

/** Simplified Chinese (‪中文(简体)‬)
 * @author Gaoxuewei
 * @author IAlex
 */
$messages['zh-hans'] = array(
	'openidlogin' => '使用OpenID登陆',
	'openidfinish' => '结束OpenID登陆',
	'openidserver' => 'OpenID服务器',
	'openidxrds' => 'Yadis文件',
	'openidconvert' => 'OpenID转换',
	'openiderror' => '验证错误',
	'openiderrortext' => '在验证OpenID地址时出现了一个错误。',
	'openidconfigerror' => 'OpenID配制出错',
	'openidconfigerrortext' => '这个维基的OpenID存储设置无法使用。
请通知[[Special:ListUsers/sysop|管理员]]。',
	'openidpermission' => 'OpenID许可错误',
	'openidpermissiontext' => '您提供的OpenID不允许在本服务器上登录。',
	'openidcancel' => '验证取消',
	'openidcanceltext' => 'OpenID地址验证被取消。',
	'openidfailure' => '验证失败',
	'openidfailuretext' => 'OpenID地址验证失败。错误信息："$1"',
	'openidsuccess' => '验证成功',
	'openidsuccesstext' => 'OpenID地址验证成功。',
	'openidusernameprefix' => 'OpenID用户',
	'openidserverlogininstructions' => '请在下面输入您的密码以便以用户$2登陆$3 (用户页面$1)。',
	'openidtrustinstructions' => '请确认您是否愿与$1分享数据。',
	'openidallowtrust' => '允许$1信任这个用户的账户。',
	'openidnopolicy' => '站点没有提供隐私政策。',
	'openidpolicy' => '如要获得更多信息，请参见<a target="_new" href="$1">隐私政策</a>。',
	'openidoptional' => '可选',
	'openidrequired' => '必选',
	'openidnickname' => '昵称',
	'openidfullname' => '全称',
	'openidemail' => '电子邮件地址',
	'openidlanguage' => '语言',
	'openidnotavailable' => '您选择的昵称($1)已经被其他用户使用。',
	'openidnotprovided' => '您的OpenID服务器没有提供昵称（可能无法提供，或者您选择不提供）。',
	'openidchooseinstructions' => '所有的用户都需要提供昵称；
您可以从下面任选一个。',
	'openidchoosefull' => '您的全名（$1）',
	'openidchooseurl' => '从您的OpenID获取的名称（$1）',
	'openidchooseauto' => '自动生成的名称（$1）',
	'openidchoosemanual' => '您选择的名称：',
	'openidchooseexisting' => '本维基已经存在的帐户：',
	'openidchoosepassword' => '密码：',
	'openidconvertinstructions' => '本表单可以将您的用户账号修改为OpenID地址。',
	'openidconvertsuccess' => '成功转换为OpenID',
	'openidconvertsuccesstext' => '您已经成功的将您的OpenID转化为$1。',
	'openidconvertyourstext' => '这已经是您的OpenID。',
	'openidconvertothertext' => '这是别人的OpenID。',
	'openidalreadyloggedin' => "'''您已经成功登陆了，$1！'''

如果您想以后使用OpenID登陆，您可以[[Special:OpenIDConvert|转换您的帐户使用OpenID]]。",
	'openidnousername' => '没有指定用户名。',
	'openidbadusername' => '指定的用户名是错误的。',
	'openidautosubmit' => '本页包含的表单在启用JavaScript的情况下可以自动提交。
如果没有自动提交，请按 \\"继续\\" 按钮。',
	'openidloginlabel' => 'OpenID地址',
	'openid-pref-hide' => '如果使用OpenID登陆，您可以在您的用户页隐藏您的OpenID。',
);

/** Traditional Chinese (‪中文(繁體)‬)
 * @author Gzdavidwong
 * @author Wrightbus
 */
$messages['zh-hant'] = array(
	'openidserver' => 'OpenID伺服器',
	'openidconvert' => 'OpenID轉換器',
	'openiderror' => '驗證錯誤',
	'openidnickname' => '暱稱',
	'openidfullname' => '全名',
	'openidchoosefull' => '您的全名 ($1)',
	'openidchoosepassword' => '密碼：',
	'openidconvertyourstext' => '這已是您的OpenID了。',
	'openidloginlabel' => 'OpenID網址',
);

