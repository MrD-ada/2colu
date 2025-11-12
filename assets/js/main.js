/**
 * 2colu テーマ メインJavaScript
 */

jQuery(document).ready(function($) {
    
    // スムーススクロール
    $('a[href^="#"]').on('click', function(e) {
        var target = $(this.hash);
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 500);
        }
    });
    
    // モバイルメニューの開閉
    $('.menu-toggle').on('click', function() {
        $(this).toggleClass('active');
        $('.main-navigation ul').slideToggle();
    });
    
    // ウィンドウリサイズ時の処理
    $(window).on('resize', function() {
        if ($(window).width() > 767) {
            $('.main-navigation ul').removeAttr('style');
            $('.menu-toggle').removeClass('active');
        }
    });
    
    // 検索フォームの拡張機能
    $('.search-form input[type="search"]').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        $(this).parent().removeClass('focused');
    });
    
    // シェアボタンのポップアップ
    $('.share-buttons a').on('click', function(e) {
        var url = $(this).attr('href');
        var width = 600;
        var height = 400;
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        
        // TwitterとFacebook、LINEの場合のみポップアップで開く
        if (url.indexOf('twitter.com') !== -1 || 
            url.indexOf('facebook.com') !== -1 || 
            url.indexOf('line.me') !== -1) {
            e.preventDefault();
            window.open(url, 'share', 
                'width=' + width + 
                ',height=' + height + 
                ',left=' + left + 
                ',top=' + top + 
                ',scrollbars=yes,resizable=yes');
        }
    });
    
    // 画像の遅延読み込み（基本的な実装）
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // トップに戻るボタン
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });
    
    $('.back-to-top').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, 500);
    });
    
    // 外部リンクを新しいタブで開く
    $('a[href^="http"]:not([href*="' + location.hostname + '"])').attr('target', '_blank').attr('rel', 'noopener noreferrer');
    
    // コメントフォームの改善
    $('#commentform').on('submit', function() {
        $(this).find('input[type="submit"]').prop('disabled', true).val('送信中...');
    });
    
    // 広告の表示/非表示制御（AdBlocker対策）
    setTimeout(function() {
        $('.ads-area').each(function() {
            if ($(this).height() < 10) {
                $(this).hide();
            }
        });
    }, 2000);
    
});

// ページ読み込み完了後の処理
window.addEventListener('load', function() {
    // 画像の読み込み完了後にレイアウト調整
    const images = document.querySelectorAll('img');
    let loadedImages = 0;
    
    if (images.length === 0) {
        adjustLayout();
    }
    
    images.forEach(img => {
        if (img.complete) {
            loadedImages++;
            if (loadedImages === images.length) {
                adjustLayout();
            }
        } else {
            img.addEventListener('load', function() {
                loadedImages++;
                if (loadedImages === images.length) {
                    adjustLayout();
                }
            });
        }
    });
});

// レイアウト調整関数
function adjustLayout() {
    // サイドバーの高さ調整などの処理をここに記述
    console.log('Layout adjusted');
}

// パフォーマンス向上のための処理
document.addEventListener('DOMContentLoaded', function() {
    // CSSアニメーションの最適化
    const mediaQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
    if (mediaQuery.matches) {
        document.body.classList.add('reduce-motion');
    }
});