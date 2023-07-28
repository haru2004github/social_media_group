

//aside show btn
let one = document.querySelector(".one")
let two = document.querySelector(".two")
let three = document.querySelector(".three")
let aside = document.querySelector("#aside")
let content = document.querySelector("#content")
let body = document.querySelector("body")
let pointerStatus = document.querySelector('.pointerStatus')




let navIcon = document.querySelector('#navIcon')
navIcon.addEventListener('click' ,()=>{
    navIcon.classList.toggle('bg-blue-400')
    navIcon.classList.toggle('bg-red-400')
    one.classList.toggle('active')
    two.classList.toggle('active')
    three.classList.toggle('active')
    aside.classList.toggle('left-0')
    aside.classList.toggle('-left-full')
    body.classList.toggle('overflow-hidden')
    pointerStatus.classList.toggle('pointer-events-none')

})


// Select all buttons with the class "unsetScrollTo"
const buttons = document.querySelectorAll('.unsetScrollTo');

// Define the event listener function
const handleClick = (event) => {
const item = localStorage.getItem('scrollTo');
if (item) {
  // Modify the value of the item
  const updatedItem = 'home';

  // Store the updated item back into Local Storage
  localStorage.setItem('scrollTo', updatedItem);

} else {
  console.log('Item not found in Local Storage');
}


};

// Loop through each button and add the event listener
buttons.forEach((button) => {
  button.addEventListener('click', handleClick);
});
