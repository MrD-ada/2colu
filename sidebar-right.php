<?php
/**
 * 右サイドバーテンプレート
 * Gutenbergブロックと従来ウィジェット両対応
 */

// サイドバーがアクティブでなければ終了
if (!is_active_sidebar('sidebar-right')) {
    return;
}
?>

<aside id="secondary" class="sidebar-right widget-area">

    <?php
    // dynamic_sidebar() は右サイドバーに登録されているウィジェットを出力
    dynamic_sidebar('sidebar-right');
    ?>

</aside>