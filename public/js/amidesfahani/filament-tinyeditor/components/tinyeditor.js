function at({state:y,statePath:m,selector:w,plugins:_,external_plugins:v,toolbar:F,language:A="en",language_url:k=null,directionality:C="ltr",height:E=null,max_height:x=0,min_height:O=100,width:z=null,max_width:T=0,min_width:M=400,resize:P=!1,skin:$="oxide",content_css:B="default",toolbar_sticky:S=!0,toolbar_sticky_offset:Y=64,toolbar_mode:Z="sliding",toolbar_location:tt="auto",inline:et=!1,toolbar_persist:it=!1,menubar:D=!1,font_size_formats:W="",fontfamily:G="",relative_urls:K=!0,image_list:V=null,image_advtab:H=!1,image_description:J=!1,image_class_list:L=null,images_upload_url:U=null,images_upload_base_path:p=null,remove_script_host:j=!0,convert_urls:q=!0,custom_configs:I={},setup:h=null,disabled:nt=!1,locale:ot="en",license_key:N="gpl",placeholder:st=null,removeImagesEventCallback:a=null}){let c=window.filamentTinyEditors||{};return{id:null,state:y,statePath:m,selector:w,language:A,language_url:k,directionality:C,height:E,max_height:x,min_height:O,width:z,max_width:T,min_width:M,resize:P,skin:$,content_css:B,plugins:_,external_plugins:v,toolbar:F,toolbar_sticky:S,menubar:D,relative_urls:K,remove_script_host:j,convert_urls:q,font_size_formats:W,fontfamily:G,setup:h,image_list:V,image_advtab:H,image_description:J,image_class_list:L,images_upload_url:U,images_upload_base_path:p,license_key:N,custom_configs:I,updatedAt:Date.now(),disabled:nt,locale:ot,placeholder:st,removeImagesEventCallback:a,init(){this.delete(),this.initEditor(y.initialValue),window.filamentTinyEditors=c,this.$watch("state",(o,l)=>{o==="<p></p>"&&o!==this.editor()?.getContent()&&(this.editor()&&this.editor().destroy(),this.initEditor(o)),this.editor()?.container&&o!==this.editor()?.getContent()&&(this.updateEditorContent(o||""),this.putCursorToEnd())})},editor(){return tinymce.get(c[this.statePath])},initEditor(o){let l=this,Q=this.$wire,R=G||"Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; AkrutiKndPadmini=Akpdmi-n",rt={selector:w,language:A,language_url:k,directionality:C,statusbar:!1,promotion:!1,height:E,max_height:x,min_height:O,width:z,max_width:T,min_width:M,resize:P,skin:$,content_css:B,plugins:_,external_plugins:v,toolbar:F,toolbar_sticky:S,toolbar_sticky_offset:Y,toolbar_mode:Z,toolbar_location:tt,inline:et,toolbar_persist:it,menubar:D,menu:{file:{title:"File",items:"newdocument restoredraft | preview | export print | deleteallconversations"},edit:{title:"Edit",items:"undo redo | cut copy paste pastetext | selectall | searchreplace"},view:{title:"View",items:"code | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments"},insert:{title:"Insert",items:"image link media addcomment pageembed codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime"},format:{title:"Format",items:"bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat"},tools:{title:"Tools",items:"spellchecker spellcheckerlanguage | a11ycheck code wordcount"},table:{title:"Table",items:"inserttable | cell row column | advtablesort | tableprops deletetable"},help:{title:"Help",items:"help"}},font_size_formats:W||"8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt",fontfamily:R,font_family_formats:R,relative_urls:K,remove_script_host:j,convert_urls:q,image_list:V,image_advtab:H,image_description:J,image_class_list:L,images_upload_url:U,images_upload_base_path:p,license_key:N,...I,setup:function(t){window.tinySettingsCopy||(window.tinySettingsCopy=[]),t.settings&&!window.tinySettingsCopy.some(n=>n.id===t.settings.id)&&window.tinySettingsCopy.push(t.settings),t.on("blur",function(n){l.updatedAt=Date.now(),l.state=t.getContent()}),t.on("change",function(n){l.updatedAt=Date.now(),l.state=t.getContent()}),t.on("init",function(n){c[l.statePath]=t.id,o!=null&&t.setContent(o)}),t.on("OpenWindow",function(n){let s=n.target.container.closest(".fi-modal");s&&s.setAttribute("x-trap.noscroll","false")}),t.on("CloseWindow",function(n){let s=n.target.container.closest(".fi-modal");s&&s.setAttribute("x-trap.noscroll","isOpen")}),typeof h=="function"&&h(t)},images_upload_handler:(t,n)=>new Promise((s,g)=>{if(!t.blob())return;let d=(i,e)=>i?i.replace(/\/$/,"")+"/"+e.replace(/^\//,""):e,X=()=>{Q.getFormComponentFileAttachmentUrl(m).then(i=>{if(!i){g("Image upload failed");return}s(d(p,i))})},r=()=>{},u=i=>{n(i.detail.progress)};Q.upload(`componentFileAttachments.${m}`,t.blob(),X,r,u)}),init_instance_callback:function(t){var n=window.MutationObserver||window.WebKitMutationObserver||window.MozMutationObserver,s=a&&typeof a=="function";if(s){var g=new n(function(d,X){var r=[];d.forEach(function(i){Array.from(i.addedNodes).forEach(function(e){if(e.nodeName==="IMG"&&e.className!=="mce-clonedresizable"){if(r.indexOf(e.src)>=0)return;r.push(e.getAttribute("src"));return}var b=e.getElementsByTagName("img");Array.from(b).forEach(function(f){r.indexOf(f.src)>=0||r.push(f.getAttribute("src"))})})});var u=[];d.forEach(function(i){Array.from(i.removedNodes).forEach(function(e){if(e.nodeName==="IMG"&&e.className!=="mce-clonedresizable"){if(u.indexOf(e.src)>=0)return;u.push(e.getAttribute("src"));return}if(e.nodeType===1){var b=e.getElementsByTagName("img");Array.from(b).forEach(function(f){r.indexOf(f.src)>=0||r.push(f.getAttribute("src"))})}})}),u.forEach(function(i){r.indexOf(i)>=0||a&&typeof a=="function"&&a(i)})});g.observe(t.getBody(),{childList:!0,subtree:!0})}},automatic_uploads:!0};tinymce.init(rt)},updateEditorContent(o){this.editor().setContent(o)},putCursorToEnd(){this.editor().selection.select(this.editor().getBody(),!0),this.editor().selection.collapse(!1)},delete(){c[this.statePath]&&(this.editor().destroy(),delete c[this.statePath])}}}export{at as default};
