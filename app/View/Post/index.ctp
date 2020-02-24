<!-- body -->
<div class="row">
<div class="col-md-8">
<h4>Recent Posts</h4>
<hr>
<div class="row">
<?php foreach($posts as $row): ?>
<div class="col-md-6 post">
<p class="post-title"><?php echo $row['Post']['title']; ?></p>
<p class="post-body text-justify">
<?php echo $row['Post']['body']; ?>
</p>
<br>
<a class="submit-btn">Read More</a>
</div>
<?php endforeach; ?>

</div>
</div>

<div class="col-md-4">
<h4>Popular Posts</h4>
<hr>
<?php foreach($posts as $row): ?>
<div class="post">
<p class="post-title"><?php echo $row['Post']['title']; ?></p>
<p class="post-body text-justify">
<?php echo $row['Post']['body']; ?>
</p>
<br>
<a class="submit-btn">Read More</a>
</div>
<?php endforeach; ?>
</div>
</div>

