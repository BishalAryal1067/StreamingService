let userButton = document.querySelector('.user-btn');
let imageButton = document.querySelector('.image-btn');
let videoButton = document.querySelector('.video-btn');
let fixtureButton = document.querySelector('.fixture-btn');
let categoryButton = document.querySelector('.category-btn');

let userSection = document.querySelector('.users-section');
let imageSection = document.querySelector('.images-section');
let videoSection = document.querySelector('.video-section');
let fixtureSection = document.querySelector('.fixture-section');
let categorySection = document.querySelector('.category-section');


//funcion to display and hide elements;
let hideAndDisplay = (
  hideElement1,
  hideElement2,
  hideElement3,
  hideElement4,
  displayElement
) => {
  hideElement1.classList.remove('active-section');
  hideElement2.classList.remove('active-section');
  hideElement3.classList.remove('active-section');
  hideElement4.classList.remove('active-section');
  displayElement.classList.add('active-section');
}


let buttonToggle =(inactiveBtn1,
   inactiveBtn2, 
   inactiveBtn3, 
   inactiveBtn4, 
   activeBtn5) =>{
    inactiveBtn1.classList.remove('active-button');
    inactiveBtn2.classList.remove('active-button');
    inactiveBtn3.classList.remove('active-button');
    inactiveBtn4.classList.remove('active-button');
    activeBtn5.classList.add('active-button');
   }


//loading sections
document.addEventListener('DOMContentLoaded', () => {
  userButton.classList.add('active-button');
  userSection.classList.add('active-section');
});

userButton.addEventListener('click', () => {
  buttonToggle(imageButton, videoButton,fixtureButton,categoryButton,userButton);
  hideAndDisplay(imageSection, videoSection, fixtureSection, categorySection, userSection);
});

imageButton.addEventListener('click', () => {
  buttonToggle(userButton,videoButton,fixtureButton,categoryButton,imageButton);
  hideAndDisplay(videoSection, fixtureSection, categorySection, userSection, imageSection);
});

videoButton.addEventListener('click', () => {
  buttonToggle(userButton, imageButton, fixtureButton, categoryButton, videoButton);
  hideAndDisplay(fixtureSection, categorySection, userSection, imageSection, videoSection);
});

fixtureButton.addEventListener('click', () => {
  buttonToggle(userButton,imageButton,videoButton,categoryButton, fixtureButton);
  hideAndDisplay(imageSection, videoSection, userSection, categorySection, fixtureSection);
});

categoryButton.addEventListener('click', () => {
  buttonToggle(userButton, imageButton, videoButton, fixtureButton,categoryButton)
  hideAndDisplay(imageSection, videoSection, userSection, fixtureSection, categorySection);
});


//showing modals on button click

//opening add image modal
let addImageBtn = document.querySelector('.add-image-btn');
let addImageModal = document.querySelector('.add-image-modal');
let closeImageModal = document.querySelector('#close-image-modal');
addImageBtn.addEventListener('click',()=>{
  addImageModal.classList.add('modal-active');
});

closeImageModal.addEventListener('click', ()=>{
 addImageModal.classList.remove('modal-active');
});


//add video modal
let addVideoBtn = document.querySelector('.add-video-btn');
let addVideoModal = document.querySelector('.add-video-modal');
let closeVideoModal = document.querySelector('#close-video-modal');
addVideoBtn.addEventListener('click',()=>{
  addVideoModal.classList.add('modal-active');
});

closeVideoModal.addEventListener('click', ()=>{
 addVideoModal.classList.remove('modal-active');
});


//add category modal
let addCategoryBtn = document.querySelector('.add-category-btn');
let addCategoryModal = document.querySelector('.add-category-modal');
let closeCategoryModal = document.querySelector('#close-category-modal');

addCategoryBtn.addEventListener('click',()=>{
  addCategoryModal.classList.add('modal-active');
});


closeCategoryModal.addEventListener('click', ()=>{
 addCategoryModal.classList.remove('modal-active');
});

//add fxiture modal
let addFixtureBtn = document.querySelector('.add-fixture-btn');
let addFixtureModal = document.querySelector('.add-fixture-modal');
let closeFixtureModal = document.querySelector('#close-fixture-modal');

addFixtureBtn.addEventListener('click', ()=>{
  addFixtureModal.classList.add('modal-active');
});

closeFixtureModal.addEventListener('click', ()=>{
  addFixtureModal.classList.remove('modal-active');
});












