var qq=qq||{};qq.extend=function(a,b){for(var c in b)a[c]=b[c]};function DLEformatSize(a){var b=-1;do a/=1024,b++;while(99<a);return Math.max(a,.1).toFixed(1)+"kB MB GB TB PB EB".split(" ")[b]}qq.indexOf=function(a,b,c){if(a.indexOf)return a.indexOf(b,c);c=c||0;var d=a.length;for(0>c&&(c+=d);c<d;c++)if(c in a&&a[c]===b)return c;return-1};qq.getUniqueId=function(){var a=0;return function(){return a++}}();
qq.attach=function(a,b,c){a.addEventListener?a.addEventListener(b,c,!1):a.attachEvent&&a.attachEvent("on"+b,c)};qq.detach=function(a,b,c){a.removeEventListener?a.removeEventListener(b,c,!1):a.attachEvent&&a.detachEvent("on"+b,c)};qq.preventDefault=function(a){a.preventDefault?a.preventDefault():a.returnValue=!1};qq.insertBefore=function(a,b){b.parentNode.insertBefore(a,b)};qq.remove=function(a){a.parentNode.removeChild(a)};
qq.contains=function(a,b){return a==b?!0:a.contains?a.contains(b):!!(b.compareDocumentPosition(a)&8)};qq.toElement=function(){var a=document.createElement("div");return function(b){a.innerHTML=b;b=a.firstChild;a.removeChild(b);return b}}();qq.htmlDec=function(){var a=document.createElement("textarea");return function(b){var c=b;try{a.innerHTML=b,c=a.value}catch(d){}return c}}();
qq.css=function(a,b){null!=b.opacity&&"string"!=typeof a.style.opacity&&"undefined"!=typeof a.filters&&(b.filter="alpha(opacity="+Math.round(100*b.opacity)+")");qq.extend(a.style,b)};qq.hasClass=function(a,b){return(new RegExp("(^| )"+b+"( |$)")).test(a.className)};qq.addClass=function(a,b){qq.hasClass(a,b)||(a.className+=" "+b)};qq.removeClass=function(a,b){a.className=a.className.replace(new RegExp("(^| )"+b+"( |$)")," ").replace(/^\s+|\s+$/g,"")};
qq.setText=function(a,b){a.innerText=b;a.textContent=b};qq.children=function(a){var b=[];for(a=a.firstChild;a;)1==a.nodeType&&b.push(a),a=a.nextSibling;return b};qq.getByClass=function(a,b){if(a.querySelectorAll)return a.querySelectorAll("."+b);for(var c=[],d=a.getElementsByTagName("*"),e=d.length,f=0;f<e;f++)qq.hasClass(d[f],b)&&c.push(d[f]);return c};
qq.obj2url=function(a,b,c){var d=[],e="&",f=function(a,c){var e=b?/\[\]$/.test(b)?b:b+"["+c+"]":c;"undefined"!=e&&"undefined"!=c&&d.push("object"===typeof a?qq.obj2url(a,e,!0):"[object Function]"===Object.prototype.toString.call(a)?encodeURIComponent(e)+"="+encodeURIComponent(a()):encodeURIComponent(e)+"="+encodeURIComponent(a))};if(!c&&b)e=/\?/.test(b)?/\?$/.test(b)?"":"&":"?",d.push(b),d.push(qq.obj2url(a));else if("[object Array]"===Object.prototype.toString.call(a)&&"undefined"!=typeof a){var g=
0;for(c=a.length;g<c;++g)f(a[g],g)}else if("undefined"!=typeof a&&null!==a&&"object"===typeof a)for(g in a)f(a[g],g);else d.push(encodeURIComponent(b)+"="+encodeURIComponent(a));return d.join(e).replace(/^&/,"").replace(/%20/g,"+")};qq=qq||{};
qq.FileUploaderBasic=function(a){this._options={debug:!1,action:"",params:{},button:null,multiple:!0,maxConnections:3,allowedExtensions:[],sizeLimit:0,minSizeLimit:0,allowdrop:!0,onSubmit:function(a,c){},onProgress:function(a,c,d,e){},onComplete:function(a,c,d){},onCancel:function(a,c){},messages:{typeError:"{file} has invalid extension. Only {extensions} are allowed.",sizeError:"{file} is too large, maximum file size is {sizeLimit}.",minSizeError:"{file} is too small, minimum file size is {minSizeLimit}.",
emptyError:"{file} is empty, please select files again without it.",onLeave:"The files are being uploaded, if you leave now the upload will be cancelled."},showMessage:function(a){parent.DLEalert(a,"info")}};qq.extend(this._options,a);this._filesInProgress=0;this._handler=this._createUploadHandler();this._options.button&&(this._button=this._createUploadButton(this._options.button));this._preventLeaveInProgress()};
qq.FileUploaderBasic.prototype={setParams:function(a){this._options.params=a},getInProgress:function(){return this._filesInProgress},_createUploadButton:function(a){var b=this;return new qq.UploadButton({element:a,multiple:this._options.multiple&&qq.UploadHandlerXhr.isSupported(),onChange:function(a){b._onInputChange(a)}})},_createUploadHandler:function(){var a=this;var b=qq.UploadHandlerXhr.isSupported()?"UploadHandlerXhr":"UploadHandlerForm";return new qq[b]({debug:this._options.debug,action:this._options.action,
encoding:this._options.encoding,maxConnections:this._options.maxConnections,onProgress:function(b,d,e,f){a._onProgress(b,d,e,f);a._options.onProgress(b,d,e,f)},onComplete:function(b,d,e){a._onComplete(b,d,e);a._options.onComplete(b,d,e)},onCancel:function(b,d){a._onCancel(b,d);a._options.onCancel(b,d)}})},_preventLeaveInProgress:function(){var a=this;qq.attach(window,"beforeunload",function(b){if(a._filesInProgress)return b=b||window.event,b.returnValue=a._options.messages.onLeave})},_onSubmit:function(a,
b){this._filesInProgress++},_onProgress:function(a,b,c,d){},_onComplete:function(a,b,c){this._filesInProgress--},_onCancel:function(a,b){this._filesInProgress--},_onInputChange:function(a){this._handler instanceof qq.UploadHandlerXhr?this._uploadFileList(a.files):this._validateFile(a)&&this._uploadFile(a);this._button.reset()},_uploadFileList:function(a){for(var b=0;b<a.length;b++)if(!this._validateFile(a[b]))return;for(b=0;b<a.length;b++)this._uploadFile(a[b])},_uploadFile:function(a){a=this._handler.add(a);
var b=this._handler.getName(a);!1!==this._options.onSubmit(a,b)&&(this._onSubmit(a,b),this._handler.upload(a,this._options.params))},_validateFile:function(a){if(a.value)var b=a.value.replace(/.*(\/|\\)/,"");else{b=null!=a.fileName?a.fileName:a.name;var c=null!=a.fileSize?a.fileSize:a.size}if(this._isAllowedExtension(b)){if(0===c)return this._error("emptyError",b),!1;if(c&&this._options.sizeLimit&&c>this._options.sizeLimit)return this._error("sizeError",b),!1;if(c&&c<this._options.minSizeLimit)return this._error("minSizeError",
b),!1}else return this._error("typeError",b),!1;return!0},_error:function(a,b){var c=this._options.messages[a],d=this._formatFileName(b);c=c.replace("{file}",d);d=this._options.allowedExtensions.join(", ");c=c.replace("{extensions}",d);d=this._formatSize(this._options.sizeLimit);c=c.replace("{sizeLimit}",d);d=this._formatSize(this._options.minSizeLimit);c=c.replace("{minSizeLimit}",d);this._options.showMessage(c)},_formatFileName:function(a){33<a.length&&(a=a.slice(0,19)+"..."+a.slice(-13));return a},
_isAllowedExtension:function(a){a=-1!==a.indexOf(".")?a.replace(/.*[.]/,"").toLowerCase():"";var b=this._options.allowedExtensions;if(!b.length)return!0;for(var c=0;c<b.length;c++)if(b[c].toLowerCase()==a)return!0;return!1},_formatSize:function(a){var b=-1;do a/=1024,b++;while(99<a);return Math.max(a,.1).toFixed(1)+"kB MB GB TB PB EB".split(" ")[b]}};
qq.FileUploader=function(a){qq.FileUploaderBasic.apply(this,arguments);qq.extend(this._options,{element:null,listElement:null,template:'<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',fileTemplate:'<li><span class="qq-upload-file"></span><span class="qq-upload-spinner"></span><span class="qq-upload-size"></span><a class="qq-upload-cancel" href="#">Cancel</a><span class="qq-upload-failed-text">Failed</span></li>',
classes:{button:"qq-upload-button",drop:"qq-upload-drop-area",dropActive:"qq-upload-drop-area-active",list:"qq-upload-list",file:"qq-upload-file",spinner:"qq-upload-spinner",size:"qq-upload-size",cancel:"qq-upload-cancel",success:"qq-upload-success",fail:"qq-upload-fail"}});qq.extend(this._options,a);if(this._element=this._options.element)this._element.innerHTML=this._options.template,this._listElement=this._options.listElement||this._find(this._element,"list"),this._classes=this._options.classes,
this._button=this._createUploadButton(this._find(this._element,"button")),this._bindCancelEvent(),this._setupDragDrop()};qq.extend(qq.FileUploader.prototype,qq.FileUploaderBasic.prototype);
qq.extend(qq.FileUploader.prototype,{_find:function(a,b){var c=qq.getByClass(a,this._options.classes[b])[0];if(!c)throw Error("element not found "+b);return c},_setupDragDrop:function(){if(!this._options.allowdrop)return!1;var a=this,b=this._find(this._element,"drop"),c=new qq.UploadDropZone({element:b,onEnter:function(c){qq.addClass(b,a._classes.dropActive);c.stopPropagation()},onLeave:function(a){a.stopPropagation()},onLeaveNotDescendants:function(c){qq.removeClass(b,a._classes.dropActive)},onDrop:function(c){b.style.display=
"none";qq.removeClass(b,a._classes.dropActive);a._uploadFileList(c.dataTransfer.files)}});b.style.display="none";qq.attach(document,"dragenter",function(a){c._isValidFileDrag(a)&&(b.style.display="block")});qq.attach(document,"dragleave",function(a){c._isValidFileDrag(a)&&(a=document.elementFromPoint(a.clientX,a.clientY),a&&"HTML"!=a.nodeName||(b.style.display="none"))})},_onSubmit:function(a,b){qq.FileUploaderBasic.prototype._onSubmit.apply(this,arguments);this._addToList(a,b)},_onProgress:function(a,
b,c,d){qq.FileUploaderBasic.prototype._onProgress.apply(this,arguments);var e=this._getItemByFileId(a);e=this._find(e,"size");e.style.display="inline";var f=c!=d?Math.round(c/d*100)+"% from "+this._formatSize(d):this._formatSize(d);qq.setText(e,f)},_onComplete:function(a,b,c){qq.FileUploaderBasic.prototype._onComplete.apply(this,arguments);var d=this._getItemByFileId(a);qq.remove(this._find(d,"cancel"));qq.remove(this._find(d,"spinner"));c.success?qq.addClass(d,this._classes.success):qq.addClass(d,
this._classes.fail)},_addToList:function(a,b){var c=qq.toElement(this._options.fileTemplate);c.qqFileId=a;var d=this._find(c,"file");qq.setText(d,this._formatFileName(b));this._find(c,"size").style.display="none";this._listElement.appendChild(c)},_getItemByFileId:function(a){for(var b=this._listElement.firstChild;b;){if(b.qqFileId==a)return b;b=b.nextSibling}},_bindCancelEvent:function(){var a=this;qq.attach(this._listElement,"click",function(b){b=b||window.event;var c=b.target||b.srcElement;qq.hasClass(c,
a._classes.cancel)&&(qq.preventDefault(b),b=c.parentNode,a._handler.cancel(b.qqFileId),qq.remove(b))})}});qq.UploadDropZone=function(a){this._options={element:null,onEnter:function(a){},onLeave:function(a){},onLeaveNotDescendants:function(a){},onDrop:function(a){}};qq.extend(this._options,a);this._element=this._options.element;this._disableDropOutside();this._attachEvents()};
qq.UploadDropZone.prototype={_disableDropOutside:function(a){qq.UploadDropZone.dropOutsideDisabled||(qq.attach(document,"dragover",function(a){a.dataTransfer&&(a.dataTransfer.dropEffect="none",a.preventDefault())}),qq.UploadDropZone.dropOutsideDisabled=!0)},_attachEvents:function(){var a=this;qq.attach(a._element,"dragover",function(b){if(a._isValidFileDrag(b)){var c=b.dataTransfer.effectAllowed;b.dataTransfer.dropEffect="move"==c||"linkMove"==c?"move":"copy";b.stopPropagation();b.preventDefault()}});
qq.attach(a._element,"dragenter",function(b){if(a._isValidFileDrag(b))a._options.onEnter(b)});qq.attach(a._element,"dragleave",function(b){if(a._isValidFileDrag(b)){a._options.onLeave(b);var c=document.elementFromPoint(b.clientX,b.clientY);if(!qq.contains(this,c))a._options.onLeaveNotDescendants(b)}});qq.attach(a._element,"drop",function(b){a._isValidFileDrag(b)&&(b.preventDefault(),a._options.onDrop(b))})},_isValidFileDrag:function(a){a=a.dataTransfer;var b=-1<navigator.userAgent.indexOf("AppleWebKit");
return a&&"none"!=a.effectAllowed&&(a.files||!b&&a.types.contains&&a.types.contains("Files"))}};qq.UploadButton=function(a){this._options={element:null,multiple:!1,name:"file",onChange:function(a){},hoverClass:"qq-upload-button-hover",focusClass:"qq-upload-button-focus"};qq.extend(this._options,a);this._element=this._options.element;qq.css(this._element,{position:"relative",overflow:"hidden",direction:"ltr"});this._input=this._createInput()};
qq.UploadButton.prototype={getInput:function(){return this._input},reset:function(){this._input.parentNode&&qq.remove(this._input);qq.removeClass(this._element,this._options.focusClass);this._input=this._createInput()},_createInput:function(){var a=document.createElement("input");this._options.multiple&&a.setAttribute("multiple","multiple");a.setAttribute("type","file");a.setAttribute("name",this._options.name);qq.css(a,{position:"absolute",right:0,top:0,fontFamily:"Arial",fontSize:"118px",margin:0,
padding:0,cursor:"pointer",opacity:0});this._element.appendChild(a);var b=this;qq.attach(a,"change",function(){b._options.onChange(a)});qq.attach(a,"mouseover",function(){qq.addClass(b._element,b._options.hoverClass)});qq.attach(a,"mouseout",function(){qq.removeClass(b._element,b._options.hoverClass)});qq.attach(a,"focus",function(){qq.addClass(b._element,b._options.focusClass)});qq.attach(a,"blur",function(){qq.removeClass(b._element,b._options.focusClass)});window.attachEvent&&a.setAttribute("tabIndex",
"-1");return a}};qq.UploadHandlerAbstract=function(a){this._options={debug:!1,action:"/upload.php",maxConnections:999,onProgress:function(a,c,d,e){},onComplete:function(a,c,d){},onCancel:function(a,c){}};qq.extend(this._options,a);this._queue=[];this._params=[]};
qq.UploadHandlerAbstract.prototype={log:function(a){this._options.debug&&window.console&&console.log("[uploader] "+a)},add:function(a){},upload:function(a,b){var c=this._queue.push(a),d={};qq.extend(d,b);this._params[a]=d;c<=this._options.maxConnections&&this._upload(a,this._params[a])},cancel:function(a){this._cancel(a);this._dequeue(a)},cancelAll:function(){for(var a=0;a<this._queue.length;a++)this._cancel(this._queue[a]);this._queue=[]},getName:function(a){},getSize:function(a){},getQueue:function(){return this._queue},
_upload:function(a){},_cancel:function(a){},_dequeue:function(a){a=qq.indexOf(this._queue,a);this._queue.splice(a,1);var b=this._options.maxConnections;this._queue.length>=b&&a<b&&(a=this._queue[b-1],this._upload(a,this._params[a]))}};qq.UploadHandlerForm=function(a){qq.UploadHandlerAbstract.apply(this,arguments);this._inputs={}};qq.extend(qq.UploadHandlerForm.prototype,qq.UploadHandlerAbstract.prototype);
qq.extend(qq.UploadHandlerForm.prototype,{add:function(a){a.setAttribute("name","qqfile");var b="qq-upload-handler-iframe"+qq.getUniqueId();this._inputs[b]=a;a.parentNode&&qq.remove(a);return b},getName:function(a){return this._inputs[a].value.replace(/.*(\/|\\)/,"")},_cancel:function(a){this._options.onCancel(a,this.getName(a));delete this._inputs[a];if(a=document.getElementById(a))a.setAttribute("src","javascript:false;"),qq.remove(a)},_upload:function(a,b){var c=this._inputs[a];if(!c)throw Error("file with passed id was not added, or already uploaded or cancelled");
var d=this.getName(a),e=this._createIframe(a),f=this._createForm(e,b);f.appendChild(c);var g=this;this._attachLoadEvent(e,function(){g.log("iframe loaded");var b=g._getIframeContentJSON(e);g._options.onComplete(a,d,b);g._dequeue(a);delete g._inputs[a];setTimeout(function(){qq.remove(e)},1)});f.submit();qq.remove(f);return a},_attachLoadEvent:function(a,b){qq.attach(a,"load",function(){a.parentNode&&(a.contentDocument&&a.contentDocument.body&&"false"==a.contentDocument.body.innerHTML||b())})},_getIframeContentJSON:function(a){a=
a.contentDocument?a.contentDocument:a.contentWindow.document;this.log("converting iframe's innerHTML to JSON");this.log("innerHTML = "+a.body.innerHTML);a=a.body.innerHTML;"<pre>"==a.slice(0,5).toLowerCase()&&"</pre>"==a.slice(-6).toLowerCase()&&(a=qq.htmlDec(a.slice(5,-6)));try{var b=eval("("+a+")")}catch(c){b={}}return b},_createIframe:function(a){var b=qq.toElement('<iframe src="javascript:false;" name="'+a+'" />');b.setAttribute("id",a);b.style.display="none";document.body.appendChild(b);return b},
_createForm:function(a,b){var c=qq.toElement('<form method="post" enctype="multipart/form-data"></form>'),d=qq.obj2url(b,this._options.action);c.setAttribute("action",d);c.setAttribute("target",a.name);c.style.display="none";document.body.appendChild(c);return c}});qq.UploadHandlerXhr=function(a){qq.UploadHandlerAbstract.apply(this,arguments);this._files=[];this._xhrs=[];this._loaded=[]};
qq.UploadHandlerXhr.isSupported=function(){var a=document.createElement("input");a.type="file";return"multiple"in a&&"undefined"!=typeof File&&"undefined"!=typeof(new XMLHttpRequest).upload};qq.extend(qq.UploadHandlerXhr.prototype,qq.UploadHandlerAbstract.prototype);
qq.extend(qq.UploadHandlerXhr.prototype,{add:function(a){if(!(a instanceof File))throw Error("Passed obj in not a File (in qq.UploadHandlerXhr)");return this._files.push(a)-1},getName:function(a){a=this._files[a];return null!=a.fileName?a.fileName:a.name},getSize:function(a){a=this._files[a];return null!=a.fileSize?a.fileSize:a.size},getLoaded:function(a){return this._loaded[a]||0},_upload:function(a,b){var c=this._files[a],d=this.getName(a);this.getSize(a);this._loaded[a]=0;var e=this._xhrs[a]=new XMLHttpRequest,
f=this;e.upload.onprogress=function(b){b.lengthComputable&&(f._loaded[a]=b.loaded,f._options.onProgress(a,d,b.loaded,b.total))};e.onreadystatechange=function(){4==e.readyState&&f._onComplete(a,e)};b=b||{};b.qqfile=d;var g=qq.obj2url(b,this._options.action);e.open("POST",g,!0);e.setRequestHeader("X-Requested-With","XMLHttpRequest");e.setRequestHeader("X-File-Name",encodeURIComponent(d));"multipart"==this._options.encoding&&"undefined"!==typeof FormData?(g=new FormData,g.append("qqfile",c),e.send(g)):
(e.setRequestHeader("Content-Type","application/octet-stream"),e.send(c))},_onComplete:function(a,b){if(this._files[a]){var c=this.getName(a),d=this.getSize(a);this._options.onProgress(a,c,d,d);if(200==b.status){this.log("xhr - server response received");this.log("responseText = "+b.responseText);try{var e=eval("("+b.responseText+")")}catch(f){e={}}this._options.onComplete(a,c,e)}else this._options.onComplete(a,c,{});this._files[a]=null;this._xhrs[a]=null;this._dequeue(a)}},_cancel:function(a){this._options.onCancel(a,
this.getName(a));this._files[a]=null;this._xhrs[a]&&(this._xhrs[a].abort(),this._xhrs[a]=null)}});