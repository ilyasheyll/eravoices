document.querySelector('.admin-content__report').addEventListener('click', function(event) {
    event._skipClick = true;
});

document.querySelector('body').addEventListener('click', function(event) {
    if (event._skipClick) return;
    document.querySelector('.admin-content__report-dropdown').classList.remove('admin-content__report-dropdown--showed');
});


document.querySelector('.admin-content__report-button').addEventListener('click', () => {
    console.log(1);
    document.querySelector('.admin-content__report-dropdown').classList.toggle('admin-content__report-dropdown--showed');
});
