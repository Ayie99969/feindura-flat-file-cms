var CodeMirror=(function(){function y(O,aP){var aY={},aK=y.defaults;for(var bd in aK){if(aK.hasOwnProperty(bd)){aY[bd]=(aP&&aP.hasOwnProperty(bd)?aP:aK)[bd];}}var bb=document.createElement("div");bb.className="CodeMirror";if(window.ActiveXObject&&/MSIE [1-7][\b\.]/.test(navigator.userAgent)){bb.style.position="relative";}bb.innerHTML='<div style="position: relative"><div style="position: absolute; height: 0; width: 0; overflow: hidden;"></div><div style="position: relative"><div class="CodeMirror-gutter"><div class="CodeMirror-gutter-text"></div></div><div style="overflow: hidden; position: absolute; width: 0; left: 0"><textarea style="height: 1px; position: absolute; width: 1px;" wrap="off"></textarea></div><div class="CodeMirror-lines"><div style="position: relative"><pre class="CodeMirror-cursor">&#160;</pre><div></div></div></div></div></div>';if(O.appendChild){O.appendChild(bb);}else{O(bb);}var av=bb.firstChild,an=av.firstChild,a7=an.nextSibling,aE=a7.firstChild,bB=aE.firstChild,bF=aE.nextSibling,bD=bF.firstChild,ay=bF.nextSibling.firstChild,W=ay.firstChild,Z=W.nextSibling;if(aY.tabindex!=null){bD.tabindex=aY.tabindex;}if(!aY.gutter&&!aY.lineNumbers){aE.style.display="none";}var ax=new l(),ah=new l(),Y;var a0,bx=[new z("")],aT,aQ=new c(),i;a9();var aF={from:{line:0,ch:0},to:{line:0,ch:0},inverted:false};var aS,bi;var a5,bv,aA,ae,bt;var a2=0,bg=0,bn=0,aD=null;var P,bm;var az="";by(function(){ab(aY.value||"");a5=false;})();setTimeout(at,20);e(bb,"mousedown",by(ai));if(!o){e(bb,"contextmenu",by(ag));}e(av,"dblclick",by(a1));e(bb,"scroll",function(){X([]);if(aY.onScroll){aY.onScroll(bu);}});e(window,"resize",function(){X(true);});e(bD,"keyup",by(a6));e(bD,"keydown",by(al));e(bD,"keypress",by(aW));e(bD,"focus",au);e(bD,"blur",ar);e(bb,"dragenter",function(bI){bI.stop();});e(bb,"dragover",function(bI){bI.stop();});e(bb,"drop",by(ad));e(bb,"paste",function(){bD.focus();bs();});e(bD,"paste",function(){bs();});e(bD,"cut",function(){bs();});if(document.activeElement==bD){au();}else{ar();}function I(bI){return bI>=0&&bI<bx.length;}var bu={getValue:aZ,setValue:by(ab),getSelection:bp,replaceSelection:by(ac),focus:function(){bD.focus();au();bs();},setOption:function(bI,bJ){aY[bI]=bJ;if(bI=="lineNumbers"||bI=="gutter"){K();}else{if(bI=="mode"||bI=="indentUnit"){a9();}}},getOption:function(bI){return aY[bI];},undo:by(bk),redo:by(bG),indentLine:by(function(bI){if(I(bI)){ak(bI,"smart");}}),historySize:function(){return{undo:aQ.done.length,redo:aQ.undone.length};},matchBrackets:by(function(){aj(true);}),getTokenAt:function(bI){bI=aa(bI);return bx[bI.line].getTokenAt(a0,aw(bI.line),bI.ch);},cursorCoords:function(bI){if(bI==null){bI=aF.inverted;}return be(bI?aF.from:aF.to);},charCoords:function(bI){return be(aa(bI));},coordsChar:function(bJ){var bK=A(ay);var bI=aM(Math.min(bx.length-1,a2+Math.floor((bJ.y-bK.top)/bw())));return aa({line:bI,ch:aX(aM(bI),bJ.x-bK.left)});},getSearchCursor:function(bJ,bK,bI){return new ao(bJ,bK,bI);},markText:by(function(bJ,bI,bK){return by(N(bJ,bI,bK));}),setMarker:af,clearMarker:V,setLineClass:by(aC),lineInfo:T,addWidget:function(bK,bJ,bI){var bK=bf(aa(bK),true);bJ.style.top=(a2*bw()+bK.yBot+aU())+"px";bJ.style.left=(bK.x+a8())+"px";av.appendChild(bJ);if(bI){bH(bK.x,bK.yBot,bK.x+bJ.offsetWidth,bK.yBot+bJ.offsetHeight);}},lineCount:function(){return bx.length;},getCursor:function(bI){if(bI==null){bI=aF.inverted;}return q(bI?aF.from:aF.to);},somethingSelected:function(){return !n(aF.from,aF.to);},setCursor:by(function(bI,bJ){if(bJ==null&&typeof bI.line=="number"){aI(bI.line,bI.ch);}else{aI(bI,bJ);}}),setSelection:by(function(bJ,bI){bh(aa(bJ),aa(bI||bJ));}),getLine:function(bI){if(I(bI)){return bx[bI].text;}},setLine:by(function(bI,bJ){if(I(bI)){ba(bJ,{line:bI,ch:0},{line:bI,ch:bx[bI].text.length});}}),removeLine:by(function(bI){if(I(bI)){ba("",{line:bI,ch:0},aa({line:bI+1,ch:0}));}}),replaceRange:by(ba),getRange:function(bJ,bI){return aV(aa(bJ),aa(bI));},operation:function(bI){return by(bI)();},refresh:function(){X(true);},getInputField:function(){return bD;},getWrapperElement:function(){return bb;}};function ab(bI){aQ=null;var bJ={line:0,ch:0};a4(bJ,{line:bx.length-1,ch:bx[bx.length-1].text.length},v(bI),bJ,bJ);aQ=new c();}function aZ(bK){var bL=[];for(var bJ=0,bI=bx.length;bJ<bI;++bJ){bL.push(bx[bJ].text);}return bL.join("\n");}function ai(bO){for(var bK=bO.target();bK!=bb;bK=bK.parentNode){if(bK.parentNode==bB){if(aY.onGutterClick){aY.onGutterClick(bu,d(bB.childNodes,bK)+a2);}return bO.stop();}}if(o&&bO.button()==3){ag(bO);}if(bO.button()!=1){return;}var bI=U(bO),bQ=bI,bJ;if(!bI){if(bO.target()==bb){bO.stop();}return;}aI(bI.line,bI.ch,false);if(!i){au();}bO.stop();function bM(){bD.focus();a5=true;bL();bN();}function bP(bR){var bT=U(bR,true);if(bT&&!n(bT,bQ)){if(!i){au();}bQ=bT;bh(bI,bT);a5=false;var bS=bz();if(bT.line>=bS.to||bT.line<bS.from){bJ=setTimeout(by(function(){bP(bR);}),150);}}}var bL=e(document,"mousemove",by(function(bR){clearTimeout(bJ);bR.stop();bP(bR);}),true);var bN=e(document,"mouseup",by(function(bR){clearTimeout(bJ);var bS=U(bR);if(bS){bh(bI,bS);}bR.stop();bM();}),true);}function a1(bI){var bJ=U(bI);if(!bJ){return;}a3(bJ);bI.stop();}function ad(bM){var bP=U(bM,true),bJ=bM.e.dataTransfer.files;if(!bP||aY.readOnly){return;}if(bJ&&bJ.length&&window.FileReader&&window.File){var bO=bJ.length,bN=Array(bO),bK=0;for(var bI=0;bI<bO;++bI){bL(bJ[bI],bI);}function bL(bS,bR){var bQ=new FileReader;bQ.onload=function(){bN[bR]=bQ.result;if(++bK==bO){ba(bN.join(""),aa(bP),aa(bP));}};bQ.readAsText(bS);}}else{try{var bN=bM.e.dataTransfer.getData("Text");if(bN){ba(bN,bP,bP);}}catch(bM){}}}function al(bM){if(!i){au();}var bL=bM.e.keyCode;var bK=(j?bM.e.metaKey:bM.e.ctrlKey)&&!bM.e.altKey,bJ=bM.e.ctrlKey||bM.e.altKey||bM.e.metaKey;if(bL==16||bM.e.shiftKey){aS=aS||(aF.inverted?aF.to:aF.from);}else{aS=null;}if(aY.onKeyEvent&&aY.onKeyEvent(bu,s(bM.e))){return;}if(bL==33||bL==34){bq(bL==34);return bM.stop();}if(bK&&(bL==36||bL==35)){bA(bL==36);return bM.stop();}if(bK&&bL==65){bc();return bM.stop();}if(!aY.readOnly){if(!bJ&&bL==13){return;}if(!bJ&&bL==9&&ap(bM.e.shiftKey)){return bM.stop();}if(bK&&bL==90){bk();return bM.stop();}if(bK&&((bM.e.shiftKey&&bL==90)||bL==89)){bG();return bM.stop();}}aD=(bK?"c":"")+bL;if(aF.inverted&&t.hasOwnProperty(aD)){var bI=G(bD);if(bI){bi={anchor:bI.start};f(bD,bI.start,bI.start);}}bs(aD);}function a6(bI){if(bi){bi=null;a5=true;}if(bI.e.keyCode==16){aS=null;}}function aW(bK){if(aY.onKeyEvent&&aY.onKeyEvent(bu,s(bK.e))){return;}if(aY.electricChars&&a0.electricChars){var bI=String.fromCharCode(bK.e.charCode==null?bK.e.keyCode:bK.e.charCode);if(a0.electricChars.indexOf(bI)>-1){setTimeout(by(function(){ak(aF.to.line,"smart");}),50);}}var bJ=bK.e.keyCode;if(bJ==13){aq();bK.stop();}else{if(bJ==9&&aY.tabMode!="default"){bK.stop();}else{bs(aD);}}}function au(){if(!i&&aY.onFocus){aY.onFocus(bu);}i=true;bj();if(bb.className.search(/\bCodeMirror-focused\b/)==-1){bb.className+=" CodeMirror-focused";}J();}function ar(){if(i&&aY.onBlur){aY.onBlur(bu);}clearInterval(Y);aS=null;i=false;bb.className=bb.className.replace(" CodeMirror-focused","");}function a4(bP,bO,bM,bJ,bI){if(aQ){var bK=[];for(var bL=bP.line,bN=bO.line+1;bL<bN;++bL){bK.push(bx[bL].text);}aQ.addChange(bP.line,bM.length,bK);while(aQ.done.length>aY.undoDepth){aQ.done.shift();}}L(bP,bO,bM,bJ,bI);}function aH(bO,bN){var bM=bO.pop();if(bM){var bK=[],bI=bM.start+bM.added;for(var bJ=bM.start;bJ<bI;++bJ){bK.push(bx[bJ].text);}bN.push({start:bM.start,added:bM.old.length,old:bK});var bL=aa({line:bM.start+bM.old.length-1,ch:k(bK[bK.length-1],bM.old[bM.old.length-1])});L({line:bM.start,ch:0},{line:bI-1,ch:bx[bI-1].text.length},bM.old,bL,bL);}}function bk(){aH(aQ.done,aQ.undone);}function bG(){aH(aQ.undone,aQ.done);}function L(bT,bM,bY,bI,bZ){var bX=false,bL=az.length;for(var bU=bT.line;bU<bM.line;++bU){if(bx[bU].text.length==bL){bX=true;break;}}var bP=bM.line-bT.line,bO=bx[bT.line],bJ=bx[bM.line];if(bO==bJ){if(bY.length==1){bO.replace(bT.ch,bM.ch,bY[0]);}else{bJ=bO.split(bM.ch,bY[bY.length-1]);var bQ=[bT.line+1,bP];bO.replace(bT.ch,bO.text.length,bY[0]);for(var bU=1,bW=bY.length-1;bU<bW;++bU){bQ.push(new z(bY[bU]));}bQ.push(bJ);bx.splice.apply(bx,bQ);}}else{if(bY.length==1){bO.replace(bT.ch,bO.text.length,bY[0]+bJ.text.slice(bM.ch));bx.splice(bT.line+1,bP);}else{var bQ=[bT.line+1,bP-1];bO.replace(bT.ch,bO.text.length,bY[0]);bJ.replace(0,bM.ch,bY[bY.length-1]);for(var bU=1,bW=bY.length-1;bU<bW;++bU){bQ.push(new z(bY[bU]));}bx.splice.apply(bx,bQ);}}for(var bU=bT.line,bW=bU+bY.length;bU<bW;++bU){var bS=bx[bU].text;if(bS.length>bL){az=bS;bL=bS.length;bX=false;}}if(bX){bL=0;for(var bU=0,bW=bx.length;bU<bW;++bU){var bS=bx[bU].text;if(bS.length>bL){bL=bS.length;az=bS;}}}var bK=[],bN=bY.length-bP-1;for(var bU=0,bS=aT.length;bU<bS;++bU){var bV=aT[bU];if(bV<bT.line){bK.push(bV);}else{if(bV>bM.line){bK.push(bV+bN);}}}if(bY.length){bK.push(bT.line);}aT=bK;bC(100);bv.push({from:bT.line,to:bM.line+1,diff:bN});aA={from:bT,to:bM,text:bY};function bR(b0){return b0<=Math.min(bM.line,bM.line+bN)?b0:b0+bN;}bh(bI,bZ,bR(aF.from.line),bR(aF.to.line));av.style.height=(bx.length*bw()+2*aU())+"px";}function ba(bJ,bM,bL){bM=aa(bM);if(!bL){bL=bM;}else{bL=aa(bL);}bJ=v(bJ);function bK(bP){if(m(bP,bM)){return bP;}if(!m(bL,bP)){return bI;}var bN=bP.line+bJ.length-(bL.line-bM.line)-1;var bO=bP.ch;if(bP.line==bL.line){bO+=bJ[bJ.length-1].length-(bL.ch-(bL.line==bM.line?bM.ch:0));}return{line:bN,ch:bO};}var bI;bl(bJ,bM,bL,function(bN){bI=bN;return{from:bK(aF.from),to:bK(aF.to)};});return bI;}function ac(bI,bJ){bl(v(bI),aF.from,aF.to,function(bK){if(bJ=="end"){return{from:bK,to:bK};}else{if(bJ=="start"){return{from:aF.from,to:aF.from};}else{return{from:aF.from,to:bK};}}});}function bl(bL,bN,bM,bI){var bK=bL.length==1?bL[0].length+bN.ch:bL[bL.length-1].length;var bJ=bI({line:bN.line+bL.length-1,ch:bK});a4(bN,bM,bL,bJ.from,bJ.to);}function aV(bN,bM){var bJ=bN.line,bI=bM.line;if(bJ==bI){return bx[bJ].text.slice(bN.ch,bM.ch);}var bL=[bx[bJ].text.slice(bN.ch)];for(var bK=bJ+1;bK<bI;++bK){bL.push(bx[bK].text);}bL.push(bx[bI].text.slice(0,bM.ch));return bL.join("\n");}function bp(){return aV(aF.from,aF.to);}var aL=false;function bj(){if(aL){return;}ax.set(2000,function(){R();br();if(i){bj();}aB();});}function bs(bK){var bI=false;aL=true;function bJ(){R();var bL=br();if(bL=="moved"&&bK){t[bK]=true;}if(!bL&&!bI){bI=true;ax.set(80,bJ);}else{aL=false;bj();}aB();}ax.set(20,bJ);}function br(){var bO=false,bV=bD.value,bX=G(bD);if(!bX){return false;}var bO=P.text!=bV,bQ=bi;var bP=bO||bX.start!=P.start||bX.end!=(bQ?P.start:P.end);if(!bP&&!bQ){return false;}if(bO){aS=bi=null;if(aY.readOnly){a5=true;return"changed";}}function bM(b4,b2){var b3=0;for(;;){var b1=bV.indexOf("\n",b3);if(b1==-1||(bV.charAt(b1-1)=="\r"?b1-1:b1)>=b4){return{line:b2,ch:b4-b3};}++b2;b3=b1+1;}}var bW=bM(bX.start,P.from),bJ=bM(bX.end,P.from);if(bQ){bW=bX.start==bQ.anchor?bJ:bW;bJ=aS?aF.to:bX.start==bQ.anchor?bW:bJ;if(!m(bW,bJ)){bi=null;aF.inverted=false;var b0=bW;bW=bJ;bJ=b0;}}if(bW.line==bJ.line&&bW.line==aF.from.line&&bW.line==aF.to.line&&!aS){a5=false;}if(bO){var bN=0,bL=bV.length,bY=Math.min(bL,P.text.length);var bZ,bS=P.from,bK=-1;while(bN<bY&&(bZ=bV.charAt(bN))==P.text.charAt(bN)){++bN;if(bZ=="\n"){bS++;bK=bN;}}var bT=bK>-1?bN-bK:bN,bI=P.to-1,bR=P.text.length;for(;;){bZ=P.text.charAt(bR);if(bZ=="\n"){bI--;}if(bV.charAt(bL)!=bZ){++bL;++bR;break;}if(bR<=bN||bL<=bN){break;}--bL;--bR;}var bK=P.text.lastIndexOf("\n",bR-1),bU=bK==-1?bR:bR-bK-1;a4({line:bS,ch:bT},{line:bI,ch:bU},v(bV.slice(bN,bL)),bW,bJ);if(bS!=bI||bW.line!=bS){a5=true;}}else{bh(bW,bJ);}P.text=bV;P.start=bX.start;P.end=bX.end;return bO?"changed":bP?"moved":false;}function at(){var bL=[];var bN=Math.max(0,aF.from.line-1),bM=Math.min(bx.length,aF.to.line+2);for(var bK=bN;bK<bM;++bK){bL.push(bx[bK].text);}bL=bD.value=bL.join(h);var bJ=aF.from.ch,bI=aF.to.ch;for(var bK=bN;bK<aF.from.line;++bK){bJ+=h.length+bx[bK].text.length;}for(var bK=bN;bK<aF.to.line;++bK){bI+=h.length+bx[bK].text.length;}P={text:bL,from:bN,to:bM,start:bJ,end:bI};f(bD,bJ,bi?bJ:bI);}function aJ(){var bI=bf(aF.inverted?aF.from:aF.to);return bH(bI.x,bI.y,bI.x,bI.yBot);}function bH(bK,bO,bI,bN){var bM=a8(),bT=aU();bO+=bT;bN+=bT;bK+=bM;bI+=bM;var bQ=bb.clientHeight,bL=bb.scrollTop,bJ=false,bS=true;if(bO<bL){bb.scrollTop=Math.max(0,bO-10);bJ=true;}else{if(bN>bL+bQ){bb.scrollTop=bN+10-bQ;bJ=true;}}var bP=bb.clientWidth,bR=bb.scrollLeft;if(bK<bR){bb.scrollLeft=Math.max(0,bK-10);bJ=true;}else{if(bI>bP+bR){bb.scrollLeft=bI+10-bP;bJ=true;if(bI>av.clientWidth){bS=false;}}}if(bJ&&aY.onScroll){aY.onScroll(bu);}return bS;}function bz(){var bI=bw(),bJ=bb.scrollTop-aU();return{from:Math.min(bx.length,Math.max(0,Math.floor(bJ/bI))),to:Math.min(bx.length,Math.ceil((bJ+bb.clientHeight)/bI))};}function X(b1){if(!bb.clientWidth){a2=bg=0;return;}var b0=b1===true?[]:[{from:a2,to:bg,domStart:0}];for(var bZ=0,bV=b1.length||0;bZ<bV;++bZ){var bP=b1[bZ],bN=[],bQ=bP.diff||0;for(var bY=0,bW=b0.length;bY<bW;++bY){var bS=b0[bY];if(bP.to<=bS.from){bN.push({from:bS.from+bQ,to:bS.to+bQ,domStart:bS.domStart});}else{if(bS.to<=bP.from){bN.push(bS);}else{if(bP.from>bS.from){bN.push({from:bS.from,to:bP.from,domStart:bS.domStart});}if(bP.to<bS.to){bN.push({from:bP.to+bQ,to:bS.to+bQ,domStart:bS.domStart+(bP.to-bS.from)});}}}}b0=bN;}var bK=bz();var bX=Math.min(a2,Math.max(bK.from-3,0)),bI=Math.min(bx.length,Math.max(bg,bK.to+3)),bO=[],bR=0,bM=bg-a2,bL=bX,bU=0;for(var bZ=0,bV=b0.length;bZ<bV;++bZ){var bS=b0[bZ];if(bS.to<=bX){continue;}if(bS.from>=bI){break;}if(bS.domStart>bR||bS.from>bL){bO.push({from:bL,to:bS.from,domSize:bS.domStart-bR,domStart:bR});bU+=bS.from-bL;}bL=bS.to;bR=bS.domStart+(bS.to-bS.from);}if(bR!=bM||bL!=bI){bU+=Math.abs(bI-bL);bO.push({from:bL,to:bI,domSize:bM-bR,domStart:bR});}if(!bO.length){return;}Z.style.display="none";if(bU>(bK.to-bK.from)*0.3){aN(bX=Math.max(bK.from-10,0),bI=Math.min(bK.to+7,bx.length));}else{S(bO);}Z.style.display="";var bT=bX!=a2||bI!=bg||bn!=bb.clientHeight;a2=bX;bg=bI;a7.style.top=(bX*bw())+"px";if(bT){bn=bb.clientHeight;av.style.height=(bx.length*bw()+2*aU())+"px";Q();}var bJ=aG(az);ay.style.width=bJ>bb.clientWidth?bJ+"px":"";if(Z.childNodes.length!=bg-a2){throw new Error("BAD PATCH! "+JSON.stringify(bO)+" size="+(bg-a2)+" nodes="+Z.childNodes.length);}bo();}function aN(bP,bO){var bL=[],bN={line:bP,ch:0},bM=m(aF.from,bN)&&!m(aF.to,bN);for(var bK=bP;bK<bO;++bK){var bJ=null,bI=null;if(bM){bJ=0;if(aF.to.line==bK){bM=false;bI=aF.to.ch;}}else{if(aF.from.line==bK){if(aF.to.line==bK){bJ=aF.from.ch;bI=aF.to.ch;}else{bM=true;bJ=aF.from.ch;}}}bL.push(bx[bK].getHTML(bJ,bI,true));}Z.innerHTML=bL.join("");}function S(bU){var bV=aF.from.line,bW=aF.to.line,bK=0,bS=F&&document.createElement("div");for(var bQ=0,bR=bU.length;bQ<bR;++bQ){var bN=bU[bQ];var bM=(bN.to-bN.from)-bN.domSize;var bT=Z.childNodes[bN.domStart+bN.domSize+bK]||null;if(F){for(var bP=Math.max(-bM,bN.domSize);bP>0;--bP){Z.removeChild(bT?bT.previousSibling:Z.lastChild);}}else{if(bM){for(var bP=Math.max(0,bM);bP>0;--bP){Z.insertBefore(document.createElement("pre"),bT);}for(var bP=Math.max(0,-bM);bP>0;--bP){Z.removeChild(bT?bT.previousSibling:Z.lastChild);}}}var bL=Z.childNodes[bN.domStart+bK],bO=bV<bN.from&&bW>=bN.from;for(var bP=bN.from;bP<bN.to;++bP){var bJ=null,bI=null;if(bO){bJ=0;if(bW==bP){bO=false;bI=aF.to.ch;}}else{if(bV==bP){if(bW==bP){bJ=aF.from.ch;bI=aF.to.ch;}else{bO=true;bJ=aF.from.ch;}}}if(F){bS.innerHTML=bx[bP].getHTML(bJ,bI,true);Z.insertBefore(bS.firstChild,bT);}else{bL.innerHTML=bx[bP].getHTML(bJ,bI,false);bL.className=bx[bP].className||"";bL=bL.nextSibling;}}bK+=bM;}}function Q(){if(!aY.gutter&&!aY.lineNumbers){return;}var bK=a7.offsetHeight,bR=bb.clientHeight;aE.style.height=(bK-bR<2?bR:bK)+"px";var bP=[];for(var bN=a2;bN<bg;++bN){var bO=bx[bN].gutterMarker;var bQ=aY.lineNumbers?bN+aY.firstLineNumber:null;if(bO&&bO.text){bQ=bO.text.replace("%N%",bQ!=null?bQ:"");}else{if(bQ==null){bQ="\u00a0";}}bP.push((bO&&bO.style?'<pre class="'+bO.style+'">':"<pre>"),bQ,"</pre>");}aE.style.display="none";bB.innerHTML=bP.join("");var bM=String(bx.length).length,bI=bB.firstChild,bJ=a(bI),bL="";while(bJ.length+bL.length<bM){bL+="\u00a0";}if(bL){bI.insertBefore(document.createTextNode(bL),bI.firstChild);}aE.style.display="";ay.style.marginLeft=aE.offsetWidth+"px";}function bo(){var bJ=aF.inverted?aF.from:aF.to;var bI=M(bJ.line,bJ.ch)+"px",bK=(bJ.line-a2)*bw()+"px";bF.style.top=bK;bF.style.left=bI;if(n(aF.from,aF.to)){W.style.top=bK;W.style.left=bI;W.style.display="";}else{W.style.display="none";}}function bh(bP,bO,bJ,bM){if(n(aF.from,bP)&&n(aF.to,bO)){return;}var bL=aS&&aa(aS);if(m(bO,bP)){var bK=bO;bO=bP;bP=bK;}if(bL){if(m(bL,bP)){bP=bL;}else{if(m(bO,bL)){bO=bL;}}}var bI=n(aF.to,bO),bN=n(aF.from,bP);if(n(bP,bO)){aF.inverted=false;}else{if(bI&&!bN){aF.inverted=true;}else{if(bN&&!bI){aF.inverted=false;}}}if(bJ==null){bJ=aF.from.line;bM=aF.to.line;}if(n(bP,bO)){if(!n(aF.from,aF.to)){bv.push({from:bJ,to:bM+1});}}else{if(n(aF.from,aF.to)){bv.push({from:bP.line,to:bO.line+1});}else{if(!n(bP,aF.from)){if(bP.line<bJ){bv.push({from:bP.line,to:Math.min(bO.line,bJ)+1});}else{bv.push({from:bJ,to:Math.min(bM,bP.line)+1});}}if(!n(bO,aF.to)){if(bO.line<bM){bv.push({from:Math.max(bJ,bP.line),to:bM+1});}else{bv.push({from:Math.max(bP.line,bM),to:bO.line+1});}}}}aF.from=bP;aF.to=bO;ae=true;}function aI(bI,bJ){var bK=aa({line:bI,ch:bJ||0});bh(bK,bK);}function aM(bI){return Math.max(0,Math.min(bI,bx.length-1));}function aa(bK){if(bK.line<0){return{line:0,ch:0};}if(bK.line>=bx.length){return{line:bx.length-1,ch:bx[bx.length-1].text.length};}var bI=bK.ch,bJ=bx[bK.line].text.length;if(bI==null||bI>bJ){return{line:bK.line,ch:bJ};}else{if(bI<0){return{line:bK.line,ch:0};}else{return bK;}}}function bq(bK){var bI=Math.floor(bb.clientHeight/bw()),bJ=aF.inverted?aF.from:aF.to;aI(bJ.line+(Math.max(bI-1,1)*(bK?1:-1)),bJ.ch);}function bA(bI){aI(bI?0:bx.length-1);}function bc(){var bI=bx.length-1;bh({line:0,ch:0},{line:bI,ch:bx[bI].text.length});}function a3(bL){var bJ=bx[bL.line].text;var bK=bL.ch,bI=bL.ch;while(bK>0&&/\w/.test(bJ.charAt(bK-1))){--bK;}while(bI<bJ.length-1&&/\w/.test(bJ.charAt(bI))){++bI;}bh({line:bL.line,ch:bK},{line:bL.line,ch:bI});}function aq(){ac("\n","end");if(aY.enterMode!="flat"){ak(aF.from.line,aY.enterMode=="keep"?"prev":"smart");}}function ap(bI){aS=null;switch(aY.tabMode){case"default":return false;case"indent":for(var bJ=aF.from.line,bK=aF.to.line;bJ<=bK;++bJ){ak(bJ,"smart");}break;case"classic":if(n(aF.from,aF.to)){if(bI){ak(aF.from.line,"smart");}else{ac("\t","end");}break;}case"shift":for(var bJ=aF.from.line,bK=aF.to.line;bJ<=bK;++bJ){ak(bJ,bI?"subtract":"add");}break;}return true;}function ak(bK,bR){if(bR=="smart"){if(!a0.indent){bR="prev";}else{var bI=aw(bK);}}var bS=bx[bK],bM=bS.indentation(),bJ=bS.text.match(/^\s*/)[0],bO;if(bR=="prev"){if(bK){bO=bx[bK-1].indentation();}else{bO=0;}}else{if(bR=="smart"){bO=a0.indent(bI,bS.text.slice(bJ.length));}else{if(bR=="add"){bO=bM+aY.indentUnit;}else{if(bR=="subtract"){bO=bM-aY.indentUnit;}}}}bO=Math.max(0,bO);var bQ=bO-bM;if(!bQ){if(aF.from.line!=bK&&aF.to.line!=bK){return;}var bP=bJ;}else{var bP="",bN=0;if(aY.indentWithTabs){for(var bL=Math.floor(bO/u);bL;--bL){bN+=u;bP+="\t";}}while(bN<bO){++bN;bP+=" ";}}ba(bP,{line:bK,ch:0},{line:bK,ch:bJ.length});}function a9(){a0=y.getMode(aY,aY.mode);for(var bJ=0,bI=bx.length;bJ<bI;++bJ){bx[bJ].stateAfter=null;}aT=[0];}function K(){var bI=aY.gutter||aY.lineNumbers;aE.style.display=bI?"":"none";if(bI){Q();}else{Z.parentNode.style.marginLeft=0;}}function N(bO,bN,bK){bO=aa(bO);bN=aa(bN);var bI=[];function bM(bP,bT,bS,bQ){var bP=bx[bP],bR=bP.addMark(bT,bS,bQ);bR.line=bP;bI.push(bR);}if(bO.line==bN.line){bM(bO.line,bO.ch,bN.ch,bK);}else{bM(bO.line,bO.ch,null,bK);for(var bJ=bO.line+1,bL=bN.line;bJ<bL;++bJ){bM(bJ,0,null,bK);}bM(bN.line,0,bN.ch,bK);}bv.push({from:bO.line,to:bN.line+1});return function(){var bT,bP;for(var bQ=0;bQ<bI.length;++bQ){var bS=bI[bQ],bR=d(bx,bS.line);bS.line.removeMark(bS);if(bR>-1){if(bT==null){bT=bR;}bP=bR;}}if(bT!=null){bv.push({from:bT,to:bP+1});}};}function af(bI,bK,bJ){if(typeof bI=="number"){bI=bx[aM(bI)];}bI.gutterMarker={text:bK,style:bJ};Q();return bI;}function V(bI){if(typeof bI=="number"){bI=bx[aM(bI)];}bI.gutterMarker=null;Q();}function aC(bI,bJ){if(typeof bI=="number"){var bK=bI;bI=bx[aM(bI)];}else{var bK=d(bx,bI);if(bK==-1){return null;}}bI.className=bJ;bv.push({from:bK,to:bK+1});return bI;}function T(bJ){if(typeof bJ=="number"){var bK=bJ;bJ=bx[bJ];if(!bJ){return null;}}else{var bK=d(bx,bJ);if(bK==-1){return null;}}var bI=bJ.gutterMarker;return{line:bK,text:bJ.text,markerText:bI&&bI.text,markerClass:bI&&bI.style};}function aG(bI){an.innerHTML="<pre><span>x</span></pre>";an.firstChild.firstChild.firstChild.nodeValue=bI;return an.firstChild.firstChild.offsetWidth||10;}function M(bI,bJ){if(bJ==0){return 0;}an.innerHTML="<pre><span>"+bx[bI].getHTML(null,null,false,bJ)+"</span></pre>";return an.firstChild.firstChild.offsetWidth;}function aX(bU,bO){if(bO<=0){return 0;}var bL=bx[bU],bR=bL.text;function bS(bV){an.innerHTML="<pre><span>"+bL.getHTML(null,null,false,bV)+"</span></pre>";return an.firstChild.firstChild.offsetWidth;}var bP=0,bN=0,bQ=bR.length,bM;var bJ=Math.min(bQ,Math.ceil(bO/aG("x")));for(;;){var bK=bS(bJ);if(bK<=bO&&bJ<bQ){bJ=Math.min(bQ,Math.ceil(bJ*1.2));}else{bM=bK;bQ=bJ;break;}}if(bO>bM){return bQ;}bJ=Math.floor(bQ*0.8);bK=bS(bJ);if(bK<bO){bP=bJ;bN=bK;}for(;;){if(bQ-bP<=1){return(bM-bO>bO-bN)?bP:bQ;}var bT=Math.ceil((bP+bQ)/2),bI=bS(bT);if(bI>bO){bQ=bT;bM=bI;}else{bP=bT;bN=bI;}}}function bf(bL,bK){var bJ=bw(),bI=bL.line-(bK?a2:0);return{x:M(bL.line,bL.ch),y:bI*bJ,yBot:(bI+1)*bJ};}function be(bK){var bI=bf(bK,true),bJ=A(ay);return{x:bJ.left+bI.x,y:bJ.top+bI.y,yBot:bJ.top+bI.yBot};}function bw(){var bI=Z.childNodes.length;if(bI){return Z.offsetHeight/bI;}an.innerHTML="<pre>x</pre>";return an.firstChild.offsetHeight||1;}function aU(){return ay.offsetTop;}function a8(){return ay.offsetLeft;}function U(bL,bK){var bM=A(ay),bI=bL.pageX()-bM.left,bO=bL.pageY()-bM.top;if(!bK&&bL.target()!=ay.parentNode&&!(bL.target()==bb&&bO>(bx.length*bw())&&bb.clientHeight>av.offsetHeight)){for(var bN=bL.target();bN!=Z&&bN!=W;bN=bN.parentNode){if(!bN||bN==bb){return null;}}}var bJ=a2+Math.floor(bO/bw());return aa({line:bJ,ch:aX(aM(bJ),bI)});}function ag(bI){var bL=U(bI);if(!bL||window.opera){return;}if(n(aF.from,aF.to)||m(bL,aF.from)||!m(bL,aF.to)){aI(bL.line,bL.ch);}var bK=bD.style.cssText;bD.style.cssText="position: fixed; width: 30px; height: 30px; top: "+(bI.pageY()-1)+"px; left: "+(bI.pageX()-1)+"px; z-index: 1000; background: white; border-width: 0; outline: none; overflow: hidden;";var bJ=bD.value=bp();bD.focus();f(bD,0,bJ.length);if(o){bI.stop();}bt=true;setTimeout(function(){if(bD.value!=bJ){by(ac)(bD.value,"end");}bD.style.cssText=bK;bt=false;at();bj();},50);}function J(){clearInterval(Y);var bI=true;W.style.visibility="";Y=setInterval(function(){W.style.visibility=(bI=!bI)?"":"hidden";},650);}var bE={"(":")>",")":"(<","[":"]>","]":"[<","{":"}>","}":"{<"};function aj(bO){var bI=aF.inverted?aF.from:aF.to,bQ=bx[bI.line],bJ=bI.ch-1;var bN=(bJ>=0&&bE[bQ.text.charAt(bJ)])||bE[bQ.text.charAt(++bJ)];if(!bN){return;}var bR=bN.charAt(0),bP=bN.charAt(1)==">",b1=bP?1:-1,bW=bQ.styles;for(var b2=bJ+1,bY=0,b0=bW.length;bY<b0;bY+=2){if((b2-=bW[bY].length)<=0){var bZ=bW[bY+1];break;}}var bL=[bQ.text.charAt(bJ)],bV=/[(){}[\]]/;function bT(ce,b9,ca){if(!ce.text){return;}var cd=ce.styles,b8=bP?0:ce.text.length-1,cb;for(var b5=bP?0:cd.length-2,b7=bP?cd.length:-2;b5!=b7;b5+=2*b1){var cc=cd[b5];if(cd[b5+1]!=null&&cd[b5+1]!=bZ){b8+=b1*cc.length;continue;}for(var b4=bP?0:cc.length-1,b3=bP?cc.length:-1;b4!=b3;b4+=b1,b8+=b1){if(b8>=b9&&b8<ca&&bV.test(cb=cc.charAt(b4))){var b6=bE[cb];if(b6.charAt(1)==">"==bP){bL.push(cb);}else{if(bL.pop()!=b6.charAt(0)){return{pos:b8,match:false};}else{if(!bL.length){return{pos:b8,match:true};}}}}}}}for(var bY=bI.line,b0=bP?Math.min(bY+50,bx.length):Math.max(0,bY-50);bY!=b0;bY+=b1){var bQ=bx[bY],bM=bY==bI.line;var bS=bT(bQ,bM&&bP?bJ+1:0,bM&&!bP?bJ:bQ.text.length);if(bS){var bZ=bS.match?"CodeMirror-matchingbracket":"CodeMirror-nonmatchingbracket";var bX=N({line:bI.line,ch:bJ},{line:bI.line,ch:bJ+1},bZ),bK=N({line:bY,ch:bS.pos},{line:bY,ch:bS.pos+1},bZ);var bU=by(function(){bX();bK();});if(bO){setTimeout(bU,800);}else{bm=bU;}break;}}}function aO(bO){var bN,bK;for(var bJ=bO,bL=bO-40;bJ>bL;--bJ){if(bJ==0){return 0;}var bI=bx[bJ-1];if(bI.stateAfter){return bJ;}var bM=bI.indentation();if(bK==null||bN>bM){bK=bJ;bN=bM;}}return bK;}function aw(bM){var bL=aO(bM),bK=bL&&bx[bL-1].stateAfter;if(!bK){bK=g(a0);}else{bK=x(a0,bK);}for(var bJ=bL;bJ<bM;++bJ){var bI=bx[bJ];bI.highlight(a0,bK);bI.stateAfter=x(a0,bK);}if(!bx[bM].stateAfter){aT.push(bM);}return bK;}function aR(){var bM=+new Date+aY.workTime;while(aT.length){if(!bx[a2].stateAfter){var bK=a2;}else{var bK=aT.pop();}if(bK>=bx.length){continue;}var bJ=aO(bK),bI=bJ&&bx[bJ-1].stateAfter;if(bI){bI=x(a0,bI);}else{bI=g(a0);}for(var bP=bJ,bL=bx.length;bP<bL;++bP){var bQ=bx[bP],bN=bQ.stateAfter;if(+new Date>bM){aT.push(bP);bC(aY.workDelay);bv.push({from:bK,to:bP});return;}var bO=bQ.highlight(a0,bI);bQ.stateAfter=x(a0,bI);if(bN&&!bO&&bQ.text){break;}}bv.push({from:bK,to:bP});}}function bC(bI){if(!aT.length){return;}ah.set(bI,by(aR));}function R(){a5=null;bv=[];aA=ae=false;}function aB(){var bJ=false;if(ae){bJ=!aJ();}if(bv.length){X(bv);}else{if(ae){bo();}}if(bJ){aJ();}if(ae){J();}if(!bt&&(a5===true||(a5!==false&&ae))){at();}if(ae&&aY.matchBrackets){setTimeout(by(function(){if(bm){bm();bm=null;}aj(false);}),20);}var bI=aA;if(ae&&aY.onCursorActivity){aY.onCursorActivity(bu);}if(bI&&aY.onChange){aY.onChange(bu,bI);}}var am=0;function by(bI){return function(){if(!am++){R();}try{var bJ=bI.apply(this,arguments);}finally{if(!--am){aB();}}return bJ;};}function ao(bK,bM,bJ){this.atOccurrence=false;if(bJ==null){bJ=typeof bK=="string"&&bK==bK.toLowerCase();}if(bM&&typeof bM=="object"){bM=aa(bM);}else{bM={line:0,ch:0};}this.pos={from:bM,to:bM};if(typeof bK!="string"){this.matches=function(bP,bT){if(bP){var bN=bx[bT.line].text.slice(0,bT.ch),bO=bN.match(bK),bS=0;while(bO){var bQ=bN.indexOf(bO[0]);bS+=bQ;bN=bN.slice(bQ+1);var bR=bN.match(bK);if(bR){bO=bR;}else{break;}}}else{var bN=bx[bT.line].text.slice(bT.ch),bO=bN.match(bK),bS=bO&&bT.ch+bN.indexOf(bO[0]);}if(bO){return{from:{line:bT.line,ch:bS},to:{line:bT.line,ch:bS+bO[0].length},match:bO};}};}else{if(bJ){bK=bK.toLowerCase();}var bI=bJ?function(bN){return bN.toLowerCase();}:function(bN){return bN;};var bL=bK.split("\n");if(bL.length==1){this.matches=function(bQ,bR){var bO=bI(bx[bR.line].text),bN=bK.length,bP;if(bQ?(bR.ch>=bN&&(bP=bO.lastIndexOf(bK,bR.ch-bN))!=-1):(bP=bO.indexOf(bK,bR.ch))!=-1){return{from:{line:bR.line,ch:bP},to:{line:bR.line,ch:bP+bN}};}};}else{this.matches=function(bS,bU){var bT=bU.line,bV=(bS?bL.length-1:0),bQ=bL[bV],bW=bI(bx[bT].text);var bR=(bS?bW.indexOf(bQ)+bQ.length:bW.lastIndexOf(bQ));if(bS?bR>=bU.ch||bR!=bQ.length:bR<=bU.ch||bR!=bW.length-bQ.length){return;}for(;;){if(bS?!bT:bT==bx.length-1){return;}bW=bI(bx[bT+=bS?-1:1].text);bQ=bL[bS?--bV:++bV];if(bV>0&&bV<bL.length-1){if(bW!=bQ){return;}else{continue;}}var bP=(bS?bW.lastIndexOf(bQ):bW.indexOf(bQ)+bQ.length);if(bS?bP!=bW.length-bQ.length:bP!=bQ.length){return;}var bN={line:bU.line,ch:bR},bO={line:bT,ch:bP};return{from:bS?bO:bN,to:bS?bN:bO};}};}}}ao.prototype={findNext:function(){return this.find(false);},findPrevious:function(){return this.find(true);},find:function(bJ){var bI=this,bL=aa(bJ?this.pos.from:this.pos.to);function bK(bM){var bN={line:bM,ch:0};bI.pos={from:bN,to:bN};bI.atOccurrence=false;return false;}for(;;){if(this.pos=this.matches(bJ,bL)){this.atOccurrence=true;return this.pos.match||true;}if(bJ){if(!bL.line){return bK(0);}bL={line:bL.line-1,ch:bx[bL.line-1].text.length};}else{if(bL.line==bx.length-1){return bK(bx.length);}bL={line:bL.line+1,ch:0};}}},from:function(){if(this.atOccurrence){return q(this.pos.from);}},to:function(){if(this.atOccurrence){return q(this.pos.to);}}};return bu;}y.defaults={value:"",mode:null,indentUnit:2,indentWithTabs:false,tabMode:"classic",enterMode:"indent",electricChars:true,onKeyEvent:null,lineNumbers:false,gutter:false,firstLineNumber:1,readOnly:false,onChange:null,onCursorActivity:null,onGutterClick:null,onFocus:null,onBlur:null,onScroll:null,matchBrackets:false,workTime:100,workDelay:200,undoDepth:40,tabindex:null};var b={},r={};y.defineMode=function(i,I){if(!y.defaults.mode&&i!="null"){y.defaults.mode=i;}b[i]=I;};y.defineMIME=function(I,i){r[I]=i;};y.getMode=function(J,i){if(typeof i=="string"&&r.hasOwnProperty(i)){i=r[i];}if(typeof i=="string"){var L=i,I={};}else{var L=i.name,I=i;}var K=b[L];if(!K){if(window.console){console.warn("No mode "+L+" found, falling back to plain text.");}return y.getMode(J,"text/plain");}return K(J,I);};y.listModes=function(){var I=[];for(var i in b){if(b.propertyIsEnumerable(i)){I.push(i);}}return I;};y.listMIMEs=function(){var I=[];for(var i in r){if(r.propertyIsEnumerable(i)){I.push(i);}}return I;};y.fromTextArea=function(I,K){if(!K){K={};}K.value=I.value;if(!K.tabindex&&I.tabindex){K.tabindex=I.tabindex;}function M(){I.value=i.getValue();}if(I.form){var L=e(I.form,"submit",M,true);if(typeof I.form.submit=="function"){var J=I.form.submit;function N(){M();I.form.submit=J;I.form.submit();I.form.submit=N;}I.form.submit=N;}}I.style.display="none";var i=y(function(O){I.parentNode.insertBefore(O,I.nextSibling);},K);i.save=M;i.toTextArea=function(){M();I.parentNode.removeChild(i.getWrapperElement());I.style.display="";if(I.form){L();if(typeof I.form.submit=="function"){I.form.submit=J;}}};return i;};function x(K,i){if(i===true){return i;}if(K.copyState){return K.copyState(i);}var J={};for(var L in i){var I=i[L];if(I instanceof Array){I=I.concat([]);}J[L]=I;}return J;}y.startState=g;function g(J,I,i){return J.startState?J.startState(I,i):true;}y.copyState=x;function w(i){this.pos=this.start=0;this.string=i;}w.prototype={eol:function(){return this.pos>=this.string.length;},sol:function(){return this.pos==0;},peek:function(){return this.string.charAt(this.pos);},next:function(){if(this.pos<this.string.length){return this.string.charAt(this.pos++);}},eat:function(i){var J=this.string.charAt(this.pos);if(typeof i=="string"){var I=J==i;}else{var I=J&&(i.test?i.test(J):i(J));}if(I){++this.pos;return J;}},eatWhile:function(i){var I=this.start;while(this.eat(i)){}return this.pos>I;},eatSpace:function(){var i=this.pos;while(/[\s\u00a0]/.test(this.string.charAt(this.pos))){++this.pos;}return this.pos>i;},skipToEnd:function(){this.pos=this.string.length;},skipTo:function(i){var I=this.string.indexOf(i,this.pos);if(I>-1){this.pos=I;return true;}},backUp:function(i){this.pos-=i;},column:function(){return C(this.string,this.start);},indentation:function(){return C(this.string);},match:function(K,I,i){if(typeof K=="string"){function L(M){return i?M.toLowerCase():M;}if(L(this.string).indexOf(L(K),this.pos)==this.pos){if(I!==false){this.pos+=K.length;}return true;}}else{var J=this.string.slice(this.pos).match(K);if(J&&I!==false){this.pos+=J[0].length;}return J;}},current:function(){return this.string.slice(this.start,this.pos);}};function z(I,i){this.styles=i||[I,null];this.stateAfter=null;this.text=I;this.marked=this.gutterMarker=this.className=null;}z.prototype={replace:function(N,O,R){var S=[],L=this.marked;E(0,N,this.styles,S);if(R){S.push(R,null);}E(O,this.text.length,this.styles,S);this.styles=S;this.text=this.text.slice(0,N)+R+this.text.slice(O);this.stateAfter=null;if(L){var P=R.length-(O-N),J=this.text.length;function M(i){return i<=Math.min(O,O+P)?i:i+P;}for(var K=0;K<L.length;++K){var I=L[K],Q=false;if(I.from>=J){Q=true;}else{I.from=M(I.from);if(I.to!=null){I.to=M(I.to);}}if(Q||I.from>=I.to){L.splice(K,1);K--;}}}},split:function(J,I){var i=[I,null];E(J,this.text.length,this.styles,i);return new z(I+this.text.slice(J),i);},addMark:function(L,K,I){var i=this.marked,J={from:L,to:K,style:I};if(this.marked==null){this.marked=[];}this.marked.push(J);this.marked.sort(function(N,M){return N.from-M.from;});return J;},removeMark:function(K){var I=this.marked;if(!I){return;}for(var J=0;J<I.length;++J){if(I[J]==K){I.splice(J,1);break;}}},highlight:function(N,K){var M=new w(this.text),i=this.styles,O=0,L=false;while(!M.eol()){var I=N.token(M,K);var J=this.text.slice(M.start,M.pos);M.start=M.pos;if(O&&i[O-1]==I){i[O-2]+=J;}else{if(J){if(!L&&i[O]!=J||i[O+1]!=I){L=true;}i[O++]=J;i[O++]=I;}}if(M.pos>5000){i[O++]=this.text.slice(M.pos);i[O++]=null;break;}}if(i.length!=O){i.length=O;L=true;}return L;},getTokenAt:function(M,K,J){var i=this.text,L=new w(i);while(L.pos<J&&!L.eol()){L.start=L.pos;var I=M.token(L,K);}return{start:L.start,end:L.pos,string:L.current(),className:I||null,state:K};},indentation:function(){return C(this.text);},getHTML:function(U,Y,L,W){var O=[];if(L){O.push(this.className?'<pre class="'+this.className+'">':"<pre>");}function Z(ah,i){if(!ah){return;}if(i){O.push('<span class="',i,'">',p(ah),"</span>");}else{O.push(p(ah));}}var T=this.styles,M=this.text,S=this.marked;if(U==Y){U=null;}var ab=M.length;if(W!=null){ab=Math.min(W,ab);}if(!M&&W==null){Z(" ",U!=null&&Y==null?"CodeMirror-selected":null);}else{if(!S&&U==null){for(var aa=0,P=0;P<ab;aa+=2){var V=T[aa],X=V.length;if(P+X>ab){V=V.slice(0,ab-P);}P+=X;Z(V,T[aa+1]);}}else{var K=0,aa=0,R="",ac,af=0;var ad=-1,N=null;function ae(){if(S){ad+=1;N=(ad<S.length)?S[ad]:null;}}ae();while(K<ab){var Q=ab;var ag="";if(U!=null){if(U>K){Q=U;}else{if(Y==null||Y>K){ag=" CodeMirror-selected";if(Y!=null){Q=Math.min(Q,Y);}}}}while(N&&N.to!=null&&N.to<=K){ae();}if(N){if(N.from>K){Q=Math.min(Q,N.from);}else{ag+=" "+N.style;if(N.to!=null){Q=Math.min(Q,N.to);}}}for(;;){var J=K+R.length;var I=ac;if(ag){I=ac?ac+ag:ag;}Z(J>Q?R.slice(0,Q-K):R,I);if(J>=Q){R=R.slice(Q-K);K=Q;break;}K=J;R=T[aa++];ac=T[aa++];}}if(U!=null&&Y==null){Z(" ","CodeMirror-selected");}}}if(L){O.push("</pre>");}return O.join("");}};function E(O,P,I,Q){for(var M=0,N=0,J=0;N<P;M+=2){var K=I[M],L=N+K.length;if(J==0){if(L>O){Q.push(K.slice(O-N,Math.min(K.length,P-N)),I[M+1]);}if(L>=O){J=1;}}else{if(J==1){if(L>P){Q.push(K.slice(0,P-N),I[M+1]);}else{Q.push(K,I[M+1]);}}}N=L;}}function c(){this.time=0;this.done=[];this.undone=[];}c.prototype={addChange:function(P,K,I){this.undone.length=0;var O=+new Date,M=this.done[this.done.length-1];if(O-this.time>400||!M||M.start>P+K||M.start+M.added<P-M.added+M.old.length){this.done.push({start:P,added:K,old:I});}else{var L=0;if(P<M.start){for(var J=M.start-P-1;J>=0;--J){M.old.unshift(I[J]);}M.added+=M.start-P;M.start=P;}else{if(M.start<P){L=P-M.start;K+=L;}}for(var J=M.added-L,N=I.length;J<N;++J){M.old.push(I[J]);}if(M.added<K){M.added=K;}}this.time=O;}};function D(){if(this.preventDefault){this.preventDefault();this.stopPropagation();}else{this.returnValue=false;this.cancelBubble=true;}}function s(i){if(!i.stop){i.stop=D;}return i;}function H(i){this.e=i;}H.prototype={stop:function(){D.call(this.e);},target:function(){return this.e.target||this.e.srcElement;},button:function(){if(this.e.which){return this.e.which;}else{if(this.e.button&1){return 1;}else{if(this.e.button&2){return 3;}else{if(this.e.button&4){return 2;}}}}},pageX:function(){if(this.e.pageX!=null){return this.e.pageX;}else{return this.e.clientX+document.body.scrollLeft+document.documentElement.scrollLeft;}},pageY:function(){if(this.e.pageY!=null){return this.e.pageY;}else{return this.e.clientY+document.body.scrollTop+document.documentElement.scrollTop;}}};function e(K,J,I,i){function L(M){I(new H(M||window.event));}if(typeof K.addEventListener=="function"){K.addEventListener(J,L,false);if(i){return function(){K.removeEventListener(J,L,false);};}}else{K.attachEvent("on"+J,L);if(i){return function(){K.detachEvent("on"+J,L);};}}}function l(){this.id=null;}l.prototype={set:function(i,I){clearTimeout(this.id);this.id=setTimeout(I,i);}};var F=(function(){var i=document.createElement("pre");i.innerHTML=" ";return !i.innerHTML;})();var o=/gecko\/\d{7}/i.test(navigator.userAgent);var h="\n";(function(){var i=document.createElement("textarea");i.value="foo\nbar";if(i.value.indexOf("\r")>-1){h="\r\n";}}());var u=8;var j=/Mac/.test(navigator.platform);var t={};for(var B=35;B<=40;++B){t[B]=t["c"+B]=true;}function C(J,I){if(I==null){I=J.search(/[^\s\u00a0]/);if(I==-1){I=J.length;}}for(var K=0,L=0;K<I;++K){if(J.charAt(K)=="\t"){L+=u-(L%u);}else{++L;}}return L;}function A(J){var i=0,L=0,I=J;for(var K=J;K;K=K.offsetParent){i+=K.offsetLeft;L+=K.offsetTop;}for(var K=J;K!=document.body;K=K.parentNode){i-=K.scrollLeft;L-=K.scrollTop;}return{left:i,top:L};}function a(i){return i.textContent||i.innerText||i.nodeValue||"";}function n(I,i){return I.line==i.line&&I.ch==i.ch;}function m(I,i){return I.line<i.line||(I.line==i.line&&I.ch<i.ch);}function q(i){return{line:i.line,ch:i.ch};}function p(i){return i.replace(/[<&]/g,function(I){return I=="&"?"&amp;":"&lt;";});}function k(L,K){if(!K){return L?L.length:0;}if(!L){return K.length;}for(var J=L.length,I=K.length;J>=0&&I>=0;--J,--I){if(L.charAt(J)!=K.charAt(I)){break;}}return I+1;}function d(L,I){if(L.indexOf){return L.indexOf(I);}for(var J=0,K=L.length;J<K;++J){if(L[J]==I){return J;}}return -1;}if("\n\nb".split(/\n/).length!=3){var v=function(J){var K=0,I,i=[];while((I=J.indexOf("\n",K))>-1){i.push(J.slice(K,J.charAt(I-1)=="\r"?I-1:I));K=I+1;}i.push(J.slice(K));return i;};}else{var v=function(i){return i.split(/\r?\n/);};}if(window.getSelection){var G=function(I){try{return{start:I.selectionStart,end:I.selectionEnd};}catch(i){return null;}};var f=function(J,K,i){try{J.setSelectionRange(K,i);}catch(I){}};}else{var G=function(K){try{var O=document.selection.createRange();}catch(Q){return null;}if(!O||O.parentElement()!=K){return null;}var J=K.value,P=J.length,R=K.createTextRange();R.moveToBookmark(O.getBookmark());var M=K.createTextRange();M.collapse(false);if(R.compareEndPoints("StartToEnd",M)>-1){return{start:P,end:P};}var I=-R.moveStart("character",-P);for(var N=J.indexOf("\r");N>-1&&N<I;N=J.indexOf("\r",N+1),I++){}if(R.compareEndPoints("EndToEnd",M)>-1){return{start:I,end:P};}var L=-R.moveEnd("character",-P);for(var N=J.indexOf("\r");N>-1&&N<L;N=J.indexOf("\r",N+1),L++){}return{start:I,end:L};};var f=function(M,O,J){var K=M.createTextRange();K.collapse(true);var I=K.duplicate();var L=0,i=M.value;for(var N=i.indexOf("\n");N>-1&&N<O;N=i.indexOf("\n",N+1)){++L;}K.move("character",O-L);for(;N>-1&&N<J;N=i.indexOf("\n",N+1)){++L;}I.move("character",J-L);K.setEndPoint("EndToEnd",I);K.select();};}y.defineMode("null",function(){return{token:function(i){i.skipToEnd();}};});y.defineMIME("text/plain","null");return y;})();