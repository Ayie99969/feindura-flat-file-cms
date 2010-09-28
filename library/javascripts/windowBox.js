/*
    feindura - Flat File Content Management System
    Copyright (C) Fabian Vogelsteller [frozeman.de]

    This program is free software;
    you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
    without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along with this program;
    if not,see <http://www.gnu.org/licenses/>.
*/
// java/windowBox.js version 0.39 (requires mootools-core and mootools-more)

// vars
var loadingText;
var uploadAnimationElement = null;

/* ---------------------------------------------------------------------------------- */
// dimms the background and calls: requestSite(site,siteTitle);
function openWindowBox(site,siteTitle,fixed) {
    
  $('dimmContainer').setStyle('opacity','0');
  $('dimmContainer').setStyle('display','block');
  
  var fadeBg = new Fx.Tween($('dimmContainer'), {duration: 200, transition: Fx.Transitions.Sine.easeOut});
  fadeBg.start('opacity', '0.5');
  
  loadingText = $$('#windowBox .boxTop').get('html');
  
  fadeBg.onComplete = function(e){
    if(site) {
      
      // if fixed is true, than the window positon is relative,
      // means its fixed in the document, and NOT scrolling with the user
      if(fixed || navigator.appVersion.match(/MSIE ([0-6]\.\d)/)) {
        $('windowBox').setStyle('position','relative');
      } else {
        $('windowBox').setStyle('position','fixed');
      }
      
      // set the display to block
      $('windowBoxContainer').fade('show');
      //$('#windowBoxContainer').setStyle('visibility','visible');
      
      // set the fade
      $('windowBox').set('opacity','0');  			
      $('windowBox').tween('opacity','1');
		  $('windowRequestBox').slide('show');
		  

      // IE HACK, wont bring the bottom div to the top
			if(navigator.appVersion.match(/MSIE ([0-6]\.\d)/)) {
			   $$('#windowBox .boxBottom')[0].setStyle('top','68px');
			}
      
			// send HTML request
      requestSite(site,siteTitle);
		}
	}    
}

/* ---------------------------------------------------------------------------------- */
// fades all windows out and set windowBoxContainer to display:none;
// and remove alle Events from dimmContainer, windowBox, windowRequestBox
function closeWindowBox(redirectAfter) {
      
	// resize the box by a slide
	$('windowRequestBox').set('slide', {duration: '250', transition: Fx.Transitions.Pow.easeIn});
	$('windowBox').set('fade', {duration: '100', transition: Fx.Transitions.Pow.easeOut});
	$('dimmContainer').set('fade', {duration: '100', transition: Fx.Transitions.Pow.easeOut});
	
	// IE HACK, wont bring the bottom div to the top
	if(navigator.appVersion.match(/MSIE ([0-6]\.\d)/)) {
		$$('#windowBox .boxBottom')[0].set('tween',{duration: '250', transition: Fx.Transitions.Pow.easeIn});
		$$('#windowBox .boxBottom')[0].tween('top','0px');
	}
	
	$('windowRequestBox').get('slide').addEvent('complete', function(e) {
			// set the html inside the windowRequestBox div back.
			$('windowRequestBox').set('html', '');
			$('windowRequestBox').setStyle('height', 'auto');
			
			// fades the windowBox
			$('windowBox').tween('opacity','0');
			// fades the dimmContainer
      $('dimmContainer').tween('opacity','0');
			
			this.removeEvents();
    }); 
	
	// slides the windowRequestBox out
	$('windowRequestBox').slide('out');

  
  // fades the windowBox
  $('windowBox').get('tween').addEvent('complete', function(e) {
        // set the display of the windowBoxContainerto none;
       $('windowBoxContainer').fade('hide');
        
        this.removeEvents();
    });
    
  // fades the dimmContainer // last effect
  $('dimmContainer').get('tween').addEvent('complete', function(e) {
			   $('dimmContainer').setStyle('display','none');
			   $$('#windowBox .boxTop').set('html',loadingText);
			   
			   this.removeEvents();
			   
			   if(redirectAfter)
			     document.location.href = redirectAfter;
    });
    
  return false;
}

/* ---------------------------------------------------------------------------------- */
// AJAX REQUEST
// send a HTML request and put the outcome in the windowRequestBox
function requestSite(site,siteTitle,formId) {

  var formular = $(formId);
  var newWindow = true;
  var removeLoadingCircle;
  
  // creates the request Object
  var requestSite = new Request.HTML({url:site,
    //-----------------------------------------------------------------------------
    onRequest: function() { //-----------------------------------------------------
        
        // checks if the windowRequestBox is empty, means that an new window is opend
  		  if($('windowRequestBox').get('text') != '')
  		    newWindow = false;
        
        // shows the LOADING
        if(!navigator.appVersion.match(/MSIE ([0-7]\.\d)/)) {
          $('windowRequestBox').grab(new Element('div', {id: 'windowBoxDimmer'}),'top');
          removeLoadingCircle = loadingCircle('windowBoxDimmer', 23, 35, 12, 5, "#fff");
        } else {
          $('windowRequestBox').grab(new Element('div', {id: 'loadingCircle', style: 'position: absolute !important; top: 20px; left: 55px; width: 48px !important;'}),'top');
        }
    },
    //-----------------------------------------------------------------------------
		onSuccess: function(html) { //-------------------------------------------------      
      
      // resize the box by a slide; set the slide
		  $('windowRequestBox').set('slide', {duration: '300', transition: Fx.Transitions.Pow.easeOut});      
      $('windowRequestBox').slide('out');
      
      if(!navigator.appVersion.match(/MSIE ([0-7]\.\d)/))
        removeLoadingCircle();
      
      // ->> on complete fade out, put content
      $('windowRequestBox').get('slide').addEvent('complete',function(e) {
        
        $('windowRequestBox').get('slide').removeEvents();
        
        // fill in the content
  			if(site) {
    			//Clear the text currently inside the results div.
    			$('windowRequestBox').set('html', '');
    			//Inject the new DOM elements into the results div.
    			$('windowRequestBox').adopt(html);
  			}
  			
  			// fire a event if the page is loaded
  			$('windowBox').fireEvent('loaded',$('windowRequestBox'));
        
        // sets the height of the wrapper to auto after the slide,
        // so that the windowRequestBox, resizes automaticly when content is changing
        $('windowRequestBox').get('slide').addEvent('complete', function() {
          if($('windowRequestBox').get('slide').wrapper.offsetHeight != 0 && !navigator.appVersion.match(/MSIE ([0-6]\.\d)/))
            $('windowRequestBox').get('slide').wrapper.setStyle('height','auto');
        });
			  
  			// only when the a new window is opend slide in ------------
  			if(newWindow) {
  			
    		  // first fill in the title
    		  if(siteTitle) {
      			//Inject the new DOM elements into the boxTop div.
      			$$('#windowBox .boxTop').set('html',siteTitle + '<a href="#" onclick="closeWindowBox();return false;"></a>');
    			} else {
            //Clear the boxTop <div>
      		  $$('#windowBox .boxTop').set('html', '<a href="#" onclick="closeWindowBox(false);return false;"></a>');
          }
            
          // IE HACK, wont bring the bottom div to the bottom
    			if(navigator.appVersion.match(/MSIE ([0-6]\.\d)/)) {
      			$$('#windowBox .boxBottom')[0].setStyle('top','68px');
      			$$('#windowBox .boxBottom')[0].set('tween',{duration: '500', transition: Fx.Transitions.Pow.easeOut});
      			$$('#windowBox .boxBottom')[0].tween('top',$('windowRequestBox').getSize().y);
    			}
    		
    		// else RESIZE ------------
  			} else {
  			   
  			  // slides out
          //$('windowRequestBox').slide('show');
            
          // IE HACK, wont bring the bottom div to the bottom
    			if(navigator.appVersion.match(/MSIE ([0-6]\.\d)/)) {
      			$$('#windowBox .boxBottom')[0].setStyle('top',$('windowRequestBox').getSize().y);
    			}
        }			
  			
  			// slides in again
        $('windowRequestBox').slide('in');
  			
  			/* set toolTips to all objects with a toolTip class */
  			setToolTips();
			
			});
		},
		//-----------------------------------------------------------------------------
		//Our request will most likely succeed, but just in case, we'll add an
		//onFailure method which will let the user know what happened.
		onFailure: function() { //-----------------------------------------------------
			$('windowRequestBox').set('text', 'The request failed.');
		  }
  }).post(formular);
}

// *** ->> THUMBNAIL - functions -----------------------------------------------------------------------------------------------------------------------
 
//--------------------------------------------------
// called on the beginning of the upload
function startUploadAnimation() {
  
  // shows the LOADING
  if(!navigator.appVersion.match(/MSIE ([0-7]\.\d)/)) {
    $('windowRequestBox').grab(new Element('div', {id: 'windowBoxDimmer', style: 'padding-top: 80px;'}),'top');
    $('windowBoxDimmer').setStyle('display','block');
    uploadAnimationElement = loadingCircle('windowBoxDimmer', 30, 50, 12, 10, "#fff");
  } else {
    uploadAnimationElement = new Element('div', {id: 'loadingCircle', style: 'position: absolute !important; top: 20px; left: 55px; width: 48px !important;'});
    $('windowRequestBox').grab(uploadAnimationElement,'top'); 
  }  
  return true;
}
//--------------------------------------------------
// called on the end of the upload
function stopUploadAnimation() {
  
  // shows the iframe content
  $('uploadTargetFrame').setStyle('width','100%');
  $('uploadTargetFrame').tween('height','100px');
  
  // removes the loading animation
  if(uploadAnimationElement != null) {
  
    if(!navigator.appVersion.match(/MSIE ([0-7]\.\d)/)) {
      uploadAnimationElement();
      //$('windowBoxDimmer').setStyle('padding',0);
      //$('windowBoxDimmer').tween('height',0);
      // slides in again
        $('windowRequestBox').slide('out');
        
        $('windowRequestBox').get('slide').addEvent('complete',function(e) {
          $('windowBoxDimmer').setStyle('display','none');
          $('windowRequestBox').slide('in');
        });
      
    } else {
      uploadAnimationElement.destroy();
    }
    
    return true;
  }
  return false;
}
//--------------------------------------------------
// called on the SUCCESFULL end of the upload
function finishUpload(frameHeight) {

  // shows the iframe content
  if($('uploadTargetFrame').tween('height',frameHeight + 'px'))
  
  // show the ok button
  $('pageThumbnailOkButton').setStyle('display','block');
  
  // hides the from and the thumbInfo
  $('pageThumbnailUploadForm').setStyle('display','none');
  $('thumbInfo').setStyle('display','none');
}

// *---------------------------------------------------------------------------------------------------*
//  DOMREADY
// *---------------------------------------------------------------------------------------------------*
window.addEvent('domready', function() {

  // -> CLOSE WINDOW BOX by clicking the windowBoxContainer
  $('windowBoxContainer').addEvent('mouseup',function(e){    
    if(e.target.getProperty('id') == 'windowBoxContainer')
    closeWindowBox();
  });
    
  // *** ->> THUMBNAIL -----------------------------------------------------------------------------------------------------------------------
  
  // run the script if the windowBox is loaded with content
  $('windowBox').addEvent('loaded',function(windowContent) {
    
    // checks if the pageThumbnailUpload site is opend
    if($('pageThumbnailUploadForm') != null) {
      // hides the iframe on startup
      $('uploadTargetFrame').setStyle('width','0px');
      $('uploadTargetFrame').setStyle('height','0px');
      
      // hide the ok button
      $('pageThumbnailOkButton').setStyle('display','none');
    
      // -----------------------------------------
      // ADD SLIDE TO THE THUMB-SIZE
      if($('thumbSize') != null && !navigator.appVersion.match(/MSIE ([0-6]\.\d)/)) {  
    
         // creates the slide effect
    	   var slideThumbSize = new Fx.Slide($('thumbSize'),{duration: '750', transition: Fx.Transitions.Pow.easeOut});  
        
         // slides the hotky div in, on start
         slideThumbSize.hide();
        
         // sets the SLIDE EFFECT to the buttons
         if($('thumbSizeToogle') != null) {
           $('thumbSizeToogle').addEvent('click', function(e){  	   
          		e.stop();    		
          		slideThumbSize.toggle();
          	});
         }
      }
      
      // sets the realtime
      setThumbScale('windowBox_thumbWidth','windowBox_thumbWidthScale','windowBox_thumbHeight','windowBox_thumbHeightScale');
    
      /* set autoresize to THUMBNAIL PREVIEW */
			//autoResizeThumbnailPreview();
    }
  });
  
});