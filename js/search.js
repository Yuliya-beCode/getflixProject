const moviesContainer = document.getElementById('movies');
const posters = 'https://images.tmdb.org/t/p/w342'
const result = document.getElementById('result');

function searchFor(search) {
    const apiKey = '04c35731a5ee918f014970082a0088b1';
    

    const query = `https://api.themoviedb.org/3/search/movie?&api_key=${apiKey}&query=${search}`
    // let feactured = 'https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&api_key=04c35731a5ee918f014970082a0088b1&page=1'
    // let topRated = 'https://api.themoviedb.org/3/movie/top_rated?api_key=04c35731a5ee918f014970082a0088b1&language=en-US'


    fetch(query)
        .then(res => res.json())
        .then(data => {
            // data.results []
            const movies = data.results;
            const movieBlock = createMovieCard(movies);
            moviesContainer.appendChild(movieBlock);
            // console.log(data)
        })
        .catch(error => result.innerHTML = 'ERROR')

}

function checkProperties(movie){
    
}

function movieSection(movies) {
    return movies.map(movie => {
        
        let img_poster = `${posters}${movie.poster_path}`;

        if(movie.poster_path == null){
            // console.log(movie.title);
            img_poster = "./placeholder.png";
        }
        return `<div class="col mb-5">
                    <div class="card">
                        <img src=${img_poster} class="card-img-top" alt="${movie.title} poster"> 
                        <div class="card-body p-1">
                            <h5 class="card-title text-center">${movie.title}</h5>
                            <p hidden>${movie.id}</p>
                        </div>
                    </div>
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

window.addEventListener('load', (event) => {
    console.log('page is fully loaded');
  });

document.getElementById('btn_search').addEventListener("click", () => {

    // Deletes the child elements from #movies
    moviesContainer.innerHTML = '';
    const search = document.getElementById('search_input').value;
    
    // console.log(search);
    searchFor(search);


});