<?php
/**
 * シェアボタンテンプレート
 */

$post_title = urlencode(get_the_title());
$post_url = urlencode(get_permalink());
$post_excerpt = urlencode(wp_trim_words(get_the_excerpt(), 50));
?>

<div class="share-buttons">
    <ul>
        <li>
            <a href="https://twitter.com/intent/tweet?text=<?php echo $post_title; ?>&url=<?php echo $post_url; ?>" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="share-twitter">
                Twitter
            </a>
        </li>
        <li>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="share-facebook">
                Facebook
            </a>
        </li>
        <li>
            <a href="https://social-plugins.line.me/lineit/share?url=<?php echo $post_url; ?>" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="share-line">
                LINE
            </a>
        </li>
        <li>
            <a href="https://b.hatena.ne.jp/entry/s/<?php echo str_replace(array('https://', 'http://'), '', get_permalink()); ?>" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="share-hatena">
                はてブ
            </a>
        </li>
        <li>
            <a href="https://getpocket.com/edit?url=<?php echo $post_url; ?>&title=<?php echo $post_title; ?>" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="share-pocket">
                Pocket
            </a>
        </li>
    </ul>
</div>