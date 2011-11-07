<?php

$messages = array();

$messages['en'] = array(
	'chat-desc' => '[[Special:Chat|Live chat]]',
	'chat-no-login' => 'You must be logged in to chat.',
	'chat-no-login-text' => 'Please login to chat.',
	'chat-default-topic' => 'Welcome to the $1 chat',
	'chat-user-joined' => '$1 has joined the chat.',
	
	// Many of these are sent from server.js to the client (which uses $.msg() to translate the message).
	'chat-user-parted' => '$1 has left the chat.',
	'chat-user-joined' => '$1 has joined the chat.',
	'chat-user-blocked' => '$1 has blocked $2.',
	'chat-user-allow' => '$1 has allowed $2.',
	'chat-user-was-kickbanned' => '$1 was kickbanned.',

	'chat-user-permanently-disconnected' => 'You have been disconnected, check your Internet connection and refresh browser window',

	'chat-inlinealert-a-made-b-chatmod' => "$1 has made <strong>$2</strong> a chat moderator.",
	'chat-err-connected-from-another-browser' => 'You have connected from another browser. This connection will be closed.',
	'chat-err-communicating-with-mediawiki' => 'Error communicating with MediaWiki server.',

	// Possible errors when trying to kick/ban a user:
	'chat-ban-cant-ban-moderator' => "You cannot kick/ban another Chat Moderator.",
	'chat-ban-already-banned' => '$1 is already banned from chat on this wiki.',
	'chat-ban-you-need-permission' => 'You do not have the $1 permission which is required to kick/ban a user.',
	'chat-missing-required-parameter' => '\'$1\' is required but was not found in the request.',

	'chat-err-already-chatmod' => "Error: \"$1\" is already in the \"$2\" group.",
	'chat-err-no-permission-to-add-chatmod' => "Error: You do not have permission to add the \"$1\" group to this user.",
	'chat-userrightslog-a-made-b-chatmod' => "$1 promoted $2 to be a chat moderator on this wiki.",

	
	'chat-you-are-banned' => 'Permissions error.',
	// TODO: link to list of admins
	'chat-you-are-banned-text' => 'Sorry, you do not have permission to chat on this wiki.  If you think this was a mistake or would like to be reconsidered, please contact an administrator.',
	'chat-room-is-not-on-this-wiki' => 'The chat room you are attempting to enter does not appear to exist on this wiki.',
	'chat-kick-log-reason' => 'Kick/banned from the chat for this wiki by $1. Please contact them for more info.',
	'chat-headline' => '$1 Chat',
	'chat-live' => 'Live!',
	'chat-start-a-chat' => 'Start a Chat',
	'chat-whos-here' => "Who's here ($1)",
	'chat-join-the-chat' => 'Join the Chat',
	'chat-edit-count' => '$1 Edits',

	'chat-member-since' => 'Member since $1',
	'chat-great-youre-logged-in' => "Great! You're logged in.",

	'chat-user-manu-profile' => 'User Profile',
	'chat-user-manu-contribs' => 'Contributions',
	'chat-user-manu-private' => 'Private Message',
	'chat-user-manu-give-chat-mod' => 'Give ChatMod Status',
	'chat-user-manu-kickban' => 'Kickban',

	'chat-user-manu-private-block' => 'Block Private Messages',
	'chat-user-manu-private-allow' => 'Allow Private Messages',
	'chat-user-manu-private-close' => 'Close Private Room',
	'chat-private-headline' => 'Private chat with $1',
);

/** Message documentation (Message documentation)
 * @author Claudia Hattitten
 */
$messages['qqq'] = array(
	'chat-whos-here' => 'Regards users that are in a chat room. The parameter gives the total count.',
);

/** Afrikaans (Afrikaans)
 * @author Naudefj
 */
$messages['af'] = array(
	'chat-no-login-text' => 'Meld asseblief aan om te klets.',
);

/** Asturian (Asturianu)
 * @author Xuacu
 */
$messages['ast'] = array(
	'chat-desc' => '[[Special:Chat|Charra en vivu]]',
	'chat-no-login' => 'Has de tar coneutáu pa charrar',
	'chat-no-login-text' => 'Por favor, conéutate pa charrar.',
	'chat-default-topic' => 'Bienveníu a la charra $1',
	'chat-ban-cant-ban-moderator' => 'Nun pues espulsar/torgar a otru moderador del chat.',
	'chat-ban-already-banned' => '$1 yá tien torgáu el chat nesta wiki.',
	'chat-ban-you-need-permission' => 'Nun tienes el permisu de $1 que ye necesariu pa espulsar/torgar a un usuariu.',
	'chat-missing-required-parameter' => "'$1' ye necesariu, pero nun s'alcontró na petición.",
	'chat-you-are-banned' => 'Fallu de permisos.',
	'chat-you-are-banned-text' => "Nun tienes permisu pal chat d'esta wiki. Si pienses que foi por error o quies que se reconsidere, ponte en contautu con un alministrador.",
	'chat-room-is-not-on-this-wiki' => 'La sala de charra na que tas tentando entrar paez que nun esiste nesta wiki.',
	'chat-kick-log-reason' => "Espulsáu/torgáu na charra d'esta wiki por $1.
Ponte'n contautu con ellos pa más info.",
	'chat-headline' => 'Chat de $1',
	'chat-live' => '¡En vivo!',
	'chat-start-a-chat' => 'Aniciar una charra',
	'chat-whos-here' => 'Quién ta equí ($1)',
	'chat-join-the-chat' => 'Xunise al Chat',
	'chat-edit-count' => '$1 Ediciones',
	'chat-member-since' => 'Miembru dende $1',
);

/** Bulgarian (Български)
 * @author DCLXVI
 */
$messages['bg'] = array(
	'chat-desc' => '[[Special:Chat|Чат]]',
);

/** Breton (Brezhoneg)
 * @author Fulup
 * @author Y-M D
 */
$messages['br'] = array(
	'chat-desc' => '[[Special:Chat|Flapiñ war-eeun]]',
	'chat-no-login' => "Ret eo deoc'h bezañ kevreet evit flapiñ",
	'chat-no-login-text' => 'Kevreit evit gallout flapiñ.',
	'chat-default-topic' => 'Degemer mat er flap $1',
	'chat-ban-cant-ban-moderator' => "Ne c'hellit ket skarzhañ/stankañ ur merour all deus ar flap.",
	'chat-ban-already-banned' => '$1 a zo stanket dija war flap ar wiki-mañ.',
	'chat-ban-you-need-permission' => "N'ho peus ket an aotreoù $1 rekis evit skarzhañ/stankañ un implijer.",
	'chat-missing-required-parameter' => 'Rekis eo "$1" met n\'eo ket bet kavet er reked.',
	'chat-you-are-banned' => 'Fazi aotreoù.',
	'chat-you-are-banned-text' => "Berzet eo bet ar flap ouzhoc'h.
Ma soñj deoc'h ez eo dre fazi pe mar fell deoc'h e vefe distroet war an diviz e c'hallit mont e darempred gant ur merour.",
	'chat-room-is-not-on-this-wiki' => "War a seblant n' ez eus ket eus deus ar flap a glaskit keveañ outañ.",
	'chat-kick-log-reason' => "Skarzhet eus ar flap er wiki-mañ gant $1.
Kit e darempred ganto da c'houzout hiroc'h.",
	'chat-headline' => 'Chat $1',
	'chat-live' => 'War-eeun !',
	'chat-start-a-chat' => 'Kregiñ gant ar Flap',
	'chat-whos-here' => "Piv 'vez amañ ($1)",
	'chat-join-the-chat' => 'Mont er Flap',
	'chat-edit-count' => '$1 Kemm',
	'chat-member-since' => 'Ezel adalek an $1',
);

/** Bosnian (Bosanski)
 * @author CERminator
 */
$messages['bs'] = array(
	'chat-desc' => '[[Special:Chat|Razgovor uživo]]',
	'chat-no-login' => 'Morate biti prijavljeni da biste chatali',
	'chat-no-login-text' => 'Molimo prijavite se za chat.',
	'chat-default-topic' => 'Dobrodošli na $1 chat',
	'chat-you-are-banned' => 'Greške pri odobrenju.',
	'chat-you-are-banned-text' => 'Zabranjen vam je chat.
Ako mislite da je to greška ili želite da se ponovo razmotri, molimo kontaktirajte administratora.',
	'chat-kick-log-reason' => 'Izbačeni/blokirani ste za chat na ovoj wiki od strane $1.
Molimo kontaktirajte ga za više podataka.',
);

/** Catalan (Català)
 * @author BroOk
 */
$messages['ca'] = array(
	'chat-desc' => '[[Special:Chat| Xat en línia]]',
	'chat-no-login' => "Has d'estar connectat al xat.",
	'chat-no-login-text' => "Si us plau connecta't per parlar.",
	'chat-default-topic' => 'Benvingut al $1 xat',
	'chat-user-parted' => '$1ha sortit del xat.',
	'chat-user-was-kickbanned' => '$1 ha estat bannejat.',
	'chat-inlinealert-a-made-b-chatmod' => '$1ha fet a <strong>$2</strong> un moderador de xat.',
	'chat-err-connected-from-another-browser' => "S'ha connectat des d'un altre navegador. Aquesta connexió es tancarà.",
	'chat-err-communicating-with-mediawiki' => 'Error de comunicació amb el servidor de MediaWiki.',
	'chat-ban-cant-ban-moderator' => 'No pots expulsar/bennejar un altre moderador del xat.',
	'chat-ban-already-banned' => "$1 ja està bannejat del xat d'aquesta wiki.",
	'chat-ban-you-need-permission' => 'No teniu el $1 permís que es necessita per expulsar/bannejar un usuari.',
	'chat-missing-required-parameter' => "'$1' és necessari però no s'ha trobat en la sol·licitud.",
	'chat-err-already-chatmod' => 'Error: "$1" ja està en el "$2" grup.',
	'chat-err-no-permission-to-add-chatmod' => 'Error: No té permís per afegir el " $1 " grup a aquest usuari.',
	'chat-userrightslog-a-made-b-chatmod' => '$1promogut $2 per ser moderador del xat en aquest wiki.',
	'chat-you-are-banned' => 'Error de permisos.',
	'chat-you-are-banned-text' => "Ho sentim, no teniu permís per xatejar en aquest wiki. Si penses que és un error o vols ser reconsiderat, si us plau posa't contacte amb un administrador.",
	'chat-room-is-not-on-this-wiki' => "La sala de xat que estàs intentant d'entrar no sembla existir en aquest wiki.",
	'chat-kick-log-reason' => "Expulsat/bannejat del xat d'aquest wiki per $1. Si us plau, poseu-vos en contacte per més informació.",
	'chat-headline' => '$1 Xat',
	'chat-live' => 'Live!',
	'chat-start-a-chat' => 'Inicia una conversa',
	'chat-whos-here' => 'Qui és aquí ($1)',
	'chat-join-the-chat' => 'Uneix-te al xat',
	'chat-edit-count' => '$1 Edicions',
	'chat-member-since' => 'Membre des de $1',
);

/** German (Deutsch)
 * @author Claudia Hattitten
 * @author DaSch
 * @author LWChris
 */
$messages['de'] = array(
	'chat-desc' => '[[Special:Chat|Live-Chat]]',
	'chat-no-login' => 'Du musst angemeldet sein, um zu chatten',
	'chat-no-login-text' => 'Bitte anmelden, um zu chatten.',
	'chat-default-topic' => 'Willkommen im $1 Chat',
	'chat-user-parted' => '$1 hat den Chat verlassen.',
	'chat-user-was-kickbanned' => '$1 wurde aus dem Chat augeschlossen.',
	'chat-inlinealert-a-made-b-chatmod' => '$1 hat <strong>$2</strong> zum Chat-Moderator gemacht.',
	'chat-err-connected-from-another-browser' => 'Du hast dich mit einem anderen Browser verbunden. Diese Verbindung wird geschlossen.',
	'chat-err-communicating-with-mediawiki' => 'Fehler bei Kommunikation mit MediaWiki Server.',
	'chat-ban-cant-ban-moderator' => 'Du kannst einen anderen Moderator nicht rauswerfen.',
	'chat-ban-already-banned' => '$1 ist bereits aus dem Chat verbannt.',
	'chat-ban-you-need-permission' => 'Du verfügst nicht über die Berechtigung $1, die erforderlich ist, um einen Benutzer zu entfernen/verbannen.',
	'chat-missing-required-parameter' => '"$1" ist notwendig, wurde aber in der Anfrage nicht gefunden.',
	'chat-err-already-chatmod' => 'Fehler: "$1" ist bereits in der "$2" Gruppe.',
	'chat-err-no-permission-to-add-chatmod' => 'Fehler: Du hast keine Berechtigung, die "$1" Gruppe bei diesem Benutzer hinzuzufügen.',
	'chat-userrightslog-a-made-b-chatmod' => '$1 hat $2 zum Chat-Moderator in diesem Wiki befördert.',
	'chat-you-are-banned' => 'Berechtigungsfehler.',
	'chat-you-are-banned-text' => 'Entschuldige bitte, aber du hast keine Berechtigung, in diesem Wiki zu chatten.
Wenn du dies für einen Fehler hältst oder möchtest, dass die Entscheidung überdacht wird, wende dich bitte an einen Administrator.',
	'chat-room-is-not-on-this-wiki' => 'Den Chat-Raum, dem du beitreten willst, scheint es in diesem Wiki nicht zu geben.',
	'chat-kick-log-reason' => 'Rauswurf/Bann aus dem Chat für dieses Wiki durch $1.
Bitte kontaktiere sie für weitere Informationen.',
	'chat-headline' => 'Chat: $1',
	'chat-live' => 'in Echtzeit!',
	'chat-start-a-chat' => 'Chat starten',
	'chat-whos-here' => 'Anwesende ($1)',
	'chat-join-the-chat' => 'Chat beitreten',
	'chat-edit-count' => '$1 {{plural:$1|Edit|Edits}}',
	'chat-member-since' => 'Mitglied seit $1',
);

/** Spanish (Español)
 * @author VegaDark
 */
$messages['es'] = array(
	'chat-desc' => '[[Special:Chat|Chat en vivo]]',
	'chat-no-login' => 'Debes iniciar sesión para chatear.',
	'chat-no-login-text' => 'Inicia sesión para chatear.',
	'chat-default-topic' => 'Bienvenido al chat de $1',
	'chat-user-parted' => '$1 ha salido del chat.',
	'chat-user-was-kickbanned' => '$1 fue bloqueado y expulsado.',
	'chat-inlinealert-a-made-b-chatmod' => '$1 ha hecho a <strong>$2</strong> un moderador del chat.',
	'chat-err-connected-from-another-browser' => 'Te has conectado de otro navegador. Esta conexión se cerrará.',
	'chat-err-communicating-with-mediawiki' => 'Error al comunicarse con el servidor MediaWiki.',
	'chat-ban-cant-ban-moderator' => 'No puedes expulsar/bloquear otro moderador del chat.',
	'chat-ban-already-banned' => '$1 ya está bloqueado del chat en este wiki.',
	'chat-ban-you-need-permission' => 'No tienes el permiso $1 que es requerido para expulsar/bloquear un usuario.',
	'chat-missing-required-parameter' => "'$1' es necesario pero no fue encontrado en la solicitud.",
	'chat-err-already-chatmod' => 'Error: "$1" ya está en el grupo "$2".',
	'chat-err-no-permission-to-add-chatmod' => 'Error: No tienes permiso para agregar el grupo $1 a este usuario.',
	'chat-userrightslog-a-made-b-chatmod' => '$1 promovió a $2 para ser moderador del chat en este wiki.',
	'chat-you-are-banned' => 'Error de permisos.',
	'chat-you-are-banned-text' => 'Lo sentimos, no tienes permiso para entrar al chat en esta wiki.
Si crees que ha sido un error o te gustaría reconsiderarlo, por favor contacta con un administrador.',
	'chat-room-is-not-on-this-wiki' => 'La sala de chat a la que estás tratando de entrar, parece no existir en este wiki.',
	'chat-kick-log-reason' => 'Expulsado y bloqueado del chat de esta wiki por $1.
Por favor, contáctalo para más información.',
	'chat-headline' => 'Chat de $1',
	'chat-live' => '¡En vivo!',
	'chat-start-a-chat' => 'Iniciar el Chat',
	'chat-whos-here' => 'Quién está aquí ($1)',
	'chat-join-the-chat' => 'Únete al Chat',
	'chat-edit-count' => '$1 ediciones',
	'chat-member-since' => 'Miembro desde $1',
);

/** French (Français)
 * @author IAlex
 * @author McDutchie
 * @author Notafish
 * @author Od1n
 * @author Wyz
 */
$messages['fr'] = array(
	'chat-desc' => '[[Special:Chat|Tchater en direct]]',
	'chat-no-login' => 'Vous devez être connecté pour tchater.',
	'chat-no-login-text' => 'Veuillez vous connecter pour tchater.',
	'chat-default-topic' => 'Bienvenue sur le tchat de $1',
	'chat-user-parted' => '$1 a quitté le tchat.',
	'chat-user-was-kickbanned' => '$1 a été banni.',
	'chat-inlinealert-a-made-b-chatmod' => '$1 a promu <strong>$2</strong> au rang de modérateur du tchat.',
	'chat-err-connected-from-another-browser' => 'Vous vous êtes connecté depuis un autre navigateur. Cette connexion va être fermée.',
	'chat-err-communicating-with-mediawiki' => 'Une erreur est survenue lors de la communication avec le serveur MediaWiki.',
	'chat-ban-cant-ban-moderator' => 'Vous ne pouvez pas éjecter/bannir un autre modérateur du tchat.',
	'chat-ban-already-banned' => '$1 est déjà banni du tchat sur ce wiki.',
	'chat-ban-you-need-permission' => 'Vous n’avez pas la permission $1, qui est nécessaire pour pouvoir éjecter/bannir un utilisateur.',
	'chat-missing-required-parameter' => "'$1' est requis mais n’a pas été trouvé dans la requête.",
	'chat-err-already-chatmod' => 'Erreur: « $1 » est déjà dans le groupe « $2 ».',
	'chat-err-no-permission-to-add-chatmod' => "Erreur : Vous n'avez pas la permission d'ajouter cet utilisateur au groupe « $1 ».",
	'chat-userrightslog-a-made-b-chatmod' => '$1 a promu $2 au rang de modérateur du tchat sur ce wiki.',
	'chat-you-are-banned' => 'Erreur de permissions.',
	'chat-you-are-banned-text' => "Désolé, vous n'avez pas la permission de tchater sur ce wiki. Si vous pensez que c'est une erreur ou souhaitez en discuter, veuillez contacter un administrateur.",
	'chat-room-is-not-on-this-wiki' => 'Le salon de tchat auquel vous essayez de vous connecter ne semble pas exister sur ce wiki.',
	'chat-kick-log-reason' => 'Éjecté/banni du tchat pour ce wiki par $1. Veuillez les contacter pour plus d’informations.',
	'chat-headline' => '$1 — Tchat',
	'chat-live' => 'En direct !',
	'chat-start-a-chat' => 'Démarrer un tchat',
	'chat-whos-here' => 'Qui est présent ($1)',
	'chat-join-the-chat' => 'Rejoindre le tchat',
	'chat-edit-count' => '$1 contributions',
	'chat-member-since' => 'Membre depuis $1',
);

/** Galician (Galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'chat-desc' => '[[Special:Chat|Conversación en vivo]]',
	'chat-no-login' => 'Debe acceder ao sistema para chatear.',
	'chat-no-login-text' => 'Acceda ao sistema para chatear.',
	'chat-default-topic' => 'Benvido ao chat $1',
	'chat-user-parted' => '$1 deixou a conversación.',
	'chat-user-was-kickbanned' => '$1 foi bloqueado.',
	'chat-err-connected-from-another-browser' => 'Conectouse desde outro navegador. Esta conexión vai pecharse.',
	'chat-err-communicating-with-mediawiki' => 'Erro na comunicación co servidor MediaWiki.',
	'chat-you-are-banned' => 'Erro de permisos.',
	'chat-headline' => 'Chat $1',
	'chat-live' => 'En vivo!',
	'chat-start-a-chat' => 'Iniciar un chat',
	'chat-whos-here' => 'Quen está aquí ($1)',
	'chat-join-the-chat' => 'Únase ao chat',
	'chat-edit-count' => '$1 edicións',
	'chat-member-since' => 'Membro desde $1',
);

/** Hungarian (Magyar)
 * @author Dani
 */
$messages['hu'] = array(
	'chat-no-login' => 'A csevegéshez be kell jelentkezned!',
	'chat-no-login-text' => 'Jelentkezz be a csevegéshez!',
	'chat-default-topic' => 'Üdvözlünk a $1 csevegőben!',
	'chat-ban-already-banned' => '$1 már ki van tiltva a wiki csevegőjéből.',
	'chat-you-are-banned' => 'Engedélyezési hiba.',
	'chat-headline' => '$1-csevegő',
	'chat-live' => 'Élő!',
	'chat-start-a-chat' => 'Csevegő indítása',
	'chat-whos-here' => 'Ki van itt ($1)',
	'chat-join-the-chat' => 'Csatlakozás a csevegéshez',
	'chat-edit-count' => '$1 szerkesztés',
);

/** Interlingua (Interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'chat-desc' => '[[Special:Chat|Live chat]]',
	'chat-no-login' => 'Tu debe aperir un session pro poter chattar.',
	'chat-no-login-text' => 'Per favor aperi session pro chattar.',
	'chat-default-topic' => 'Benvenite al chat de $1',
	'chat-user-parted' => '$1 ha quitate le chat.',
	'chat-user-was-kickbanned' => '$1 ha essite ejectate e bannite.',
	'chat-inlinealert-a-made-b-chatmod' => '$1 ha facite <strong>$2</strong> moderator del chat.',
	'chat-err-connected-from-another-browser' => 'Tu te ha connectite ab un altere navigator. Iste connexion essera claudite.',
	'chat-err-communicating-with-mediawiki' => 'Error durante le communication con le servitor MediaWiki.',
	'chat-ban-cant-ban-moderator' => 'Tu non pote ejectar/bannir un altere moderator del chat.',
	'chat-ban-already-banned' => '$1 es jam bannite del chat in iste wiki.',
	'chat-ban-you-need-permission' => 'Tu non ha le permission de $1 le qual es necessari pro poter ejectar/bannir un usator.',
	'chat-missing-required-parameter' => "'$1' es obligatori ma non esseva trovate in le requesta.",
	'chat-err-already-chatmod' => 'Error: "$1" es jam in le gruppo "$2".',
	'chat-err-no-permission-to-add-chatmod' => 'Error: Tu non ha le permission de adder iste usator al gruppo "$1".',
	'chat-userrightslog-a-made-b-chatmod' => '$1 ha promovite $2 a moderator del chat in iste wiki.',
	'chat-you-are-banned' => 'Error de permissiones.',
	'chat-you-are-banned-text' => 'Regrettabilemente, tu non ha le permission de entrar in le chat de iste wiki.
Si tu pensa que isto es un error o si tu vole esser reconsiderate, per favor contacta un administrator.',
	'chat-room-is-not-on-this-wiki' => 'Le canal de chat in le qual tu tenta entrar non pare exister in iste wiki.',
	'chat-kick-log-reason' => 'Expellite del chat de iste wiki per $1.
Per favor contacta le pro plus informationes.',
	'chat-headline' => 'Chat de $1',
	'chat-live' => 'In directo!',
	'chat-start-a-chat' => 'Comenciar un chat',
	'chat-whos-here' => 'Qui es presente ($1)',
	'chat-join-the-chat' => 'Entrar in le chat',
	'chat-edit-count' => 'Modificationes de $1',
	'chat-member-since' => 'Membro depost $1',
);

/** Japanese (日本語)
 * @author Tommy6
 */
$messages['ja'] = array(
	'chat-desc' => '[[Special:Chat|ライブチャット]]',
	'chat-no-login' => 'ログインする必要があります。',
	'chat-no-login-text' => 'チャット機能を利用するにはログインする必要があります。',
	'chat-default-topic' => '「$1 チャット」にようこそ',
	'chat-ban-cant-ban-moderator' => '他のチャットモデレータを強制退出させるあるいは追放することはできません。',
	'chat-ban-already-banned' => '$1 は既にこのウィキのチャットから追放されています。',
	'chat-ban-you-need-permission' => 'ユーザを強制退出させるあるいは追放するのに必要な$1権限がありません。',
	'chat-missing-required-parameter' => '「$1」が要求されましたがリクエストの中に見つかりませんでした。',
	'chat-you-are-banned' => '権限がありません',
	'chat-you-are-banned-text' => 'このウィキのチャット機能を利用する権限がありません。もし、これが誤りであるあるいは再考が必要であると考えるのであれば、管理者に連絡を取ってください。',
	'chat-room-is-not-on-this-wiki' => 'あなたが入ろうとしたチャットルームはこのウィキにはないようです。',
	'chat-kick-log-reason' => '$1 がこのウィキのチャットから強制退出あるいは追放しました。さらに詳しい情報については、実施者に問い合わせてください。',
	'chat-headline' => '$1 チャット',
	'chat-live' => 'Live!',
	'chat-start-a-chat' => 'チャットに参加',
	'chat-whos-here' => '現在いるユーザ ($1)',
	'chat-join-the-chat' => 'チャットに参加',
	'chat-edit-count' => '編集回数: $1',
	'chat-member-since' => '利用開始: $1',
);

/** Korean (한국어)
 * @author Infinity
 */
$messages['ko'] = array(
	'chat-desc' => '[[Special:Chat|실시간 채팅]]',
	'chat-no-login' => '채팅을 하기 위해서는 로그인이 필요합니다.',
	'chat-no-login-text' => '채팅을 하기 위해서는 로그인이 필요합니다.',
	'chat-default-topic' => '$1 채팅에 오신 것을 환영합니다',
	'chat-ban-cant-ban-moderator' => '다른 채팅 운영자를 추방할 수 없습니다.',
	'chat-ban-already-banned' => '$1 사용자는 이미 추방되었습니다.',
	'chat-ban-you-need-permission' => '다른 사용자를 추방하기 위해서는 $1 권한이 필요합니다.',
	'chat-you-are-banned' => '권한 오류',
	'chat-you-are-banned-text' => '죄송합니다. 이 위키에서 채팅에 참여할 권한이 없습니다. 만약 이 사안이 관리자의 실수이거나 재검토가 필요하다고 생각하신다면 관리자에게 문의해주세요.',
	'chat-room-is-not-on-this-wiki' => '입장하려고 하는 채팅방이 이 위키에 없습니다.',
	'chat-kick-log-reason' => '$1에 의해 채팅에서 추방됨. 더 자세한 이유는 운영진에게 문의.',
	'chat-headline' => '$1 채팅',
	'chat-live' => '라이브!',
	'chat-start-a-chat' => '채팅 시작하기',
	'chat-whos-here' => '채팅중인 사용자 ($1)',
	'chat-join-the-chat' => '채팅 참가하기',
	'chat-edit-count' => '$1회 기여',
	'chat-member-since' => '$1부터 기여',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'chat-default-topic' => 'Wëllkomm am $1-Chat',
	'chat-you-are-banned' => 'Berechtigungs-Feeler',
	'chat-edit-count' => '$1 Ännerungen',
);

/** Macedonian (Македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'chat-desc' => '[[Special:Chat|Разговори во живо]]',
	'chat-no-login' => 'Мора да се најавени за да разговарате',
	'chat-no-login-text' => 'Најавете се за да разговарате.',
	'chat-default-topic' => 'Добредојдовте на разговорот за $1',
	'chat-user-parted' => '$1 го напушти разговорот.',
	'chat-user-was-kickbanned' => 'Корисникот $1 е исфрлен и пристапот му е забранет.',
	'chat-inlinealert-a-made-b-chatmod' => '$1 го/ја назначи <strong>$2</strong> за модератор на разговорите.',
	'chat-err-connected-from-another-browser' => 'Се поврзавте од друг прелистувач. Оваа врска ќе се затвори.',
	'chat-err-communicating-with-mediawiki' => 'Грешка при општењето со опслужувачот на МедијаВики.',
	'chat-ban-cant-ban-moderator' => 'Не можете да исфрлите/забраните пристап на друг модератор.',
	'chat-ban-already-banned' => 'На корисникот $1 веќе му е забранет пристапот до разговорот на ова вики.',
	'chat-ban-you-need-permission' => 'Ја немате дозволата за $1, што е потребна за исфрлање на корисници и забранување на пристап.',
	'chat-missing-required-parameter' => 'Задолжително треба „$1“, но не пронајдов такво нешто во барањето.',
	'chat-err-already-chatmod' => 'Грешка: „$1“ веќе припаѓа на групата „$2“.',
	'chat-err-no-permission-to-add-chatmod' => 'Грешка: Немате дозвола да ја додадете групата „$1“ кон овој корисник.',
	'chat-userrightslog-a-made-b-chatmod' => '$1 го/ја унапреди $2 во модератор на разговорите на ова вики.',
	'chat-you-are-banned' => 'Грешка во дозволите.',
	'chat-you-are-banned-text' => 'Забрането ви е да разговарате на ова вики.
Ако сметате дека ова е направено по грешка или сакате да се преиспита одлуката, обратете се кај администратор.',
	'chat-room-is-not-on-this-wiki' => 'Собата за разговор што сакате да ја пристапите не постои на ова вики.',
	'chat-kick-log-reason' => 'Исфрлен од/има забранет пристап до разговорот на ова вики од страна на $1. За повеќе информации, обратете се кај тој корисник.',
	'chat-headline' => 'Разговор — $1',
	'chat-live' => 'Во живо!',
	'chat-start-a-chat' => 'Започни разговор',
	'chat-whos-here' => 'Кој има тука ($1)',
	'chat-join-the-chat' => 'Приклучи се во разговорот',
	'chat-edit-count' => '$1 уредувања',
	'chat-member-since' => 'Членува од $1',
);

/** Malayalam (മലയാളം)
 * @author Praveenp
 */
$messages['ml'] = array(
	'chat-edit-count' => '$1 തിരുത്തലുകൾ',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'chat-desc' => '[[Special:Chat|Sembang secara langsung]]',
	'chat-no-login' => 'Anda mesti log masuk untuk bersembang',
	'chat-no-login-text' => 'Sila log masuk untuk bersembang',
	'chat-default-topic' => 'Selamat datang ke ruang sembang $1',
	'chat-user-parted' => '$1 telah meninggalkan ruang sembang.',
	'chat-user-was-kickbanned' => '$1 diusir keluar.',
	'chat-inlinealert-a-made-b-chatmod' => '$1 telah menjadikan <strong>$2</strong> seorang moderator sembang.',
	'chat-err-connected-from-another-browser' => 'Anda telah bersambung dari pelayar lain. Sambungan ini akan ditutup.',
	'chat-err-communicating-with-mediawiki' => 'Ralat ketika berhubung dengan pelayan MediaWiki.',
	'chat-ban-cant-ban-moderator' => 'Anda tidak boleh menghalau/melarang Penyelia Sembang yang lain.',
	'chat-ban-already-banned' => '$1 sudah dilarang daripada bersembang di wiki ini.',
	'chat-ban-you-need-permission' => 'Anda tidak mendapat kebenaran $1 yang diperlukan untuk menghalau/melarang pengguna.',
	'chat-missing-required-parameter' => "'$1' diperlukan tetapi tiada dalam permintaan.",
	'chat-err-already-chatmod' => 'Perhatian: "$1" sudah berada dalam kumpulan "$2".',
	'chat-err-no-permission-to-add-chatmod' => 'Perhatian: Anda tidak dibenarkan menambahkan kumpulan "$1" ke dalam pengguna ini.',
	'chat-userrightslog-a-made-b-chatmod' => '$1 menaik pangkat $2 untuk menjadi moderator sembang di wiki ini.',
	'chat-you-are-banned' => 'Ralat kebenaran.',
	'chat-you-are-banned-text' => 'Maaf, anda tidak dibenarkan untuk bersembang di wiki ini.
Jika anda rasa ini kesilapan atau ingin merayu untuk dibenarkan semula, sila hubungi pentadbir.',
	'chat-room-is-not-on-this-wiki' => 'Ruang sembang yang anda cuba masuk itu nampaknya tidak wujud di wiki ini.',
	'chat-kick-log-reason' => 'Dilarang daripada bersembang di wiki ini oleh $1.
Sila hubungi mereka untuk penjelasan lanjut.',
	'chat-headline' => 'Ruang Sembang $1',
	'chat-live' => 'Live!',
	'chat-start-a-chat' => 'Mula Bersembang',
	'chat-whos-here' => 'Siapa di sini ($1)',
	'chat-join-the-chat' => 'Jom Sembang',
	'chat-edit-count' => '$1 Suntingan',
	'chat-member-since' => 'Ahli sejak $1',
);

/** Dutch (Nederlands)
 * @author SPQRobin
 * @author Siebrand
 */
$messages['nl'] = array(
	'chat-desc' => '[[Special:Chat|Livechat]]',
	'chat-no-login' => 'U moet aangemeld zijn om deel te nemen aan de chat.',
	'chat-no-login-text' => 'Meld u aan om deel te nemen aan de chat.',
	'chat-default-topic' => 'Welkom bij de chat van $1',
	'chat-user-parted' => '$1 heeft de chat verlaten.',
	'chat-user-was-kickbanned' => '$1 is uit het kanaal geschopt en verbannen.',
	'chat-inlinealert-a-made-b-chatmod' => '$1 heeft <strong>$2</strong> chatmoderator gemaakt.',
	'chat-err-connected-from-another-browser' => 'U bent verbonden via een andere browser. Deze verbinding wordt nu gesloten.',
	'chat-err-communicating-with-mediawiki' => 'Er is een fout opgetreden in de verbinding met de MediaWiki-server.',
	'chat-ban-cant-ban-moderator' => 'U kunt een andere chatmoderator niet kicken of verbannen.',
	'chat-ban-already-banned' => '$1 is al verbannen uit de chat voor deze wiki.',
	'chat-ban-you-need-permission' => 'U hebt het recht "$1" niet, wat nodig is om een gebruiker te kicken of te verbannen.',
	'chat-missing-required-parameter' => '"$1" is vereist, maar is niet aangetroffen in het verzoek.',
	'chat-err-already-chatmod' => 'Fout: "$1" is al in de groep "$2".',
	'chat-err-no-permission-to-add-chatmod' => 'Fout: U hebt geen toestemming om de groep "$1" aan deze gebruiker toe te voegen.',
	'chat-userrightslog-a-made-b-chatmod' => '$1 heeft $2 gepromoveerd tot chatmoderator op deze wiki.',
	'chat-you-are-banned' => 'Fouten in rechten.',
	'chat-you-are-banned-text' => 'U mag niet langer deelnemen aan de chat. Als u denkt dat dit niet klopt, of als u wilt vragen uw blokkade op te heffen, neem dan contact op met een beheerder.',
	'chat-room-is-not-on-this-wiki' => 'De chatroom waar u probeert binnen te komen bestaat niet op deze wiki.',
	'chat-kick-log-reason' => 'De toegang tot de chat voor deze wiki is u ontzegd door $1.
Neem alstublieft contact op met deze gebruiker voor meer informatie.',
	'chat-headline' => 'Chat voor $1',
	'chat-live' => 'Live!',
	'chat-start-a-chat' => 'Chat starten',
	'chat-whos-here' => 'Wie is er ($1)',
	'chat-join-the-chat' => 'Deelnemen aan de chat',
	'chat-edit-count' => '$1 bewerkingen',
	'chat-member-since' => 'Lid sinds $1',
);

/** ‪Nederlands (informeel)‬ (‪Nederlands (informeel)‬)
 * @author Siebrand
 */
$messages['nl-informal'] = array(
	'chat-no-login' => 'Je moet aangemeld zijn om deel te nemen aan de chat',
	'chat-no-login-text' => 'Meld je aan om deel te nemen aan de chat.',
	'chat-ban-cant-ban-moderator' => 'Je kunt een andere chatmoderator niet kicken of verbannen.',
	'chat-ban-you-need-permission' => 'Je hebt het recht "$1" niet wat nodig is om een gebruiker te kicken of te verbannen.',
	'chat-you-are-banned-text' => 'Je mag niet langer deelnemen aan de chat. Als je denkt dat dit niet klopt, of als je wilt vragen uw blokkade op te heffen, neem dan contact op met een beheerder.',
	'chat-room-is-not-on-this-wiki' => 'De chatroom waar je probeert binnen te komen bestaat niet op deze wiki.',
);

/** Norwegian (bokmål)‬ (‪Norsk (bokmål)‬)
 * @author Audun
 * @author Nghtwlkr
 */
$messages['no'] = array(
	'chat-desc' => '[[Special:Chat|Chat]]',
	'chat-no-login' => 'Du må være logget inn for å chatte',
	'chat-no-login-text' => 'Vennligst logg inn for å chatte.',
	'chat-default-topic' => 'Velkommen til $1-chatten',
	'chat-user-parted' => '$1 har forlatt chatten.',
	'chat-user-was-kickbanned' => '$1 ble sparket ut.',
	'chat-inlinealert-a-made-b-chatmod' => '$1 gjorde <strong>$2</strong> til en chat-moderator.',
	'chat-err-connected-from-another-browser' => 'Du har koblet til fra en annen nettleser. Denne tilkoblingen vil bli lukket.',
	'chat-err-communicating-with-mediawiki' => 'Feil under kommunikasjon med MediaWiki-tjeneren.',
	'chat-ban-cant-ban-moderator' => 'Du kan ikke sparke/utestenge en annen Chat-moderator.',
	'chat-ban-already-banned' => '$1 er allerede utestengt fra chatten på denne wikien.',
	'chat-ban-you-need-permission' => 'Du har ikke $1-tillatelsen som kreves for å sparke/utestenge en bruker.',
	'chat-missing-required-parameter' => '«$1» er påkrevd, men ble ikke funnet i forespørselen.',
	'chat-err-already-chatmod' => 'Feil: «$1» er allerede i gruppen «$2».',
	'chat-err-no-permission-to-add-chatmod' => 'Feil: Du har ikke tillatelse til å legge gruppen «$1» til denne brukeren.',
	'chat-userrightslog-a-made-b-chatmod' => '$1 forfremmet $2 til å være en chat-moderator på denne wikien.',
	'chat-you-are-banned' => 'Rettighetsfeil.',
	'chat-you-are-banned-text' => 'Beklager, du har ikke rett til å chatte på denne wikien. Hvis du tror dette er en feil, eller om du vil bli revurdert, vennligst kontakt en administrator.',
	'chat-room-is-not-on-this-wiki' => 'Chatrommet du forsøker å entre ser ikke ut til å eksistere på denne wikien.',
	'chat-kick-log-reason' => 'Sparket/utestengt fra chatten på denne wikien av $1.
Vennligst kontakt dem for mer informasjon.',
	'chat-headline' => '$1-chat',
	'chat-live' => 'Live!',
	'chat-start-a-chat' => 'Start en chat',
	'chat-whos-here' => 'Hvem er her ($1)',
	'chat-join-the-chat' => 'Bli med i chatten',
	'chat-edit-count' => '$1 redigeringer',
	'chat-member-since' => 'Medlem siden $1',
);

/** Polish (Polski)
 * @author Cloudissimo
 */
$messages['pl'] = array(
	'chat-desc' => '[[Special:Chat|Czat na żywo]]',
	'chat-no-login' => 'Musisz być zalogowany, żeby korzystać z czatu.',
	'chat-no-login-text' => 'Zaloguj się, żeby korzystać z czatu.',
	'chat-default-topic' => 'Witaj na czacie $1',
	'chat-user-parted' => '$1 opuścił czat.',
	'chat-user-was-kickbanned' => '$1 został wyrzucony z czatu.',
	'chat-err-connected-from-another-browser' => 'Połączyłeś się z innej przeglądarki. To połączenie zostanie zamknięte.',
	'chat-err-communicating-with-mediawiki' => 'Wystąpił błąd podczas komunikacji z serwerem MediaWiki.',
	'chat-you-are-banned' => 'Błąd uprawnień.',
	'chat-you-are-banned-text' => 'Niestety, nie masz uprawnień do korzystania z czatu na tej wiki. Jeśli uważasz, że wynikło to z powodu błędu lub powinno być ponownie rozpatrzone, skontaktuj się z administratorem.',
	'chat-room-is-not-on-this-wiki' => 'Chatroom, do którego próbujesz dołączyć wydaje się nie istnieć na tej wiki.',
	'chat-kick-log-reason' => 'Wyrzucony z czatu przez $1. Prosimy o kontakt z nimi w celu uzyskania dalszych informacji.',
	'chat-live' => 'Na żywo!',
	'chat-start-a-chat' => 'Rozpocznij czat',
	'chat-whos-here' => 'Obecnych ($1)',
	'chat-join-the-chat' => 'Dołącz do czatu',
	'chat-edit-count' => '$1 Edycji',
	'chat-member-since' => 'Użytkownik od $1',
);

/** Pashto (پښتو)
 * @author Ahmed-Najib-Biabani-Ibrahimkhel
 */
$messages['ps'] = array(
	'chat-live' => 'ژوندی!',
);

/** Portuguese (Português)
 * @author Hamilton Abreu
 */
$messages['pt'] = array(
	'chat-desc' => '[[Special:Chat|Conversação ao vivo]]',
	'chat-no-login' => 'Para conversar tem de autenticar-se.',
	'chat-no-login-text' => 'Autentique-se para conversar, por favor.',
	'chat-default-topic' => 'Bem-vindo(a) à conversação $1',
	'chat-user-parted' => '$1 saiu da conversação.',
	'chat-user-was-kickbanned' => '$1 foi banido.',
	'chat-inlinealert-a-made-b-chatmod' => '$1 tornou <strong>$2</strong> moderador.',
	'chat-err-connected-from-another-browser' => 'Ligou-se a partir de outro browser. Esta ligação será fechada.',
	'chat-err-communicating-with-mediawiki' => 'Erro de comunicação com o servidor do MediaWiki.',
	'chat-ban-cant-ban-moderator' => 'Não pode expulsar nem bloquear outro moderador.',
	'chat-ban-already-banned' => '$1 já está bloqueado da conversação nesta wiki.',
	'chat-ban-you-need-permission' => 'Não tem a permissão $1, que é necessária para expulsar ou bloquear utilizadores.',
	'chat-missing-required-parameter' => "'$1' é obrigatório mas não foi encontrado no pedido.",
	'chat-err-already-chatmod' => 'Erro: "$1" já está no grupo "$2".',
	'chat-err-no-permission-to-add-chatmod' => 'Erro: Não tem permissões para colocar este utilizador no grupo "$1".',
	'chat-userrightslog-a-made-b-chatmod' => '$1 promoveu $2 a moderador de conversação nesta wiki.',
	'chat-you-are-banned' => 'Erro de permissões.',
	'chat-you-are-banned-text' => 'Desculpe, mas não tem permissões para usar a conversação nesta wiki. Se acredita que a falta de permissões resulta de um erro ou pretende que o assunto seja reconsiderado, contacte um administrador, por favor.',
	'chat-room-is-not-on-this-wiki' => 'A sala de conversação onde está tentando entrar não parece existir nesta wiki.',
	'chat-kick-log-reason' => 'Banido da conversação desta wiki por $1.
Contacte este utilizador para mais informações.',
	'chat-headline' => 'Conversação $1',
	'chat-live' => 'Ao vivo!',
	'chat-start-a-chat' => 'Iniciar Conversação',
	'chat-whos-here' => 'Quem está aqui ($1)',
	'chat-join-the-chat' => 'Junte-se à Conversação',
	'chat-edit-count' => '$1 Edições',
	'chat-member-since' => 'Membro desde $1',
);

/** Brazilian Portuguese (Português do Brasil)
 * @author Aristóbulo
 */
$messages['pt-br'] = array(
	'chat-desc' => '[[Special:Chat|Bate-Papo]]',
	'chat-no-login' => 'Você precisa estar logado no bate-papo',
	'chat-no-login-text' => 'Por favor faça o login para o bate-papo.',
	'chat-default-topic' => 'Bem-vindo ao $1 bate-papo',
	'chat-you-are-banned' => 'Desculpe, você está banido do chat',
	'chat-you-are-banned-text' => 'Você foi banido do chat.
Se você acha que isso foi um erro ou gostaria de ser reconsiderado(a), por favor entre em contato com um administrador.',
);

/** Romanian (Română)
 * @author Stelistcristi
 */
$messages['ro'] = array(
	'chat-desc' => '[[Special:Chat|Chat live]]',
	'chat-no-login' => 'Trebuie să fii autentificat pentru a intra pe chat.',
	'chat-no-login-text' => 'Te rugăm autentifică-te pentru a intra pe chat.',
	'chat-start-a-chat' => 'Porneşte un chat',
	'chat-whos-here' => 'Cine-i aici ($1)',
	'chat-join-the-chat' => 'Alăturaţi-vă chat-ului',
	'chat-member-since' => 'Membru din $1',
);

/** Serbian Cyrillic ekavian (‪Српски (ћирилица)‬)
 * @author Rancher
 */
$messages['sr-ec'] = array(
	'chat-desc' => '[[Special:Chat|Ћаскање]]',
	'chat-no-login' => 'Морате бити пријављени да бисте ћаскали.',
	'chat-no-login-text' => 'Пријавите се да бисте ћаскали.',
	'chat-default-topic' => 'Добро дошли на ћасање $1',
	'chat-you-are-banned' => 'Забрањен вам је приступ ћаскању.',
	'chat-you-are-banned-text' => 'Забрањен вам је приступ ћаскању.
Ако мислите да је ово грешка, контактирајте администратора.',
	'chat-kick-log-reason' => 'Избачени сте са ћаскања од стране {{GENDER:$1|корисника|кориснице|корисника}} $1.
Контактирајте га да бисте сазнали зашто сте избачени.',
);

/** Swedish (Svenska)
 * @author Lokal Profil
 * @author WikiPhoenix
 */
$messages['sv'] = array(
	'chat-desc' => '[[Special:Chat|Live-chatt]]',
	'chat-no-login' => 'Du måste vara inloggad för att chatta.',
	'chat-no-login-text' => 'Var god logga in för att chatta.',
	'chat-default-topic' => 'Välkommen till $1-chatten',
	'chat-user-parted' => '$1 har lämnat chatten.',
	'chat-user-was-kickbanned' => '$1 blev utsparkad.',
	'chat-inlinealert-a-made-b-chatmod' => '$1 har gjort <strong>$2</strong> till en chattmoderator.',
	'chat-err-connected-from-another-browser' => 'Du har anslutit från en annan webbläsare. Denna anslutning kommer att stängas.',
	'chat-err-communicating-with-mediawiki' => 'Fel uppstod vid kommunikation med MediaWiki-servern.',
	'chat-ban-cant-ban-moderator' => 'Du kan inte sparka/stänga av en annan chattmoderator.',
	'chat-ban-already-banned' => '$1 är redan avstängd från chatten på denna wiki.',
	'chat-ban-you-need-permission' => 'Du har inte $1-behörighet som krävs för att sparka/stänga av en användare.',
	'chat-missing-required-parameter' => "'$1' krävs, men hittades inte i begäran.",
	'chat-err-already-chatmod' => 'Fel: "$1" är redan i gruppen "$2".',
	'chat-err-no-permission-to-add-chatmod' => 'Fel: Du har inte behörighet att lägga till gruppen "$1" till den här användaren.',
	'chat-userrightslog-a-made-b-chatmod' => '$1 befordrade $2 att vara en chattmoderator på denna wiki.',
	'chat-you-are-banned' => 'Behörighetsfel.',
	'chat-you-are-banned-text' => 'Tyvärr har du inte behörighet att chatta på denna wiki. Om du tror att detta var ett misstag eller vill bli omprövad, var god kontakta en administratör.',
	'chat-room-is-not-on-this-wiki' => 'Chattrummet du försöker gå in på verkar inte finnas på denna wiki.',
	'chat-kick-log-reason' => 'Utsparkad/avstängd från chatten för den här wikin av $1. Kontakta dem för mer information.',
	'chat-headline' => '$1-chatt',
	'chat-live' => 'Live!',
	'chat-start-a-chat' => 'Starta en chatt',
	'chat-whos-here' => 'Vem är här ($1)',
	'chat-join-the-chat' => 'Delta i chatten',
	'chat-edit-count' => '$1 redigeringar',
	'chat-member-since' => 'Medlem sedan $1',
);

/** Thai (ไทย)
 * @author Akkhaporn
 */
$messages['th'] = array(
	'chat-desc' => '[[Special:Chat|Live chat]]',
	'chat-no-login' => 'คุณต้องล็อกอินในการสนทนา',
	'chat-no-login-text' => 'กรุณาเข้าสู่ระบบเพื่อสนทนา',
	'chat-default-topic' => 'ยินดีต้อนรับ $1 สู่ห้องสนทนา',
	'chat-user-parted' => '$1 ได้ออกจากห้องสนทนา',
	'chat-user-was-kickbanned' => '$1 ถูกเตะออกจากห้อง',
	'chat-inlinealert-a-made-b-chatmod' => '$1 ได้แต่งตั้ง <strong>$2</strong> เป็นผู้ดูแลห้องสนทนา',
	'chat-err-connected-from-another-browser' => 'คุณได้มีเชื่อมต่อจากเบราเซอร์อื่น การเชื่อมต่อนี้จะถูกปิด',
	'chat-err-communicating-with-mediawiki' => 'มีข้อผิดพลาดในการสื่อสารกับเซิร์ฟเวอร์ของมีเดียวิกิ',
	'chat-ban-cant-ban-moderator' => 'คุณไม่สามารถ เตะ/แบน ผผู้ดูแลห้องสนทนาคนอื่น',
	'chat-ban-already-banned' => '$1 ถูกแบนแล้วจากห้องสนทนาวิกิ',
	'chat-ban-you-need-permission' => 'คุณไม่มีสิทธิ์ $1 ซึ่งจะต้องการไป เตะ/แบน ผู้ใช้',
	'chat-missing-required-parameter' => "'$1' เป็นสิ่งจำเป็น แต่ไม่พบในการร้องขอ",
	'chat-err-already-chatmod' => 'ผิดพลาด: "$1" มีอยู่แล้วในกลุ่ม "$2"',
	'chat-err-no-permission-to-add-chatmod' => 'ผิดพลาด: คุณไม่ได้รับสิทธิ์ในการเพิ่มกลุ่ม "$1" ไปยังผู้ใช้รายนี้',
	'chat-userrightslog-a-made-b-chatmod' => '$1 เลื่อนขั้น $2 เป็นผู้ดูแลห้องสนทนาวิกิ',
	'chat-you-are-banned' => 'ข้อผิดพลาดในการใช้สิทธิ์',
	'chat-you-are-banned-text' => 'ขออภัย, คุณไม่ได้รับสิทธิ์ในการใช้ห้องสนทนาวิกินี้. ถ้าคุณคิดว่านี่เป็นความผิดพลาดหรือต้องการที่จะได้รับการพิจารณา, กรุณาติดต่อผู้ดูแลระบบ',
	'chat-room-is-not-on-this-wiki' => 'ในห้องสนทนาที่คุณกำลังพยายามที่จะป้อนจะไม่ปรากฏอยู่ในวิกินี้',
	'chat-kick-log-reason' => 'เตะ/แบน จากห้องสนทนาวิกิโดย $1. กรุณาติดต่อพวกเขาสำหรับข้อมูล',
	'chat-headline' => '$1 พูดว่า',
	'chat-live' => 'สด!',
	'chat-start-a-chat' => 'เริ่มต้นสนทนา',
	'chat-whos-here' => 'ออนไลน์ ($1)',
	'chat-join-the-chat' => 'เข้าร่วมสนทนา',
	'chat-edit-count' => '$1 การแก้ไข',
	'chat-member-since' => 'เป็นสมาชิกตั้งแต่ $1',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'chat-desc' => '[[Special:Chat|Buhay na satsatan]]',
	'chat-no-login' => 'Dapat kang nakalagda upang makapagsatsatan',
	'chat-no-login-text' => 'Mangyaring lumagda upang makapagsatsatan.',
	'chat-default-topic' => 'Maligayang pagdating sa satsatang $1',
	'chat-you-are-banned' => 'Kamalian sa mga kapahintulutan.',
	'chat-you-are-banned-text' => 'Paumanhin, wala kang pahintulot na makipagsatsatan sa wiking ito.
Kung iniisip mong isa itong pagkakamali o nais mong muling maisaalang-alang, mangyaring makipag-ugnayan sa isang tagapangasiwa.',
	'chat-kick-log-reason' => 'Sinipa/pinagbawala mula sa satsatan para sa wiking ito ni $1.
Mangyaring makipag-ugnayan sa kanila para sa mas maraming kabatiran.',
	'chat-headline' => '$1 Satsatan',
	'chat-live' => 'Buhay!',
	'chat-start-a-chat' => 'Magsimula ng isang Satsatan',
	'chat-whos-here' => 'Sino ang narito ($1)',
	'chat-join-the-chat' => 'Sumali sa Satsatan',
	'chat-edit-count' => '$1 Mga pamamatnugot',
	'chat-member-since' => 'Kasapi magmula pa noong $1',
);

/** Vietnamese (Tiếng Việt)
 * @author Xiao Qiao
 * @author XiaoQiaoGrace
 */
$messages['vi'] = array(
	'chat-desc' => '[[Special:Chat|Trò chuyện trực tuyến]]',
	'chat-no-login' => 'Bạn phải đăng nhập để trò chuyện.',
	'chat-no-login-text' => 'Vui lòng đăng nhập để trò chuyện.',
	'chat-default-topic' => 'Chào mừng đến với trò chuyện $1',
	'chat-user-parted' => '$1 đã rời khỏi cuộc tán gẫu',
	'chat-user-was-kickbanned' => '$1 đã bị bậc ra.',
	'chat-err-connected-from-another-browser' => 'Bạn đã kết nối từ một trình duyệt khác. Kết nối này sẽ bị đóng.',
	'chat-err-communicating-with-mediawiki' => 'Lỗi giao tiếp với hệ thống MediaWiki.',
	'chat-ban-cant-ban-moderator' => 'Bạn không thể đẩy/cấm người điều hành trò chuyện',
	'chat-ban-already-banned' => '$1 đã bị cấm trò chuyện trên wiki này',
	'chat-ban-you-need-permission' => 'Bạn không có quyền từ $1 để yêu cầu đẩy/cấm một người dùng.',
	'chat-err-no-permission-to-add-chatmod' => 'Lỗi: Bạn không có quyền cấp nhóm "$1" cho người dùng này.',
	'chat-userrightslog-a-made-b-chatmod' => '$1 phong cấp $2 thành điều phối viên phòng trò chuyện tại wiki này.',
	'chat-you-are-banned' => 'Lỗi về quyền',
	'chat-you-are-banned-text' => 'Xin lỗi, bạn không được phép trò chuyện trên wiki này. Nếu bạn nghĩ rằng đây là một sai lầm hoặc muốn được xem xét lại, xin vui lòng liên hệ với một bảo quản viên.',
	'chat-room-is-not-on-this-wiki' => 'Phòng trò chuyện bạn đang cố gắng nhập vào có vẻ không tồn tại trên wiki này.',
	'chat-kick-log-reason' => 'Bị đẩy/cấm từ trò chuyện trong wiki này bởi $1. Xin liên hệ với họ để có thông tin.',
	'chat-headline' => '$1 trò chuyện',
	'chat-live' => 'Trực tuyến!',
	'chat-start-a-chat' => 'Bắt đầu cuộc trò chuyện',
	'chat-whos-here' => 'Ai đang ở đây ($1)',
	'chat-join-the-chat' => 'Tham gia trò chuyện',
	'chat-edit-count' => '$1 chỉnh sửa',
	'chat-member-since' => 'Gia nhập từ $1',
);

/** Simplified Chinese (‪中文(简体)‬)
 * @author Liangent
 */
$messages['zh-hans'] = array(
	'chat-desc' => '[[Special:Chat|在线聊天]]',
	'chat-no-login' => '您必须登录以聊天。',
	'chat-no-login-text' => '请登录以聊天。',
	'chat-default-topic' => '欢迎来到$1聊天',
	'chat-you-are-banned' => '权限错误。',
	'chat-headline' => '$1聊天',
	'chat-live' => '在线！',
	'chat-start-a-chat' => '开始聊天',
	'chat-whos-here' => '谁在这里（$1）',
	'chat-join-the-chat' => '加入聊天',
	'chat-edit-count' => '$1次编辑',
	'chat-member-since' => '$1以来的成员',
);

