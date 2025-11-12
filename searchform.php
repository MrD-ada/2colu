<?php
/**
 * カスタム検索フォーム
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text">検索:</span>
        <input type="search" 
               class="search-field" 
               placeholder="サイト内を検索..." 
               value="<?php echo get_search_query(); ?>" 
               name="s" 
               required />
    </label>
    <button type="submit" class="search-submit">
        <span class="screen-reader-text">検索</span>
        🔍
    </button>
</form>