<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="<?php echo $SITEURL; ?>plugins/multiMenu/js/multiMenu.css" />

<div class="multiMenu">


    <h3 class="lead mt-2 border-bottom pb-3"><?php echo i18n_r('multiMenu/LISTMENU');?></h3>


    <div class="multimenu-add bg-light border p-2 mb-2">
        <a class="btn btn-primary btn-sm text-light text-decoration-none" style="text-decoration:none;"
         href="<?php echo $SITEURL . $GSADMIN; ?>/load.php?id=multiMenu&addMultiMenu"><?php echo i18n_r('multiMenu/ADDMENU');?></a>
    </div>


    <table class="tables text-center">

        <tr>
            <th class="text-center"><?php echo i18n_r('multiMenu/NAME');?></th>
            <th class="text-center"><?php echo i18n_r('multiMenu/CODE');?></th>
            <th class="text-center"><?php echo i18n_r('multiMenu/EDIT');?></th>
            <th class="text-center"><?php echo i18n_r('multiMenu/DELETE');?></th>
        </tr>


        <?php

        foreach (glob(GSDATAOTHERPATH . 'multiMenu/*json') as $file) {

            echo '
    <tr>
    <td style="height:50px;" ><p style="margin:0;line-height:2.2">' . pathinfo($file)['filename'] . '</p></td>
    <td style="padding:5px;background:#fafafa;display:flex;align-items:center;justify-content:center;height:50px"><code >&#x3c;?php multiMenu("' . pathinfo($file)['filename'] . '"); ?&#x3e;</code></td>
    <td style="width:50px;"><a class="btn btn-sm btn-primary text-light" href="' . $SITEURL . $GSADMIN . '/load.php?id=multiMenu&addMultiMenu&menuname=' . pathinfo($file)['filename'] . '  "><i class="fa-solid fa-pen-to-square"></i></a></td>
    <td style="width:50px;"><a class="btn btn-sm btn-danger text-light" href="' . $SITEURL . $GSADMIN . '/load.php?id=multiMenu&delthis=' . pathinfo($file)['filename'] . '  "><i class="fa-solid fa-trash"></i></a></td>
 </tr>';
        }; ?>



    </table>

</div>

<?php



if (isset($_GET['delthis'])) {
    global $SITEURL;
    global $GSADMIN;
    unlink(GSDATAOTHERPATH . 'multiMenu/' . $_GET['delthis'] . '.json');

    echo "
    <script>


        window.location.href = '" . $SITEURL . $GSADMIN . "/load.php?id=multiMenu';


    </script>
    ";
}; ?>
