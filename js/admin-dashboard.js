const userIcon = document.querySelector('.user-icon');
const userContainer = document.querySelector('.users-container');
const contentContainer = document.querySelector('.content-container');
const contentIcon = document.querySelector('.content-icon');
const addItem = document.querySelector('.add-btn');
const exitModal = document.querySelector('#exit-modal');
const modal = document.querySelector('.modal');

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

addItem.addEventListener('click', ()=>{
  modal.classList.add('modal-active');
});

exitModal.addEventListener('click', ()=>{
  modal.classList.remove('modal-active');
});


