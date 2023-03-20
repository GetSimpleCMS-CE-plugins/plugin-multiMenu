<?php
 
 
$thisfile=basename(__FILE__, ".php");
 
# register plugin
register_plugin(
	$thisfile, //Plugin id
	'multiMenu', 	//Plugin name
	'1.0.1', 		//Plugin version
	'Multicolor',  //Plugin author
	'https://www.paypal.com/paypalme/multicol0r', //author website
	'Plugin to create multiple menus', //Plugin description
	'pages', //page type - on which admin tab to display
	'showMultiMenu'  //main function (administration)
);
 
 
 
# add a link in the admin tab 'theme'
add_action('pages-sidebar','createSideMenu',array($thisfile,'MultiMenu Settings'));

 

function showMultiMenu() {


	global $SITEURL;
	global $GSADMIN;

	if(isset($_GET['addMultiMenu'])){
		include(GSPLUGINPATH.'multiMenu/addNew.php');

	}else{
		include(GSPLUGINPATH.'multiMenu/settings.php');
	}


	echo '<form action="https://www.paypal.com/cgi-bin/webscr" class="moneyshot" method="post" target="_top" style="display:block;text-align:center;">
        <p style="margin:0;padding:0;margin-bottom:10px;">Support my work:)</p>
        <input type="hidden" name="cmd" value="_s-xclick" />
        <input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL" />
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
        <img alt="" border="0" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" />
        </form>
        ';

	
 

}






function multiMenu($name){

global $MMcount;

	global $SITEURL;

	$files = file_get_contents(GSDATAOTHERPATH.'multiMenu/'.$name.'.json');
    $reJsonFiles = json_decode($files);

if($reJsonFiles->front == 'yes'){

	echo '<h3>'. $reJsonFiles->name.'</h3>';

};


echo '<ul class="'.$name.'">';


	foreach($reJsonFiles->names as $key=>$value){

		 

		if (strpos($reJsonFiles->link[$key], 'https://') !== false || strpos($reJsonFiles->link[$key], 'http://') !== false){ 
		$linker = $reJsonFiles->link[$key];
		}else{
		$linker = $SITEURL.$reJsonFiles->link[$key];
		};


if($reJsonFiles->parents[$key]==''){

echo '<li data-parent="'.$reJsonFiles->parents[$key].'" data-link="'.$reJsonFiles->link[$key].'">
<a href="'.$linker.'">'.$value.'</a><ul class="submenu"></ul></li>';
 
 }else{

echo '<li data-parent="'.$reJsonFiles->parents[$key].'" data-link="'.$reJsonFiles->link[$key].'"><a href="'.$linker.'">'.$value.'</a>';
echo '</li>';
  

	};


	};





echo '</ul>';
	


echo '

<script>


 
document.querySelectorAll("ul.'.$name.' li").forEach((x,i)=>{

if(x.dataset.parent!==""){

document.querySelectorAll(`ul.'.$name.' li[data-link="${x.dataset.parent}"] ul`).forEach((c,e)=>{
	c.appendChild(x);

	});

};


});



	
document.querySelectorAll("ul.'.$name.' ul").forEach((a)=>{
	if(a.innerHTML == ""){
a.remove();
	}});

</script>

';


};




?>