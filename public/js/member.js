//change role of user



 //change Display Style

/// for User list Display mode
const gridDisplay = document.querySelector("#gridDisplay")
const rowDisplay = document.querySelector("#rowDisplay")
const gridDisplayBtn = document.querySelector("#gridDisplayBtn")

let grid = false;

// Switch theme function
const toggleDisplayStyle= () => {
    grid = !grid
    switchDisplay()
}

const toGrid= () => {
    localStorage.setItem('data-display','grid')
    gridDisplay.classList.remove('hidden')
    gridDisplay.classList.add('block')
    rowDisplay.classList.remove('block')
    rowDisplay.classList.add('hidden')
    gridDisplayBtn.title = "Seen By Grids"
    gridDisplayBtn.innerHTML=`

    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21.5 2h-19a.5.5 0 0 0-.5.5v19a.5.5 0 0 0 .5.5h19a.5.5 0 0 0 .5-.5v-19a.5.5 0 0 0-.5-.5zm-13 19H3V3h5.5v18zm6 0h-5V3h5v18zm6.5 0h-5.5V3H21v18z"/></svg>`

}

const toRow= () => {
    localStorage.removeItem('data-display')
    rowDisplay.classList.remove('hidden')
    rowDisplay.classList.add('block')
    gridDisplay.classList.remove('block')
    gridDisplay.classList.add('hidden')
    gridDisplayBtn.title = "Seen By Rows"
    gridDisplayBtn.innerHTML=`
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 15.5V13h18v2.5H3ZM3 11V8.5h18V11H3Zm0-4.5V4h18v2.5H3ZM3 20v-2.5h18V20H3Z"/></svg>
    `

}

const switchDisplay = () => {
    grid ? toGrid() : toRow()
}

const dataDisplay = localStorage.getItem('data-display')

dataDisplay === 'grid' ? toGrid() : toRow();


//
