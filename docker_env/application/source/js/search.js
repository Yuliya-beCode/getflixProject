const moviesContainer = document.getElementById('movies');
const apiKey = '04c35731a5ee918f014970082a0088b1';
const posters = 'https://images.tmdb.org/t/p/w342'
const search_input = document.getElementById('search_input');
const result = document.getElementById('result');

const btn_trending = document.getElementById('trending');
const btn_topPopular = document.getElementById('topPopular');
const btn_topRated = document.getElementById('topRated');
const btn_action = document.getElementById('action');
const btn_comedy = document.getElementById('comedy');
const btn_horror = document.getElementById('horror');
const btn_romantic = document.getElementById('romantic');
const btn_docs = document.getElementById('docs');

const filter_buttons = [btn_trending, btn_topPopular, btn_topRated, btn_action, btn_comedy, btn_horror, btn_romantic, btn_docs];

function getSearch(search) {
    // Deletes the child elements from #movies
    moviesContainer.innerHTML = '';

    cachedFetch(search)
        .then(res => res.json())
        .then(data => {
            // data.results []
            const movies = data.results;
            const movieBlock = createMovieCard(movies);
            moviesContainer.appendChild(movieBlock);
        })
        .catch(error => result.innerHTML = 'ERROR')
}

// Cache solution in local storage (reduces database consumption)
const cachedFetch = (url, options) => {
    let expiry = 5 * 60 // 5 min default
    if (typeof options === 'number') {
        expiry = options
        options = undefined
    } else if (typeof options === 'object') {
        expiry = options.seconds || expiry
    }
    let cacheKey = url
    let cached = localStorage.getItem(cacheKey)
    let whenCached = localStorage.getItem(cacheKey + ':ts')
    if (cached !== null && whenCached !== null) {
        let age = (Date.now() - whenCached) / 1000
        if (age < expiry) {
            let response = new Response(new Blob([cached]))
            return Promise.resolve(response)
        } else {
            localStorage.removeItem(cacheKey)
            localStorage.removeItem(cacheKey + ':ts')
        }
    }
    return fetch(url, options).then(response => {
        if (response.status === 200) {
            let ct = response.headers.get('Content-Type')
            if (ct && (ct.match(/application\/json/i) || ct.match(/text\//i))) {
                response.clone().text().then(content => {
                    localStorage.setItem(cacheKey, content)
                    localStorage.setItem(cacheKey + ':ts', Date.now())
                })
            }
        }
        return response
    })
}

function searchFor(search) {
    const query = `https://api.themoviedb.org/3/search/movie?&api_key=${apiKey}&query=${search}`
    getSearch(query);
    result.innerHTML = `Movie Search Results for : ${search_input.value}`;
}


function getTrending() {

    const trending = `https://api.themoviedb.org/3/trending/all/week?api_key=${apiKey}&language=en-US`;
    getSearch(trending);
    result.innerHTML = 'Trending movies';
}

function getMostPopular() {

    const mostPopular = `https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&api_key=${apiKey}&page=1`;
    getSearch(mostPopular);
    result.innerHTML = 'Most Popular movies';
}

function getTopRated() {
    const topRated = `https://api.themoviedb.org/3/movie/top_rated?api_key=${apiKey}&language=en-US`;
    getSearch(topRated);
    result.innerHTML = 'Top rated movies';
}

function getAction() {

    const action = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&with_genres=28`;
    getSearch(action);
    result.innerHTML = 'Action movies';
}

function getComedy() {

    const comedy = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&with_genres=35`;
    getSearch(comedy);
    result.innerHTML = 'Comedy movies';
}

function getHorror() {

    const horror = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&with_genres=27`;
    getSearch(horror);
    result.innerHTML = 'Horror movies';
}

function getRomance() {

    const romantic = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&with_genres=10749`;
    getSearch(romantic);
    result.innerHTML = 'Romantic movies';
}

function getDocs() {

    const docs = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&with_genres=99`;
    getSearch(docs);
    result.innerHTML = 'Documentary movies';
}


function movieSection(movies) {
    return movies.map(movie => {
        let img_poster = `${posters}${movie.poster_path}`;

        if (movie.poster_path == null) {
            // console.log(movie.title);
            img_poster = "./placeholder.png";
        }
        return `<div class="col mb-5">
                        <a href="/info.php?id=${movie.id}" target="_blank">
                            <div class="card">
                                <img src=${img_poster} class="card-img-top" alt="${movie.title} poster"> 
                                <div class="card-body p-1">
                                    <h5 class="card-title text-center">${movie.title}</h5>
                                    <p hidden>${movie.id}</p>
                                </div>
                            </div>
                       </a> 
                   </div>`;
    })
}

function createMovieCard(movies) {
    const movieElement = document.createElement('div');
    movieElement.setAttribute('class', 'row row-cols-5 justify-content-center');

    movieTemplate = movieSection(movies);

    movieElement.innerHTML = movieTemplate;
    return movieElement;

}

window.addEventListener('load', () => {
    getTrending()
});

document.getElementById('btn_search').addEventListener("click", () => {

    // moviesContainer.innerHTML = '';
    if ((search_input.value != '') && (search_input.value != null)) {

        searchFor(search_input.value);
    }
});

function btnSwitchState() {
    filter_buttons.forEach(el => {
        if (el.classList.contains('active')) {
            el.classList.remove('active');
        }
    });
}


btn_trending.addEventListener("click", () => {
    if (!btn_trending.classList.contains('active')) {

        btnSwitchState(); // Remove active class on other buttons
        btn_trending.classList.add('active');
        getTrending()
    }
});
btn_topPopular.addEventListener("click", () => {
    if (!btn_topPopular.classList.contains('active')) {

        btnSwitchState(); // Remove active class on other buttons
        btn_topPopular.classList.add('active');
        getMostPopular()
    }
});
btn_topRated.addEventListener("click", () => {
    if (!btn_topRated.classList.contains('active')) {

        btnSwitchState(); // Remove active class on other buttons
        btn_topRated.classList.add('active');
        getTopRated()
    }
});
btn_action.addEventListener("click", () => {
    if (!btn_action.classList.contains('active')) {

        btnSwitchState(); // Remove active class on other buttons
        btn_action.classList.add('active');
        getAction()
    }
});
btn_comedy.addEventListener("click", () => {
    if (!btn_comedy.classList.contains('active')) {

        btnSwitchState(); // Remove active class on other buttons
        btn_comedy.classList.add('active');
        getComedy()
    }
});
btn_horror.addEventListener("click", () => {
    if (!btn_horror.classList.contains('active')) {

        btnSwitchState(); // Remove active class on other buttons
        btn_horror.classList.add('active');
        getHorror()
    }
});
btn_romantic.addEventListener("click", () => {
    if (!btn_romantic.classList.contains('active')) {

        btnSwitchState(); // Remove active class on other buttons
        btn_romantic.classList.add('active');
        getRomance()
    }
});
btn_docs.addEventListener("click", () => {
    if (!btn_docs.classList.contains('active')) {

        btnSwitchState(); // Remove active class on other buttons
        btn_docs.classList.add('active');
        getDocs()
    }
});