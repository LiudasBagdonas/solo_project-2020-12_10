<main>
   <div class="poo_wall_box">
       <div class="hanky_box"></div>
<?php if (!empty($data)): ?>

<?php foreach ($data['items'] as $item_index => $item): ?>
     <section class="poo_box bg_<?php print $item['color']; ?>" style="
              top: <?php print $item['yaxes']; ?>px;
                left: <?php print $item['xaxes']; ?>px;">
          <span></span>
 </section>

<?php endforeach; ?>
<?php endif; ?>
</div>
</main>