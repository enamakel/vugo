<?php if(is_array($bradcrumbs) && count($bradcrumbs)>0): ?>
<ol class="breadcrumb ng-scope">
    <?php $last = array_pop($bradcrumbs); ?>
    <?php foreach ($bradcrumbs as $key=>$value): ?>
    <li>
        <a href="<?php echo HTTP_BASE_URL.$key?>"><?php echo $value?></a>
    </li>
    <?php endforeach; ?>
    <li class="active">
        <?php echo $last?>
    </li>
</ol>
<?php endif; ?>