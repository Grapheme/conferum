<?php if(!empty($crumbs)):?>
<div class="breadcrumbs">
    <ul>
    <?php foreach($crumbs as $crumb):?>
        <li>
            <a href="<?=site_url($crumb['url']);?>"><?=$crumb['title']?></a>
        </li>
    <?php endforeach;?>
    </ul>
</div>
<?php endif; ?>