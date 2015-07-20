<?php if(1):?>
    <?php if(!empty($crumbs)):?>
    <div>
        <ul>
        <?php foreach($crumbs as $crumb):?>
            <li>
                <a href="<?=site_url($crumb['url']);?>"><?=$crumb['title']?></a>
            </li>
        <?php endforeach;?>
        </ul>
    </div>
    <?php endif; ?>
<?php endif; ?>