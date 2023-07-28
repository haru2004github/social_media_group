$(document).ready(function(){


    $('.cancelBtn').click(function(){
        $parentNode = $('.editShowInput').parents('tr');
        $parentNode.find('.category').find('.categoryName').removeClass('hidden')
        $parentNode.find('.category').find('.categoryName').addClass('block')
        $parentNode.find('.category').find('.categoryEdit').addClass('hidden')


        $parentNodeForEditBtn = $(this).parents('.parentEditBtn');
        // edit and update btn switch 
        $parentNodeForEditBtn.find('.editBtn').addClass('hidden')
        $parentNodeForEditBtn.find('.editShowInput').removeClass('hidden')
        $parentNodeForEditBtn.find('.editShowInput').addClass('flex')

        // delete and cancel btn switch 
        $parentNodeForEditBtn.find('.cancelBtn').addClass('hidden')
        $parentNodeForEditBtn.find('.deleteBtn').removeClass('hidden')
        $parentNodeForEditBtn.find('.deleteBtn').addClass('flex')
    })

    $('.editShowInput').click(function(){
        $parentNode = $(this).parents('tr');
        $parentNode.find('.category').find('.categoryEdit').removeClass('hidden')
        $parentNode.find('.category').find('.categoryEdit').addClass('block')
        $parentNode.find('.category').find('.categoryName').addClass('hidden')


        $parentNodeForEditBtn = $(this).parents('.parentEditBtn');
        // edit and update btn switch 
        $parentNodeForEditBtn.find('.editShowInput').addClass('hidden')
        $parentNodeForEditBtn.find('.editBtn').removeClass('hidden')
        $parentNodeForEditBtn.find('.editBtn').addClass('flex')

        // delete and cancel btn switch 
        $parentNodeForEditBtn.find('.deleteBtn').addClass('hidden')
        $parentNodeForEditBtn.find('.cancelBtn').removeClass('hidden')
        $parentNodeForEditBtn.find('.cancelBtn').addClass('flex')
            


    })
})