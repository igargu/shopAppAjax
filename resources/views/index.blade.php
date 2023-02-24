@extends('app.base')

@section('content')
<script>
	window.addEventListener("load", function(event) {
		if (document.getElementsByClassName('pagination').length > 0) {
			let ul = document.getElementsByClassName('pagination')[0];
			ul.classList.remove("pagination");
			ul.classList.add("store-pagination");
		}
	});
</script>
<div class="section">
	<div class="container">
		<div class="row">
			<div id="aside" class="col-md-3">
				<div id="asideClearFilters" class="aside" hidden>
					<a id="btClearFilters" class="primary-btn cta-btn filter-button">Clear filters</a>
				</div>
				<script>
					/* global $ global showData */
					document.getElementById('btClearFilters').addEventListener("click", function(event) {
						$.ajax({
					    	type: 'get',
					        url: '{{ url("fetchdata") }}',
					        data: {
					        	'q': document.getElementById("q").value,
					        	'orderby': ob,
						        'ordertype': ot
					        },
					        success: function(data) {
					        	showData(data);
					        }
					    });
					    
					    auxCont = 0;
					    fo = '';
						ge = '';
						pr = '';
					    $("input:checkbox").attr('checked', false);
					    document.getElementById('price-min').value = 0;
						document.getElementById('price-max').value = 900;
						document.getElementById("asideClearFilters").toggleAttribute("hidden");
					});
				</script>
				<div class="aside">
					<h3 class="aside-title">Format</h3>
					<div class="checkbox-filter">
						<?php
						$formats = Illuminate\Support\Facades\DB::select('select * from format');
						foreach($formats as $format) {
						?>
						<div class="input-checkbox">
							<input type="checkbox" id="cb-format-{{ strtolower($format->name) }}" value="{{ strtolower($format->name) }}" />
							<label for="cb-format-{{ strtolower($format->name) }}">
								<span></span>
								{{ $format->name }}
							</label>
						</div>
						<?php
						}
						?>
					</div>
				</div>
				<div class="aside">
					<h3 class="aside-title">Genre</h3>
					<div class="checkbox-filter">
						<?php
						$genres = Illuminate\Support\Facades\DB::select('select * from genre');
						foreach($genres as $genre) {
						?>
						<div class="input-checkbox">
							<input type="checkbox" id="cb-genre-{{ strtolower($genre->name) }}" value="{{ strtolower($genre->name) }}" />
							<label for="cb-genre-{{ strtolower($genre->name) }}">
								<span></span>
								{{ $genre->name }}
							</label>
						</div>
						<?php
						}
						?>
					</div>
				</div>
				<div class="aside">
					<h3 class="aside-title">Price</h3>
					<div class="price-filter">
						<div class="input-number price-min">
							<input id="price-min" type="number" value="0">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
						<span>-</span>
						<div class="input-number price-max">
							<input id="price-max" type="number" value="900">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
					</div>
				</div>
				<script>
					document.getElementById('aside').addEventListener("change", function(event) {
						let filterFormat = '';
						for (format of <?= json_encode($formats); ?>) {
							let cb = document.getElementById('cb-format-'+format.name.toLowerCase());
							if (cb.checked) {
								filterFormat += `${format.name}:`;
							}
						}
						filterFormat = filterFormat.replace(/.$/,"");
						
						let filterGenre = '';
						for (genre of <?= json_encode($genres); ?>) {
							let cb = document.getElementById('cb-genre-'+genre.name.toLowerCase());
							if (cb.checked) {
								filterGenre += `${genre.name}:`;
							}
						}
						filterGenre = filterGenre.replace(/.$/,"");
						
						let priceMin = document.getElementById('price-min').value;
						let priceMax = document.getElementById('price-max').value;
						let filterPrice = `${priceMin}:${priceMax}`;
						
						fo = filterFormat;
						ge = filterGenre;
						pr = filterPrice;
						
						$.ajax({
					    	type: 'get',
					        url: '{{ url("fetchdata") }}',
					        data: {
					        	'q': document.getElementById("q").value,
					        	'orderby': ob,
						        'ordertype': ot,
					        	'format': filterFormat,
					        	'genre': filterGenre,
								'price': filterPrice
					        },
					        success: function(data) {
					        	showData(data);
					        }
					    });
					    
					    auxCont++;
					    
					    if (!$("input:checkbox").is(":checked") 
					    	 && (priceMin == 0 && priceMax == 900)) {
					    	auxCont = 0;
					    }
					    
					    if (auxCont == 1 ||auxCont == 0) {
					    	document.getElementById("asideClearFilters").toggleAttribute("hidden");
					    }
					});
				</script>
			</div>
			<div id="store" class="col-md-9">
				<div class="store-filter clearfix">
					<div class="store-sort">
						Sort By:
						<a id="sort1" onclick="orderMovies('b1', 't1', 1)" class="active">Default</a>
						<a id="sort2" onclick="orderMovies('b2', 't1', 2)">Name: A to Z</a>
						<a id="sort3" onclick="orderMovies('b2', 't2', 3)">Name: Z to A</a>
						<a id="sort4" onclick="orderMovies('b6', 't1', 4)">Price: Low to High</a>
						<a id="sort5" onclick="orderMovies('b6', 't2', 5)">Price: High to Low</a>
					</div>
					<script>
						/* global $ global showData */
						function orderMovies (orderBy, orderType, sortID) {
							$('.store-sort').children().each( function() {
								if($(`#${this.id}`).hasClass('active')) {
									$(`#${this.id}`).toggleClass('active');
								}
							});
							$(`#sort${sortID}`).toggleClass('active');
							
							ob = orderBy;
							ot = orderType;
							
						    $.ajax({
						        type: 'get',
						        url: '{{ url("fetchdata") }}',
						        data: {
						        	'q': document.getElementById("q").value,
						        	'orderby': orderBy,
						        	'ordertype': orderType,
						        	'format': fo,
						        	'genre': ge,
									'price': pr
						        },
						        success: function(data) {
						        	showData(data);
						        }
						    });
						}
					</script>
				</div>
				<div id="moviesRow" class="row"></div>
				<div class="store-filter clearfix paginator">
					<nav>
						<ul id="pagination" class="store-pagination"></ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
