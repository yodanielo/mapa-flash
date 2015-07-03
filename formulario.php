<?php
/*
 * contacto.php
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$protects = array('_REQUEST', '_GET', '_POST', '_COOKIE', '_FILES', '_SERVER', '_ENV', 'GLOBALS', '_SESSION');
foreach ($protects as $protect) {
    if ( in_array($protect , array_keys($_REQUEST)) ||
        in_array($protect , array_keys($_GET)) ||
        in_array($protect , array_keys($_POST)) ||
        in_array($protect , array_keys($_COOKIE)) ||
        in_array($protect , array_keys($_FILES))) {
        die("Invalid Request.");
    }
}

/**
 * used to leave the input element without trim it
 */
define( "_MOS_NOTRIM", 0x0001 );
/**
 * used to leave the input element with all HTML tags
 */
define( "_MOS_ALLOWHTML", 0x0002 );
/**
 * used to leave the input element without convert it to numeric
 */
define( "_MOS_ALLOWRAW", 0x0004 );
/**
 * used to leave the input element without slashes
 */
define( "_MOS_NOMAGIC", 0x0008 );

function mosgetparam( &$arr, $name, $def=null, $mask=0 ) {
    if (isset( $arr[$name] )) {
        if (is_array($arr[$name])) foreach ($arr[$name] as $key=>$element) $result[$key] = mosGetParam ($arr[$name], $key, $def, $mask);
        else {
            $result = $arr[$name];
            if (!($mask&_MOS_NOTRIM)) $result = trim($result);
            if (!is_numeric( $result)) {
                if (!($mask&_MOS_ALLOWHTML)) $result = strip_tags($result);
                if (!($mask&_MOS_ALLOWRAW)) {
                    if (is_numeric($def)) $result = intval($result);
                }
            }
            if (!get_magic_quotes_gpc()) {
                $result = addslashes( $result );
            }
        }
        return $result;
    } else {
        return $def;
    }
}
if(mosgetparam($_POST,"nombre","")!=""){
    $a_email="prueba09@edmultimedia.net";
    $eol="\r\n";
    $now = mktime().".".md5(rand(1000,9999));
    $headers = "From:".$a_email.$eol."To:".$a_email.$eol;
    $headers .= 'Return-Path: '.$a_email.'<'.$a_email.'>'.$eol;
    $headers .= "Message-ID: <".$now." TheSystem@".$_SERVER['SERVER_NAME'].">".$eol;
    $headers .= "X-Mailer: PHP v".phpversion().$eol;
    $headers .= "Content-Type: text/html; charset=iso-8859-1".$eol;
    $mensaje = "";
    $mensaje .= '<table align="left">'.$eol;
    $mensaje .= '	<tr><td align="left" colspan="2">'.mosgetparam($_POST,"nombre","").' desea comunicarse con usted</td></tr>'.$eol;
    $mensaje .= '	<tr><th align="left">Nombre:</th><td>'.mosgetparam($_POST,"nombre","").'</td></tr>'.$eol;
    $mensaje .= '	<tr><th align="left">Email:</th><td align="left">'.mosgetparam($_POST,"email","").'</td></tr>'.$eol;
    $mensaje .= '	<tr><th align="left">Message:</th><td align="left">'.mosgetparam($_POST,"message","").'</td></tr>'.$eol;
    $mensaje .= '</table>'.$eol;
    $resultado=mail($a_email, "CONTACTO", $mensaje, $headers);
}
?>

