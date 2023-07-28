let layerOne = document.querySelector('#layerOne');
let layerTwo = document.querySelector('#layerTwo');
let layerThree = document.querySelector('#layerThree');

//hide show cover modal

//showModal
const showModal=()=>{
    layerOne.classList.remove('opacity-0','pointer-events-none')
    document.getElementById('coverPhotoModal').classList.remove('opacity-0','pointer-events-none')
    layerOne.classList.add('opacity-100')
    document.getElementById('coverPhotoModal').classList.add('opacity-100','pointer-events-auto')
    localStorage.setItem('data-cover-display','show')

}

//hideModal
const hideModal =()=>{
    layerOne.classList.remove('opacity-100')
    document.getElementById('coverPhotoModal').classList.remove('opacity-100','pointer-events-auto')
    layerOne.classList.add('opacity-0','pointer-events-none')
    document.getElementById('coverPhotoModal').classList.add('opacity-0','pointer-events-none')
    localStorage.removeItem('data-cover-display')
}


let display = false;

// Switch display function
const toggleDisplayForCover = () => {
    display = !display;
    switchDisplay()
}

const switchDisplay = () => {
    display ? showModal() : hideModal()
}

const dataDisplay = localStorage.getItem('data-cover-display')

dataDisplay === 'show' ? showModal() : hideModal();
// /////////////////////////////////////////////////////////////////


// show and hide for Profile Image


//showModal For Profile Image
const showModalForProfile=()=>{
    layerTwo.classList.remove('opacity-0','pointer-events-none')
    document.getElementById('profileImageModal').classList.remove('opacity-0','pointer-events-none')
    layerTwo.classList.add('opacity-100')
    document.getElementById('profileImageModal').classList.add('opacity-100','pointer-events-auto')
    localStorage.setItem('data-profile-display','show')



}

//hideModal For Profile Image
const hideModalForProfile =()=>{
    layerTwo.classList.remove('opacity-100')
    document.getElementById('profileImageModal').classList.remove('opacity-100','pointer-events-auto')
    layerTwo.classList.add('opacity-0','pointer-events-none')
    document.getElementById('profileImageModal').classList.add('opacity-0','pointer-events-none')
    localStorage.removeItem('data-profile-display')
}


let displayForProfile = false;

// Switch theme function
const toggleDisplayForProFile = () => {
    displayForProfile = !displayForProfile;
    switchDisplayForProfile()
}

const switchDisplayForProfile = () => {
    displayForProfile ? showModalForProfile() : hideModalForProfile()
}

const dataDisplayForProfile = localStorage.getItem('data-profile-display')

dataDisplayForProfile === 'show' ? showModalForProfile() : hideModalForProfile();
////////////////////////////////////////////////////////////




// show and hide edit profile modal

 //showModal For edit
 const showModalForEditAccount=()=>{
    layerThree.classList.remove('opacity-0','pointer-events-none')
    document.getElementById('accountDetailModal').classList.remove('opacity-0','pointer-events-none')
    layerThree.classList.add('opacity-100')
    document.getElementById('accountDetailModal').classList.add('opacity-100','pointer-events-auto')
    localStorage.setItem('data-editAccount-display','show')



}

//hideModal For edit
const hideModalForEditAccount =()=>{
    layerThree.classList.remove('opacity-100')
    document.getElementById('accountDetailModal').classList.remove('opacity-100','pointer-events-auto')
    layerThree.classList.add('opacity-0','pointer-events-none')
    document.getElementById('accountDetailModal').classList.add('opacity-0','pointer-events-none')
    localStorage.removeItem('data-editAccount-display')
}


let displayForEditAccount = false;

// Switch theme function
const toggleDisplayForEdit = () => {
    displayForEditAccount = !displayForEditAccount;
    switchDisplayForEditAccount()
}

const switchDisplayForEditAccount = () => {
    displayForEditAccount ? showModalForEditAccount() : hideModalForEditAccount()
}

const dataDisplayForEdit = localStorage.getItem('data-editAccount-display')

dataDisplayForEdit === 'show' ? showModalForEditAccount() : hideModalForEditAccount();
////////////////////////////////////////////////////////////
