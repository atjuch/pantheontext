
	<?php do_action('bunyad_post_main_content'); ?>
    <div class="main wrap cf">
        <div class="row">
        <div class="col-12" style="text-align:center">
            <!--img src="http://placehold.it/728x90"/ -->
        </div>
            </div>
    </div>
	
	<footer class="main-footer">
	
	<?php if (!Bunyad::options()->disable_footer): ?>
		<div class="wrap">
		
		<?php if (is_active_sidebar('main-footer')): ?>
			<ul class="widgets row cf">
				<?php dynamic_sidebar('main-footer'); ?>
			</ul>
		<?php endif; ?>
		
		</div>
	
	<?php endif; ?>
	
	
	<?php if (!Bunyad::options()->disable_lower_footer): ?>
		<div class="lower-foot">
			<div class="wrap">
		
			<?php if (is_active_sidebar('lower-footer')): ?>
			
			<div class="widgets">
				<?php dynamic_sidebar('lower-footer'); ?>
			</div>
			
			<?php endif; ?>
		
			</div>
		</div>		
	<?php endif; ?>
	
	</footer>
	
</div> <!-- .main-wrap -->

<?php wp_footer(); ?>

<?php
// this is to filter out NSFW related content
$nsfw = false;
if (is_single()){
    $posttags = get_the_tags();
    if ($posttags) {
        foreach($posttags as $tag) {
            if(strtolower(trim($tag->name)) == 'nsfw'){
                echo '<!-- nsfw -->';
                $nsfw = true;
            }
        };
        }
    }

if(empty($nsfw) && !is_category('nsfw') && !is_category('health') && !is_category('genital-warfare') && !is_category('gay-sex') && !is_category('drugs') && !is_category('sex-2') && !is_category('sex') && !is_search()){ ?>
        <!-- unicornbooty_testing_728x90 -->
        <ins class="adsbygoogle"
             style="width: 728px;height: 90px;margin: 20px auto;display: block;"
             data-ad-client="ca-pub-3045333088885241"
             data-ad-slot="5322217416"></ins>

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <?php
     }
     ?>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1566706946942719";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>