<?php 
if(!defined('EMLOG_ROOT')) {exit('error!');}
foreach($logs as $value):
?>
	<div class="post">
		<h2><?php topflg($value['top']); ?><a href="./?post=<?php echo $value['logid']; ?>"><?php echo $value['log_title']; ?></a></h2>
			<div class="date">Post by <?php blog_author($value['author']); ?> <?php echo date('Y-n-j G:i l', $value['date']); ?> <?php editflg($value['logid'],$value['author']); ?></div>
					<div class="entry">
						<p><?php echo $value['log_description']; ?></p>
						<p><?php blog_att($value['logid']); ?></p>
						<p><?php blog_tag($value['logid']); ?></p>
						<div class="commentbubble">
						<a href="./?post=<?php echo $value['logid']; ?>#comment"><?php echo $value['comnum']; ?></a>
						</div>
						
						<p class="postmetadata">
						<?php blog_sort($value['sortid'], $value['logid']); ?><br>
						<a href="./?post=<?php echo $value['logid']; ?>#tb">引用(<?php echo $value['tbcount']; ?>)</a> 
						<a href="./?post=<?php echo $value['logid']; ?>">浏览(<?php echo $value['views']; ?>)</a>
						</p>
					</div>
			</div>
<?php endforeach; ?>
<div class="navigation">
<?php echo $page_url;?>				
</div>
</div>
<?php 
include getViews('side');
include getViews('footer'); 
?>