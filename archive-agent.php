<?php
/**
 * The template for displaying the archive page for the agents custom post type
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Phoenix
 */
get_header(); ?>
	<main id="primary" class="site-main">
		<div class="hero">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>Insurance Agents</h1>

            			<?php get_template_part('template-parts/content', 'topmda'); ?>

					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="main-content">
						<?php if( function_exists( 'aioseo_breadcrumbs' ) ): ?>
							<div class="breadcrumb-wrap no-mt"><?php aioseo_breadcrumbs(); ?></div>
						<?php endif ?>
						<h2>Top Cities</h2>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="nav-sub-wrapper">
					<div class="col-md-3">
						<div class="nav-sub">
							<ul>
								<li class="nav-sub-item"><a href="/agents/akron-oh/" title="Akron, OH Insurance Agents">Akron, OH</a></li>
								<li class="nav-sub-item"><a href="/agents/albuquerque-nm/" title="Albuquerque, NM Insurance Agents">Albuquerque, NM</a></li>
								<li class="nav-sub-item"><a href="/agents/anaheim-ca/" title="Anaheim, CA Insurance Agents">Anaheim, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/anchorage-ak/" title="Anchorage, AK Insurance Agents">Anchorage, AK</a></li>
								<li class="nav-sub-item"><a href="/agents/arlington-tx/" title="Arlington, TX Insurance Agents">Arlington, TX</a></li>
								<li class="nav-sub-item"><a href="/agents/arlington-va/" title="Arlington, VA Insurance Agents">Arlington, VA</a></li>
								<li class="nav-sub-item"><a href="/agents/atlanta-ga/" title="Atlanta, GA Insurance Agents">Atlanta, GA</a></li>
								<li class="nav-sub-item"><a href="/agents/aurora-co/" title="Aurora, CO Insurance Agents">Aurora, CO</a></li>
								<li class="nav-sub-item"><a href="/agents/austin-tx/" title="Austin, TX Insurance Agents">Austin, TX</a></li>
								<li class="nav-sub-item"><a href="/agents/bakersfield-ca/" title="Bakersfield, CA Insurance Agents">Bakersfield, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/baltimore-md/" title="Baltimore, MD Insurance Agents">Baltimore, MD</a></li>
								<li class="nav-sub-item"><a href="/agents/baton-rouge-la/" title="Baton Rouge, LA Insurance Agents">Baton Rouge, LA</a></li>
								<li class="nav-sub-item"><a href="/agents/birmingham-al/" title="Birmingham, AL Insurance Agents">Birmingham, AL</a></li>
								<li class="nav-sub-item"><a href="/agents/boise-id/" title="Boise, ID Insurance Agents">Boise, ID</a></li>
								<li class="nav-sub-item"><a href="/agents/boston-ma/" title="Boston, MA Insurance Agents">Boston, MA</a></li>
								<li class="nav-sub-item"><a href="/agents/buffalo-ny/" title="Buffalo, NY Insurance Agents">Buffalo, NY</a></li>
								<li class="nav-sub-item"><a href="/agents/chandler-az/" title="Chandler, AZ Insurance Agents">Chandler, AZ</a></li>
								<li class="nav-sub-item"><a href="/agents/charlotte-nc/" title="Charlotte, NC Insurance Agents">Charlotte, NC</a></li>
								<li class="nav-sub-item"><a href="/agents/chesapeake-va/" title="Chesapeake, VA Insurance Agents">Chesapeake, VA</a></li>
								<li class="nav-sub-item"><a href="/agents/chicago-il/" title="Chicago, IL Insurance Agents">Chicago, IL</a></li><li class="nav-sub-item"><a href="/agents/chula-vista-ca/" title="Chula Vista, CA Insurance Agents">Chula Vista, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/cincinnati-oh/" title="Cincinnati, OH Insurance Agents">Cincinnati, OH</a></li>
								<li class="nav-sub-item"><a href="/agents/cleveland-oh/" title="Cleveland, OH Insurance Agents">Cleveland, OH</a></li>
								<li class="nav-sub-item"><a href="/agents/colorado-springs-co/" title="Colorado Springs, CO Insurance Agents">Colorado Springs, CO</a></li><li class="nav-sub-item"><a href="/agents/columbus-oh/" title="Columbus, OH Insurance Agents">Columbus, OH</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3">
						<div class="nav-sub">
							<ul>
								<li class="nav-sub-item"><a href="/agents/corpus-christi-tx/" title="Corpus Christi, TX Insurance Agents">Corpus Christi, TX</a></li>
								<li class="nav-sub-item"><a href="/agents/dallas-tx/" title="Dallas, TX Insurance Agents">Dallas, TX</a></li>
								<li class="nav-sub-item"><a href="/agents/denver-co/" title="Denver, CO Insurance Agents">Denver, CO</a></li>
								<li class="nav-sub-item"><a href="/agents/detroit-mi/" title="Detroit, MI Insurance Agents">Detroit, MI</a></li>
								<li class="nav-sub-item"><a href="/agents/durham-nc/" title="Durham, NC Insurance Agents">Durham, NC</a></li>
								<li class="nav-sub-item"><a href="/agents/el-paso-tx/" title="El Paso, TX Insurance Agents">El Paso, TX</a></li>
								<li class="nav-sub-item"><a href="/agents/fort-wayne-in/" title="Fort Wayne, IN Insurance Agents">Fort Wayne, IN</a></li>
								<li class="nav-sub-item"><a href="/agents/fort-worth-tx/" title="Fort Worth, TX Insurance Agents">Fort Worth, TX</a></li>
								<li class="nav-sub-item"><a href="/agents/fresno-ca/" title="Fresno, CA Insurance Agents">Fresno, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/garland-tx/" title="Garland, TX Insurance Agents">Garland, TX</a></li>
								<li class="nav-sub-item"><a href="/agents/glendale-az/" title="Glendale, AZ Insurance Agents">Glendale, AZ</a></li>
								<li class="nav-sub-item"><a href="/agents/greensboro-nc/" title="Greensboro, NC Insurance Agents">Greensboro, NC</a></li>
								<li class="nav-sub-item"><a href="/agents/hempstead-ny/" title="Hempstead, NY Insurance Agents">Hempstead, NY</a></li>
								<li class="nav-sub-item"><a href="/agents/henderson-nv/" title="Henderson, NV Insurance Agents">Henderson, NV</a></li>
								<li class="nav-sub-item"><a href="/agents/hialeah-fl/" title="Hialeah, FL Insurance Agents">Hialeah, FL</a></li>
								<li class="nav-sub-item"><a href="/agents/honolulu-hi/" title="Honolulu, HI Insurance Agents">Honolulu, HI</a></li>
								<li class="nav-sub-item"><a href="/agents/houston-tx/" title="Houston, TX Insurance Agents">Houston, TX</a></li>
								<li class="nav-sub-item"><a href="/agents/huntington-ny/" title="Huntington, NY Insurance Agents">Huntington, NY</a></li>
								<li class="nav-sub-item"><a href="/agents/indianapolis-in/" title="Indianapolis, IN Insurance Agents">Indianapolis, IN</a></li>
								<li class="nav-sub-item"><a href="/agents/jacksonville-fl/" title="Jacksonville, FL Insurance Agents">Jacksonville, FL</a></li>
								<li class="nav-sub-item"><a href="/agents/jersey-city-nj/" title="Jersey City, NJ Insurance Agents">Jersey City, NJ</a></li>
								<li class="nav-sub-item"><a href="/agents/kansas-city-mo/" title="Kansas City, MO Insurance Agents">Kansas City, MO</a></li>
								<li class="nav-sub-item"><a href="/agents/laredo-tx/" title="Laredo, TX Insurance Agents">Laredo, TX</a></li>
								<li class="nav-sub-item"><a href="/agents/las-vegas-nv/" title="Las Vegas, NV Insurance Agents">Las Vegas, NV</a></li>
								<li class="nav-sub-item"><a href="/agents/lexington-ky/" title="Lexington, KY Insurance Agents">Lexington, KY</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3">
						<div class="nav-sub">
							<ul>
								<li class="nav-sub-item"><a href="/agents/lincoln-ne/" title="Lincoln, NE Insurance Agents">Lincoln, NE</a></li>
								<li class="nav-sub-item"><a href="/agents/long-beach-ca/" title="Long Beach, CA Insurance Agents">Long Beach, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/los-angeles-ca/" title="Los Angeles, CA Insurance Agents">Los Angeles, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/lubbock-tx/" title="Lubbock, TX Insurance Agents">Lubbock, TX</a></li>
								<li class="nav-sub-item"><a href="/agents/madison-wi/" title="Madison, WI Insurance Agents">Madison, WI</a></li>
								<li class="nav-sub-item"><a href="/agents/memphis-tn/" title="Memphis, TN Insurance Agents">Memphis, TN</a></li>
								<li class="nav-sub-item"><a href="/agents/mesa-az/" title="Mesa, AZ Insurance Agents">Mesa, AZ</a></li>
								<li class="nav-sub-item"><a href="/agents/miami-fl/" title="Miami, FL Insurance Agents">Miami, FL</a></li>
								<li class="nav-sub-item"><a href="/agents/milwaukee-wi/" title="Milwaukee, WI Insurance Agents">Milwaukee, WI</a></li>
								<li class="nav-sub-item"><a href="/agents/minneapolis-mn/" title="Minneapolis, MN Insurance Agents">Minneapolis, MN</a></li>
								<li class="nav-sub-item"><a href="/agents/modesto-ca/" title="Modesto, CA Insurance Agents">Modesto, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/montgomery-al/" title="Montgomery, AL Insurance Agents">Montgomery, AL</a></li>
								<li class="nav-sub-item"><a href="/agents/nashville-tn/" title="Nashville, TN Insurance Agents">Nashville, TN</a></li>
								<li class="nav-sub-item"><a href="/agents/new-orleans-la/" title="New Orleans, LA Insurance Agents">New Orleans, LA</a></li>
								<li class="nav-sub-item"><a href="/agents/new-york-ny/" title="New York, NY Insurance Agents">New York, NY</a></li>
								<li class="nav-sub-item"><a href="/agents/newark-nj/" title="Newark, NJ Insurance Agents">Newark, NJ</a></li>
								<li class="nav-sub-item"><a href="/agents/norfolk-va/" title="Norfolk, VA Insurance Agents">Norfolk, VA</a></li>
								<li class="nav-sub-item"><a href="/agents/oakland-ca/" title="Oakland, CA Insurance Agents">Oakland, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/oklahoma-city-ok/" title="Oklahoma City, OK Insurance Agents">Oklahoma City, OK</a></li>
								<li class="nav-sub-item"><a href="/agents/omaha-ne/" title="Omaha, NE Insurance Agents">Omaha, NE</a></li>
								<li class="nav-sub-item"><a href="/agents/orlando-fl/" title="Orlando, FL Insurance Agents">Orlando, FL</a></li>
								<li class="nav-sub-item"><a href="/agents/philadelphia-pa/" title="Philadelphia, PA Insurance Agents">Philadelphia, PA</a></li>
								<li class="nav-sub-item"><a href="/agents/phoenix-az/" title="Phoenix, AZ Insurance Agents">Phoenix, AZ</a></li>
								<li class="nav-sub-item"><a href="/agents/pittsburgh-pa/" title="Pittsburgh, PA Insurance Agents">Pittsburgh, PA</a></li>
								<li class="nav-sub-item"><a href="/agents/plano-tx/" title="Plano, TX Insurance Agents">Plano, TX</a></li>
							</ul>
						</div>
					</div>


					<div class="col-md-3">
						<div class="nav-sub">
							<ul>
								<li class="nav-sub-item"><a href="/agents/portland-or/" title="Portland, OR Insurance Agents">Portland, OR</a></li>
								<li class="nav-sub-item"><a href="/agents/raleigh-nc/" title="Raleigh, NC Insurance Agents">Raleigh, NC</a></li>
								<li class="nav-sub-item"><a href="/agents/reno-nv/" title="Reno, NV Insurance Agents">Reno, NV</a></li>
								<li class="nav-sub-item"><a href="/agents/riverside-ca/" title="Riverside, CA Insurance Agents">Riverside, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/rochester-ny/" title="Rochester, NY Insurance Agents">Rochester, NY</a></li>
								<li class="nav-sub-item"><a href="/agents/sacramento-ca/" title="Sacramento, CA Insurance Agents">Sacramento, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/san-antonio-tx/" title="San Antonio, TX Insurance Agents">San Antonio, TX</a></li>
								<li class="nav-sub-item"><a href="/agents/san-bernardino-ca/" title="San Bernardino, CA Insurance Agents">San Bernardino, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/san-diego-ca/" title="San Diego, CA Insurance Agents">San Diego, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/san-francisco-ca/" title="San Francisco, CA Insurance Agents">San Francisco, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/san-jose-ca/" title="San Jose, CA Insurance Agents">San Jose, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/santa-ana-ca/" title="Santa Ana, CA Insurance Agents">Santa Ana, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/scottsdale-az/" title="Scottsdale, AZ Insurance Agents">Scottsdale, AZ</a></li>
								<li class="nav-sub-item"><a href="/agents/seattle-wa/" title="Seattle, WA Insurance Agents">Seattle, WA</a></li>
								<li class="nav-sub-item"><a href="/agents/st-louis-mo/" title="St. Louis, MO Insurance Agents">St. Louis, MO</a></li>
								<li class="nav-sub-item"><a href="/agents/st-paul-mn/" title="St. Paul, MN Insurance Agents">St. Paul, MN</a></li>
								<li class="nav-sub-item"><a href="/agents/st-petersburg-fl/" title="St. Petersburg, FL Insurance Agents">St. Petersburg, FL</a></li>
								<li class="nav-sub-item"><a href="/agents/stockton-ca/" title="Stockton, CA Insurance Agents">Stockton, CA</a></li>
								<li class="nav-sub-item"><a href="/agents/tampa-fl/" title="Tampa, FL Insurance Agents">Tampa, FL</a></li>
								<li class="nav-sub-item"><a href="/agents/toledo-oh/" title="Toledo, OH Insurance Agents">Toledo, OH</a></li>
								<li class="nav-sub-item"><a href="/agents/tucson-az/" title="Tucson, AZ Insurance Agents">Tucson, AZ</a></li>
								<li class="nav-sub-item"><a href="/agents/tulsa-ok/" title="Tulsa, OK Insurance Agents">Tulsa, OK</a></li>
								<li class="nav-sub-item"><a href="/agents/virginia-beach-va/" title="Virginia Beach, VA Insurance Agents">Virginia Beach, VA</a></li>
								<li class="nav-sub-item"><a href="/agents/washington-dc/" title="Washington, DC Insurance Agents">Washington, DC</a></li>
								<li class="nav-sub-item"><a href="/agents/wichita-ks/" title="Wichita, KS Insurance Agents">Wichita, KS</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php get_footer();
