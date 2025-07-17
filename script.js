// ========== HAMBURGER MENU TOGGLE ==========
const hamburger = document.getElementById('hamburger');
const navLinks = document.querySelector('.nav-links');

hamburger.addEventListener('click', () => {
  navLinks.classList.toggle('active');
});


// ========== TV MAZE API SEARCH ==========
const searchInput = document.getElementById('searchInput');
const searchResults = document.getElementById('searchResults');
const favoritesGrid = document.getElementById('favoritesGrid');

let favorites = [];

// Listen for input
searchInput.addEventListener('input', async () => {
  const query = searchInput.value.trim();

  if (query.length < 2) {
    searchResults.innerHTML = '';
    return;
  }

  const res = await fetch(`https://api.tvmaze.com/search/shows?q=${query}`);
  const data = await res.json();

  displayResults(data);
});

function displayResults(shows) {
  searchResults.innerHTML = '';

  shows.forEach(item => {
    const show = item.show;

    const card = document.createElement('div');
    card.className = 'card';

    const image = show.image ? show.image.medium : 'https://via.placeholder.com/210x295?text=No+Image';
    const summary = show.summary ? show.summary.replace(/<[^>]+>/g, '') : 'No description available.';

    card.innerHTML = `
      <img src="${image}" alt="${show.name}" />
      <h3>${show.name}</h3>
      <p>${summary.substring(0, 100)}...</p>
      <button class="add-btn">+ Add to Favorites</button>
    `;

    card.querySelector('.add-btn').addEventListener('click', () => addToFavorites(show));
    searchResults.appendChild(card);
  });
}


// ========== ADD TO FAVORITES ==========
function addToFavorites(show) {
  if (favorites.find(fav => fav.id === show.id)) return;

  favorites.push(show);
  renderFavorites();
}

function removeFromFavorites(id) {
  favorites = favorites.filter(show => show.id !== id);
  renderFavorites();
}

function renderFavorites() {
  favoritesGrid.innerHTML = '';

  favorites.forEach(show => {
    const card = document.createElement('div');
    card.className = 'card';

    const image = show.image ? show.image.medium : 'https://via.placeholder.com/210x295?text=No+Image';
    const summary = show.summary ? show.summary.replace(/<[^>]+>/g, '') : 'No description available.';

    card.innerHTML = `
      <img src="${image}" alt="${show.name}" />
      <h3>${show.name}</h3>
      <p>${summary.substring(0, 100)}...</p>
      <button class="remove-btn">× Remove</button>
    `;

    card.querySelector('.remove-btn').addEventListener('click', () => removeFromFavorites(show.id));
    favoritesGrid.appendChild(card);
  });
}
