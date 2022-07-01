<?php

/** @var Connection $connection */
$connection = require_once 'pdo.php';
// Read notes from database
$notes = $connection->getNotes();
$pen = $connection->getPendapat();

$currentNote = [
    'id' => '',
    'title' => '',
    'description' => ''
];
if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "dbpratitur";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$username   = "";
$text       = "";
$sukses     = "";
$error      = "";

if (isset($_POST['simpan'])){
  $username = $_POST['username'];
  $text     = $_POST['text'];
  if($username && $text){
    $sql1   = "insert into pendapat(username,text) values ('$username','$text')";
    $q1     = mysqli_query($koneksi, $sql1);
    if ($q1) {
      $sukses     = "Berhasil memasukkan data baru";
      header("Refresh:0");
  } else {
      $error      = "Gagal memasukkan data";
  }
}
} else {
$error = "Silakan masukkan semua data";
  }
  
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tabs</title>
    <link rel="stylesheet" type="text/css" href="css.css">
	<link rel="icon" type="image/x-icon" href="favicon.png">
    
</head>
<body style="height: 10000px;"  onload="start()">
  
<h1 class="title">Pratitur</h1>
<h3 class='title1'>Bebas berekspresi dengan kata-kata</h3>

<div class="tabContainer">
    <div class="nav"  id="myHeader">
    <div class="buttonContainer">
        <button onclick="showPanel(0,'#000000FF')">Tutur Kata</button>
        <button onclick="showPanel(1,'#000000FF')">Tukar Pendapat</button>
    </div>
    </div><br><br><br>
    <div class="tabPanel">
        <form action="create.php" method="post">
        <input type="hidden" name="id" value="<?php echo $currentNote['id'] ?>"></input>
        <input class="input" placeholder="username" required type="text" name="title" placeholder="Note title" autocomplete="off"
               value="<?php echo $currentNote['title'] ?>"></input><br><br>
        <textarea name="description" id="myTextarea" class="myTextarea"  cols="30" rows="4"
                  ><?php echo $currentNote['description'] ?></textarea>
        <!-- <div class="rt">
        <div id="toolBar1" class="rt">
          <select onchange="formatDoc('fontname',this[this.selectedIndex].value);">
          <option class="heading" selected>Font</option>
          <option>Arial</option>
          <option>Arial Black</option>
          <option>Courier New</option>
          <option>Times New Roman</option>
          </select>
          <select onchange="formatDoc('fontsize',this[this.selectedIndex].value);">
          <option class="heading" selected>Font size</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          </select>
          <select onchange="formatDoc('forecolor',this[this.selectedIndex].value);">
          <option class="heading" selected>Font color</option>
          <option value="red">Red</option>
          <option value="blue">Blue</option>
          <option value="green">Green</option>
          <option value="black">Black</option>
          <option value="yellow">Yellow</option>
          </select>
          
          </div>
          <div id="toolBar2">
          <img class="intLink" title="Clean" onclick="if(1){textBox.innerHTML=initText}; " src="icons/clean.svg" />
          <img class="intLink" title="Undo" onclick="formatDoc('undo');" src="icons/undo.svg" />
          <img class="intLink" title="Redo" onclick="formatDoc('redo');" src="icons/redo.svg" />
          <img class="intLink" title="Remove formatting" onclick="formatDoc('removeFormat')" src="icons/format.svg">
          <img class="intLink" title="Bold" onclick="formatDoc('bold');" src="icons/bold.svg" />
          <img class="intLink" title="Italic" onclick="formatDoc('italic');" src="icons/italic.svg" />
          <img class="intLink" title="Underline" onclick="formatDoc('underline');" src="icons/underline.svg" />
          <img class="intLink" title="Left align" onclick="formatDoc('justifyleft');" src="icons/justifyleft.svg" />
          <img class="intLink" title="Center align" onclick="formatDoc('justifycenter');" src="icons/justifycenter.svg" />
          <img class="intLink" title="Right align" onclick="formatDoc('justifyright');" src="icons/justifyright.svg" />
          <img class="intLink" title="Numbered list" onclick="formatDoc('insertorderedlist');" src="icons/numberedlist.svg" />
          <img class="intLink" title="Dotted list" onclick="formatDoc('insertunorderedlist');" src="icons/dottedlist.svg" />
        
          <img class="intLink" title="Add indentation" onclick="formatDoc('indent');" src="icons/indent.svg" />
          <img class="intLink" title="Paragraph" onclick="formatDoc('formatblock','p')" src="icons/pilcrow.svg" />
        
          </div>
          <div class="ta" id="textBox" contenteditable="true"></div><br><br>
         
      
        </div> <br>
        
       --> <br>
     <button class="submit">
     <?php if ($currentNote['id']): ?>
                Update
            <?php else: ?>
              Post
            <?php endif ?>
     </button>><br><br>
    </form>
    <?php foreach ($notes as $note): ?>
    <div class="box">
   
    <div class="description">
                    <?php echo $note['description'] ?>
                </div>
                <hr>
                <div class='btmpost'>
  <small href="?id=<?php echo $note['id'] ?>">
                        <?php echo $note['title'] ?></small>
  <small><?php echo date('d/m/Y H:i', strtotime($note['create_date'])) ?></small>
</div>
               
   
</div>
<br><br>

<?php endforeach; ?>
  </div>
   
    <div class="tabPanel"> 
      <form id=""   action="" method="post">
      <input class="input2" placeholder="username" required id="username" name="username">
      <div class="richtext">
        
    <br>
        <textarea id="editor" class="default" contenteditable="true" name="text"> </textarea>
   
        <span id="counter"></span>
    </div><br>
    
    <input type="submit" class="submit" name="simpan" value="Submit">
    </form> <br>
    <?php foreach ($pen as $pendapat): ?>
    <div class="box">
   
    <div class="description">
                    <?php echo $pendapat['text'] ?>
                </div>
                <hr>
                <div class='btmpost'>
                  <hr>
  <small >
                        <?php echo $pendapat['username'] ?></small>
 
</div>
               
   
</div>
<br><br>

<?php endforeach; ?>
</div>


</div>


<script src="myScript.js"></script>
<script src='tinymce/js/tinymce/tinymce.min.js'></script>
<script>
tinymce.init({
  selector: 'textarea#myTextarea',
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    /*content_css: '//www.tiny.cloud/css/codepen.min.css',*/
    link_list: [
        { title: 'My page 1', value: 'https://www.codexworld.com' },
        { title: 'My page 2', value: 'https://www.xwebtools.com' }
    ],
    image_list: [
        { title: 'My page 1', value: 'https://www.codexworld.com' },
        { title: 'My page 2', value: 'https://www.xwebtools.com' }
    ],
    image_class_list: [
        { title: 'None', value: '' },
        { title: 'Some class', value: 'class-name' }
    ],
    importcss_append: true,
    file_picker_callback: function (callback, value, meta) {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
            callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
        }
    
        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
            callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
        }
    
        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
            callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
        }
    },
    templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
        { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
        { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_mode: 'sliding',
    contextmenu: "link image imagetools table",
});
</script>
<script>
  
    window.onscroll = function() {myFunction()};
    
    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;
    
    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
    </script>
    <script>
      var frmMain = document.getElementById("idk");
      frmMain.onsubmit = function() {
        var requiredDiv = document.getElementById("editor");
        if (requiredDiv.innerHTML.trim().length == 0) {
          alert("Harap isi semua field");
          return false;
        }
      };
    </script>

 
 
</body>
</html>