<div>
<button type="button" onclick="document.getElementById('wysiwygeditor').innerHTML = document.getElementById('texteditor').value;document.getElementById('wysiwyg').style.display = 'block';document.getElementById('text').style.display = 'none';">design</button>
<button type="button" onclick="document.getElementById('texteditor').value = document.getElementById('wysiwygeditor').innerHTML;document.getElementById('wysiwyg').style.display = 'none';document.getElementById('text').style.display = 'block';">source</button>
</div>
<div id="wysiwyg" style="display:block">
<div>
<button type="button" unselectable="on" onclick='document.execCommand("bold",false,null);'><B>Bold</B></button>
<button type="button" unselectable="on" onclick='document.execCommand("formatblock", false, "<h1>");'>H1</button>
<button type="button" unselectable="on" onclick='document.execCommand("formatblock", false, "<h2>");'>H2</button>
<!--button type="button" unselectable="on" onclick='var image = window.showModalDialog("/cmsdev/upload/edit/","","scroll:0;status:0;");if(image){document.execCommand("insertimage",false,image);}'>Image</button-->
<button type="button" unselectable="on" onclick='window.open("/cmsdev/upload/edit/","","width=500,height=500,scrollbars=no,status=no")'>Image</button>
<!--
sendClickLog(this,'画像の追加');return editor.execCommand('insertimage');
-->

</div>
<div id="wysiwygeditor" contenteditable="true" style="overflow:auto; word-wrap:break-word; width:100%;height:200px;border-style:solid;border-width:1px;"></div>
</div>
<div id="text" style="display:none">
<textarea id="texteditor" style="overflow:auto; word-wrap:break-word; width:100%;height:200px;border-style:solid;border-width:1px;">
</textarea>
</div>
<script>
//http://archiva.jp/test/html/wysiwyg.html
//document.getElementById('editor').style.display = 'none';
document.getElementById('wysiwygeditor').innerHTML = document.getElementById('editor').value;
document.getElementById('edit').onsubmit = function() {
if (document.getElementById('wysiwyg').style.display == 'block') {
	document.getElementById('editor').value = document.getElementById('wysiwygeditor').innerHTML;
} else {
	document.getElementById('editor').value = document.getElementById('texteditor').value
}
return true;
};
</script>
