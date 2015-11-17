		<!-- BEGIN SIDEBAR -->
		<div class="five columns">

				<?php 
				/*
						Get Sidebar
				*/
				
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar") ) : ?>                
				<?php endif; ?> 

		</div> <!-- /five columns -->									 
		<!-- END SIDEBAR -->