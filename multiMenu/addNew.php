

<style>
    .multiMenu input{
width: 100%;
padding:5px;
box-sizing: border-box;
margin-top: 5px;
border:#ddd solid 1px;
     }

    .multiMenu{
        display: flex;
        flex-wrap: wrap;
    }

    .multiMenu label{
        margin-left: 5px;
    }

    .multiMenu select{
        width: 80%;
        padding: 10px;
        box-sizing: border-box;
        background: none;
        border:solid 1px #ddd;
        margin-top: 20px;
    }

    .addToMenu{
        display: inline-flex;
        width: 20%;
        margin: 0;
        padding: 10px;
        box-sizing: border-box;
        margin-top: 20px;
        border: none;
        background: #000;
        color:#fff;
        align-items: center;
        justify-content: center;
    }

    .multiMenu input[type="checkbox"]{
        all:revert;s
    }

.multiMenu-ul{
width:100%;
list-style-type:none;
margin: 0 !important;
padding: 0 !important;
 }

.multiMenu-ul li{
    border:solid 1px;
    width: 100%;
    padding:10px;
    background: #fafafa;
    border:solid 1px #ddd;
    box-sizing:border-box;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 20px;
    gap:20px;
    align-items: center;
}

.multiMenu input[type="submit"]{
    background: #000;
    padding: 10px 15px;
margin-top: 10px;
    color:#fff;
}
 

.nameMenu{
    background: #fafafa;
    border:solid 1px #ddd;
    padding: 10px;
}

.closeMM{
    background: red;
    border:none;
    color:#fff;
    width:20px;
    height:20px;
}


.parentHave{
    border-left:solid 5px grey !important;
}
</style>



<form class="multiMenu"method="post" action="<?php 

if(isset($_GET['menuname'])){
    echo $SITEURL.$GSADMIN.'/load.php?id=multiMenu&addMultiMenu&menuname='.$_GET['menuname'];
} 
 


;?>">

<label for="name">Name menu for function without spacebar</label>
<input type="text" name="nameFile" value="<?php echo @$_GET['menuname'];?>" required pattern="[a-zA-Z0-9]+">

<div style="width:100%; margin:10px auto;background:#333; color:#fff !important;border:solid 1px #ddd;padding:10px 0;">
<label for="" style="color:#fff; display:flex; justify-content:space-between;align-items:center;"><span>Show Menu name on frontend?</span><input type="checkbox" class="check" value="yes" name="front"></label>
</div>

<div style="width:100%" class="hidecheck nameMenu">
<label for="name">Name menu on frontend</label>
<input type="text" name="nameFront" value="

<?php 

if(isset($_GET['menuname'])){
    $files = file_get_contents(GSDATAOTHERPATH.'multiMenu/'.$_GET['menuname'].'.json');
    $reJsonFiles = json_decode($files);
    
   echo $reJsonFiles->name;
}


;?>

" >
</div>


<select class="selectMultiMenu">

 <?php 

foreach(glob(GSDATAPAGESPATH.'*.xml') as $file){
$page = getXML($file);


 if(!empty($page->parent)){
    $parents = $page->parent.'/';
    $parentsN = $page->parent;
 }else{
    $parents = "";
    $parentsN='';
 };


echo '<option value="'.$parents.$page->url.'~'.$page->menu.'~'.$parentsN.'"  >'.$page->title.'</option>';
}
;?>
 </select>

 <button class="addToMenu">Add this to menu</button>



 <h3 style="margin-top:20px;">Edit menu</h3>

 

 <ul class="multiMenu-ul" id="sortable" style="text-align:center">
<li>
    <p style="margin:0;padding:0;color: #222;
font-weight: bold;
text-transform: uppercase;
line-height: 20px !important;
text-align: left;font-size:11px;
text-align:center;">Link</p>
    <p style="margin:0;padding:0;color: #222;
font-weight: bold;
text-transform: uppercase;
line-height: 20px !important;
text-align: left;font-size:11px;text-align:center;">Name</p>

    <p style="margin:0;padding:0;color: #222;
font-weight: bold;
text-transform: uppercase;
line-height: 20px !important;
text-align: left;font-size:11px;text-align:center;">Parent Slug</p>
</li>







<?php



if(isset($_GET['menuname'])){
    
foreach($reJsonFiles->link as $key => $value){

    echo '<li data-parent="'.$reJsonFiles->parents[$key].'" data-link="'.$value.'"><input type="text" name="link[]" value="'.$value.'"><input name="names[]" value="'.$reJsonFiles->names[$key].'"><input name="parents[]" value="'.$reJsonFiles->parents[$key].'">
    
    
    <button class="closeMM">X</button>

 
    </li>';


};
}

 

;?>

 </ul>
 

 <input type="submit" name="submit" value="save menu" >
</form>





<script>


document.querySelector('.addToMenu').addEventListener('click',(e)=>{

    e.preventDefault();

    $ars = document.querySelector('.selectMultiMenu').value.split("~");


    const lis = document.createElement('li');

    const inputer = document.createElement('input');

    inputer.setAttribute('type','text');
    inputer.value =  $ars[0];
    inputer.setAttribute('name','link[]');
    
    const inputer2 = document.createElement('input');
    inputer2.value = $ars[1];
    inputer2.setAttribute('name','names[]');


   
    const inputer3 = document.createElement('input');
    inputer3.value = $ars[2];
    inputer3.setAttribute('name','parents[]');

    
    document.querySelector('.multiMenu-ul').appendChild(lis);

    const close = document.createElement('button');
    close.innerHTML = 'X';
  
    close.classList.add('closeMM');


    lis.appendChild(inputer);
    lis.appendChild(inputer2);
    lis.appendChild(inputer3);
    lis.appendChild(close);
    

    
document.querySelectorAll('.closeMM').forEach(x=>{

x.addEventListener('click',e=>{
e.preventDefault();
x.parentElement.remove();
    });

})


 



})


 



document.querySelectorAll('.closeMM').forEach(x=>{

x.addEventListener('click',e=>{
e.preventDefault();
x.parentElement.remove();
    });

})


</script>


<?php 

if(isset($_GET['menuname'])){
    $files = file_get_contents(GSDATAOTHERPATH.'multiMenu/'.$_GET['menuname'].'.json');
    $reJsonFiles = json_decode($files);
    
   echo '<script>

   if("'.$reJsonFiles->front.'" == "yes"){
   document.querySelector(".check").checked = true;
   };
   </script>';
}

;?>


<script>
  $( function() {
    $( "#sortable" ).sortable();
  } );



  document.querySelector('input[name="nameFile"]').addEventListener('keyup',(e)=>{

    document.querySelector('.multiMenu').setAttribute('action', "<?php echo $SITEURL.$GSADMIN.'/load.php?id=multiMenu&addMultiMenu&menuname=';?>" + document.querySelector('input[name="nameFile"]').value);

  });

  
  document.querySelectorAll('.multiMenu-ul li').forEach((x,c)=>{

    if(x.dataset.parent !== '' && c !== 0){
        x.classList.add('parentHave');
    };

  })
  
  </script>

 

<?php 

if(isset($_POST['submit'])){

    


    $data = array();
    $data['name'] = $_POST['nameFront'];
    $data['front'] = @$_POST['front'];
    $data['link'] = array();
    $data['names'] = array();
    $data['parents'] = array();
 
    foreach($_POST['link'] as $key=>$value){
     $data['link'][$key] = $value;
    };

    foreach($_POST['names'] as $key=>$value){
    $data['names'][$key] = $value;
    };



    foreach($_POST['parents'] as $key=>$value){
    $data['parents'][$key] = $value;
    };


    $jsonData = json_encode($data);

 
// Set up the folder name and its permissions
// Note the constant GSDATAOTHERPATH, which points to /path/to/getsimple/data/other/
$folder        = GSDATAOTHERPATH . 'multiMenu/';
$filename      = $folder .$_POST['nameFile'].'.json';
$chmod_mode    = 0755;
$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
 
// Save the file (assuming that the folder indeed exists)
if ($folder_exists) {
  file_put_contents($filename, $jsonData);

  echo("<meta http-equiv='refresh' content='0'>");
};



};


;?>




