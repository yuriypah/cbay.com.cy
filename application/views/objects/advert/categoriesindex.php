<div id="advert-categories-map" class="indexPage">
    <?php $i = 0; ?>
    <?php foreach ($data as $row): ?>
        <?php
        $i++;
        $children = $row->children();
        $link = URL::query(array('c' => $row->id));
        $categoryWithIcons = array(2, 1, 6, 8, 7, 3, 4, 5, 20, 19, 25,88);
        ?>
        <dl>
            <dt>
                <?php
                if (in_array($row->id, $categoryWithIcons)) {
                    echo "<span class='categoryIndex cIndex" . $row->id . "'></span>";
                }
                ?>
                <?php echo HTML::anchor('/adverts/' . $link, $row->title); ?>
            </dt>
            <?php if (!empty($children)): ?>
                <?php foreach ($children as $category): ?>
                    <?php
                    $link = URL::query(array('c' => $category->id));
                    ?>
                    <dd class="subCategory_link">

                        <?php
                        echo "<span class='categoryIndex subCategory'>&rarr;</span>";
                        echo HTML::anchor('/adverts/' . $link, $category->title); ?>
                    </dd>
                <?php endforeach; ?>
            <?php endif; ?>
        </dl>
        <?php if (($i % 4) == 0): ?>
            <div class="clear"></div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>