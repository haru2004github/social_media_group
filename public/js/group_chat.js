function show(modalName){
    document.getElementById(modalName).classList.toggle('opacity-100')
    document.getElementById(modalName).classList.toggle('pointer-events-auto')
}



//for preview image
function previewFile() {
  const preview = document.querySelector("#previewImage");
  const file = document.querySelector("#file").files[0];
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

//pre view edit image

function previewFileForEditImage() {
    const previewEditImage = document.querySelector("#previewEditImage");
    const editFile = document.querySelector("#fileForEditImage").files[0];
    const editReader = new FileReader();

    editReader.addEventListener(
      "load",
      () => {
        // convert image file to base64 string
        previewEditImage.src = editReader.result;
      },
      false
    );

    if (editFile) {
      editReader.readAsDataURL(editFile);
    }
  }
  //


//pre view edit image
function previewFileForEditMessageAndImage() {
    const previewEditMessageAndImage = document.querySelector("#previewEditMessageAndImage");
    const editFileImage = document.querySelector("#fileForEditMessageAndImage").files[0];
    const editReaderImage = new FileReader();

    editReaderImage.addEventListener(
      "load",
      () => {
        // convert image file to base64 string
        previewEditMessageAndImage.src = editReaderImage.result;
      },
      false
    );

    if (editFileImage) {
      editReaderImage.readAsDataURL(editFileImage);
    }
  }
  //





 //change background image

/// for dark mode
const createBackBtn = document.querySelector("#createBackBtn")
const groupChatBackground = document.querySelector("#groupChatBackground")

let background = false;
// Switch theme function
const toggleBackground = () => {
    background = !background;
    switchBackground()
}

const setBackground= () => {
    localStorage.setItem('data-background','selected')
    createBackBtn.innerHTML= "Delete Background"
    groupChatBackground.classList.remove(`dark:bg-slate-900]` )
    groupChatBackground.classList.add(`bg-[url('https://blog.1a23.com/wp-content/uploads/sites/2/2020/02/pattern-33.svg')]` )
}

const removeBackground= () => {
    localStorage.removeItem('data-background')
    createBackBtn.innerHTML = "Create Background"
    groupChatBackground.classList.remove(`bg-[url('https://blog.1a23.com/wp-content/uploads/sites/2/2020/02/pattern-33.svg')]` )
    groupChatBackground.classList.add(`dark:bg-slate-900` )

}

const switchBackground = () => {
    background ? setBackground() : removeBackground()
}

const dataBackground = localStorage.getItem('data-background')

dataBackground === 'selected' ? setBackground() : removeBackground();


//
$(document).ready(function(){
    // for auto scroll down
    $('.chat-container').animate({ scrollTop: $('.chat-messages').height() }, 'slow');



//mouser key down for only message to show option
$(".messageContent").on('contextmenu',function(event){
    event.preventDefault();
   $parentNodeForMessage = $(this).parents('.parentMessage');
   $parentNodeForMessage.find('.option').removeClass('opacity-0 pointer-events-none')
   $parentNodeForMessage.find('.option').addClass('opacity-100')

});

// mouser key down for only image to show option
$(".messageImage").on('contextmenu',function( event){
    event.preventDefault();
    $parentNodeForMessage = $(this).parents('.parentImage');
    $parentNodeForMessage.find('.option').removeClass('opacity-0 pointer-events-none')
    $parentNodeForMessage.find('.option').addClass('opacity-100')

 });

//  mouser key down for both message and image to show option
 $(".bothContentAndImageMessage").on('contextmenu',function(event){
    event.preventDefault();
    $parentNodeForMessage = $(this).parents('.parentImageAndMessage');
    $parentNodeForMessage.find('.option').removeClass('opacity-0 pointer-events-none')
    $parentNodeForMessage.find('.option').addClass('opacity-100')

 });


//show message input box and option
$('.messageShowInput').click(function(){
    $parentNodeForMessage = $(this).parents('.parentMessage');
    $parentNodeForMessage.find('.messageText').addClass('hidden')
    $parentNodeForMessage.find('.messageEdit').removeClass('hidden')
    $parentNodeForMessage.find('.messageEdit').addClass('block')
    $parentNodeForMessage.find(this).addClass('hidden')
    $parentNodeForMessage.find('.editBtn').removeClass('hidden')
    $parentNodeForMessage.find('.editBtn').addClass('flex')

})

// close option for only message
$('.cancelBtn').click(function(){
    $parentNodeForMessage = $(this).parents('.parentMessage');
    $parentNodeForMessage.find('.option').removeClass('opacity-100')
    $parentNodeForMessage.find('.option').addClass('opacity-0 pointer-events-none')
    $parentNodeForMessage.find('.messageEdit').removeClass('flex')
    $parentNodeForMessage.find('.messageEdit').addClass('hidden')
    $parentNodeForMessage.find('.messageShowInput').removeClass('hidden')
    $parentNodeForMessage.find('.messageText').removeClass('hidden')
    $parentNodeForMessage.find('.messageText').addClass('inline')
    $parentNodeForMessage.find('.editBtn').addClass('hidden')
    $parentNodeForMessage.find('.editBtn').removeClass('flex')

 })

//show image edit image selection and option section
$('.showEditImage').click(function(){
    $parentNodeForMessage = $(this).parents('.parentImage');
    $parentNodeForMessage.find(this).addClass('hidden')
    $parentNodeForMessage.find('.chooseImageBtn').removeClass('hidden')
    $parentNodeForMessage.find('.chooseImageBtn').addClass('block')
    $parentNodeForMessage.find('.deleteBtn').addClass('hidden')
    $parentNodeForMessage.find('.uploadImageBtn').removeClass('hidden')
    $parentNodeForMessage.find('.uploadImageBtn').addClass('flex')

})

// close option for only image
$('.cancelBtnForImage').click(function(){
    $parentNodeForMessage = $(this).parents('.parentImage');
    $parentNodeForMessage.find('.option').removeClass('opacity-100')
    $parentNodeForMessage.find('.option').addClass('opacity-0 pointer-events-none')

    $parentNodeForMessage.find('.showEditImage').removeClass('hidden')
    $parentNodeForMessage.find('.chooseImageBtn').removeClass('block')
    $parentNodeForMessage.find('.chooseImageBtn').addClass('hidden')
    $parentNodeForMessage.find('.deleteBtn').removeClass('hidden')
    $parentNodeForMessage.find('.uploadImageBtn').removeClass('flex')
    $parentNodeForMessage.find('.uploadImageBtn').addClass('hidden')
 })


//show image edit image selection and option section
$('.showEditImageAndContent').click(function(){
    $parentNodeForMessage = $(this).parents('.parentImageAndMessage');
    $parentNodeForMessage.find(this).addClass('hidden')

    $parentNodeForMessage.find('.chooseImageBtn').removeClass('hidden')
    $parentNodeForMessage.find('.chooseImageBtn').addClass('block')

    $parentNodeForMessage.find('.messageText').addClass('hidden')

    $parentNodeForMessage.find('.messageEdit').removeClass('hidden')
    $parentNodeForMessage.find('.messageEdit').addClass('block')

    $parentNodeForMessage.find('.deleteBtn').addClass('hidden')
    $parentNodeForMessage.find('.uploadImageBtn').removeClass('hidden')
    $parentNodeForMessage.find('.uploadImageBtn').addClass('flex')
})

    // close option for both image and message
$('.cancelBtnForBothImageAndContent').click(function(){
    $parentNodeForMessage = $(this).parents('.parentImageAndMessage');
    $parentNodeForMessage.find('.option').removeClass('opacity-100')
    $parentNodeForMessage.find('.option').addClass('opacity-0 pointer-events-none')

    $parentNodeForMessage.find('.showEditImageAndContent').removeClass('hidden')

    $parentNodeForMessage.find('.chooseImageBtn').removeClass('block')
    $parentNodeForMessage.find('.chooseImageBtn').addClass('hidden')

    $parentNodeForMessage.find('.messageEdit').addClass('hidden')
    $parentNodeForMessage.find('.messageEdit').removeClass('block')

    $parentNodeForMessage.find('.messageText').removeClass('hidden')

    $parentNodeForMessage.find('.deleteBtn').removeClass('hidden')
    $parentNodeForMessage.find('.uploadImageBtn').addClass('hidden')
    $parentNodeForMessage.find('.uploadImageBtn').removeClass('flex')


 })

     //validate chat input has any data or any image
     $('.chatInput').on('input', function() {
        if ($(this).val().trim() !== '') {
          $('.sendBtn').prop('disabled', false);
          $('.sendBtn').addClass('hover:bg-blue-500')
        } else {
          $('.sendBtn').prop('disabled', true);
          $('.sendBtn').removeClass('hover:bg-blue-500')
        }
    });


});
