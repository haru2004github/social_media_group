let layerOne = document.querySelector('#layerOne');
let layerThree = document.querySelector('#layerThree')
let layerTwo = document.querySelector('#layerTwo');
let fullImage = document.querySelector('.fullImage');
let modalImageContainer = document.querySelector('.modalImageContainer');
let container = document.querySelector('.container');
let savePhotoBtn = document.querySelector('.savePhotoBtn');




container.addEventListener('click' ,(event)=>{
    const target = event.target;
    if(target.classList.contains('image')){
        fullImage.src = target.src
        layerTwo.classList.remove('opacity-0','pointer-events-none')
        modalImageContainer.classList.remove('opacity-0','pointer-events-none')
        savePhotoBtn.href = target.src
        body.classList.toggle('h-screen')

    }
})

//close full image
function closeFullImage(){
    layerTwo.classList.add('opacity-0','pointer-events-none')
    modalImageContainer.classList.add('opacity-0','pointer-events-none')
    body.classList.toggle('h-screen')
}


// show and hide edit group profile modal

 //showModal For edit
 const showModalForEditGroup=()=>{
    layerOne.classList.remove('opacity-0','pointer-events-none')
    document.getElementById('groupModal').classList.remove('opacity-0','pointer-events-none')
    layerOne.classList.add('opacity-100')
    document.getElementById('groupModal').classList.add('opacity-100','pointer-events-auto')
    localStorage.setItem('data-edit-group-display','show')
    body.classList.toggle('h-screen')

}

//hideModal For edit
const hideModalForEditGroup =()=>{
    layerOne.classList.remove('opacity-100')
    document.getElementById('groupModal').classList.remove('opacity-100','pointer-events-auto')
    layerOne.classList.add('opacity-0','pointer-events-none')
    document.getElementById('groupModal').classList.add('opacity-0','pointer-events-none')
    localStorage.removeItem('data-edit-group-display')
    body.classList.toggle('h-screen')

}


let displayForEditAccount = false;

// Switch theme function
const toggleDisplayForEdit = () => {
    displayForEditAccount = !displayForEditAccount;
    switchDisplayForEditGroup()
}

const switchDisplayForEditGroup = () => {
    displayForEditAccount ? showModalForEditGroup() : hideModalForEditGroup()
}

const dataDisplayForEdit = localStorage.getItem('data-edit-group-display')

dataDisplayForEdit === 'show' ? showModalForEditGroup() : hideModalForEditGroup();
////////////////////////////////////////////////////////////



// show and hide post modal

 //showModal For post
 const showModalForPost=()=>{
    layerThree.classList.remove('opacity-0','pointer-events-none')
    document.getElementById('postModal').classList.remove('opacity-0','pointer-events-none')
    layerThree.classList.add('opacity-100')
    document.getElementById('postModal').classList.add('opacity-100','pointer-events-auto')
    localStorage.setItem('data-post-display','show')
    body.classList.toggle('h-screen')


}

//hideModal For Post
const hideModalForPost =()=>{
    layerThree.classList.remove('opacity-100')
    document.getElementById('postModal').classList.remove('opacity-100','pointer-events-auto')
    layerThree.classList.add('opacity-0','pointer-events-none')
    document.getElementById('postModal').classList.add('opacity-0','pointer-events-none')
    localStorage.removeItem('data-post-display')
    body.classList.toggle('h-screen')

}


let displayForPost = false;

// Switch theme function
const toggleDisplayForPost = () => {
    displayForPost = !displayForPost;
    switchDisplayForPost()
}

const switchDisplayForPost = () => {
    displayForPost ? showModalForPost() : hideModalForPost()
}

const dataDisplayForPost = localStorage.getItem('data-post-display')

dataDisplayForPost === 'show' ? showModalForPost() : hideModalForPost();
////////////////////////////////////////////////////////////


//show post option

$(document).ready(function(){


    // show option for post
    $('.showOption').click(function(){
        $parentNode = $(this).parents('.parentNode');
        $parentNode.find('.postOption').toggleClass('opacity-0 pointer-events-none')

        $postId = $parentNode.find('#postId').val()
        $postOwnerId = $parentNode.find('#postOwnerId').val()
        $savePostBtn = $parentNode.find('.savePostBtn')

    })

    let pressTimer;

    $('.reactBtn').on("touchstart", function (e) {
    // Start the press timer
    pressTimer = setTimeout(function(){
        $parentNodeForReaction = $(this).parents('.parentForReaction')
        $parentNodeForReaction.find('.reactSelectionBox').removeClass('opacity-0 pointer-events-none')
    }, 300);
    });

    $('.reactBtn').on("touchend", function () {
    // Clear the press timer when touch ends
    clearTimeout(pressTimer);
    $parentNodeForReaction = $(this).parents('.parentForReaction')
    // $parentNodeForReaction.find('.reactSelectionBox').addClass('opacity-0 pointer-events-none')
    });

    $('.reactBtn').on("contextmenu", function (e) {
    // Prevent the default context menu from showing on desktop
    e.preventDefault();
    // Trigger the context menu function on right-click (desktop)
    $parentNodeForReaction = $(this).parents('.parentForReaction')
    $parentNodeForReaction.find('.reactSelectionBox').removeClass('opacity-0 pointer-events-none')
    });

    $('.reactBtn').on("mousedown", function (e) {
    // Check if the right mouse button is pressed (desktop)
    if (e.which === 3) {
        $parentNodeForReaction = $(this).parents('.parentForReaction')
        $parentNodeForReaction.find('.reactSelectionBox').addClass('opacity-0 pointer-events-none')
    }
    });

        // mouseleave from react selection box to close react box
    $('.reactSelectionBox').mouseleave(function(){
        $parentNodeForReaction = $(this).parents('.parentForReaction')
        $parentNodeForReaction.find('.reactSelectionBox').addClass('opacity-0 pointer-events-none')

    })

    //mouser leave from postOption auto close
    $('.postOption').mouseleave(function(){
        $parentNodeForReaction = $(this).parents('.parentNode')
        $parentNodeForReaction.find('.postOption').addClass('opacity-0 pointer-events-none')

    })

    //ajax react on post

    $(".react").click(function(event) {
        event.preventDefault();
        $reactType = $(this).attr("id");
        $parentNodeForReaction = $(this).parents('.parentForReaction')
        $postId = $parentNodeForReaction.find('#postId').val();
        $userId = $parentNodeForReaction.find('#userId').val();


        $.ajax({
            type  : 'get',
            data  :  {
                "reactType" : $reactType,
                "userId"    : $userId,
                "postId"    : $postId,
            },
            url   : "/reaction/create",
            dataType : 'json',
            success  : function(response){
                if(response.status = true){
                    localStorage.setItem('scrollTo','post'+response.scrollTo)
                    location.reload()
                }
            }
        })
    });

    //cancel reaction
    $(".reacted").click(function(event) {
        event.preventDefault();
        $parentNodeForReaction = $(this).parents('.parentForReaction')
        $postId = $parentNodeForReaction.find('#postId').val();
        $userId = $parentNodeForReaction.find('#userId').val();

        $.ajax({
            type  : 'get',
            data  :  {
                "userId"    : $userId,
                "postId"    : $postId,
            },
            url   : "/reaction/cancel",
            dataType : 'json',
            success  : function(response){
                if(response.status = true){
                    localStorage.setItem('scrollTo','post'+response.scrollTo)
                    location.reload()
                }
            }
        })
    });

    //add view to click post image
    $('.postImage').click(function(){
        $parentNode = $(this).parents('.parentNode');
        $postId = $parentNode.find('.postId').val();

          $.ajax({
              type  : 'get',
              data  :  {
                  "postId"    : $postId,
              },
              url   : "/post/viewCount",
              dataType : 'json',
          })
    })

    //add save post
    $('.savePostBtn').click(function(){
        $parentNode = $(this).parents('.postOption')
        $postId = $parentNode.find('#postId').val()
        $postOwnerId = $parentNode.find('#postOwnerId').val()
        $savePostBtn = $parentNode.find('.savePostBtn')

        $.ajax({
            type : 'get',
            data : {
                'postId' : $postId,
                'postOwnerId' : $postOwnerId
            },
            url  : "/save_post/add",
            dataType : 'json',
            success : function(response){
                if(response.status == 'saved'){
                    $savePostBtn.attr('disabled')
                    $savePostBtn.attr('title','Saved Post')
                    $savePostBtn.html(`
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="currentColor" d="M14.8 9c.1-.3.2-.6.2-1c0-2.2-1.8-4-4-4c-1.5 0-2.9.9-3.5 2.2c-.3-.1-.7-.2-1-.2C5.1 6 4 7.1 4 8.5c0 .2 0 .4.1.5c-1.8.3-3.1 1.7-3.1 3.5C1 14.4 2.6 16 4.5 16h10c1.9 0 3.5-1.6 3.5-3.5c0-1.8-1.4-3.3-3.2-3.5zm-6.3 5.9l-3.2-3.2l1.4-1.4l1.8 1.8l3.8-3.8l1.4 1.4l-5.2 5.2z"/></svg>
                    `)

                }

            }
        })
    })

    //add viewer btn
    $('.addViewerBtn').click(function(){
        $parentNode = $(this).parents('.parentNode');

        $postId = $parentNode.find('#postId').val();

          $.ajax({
              type  : 'get',
              data  :  {
                  "postId"    : $postId,
              },
              url   : "/post/viewCount",
              dataType : 'json',

          })
    })

    //set scroll to
    $('.setScrollTo').click(function(){
        $parentNode = $(this).parents('.parentNode');
        $postId = $parentNode.find('#postId').val()
        localStorage.setItem('scrollTo','post'+$postId)

    })

    //validate comment input has any data or any image
    $('.comment').on('input', function() {
        if ($(this).val().trim() !== '') {
          $('.setScrollTo').prop('disabled', false);
          $('.setScrollTo').addClass('hover:bg-slate-100 dark:hover:bg-slate-900')
        } else {
          $('.setScrollTo').prop('disabled', true);
          $('.setScrollTo').removeClass('hover:bg-slate-100 dark:hover:bg-slate-900')
        }
    });

     //validate post input has any data or any image
     $('.postInput').on('input', function() {
        if ($(this).val().trim() !== '') {
          $('.postBtn').prop('disabled', false);
          $('.postBtn').addClass('hover:bg-blue-600')
        } else {
          $('.postBtn').prop('disabled', true);
          $('.postBtn').removeClass('hover:bg-blue-600')
        }
    });


})





