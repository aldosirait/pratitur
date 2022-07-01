var tabButtons=document.querySelectorAll(".tabContainer .buttonContainer button");
var tabPanels=document.querySelectorAll(".tabContainer  .tabPanel");

function showPanel(panelIndex,colorCode) {
    tabButtons.forEach(function(node){
        node.style.backgroundColor="";
        node.style.color="";
    });
    tabButtons[panelIndex].style.backgroundColor=colorCode;
    tabButtons[panelIndex].style.color="white";
    tabPanels.forEach(function(node){
        node.style.display="none";
    });
    tabPanels[panelIndex].style.display="block";
    tabPanels[panelIndex].style.backgroundColor=colorCode;
}
showPanel(0,'#000000FF');




var textBox, initText;
function initDoc() {
  textBox = document.getElementById("textBox");
  initText = textBox.innerHTML;
  
}

function formatDoc(thingtochange, valuetochange) {
  //img.intLink.border="1px solid white";
   document.execCommand(thingtochange, false, valuetochange);
   textBox.focus(); 
}


function start(){
    initDoc();
    onEditorLoad();
    
}


function generator(){
    /*your code here...*/    
    var element = document.createElement("div");
    element.setAttribute("id", "result");
    element.appendChild(document.createTextNode(name));
    document.getElementById("placeholder").appendChild(element);
    /*the ajax code here*/
    var url='urltophpfile/phpfile.php';
    $.get(url,function(data){
        $('#counting').html(data+' Word combinations have been generated so far.');
    });
 }