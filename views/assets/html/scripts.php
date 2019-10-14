<?php // prism scripts, only add for blog_post page ?>
<?php
if($filename == "blog_post") {
    echo '<script src="/views/resources/prism/prism.js"></script>';
}
?>

<?php // lazyload scripts ?>
<script src="https://cdn.jsdelivr.net/npm/intersection-observer@0.7.0/intersection-observer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.1.0/dist/lazyload.min.js"></script>

<?php // main scripts ?>
<script src="/views/assets/js/script.js"></script>
<?php
// only add page js if exists
if(in_array($filename . ".js", scandir(dirname(__FILE__) . "/../js/pages/"))) {
    echo '<script src="/views/assets/js/pages/' . $filename . '.js"></script>';
}
?>