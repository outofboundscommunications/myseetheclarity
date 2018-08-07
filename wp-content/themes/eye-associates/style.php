<?php
function dynaminc_css($post_id) {
$page_color = get_field('page_color', $post_id);
?>
<style type="text/css">
/*
body{
	background-color: <?php echo $page_color;?>;
}
*/
</style>
<?php
}
?>