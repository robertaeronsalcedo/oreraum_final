$(function() {
  $("#notif-message").hide();
  const getnotification = async() => {
    $('#notificationList').html("");
    var opt = {
        headers:{
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        method : 'GET'
    };

    try {
        let response = await fetch('/get-notification',opt);
        const statusCode = response.status;
        let responseJsonData = await response.json();
        console.log(responseJsonData)
          // <span class="label label-danger" style="position:absolute;right:0px;">9</span>\
        responseJsonData.forEach(function(data) {
          var template = $('<li>\
                    <a href="#">\
                      <div class="row">\
                          <div class="col-sm-12">\
                            <small class="pull-right"><i class="fa fa-clock-o"></i> <span id="minAgo"></span></small>\
                          </div>\
                          <div class="col-sm-12">\
                            <i class="fa fa-users text-aqua"></i> <span id="message" style="  word-break: break-all;white-space: normal;"></span>\
                          </div>\
                      </div>\
                    </a>\
                  </li>');
          template.find('a').attr("href",(data.notif_type=="announcement") ? base_url+"/bulletin" : (role == "Adviser" ? base_url+"/manuscript_list" : base_url+"/submission") )
          template.find('.fa-users').removeClass().addClass((data.notif_type=="announcement") ? "fa fa-bullhorn" : "fa fa-file-pdf-o");
          template.find('#minAgo').html(moment(data.created_at).startOf('hour').fromNow());
          template.find('#message').html(data.message.length > 50 ?   data.message.substring(0,50)+'...' : data.message);
          template.appendTo($('#notificationList'));
        });

    }
    catch(e) {
      console.log({error : true, description : e});
    }

        
  }
$(document).on('click','#notificationBtn', function() {
 getnotification();
});
 

var socket = io(_HOST);
socket.on('notification', function(callback){
  console.log(callback);
  _user_id = callback.data.user_id ? callback.data.user_id : "";
  _announcement = callback.data.announcement ? callback.data.announcement : false;
  
  if(_user_id == my_id || _announcement) {

    $('#notifalert').attr('src',asset+"audio/alert.mp3");
    document.getElementById('notifalert').play();
     $("#notif-message").show();
     animateCSS('#notif-icon', 'swing');
    setTimeout(()=>{
      $("#notif-message").hide();
    },2000);

  }


});

function animateCSS(element, animationName, callback) {
    const node = document.querySelector(element)
    node.classList.add('animated', animationName)

    function handleAnimationEnd() {
        node.classList.remove('animated', animationName)
        node.removeEventListener('animationend', handleAnimationEnd)

        if (typeof callback === 'function') callback()
    }

    node.addEventListener('animationend', handleAnimationEnd)
}

});