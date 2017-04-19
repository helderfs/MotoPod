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
			<h2>Notícias</h2>
			<ul class="tmo_list">
				<li><a href="news_motos">Motos</a></li>
				<li><a href="news_f1">Fórmula 1</a></li>
				<li><a href="news_motogp">MotoGP</a></li>
			</ul>
		</div>

		<div class="sidebar_box">
			<h2>Notícias Recentes</h2>
			<?php
			$qr = "
			SELECT * FROM mp_posts
			 ORDER BY PST_DATE DESC, PST_HORA DESC
			 LIMIT 1,4";

			$sql = mysql_query($qr);
			$total = mysql_num_rows($sql);
			while($r = mysql_fetch_array($sql)){
				$ipst	= $r['PST_COD'];
				$post 	= $r['PST_POSTRES'];
				$link 	= $r['PST_LINK'];
				
				if (strlen($post) >= 30)
					$post = substr($post, 0, 30) . "...";

				echo '
				<div class="recent_comment_box">
					<a href="'. $link .'">'. $r['PST_TITULO'] .'</a>
					<p><font size="1px">'. $post .'</font></p>
				</div>';
			}
			?>
			
			<h2>Motos Recentes</h2>
			<?php
			$qr = "
			SELECT *
			  FROM mp_motos MOT
			  LEFT JOIN mp_marca_mod MMO ON MMO.MMO_COD = MOT.MOT_MMO_COD
			 LIMIT 1,4";

			$sql = mysql_query($qr);
			$total = mysql_num_rows($sql);
			while($r = mysql_fetch_array($sql)){

				$marca  = $r['MMO_MAR_COD'];
				$mar_nm = buscaDB('mp_marca', 'MAR_COD', $r['MMO_MAR_COD'], 'MAR_NOME');	// Table Search , Field Search , Value Search , Field Return
				$modelo = mb_strtoupper( retSEspOut( $r['MMO_MODELO'] ) );
				$mod_nm = $r['MMO_MODELO'];
				$ano    = $r['MOT_ANOFAB'];
				$link	= 'moto/'. $marca .'/'. $modelo .'/'. $ano;
				
				echo '
				<div class="recent_comment_box">
					<a href="'. $link .'">'. $mar_nm ." - ". $mod_nm ." - ". $ano .'</a></h2>
				</div>';
			}
			?>
		</div>
		<div class="cleaner"></div>
	</div>