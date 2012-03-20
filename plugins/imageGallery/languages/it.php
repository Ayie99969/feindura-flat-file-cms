<?php
/**
 * ITALIAN (IT) language-file for the imageGallery plugin
 * Traslated in Italian By Raffaele Panariello [Social Service] unuomoinblues@gmail.com
 * NEEDS a RETURN $pluginLangFile; at the END
 * 
 * 
 * Every plugin language file has to have:
 *    - $pluginLangFile['feinduraPlugin_title']        = 'Exampletitle';
 *    - $pluginLangFile['feinduraPlugin_description']  = 'This is an example plugin dscription.';
 *  
 * If the array key has an "configname_tip" on the end it will be used as toolTip.
 * E.g.:
 * $pluginLangFile['exampleconfig_tip'] = 'Example config tooltip text';
 * 
 * @package [Plugins]
 * @subpackage imageGallery
 */

/* PLUGIN ************************************************************************************ */

$pluginLangFile['feinduraPlugin_title']        = 'Galleria Immagini';
$pluginLangFile['feinduraPlugin_description']  = 'Elenca le immagini da una cartella sul server. Una miniatura verr&#224; creata automaticamente per ogni immagine. Quando si fa clic su un\'immagine, sar&#224; mostrata con le sue dimensioni reali in un <a href="http://reghellin.com/milkbox/">lightbox</a>.';

/* CONFIG ************************************************************************************ */

$pluginLangFile['galleryPath']         = 'percorso della galleria';
$pluginLangFile['galleryPath_tip']     = 'percorso assoluto della cartella che contiene le immagini:: ad esempio &quot;/upload/Imagegallery1&quot;';
$pluginLangFile['galleryTitle']        = 'titolo della galleria';
$pluginLangFile['previewImage']        = 'nome del file immagine di anteprima della galleria';
$pluginLangFile['imageWidth']          = 'larghezza immagine';
$pluginLangFile['imageWidth_tip']      = 'in pixel';
$pluginLangFile['imageHeight']         = 'altezza immagine';
$pluginLangFile['imageHeight_tip']     = 'in pixel';
$pluginLangFile['thumbnailWidth']      = 'larghezza anteprima';
$pluginLangFile['thumbnailWidth_tip']  = 'in pixel';
$pluginLangFile['thumbnailHeight']     = 'altezza anteprima';
$pluginLangFile['thumbnailHeight_tip'] = 'in pixel';
$pluginLangFile['filenameCaptions']    = 'nome del file come didascalia';
$pluginLangFile['filenameCaptions_tip'] = 'Utilizza il nome del file (senza estensione), come didascalia, se nessuna linea in un captions.txt esiste per questo file.';
$pluginLangFile['tag']                 = 'lista HTML-Tag';
$pluginLangFile['tag_tip']             = 'Il codice HTML-Tag che sar&#224; utilizzato per elencare le immagini::Il seguente codice HTML-tag sono consentiti: &quot;table&quot;, &quot;ul&quot; oder nothing.';
$pluginLangFile['breakAfter']          = 'break after';
$pluginLangFile['breakAfter_tip']      = 'Non funziona solo se la lista HTML-Tag � &quot;table&quot;:: Indica dopo quante immagini una nuova riga inizia.';


// -----------------------------------------------------------------------------------------------
// RETURN ****************************************************************************************
// -----------------------------------------------------------------------------------------------
return $pluginLangFile;

?>