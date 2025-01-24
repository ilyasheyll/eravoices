const titleInput = document.getElementById('title');
const descrInput = document.getElementById('min_descr');
const eventSelect = document.getElementById('event-select');
const imgInput = document.getElementById('image');
let imgInputValue = document.getElementById('banner_img').value;
const linkInput = document.getElementById('link');

const bannerBlock = document.querySelector('.banner');
const bannerTitle = document.querySelector('.banner__title');
const bannerDescr = document.querySelector('.banner__descr');
const bannerButton = document.querySelector('.banner__button');

document.addEventListener('DOMContentLoaded', showBanner);
eventSelect.addEventListener('change', showBanner);

titleInput.addEventListener('input', () => {
    bannerTitle.textContent = titleInput.value;
});

descrInput.addEventListener('input', () => {
    bannerDescr.textContent = descrInput.value;
});

linkInput.addEventListener('input', () => {
    bannerButton.href = linkInput.value;
});

imgInput.addEventListener('change', () => {
    const fileReader = new FileReader();
    fileReader.onload = function() {
        bannerBlock.style.backgroundImage = `url(${fileReader.result})`;
        imgInputValue = fileReader.result;
    };

    fileReader.readAsDataURL(imgInput.files[0]);
});

function showBanner() {
    if (eventSelect.value !== '') showBannerByEvent(eventSelect.value);
    else showDefaultBanner();
}

async function showBannerByEvent(eventId) {
    const response = await fetch(`/api/events/${eventId}`);
    if (!response.ok) throw new Error();
    const event = await response.json();

    const eventImgUrl = `${location.origin}/storage/${event.data.image}`;
    // document.querySelector('.admin-content__preview').style.display = 'block';
    bannerBlock.style.backgroundImage = imgInputValue !== '' ? `url(${imgInputValue})` : `url(${eventImgUrl})`;
    bannerTitle.textContent = titleInput.value;
    bannerDescr.textContent = descrInput.value;
    bannerButton.href = linkInput.value !== '' ? linkInput.value : `${location.origin}/events/${eventId}`;
}

function showDefaultBanner() {
    bannerBlock.style.backgroundImage = `url(${imgInputValue})`;
    bannerTitle.textContent = titleInput.value;
    bannerDescr.textContent = descrInput.value;
    bannerButton.href = linkInput.value;
}
