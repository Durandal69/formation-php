function toggleLivres() {
    let el = document.getElementById('tableLivres');
    el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
}

function toggleAuteurs() {
    let el = document.getElementById('tableAuteurs');
    el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
}

function toggleMembres() {
    let el = document.getElementById('tableMembres');
    el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
}

function toggleEmprunts() {
    let el = document.getElementById('tableEmprunts');
    el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
}