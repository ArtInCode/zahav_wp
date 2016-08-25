<?php
$themeURI = get_template_directory_uri();
$labels = get_option( 'trans_item' );

$args  = array(
			'post_type' => 'feedback',
			'orderby'=>'id',
			'order'=>'ASC',
			'posts_per_page'=>6,
			

		);
		$feedback = new WP_Query( $args );
?>
<div class="container-fluid white-bgr" id="top-content">
	<div class="container">
	
		<div class="col-md-5 col-sm-8 no-padding right-are col-md-push-7  col-sm-push-4 relative col-xs-12">
		    <div class="right-corner-wrap col-md-10 col-md-offset-2">
			   	
			   	<div class="right-corner-text gold-color">
			   		<?php
			   		if ( $feedback->have_posts() ) {
					$r=1; 
					$num = 0;
					while ( $feedback->have_posts() ) {
						$feedback->the_post();
						if($feedback->post->feedback == "welcome"){

						$mainTitle =  explode(" ", mb_substr($feedback->post->post_title, 0));
						$clearedTitle = "";
						foreach ($mainTitle as $v) {
							$clearedTitle .= "<span>".$v."</span>";
						}

			   		?>
			   			<div class="right-corner-logo relative text-center">
					   		<img src="<?=$themeURI?>/images/logo-quiz.png" alt="" class="main-logo img-responsive"/>
					   		<h1 class="main-title relative"><?=$clearedTitle?></h1>					   		
					   	</div>
			   			<?php the_content();	?>
			   		<?php
			   			}
					}
				}
					?>
			   	</div>	   	
		    </div>
		</div>
		<div class="col-md-7 col-sm-4 no-padding left-area col-md-pull-5 col-sm-pull-8  col-xs-12 relative">
			<?php
			$args  = array(
				'post_type' => 'question',
				'orderby'=>'id',
				'order'=>'ASC',
				'posts_per_page'=>6,
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => 'quize',
					),
				),

			);
			$the_query = new WP_Query( $args );
			//var_dump($the_query); 
			// The Loop
			$f = 0; 
			$s = 0;
			$t = 0;  
			if ( $the_query->have_posts() ) {
				$r=1; 
				$num = 0;
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$r++; 

					$f = "option_".$r++;
					$s = "option_".$r++;
					$t = "option_".$r++; 
					$num++;
					$nextwrap  = $num + 1;
					?>
					<div class="col-md-12 col-sm-12 col-xs-12 question-chart-wrap no-padding" id="wrap-num-<?=$num?>">
						<div class="question-chart-wrap-header dark-bgr col-md-12 col-sm-12 col-xs-12">
							<h2 class="question-title">						
								<span class="white-color"><?=the_title();?></span>
								<span class="gold-color">:<?=$labels['main_title']?></span> 
							</h2>
						</div>
						<div class="question-chart-body col-md-12 col-sm-12 col-xs-12 gold-color bold-text  padding-tb-20 font-size-30 line-height-30">
							<?php the_content();	?>
						</div>
						<div class="question-chart-option col-md-12 col-sm-12 col-xs-12 gold-color">
							<p> 
								<input type="radio" data-wrap="<?=$nextwrap?>" class="cool-checkbox" name="option_<?=$r?>" value="1" id="<?=$f?>"/>
								<label for="<?=$f?>" ><span></span><?=$the_query->post->question_1?></label>
							</p>
							<p> 
								<input type="radio" data-wrap="<?=$nextwrap?>" class="cool-checkbox" name="option_<?=$r?>" value="2" id="<?=$s?>"/>
								<label for="<?=$s?>" ><span></span><?=$the_query->post->question_2?></label>
							</p>
							<p>
								<input type="radio" class="cool-checkbox" data-wrap="<?=$nextwrap?>" name="option_<?=$r?>" value="3" id="<?=$t?>"/>
								<label for="<?=$t?>"><span></span><?=$the_query->post->question_3?></label>
							</p>
						</div>
						
				    </div>
					<?php
					//<span class="question-flag relative pull-left gold-bgr white-color">$labels['flag_text'] </span>
				}
				
				/* Restore original Post Data */
				wp_reset_postdata();
			} else {
				// no posts found
			}

			
			

			if ( $feedback->have_posts() ) {
				$r=1; 
				$num = 0;
				while ( $feedback->have_posts() ) {
					$feedback->the_post();
					?>
					<div class="col-md-12 col-sm-12 col-xs-12 question-chart-wrap no-padding" id="<?=$feedback->post->feedback?>">
						<div class="question-chart-wrap-header dark-bgr col-md-12">
							<h2 class="question-title">						
								<span class="white-color"><?=the_title();?></span>							
							</h2>
						</div>
						<div class="question-chart-body col-md-12 col-sm-12 col-xs-12">
							<p><?php the_content();	?></p>
						</div>					
				    </div>
					<?php
					}
				
				/* Restore original Post Data */
				wp_reset_postdata();
			} 
			?>
			

		</div>
	</div><!--#top-content-->	
	<div class="container ">
		<div class="col-md-12 col-sm-12 col-xs-12 gold-bgr home-footer">
			<div class="col-md-3 footer-image relative text-center">
				<img src="<?=$themeURI;?>/images/logo.png" alt="logo" class="img-responsive">
			</div>
			<div class="col-md-9 rtl">
				<?php echo do_shortcode('[contact-form-7 id="23" title="Contact form 1"]')?>				
			</div>
		</div>
	</div>
</div>
