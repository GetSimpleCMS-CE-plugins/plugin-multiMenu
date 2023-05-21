<?php

	$thisfile = basename(__FILE__, ".php");

	# register plugin
	register_plugin(
		$thisfile, //Plugin id
		'MultiMenu', 	//Plugin name
		'2.0', 		//Plugin version
		'Multicolor',  //Plugin author
		'https://www.paypal.com/paypalme/multicol0r', //author website
		'Plugin to create multiple menus', //Plugin description
		'pages', //page type - on which admin tab to display
		'showMultiMenu'  //main function (administration)
	);

	i18n_merge('multiMenu') || i18n_merge('multiMenu', 'en_US');


	# add a link in the admin tab 'theme'
	add_action('pages-sidebar', 'createSideMenu', array($thisfile, 'MultiMenu 🚩'));

	function showMultiMenu(){

		global $SITEURL;
		global $GSADMIN;

		if (isset($_GET['addMultiMenu'])) {
			include(GSPLUGINPATH . 'multiMenu/addNew.php');
		} else {
			include(GSPLUGINPATH . 'multiMenu/settings.php');
		}

		echo '<form style="background:#fafafa; border:solid 1px #ddd; text-align:center; padding:10px;" action="https://www.paypal.com/cgi-bin/webscr" class="moneyshot" method="post" target="_top" style="display:block;text-align:center;">
			<p style="margin:0;padding:0;margin-bottom:10px;">'.i18n_r('multiMenu/PAYPAL').'</p>
			<input type="hidden" name="cmd" value="_s-xclick" />
			<input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL" />
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
			<img alt="" border="0" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" />
			</form>
<small style="text-align:center;width:100%;display:block;margin-top:10px;">
			<a href="https://www.jqueryscript.net/menu/Drag-Drop-Menu-Builder-For-Bootstrap.html">'.i18n_r('multiMenu/INFO').'</a>
</small>
			';
	}

	add_action('footer', 'hideMenu');

	function hideMenu(){
		echo '<style> #metadata_window p.post-menu{display:none}
		 #menu-items{display:none !important}
		 #sb_menumanager{display:none !important}
		</style>';
	};

	function multiMenu($name){

		global $SITEURL;

		$files = file_get_contents(GSDATAOTHERPATH . 'multiMenu/' . $name . '.json');
		$class = file_get_contents(GSDATAOTHERPATH . 'multiMenu/folderClass/' . $name . '-class.json');
		$jsClass = json_decode($class);
		$reJsonFiles = json_decode($files);

		echo '<ul class="' . $jsClass->classul . '">';

		global $SITEURL;
		foreach ($reJsonFiles as $item) {

			if (strpos($item->href, 'http') !== false) {
				$check = GSDATAPAGESPATH . 'index.xml';
			} else {
				$check = GSDATAPAGESPATH . $item->href . '.xml';
			};

			$xml = @simplexml_load_file($check);

			if (file_exists($check)) {

				echo '
				<li class="' . ($jsClass->active == 'li' ? (return_page_slug() == $item->href ? 'active current' : '') : "") . ' ' . $jsClass->classulli . ' ' . (isset($item->children) ? 'parent' : '') . '">
					<a href="'
					. (strpos($item->href, 'http') ?  find_url($item->href, (string)$xml->parent) : $item->href) .

					'" target="' . $item->target . '" class="' . ($jsClass->active == 'a' ? (return_page_slug() == $item->href ? 'active current' : '') : "") . ' ' . $jsClass->classullia . '">' . $item->text . '</a>';

				if (isset($item->children)) {
					echo '
					<ul class="' . $jsClass->classulliul . '">';
					foreach ($item->children as $subitem) {

						if (strpos($subitem->href, 'http') !== false) {
							$checkSub = GSDATAPAGESPATH . 'index.xml';
						} else {
							$checkSub = GSDATAPAGESPATH . $subitem->href . '.xml';
						};

						$xmlSub = @simplexml_load_file($checkSub);

						if (file_exists($checkSub)) {
							echo '
							<li class="' . $jsClass->classulliulli . ' ' . ($jsClass->active == 'li' ? (return_page_slug() == $subitem->href ? 'active current' : '') : "") . '">
								<a  class="' . ($jsClass->active == 'a' ? (return_page_slug() == $subitem->href ? 'active current' : '') : "") . ' ' . $jsClass->classulliullia . '"
							href="' .  (strpos($subitem->href, 'http') ?  find_url($subitem->href, (string)$xmlSub->parent) : $subitem->href) . '" target="' . $subitem->target . '">' . $subitem->text . '</a>';
						};

						//sub-sub
						if (isset($subitem->children)) {
							echo '
							<ul class="' . $jsClass->classulliul . '">';
							foreach ($subitem->children as $subsubitem) {

								if (strpos($subsubitem->href, 'http') !== false) {
									$checkSubSub = GSDATAPAGESPATH . 'index.xml';
								} else {
									$checkSubSub = GSDATAPAGESPATH . $subsubitem->href . '.xml';
								};

								$xmlSubSub = @simplexml_load_file($checkSubSub);

								if (file_exists($checkSubSub)) {
									echo '
									<li class="' . $jsClass->classulliulli . ' ' . ($jsClass->active == 'li' ? (return_page_slug() == $subsubitem->href ? 'active current' : '') : "") . '">
									<a href="' . (strpos($subsubitem->href, 'http') ?  find_url($subsubitem->href, (string)$xmlSubSub) : $subsubitem->href) . '"
									 class="' . ($jsClass->active == 'a' ? (return_page_slug() == $subsub->href ? 'active current' : '') : "") . ' ' . $jsClass->classulliullia . '"
									   target="' . $subsubitem->target . '">' . $subsubitem->text . '</a>
									   </li>';
								};
							};
							echo '
							</ul>';
						};

						echo '
						</li>';
					};
					echo '
					</ul>';
				};

				echo '
				</li>';
			};
		};

		echo '
		</ul>';
	};
