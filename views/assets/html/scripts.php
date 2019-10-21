<?php // prism scripts, only add for blog_post page ?>
<?php
if($filename == "blog_post") {
    echo '<script src="/views/resources/prism/prism.js"></script>';
}
?>

<?php // main scripts ?>
<script src="/views/assets/js/script.js?v=2"></script>
<?php
// only add page js if exists
if(in_array($filename . ".js", scandir(dirname(__FILE__) . "/../js/pages/"))) {
    echo '<script src="/views/assets/js/pages/' . $filename . '.js?v=2"></script>';
}
?>
<?php // lazyload scripts ?>
<script src="/views/assets/js/lazyload.js?v=2"></script>