<?php
// auto-generated by sfPropelAdmin
// date: 2008/02/26 13:13:15
?>
<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>
<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('Asignar alumno a grado y secci&oacute;n', 
array()) ?></h1>



<div id="sf_admin_header">
<?php include_partial('relAlumnoDivision/edit_header', array('rel_alumno_division' => $rel_alumno_division)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('relAlumnoDivision/edit_messages', array('rel_alumno_division' => $rel_alumno_division, 'labels' => $labels)) ?>
<?php include_partial('relAlumnoDivision/edit_form', array('rel_alumno_division' => $rel_alumno_division, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('relAlumnoDivision/edit_footer', array('rel_alumno_division' => $rel_alumno_division)) ?>
</div>




</div>
