/**
 * Created by Shashiki on 11/1/2016.
 */
var postId=0;
var postBodyElement=null;

$('.post').find('.interaction').find('.edit').on('click',function () {
    event.preventDefault();

    postBodyElement=event.target.parentNode.parentNode.childNodes[1];
    var postBody=event.target.parentNode.parentNode.childNodes[1].textContent;
    postId =event.target.parentNode.parentNode.parentNode.parentNode.dataset['postid'];
    console.log(postBodyElement);
    console.log(postBody);
    console.log(postId);

    $('#post-body').val(postBody);
   $('#edit-model').modal();
});

$('#modal-save').on('click',function () {
    $.ajax({
        method: 'POST',
        url: urlEdit,
        data:{body:$('#post-body').val(),postId:postId,_token: token}

    })
        .done(function (msg) {
            $(postBodyElement).text(msg['new_body']);
            $('#edit-model').modal('hide');

        });
});

$('.like').on('click',function (event) {

    event.preventDefault();
    postId =event.target.parentNode.parentNode.parentNode.parentNode.dataset['postid'];

    var isLike = event.target.previousElementSibling == null;
    $.ajax({
        method: 'POST',
        url: urlLike,
        data:{isLike: isLike, postId: postId, _token: token}
    })
        .done(function () {
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
            event.target.className =isLike ? event.target.className == 'like icon ion-android-favorite-outline' ? 'like icon ion-android-favorite' : 'like icon ion-android-favorite-outline' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';

            if (isLike) {
                event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
        });
});