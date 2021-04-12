const moviesContainer = document.getElementById('movies');
const apiKey = '04c35731a5ee918f014970082a0088b1';
const posters = 'https://images.tmdb.org/t/p/w185'
const tmdbBaseUrl = 'https://api.themoviedb.org/3'
const search_input = document.getElementById('search_input');
const result = document.getElementById('result');

const searchForm = document.getElementById('switch_ctrl');

//FIND BUTTONS
const findPlaylist = document.getElementById('findPlaylist');
const findCategory = document.getElementById('findCategory');
const findYear = document.getElementById('findYear');

// ## PLAYLISTS BTNS ##
const btn_nowPlay = 'nowPlay';
const btn_trending = 'trending';
const btn_upcoming = 'upcoming';
const btn_popular = 'popular';
const btn_topRated = 'topRated';

// ## PLAYLISTS QUERIES ##
const nowPlay = `${tmdbBaseUrl}/movie/now_playing?api_key=${apiKey}&language=en-US&page=1`;
const trending = `${tmdbBaseUrl}/trending/movie/week?api_key=${apiKey}&language=en-US`;
const upcoming = `${tmdbBaseUrl}/movie/upcoming?api_key=${apiKey}&language=en-US&page=1`;
const popular = `${tmdbBaseUrl}/movie/popular?api_key=${apiKey}&language=en-US&page=1`;
const topRated = `${tmdbBaseUrl}/movie/top_rated?api_key=${apiKey}&language=en-US&page=1`;
// ## CAT QUERIES ##
const catBaseQuery = `${tmdbBaseUrl}/discover/movie?api_key=${apiKey}`;
// ## BASE SEARCH QUERIES ##
const baseQuery = `${tmdbBaseUrl}/search/movie?api_key=${apiKey}`;

const playlist_btn = [btn_nowPlay, btn_trending, btn_upcoming, btn_popular, btn_topRated];

const playlist_btns = document.getElementsByClassName("playlist");
const cat_btns = document.getElementsByClassName("cat");
const year_btns = document.getElementsByClassName("year");

const wrapper = document.getElementById('filters');

function toggleFilters(btn, isActive) {
    if (isActive) {

        switch (btn.id) {
            case "findPlaylist":
                for (let i = 0; i < playlist_btns.length; i++) {
                    playlist_btns[i].classList.add('d-none');
                    playlist_btns[i].classList.remove('active');
                }
                break;
            case "findCategory":
                for (let i = 0; i < cat_btns.length; i++) {
                    cat_btns[i].classList.add('d-none');
                    cat_btns[i].classList.remove('active');
                }
                break;
            case "findYear":
                for (let i = 0; i < year_btns.length; i++) {
                    year_btns[i].classList.add('d-none');
                    year_btns[i].classList.remove('active');
                }
                break;

            default:
                break;
        }
    } else {
        switch (btn.id) {
            case "findPlaylist":
                for (let i = 0; i < playlist_btns.length; i++) {
                    playlist_btns[i].classList.remove('d-none');
                }
                break;
            case "findCategory":
                for (let i = 0; i < cat_btns.length; i++) {
                    cat_btns[i].classList.remove('d-none');
                }
                break;
            case "findYear":
                for (let i = 0; i < year_btns.length; i++) {
                    year_btns[i].classList.remove('d-none');
                }
                break;

            default:
                break;
        }
    }
}

function clickPress(event) {
    if (event.keyCode == 13) {
        goSearch();
    }
}

wrapper.addEventListener('click', (event) => {
    const isButton = event.target.nodeName === 'BUTTON';
    const btnClicked = event.target;
    if (!isButton) {
        return;
    }

    if (btnClicked.classList.contains('active')) {

        let params = new URLSearchParams(window.location.search);
        let tempParams = params;

        if (btnClicked.classList.contains('find')) {

            toggleFilters(btnClicked, true);
            btnClicked.classList.remove('active');
            switch (btnClicked.id) {
                case 'findPlaylist':

                    break;
                case 'findCategory':
                    if (getParam('category')) {
                        tempParams.delete('category');
                        window.location.search = tempParams
                    }
                    break;
                case 'findYear':
                    if (getParam('year')) {
                        tempParams.delete('year');
                        window.location.search = tempParams
                    }
                    break;

                default:
                    break;
            }


        } else if (getParam('search') && getParam('search') != "") {

            if (btnClicked.classList.contains('cat')) {

                if (getParam('category')) {
                    params.delete('category');
                }
            }
            if (btnClicked.classList.contains('year')) {

                if (getParam('year')) {
                    params.delete('year');
                }
            }
            window.location.search = params;
        }

    } else {

        if (btnClicked.classList.contains('find')) {

            toggleFilters(btnClicked, false);
            btnClicked.classList.add('active');

        } else if (getParam('search') && getParam('search') != "") {

            let params = new URLSearchParams(window.location.search);

            if (btnClicked.classList.contains('cat')) {

                if (getParam('category')) {
                    params.delete('category');
                }
                params.append('category', `${btnClicked.id}`);
            }
            if (btnClicked.classList.contains('year')) {

                if (getParam('year')) {
                    params.delete('year');
                }
                params.append('year', `${btnClicked.id}`);
            }
            window.location.search = params;

        } else {
            if (btnClicked.classList.contains('playlist')) {
                const params = "?" + new URLSearchParams({
                    playlist: `${btnClicked.id}`
                })
                window.location.search = params;
            }
            if (btnClicked.classList.contains('cat')) {

                const params = "?" + new URLSearchParams({
                    category: `${btnClicked.id}`
                })
                window.location.search = params;
            }
        }
    }
})

// Cache solution in local storage (reduces database consumption)
const cachedFetch = (url, options) => {
    let expiry = 2 * 60 // 2 min default
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
                    try {
                        localStorage.setItem(cacheKey, content)
                        localStorage.setItem(cacheKey + ':ts', Date.now())
                    } catch (e) {
                        if (e.name === 'QuotaExceededError' || e.name === 'QUOTA_EXCEEDED_ERR') {
                            console.log("Memory is full. Cannot cache the results.");
                        } else {
                            console.log("Something went wrong while caching. Try again later.")
                        }
                    }
                })
            }
        }
        return response
    })
}

let moviesFound = 0;
let newPage = 1;
let nPages = 1;

async function getMovies(search, category = []) {
    console.log('calling');
    let result = 0;

    for (let i = 1; i <= nPages; i++) {
        if (result < 19) {
            result = await getSearch(search, category, i);
        }
    }
    console.log('nPages = ' + nPages);
    console.log('Result = ' + result);
}

function findCommonElements(arr1, arr2) {
    return arr1.some(item => arr2.includes(item))
}

let movieElement = document.createElement('div');

// FETCH PROCESS
async function getSearch(search, category = [], page = 1) {
    // Deletes the child elements from #movies
    if (page == 1) {
        moviesContainer.innerHTML = '';
    }
    // cachedFetch(`${search}&page=${page}`)
    await cachedFetch(`${search}&page=${page}`)
        .then(res => res.json())
        .then(data => {

            nPages = data.total_pages;
            let movies = data.results;

            movieElement.setAttribute('class', 'row  row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 row-cols-xxl-7 justify-content-start');
            let tempMovies = movies.map(movie => {

                // movie.genre_ids.includes(category) 
                // console.log(category);
                if (category.length == 0 || findCommonElements(movie.genre_ids, category)) {

                    moviesFound += 1;
                    // console.log(moviesFound);

                    let img_poster = `${posters}${movie.poster_path}`;

                    if (movie.poster_path == null) {
                        // console.log(movie.title);
                        img_poster = "./placeholder.png";
                    }
                    return `<div class="col mb-5">
                                <div id="movie_${moviesFound}" class="card" onclick="showDetails(${movie.id})">
                                    <img src=${img_poster} class="card-img-top" alt="${movie.title} poster"> 
                                    <div class="card-body p-1">
                                        <h5 class="card-title text-center">${movie.title}</h5>
                                        <p hidden>${movie.id}</p>
                                    </div>
                                </div>
                            </div>`;
                }
            })

            movieElement.insertAdjacentHTML('beforeend', tempMovies.join(' '));
            moviesContainer.appendChild(movieElement);

        })
        .catch(error => result.innerHTML = 'ERROR');
    return moviesFound;
}

// Only for direct simple search
function searchFor(search) {
    const query = `https://api.themoviedb.org/3/search/movie?&api_key=${apiKey}&query=${search}`
    getSearch(query);
    result.innerHTML = `Movie Search Results for : ${search_input.value}`;
}

const btnSearch = document.getElementById('btn_search');

function goSearch() {
    let curSearch = search_input.value;
    if ((curSearch != '') && (curSearch != null)) {

        const cleanText = curSearch.replace(/<\/?[^>]+(>|$)/g, "");
        let params = new URLSearchParams(window.location.search);
        if (getParam('search')) {
            params.set('search', `${cleanText}`);
        } else {
            params = "?" + new URLSearchParams({
                search: `${cleanText}`
            })
        }
        window.location.search = params;
    } else {
        window.location.search = '';
    }
}

btnSearch.addEventListener("click", () => {
    goSearch();

});

function getParam(paramName) {
    let params = new URLSearchParams(window.location.search);
    return params.get(paramName);
}
// GET REQUEST HANDLER
document.addEventListener("DOMContentLoaded", () => {

    const params = new URLSearchParams(window.location.search);

    if (Array.from(params).length) {

        console.log(`We have ${Array.from(params).length} parameters here.`);
        let curParam;

        if (getParam('search') && getParam('search') != "") {
            const searchText = getParam('search');
            document.getElementById("filterText").innerHTML = "Filter by :";
            let searchParam = '';
            let catParam = [];
            let yearParam = '';
            let urlToFetch = `${baseQuery}&query=${searchText}`;
            let btn;
            const paramArray = Array.from(params);

            findPlaylist.classList.add('d-none');

            toggleFilters(findPlaylist, true);
            // toggleFilters(findCategory, false);


            paramArray.forEach(el => {
                switch (el[0]) {
                    case 'year':
                        if (el[1] != "") {
                            if (!yearParam) {
                                console.log(el[1]);
                                toggleFilters(findYear, false);
                                findYear.classList.add('active');
                                try {
                                    document.getElementById(el[1]).classList.add('active');
                                    urlToFetch += `&year=${el[1]}`;
                                    yearParam = `${el[1]}, `;
                                } catch {}
                            }
                        }
                        break;
                    case 'category':
                        if (el[1] != "") {
                            if (catParam.length == 0) {
                                // console.log(el[1]);
                                toggleFilters(findCategory, false);
                                findCategory.classList.add('active');
                                try {
                                    btn = document.getElementById(el[1]);
                                    btn.classList.add('active');
                                    catParam.push(Number(btn.value));
                                } catch {}
                            }
                        }
                        break;
                    default:
                        // findCategory.classList.add('active');
                        break;
                }
            });
            // getSearch(urlToFetch, catParam);
            getMovies(urlToFetch, catParam);
            search_input.value = searchText;

        } else {
            findYear.classList.add('d-none');
            if (getParam('playlist')) {

                curParam = getParam('playlist');
                const btnActive = document.getElementById(curParam);

                try {
                    getSearch(eval(curParam));
                    btnActive.classList.add('active');
                    toggleFilters(findPlaylist, false);
                    toggleFilters(findCategory, true);
                    toggleFilters(findYear, true);
                } catch (error) {
                    getSearch(nowPlay);
                    document.getElementById(btn_nowPlay).classList.add('active');
                }
                search_input.value = "";
                findPlaylist.classList.add('active');
            }
            if (getParam('category')) {
                curParam = getParam('category');
                const btnActive = document.getElementById(curParam);
                try {
                    getSearch(`${catBaseQuery}&with_genres=${btnActive.value}`);
                    btnActive.classList.add('active');
                    toggleFilters(findPlaylist, true);
                    toggleFilters(findCategory, false);
                    toggleFilters(findYear, true);
                } catch (error) {
                    getSearch(nowPlay);
                    document.getElementById(btn_nowPlay).classList.add('active');
                }
                search_input.value = "";
                findCategory.classList.add('active');
            }
        }
    } else {
        params.delete('search');
        getSearch(nowPlay);
        findPlaylist.classList.add('active');
        findYear.classList.add('d-none');
        document.getElementById("nowPlay").classList.add('active');
        console.log('No parameters to pass.');
    }
});

function showDetails(movieId) {
    console.log(movieId);
    params = "?" + new URLSearchParams({
        movie: `${movieId}`
    })
    window.location.href = 'info.php'+params;
    // window.location = params;
}