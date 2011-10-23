<?php
/**
 * Interface messages for catdown tool.
 *
 * @toolowner platonides
 */

$url = '~platonides/catdown/';

$messages = array();

$messages['en'] = array(
	'title' => 'Download of images by category',
	'subtitle' => 'The easy way to download the images in a category',
	/* Labels */
	'project' => 'Project:',
	'category' => 'Category:',
	'thumbnailing' => 'Thumbnailing',
	'max-width' => 'Maximum width:',
	'max-height' => 'Maximum height:',

	/* Errors */
	'invalid-width' => 'Invalid width',
	'invalid-height' => 'Invalid height',
	'no-such-project' => "There's no such project",
	'no-images' => 'There are no images in that category',
	'category-is-url' => 'The given category name looks like a URL. You need to specify the category name, not its url.',
	'category-contains-namespace' => 'You seem to have included the namespace along the category name. With the given name, the page would be available as [[Category:$1]].',
	'zip-failed' => 'Zip creation failed',
	'image-area-too-big' => '$1 is too big to create a thumbnail. Using full size.',

	'download-info' => "There are $1 images with an estimated size of $2",
	'download' => 'Download',

	'readme-contents' => 'The enclosing file $4 lists 
the images at the $1 category ( $2 )$3.

== Instructions for downloading all the listed images ==
The download time may vary from a few minutes to several hours.

Windows:
 Extract all the files in the same folder and run $5
 $6
Linux/Mac OS
 Extract all the files and open a terminal in that folder. Run sh $5
',
	'non-bundled-wget' => "Note: This version doesn't include wget for Windows. You will need to decompress 
to a folder with wget.exe or otherwise have wget in the PATH",
	'wget-info' => 'This file bundles a copy of wget $1 (for Windows platform). Wget is Free Software, 
under the terms of the GNU GENERAL PUBLIC LICENSE version 3.
There is a copy of the license below, and it is also available at http://www.gnu.org/licenses/gpl-3.0.txt

In case you are interested in getting the source code for this program, you can download it from
 http://toolserver.org/~platonides/catdown/wget-sources.php?version=$1
 http://ftp.gnu.org/gnu/wget/wget-$1.tar.xz
 ftp://ftp.gnu.org/gnu/wget/wget-$1.tar.xz
or some other GNU Mirror, see
 http://www.gnu.org/prep/ftp.html
',

	'scaling-none' => '', // Optional
	'scaling-width' => ', scaled to a maximum width of $1 pixels',
	'scaling-height' => ', scaled to a maximum height of $1 pixels',
	'scaling-both' => ', scaled to a maximum size of $1x$2 pixels',

	'script-filename' => 'download.bat', // Optional
	'readme-filename' => 'README.txt', // Optional
);

/** Message documentation (Message documentation) */
$messages['qqq'] = array(
	'title' => 'Title for the tool',
	'subtitle' => 'Subtitle for the tool',
	'project' => 'Caption for choosing the project domain',
	'category' => 'Label for the input to choose the category to dump. It is recommended to make it the same as the local NS_CATEGORY, with trailing :',
	'thumbnailing' => 'Title for the inputs for max width and height',
	'max-width' => 'Label of the input to set the maximum width of the thumbnails.',
	'max-height' => 'Label of the input to set the maximum height of the thumbnails.',
	'invalid-width' => 'Shown when an invalid width is provided',
	'invalid-height' => 'Shown when an invalid height is provided',
	'no-such-project' => "Error given for wrong project (eg. 'qwerty.wikipedia')",
	'no-images' => "Shown when the category doesn't have any files",
	'category-is-url' => 'Shown when a full url is given as category name',
	'category-contains-namespace' => 'Shown when a category with namespace is given as category. $1: Given category name.',
	'zip-failed' => 'Generic error for when the zip creation failed',
	'image-area-too-big' => 'Shown when an image cannot be thumbnailed. See http://www.mediawiki.org/wiki/Manual:$wgMaxImageArea
Parameters: $1: Name of the image',
	'download-info' => 'Information shown previous to the download.
$1: Number of images.
$2: Estimated size of all the files in the system',
	'download' => 'Big link to download the zip',
	'readme-contents' => "Contents of the README file.
* $1: Category name
* $2: Category url
* $3 Result of scaling restrictions (one of scaling-none, scaling-width, scaling-height, scaling-both messages)
* $4: Filename of the list.
* $5 Name of the .bat script to run (script-filename msg)
* $6: Note if wget for Windows was not bundled (contents of non-bundled-wget message if \\'Bundle wget\\' was not checked)",
	'non-bundled-wget' => "Message added to the readme noting that the script won't work in Windows without a wget.exe (it is usually installed in other OS)",
	'wget-info' => 'Text appended to the readme explaining the rights you have on the wget binary.
$1: Version of wget

The content of the gpl-3.0 is appended below this text (untranslated, as it is required by the license).',
	'scaling-none' => "Added to readme-contents as $6 if there's no scaling",
	'scaling-width' => 'Added to readme-contents as $6 if the images are scaled to a maximum width.
$1: Maximum width in pixels',
	'scaling-height' => 'Added to readme-contents as $6 if the images are scaled to a maximum height.
$1: Maximum height in pixels',
	'scaling-both' => 'Added to readme-contents as $6 if the images are scaled to a maximum width and.
$1: Maximum width in pixels
$2: Maximum height in pixels',
	'script-filename' => 'Name of the script which downloads the files.',
	'readme-filename' => 'Name of the readme file',
);

/** Breton (Brezhoneg)
 * @author Fulup
 */
$messages['br'] = array(
	'title' => 'Pellgargañ skeudennoù dre rummadoù',
	'subtitle' => 'An doare aesañ da bellgargañ skeudennoù en ur rummad',
	'project' => 'Raktres :',
	'category' => 'Rummad :',
	'thumbnailing' => 'Munudiñ',
	'max-width' => 'Ledander brasañ :',
	'max-height' => 'Uhelder brasañ :',
	'invalid-width' => 'Ledander direizh',
	'invalid-height' => 'Uhelder direizh',
	'no-such-project' => "Ar raktres-mañ n'eus ket anezhañ",
	'no-images' => "N'eus skeudenn ebet er rummad-mañ",
	'category-is-url' => "Tres un URL zo gant anv ar rummad zo bet lakaet. Ret eo deoc'h merkañ anv ar rummad ha neket an URL anezhañ.",
	'category-contains-namespace' => "Evit doare eo bet lakaet ganeoc'h an esaouenn anv asambles gant anv ar rummad. Gant an anv roet e tlefe ar bajenn bezañ hegerz evel [[Category:$1]].",
	'image-area-too-big' => 'Re vras eo $1 da grouiñ ur munud. Ober gant ar vent leun.',
	'download-info' => '$1 skeudenn zo dezho ar vent a $2 pe war-dro',
	'download' => 'Pellgargañ',
	'readme-contents' => "Renabliñ a ra ar restr $4 enframmet 
ar skeudennoù zo er rummad $1 ( $2 )$3.

== Kuzulioù evit pellgargañ an holl skeudennoù rollet ==
An amzer bellgargañ a c'hall bezañ cheñch-dicheñch, eus un nebeud munutennoù betek meur a eurvezh.

Windows :
 Eztennañ an holl restroù en hevelep renkell ha lañsañ $5
 $6
Linux/Mac OS
 Eztennañ an holl restroù ha digeriñ un dermenell er renkell-se. Lañsañ sh $5",
);

/** German (Deutsch)
 * @author Kghbln
 */
$messages['de'] = array(
	'title' => 'Bilder nach Kategorie herunterladen',
	'subtitle' => 'Die einfache Möglichkeit die in einer Kategorie enthaltenen Bilder herunterzuladen',
	'project' => 'Projekt:',
	'category' => 'Kategorie:',
	'thumbnailing' => 'Miniaturbilderstellung',
	'max-width' => 'Maximale Breite:',
	'max-height' => 'Maximale Höhe:',
	'invalid-width' => 'Die Breite ist ungültig.',
	'invalid-height' => 'Die Höhe ist ungültig.',
	'no-such-project' => 'Das angegebene Projekt ist nicht vorhanden.',
	'no-images' => 'In dieser Kategorie sind keine Bilder enthalten.',
	'category-is-url' => 'Der angegebenen Kategorienamen scheint eine URL zu sein. Bitte den Kategorienamen und nicht dessen URL angeben.',
	'category-contains-namespace' => 'Du scheinst neben dem Kategorienamen auch die Namensraumbezeichnung angegeben zu haben. Mit dem angegebene Namen würde die Seite als [[Category:$1]] verfügbar sein.',
	'zip-failed' => 'ZIP-Erstellung fehlgeschlagen',
	'image-area-too-big' => '$1 ist zu groß, um eine Miniaturansicht erstellen zu können. Daher wird die volle Bildgröße genutzt.',
	'download-info' => 'Es sind $1 Bilder mit eine geschätzten Gesamtgröße von $2 vorhanden.',
	'download' => 'Herunterladen',
	'readme-contents' => 'Die Datei $4 listet die Bilder in der Kategorie $1 auf ($2) $3.

== Anleitung zum Herunterladen der aufgelisteten Bilder ==
Die für das Herunterladen benötigte Zeit kann zwischen wenigen Minuten und mehreren Stunden liegen.

Windows:
Alle Dateien in den selben Ordner entpacken und $5 ausführen.
$6
Linux/Mac OS:
Alle Dateien entpacken und ein Terminal öffnen. Danach sh $5 ausführen.',
	'non-bundled-wget' => 'Hinweis: Diese Version enthält nicht Wget für Windows. Du musst die Bilder mit wget.exe in einem Ordner
dekomprimieren oder Wget im Pfad bereitstellen.',
	'wget-info' => 'Diese Datei enthält eine Kopie von Wget $1 (für Windows). Wget ist Freie Software gemäß der
Lizenz „GNU GENERAL PUBLIC LICENSE“ in Version 3.
Eine Kopie der Lizenz befindet sich unten, ist aber auch unter der URL http://www.gnu.org/licenses/gpl-3.0.txt verfügbar.

Sofern du daran interessiert bist den Quellcode dieses Programms zu bekommen, kannst du ihn an folgenden Stellen herunterladen:
 http://toolserver.org/~platonides/catdown/wget-sources.php?version=$1
 http://ftp.gnu.org/gnu/wget/wget-$1.tar.xz
 ftp://ftp.gnu.org/gnu/wget/wget-$1.tar.xz
Es gibt auch andere GNU-Mirror. Siehe hierzu
 http://www.gnu.org/prep/ftp.html',
	'scaling-width' => ', auf eine maximale Breite von $1 Pixel skaliert',
	'scaling-height' => ', auf eine maximale Höhe von $1 Pixel skaliert',
	'scaling-both' => ', auf eine maximale Größe von $1x$2 Pixel skaliert',
);

/** German (formal address) (‪Deutsch (Sie-Form)‬)
 * @author Kghbln
 */
$messages['de-formal'] = array(
	'category-contains-namespace' => 'Sie scheinen neben dem Kategorienamen auch die Namensraumbezeichnung angegeben zu haben. Mit dem angegebene Namen würde die Seite als [[Category:$1]] verfügbar sein.',
	'wget-info' => 'Diese Datei enthält eine Kopie von Wget $1 (für Windows). Wget ist Freie Software gemäß der
Lizenz „GNU GENERAL PUBLIC LICENSE“ in Version 3.
Eine Kopie der Lizenz befindet sich unten, ist aber auch unter der URL http://www.gnu.org/licenses/gpl-3.0.txt verfügbar.

Sofern Sie daran interessiert sind den Quellcode dieses Programms zu bekommen, können Sie ihn an folgenden Stellen herunterladen:
 http://toolserver.org/~platonides/catdown/wget-sources.php?version=$1
 http://ftp.gnu.org/gnu/wget/wget-$1.tar.xz
 ftp://ftp.gnu.org/gnu/wget/wget-$1.tar.xz
Es gibt auch andere GNU-Mirror. Siehe hierzu
 http://www.gnu.org/prep/ftp.html',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'title' => 'Biller vun enger Kategorie eroflueden',
	'subtitle' => 'Déi einfach Manéier fir Biller aus enger Kategorie erofzelueden',
	'project' => 'Projet:',
	'category' => 'Kategorie:',
	'max-width' => 'Maximal Breet:',
	'max-height' => 'Maximal Héicht:',
	'no-such-project' => 'Esou e Projet gëtt et net',
	'no-images' => 'Et gëtt keng Biller an där Kategorie',
	'category-is-url' => "D'Kategorie déi ugi gouf gesäit wéi eng komplett URL aus. Dir musst den Numm vun der Kategorie uginn, an net hir URL.",
	'image-area-too-big' => '$1 ass ze grouss fir e Miniatur-Bild ze generéieren. Déi komplett Gréisst gëtt benotzt.',
	'download-info' => 'Et sinn $1 Biller mat enger geschater Gréisst vun $2 do',
	'download' => 'Eroflueden',
	'scaling-width' => ', op eng maximal Breet vu(n) $1 Pixel skaléiert',
	'scaling-height' => ', op eng maximal Héicht vu(n) $1 Pixel skaléiert',
	'scaling-both' => ', op eng maximal Gréisst vu(n) $1x$2 Pixel skaléiert',
);

/** Macedonian (Македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'title' => 'Преземање на слики по категории',
	'subtitle' => 'Лесен начин на преземање на сликите во некоја категорија',
	'project' => 'Проект:',
	'category' => 'Категорија:',
	'thumbnailing' => 'Минијатуризација',
	'max-width' => 'Макс. ширина:',
	'max-height' => 'Макс. висина:',
	'invalid-width' => 'Неважечка висина',
	'invalid-height' => 'Неважечка ширина',
	'no-such-project' => 'Нема таков проект',
	'no-images' => 'Во таа категорија нема слики',
	'category-is-url' => 'Зададеното име личи на URL-адреса. Треба да го наведете името на категоријата, а не адресата.',
	'category-contains-namespace' => 'Изгледа дека сте го навеле именскиот простор заедно со името на категоријата. Со зададеното име, страницата ќе биде достапна на [[Category:$1]].',
	'zip-failed' => 'Не успеав да создадам ZIP',
	'image-area-too-big' => 'Сликата $1 е преголема за да може да се минијатуризира. Ќе ја употребам полната големина.',
	'download-info' => 'Има $1 слики со проценета вкупна големина од $2',
	'download' => 'Преземи',
	'readme-contents' => 'Во податотеката $4 се наведени 
сликите во категоријата $1 ( $2 )$3.

== Напатствија за преземање на сите наведени слики ==
Преземањето може да потрае од неколку минути до неколку часа.

Windows:
 Отпакувајте ги сите податотеки во иста папка и пуштете ја $5
 $6
Linux/Mac OS
Отпакувајте ги сите податотеки и отворете терминал во таа папка. Пуштете ја sh $5',
	'non-bundled-wget' => 'Напомена: Оваа верзија не содржи wget за Windows. Отпакувањето ќе треба да  
го извршите во папка со wget.exe или веќе да имате wget во патеката',
	'wget-info' => "Податотекава содржи примерок на wget $1 (за Windows). Wget е слободна програмска опрема, 
и се нуди под условите на ГНУ-ОВАТА ОПШТА ЈАВНА ЛИЦЕНЦА (''GNU GENERAL PUBLIC LICENSE'') верзија 3.
Подолу е наведен примерок на лиценцата (достапен и на http://www.gnu.org/licenses/gpl-3.0.txt)

Доколку сакате да го добиете изворниот код на програмов, преземете го од
 http://toolserver.org/~platonides/catdown/wget-sources.php?version=$1
 http://ftp.gnu.org/gnu/wget/wget-$1.tar.xz
 ftp://ftp.gnu.org/gnu/wget/wget-$1.tar.xz
или некое друго огледало на ГНУ, вид.
 http://www.gnu.org/prep/ftp.html",
	'scaling-width' => ', со изменет размер до максимална ширина од $1 пиксели',
	'scaling-height' => ', со изменет размер до висина ширина од $1 пиксели',
	'scaling-both' => ', со изменет размер до максимална големина од $1 x $2 пиксели',
	'script-filename' => 'преземање.bat',
	'readme-filename' => 'ДОКУМЕНТАЦИЈА.txt',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'title' => 'Muat turun imej mengikut kategori',
	'subtitle' => 'Cara yang mudah untuk memuat turun imej dalam satu kategori',
	'project' => 'Projek:',
	'category' => 'Kategori:',
	'thumbnailing' => 'Thumbnail',
	'max-width' => 'Lebar maksimum:',
	'max-height' => 'Tinggi maksimum:',
	'invalid-width' => 'Lebar tidak sah',
	'invalid-height' => 'Tinggi tidak sah',
	'no-such-project' => 'Projek ini tidak wujud',
	'no-images' => 'Tiada imej dalam kategori itu',
	'category-is-url' => 'Nama kategori yang diberikan nampak seperti URL. Anda perlu menyatakan nama kategori itu, bukan URL-nya.',
	'category-contains-namespace' => 'Nampaknya anda telah menyertakan ruang nama dengan nama kategori. Dengan nama yang diberikan, laman itu tersedia sebagai [[Category:$1]].',
	'zip-failed' => 'Zip gagal dibuat',
	'image-area-too-big' => '$1 terlalu besar untuk membuat thumbnail. Saiz penuh digunakan.',
	'download-info' => 'Terdapat $1 imej yang saiznya sekitar $2',
	'download' => 'Muat turun',
	'readme-contents' => 'Fail pelampir $4 menyenaraikan
imej-imej di kategori $1 ( $2 )$3.

== Arahan memuat turun semua imej tersenarai ==
Jangka masa muat turun mungkin antara beberapa minit dan beberapa jam.

Windows:
 Ekstrakkan semua fail dalam folder yang sama dan jalankan $5
 $6
Linux/Mac OS
 Ekstrakkan semua fail dan buka sebuah terminal dalam folder itu. Jalankan sh $5',
	'non-bundled-wget' => 'Perhatian: Versi ini tidak menyertakan wget untuk Windows. Anda mungkin perlu menyahmampatkannya ke dalam folder dengan wget.exe, ataupun mempunyai wget dalam LALUAN',
	'wget-info' => 'Fail ini memberkaskan salinan wget $1 (untuk platform Windows). Wget ialah Perisian Bebas, 
mengikut terma-terma LESEN AWAM AM GNU versi 3.
Di bawa adalah satu salinan lesen, dan ia juga didapati di http://www.gnu.org/licenses/gpl-3.0.txt

Sekiranya anda berminat untuk mendapatkan kod sumber untuk program ini, anda boleh memuat turunnya dari
 http://toolserver.org/~platonides/catdown/wget-sources.php?version=$1
 http://ftp.gnu.org/gnu/wget/wget-$1.tar.xz
 ftp://ftp.gnu.org/gnu/wget/wget-$1.tar.xz
atau mana-mana Cermin GNU yang lain, rujuk
 http://www.gnu.org/prep/ftp.html',
	'scaling-width' => ', dilaraskan kepada lebar maksimum $1 piksel',
	'scaling-height' => ', dilaraskan kepada tinggi maksimum $1 piksel',
	'scaling-both' => ', dilaraskan kepada saiz maksimum $1x$2 piksel',
);

/** Dutch (Nederlands)
 * @author SPQRobin
 */
$messages['nl'] = array(
	'title' => 'Downloaden van afbeeldingen in een categorie',
	'subtitle' => 'De gemakkelijke manier om afbeeldingen in een bepaalde categorie te downloaden',
	'project' => 'Project:',
	'category' => 'Categorie:',
	'max-width' => 'Maximale breedte:',
	'max-height' => 'Maximale hoogte:',
	'invalid-width' => 'Ongeldige breedte',
	'invalid-height' => 'Ongeldige hoogte',
	'no-such-project' => 'Er bestaat geen project met die naam',
	'no-images' => 'Er zijn geen afbeeldingen in die categorie',
	'category-is-url' => 'De opgegeven categorienaam lijkt een URL te zijn. U moet de categorienaam opgeven, niet de URL.',
	'zip-failed' => 'Het maken van een zip-bestand is mislukt',
	'image-area-too-big' => '$1 is te groot om een miniatuur maken. De volledige grootte wordt gebruikt.',
	'download-info' => 'Er zijn $1 afbeeldingen met een geschatte grootte van $2',
	'download' => 'Downloaden',
);

/** Telugu (తెలుగు)
 * @author Veeven
 */
$messages['te'] = array(
	'project' => 'ప్రాజెక్టు:',
	'category' => 'వర్గం:',
	'max-width' => 'గరిష్ఠ వెడల్పు:',
	'max-height' => 'గరిష్ఠ ఎత్తు:',
	'invalid-width' => 'చెల్లని వెడల్పు',
	'invalid-height' => 'చెల్లని ఎత్తు',
	'no-such-project' => 'అటువంటి ప్రాజెక్టు లేదు',
	'no-images' => 'ఆ వర్గంలో బొమ్మలు ఏమీ లేవు',
);

/** Vietnamese (Tiếng Việt)
 * @author Minh Nguyen
 */
$messages['vi'] = array(
	'title' => 'Tải về hình ảnh theo thể loại',
	'subtitle' => 'Cách dễ dàng để tải về tất cả các hình ảnh trong một thể loại',
	'project' => 'Dự án:',
	'category' => 'Thể loại:',
	'thumbnailing' => 'Hình nhỏ',
	'max-width' => 'Chiều rộng tối đa:',
	'max-height' => 'Chiều cao tối đa:',
	'invalid-width' => 'Chiều rộng không hợp lệ',
	'invalid-height' => 'Chiều cao không hợp lệ',
	'no-such-project' => 'Không tìm thấy dự án này.',
	'no-images' => 'Không tìm thấy hình ảnh trong thể loại này.',
	'category-is-url' => 'Hình như địa chỉ URL được cho vào thay vì tên thể loại. Xin cho vào tên thể loại.',
	'category-contains-namespace' => 'Hình như bạn đã bao gồm không gian tên cùng với tên thể loại. Với tên này, trang sẽ là [[Category:$1]].',
	'zip-failed' => 'Thất bại khi tạo ZIP',
	'image-area-too-big' => '$1 quá lớn để tạo ra hình thu nhỏ. Đang sử dụng kích cỡ gốc thay thế.',
	'download-info' => 'Có $1 hình ảnh với kích thước ước lượng là $2',
	'download' => 'Tải về',
	'readme-contents' => 'Tập tin kèm theo $4 liệt kê
các hình ảnh trong thể loại $1 ( $2 )$3.

== Hướng dẫn tải về tất cả các hình ảnh trong danh sách ==
Có thể cần vài phút đến vào tiếng để tải về xong.

Windows:
:Giải nén tất cả các tập tin vào cùng thư mục và chạy <code>$5</code>
:$6
Linux và Mac OS:
:Giải nén tất cả các tập tin vào cùng thư mục và chỉ dòng lệnh đến thư mục đó. Chạy <code>sh $5</code>',
	'non-bundled-wget' => 'Lưu ý: Phiên bản này không bao gồm wget cho Windows. Bạn sẽ cần phải giải nén các tập tin vào một thư mục có wget.exe hoặc có biến PATH chỉ đến wget.',
	'wget-info' => 'Tập tin này kèm theo wget $1 (dành cho nền Windows). Wget là Phần mềm Tự do,
theo các điều khoản của GIẤY PHÉP CÔNG CỘNG GNU phiên bản 3.
Giấy phép có sẵn ở dưới và tại http://www.gnu.org/licenses/gpl-3.0.txt

Trong trường hợp bạn muốn lấy mã nguồn của chương trình này, bạn có thể tải nó về từ
 http://toolserver.org/~platonides/catdown/wget-sources.php?version=$1
 http://ftp.gnu.org/gnu/wget/wget-$1.tar.xz
 ftp://ftp.gnu.org/gnu/wget/wget-$1.tar.xz
hoặc một Kho phần mềm GNU khác; xem
 http://www.gnu.org/prep/ftp.html',
	'scaling-width' => ', được chỉnh lại theo chiều rộng tối đa là $1 điểm ảnh',
	'scaling-height' => ', được chỉnh lại theo chiều cao tối đa là $1 điểm ảnh',
	'scaling-both' => ', được chỉnh lại theo kích cỡ tối đa là $1 × $2 điểm ảnh',
);

