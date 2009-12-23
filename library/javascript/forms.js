/*  feindura - Flat File Content Management System
    Copyright (C) 2009 Fabian Vogelsteller [frozeman.de]

    This program is free software;
    you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
    without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along with this program;
    if not,see <http://www.gnu.org/licenses/>.
    
*
* 
* forms.php version 0.1 (require mootools-core AND mootools-more)  */

var myCfe;

/* ---------------------------------------------------------------------------------
* when the DOM is ready */
window.addEvent('domready', function() {
  
  // ------------------------------------------------------------
  // makes inputs who are empty small, and resize it on mouseover
  if($$('.right input') != null) {
        var smallSize = '50';
        
        $$('.right input').each(function(input){
            
            // looks for empty inputs
            if(input.get('value') == '' || input.get('disabled') != false) {
                
                var hasFocus = false;
                var hasContent = false;
                
                var inputWidthBefore = input.getStyle('width');
                input.setStyle('width', smallSize + 'px'); //makes the input small
                
                input.set('tween',{duration: '700', transition: Fx.Transitions.Bounce.easeOut})
                
                input.addEvents({
                  'mouseover' : function() { // resize on mouseover
                      input.tween('width',inputWidthBefore);
                  },
                  'focus' : function(){ // if onfocus set hasFocus = true
                      hasFocus = true;
                      input.tween('width',inputWidthBefore);
                  },
                  'blur' : function() { // if onblur set hasFocus = false and tween to small if the input has still no content
                      hasFocus = false;
                      if(input.get('value') == '')
                        input.tween('width',smallSize + 'px');
                  },
                  'mouseout' : function() { // onmouseout, if has not focus tween to small
                      if(!hasFocus && input.get('value') == '')
                        input.tween('width',smallSize + 'px');
                  }
                });
            }
        });
  }
  
  
  // ------------------------------------------------------------
  // REPLACE the CHECKBOXES
  
  /* path to a 1x1 pixel transparent gif */
  cfe.spacer = "library/thirdparty/customformelements/gfx/spacer.gif";
  
  // create a cfe replacement instance
  myCfe = new cfe.replace();
  
  // ->> create CHECKBOX DEPENDENCIES
  $$('input[type=checkbox]').each(function(checkbox) {
    var checkboxId = checkbox.get('id');
    // go trough checkboxes with id
    if(checkboxId) {    
      // -> ** categories[0-9]sortdate
      if(checkbox.get('id').match(/^categories[0-9]sortbydate$/)) {
        var categoryNumber = checkbox.get('id').match(/[0-9]+/);
        myCfe.addDependencies(checkbox,['categories'+categoryNumber+'sortdate']);
      }    
    
    }
  });
  
  // initialize the replacment
  myCfe.init({scope: $('content')});
   
});