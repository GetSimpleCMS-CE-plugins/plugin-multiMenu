<?php
global $SITEURL;
$checkHideMenu = file_get_contents(GSDATAOTHERPATH . 'multiMenuSettings.json');
$checkHideMenu = json_decode($checkHideMenu, true);

; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="<?php echo $SITEURL; ?>plugins/multiMenu/js/multiMenu.css" />



<form method="post" class="multiMenu">
    <h3>Default menu settings</h3>
    <hr>

    <div class="col-md-12 d-flex justify-content-between align-items-center border p-3 bg-light">
        <label for="" class="m-0 p-0"><?php echo i18n_r('multiMenu/HIDEMENUQUESTION'); ?></label>
        <input id="check" type="checkbox" name="hidemenu" value="true">
    </div>

    <input type="submit" class="full-rounded btn btn-primary btn-sm text-light text-decoration-none my-3" name="save">

</form>

<?php if ($checkHideMenu['hidemenu'] == 'true'): ?>

    <script>
        document.querySelector('[name="hidemenu"]').checked = true;
    </script>

<?php endif; ?>

<?php if (isset($_POST['save'])) {
    $checkHideMenu = file_get_contents(GSDATAOTHERPATH . 'multiMenuSettings.json');
    $checkHideMenu = json_decode($checkHideMenu, true);

    $hidemenu = $_POST['hidemenu'] ?? 'false';
    $checkHideMenu['hidemenu'] = $hidemenu;

    $checkHideMenu = json_encode($checkHideMenu);

    file_put_contents(GSDATAOTHERPATH . 'multiMenuSettings.json', $checkHideMenu);

    echo ("<meta http-equiv='refresh' content='0'>");


}
; ?>