	<div id="sidebar">
		<!-- BANNERS
		<div class="sidebar_box">
			<ul class="ads_125">
				<li><a href="http://www.templatemo.com"><img src="images/ads.jpg" alt="CSS Templates" /></a></li>
				<li class="odd"><a href="http://www.flashmo.com"><img src="images/ads.jpg" alt="banner" /></a></li>
				<li class="last_row"><a href="http://www.templatemo.com/page/1"><img src="images/ads.jpg" alt="banner" /></a></li>
				<li class="odd last_row"><a href="http://www.flashmo.com/page/1"><img src="images/ads.jpg" alt="banner" /></a></li>
			</ul>  
			<div class="cleaner"></div>
		</div>        
		-->
		<div class="sidebar_box">
			<h4>Notícias por Categoria</h4>
			<ul class="tmo_list">
				<li><a href="news_motos">Motos</a></li>
				<li><a href="news_f1">Fórmula 1</a></li>
				<li><a href="news_motogp">MotoGP</a></li>
			</ul>
		</div>

		<div class="sidebar_box">
			<h4>Notícias Recentes</h4>
			<?php
			$qr = "
			SELECT * FROM mp_posts
			 ORDER BY PST_DATE DESC, PST_HORA DESC
			 LIMIT 1,8";

			$sql = mysql_query($qr);
			$total = mysql_num_rows($sql);
			while($r = mysql_fetch_array($sql)){
				$ipst	= $r['PST_COD'];
				$post 	= $r['PST_POST'];
				$link 	= $r['PST_LINK'];
				$titulo	= $r['PST_TITULO'];
				
				$cat_news = "";
				switch ($r['PST_CATNEWS']){
					case "1":
						$cat_news = "Moto - ";
						break;
					case "2":
						$cat_news = "MotoGP - ";
						break;
					case "3":
						$cat_news = "F-1 - ";
						break;
				}
				
				if (strlen($titulo) >= 30)
					$titulo = substr($titulo, 0, 30) . "...";
				//if (strlen($post) >= 30)
					//$post = substr($post, 0, 30) . "...";

				echo '
				<div class="recent_comment_box">
					<a href="'. $link .'">'. $cat_news . $titulo .'</a>
					<!--<p>'. $post .'</p>-->
				</div>';
			}
			?>
		</div>
		<div class="cleaner"></div>
	</div>