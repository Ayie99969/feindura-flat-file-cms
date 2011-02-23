MooTools FileManager - Copyright (c) 2009 [Christoph Pojer](http://og5.net/christoph)
=====================================================================================

A filemanager for the web based on MooTools that allows you to (pre)view, upload and modify files and folders via your browser.

![Screenshot](https://github.com/frozeman/mootools-filemanager/raw/master/screenshot.png)

### Version
  1.3.3rc4

### Author
 [Christoph Pojer](http://og5.net/christoph)

### Features

* Browse through Files and Folders on your Server
* Rename, Delete, Move (Drag&Drop), Copy (Drag + hold CTRL) and Download Files
* View detailed Previews of Images, Text-Files, Compressed-Files or Audio Content
* Nice User Interface ;)
* Upload Files via FancyUpload (integrated Feature)
* Option to automatically resize big Images when uploading
* Use it to select a File anywhere you need to specify one inside your Application's Backend
* Use as a FileManager in TinyMCE or CKEditor
* Provides your client with the most possible convenience ( ;D )
* Create galleries using the Gallery-Plugin
* History (youre able to use the forward and back button of your browser)

### Issues!
  - sometime "illegal character (Error #2038) mootools-core-1.3.js (line 5015)" when uploading multiple files

How to use
----------

### Demos

* Open the "Demos/" folder and have fun
* To test TinyMCE Download and extract it to "Demos/TinyMCE" and access "Demos/tinymce.html"
* Demo of 1.0rc2 (old): http://cpojer.net/Scripts/FileManager/Demos/

### Configurable Options

* See Source/FileManager.js and Backend/FileManager.php for all available options on the client- and server-side

### Installation

* First you need to include the follwing scripts
** Source/FileManager.js
** Source/Uploader/Fx.ProgressBar.js
** Source/Uploader/Swiff.Uploader.js
** Source/Uploader.js
** Source/Gallery.js (if you want to create a gallery, see example in the Demos/index.html)
** Language/Language.en.js (or which language(s) do you need)

* Then you need do modify the "Demos/manager.php" or "Demos/selectImage.php" to set up your upload folder etc
* See the "Demos/index.html" for examples, but basically you need to do the following:

  var myFileManager = new FileManager({
    url: 'manager.php',
    assetBasePath: '../Assets'
  });
  myFileManager.show.bind(myFileManager);


### Custom Authentication

* As Flash and therefore the Uploader ignores authenticated clients you need to specify your own authentication. In order to do this you need to provide a custom "UploadIsAuthenticated" function on the serverside and you need to specify "uploadAuthData" on the client.


### Changes
 - [James Ehly](http://www.devtrench.com)
    - thumbnail list
 - [Fabian Vogelsteller](http://frozeman.de)
    - extended thumbnails
    - now absolute and relative paths are possible
    - add clickable and selectable path in the header
    - add hiding of the thumbnail directory
    - a lot of bugfixes
    - add .htaccess to allow upload and resize of big files
    - made interface changes
    - add SqueezeBox for preview of the images
    - add keyboard navigation in the file browser
    - ported to mootools 1.3
    - add error dialogs for php errors
