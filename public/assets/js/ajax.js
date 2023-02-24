/* global fetch */

window.addEventListener('load', () => {
    document.getElementById('pagination').addEventListener('click', handleClick);
    fetchData('fetchdata');
});

function fetchData(page) {
    fetch(page)
    .then(function(response) {
        return response.json();
    })
    .then(function(jsonData) {
        showData(jsonData);
    })
    .catch(function(error) {
        console.log(error);
    });
}

function handleClick(e) {
    if (e.target.classList.contains('pulsable')) {
        fetchData(e.target.getAttribute('data-url'));
    }
}

function showData(data) {
    let row = document.getElementById('moviesRow');
    let paginationDiv = document.getElementById('pagination');
    let movies = data.movies.data;
    let pagination = data.movies.links;

    let string = '';
    if (movies.length > 0) {
        movies.forEach(movie => {
            let ratingStars = Math.floor(Math.random() * 5) + 1;
        	let stars = '';
        	for (let i = 0; i < ratingStars; i++) {
        	    stars += `<i class="fa fa-star" style="width: 20px;"></i>`;
        	}
        	for (let i = 0; i < 5-ratingStars; i++) {
        	    stars += `<i class="fa fa-star-o" style="width: 20px;"></i>`;
        	}
            string += `
                <div class="col-md-4 col-xs-6">
                    <div class="product">
						<div class="product-img">
						    <img src="storage/images/${movie.mainimage}" alt="">
                        </div>
                        <div class="product-body">
                            <p class="product-category">${movie.gname}</p>
    						<h3 class="product-name"><a href="movie/${movie.id}">${movie.name}</a></h3>
    						<h4 class="product-price">$${movie.price}</h4>
    						<div class="product-rating">
    							${stars}
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
            `;
        });
    } else {
        string = '<h3>No movies, sorry...</h3>';
    }
    row.innerHTML = string;

    pagination[0].label = '&lt';
    pagination[pagination.length - 1].label = '&gt';
    string = '';
    pagination.forEach(pag => {
        if (pag.active) {
            string += `
                <li class="page-item pulsable active" aria-current="page" data-url="${pag.url}">
                    <span class="page-link pulsable" data-url="${pag.url}">${pag.label}</span>
                </li>
            `;
        } else if (pag.url != null) {
            string += `
                <li class="page-item pulsable" data-url="${pag.url}">
                    <span class="page-link pulsable" data-url="${pag.url}" id="${'pag' + pag.label}">${pag.label}</span>
                </li>
            `;
        } else {
            string += `
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">${pag.label}</span>
                </li>
            `;
        }
    });
    paginationDiv.innerHTML = string;
}
