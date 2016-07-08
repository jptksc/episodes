<article id="<?php echo($post['id']); ?>" class="episode <?php echo($post['class']); ?>">
	<div class="video">
    	<a class="icon play open start count" href="#video" data-video-type="<?php echo($post['video_type']); ?>" data-video-id="<?php echo($post['video_id']); ?>" data-video="<?php echo($post['id']); ?>" data-meta="plays" style="background-image: url('<?php echo($post['image']); ?>');"></a>
    </div>
    <div class="copy">
        <h2><?php echo($post['title']); ?></h2>
        <p><?php echo($post['text']); ?></p>
        <span class="details">Posted <?php time_ago($post['date']); ?> | <a class="more open" href="#more" data-video-type="<?php echo($post['video_type']); ?>" data-video-id="<?php echo($post['video_id']); ?>" data-video="<?php echo($post['id']); ?>" data-video="<?php echo($post['id']); ?>" data-meta="plays">Read More</a></span>

        <div class="actions">
            <div class="action plays">
                <span><?php get_count('plays', $post['id']); ?></span>
                <a class="icon play open start count" href="#video" data-video-type="<?php echo($post['video_type']); ?>" data-video-id="<?php echo($post['video_id']); ?>" data-video="<?php echo($post['id']); ?>" data-meta="plays"></a>
            </div>
            <div class="action loves">
                <span><?php get_count('loves', $post['id']); ?></span>
                <a class="icon love count" href="#" data-video="<?php echo($post['id']); ?>" data-meta="loves"></a>
            </div>
        </div>
    </div>
</article>