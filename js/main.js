

ID_NUM=0;
function change_id(id_num){
    ID_NUM = id_num;
    alert(ID_NUM);
}

$(document).ready(function(){

    $("#category-select").on('change', function(e){
        var id_number = parseInt($('#category-select option:selected').attr('value'));
        var base_url = 'http://localhost/DiscussionForum/topicAPI.php?cat_id=' + id_number
        $.ajax({
           url:base_url,
            success: function(data){
                alert(JSON.stringify(data));
            },
            error: function(e){

            }

        });
    });

    $("#topic-select").on('click', function(e) {

    });

    $('#btn-reply').on('click',function(event){
        event.preventDefault();
        var post_id = ID_NUM;
        var message = $('#reply-content').val();

        $.ajax({
            url:"add_reply.php",
            method:"post",
            data:{qsn_id:post_id,response:message},
            success:function(data){
                $('#reply-data').append(data).slideUp(1000);

            }
        });


    })
});
