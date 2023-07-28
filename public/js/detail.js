//for preview image
function previewFile(previewImage,fileName) {
    let preview = document.getElementById(previewImage);
    let file = document.getElementById(fileName).files[0];
    const reader = new FileReader();

    reader.addEventListener(
      "load",
      () => {
        // convert image file to base64 string
        preview.src = reader.result;
      },
      false
    );

    if (file) {
      reader.readAsDataURL(file);
    }
  }
//

$(document).ready(function(){

    // Press features
    let pressTimer;

    $('.reactBtn').on("touchstart", function (e) {

    // Start the press timer
    pressTimer = setTimeout(function(){
        $parentNodeForReaction = $(this).parents('.parentForReaction')
        $parentNodeForReaction.find('.reactSelectionBox').removeClass('opacity-0 pointer-events-none')
    }, 500);
    });

    $('.reactBtn').on("touchend", function () {
    // Clear the press timer when touch ends
    clearTimeout(pressTimer);
    $parentNodeForReaction = $(this).parents('.parentForReaction')
    $parentNodeForReaction.find('.reactSelectionBox').addClass('opacity-0 pointer-events-none')
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

    // Auto Scroll this post in home page
    localStorage.setItem('scrollTo','post'+$('#postId').val())


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
                    <svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="currentColor" d="M14.8 9c.1-.3.2-.6.2-1c0-2.2-1.8-4-4-4c-1.5 0-2.9.9-3.5 2.2c-.3-.1-.7-.2-1-.2C5.1 6 4 7.1 4 8.5c0 .2 0 .4.1.5c-1.8.3-3.1 1.7-3.1 3.5C1 14.4 2.6 16 4.5 16h10c1.9 0 3.5-1.6 3.5-3.5c0-1.8-1.4-3.3-3.2-3.5zm-6.3 5.9l-3.2-3.2l1.4-1.4l1.8 1.8l3.8-3.8l1.4 1.4l-5.2 5.2z"/></svg>
                    `)

                }

            }
        })
    })
})
