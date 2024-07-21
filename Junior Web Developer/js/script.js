document.addEventListener('DOMContentLoaded', () => {
    loadTourPackages();
    loadTourPackageOptions();
});

function loadTourPackages() {
    fetch('php/get_tour_packages.php')
        .then(response => response.json())
        .then(data => {
            const packagesContainer = document.getElementById('tour-packages');
            if (packagesContainer) {
                packagesContainer.innerHTML = data.map(package => `
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="${package.image_url}" class="card-img-top" alt="${package.name}">
                            <div class="card-body">
                                <h5 class="card-title">${package.name}</h5>
                                <p class="card-text">${package.description}</p>
                                <a href="${package.video_url}" class="btn btn-primary">Watch Video</a>
                            </div>
                        </div>
                    </div>
                `).join('');
            }
        })
        .catch(error => console.error('Error fetching tour packages:', error));
}

function loadTourPackageOptions() {
    fetch('php/get_tour_packages.php')
        .then(response => response.json())
        .then(data => {
            const packageSelect = document.getElementById('package');
            if (packageSelect) {
                packageSelect.innerHTML = data.map(package => `
                    <option value="${package.id}">${package.name}</option>
                `).join('');
            }
        })
        .catch(error => console.error('Error fetching tour package options:', error));
}
