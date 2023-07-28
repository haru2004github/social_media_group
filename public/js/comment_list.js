$(document).ready(function(){



    $('.showOption').click(function(){
      $parentNode = $(this).parents('.parentNode');
      $parentNode.find('.postOption').toggleClass('opacity-0 pointer-events-none')

  })



    //reaction section
    $(".react").click(function() {
       $reactType = $(this).attr("id");
       $postId = $('#postId').val();
       $userId = $('#userId').val();

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
                   location.reload()
               }
           }
       })
     });

     //

     //cancel reaction
     $(".reacted").click(function() {
       $postId = $('#postId').val();
       $userId = $('#userId').val();

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
                   location.reload()

               }

           }

       })


     });


   // show reaction selection box
   $('#reactBtn').on('contextmenu',function(event
   ){
       event.preventDefault();
       $('.reactSelectionBox').removeClass('opacity-0 pointer-events-none')
   })

   // mouse leave from react selection box to close react box
   $('.reactSelectionBox').mouseleave(function(){
       $('.reactSelectionBox').addClass('opacity-0 pointer-events-none')

   })

    //validate input has any data or any image
    $('.comment').on('input', function() {
        if ($(this).val().trim() !== '') {
          $('.sendBtn').prop('disabled', false);
          $('.sendBtn').addClass('hover:bg-slate-100 dark:hover:bg-slate-900')
        } else {
          $('.sendBtn').prop('disabled', true);
          $('.sendBtn').removeClass('hover:bg-slate-100 dark:hover:bg-slate-900')
        }
    });






})
