document.addEventListener('DOMContentLoaded', () => {
    const attractieSelect = document.getElementById('attractie-select');
    const onderhoudForm = document.getElementById('onderhoud-form');
    const onderhoudList = document.getElementById('onderhoud-list');

    // Fetch attracties and populate the select dropdown
    fetch('backend/api/attracties.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(attractie => {
                const option = document.createElement('option');
                option.value = attractie.id;
                option.textContent = attractie.naam;
                attractieSelect.appendChild(option);
            });
        });

    // Fetch and display onderhoudsschema's
    function fetchOnderhoud() {
        onderhoudList.innerHTML = '';
        fetch('backend/api/onderhoud.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(schema => {
                    const div = document.createElement('div');
                    div.innerHTML = `
                        <strong>Attractie ID:</strong> ${schema.attractie_id} <br>
                        <strong>Datum:</strong> ${schema.onderhoud_datum} <br>
                        <strong>Type:</strong> ${schema.onderhoud_type}
                    `;
                    onderhoudList.appendChild(div);
                });
            });
    }

    // Handle form submission
    onderhoudForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(onderhoudForm);
        const data = Object.fromEntries(formData.entries());

        fetch('backend/api/onderhoud.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            console.log(result.message);
            fetchOnderhoud();
            onderhoudForm.reset();
        });
    });

    fetchOnderhoud();
});
