<?php
/**
 *    This file is part of Alba.
 * 
 *    Alba is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 2 of the License, or
 *    (at your option) any later version.
 *
 *    Alba is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with Alba; if not, write to the Free Software
 *    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
/**
 * instalador
 *
 * @package    alba
 * @author     José Luis Di Biase <josx@interorganic.com.ar>
 * @author     Héctor Sanchez <hsanchez@pressenter.com.ar>
 * @author     Fernando Toledo <ftoledo@pressenter.com.ar>
 * @version    SVN: $Id: instalar.php 4883 2007-07-30 21:41:42Z ftoledo $
 * @filesource
 * @license GPL
 */

session_start();

define ('ALBA_INSTALLER',1);

define ('IMG_OK','<img src="images/ok.png" title="Correcto" alt="Correcto">');
define ('IMG_ERROR', '<img src="images/error.png" title="Incorrecto" alt="Incorrecto">');


if (!isset($_GET['paso']))
    $paso = 1;
else
    $paso = $_GET['paso'];
    
$error_flag = false;
$completo = false;


function AlbaPath() {
    return realpath(dirname(__FILE__) .DIRECTORY_SEPARATOR. ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
}

function DebugLog($str) {
    $log = AlbaPath() . DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR . "install.log";
    $fp = fopen($log,"a+");
    if ($fp) {
        fwrite($fp,date('d/m/Y H:i:s') . " $str\n");
        fclose($fp);
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2000/REC-xhtml1-200000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="title" content="Proyecto ALBA" />
        <meta name="robots" content="index, follow" />
        <meta name="description" content="Proyecto de Gesti&oacute;n Educativa ALBA" />
        <meta name="keywords" content="alba, proyecto, software libre, educacion" />
        <meta name="language" content="es" />
    </head>
    <body>
        <div id="cabeza">
        <h1>Instalaci&oacute;n de ALBA</h1>
        </div>
        <div id="contenido">
            <?php
                switch ($paso) {
                    case 1:
                        include ("paso1.php");
                        break;
                    case 2:
                        include ("paso2.php");
                        break;
                    case 3:
                        include ("paso3.php");
                        break;
                }
            ?>
        </div>
        <br/>
        <?php if (!$error_flag && !$completo): ?>
            <div id="siguiente">
                <form method="get" action="instalar.php">
                <input type="hidden" name="paso" value="<?php echo $paso?>">
                <input type="submit" name="btSiguiente" value="Siguiente">
                </form>
            </div>
        <?php endif;?>
    </body>
</html>

