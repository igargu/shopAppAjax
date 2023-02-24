@extends('app.base')

@section('content')
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
					<?php $movieImages = Illuminate\Support\Facades\DB::select('select * from image where idmovie = ' . $movie->id . ' and name != "' . $movie->mainimage . '"'); ?>
					<div class="product-preview">
						<img src="{{ asset('storage/images/' . $movie->mainimage) }}" alt="">
					</div>
					@foreach($movieImages as $movieImage)
					<div class="product-preview">
						<img src="{{ asset('storage/images/' . $movieImage->name) }}" alt="">
					</div>
					@endforeach
					<div class="product-preview">
						<img src="{{ asset('storage/images/' . $movie->mainimage) }}" alt="">
					</div>
					@foreach($movieImages as $movieImage)
					<div class="product-preview">
						<img src="{{ asset('storage/images/' . $movieImage->name) }}" alt="">
					</div>
					@endforeach
				</div>
			</div>
			<!-- /Product main img -->

			<!-- Product thumb imgs -->
			<div class="col-md-2 col-md-pull-5">
				<div id="product-imgs">
					<?php $movieImages = Illuminate\Support\Facades\DB::select('select * from image where idmovie = ' . $movie->id . ' and name != "' . $movie->mainimage . '"'); ?>
					<div class="product-preview">
						<img src="{{ asset('storage/images/' . $movie->mainimage) }}" alt="">
					</div>
					@foreach($movieImages as $movieImage)
					<div class="product-preview">
						<img src="{{ asset('storage/images/' . $movieImage->name) }}" alt="">
					</div>
					@endforeach
					<div class="product-preview">
						<img src="{{ asset('storage/images/' . $movie->mainimage) }}" alt="">
					</div>
					@foreach($movieImages as $movieImage)
					<div class="product-preview">
						<img src="{{ asset('storage/images/' . $movieImage->name) }}" alt="">
					</div>
					@endforeach
				</div>
			</div>
			<!-- /Product thumb imgs -->

			<!-- Product details -->
			<div class="col-md-5">
				<div class="product-details">
					<h2 class="product-name">{{ $movie->name }}</h2>
					<div class="row-movie-info">
						<ul class="product-links">
							<li><strong>Genre:</strong></li>
							<li>{{ $movie->genre->name }}</li>
						</ul>
						<ul class="product-links product-links-right">
							<li><strong>Format:</strong></li>
							<li>{{ $movie->format->name }}</li>
						</ul>
					</div>
					<div>
						<div class="product-rating">
							<?php
							$ratingStars = rand(0, 5); 
							for ($i = 0; $i < $ratingStars; $i++) {
							?>
							<i class="fa fa-star"></i>
							<?php }
							for ($i = 0; $i < 5-$ratingStars; $i++) {
							?>
							<i class="fa fa-star-o"></i>
							<?php } ?>
						</div>
						<a class="review-link" href="#">10 Review(s) | Add your review</a>
					</div>
					<div>
						<h2 class="product-price">${{ $movie->price }}</h2>
						<span class="product-available">In Stock</span>
					</div>
					<div class="add-to-cart">
						<div class="qty-label">
							Qty
							<div class="input-number">
								<input type="number" value="0">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
						</div>
						<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
					</div>

					<ul class="product-btns">
						<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
						<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
					</ul>
				</div>
			</div>
			<!-- /Product details -->

			<!-- Product tab -->
			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Synopsis</a></li>
						<li><a data-toggle="tab" href="#tab2">Details</a></li>
						<li><a data-toggle="tab" href="#tab3">Reviews</a></li>
					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<p>{{ $movie->description }}</p>
								</div>
							</div>
						</div>
						<!-- /tab1  -->

						<!-- tab2  -->
						<div id="tab2" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table-info">
											<tbody class="tbody-info">
												<tr class="tr-info">
													<td class="td-info">
														<strong>DISCS</strong>
														<div>{{ $movie->discs }}</div>
													</td>
													<td class="td-info">
														<strong>RUN-TIME</strong>
														<?php 
														$time = explode(':', $movie->runtime);
														$runtime = ($time[0]*60) + ($time[1]) + ($time[2]/60);
														?>
														<div>{{ $runtime }}</div>
													</td>
													<td class="td-info">
														<strong>REGION</strong>
														<div>{{ $movie->region }}</div>
													</td>
													<td class="td-info">
														<strong>RATING</strong>
														<div>{{ $movie->rating }}</div>
													</td>
												</tr>
												<tr class="tr-info" align="center">
													<td class="td-info">
														<strong>PRODUCTION DATE</strong>
														<div>{{ $movie->date }}</div>
													</td>
													<td class="td-info">
														<strong>CLOSED-CAPTIONED</strong>
														<div>{{ $movie->closedcaptioned }}</div>
													</td>
													<td class="td-info">
														<strong>LANGUAGE</strong>
														<div>{{ $movie->language }}</div>
													</td>
													<td class="td-info">
														<strong>SUBTITLES</strong>
														<div>{{ $movie->subtitles }}</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- /tab2  -->

						<!-- tab3  -->
						<div id="tab3" class="tab-pane fade in">
							<div class="row">
								<div class="mt-5">
								    <div id="disqus_thread"></div>
								    <script type="application/javascript">
								        var disqus_config = function () {};
								        (function () {
								            if (["localhost", "127.0.0.1"].indexOf(window.location.hostname) != -1) {
								                document.getElementById('disqus_thread').innerHTML = 'Disqus comments not available by default when the website is previewed locally.';
								                return;
								            }
								            var d = document, s = d.createElement('script'); s.async = true;
								            s.src = '//' + "themefisher-template" + '.disqus.com/embed.js';
								            s.setAttribute('data-timestamp', +new Date());
								            (d.head || d.body).appendChild(s);
								        })();
								    </script>
								    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
								    <a href="https://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
								</div>
							</div>
						</div>
						<!-- /tab3  -->
					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-12">
				<div class="section-title text-center">
					<h3 class="title">Discover More Movies</h3>
				</div>
			</div>
			<?php
			$relatedMovies = Illuminate\Support\Facades\DB::select('select * from movie');
			$showedMovies = array();
			$cont = 0; 
			while($cont < 4) {
				$id = rand(0, count($relatedMovies) - 1);
				if ( ($relatedMovies[$id]->id != $movie->id) && (!in_array($id, $showedMovies)) ) {
					array_push($showedMovies, $id);
					$relatedMovie = $relatedMovies[$id];
			?>
			<!-- product -->
			<div class="col-md-3 col-xs-6">
				<div class="product">
					<div class="product-img">
						<img src="{{ asset('storage/images/' . $relatedMovie->mainimage) }}" alt="">
					</div>
					<div class="product-body">
						<?php
						$relatedMovieGenre = Illuminate\Support\Facades\DB::select('select * from genre where id = '.$relatedMovie->idgenre);
						?>
						<p class="product-category">{{ $relatedMovieGenre[0]->name }}</p>
						<h3 class="product-name"><a href="{{ url('movie/' . $relatedMovie->id) }}">{{ $relatedMovie->name }}</a></h3>
						<h4 class="product-price">${{ $relatedMovie->price }}</h4>
						<div class="product-rating">
						</div>
						<div class="product-btns">
							<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
							<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
							<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
						</div>
					</div>
					<div class="add-to-cart">
						<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
					</div>
				</div>
			</div>
			<!-- /product -->
			<?php
				$cont++;
				}
			}
			?>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
@endsection
