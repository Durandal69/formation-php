// function toggleLivres() {
//     let el = document.getElementById('tableLivres');
//     el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
// }

// function toggleAuteurs() {
//     let el = document.getElementById('tableAuteurs');
//     el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
// }

// function toggleMembres() {
//     let el = document.getElementById('tableMembres');
//     el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
// }

// function toggleEmprunts() {
//     let el = document.getElementById('tableEmprunts');
//     el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
// }


function toggleAll(displayLivre, displayAuteur, displayMembre, displayEmprunt) {
    document.getElementById('tableLivres').style.display = (displayLivre) ? 'block' : 'none';
    document.getElementById('tableAuteurs').style.display = (displayAuteur) ? 'block' : 'none';
    document.getElementById('tableMembres').style.display = (displayMembre) ? 'block' : 'none';
    document.getElementById('tableEmprunts').style.display = (displayEmprunt) ? 'block' : 'none';
}