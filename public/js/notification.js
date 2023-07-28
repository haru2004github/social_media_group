$(document).ready(function(){
    $('.postApprove').change(function(){
        $postApprove =  $(this).val();
        $parentNode = $(this).parents('.parentPostApprove')
        $postId = $parentNode.find('.postId').val();

        $.ajax({
            type  : 'get',
            data  :  {
                "postApprove"     : $postApprove,
                "postId"  : $postId
            },
            url   : "http://127.0.0.1:8000/notification/change/post_approve",
            dataType : 'json',

        })
        location.reload();
    })
})
