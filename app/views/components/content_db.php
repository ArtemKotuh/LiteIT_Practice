<div class="mostcontainer">
	<div id="content">
		<div id="link_video" style="display: none" data-link-video=""></div>
		<ul>
			<div class="row row-flex">
				<?php

				if (!empty($pageData['videos_date'])) {
					foreach ($pageData['videos_date'] as $value) {
						$youtube_link = "http://www.youtube.com/watch?v=" . $value['video_id']; ?>
						<div class="list-video col-sm-3 col-xs-4">
							<li>
								<div class="vediodiv">
									<a data-mfp-src=<?php echo $youtube_link; ?> class="popup-youtube colr2" rel="nofollow" href="">
										<img class="img-responsive" src=<?php echo $value['url']; ?> alt="">
									</a>
									<span class="addtoplaylist" title="добавить в избранные"><img id="add_featured" data-id-video=<?php echo $url; ?> data-token="2pdRromcDUi8bmmZgCPZlGiMWQaiZTBtaYkGvc1N" data-url="/featured.php" class="plusicon" src="https://video.klisl.com/images/plusicon.png" alt="в избранные"></span>
								</div>
								<div class="clear"></div>
								<p class="ttle">
									<a class="popup-youtube colr2" rel="nofollow" href=""><?php echo $value['title']; ?></a>
								</p>
								<p><?php echo $value['data']; ?></p>
							</li>
						</div>
				<?php
					}
				}
				?>
			</div>
		</ul>
	</div>
</div>