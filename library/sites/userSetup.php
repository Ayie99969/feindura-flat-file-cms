<!-- 
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+ PHPAccess by sc02
+ Administration of 
+ Password protection for WWW-directories by HTAccess
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

edited by Fabian Vogelsteller:

- strip <html><head> and <body> tags
- change css
- include <input type="hidden" name="" value="true" id="hiddenSubmit" /> ajax hack: hand over the submit buttom name for the ajax 
- include onsubmit for ajax

verion 0.5

 -->
<?php
//error_reporting(E_ALL);



/**********************/
/*  FILE-PERMISSIONS  */
/**********************/
/* Directory   : 0777 */
/* Script      : 0775 */
/**********************/

$adminloginname = "admin";		/* Enter the admin-username of your choice */
$adminloginpass = "";		/* pw: userchange | Enter the admin-password of your choice */


/******************************/
/*    Select Language         */
/******************************/
/*  0 = English (standard)    */
/*  1 = German                */
/*  2 = Trad. Chinese (BIG 5) */
/*  3 = Brazilian-Portuguese  */ 
/*  4 = French                */
/*  5 = Italian               */
/*  6 = Spanish				        */
/*  7 = Japanese	(EUC-JP)    */
/*  8 = Dutch				          */
/*  9 = Arabic                */
/* 10 = Hungarian             */
/******************************/

/* Enter the ID of the language, phpaccess should start with */

if($_SESSION['language'] == 'de')
  $standardlanguage = 1;
else
  $standardlanguage = 0;


/* HTPASSWD.EXE - crypting for windows-servers */
/* htpasswd.exe comes with apache and locates in apache's bin-dir */
/* if your path doesn't work, try copying the file to c:\ */

define("USEHTPASSWDEXE", false);
define("HTPASSWDEXELOC" , "c:/htpasswd.exe");


/*********************/
/*  Read-Only Users  */
/*********************/
/* Here you can define read-only users.           */
/* This users cannot be changed with phpaccess!   */
/* They are not safe from the DeleteAll-Function, */
/* because this deletes the two ht...-files       */
/* You have to uncomment the lines and enter an   */
/* existing user between the double-quotes ""     */

/* note: uncommenting = delete the two slashes    */
/* at the beginning of the line                   */

//$readonlyusers[] = "admin";


/***********************/
/*  DISABLE Functions  */
/***********************/
$disable['deleteall'] = 1;		/* set to 1 to deactivate the 'DeleteAll-Function' */
$disable['fileimportuser'] = 1;		/* set to 1 to deactivate the 'Import User from File' */

/***************/
/*  CONSTANTS  */
/***************/
define("AUTHNAME", "FrozeMentSystem");
define("PASSWDFILE", dirname(__FILE__)."/../../.htpasswd");
define("ACCESSFILE", dirname(__FILE__)."/../../.htaccess");
define("SCRIPTVERSION","1.05");
define("SERVERNAME", getenv("SERVER_NAME"));


/******************/
/* Language-Packs */
/******************/

if (!isset($HTTP_POST_VARS['languageselect'])) { 
	
	$languageselect = $standardlanguage; 
	
} else { /* set standard language */

	$languageselect = $HTTP_POST_VARS['languageselect']; 

} //endif

if($languageselect == 1) {	/* German Language Pack */

	$languagearray = array (

	1	=>	"Leere Eingabe f&uuml;r 'Passwort' nicht erlaubt.\n",
	2	=>	"Leere Eingabe f&uuml;r 'Benutzer' nicht erlaubt.\n",
	3	=>	"Passwortbest&auml;tigung stimmt nicht mit Passwort &uuml;berein.\n",
	4	=>	"Dieser Benutzer ist schreibgesch&uuml;tzt.\n",
	5	=>	"Keine \"".PASSWDFILE."\"-Datei vorhanden.\n",
	6	=>	"Keine \"".ACCESSFILE."\"-Datei vorhanden.\n",
	7	=>	"Keine Benutzer in \"".PASSWDFILE."\" eingetragen.\n",
	8	=>	"Vorhandene Benutzer erfolgreich eingelesen.\n",
	9	=>	"Noch keine Benutzer vorhanden.\n",
	10	=>	ACCESSFILE."\" erfolgreich erstellt.\n",
	12	=>	"Diese Funktion wurde deaktiviert.\n",
	14	=>	"Passwortschutz deaktiviert.\n",
	15	=>	"Sie haben keine Datei gew&auml;hlt.\n",
	18	=>	"Upload der Datei ist gescheitert.\n",

	16	=>	"Benutzer \"",
	17	=>	"\" ist bereits vorhanden.\n",

	19	=>	"L&ouml;schen von \"",
	20	=>	"\" auf dem Webserver gescheitert - bitte manuell entfernen.\n",

	11	=>	"Erfolgreiches Hinzuf&uuml;gen von \"",
	13	=>	"Erfolgreiches L&ouml;schen des Benutzers \"",
	21	=>	"Update des Kennwortes von \"",
	22	=>	"\".\n",

	100	=>	"Status :",
	101	=>	"Server-Information und -Pfad :",
	102	=>	"Vorhandene Benutzer :",
	103	=>	"Neuen Benutzer anlegen :",
	104	=>	"Best&auml;tigung :",
	105	=>	"Passwort &auml;ndern :",
	106	=>	"Benutzer l&ouml;schen :",
	107	=>	"Alle Benutzer l&ouml;schen :",
	108	=>	"Server:",
	109	=>	"Pfad:",
	110	=>	"Benutzer aus Datei importieren :",
	112	=>	"[ Format: Benutzer,Kennwort ]",
	111	=>	"Datei :",
	
	200	=>	"Anlegen",
	201	=>	"&Auml;ndern",
	202	=>	"L&ouml;schen",
	203	=>	"Alle l&ouml;schen",
	204	=>	"Importieren",

	300	=>	"PHPAccess-Login",
	301	=>	"Login-Name",
	302	=>	"Login-Kennwort",
	303	=>	"Login"

	);	//endarray
	
} elseif($languageselect == 2) {	/* BIG5 Language Pack */

	$languagearray = array (

	1	=>	"&#23578;&#26410;&#36664;&#20837;&#23494;&#30908;.\n", 
	2	=>	"&#23578;&#26410;&#36664;&#20837;&#24115;&#34399;.\n", 
	3	=>	"&#23494;&#30908;&#30906;&#35469;&#22833;&#25943;.\n", 
	4	=>	"&#27492;&#24115;&#34399;&#28858;&#21807;&#35712;.\n", 
	5	=>	"&#27492;&#27284;&#26696; \"".PASSWDFILE."\"&#23578;&#26410;&#34987;&#24314;&#31435;.\n", 
	6	=>	"&#27492;&#27284;&#26696; \"".ACCESSFILE."\"&#23578;&#26410;&#34987;&#24314;&#31435;.\n", 
	7	=>	"&#23578;&#26410;&#22312; \"".PASSWDFILE."\"&#20013;&#24314;&#31435;&#24115;&#34399;.\n", 
	8	=>	"&#21295;&#20837;&#20351;&#29992;&#32773;&#25104;&#21151;.\n", 
	9	=>	"&#23578;&#26410;&#24314;&#31435;&#20351;&#29992;&#32773;.\n", 
	10	=>	"&#27492;&#27284;&#26696; \"".ACCESSFILE."\"&#20197;&#24314;&#31435;&#25104;&#21151;.\n", 
	12	=>	"&#27492;&#21151;&#33021;&#24050;&#20572;&#27490;&#36939;&#20316;\n", 
	14	=>	"&#31995;&#32113;&#29694;&#34389;&#26044;&#26410;&#20445;&#35703;&#29376;&#24907;.\n", 
	15	=>	"&#23578;&#26410;&#36984;&#25799;&#27284;&#26696;.\n", 
	18	=>	"&#21295;&#20837;&#27284;&#26696;&#22833;&#25943;.\n", 

	16	=>	"&#27492;&#24115;&#34399; \"", 
	17	=>	"\" &#24050;&#32147;&#23384;&#22312;.\n", 

	19	=>	"&#33258;&#21205;&#21034;&#38500;&#27492;&#27284;&#26696; \"", 
	20	=>	"\" &#22833;&#25943; - &#35531;&#25163;&#21205;&#23559;&#20043;&#31227;&#38500;.\n", 

	11	=>	"&#25104;&#21151;&#30340;&#26032;&#22686;&#20351;&#29992;&#32773;&#24115;&#34399; \"", 
	13	=>	"&#25104;&#21151;&#30340;&#21034;&#38500;&#20351;&#29992;&#32773;&#24115;&#34399; \"", 
	21	=>	"&#25104;&#21151;&#30340;&#26356;&#26032;&#20351;&#29992;&#32773;&#23494;&#30908; \"", 
	22	=>	"\".\n", 

	100	=>	"&#29376;&#24907; :", 
	101	=>	"&#20027;&#27231;&#21517;&#31281; & &#27284;&#26696;&#36335;&#24465; :", 
	102	=>	"&#24050;&#23384;&#22312;&#30340;&#20351;&#29992;&#32773; :", 
	103	=>	"&#24314;&#31435;&#26032;&#20351;&#29992;&#32773; :", 
	104	=>	"&#20877;&#27425;&#30906;&#35469;&#23494;&#30908; :", 
	105	=>	"&#26356;&#26032;&#23494;&#30908; :", 
	106	=>	"&#21034;&#38500;&#24050;&#23384;&#22312;&#30340;&#20351;&#29992;&#32773; :", 
	107	=>	"&#21034;&#38500;&#25152;&#26377;&#20351;&#29992;&#32773; :", 
	108	=>	"&#20027;&#27231;&#21517;&#31281;:", 
	109	=>	"&#27284;&#26696;&#36335;&#24465;:", 
	110	=>	"&#21295;&#20837;&#20351;&#29992;&#32773;&#25991;&#23383;&#27284;&#26696; :", 
	112	=>	"[ &#26684;&#24335;: &#24115;&#34399;,&#23494;&#30908; ]", 
	111	=>	"&#27284;&#26696; :", 

	200	=>	"&#24314;&#31435;", 
	201	=>	"&#26356;&#26032;", 
	202	=>	"&#21034;&#38500;", 
	203	=>	"&#20840;&#37096;&#21034;&#38500;", 
	204	=>	"&#21295;&#20837;",

	300	=>	"PHPAccess-&#30331;&#20837;",
	301	=>	"&#30331;&#20837;&#24115;&#34399;:",
	302	=>	"&#30331;&#20837;&#23494;&#30908;:",
	303	=>	"&#30331;&#20837;"

	);	//endarray

} elseif($languageselect == 3) {

	$languagearray = array (

	1	=>	"Campo n�o preenchido 'pass' isto n�o � permitido.\n",
	2	=>	"Campo n�o preenchido 'user' isto n�o � permitido.\n",
	3	=>	"Senha e Confirma��o n�o s�o iguais.\n",
	4	=>	"Este usu�rio j� esta cadastrado.\n",
	5	=>	"Sem \"".PASSWDFILE."\"-arquivo disponivel.\n",
	6	=>	"Sem \"".ACCESSFILE."\"-arquivo disponivel.\n",
	7	=>	"Sem lista de usu�rios internos \"".PASSWDFILE."\".\n",
	8	=>	"Sucesso em importar os usu�rios cadastrados.\n",
	9	=>	"Sem usu�rios cadastrados.\n",
	10	=>	"Criado com sucesso \"".ACCESSFILE."\".\n",
	12	=>	"Esta fun��o est� desativada\n",
	14	=>	"Seguran�a de senha desabilitada.\n",
	15	=>	"Voc� n�o selecionou o arquivo.\n",
	18	=>	"Envio do arquivo falhou.\n",

	16	=>	"Usu�rio \"",
	17	=>	"\" j� existe.\n",

	19	=>	"Deletando \"",
	20	=>	"\" no servidor falhou - por favor, remova manualmente.\n",

	11	=>	"Usu�rio adicionado com sucesso \"",
	13	=>	"Usu�rio deletado com sucesso \"",
	21	=>	"Senha do usu�rio alterada com sucesso \"",
	22	=>	"\".\n",

	100	=>	"Status :",
	101	=>	"Informa��o do Servidor e o caminho padr�o :",
	102	=>	"Usu�rios existentes :",
	103	=>	"Criar novo usu�rio :",
	104	=>	"Confirma��o :",
	105	=>	"Alterar Senha :",
	106	=>	"Usu�rio existente deletado :",
	107	=>	"Deletar todos usu�rios :",
	108	=>	"Servidor:",
	109	=>	"Caminho:",
	110	=>	"Importar usu�rios de um arquivo de texto :",
	112	=>	"[ formatar: usu�rio,senha ]",
	111	=>	"Arquivo :",
	
	200	=>	"Criar",
	201	=>	"Alterar",
	202	=>	"Deletar",
	203	=>	"Deletar todos",
	204	=>	"Importar",

	300	=>	"PHPAccess-Login",
	301	=>	"Nome de usu�rio",
	302	=>	"Senha",
	303	=>	"Entrar"

	);	//endarray

} elseif($languageselect == 4) { //Fran�ais by PM3 

$languagearray = array ( 

	1 => "Mot de passe vide non autoris�.\n", 
	2 => "utilisateur vide non autoris�.\n", 
	3 => "confirmation du mot de passe non valide.\n", 
	4 => "Utilisateur en lecture seule.\n", 
	5 => "Pas de fichier \"".PASSWDFILE."\" disponible.\n", 
	6 => "Pas de fichier \"".ACCESSFILE."\" disponible.\n", 
	7 => "Aucun utilisateur dans \"".PASSWDFILE."\".\n", 
	8 => "Utilisateurs import�s avec succ�s.\n", 
	9 => "Pas d'utilisateurs disponibles.\n", 
	10 => "Fichier \"".ACCESSFILE."\" cr�� avec succ�s.\n", 
	12 => "Cette fonction a �t� d�sactiv�e\n", 
	14 => "Password-safety d�sactiv�.\n", 
	15 => "Aucun fichier selectionn�.\n", 
	18 => "Probl�me d'upload.\n", 

	16 => "L'utilisateur \"", 
	17 => "\" existe d�j�.\n", 

	19 => "Effacement \"", 
	20 => "\" sur le serveur non-effectu� - Supprimer le fichier manuellement.\n", 

	11 => "Utilisateur ajout� avec succ�s \"", 
	13 => "Utilisateur supprim� avec succ�s \"", 
	21 => "Utilisateur mis � jour avec succ�s \"", 
	22 => "\".\n", 

	100 => "Status :", 
	101 => "Infos sur le serveur :", 
	102 => "Utilisateurs :", 
	103 => "Ajouter un utilisateur :", 
	104 => "Confirmation :", 
	105 => "Changer le mot de passe :", 
	106 => "Effacer un utilisateur :", 
	107 => "Effacer tous les utilisateurs :", 
	108 => "Serveur:", 
	109 => "Chemin:", 
	110 => "Importer depuis un fichier :", 
	112 => "[ format: user,pass ]", 
	111 => "Fichier :", 

	200 => "Cr��r", 
	201 => "Changer", 
	202 => "Effacer", 
	203 => "Tout effacer", 
	204 => "Importer", 

	300 => "PHPAccess-Login", 
	301 => "Login", 
	302 => "Mot de passe", 
	303 => "login" 

); //endarray

} elseif($languageselect == 5)  {		/* Italian Language Pack by Giuseppe Buttafuoco */
	
	$languagearray = array (

	1	=>	"&Egrave; necessario inserire 'pass'.\n",
	2	=>	"&Egrave; necessario inserire 'user'.\n",
	3	=>	"Password e conferma password non sono uguali.\n",
	4	=>	"Utente in sola lettura.\n",
	5	=>	"Nessun \"".PASSWDFILE."\"-file disponibile.\n",
	6	=>	"Nessun \"".ACCESSFILE."\"-file disponibile.\n",
	7	=>	"Nessun utente in \"".PASSWDFILE."\".\n",
	8	=>	"Utenti attuali importati con successo.\n",
	9	=>	"Nessun utente disponibile.\n",
	10	=>	"Creato con successo: \"".ACCESSFILE."\".\n",
	12	=>	"Questa funzione &egrave; stata disattivata\n",
	14	=>	"Password-sicurezza disabilitata.\n",
	15	=>	"Non hai selezionato il file.\n",
	18	=>	"Upload del file fallito.\n",

	16	=>	"Utente \"",
	17	=>	"\" gi&agrave; esistente.\n",

	19	=>	"Cancellazione \"",
	20	=>	"\" sul webserver fallita - rimuovere manualmente.\n",

	11	=>	"Utente aggiunto con successo \"",
	13	=>	"Utente cancellato con successo \"",
	21	=>	"Password aggiornata con successo \"",
	22	=>	"\".\n",

	100	=>	"Stato :",
	101	=>	"Server-info e posizione attuale :",
	102	=>	"Utenti attuali :",
	103	=>	"Crea un nuovo utente :",
	104	=>	"Conferma :",
	105	=>	"Modifica Password :",
	106	=>	"Cancella utente attuale :",
	107	=>	"Cancella tutti gli utenti :",
	108	=>	"Server:",
	109	=>	"Posizione:",
	110	=>	"Importa utenti da file di testo :",
	112	=>	"[ formato: user,pass ]",
	111	=>	"File :",
	
	200	=>	"Crea",
	201	=>	"Modifica",
	202	=>	"Cancella",
	203	=>	"Cancella tutti",
	204	=>	"Importa",

	300	=>	"PHPAccess-Login",
	301	=>	"Login-Name",
	302	=>	"Login-Pass",
	303	=>	"login"

	);	//endarray

} elseif($languageselect == 6) {	/* Spanish Language Pack by Jos� Luis Oliveros */

	$languagearray = array (

	1	=>	"Campo vac�o para 'pass' no es permitido.\n",
	2	=>	"Campo vac�o para 'user' no es permitido.\n",
	3	=>	"Contrase�a y Confirmaci�n no son iguales.\n",
	4	=>	"Usuario de solo lectura.\n",
	5	=>	"Archivo \"".PASSWDFILE."\"-no disponible.\n",
	6	=>	"Archivo \"".ACCESSFILE."\"-no disponible.\n",
	7	=>	"Sem lista de usu�rios internos \"".PASSWDFILE."\".\n",
	8	=>	"Usuarios importados satisfactoriamente.\n",
	9	=>	"Sin usu�rios creados.\n",
	10	=>	"Creado \"".ACCESSFILE."\" satisfactoriamente.\n",
	12	=>	"Esta funci�n est� desactivada\n",
	14	=>	"Seguridad de contrase�a deshabilitada.\n",
	15	=>	"No se ha selecionado ning�n archivo.\n",
	18	=>	"Env�o de archivo fall�.\n",

	16	=>	"Usu�rio \"",
	17	=>	"\" ya existe.\n",

	19	=>	"Borrado \"",
	20	=>	"\" en el servidor fall� - por favor, borre manualmente.\n",

	11	=>	"Usu�rio adicionado satisfactoriamente \"",
	13	=>	"Usu�rio borrado com satisfactoriamente \"",
	21	=>	"Contrase�a cambiada satisfactoriamente \"",
	22	=>	"\".\n",

	100	=>	"Estado :",
	101	=>	"Informaci�n de Servidor y o ruta :",
	102	=>	"Usuarios existentes :",
	103	=>	"Crear usu�rio nuevo :",
	104	=>	"Confirmaci�n :",
	105	=>	"Cambiar contrase�a :",
	106	=>	"Borrar usuario :",
	107	=>	"Borrar todos los usuarios :",
	108	=>	"Servidor:",
	109	=>	"Ruta:",
	110	=>	"Importar usu�rios de un archivo texto :",
	112	=>	"[ formato: usuario,contrase�a ]",
	111	=>	"Archivo :",
	
	200	=>	"Crear",
	201	=>	"Modificar",
	202	=>	"Borrar",
	203	=>	"Borrar todos",
	204	=>	"Importar",

	300	=>	"PHPAccess-Login",
	301	=>	"Usuario",
	302	=>	"Contrase�a",
	303	=>	"Entrar"

	);	//endarray

} elseif($languageselect == 7) {	/* Japanese Language Pack by Yui Sugawara */

	$languagearray = array (

	1	=>	"�ѥ���ɤ����Ϥ���Ƥ��ޤ���\n",
	2	=>	"�桼����̾�����Ϥ���Ƥ��ޤ���\n",
	3	=>	"�ѥ���ɤȳ�ǧ�ѥѥ���ɤ����פ��ޤ���\n",
	4	=>	"���Υ桼�������ɤ߼��ΤߤǤ���\n",
	5	=>	"���� \"".PASSWDFILE."\"-file �ϻ��ѤǤ��ޤ���\n",
	6	=>	"���� \"".ACCESSFILE."\"-file �ϻ��ѤǤ��ޤ���\n",
	7	=>	"\"".PASSWDFILE."\"�˥桼��������Ͽ����Ƥ��ޤ���\n",
	8	=>	"�桼����������˥���ݡ��Ȥ���ޤ�����\n",
	9	=>	"�������Ѳ�ǽ�ʥ桼�����Ϥ��ޤ���\n",
	10	=>	"\"".ACCESSFILE."\"��������ɲä���ޤ�����\n",
	12	=>	"���ε�ǽ��̵���ˤʤ�ޤ�����\n",
	14	=>	"�ѥ���ɤ������ǤϤ���ޤ���\n",
	15	=>	"�ե���������Ӳ�������\n",
	18	=>	"�ե�����Υ��åץ��ɤ˼��Ԥ��ޤ�����\n",

	16	=>	"�桼���� \"",
	17	=>	"\"������Ͽ����Ƥ��ޤ���\n",

	19	=>	"�õ�ޤ���\"",
	20	=>	"\" �����֥����С���Ǽ��Ԥ��ޤ����� - ��ư�Ǻ�����Ƥ���������\n",

	11	=>	"�桼��������Ͽ����λ���ޤ����� \"",
	13	=>	"�桼�����κ������λ���ޤ����� \"",
	21	=>	"���Υ桼�����Υѥ���ɹ�������λ���ޤ����� \"",
	22	=>	"\".\n",

	100	=>	"���ơ����� :",
	101	=>	"�����С����� �ȸ��ߤΥѥ� :",
	102	=>	"��¸�Υ桼���� :",
	103	=>	"�����桼���� :",
	104	=>	"�ѥ���ɳ�ǧ :",
	105	=>	"�ѥ���ɹ��� :",
	106	=>	"��¸�Υ桼�������� :",
	107	=>	"���ƤΥ桼�������� :",
	108	=>	"�����С�:",
	109	=>	"�ѥ�:",
	110	=>	"�ƥ����ȷ����Υ桼�����򥤥�ݡ��Ȥ��롣 :",
	112	=>	"[ �����: user,pass ]",
	111	=>	"�ե����� :",
	
	200	=>	"����",
	201	=>	"����",
	202	=>	"���",
	203	=>	"���ƺ��",
	204	=>	"����ݡ���",

	300	=>	"PHPAccess�إ�����",
	301	=>	"������̾",
	302	=>	"�ѥ����",
	303	=>	"������"

	);	//endarray

} elseif($languageselect == 8) {	/* Dutch Language Pack by Grossard Werner, http://www.bstart.be */

	$languagearray = array (

	1	=>	"Lege invoer voor 'pass' is niet toegelaten.\n",
	2	=>	"Lege invoer voor 'user' is niet toegelaten.\n",
	3	=>	"Wachtwoord en bevestiging zijn niet hetzelfde.\n",
	4	=>	"Deze gebruiker is Alleen-lezen.\n",
	5	=>	"Geen \"".PASSWDFILE."\"-bestand beschikbaar.\n",
	6	=>	"Geen \"".ACCESSFILE."\"-bestand beschikbaar.\n",
	7	=>	"Geen gebruiker lijst in \"".PASSWDFILE."\".\n",
	8	=>	"Succesvol huidige gebruikers ingevoerd.\n",
	9	=>	"Geen huidige gebruikers beschikbaar.\n",
	10	=>	"Succesvol \"".ACCESSFILE."\" aangemaakt.\n",
	12	=>	"Deze functie is uitgeschakeld\n",
	14	=>	"Wachtwoord beveiliging uitgeschakeld.\n",
	15	=>	"U hebt geen bestand geselecteerd.\n",
	18	=>	"Upload van bestand is mislukt.\n",

	16	=>	"Gberuiker \"",
	17	=>	"\" bestaat al.\n",

	19	=>	"Verwijderen \"",
	20	=>	"\" op de webserver mislukt - verwijder het manueel a.u.b.\n",

	11	=>	"Succesvol gebruiker toegevoegd \"",
	13	=>	"Succesvol gebruiker verwijderd \"",
	21	=>	"Succesvol gebruiker wachtwoord gewijzigd \"",
	22	=>	"\".\n",

	100	=>	"Status :",
	101	=>	"Server-info en huidig pad:",
	102	=>	"Bestaande Gebruikers :",
	103	=>	"Nieuwe gebruiker aanmaken :",
	104	=>	"Bevestiging :",
	105	=>	"Wijzig Wachtwoord:",
	106	=>	"Verwijder bestaande gebruikers :",
	107	=>	"Verwijder alle gebruikers :",
	108	=>	"Server:",
	109	=>	"Pad:",
	110	=>	"Gebruikers uit tekstbestand importeren :",
	112	=>	"[ formaat: gebruiker,wachtwoord ]",
	111	=>	"Bestand :",
	
	200	=>	"Aanmaken",
	201	=>	"Wijzigen",
	202	=>	"Verwijderen",
	203	=>	"Verwijder Alles",
	204	=>	"Importeren",

	300	=>	"PHPAccess-Inloggen",
	301	=>	"Login-Naam",
	302	=>	"Login-Wachtwoord",
	303	=>	"login"

	);	//endarray

} elseif($languageselect == 9) {	/* Arabic Language Pack by amry */

$languagearray = array (

	1 => "�� ���� ������ �� ��� �������� ��� ����� ��.\n",
	2 => "�� ���� �� ������ �� ��� ��� �������� ��� ����� ��.\n",
	3 => "����� ���� ���� ��� ������ �� ���� ���� ��������.\n",
	4 => "��� �������� ���� �� �� ������ ���.\n",
	5 => "�� ���� \"".PASSWDFILE."\"-��� �����.\n",
	6 => "������ \"".ACCESSFILE."\"-��� �����.\n",
	7 => "�� ���� ����� �������� ����� �� \"".PASSWDFILE."\".\n",
	8 => "�� ����� ������� ����� �� ����������.\n",
	9 => "�� ���� ����� �������� ��� ����.\n",
	10 => "�� ����� ����� \"".ACCESSFILE."\".\n",
	12 => "��� ������� �� ������� �� ��� ������ �����\n",
	14 => "������� ����� ���� ��� ����� �� �� ����.\n",
	15 => "�� ����� ��� ���.\n",
	18 => "��� �� ��� �����.\n",

	16 => "�������� \"",
	17 => "\" ���� ����� ��� ����� ������� ����� �����.\n",

	19 => "��� \"",
	20 => "\" ��� ��� �������� �� ��� ����� ����� ���� ����� �� �������.\n",

	11 => "�� ����� ����� �������� \"",
	13 => "�� ����� ��� ��� ��� �������� \"",
	21 => "�� ����� ���� ���� ���� ��������\"",
	22 => "\".\n",

	100 => "����� ������ :",
	101 => "������ ������� ������� ������� �� :",
	102 => "����� ���������� ������� :",
	103 => "����� ��� ������ ���� :",
	104 => "����� :",
	105 => "��� ���� ���� :",
	106 => "��� ����� ������� ������ :",
	107 => "��� ����� �� ���������� :",
	108 => "������� ����� ��:",
	109 => "������:",
	110 => "������ �� ��� ��� txt :",
	112 => "[ ����� �����: ��������,���� ���� ]",
	111 => "File :",

	200 => "�����",
	201 => "�����",
	202 => "���",
	203 => "��� ������",
	204 => "������� ������� �� ����� ��",

	300 => "PHPAccess-���� ����",
	301 => "��������",
	302 => "���� ����",
	303 => "���� ����"

	); //endarray

} elseif($languageselect == 10) {	/* Hungarian Language Pack by Andras Patyi */

	$languagearray = array (

	1	=>	"�res jelsz� nem enged�lyezett.\n",
	2	=>	"�res felhaszn�l�n�v nem enged�lyezett.\n",
	3	=>	"Jelsz� �s Ism�tl�se nem egyezik.\n",
	4	=>	"Csak olvashat� felaszn�l�.\n",
	5	=>	"\"".PASSWDFILE."\" f�jl nem tal�lhat�.\n",
	6	=>	"\"".ACCESSFILE."\" f�jl nem tal�lhat�.\n",
	7	=>	"Nincs felhaszn�l� a \"".PASSWDFILE."\" f�jlban.\n",
	8	=>	"Felhaszn�l�k import�lva.\n",
	9	=>	"Nincs aktu�lis felhaszn�l�.\n",
	10	=>	"\"".ACCESSFILE."\" l�trehozva.\n",
	12	=>	"Ez a funkci� kiiktatva\n",
	14	=>	"Biztons�gos jelsz� kikapcsolva.\n",
	15	=>	"Nem v�lasztott�l f�jlt.\n",
	18	=>	"F�jl felt�lt�se sikertelen.\n",

	16	=>	"Felhaszn�l� \"",
	17	=>	"\" m�r l�tezik.\n",

	19	=>	"T�rl�s \"",
	20	=>	"\" a szerveren sikertelen - t�vol�tsd el k�zzel.\n",

	11	=>	"Felhaszn�l� hozz�adva \"",
	13	=>	"Felhaszn�l� t�r�lve \"",
	21	=>	"Felhaszn�l� jelszava m�dos�tva \"",
	22	=>	"\".\n",

	100	=>	"�llapot :",
	101	=>	"Szerver-info �s aktu�lis el�r�si �t :",
	102	=>	"Felhaszn�l�k :",
	103	=>	"�j felhaszn�l� :",
	104	=>	"Jelsz� ism�t :",
	105	=>	"�j jelsz� :",
	106	=>	"Felhaszn�l� t�rl�se :",
	107	=>	"�sszes felhaszn�l� t�rl�se :",
	108	=>	"Szerver:",
	109	=>	"El�r�si �t:",
	110	=>	"Felhaszn�l�k import�l�sa sz�vegf�jlb�l :",
	112	=>	"[ form�tum: user,pass ]",
	111	=>	"F�jl :",
	
	200	=>	"K�sz�t",
	201	=>	"Ment",
	202	=>	"T�r�l",
	203	=>	"�sszeset t�rli",
	204	=>	"Import",

	300	=>	"PHPAccess - Bejelentkez�s",
	301	=>	"Bejelentkez�si n�v",
	302	=>	"Jelsz�",
	303	=>	"Bejelentkez�s"

	);	//endarray

} else  {		/* English Language Pack (=standard) */
	
	$languagearray = array (

	1	=>	"Empty input for 'pass' isn't allowed.\n",
	2	=>	"Empty input for 'user' isn't allowed.\n",
	3	=>	"Pass and confirmation aren't equal.\n",
	4	=>	"This user is read-only.\n",
	5	=>	"No \"".PASSWDFILE."\"-file available.\n",
	6	=>	"No \"".ACCESSFILE."\"-file available.\n",
	7	=>	"No user listed in \"".PASSWDFILE."\".\n",
	8	=>	"Successfully imported current users.\n",
	9	=>	"No current users available.\n",
	10	=>	"Successfully created \"".ACCESSFILE."\".\n",
	12	=>	"This function has been deactivated\n",
	14	=>	"Password-safety disabled.\n",
	15	=>	"You didn't select a file.\n",
	18	=>	"Upload of file failed.\n",

	16	=>	"User \"",
	17	=>	"\" already exists.\n",

	19	=>	"Deleting \"",
	20	=>	"\" on the webserver failed - please remove it manually.\n",

	11	=>	"Successfully added user \"",
	13	=>	"Successfully deleted user \"",
	21	=>	"Successfully updated pass of user \"",
	22	=>	"\".\n",

	100	=>	"Status :",
	101	=>	"Server-info and current path :",
	102	=>	"Existing users :",
	103	=>	"Create new user :",
	104	=>	"Confirmation :",
	105	=>	"Update Password :",
	106	=>	"Delete existing user :",
	107	=>	"Delete all users :",
	108	=>	"Server:",
	109	=>	"Path:",
	110	=>	"Import users from textfile :",
	112	=>	"[ format: user,pass ]",
	111	=>	"File :",
	
	200	=>	"Create",
	201	=>	"Update",
	202	=>	"Delete",
	203	=>	"Delete all",
	204	=>	"Import",

	300	=>	"PHPAccess-Login",
	301	=>	"Login-Name",
	302	=>	"Login-Pass",
	303	=>	"login"

	);	//endarray

} // endif


/*************/
/* VARIABLES */
/*************/

$status = "";

$existingusers = getusers($status);

$newusers = "";

$language_array[0] = "English";
$language_array[1] = "Deutsch";
$language_array[2] = "Traditional Chinese (BIG-5)";
$language_array[3] = "Brazilian Portuguese";
$language_array[4] = "French";
$language_array[5] = "Italian";
$language_array[6] = "Spanish";
$language_array[7] = "Japanese (EUC-JP)";
$language_array[8] = "Dutch";
$language_array[9] = "Arabic";
$language_array[10] = "Hungarian";

if (!isset($PHP_SELF)) { $PHP_SELF = $_SERVER['PHP_SELF']; }	/* if register_globals = Off (in php.ini) */

/********************/
/* FUNCTIONS        */
/********************/

function getusers(&$status, $changestatus=1) {

	global $languagearray;

	if (file_exists(PASSWDFILE)){	/* .htpasswd existiert im Verzeichnis */
		
		$fp = fopen(PASSWDFILE, "r");

		while ($zeile = fgets($fp, 4096)) {		/* htpasswd zeilenweise einlesen */

				ereg ("(.*)(:)(.*)", $zeile, $passelements);	/* Zeile in User, ":", Pass zerlegen */

				$singleuser = $passelements[1];
				$singlepass = $passelements[3];

				$users[] = array('user' => $singleuser, 'pass' => $singlepass);

		} //endwhile

		fclose ($fp);

		clearstatcache();

		if (file_exists(PASSWDFILE) and filesize(PASSWDFILE)<3) {	/* Passwortdatei < 3 Byte */

			if ($changestatus==1)
				$status .= $languagearray[7];

			disablepasses($status);

			return false;

		} //endif

		if ($changestatus==1)
			$status .= $languagearray[8];

		return $users;

	} else	{	/* htpasswd existiert NICHT im Verzeichnis */

		if ($changestatus==1) 
			$status .= $languagearray[9];

		return false;	/* FALSE, wenn keine .htpasswd-Datei */

	} //endif
	
	$useranz = count ($users);		/* Benutzer-Anzahl bestimmen */

	if ($useranz == 0) {

		if ($changestatus==1)
			$status .= $languagearray[7];

		return false;		/* FALSE, wenn keine Benutzer definiert */

	} //endif

} //EndOfFunction


function importcommaseparateddata($textfile, $textfile_name, &$status, &$newusers, $existingusers) {

	global $languagearray;

	if($textfile=="none" or $textfile=="") {	//No file selected

		$status .= $languagearray[15];
		
	} else {	/* File was selected correctly */
		
		if(move_uploaded_file ($textfile, "./".$textfile_name)==true) {			/* Upload okay */

			createhtaccess($status);		/* .htaccess anlegen */

			$textfilehandle = fopen ($textfile_name, "r");		/* open transferred textfile */

			while ($data = fgetcsv ($textfilehandle, 1000, ",")) {		/* read and parse commaseparated data */

				$newuser = $data[0];
				$newpass = $data[1];

				if (checkimports($newuser, $newpass, $status, $existingusers) == true) {		/* Importierte Daten pr�fen */

					adduser($newuser, $newpass, $status, $newusers);		/* Userinfo in $newusers ablegen */

				} //endif

			} //endwhile

			createhtpasswd($newusers, $status, $existingusers); /* user in .htpasswd eintragen */

			fclose ($textfilehandle);

			if(unlink($textfile_name)==false ) {

				$status .= $languagearray[19].$textfile_name.$languagearray[20];
				
			} //endif

			
		} else {

			$status .= $languagearray[18];

		} //endif


	} //endif

} //EndOfFunction


function checkupdates($updatepass, $updatepass2, &$status)
{

	global $languagearray;

	if ($updatepass == ""){

		$status .= $languagearray[1];

		return false; 
		
	} //endif

	if ($updatepass2 != $updatepass) {											/* Passwortbest�tigung scheitert */

		$status .= $languagearray[3];

		return false; 

	} //endif
	
	return true;

} //EndOfFunction


function checkimports($newuser, $newpass, &$status, $existingusers)
{

	global $languagearray;

	$users = $existingusers;

	if ($newuser == "") {		/* kein Benutzer eingegeben */
		
		$status .= $languagearray[2];

		return false; 
		
	} //endif

	if ($newpass == "") {		/* kein Passwort eingegeben */

		$status .= $languagearray[1];
		
		return false; 
		
	} //endif

	if(is_array($users)) {

		while (list($key, $singleuser) = each($users)) {

			if ($singleuser['user'] == $newuser){									/* Benutzer schon vorhanden */

				$status .= $languagearray[16].$newuser.$languagearray[17];
			
				return false;

			} //endif

		} //endwhile
		
	} //endif

	return true;

} //EndOfFunction


function checkinputs($newuser, $newpass, $newpass2, &$status, &$existingusers)	/* Benutzereingaben pr�fen */
{

	global $languagearray;

	$users = $existingusers;

	if ($newuser == "") {		/* kein Benutzer eingegeben */
		
		$status .= $languagearray[2];

		return false; 
		
	} //endif

	if ($newpass == "") {		/* kein Passwort eingegeben */

		$status .= $languagearray[1];
		
		return false; 
		
	} //endif

	if ($newpass2 != $newpass) {		/* Passwortbest�tigung scheitert */

		$status .= $languagearray[3];

		return false; 

	} //endif

	if (is_array($users))
	{

		while (list($key, $singleuser) = each($users)) {

			if ($singleuser['user'] == $newuser){		/* Benutzer schon vorhanden */

				$status .= $languagearray[16].$newuser.$languagearray[17];
			
				return false;

			} //endif

		} //endwhile

	} //endif
	
	return true;

} //EndOfFunction


function checkfiles(&$status)
{

	global $languagearray;

	if (!file_exists(PASSWDFILE)){	/* .htpasswd existiert nicht */

		$status .= $languagearray[5];

	} //endif
	
	if (!file_exists(ACCESSFILE)){	/* .htaccess existiert nicht */

		$status .= $languagearray[6];

	} //endif

	if (file_exists(PASSWDFILE) and filesize(PASSWDFILE)<3) { /* .htpasswd < 3 Byte */

			$status .= $languagearray[7];
			
			disablepasses($status);

	} //endif

} //EndOfFunction


function getpath(&$status)
{

	global $languagearray;

	$rawpath = getcwd();

	$path = strtr($rawpath, "\\", "/");

	return $path;

} //EndOfFunction


function parsepathforoutput($path) {

	$path = str_replace ("/", " / ", $path);

	return $path;
	
} //EndOfFunction


function createhtaccess(&$status) {

	global $languagearray;
	
	if (!file_exists(ACCESSFILE)){		/* .htaccess existiert nicht, muss angelegt werden */

		$path = getpath($status);
		$htaccess = "AuthName \"".AUTHNAME."\"\n";
		$htaccess.= "AuthType Basic\n";
		$htaccess.= "AuthUserFile ".PASSWDFILE."\n"; // ORG: $htaccess.= "AuthUserFile ".$path."/".PASSWDFILE."\n";
		$htaccess.= "require valid-user";

		$filehandle = fopen(ACCESSFILE, "w");

		fputs($filehandle, $htaccess);

		fclose($filehandle);

		$status .= $languagearray[10];

	} //endif

} //EndOfFunction


function createhtpasswd(&$newusers, &$status, &$existingusers) {

	global $languagearrray;

	$filehandle = fopen(PASSWDFILE, "a");

	fputs ($filehandle, $newusers);

	fclose($filehandle);

	$existingusers = getusers($status, 1);

} //EndOfFunction


function cryptpass($user, $newpass) {

	if(USEHTPASSWDEXE == true) {
		$command = HTPASSWDEXELOC." -nbm ".$user." ".$newpass;
		return (exec($command));
	}
	else {
		return ($user.":".crypt($newpass));
	}
}


function adduser($user, $pass, &$status, &$newusers) {

	global $languagearray;

	$cryptedpass = cryptpass($user, $pass);

	$newline = $cryptedpass."\n";

	$newusers .= $newline;

	$status .= $languagearray[11].$user.$languagearray[22];

} //EndOfFunction


function updatepass($user2update, $newpass, &$status, &$existingusers) {

	global $languagearray;

	$pwfilecontent = "";

	$users = $existingusers;

	$filehandle = fopen(PASSWDFILE, "w");	/* Passwortdatei �ffnen */

	while (list($key, $singleuser) = each($users)){

		if ($singleuser['user'] != $user2update) {		/* Pass dieses Benutzers soll nicht ge�ndert werden */

			$pwfilecontent .= $singleuser['user'].":".$singleuser['pass'];

		} else {		/* Pass des aktuellen Benutzers soll ge�ndert werden */
		
			$cryptedpass = cryptpass($user2update, $newpass);
      
      clearstatcache();
      
			$pwfilecontent .= $cryptedpass."\n";		/* neues PW eintragen (!!vor cryptpass $singleuser['user'].":". rausgenommen, wegen doppeltdarstellung vom benutzernamen)*/
      
      clearstatcache();
      
		} //endif

	} //endwhile

	fputs ($filehandle, $pwfilecontent);

	fclose($filehandle);

	$status .= $languagearray[21].$user2update.$languagearray[22];

} //EndOfFunction


function deleteuser($user2delete, &$status, &$existingusers)
{

	global $languagearray;

	$users = $existingusers;

	$filehandle = fopen(PASSWDFILE, "w");		/* Passwortdatei �ffnen */

	$pwfilecontent = "";

	if (isset($users) && is_array($users) && count($users) > 0) {

		while (list($key, $singleuser) = each($users)){

			if ($singleuser['user'] != $user2delete) {		/* User soll nicht gel�scht werden */

				$pwfilecontent .= $singleuser['user'].":".$singleuser['pass'];

			} //endif

		} //endwhile

	}

	fputs ($filehandle, $pwfilecontent);

	fclose($filehandle);

	$status .= $languagearray[13].$user2delete.$languagearray[22];

} //EndOfFunction


function printuserscombobox($boxname, $cssclass, $width, &$existingusers) {
	
	global $status;

	$users = $existingusers;

	echo "<select name='$boxname' size='1' class='$cssclass' width='$width'>";

	while(list(,$singleuser) = each($users)) {
	    
	    print ("<option value='".$singleuser['user']."'>".$singleuser['user']."</option>");

	} //endwhile

	echo "</select>";

} //EndOfFunction


function printoptionbox($boxname, $cssclass, $elementsarray, $kataktiv=1) {

	echo "<select name='$boxname' class='$cssclass'>";

	while (list($key,$value) = each($elementsarray)) {
	
		if ($key == $kataktiv) {				/* Kategorie ist aktiv */

			$SELECTED = ' selected="selected"';
			
		} else {

			$SELECTED = "";

		} //endif
		
		echo "<option value='$key'$SELECTED>$value</option>";
		
	} //endwhile

	echo "</select>";
	
} //EndOfFunction


function disablepasses(&$status)
{

	global $languagearray;

	if (file_exists(ACCESSFILE)) { 
		
		chmod (ACCESSFILE, 0777);
		clearstatcache();
		unlink(ACCESSFILE); 

	} //endif

	if (file_exists(PASSWDFILE)) { 

		chmod (PASSWDFILE, 0777);
		clearstatcache();
		unlink(PASSWDFILE); 

	} //endif

	$status .= $languagearray[14];

} //EndOfFunction

?>

<style type="text/css">
<!--

.arial2bold { font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #000000 }
.arial12 { font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; color: #000000; padding: 2px 0px;}
.inputwidth150 { font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; color: #000000 ; width: 150px; border : 1px solid black}
.arial12weiss { font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; color: #ffffff; font-style: normal; text-decoration: none; padding: 2px 5px;}

.languageselect {
	font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: normal; color: #000000; width: 205px; border: 1px solid  black; background-color: #ffffff;
}

.inputwidth200 { 
	font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; color: #000000 ; width: 200px; border : 1px solid black; 
  background: none; background-color: #ffffff;
  
}

.inputwidth300 {
	font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; color: #000000 ; width: 670px !important; border : 1px solid black;
  padding: 4px;
}

.submitbutton { 
	font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; background-color: #999999; color : white; border : 1px solid black; width: 80px
}
.arial10weiss { font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: normal; color: #333333;}
.arial2boldweiss { font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #333333}

-->
</style>
<script type="text/JavaScript">
/* <![CDATA[ */
	/*function InputKeypress() {
		if ("13" == window.event.keyCode) return false;
	}
	*/
/* ]]> */
</script>


<?php

/**********************/
/* ADMIN-LOGIN        */
/**********************/

// for newer versions of PHP:
if(!isset($HTTP_POST_VARS))
	$HTTP_POST_VARS = $_POST;

if (isset($HTTP_POST_VARS['loginname'])) { $loginname = $HTTP_POST_VARS['loginname']; }
if (isset($HTTP_POST_VARS['loginpass'])) { $loginpass = $HTTP_POST_VARS['loginpass']; }

$logok = true; //False damit kein login ben�tigt wird <-----------------------------------------------------------------*****************

if(isset($loginname) and isset($loginpass)) {

	if(($loginname == $adminloginname) and ($loginpass == $adminloginpass)) {

		$logok = true;
				
	} //endif
	
} //endif

if($logok == false) {

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" align="center"> 
			<form name="adminlogin" method="post" action="?site=advancedsetup_phpaccess" id="userSetupLoginForm" onsubmit="requestSite('<?php echo $_SERVER['PHP_SELF']; ?>','','userSetupLoginForm');return false;">
			 
			 <div><input type="hidden" name="" value="true" id="hiddenSubmit" /></div><!-- ajax hack: hand over the submit buttom name for the ajax -->
			
				<table border="0" cellspacing="0" cellpadding="6" align="center" bgcolor="#999999">
					<tr> 
						<td> 
							<table border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="#FFFFFF">
								<tr> 
									<td style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; color: #FFFFFF" bgcolor="#666666" align="center"> 
										<?php echo $languagearray[300]; ?>
									</td>
								</tr>
								<tr> 
									<td height="20" bgcolor="#999999" class="arial10weiss">&nbsp;</td>
								</tr>
								<tr> 
									<td height="20" bgcolor="#999999" class="arial10weiss">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr> 
												<td class="arial10weiss" width="60">Language:</td>
												<td class="arial10weiss" width="210"><?php printoptionbox("languageselect", "languageselect", $language_array, $kataktiv=$languageselect); ?></td>
												<td class="arial10weiss" align="right" width="30"> 
													<input type="submit" name="languageselectsubmit" value="OK" style= "width: 30px; font-size:10px" class="buttons" onclick="document.getElementById('hiddenSubmit').name = 'languageselectsubmit';" /><!-- ajax hack: hand over the submit buttom name for the ajax -->
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr> 
									<td height="20" bgcolor="#999999" class="arial10weiss">&nbsp;</td>
								</tr>
								<tr> 
									<td height="20"> 
										<table width="100%" border="0" cellspacing="0" cellpadding="2">
											<tr> 
												<td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000" bgcolor="#CCCCCC" valign="middle"> 
													<?php echo $languagearray[301]; ?>
												</td>
												<td class="arial2boldweiss" bgcolor="#CCCCCC" valign="middle" align="right"> 
													<input type="text" name="loginname" class="inputwidth150" />
												</td>
											</tr>
											<tr> 
												<td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000" bgcolor="#CCCCCC" valign="middle"> 
													<?php echo $languagearray[302]; ?>
												</td>
												<td class="arial12" bgcolor="#CCCCCC" valign="middle" align="right"> 
													<input type="password" name="loginpass" class="inputwidth150" />
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr> 
									<td height="20" bgcolor="#999999" align="right"> 
										<input type="submit" name="loginsubmit" value="<?php echo $languagearray[303]; ?>" size="20" class="buttons" onclick="document.getElementById('hiddenSubmit').name = 'loginsubmit';" /><!-- ajax hack: hand over the submit buttom name for the ajax -->
									</td>
								</tr>
								<tr> 
									<td class="arial12weiss" bgcolor="#999999" align="center" valign="bottom" height="30"> 
										<table width="100%" border="0" cellspacing="0" cellpadding="2" height="15">
											<tr> 
												<td class="arial12weiss" align="center" bgcolor="#666666">[LMS]
													by <a href="http://sc02.funpic.de/" class="arial12weiss" style="text-decoration: underline">sc02</a></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>

<?php
	
} //endif

if($logok==true) :
	
/************************/
/* PROGRAMMABLAUF       */
/************************/

if (isset($HTTP_POST_VARS['importtextfilesubmit'])) {		/* Schaltfl�che IMPORT wurde aktiviert */

	importcommaseparateddata($HTTP_POST_FILES['textfile']['tmp_name'], $HTTP_POST_FILES['textfile']['name'], $status, $newusers, $existingusers);

} //endif


if (isset($HTTP_POST_VARS['delusersubmit'])) {	/* Schaltfl�che DELETE wurde gedr�ckt */

	if (isset($readonlyusers) and is_array($readonlyusers) and in_array($HTTP_POST_VARS['delusroptionbox'], $readonlyusers)) {
	
		$status .= $languagearray[4];
	
	} else {

		deleteuser($HTTP_POST_VARS['delusroptionbox'],$status, $existingusers);

	} //endif

} //endif


if (isset($HTTP_POST_VARS['updatepasssubmit'])) {		/* Schaltfl�che UPDATE wurde gedr�ckt */

	if (isset($readonlyusers) and is_array($readonlyusers) and in_array($HTTP_POST_VARS['updatepassoptionbox'], $readonlyusers)) {
	
		$status .= $languagearray[4];
	
	} else {	//Benutzer ist NICHT schreibgesch�tzt
		
			if (checkupdates($HTTP_POST_VARS['updatepass'],$HTTP_POST_VARS['updatepass2'],$status) == true) {		/* Benutzereingaben pr�fen */

				updatepass($HTTP_POST_VARS['updatepassoptionbox'], $HTTP_POST_VARS['updatepass'], $status, $existingusers);

			} //endif

	} //endif
		
} //endif


if (isset($HTTP_POST_VARS['newpasssubmit'])) {		/* Schaltfl�che CREATE wurde gedr�ckt */
	
	if (checkinputs($HTTP_POST_VARS['newuser'],$HTTP_POST_VARS['newpass'],$HTTP_POST_VARS['newpass2'],$status, $existingusers) == true) {		/* Benutzereingaben pr�fen */

		createhtaccess($status);		/* .htaccess anlegen */

		adduser($HTTP_POST_VARS['newuser'],$HTTP_POST_VARS['newpass'], $status, $newusers);	/* Userinfo in $newusers ablegen */

		createhtpasswd($newusers, $status, $existingusers); /* user in .htpasswd eintragen */

	} //endif

} //endif


if (isset($HTTP_POST_VARS['disablepassessubmit'])) {		/* Schaltfl�che DISABLE wurde gedr�ckt */
		
	if($disable['deleteall'] != 1) {	/* deleteall ist NICHT deaktiviert */
		
		disablepasses($status);		/* ht...-files l�schen */

		$existingusers = getusers($status);

	} //endif

} //endif


if (isset($existingusers) and is_array($existingusers) and count($existingusers)>0) {/* Benutzer sind vorhanden */
	
	$currentusers = true;		/* Benutzer vorhanden */
	
} else { 

	$currentusers = false;		/* Keine Benutzer vorhanden */

} //endif

checkfiles($status);		/* Existenz von ht...-files pr�fen */
@$existingusers = getusers($status,0);

/****************************/
/* Graphical User Interface */
/****************************/


require_once(dirname(__FILE__).'/../backend.include.php');

// didnt show the Setup for non-adminstrators
if(userIsAdmin()) {

?>

<form enctype="multipart/form-data" method="post" action="?site=userSetup" id="userSetupForm" onsubmit="requestSite('<?php echo $_SERVER['PHP_SELF']; ?>','','userSetupForm');return false;">
  
  <input type="hidden" name="" value="true" id="hiddenSubmit" /><!-- ajax hack: hand over the submit buttom name for the ajax -->
  
  <h1>Login Management System [LMS]	<?php echo SCRIPTVERSION; ?></h1>
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center" valign="top"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="6" align="center">
          <tr> 
            <td> 
              	<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
								<tr> 
									<td height="0">
										<input type="hidden" name="loginname" value="<?php echo($loginname); ?>" />
										<input type="hidden" name="loginpass" value="<?php echo($loginpass); ?>" />
									</td>
								</tr>
								<tr style="display: none;"> 
									<td height="20"> 
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr> 
												<td class="arial10weiss" width="60">Language:</td>
												<td class="arial10weiss" width="210">
													<?php printoptionbox("languageselect", "languageselect", $language_array, $kataktiv=$languageselect); ?>
												</td>
												<td class="arial10weiss" align="left"> 
													<input type="submit" name="languageselectsubmit2" value="OK" style= "width: 30px; font-size:10px" class="buttons" onclick="document.getElementById('hiddenSubmit').name = 'languageselectsubmit2';" /><!-- ajax hack: hand over the submit buttom name for the ajax -->
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr> 
									<td height="20">&nbsp; </td>
								</tr>
								<tr> 
									<td height="20"> 
										<table width="100%" border="0" cellspacing="0" cellpadding="2">
											<tr> 
												<td class="arial12weiss" valign="middle" align="left" bgcolor="#999999"> 
													<?php echo $languagearray[100]; ?>
												</td>
											</tr>
											<tr> 
												<td class="arial12" valign="middle" align="center"> 
													<textarea name="statusbox" rows="4" cols="80" readonly="readonly" class="inputwidth300" style="color:#000000;"><?php echo trim($status); ?></textarea>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr> 
									<td height="20">&nbsp;</td>
								</tr>
								<tr> 
									<td class="arial2bold"> 
										<table width="100%" border="0" cellspacing="0" cellpadding="2">
											<tr> 
												<td class="arial12weiss" bgcolor="#999999" valign="middle" align="left"> 
													<?php echo $languagearray[101]; ?>
												</td>
											</tr>
											<tr> 
												<td class="arial12" valign="middle"> 
													<table width="100%" border="0" cellspacing="2" cellpadding="0">
														<tr align="left" valign="top"> 
															<td class="arial12" width="75" align="left"> 
																<?php echo $languagearray[108]; ?>
															</td>
															<td class="arial12"> 
																<?php echo SERVERNAME; ?>
															</td>
														</tr>
														<tr align="left" valign="top"> 
															<td class="arial12"> 
																<?php echo $languagearray[109]; ?>
															</td>
															<td class="arial12"> 
																<?php echo parsepathforoutput(getpath($status)); ?>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr> 
									<td class="arial2bold" width="20">&nbsp;</td>
								</tr>
								<?php

if ( $currentusers == true ) {		/* User sind vorhanden */

?>
								<tr> 
									<td class="arial2bold"> 
										<table width="100%" border="0" cellspacing="0" cellpadding="2" name="currentuserstable">
											<tr> 
												<td class="arial12weiss" bgcolor="#999999" valign="middle" align="left"> 
													<?php echo $languagearray[102]; ?>
												</td>
											</tr>
											<tr> 
												<td class="arial12" valign="middle" align="center"> 
													<?php

					$useranz = count($existingusers);

					if ($useranz<=4) {

						$textareaheight = $useranz + 1;

					} else {

						$textareaheight = 4;

					}

					$textareauserlist = "";

					if (isset($existingusers) && is_array($existingusers) && count($existingusers) > 0) {

						while (list($key, $singleuser) = each($existingusers)) {
						
						$textareauserlist .= $singleuser['user']."\n";

						} //endwhile

					}

					$textareauserlist = trim($textareauserlist);		/* Spaces am Ende entfernen */

?>
													<textarea name="userbox" readonly="readonly" rows="<?php echo $textareaheight; ?>"  cols="80" class="inputwidth300"><?php echo $textareauserlist; ?></textarea>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr> 
									<td class="arial2bold" >&nbsp;</td>
								</tr>
								<?php

} // endif

?>
								<tr> 
									<td class="arial2bold"> 
										<table width="100%" border="0" cellspacing="0" cellpadding="2">
											<tr bgcolor="#999999" valign="middle"> 
												<td class="arial12weiss" align="left"> 
													<?php echo $languagearray[103]; ?>
												</td>
												<td class="arial2boldweiss">&nbsp; </td>
											</tr>
											<tr valign="middle" align="left"> 
												<td class="arial2bold" width="250">user </td>
												<td class="arial2bold">pass </td>
											</tr>
											<tr valign="middle"> 
												<td class="arial12" align="left"> 
													<input type="text" name="newuser" value="user" class="inputwidth150" size="20" />
												</td>
												<td class="arial12" align="left"> 
													<input type="password" name="newpass" class="inputwidth150" size="20" />
												</td>
											</tr>
											<tr valign="middle"> 
												<td class="arial12" align="right"> 
													<?php echo $languagearray[104]; ?>
												</td>
												<td class="arial12" align="left"> 
													<input type="password" name="newpass2" class="inputwidth150" size="20" />
												</td>
											</tr>
											<tr valign="middle"> 
												<td>&nbsp;</td>
												<td align="left" class="arial12"> 
													<input type="submit" name="newpasssubmit" value="<?php echo $languagearray[200]; ?>" size="20" class="buttons" onclick="document.getElementById('hiddenSubmit').name = 'newpasssubmit';" /><!-- ajax hack: hand over the submit buttom name for the ajax -->
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<?php
	
if ( $currentusers == true ) {		/* User sind vorhanden */

?>
								<tr> 
									<td class="arial12" height="20"> 
										<table width="100%" border="0" cellspacing="0" cellpadding="2" name="newusertable">
											<tr bgcolor="#999999" valign="middle"> 
												<td class="arial12weiss" align="left"> 
													<?php echo $languagearray[105]; ?>
												</td>
												<td class="arial2boldweiss">&nbsp; </td>
											</tr>
											<tr valign="middle" align="left"> 
												<td class="arial2bold" width="250">user </td>
												<td class="arial2bold">pass </td>
											</tr>
											<tr valign="middle"> 
												<td class="arial12" align="left"> 
													<?php printuserscombobox("updatepassoptionbox", "inputwidth150", 150, $existingusers); ?>
												</td>
												<td class="arial12"  align="left"> 
													<input type="password" name="updatepass" class="inputwidth150" />
												</td>
											</tr>
											<tr valign="middle"> 
												<td class="arial12" align="right"> 
													<?php echo $languagearray[104]; ?>
												</td>
												<td class="arial12"  align="left"> 
													<input type="password" name="updatepass2" class="inputwidth150" />
												</td>
											</tr>
											<tr valign="middle"> 
												<td class="arial12">&nbsp;</td>
												<td align="left" class="arial12"> 
													<input type="submit" name="updatepasssubmit" value="<?php echo $languagearray[201]; ?>" size="20" class="buttons" onclick="document.getElementById('hiddenSubmit').name = 'updatepasssubmit';" /><!-- ajax hack: hand over the submit buttom name for the ajax -->
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<?php

} //endif


if ( $currentusers == true ) {		/* User sind vorhanden */

?>
								<tr> 
									<td class="arial12"> 
										<table width="100%" border="0" cellspacing="0" cellpadding="2" name="deleteusertable">
											<tr bgcolor="#999999" valign="middle"> 
												<td class="arial12weiss"> 
													<?php echo $languagearray[106]; ?>
												</td>
												<td class="arial2boldweiss">&nbsp;</td>
											</tr>
											<tr valign="middle"> 
												<td class="arial12" align="left" width="210"> 
													<?php printuserscombobox("delusroptionbox", "inputwidth200", 200, $existingusers); ?>
												</td>
												<td class="arial12" align="left"> 
													<input type="submit" name="delusersubmit" value="<?php echo $languagearray[202]; ?>" size="20" class="buttons" onclick="document.getElementById('hiddenSubmit').name = 'delusersubmit';" /><!-- ajax hack: hand over the submit buttom name for the ajax -->
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<?php

} //endif

?>
								<tr> 
									<td class="arial12" height="20">&nbsp;</td>
								</tr>
								<?php

if($disable['fileimportuser'] != 1) {
	
?>
								<tr> 
									<td class="arial2bold"> 
										<table width="100%" border="0" cellspacing="0" cellpadding="2">
											<tr valign="middle" bgcolor="#999999"> 
												<td class="arial12weiss"> 
													<?php echo $languagearray[110]; ?>
												</td>
												<td class="arial2boldweiss" align="right">&nbsp; 
												</td>
											</tr>
										</table>
										<table width="100%" border="0" cellspacing="0" cellpadding="2">
											<tr valign="middle"> 
												<td class="arial12" align="center"> 
													<input name="textfile" type="file" class="arial12" style="width: 305px; border : 1px solid black;" />
												</td>
											</tr>
											<tr valign="middle"> 
												<td class="arial2boldweiss" align="right"> 
													<input type="submit" name="importtextfilesubmit" value="<?php echo $languagearray[204]; ?>" size="20" class="buttons" onclick="document.getElementById('hiddenSubmit').name = 'importtextfilesubmit';" /><!-- ajax hack: hand over the submit buttom name for the ajax -->
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<?php
} //endif

if($disable['deleteall'] != 1) {
	
?>
								<tr> 
									<td class="arial12" height="20" bgcolor="#CCCCCC">&nbsp;</td>
								</tr>
								<tr> 
									<td class="arial2bold"> 
										<table width="100%" border="0" cellspacing="0" cellpadding="2">
											<tr valign="middle" bgcolor="#999999"> 
												<td class="arial12weiss"> 
													<?php echo $languagearray[107]; ?>
												</td>
												<td class="arial2boldweiss" align="right"> 
													<input type="submit" name="disablepassessubmit" value="<?php echo $languagearray[203]; ?>" size="20" class="buttons" onclick="document.getElementById('hiddenSubmit').name = 'disablepassessubmit';" /><!-- ajax hack: hand over the submit buttom name for the ajax -->
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<?php

} //endif

?>
								<tr> 
									<td class="arial12weiss" style="color:#999999;" align="center" valign="bottom"> 
										Login Management System [LMS] by <a href="http://sc02.funpic.de">sc02</a>
									</td>
								</tr>
							</table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  </form>

<?php

    }

  endif;


?>