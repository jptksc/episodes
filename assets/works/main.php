<?php

include('settings.php');

/***********************************************************************************
  
The Header
  
************************************************************************************/

if(is_readable('./assets/images/' . $site['logo'])) {
    $header['logo'] = true;
}

/***********************************************************************************
  
The About Panel
  
************************************************************************************/

if(is_readable('./assets/images/' . $about['profile'])) {
    $about['profile_image'] = true;
}

if(is_readable('./assets/images/' . $about['signature'])) {
    $about['signature_image'] = true;
}

/***********************************************************************************
  
The "Time Ago" Function for the Timeline
  
************************************************************************************/
    
function time_ago($date) {
    
    // Timestamp of date/time.
    $time = strtotime($date);
    
    // Units of time.
    $units= array("Second", "Minute", "Hour", "Day", "Week", "Month", "Year", "Decade");
    
    // Time intervals.
    $intervals= array("60","60","24","7","4.35","12","10");
    
    // Current timestamp.
    $now = time();
    
    // Calculate difference in seconds.
    $difference = $now - $time;
    
    // Calculate and format.
    for($j = 0; $difference >= $intervals[$j] && $j < count($intervals)-1; $j++) {
        $difference /= $intervals[$j];
    }
    $difference = round($difference);
    
    // Add 's' if greater than 1 'minute', 'year', etc.
    if($difference != 1) {
        $units[$j].= "s";
    }  
     
    // Final formatting '1 day ago'.
    $ago = "$difference ".$units[$j]." Ago";
    
    // Echo result.
    echo $ago;
}

/***********************************************************************************
  
The "Truncate Text" Function
  
************************************************************************************/

function truncate($text, $chars = 25) {
    $text = $text." ";
    $text = substr($text,0,$chars);
    $text = substr($text,0,strrpos($text,' '));
    $text = $text." ...";
    return $text;
}

/***********************************************************************************
  
The Get Count Function
  
************************************************************************************/

function get_count($meta, $post_id) {

    // Set the data folder.
    $meta_folder = './assets/works/meta/';

    // Loves count.
    $meta_file = file($meta_folder . $post_id . '-' . $meta . '.txt');
    $meta_count = number_format($meta_file[0]);

    // Return the loves.
    echo $meta_count;
}

/***********************************************************************************
  
The "Get Content" Function
  
************************************************************************************/

function get_content() {
    
    // The content directory.
    $content_dir = '././content/';
    
    // Read the content posts.
    if($handle = opendir($content_dir)) {

        // Set up the posts array.
        $posts = array();

        // Set up the post times array.
        $post_times = array();

        // Let’s loop throught the entires.
        while (false !== ($post = readdir($handle))) {
            if(substr(strrchr($post,'.'),1)==ltrim('.txt', '.')) {
                
                // Post meta.
                $post_content = file($content_dir.$post);
                $post_time = strtotime($post_content[2]);
                $post_id = str_replace(".txt", '', $post);
                $post_video_type = strtok($post_id, '-');
                $post_video_id = str_replace($post_video_type . '-', '', $post_id);
                
                // Post content.
                $post_title = str_replace("\n", '', $post_content[0]);
                $post_date = str_replace("\n", '', $post_content[2]);
                $post_text = str_replace("\n", '', $post_content[4]);

                // Post image.
                $post_image = 'content/' . $post_id . '.jpg';
                
                // The content array.
                $posts[] = array(                    
                    'time' => $post_time, 
                    'id' => $post_id, 
                    'video_type' => $post_video_type,
                    'video_id' => $post_video_id, 
                    'title' => $post_title,
                    'date' => $post_date,
                    'text' => $post_text,
                    'image' => $post_image
                );
                
                // Sort by time.
                $post_times[] = $post_time;
            }
        }
        array_multisort($post_times, SORT_DESC, $posts);
        return $posts;
    } else {
        return false;
    }
}

/***********************************************************************************
  
The Content Loop
  
************************************************************************************/

if(empty($_GET['v'])) {
    $posts = get_content();
    if($posts) {
        ob_start();

        // Reset the content.
        $content = '';

        // Reset the counter.
        $count = 0;

        // Start the loop.
        foreach($posts as $post) {

            // Generate post loves file.    
            if(!is_readable('./assets/works/meta/' . $post['id'] . '-loves.txt')) {
                file_put_contents('./assets/works/meta/' . $post['id'] . '-loves.txt', '0');
            }

            // Generate post plays file.    
            if(!is_readable('./assets/works/meta/' . $post['id'] . '-plays.txt')) {
                file_put_contents('./assets/works/meta/' . $post['id'] . '-plays.txt', '0');
            }
            
            // Generate post images.    
            if(!is_readable('./content/' . $post['id'] . '.jpg')) {
                
                // YouTube post images.
                if($post['video_type'] == 'youtube') {
                    $thumbnail = file_get_contents('https://img.youtube.com/vi/' . $post['video_id'] . '/maxresdefault.jpg');
                }
                
                // Vimeo post images.
                if($post['video_type'] == 'vimeo') {
                    $the_video_meta = json_decode(file_get_contents('https://vimeo.com/api/oembed.json?url=https%3A%2F%2Fvimeo.com%2F' . $post['video_id']));
                    $thumbnail = file_get_contents($the_video_meta->thumbnail_url);
                }
                
                // Save the post image.
                file_put_contents('./content/' . $post['id'] . '.jpg', $thumbnail);
            }

            if($count == 0) {
                $post['class'] = 'latest';
            } else {
                $post['class'] = 'archive';
            }
            
            // Get the video template.
            include('././assets/templates/post.php');
            
            $count++;
        }
        echo $content;
        $content = ob_get_contents();
        ob_end_clean();
    }
} else {
    ob_start();

    // The post ID.
    $post['id'] = $_GET['v'];

    // Set the content directory.
    $content_dir = '././content/';

    // Post meta.
    $post_content = file($content_dir.$post['id'].'.txt');
    $post_time = strtotime($post_content[2]);
    $post['video_type'] = strtok($post['id'], '-');
    $post['video_id'] = str_replace($post['video_type'] . '-', '', $post['id']);

    // Post content.
    $post['title'] = str_replace("\n", '', $post_content[0]);
    $post['date'] = str_replace("\n", '', $post_content[2]);
    $post['text'] = str_replace("\n", '', $post_content[4]);

    // The post image.
    $post['image'] = 'content/' . $post['id'] . '.jpg';

    // The post class.
    $post['class'] = 'single';

    // Get the video template.
    include('././assets/templates/post.php');

    $content = ob_get_contents();
    ob_end_clean();
    ob_start();
}