<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new ct_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="ct-popup">

	<div id="ct-shortcode-wrap">
		
		<div id="ct-sc-form-wrap">
		
			<div id="ct-sc-form-head">
			
				<?php echo $shortcode->popup_title; ?>
			
			</div>
			<!-- /#ct-sc-form-head -->
			
			<form method="post" id="ct-sc-form">
			
				<table id="ct-sc-form-table">
				
					<?php echo $shortcode->output; ?>
					
					<tbody>
						<tr class="form-row">
							<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
							<td class="field"><a href="#" class="button-primary ct-insert">Insert Shortcode</a></td>							
						</tr>
					</tbody>
				
				</table>
				<!-- /#ct-sc-form-table -->
				
			</form>
			<!-- /#ct-sc-form -->
		
		</div>
		<!-- /#ct-sc-form-wrap -->
		
		<div class="clear"></div>
		
	</div>
	<!-- /#ct-shortcode-wrap -->

</div>
<!-- /#ct-popup -->

</body>
</html>