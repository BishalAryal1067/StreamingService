const userIcon = document.querySelector('.user-icon');
const userContainer = document.querySelector('.users-container');
const contentContainer = document.querySelector('.content-container');
const contentIcon = document.querySelector('.content-icon');
const addItem = document.querySelector('.add-btn');
// const exitModal = document.querySelector('#exit-modal');
// const modal = document.querySelector('.modal');

document.addEventListener('DOMContentLoaded', () => {
    userContainer.classList.add('users-active');
    userIcon.classList.add('user-icon-active');

});


contentIcon.addEventListener('click', () => {
    userIcon.classList.remove('user-icon-active');
    userContainer.classList.remove('.users-active');    
    contentIcon.classList.add('content-icon-active');
    contentContainer.classList.add('content-active')
});


userIcon.addEventListener('click', () => {
    contentIcon.classList.remove('content-icon-active');
    contentContainer.classList.remove('content-active');
    userIcon.classList.add('user-icon-active');
    userContainer.classList.add('users-active');
    
});


//showing popup on button click
// addItem.addEventListener('click', ()=>{
//   modal.classList.add('modal-active');
// });

// exitModal.addEventListener('click', ()=>{
//   modal.classList.remove('modal-active');
// });


//showing fixture pop up
const fixtureModal = document.querySelector('#fixtures-modal');
const fixture = document.querySelector('#fixture');
const exitFixture = document.querySelector('#exit-fixture');


fixture.addEventListener('click', ()=>{
  fixtureModal.style.display= 'block';
});

exitFixture.addEventListener('click', ()=>{
  fixtureModal.style.display = 'none';
});


//showing video pop up
const videoModal = document.querySelector('#video-modal');
const video = document.querySelector('#video');
const exitVideo = document.querySelector('#exit-video');


video.addEventListener('click', ()=>{
  videoModal.style.display= 'block';
});

exitVideo.addEventListener('click', ()=>{
  videoModal.style.display = 'none';
});

//showing photo pop up
const photoModal = document.querySelector('#photo-modal');
const photo = document.querySelector('#photo');
const exitPhoto = document.querySelector('#exit-photo');


photo.addEventListener('click', ()=>{
  photoModal.style.display= 'block';
});

exitPhoto.addEventListener('click', ()=>{
  photoModal.style.display = 'none';
});

//showing fixture pop up
const newsModal = document.querySelector('#news-modal');
const news = document.querySelector('#news');
const exitNews = document.querySelector('#exit-news');


news.addEventListener('click', ()=>{
  newsModal.style.display= 'block';
});

exitNews.addEventListener('click', ()=>{
  newsModal.style.display = 'none';
});