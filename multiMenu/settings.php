<style>
.multimenu-add{
    background: #fafafa;
    border:solid 1px #ddd;
    padding:10px;
    margin-bottom: 10px;
}
    .tables tr{
        display: grid;
        grid-template-columns: 150px 1fr 50px 50px;
        gap:0;
        border:none !important;
        border-bottom: #fafafa solid 1px;
       font-size: 12px;
       
    }

    .tables th{
        text-align: center !important;
    }

    .tables tr{
        text-align: center;
    }
  
</style>

<div class="multimenu-add">
<a href="<?php echo $SITEURL.$GSADMIN;?>/load.php?id=multiMenu&addMultiMenu">Add Menu</a>
</div>


<h3>List Menus</h3>

<table class="tables">

<tr>
<th>name</th>
<th>code</th>
<th>edit</th>
<th>delete</th>
</tr>


<?php 

foreach(glob(GSDATAOTHERPATH.'multiMenu/*json') as $file){

    echo '
    <tr>
    <td>'.pathinfo($file)['filename'].'</td>
    <td style="border:solid 1px #ddd;padding:5px;background:#fafafa;"><code >&#x3c;?php multiMenu("'.pathinfo($file)['filename'].'"); ?&#x3e;</code></td>
    <td><a href="'.$SITEURL.$GSADMIN.'/load.php?id=multiMenu&addMultiMenu&menuname='.pathinfo($file)['filename'].'  ">edit</a></td>
    <td><form action="#" method="post"><input type="hidden" name="delthis" value="'.pathinfo($file)['filename'].'"><input type="submit" style="all:unset;cursor:pointer;text-decoration:underline;" value="delete"  onclick="return confirm(`Are you sure?`);"></form></td>
</tr>';

}

;?>



</table>


<?php 


 
if(isset($_POST['delthis'])){
	
    unlink(GSDATAOTHERPATH.'multiMenu/'.$_POST['delthis'].'.json');
    echo("<meta http-equiv='refresh' content='0'>");

}

;?>