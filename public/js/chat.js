$(() => {
  $("#chatModal").hide();

  const getchatlist = async() => {

    var opt = {
        headers:{
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        method : 'GET'
    };

    try {
        let response = await fetch('/chat/get-chat-list',opt);
        const statusCode = response.status;
        let responseJsonData = await response.json();
        console.log(responseJsonData)
          // <span class="label label-danger" style="position:absolute;right:0px;">9</span>\
        responseJsonData.forEach(function(data) {
            document.getElementById('contact-list').innerHTML += '<li style="border: .5px solid white;border-bottom-width: thin;">\
                    <a href="javascript:void(0)" class="trigger-chat" data-id="'+data.id+'">\
                      <div style="width:45px;height:auto;position:relative;">\
                      <img src="'+asset+'images/defaultpic.jpg" class="menu-icon" alt="User Image" style="max-width: 45px;height: auto;">\
                      </div>\
                      <div class="menu-info" style="margin-left:50px;">\
                        <h4 class="control-sidebar-subheading">'+data.name+'</h4>\
                      </div>\
                    </a>\
                  </li>';
        });
            // document.getElementById('contact-list').innerHtml += "<li>asdas</li>";
        // for(x in annotation){
        // localStorage.setItem(annotation[x][0],annotation[x][1]);
        // }

    }
    catch(e) {
      console.log({error : true, description : e});
    }

        
  }

  getchatlist();


      // console.log(this.getAttribute("data-id"));
  $(document).on("click",".trigger-chat", async function() {
      $("#chatModal").show();
      $("#chatModal").addClass("active");
      $("#chatModal").find('.box-title').html($(this).find('.control-sidebar-subheading').html());
      var _receiver_id = $(this).attr('data-id');
      $("#chat-send-btn,#chatModal").attr("receiver-id",_receiver_id);
      $("#chat-send-btn,#chatModal").attr("sender-id",my_id);

      var opt = {
          headers:{
              'Accept': 'application/json',
              'Content-Type': 'application/json',
          },
          method : 'GET'
      };


      try {
          let response = await fetch('/chat/'+my_id+'/'+_receiver_id+'/get-messages',opt);
          const statusCode = response.status;
          let responseJsonData = await response.json();
          var nodatatofetch = $('<div class="text-center no-data-to-fetch">\
                No message to fetch.\
              </div>');
          console.log(responseJsonData)
          if(responseJsonData.length > 0) {
            $('.direct-chat-messages').html("");

            responseJsonData.forEach(function(element,index,array) {

              var receiver = $('<div class="direct-chat-msg"> \
                    <div class="direct-chat-info clearfix">\
                      <span class="direct-chat-name pull-left">Alexander Pierce</span>\
                      <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>\
                    </div>\
                    <img class="direct-chat-img" src="'+asset+'images/defaultpic.jpg" alt="">\
                    <div class="direct-chat-text">\
                    </div>\
                  </div>');

              var sender = $('<div class="direct-chat-msg right">\
                    <div class="direct-chat-info clearfix">\
                      <span class="direct-chat-name pull-right"></span>\
                      <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>\
                    </div>\
                    <img class="direct-chat-img" src="'+asset+'images/defaultpic.jpg" alt="">\
                    <div class="direct-chat-text">\
                    </div>\
                  </div>');

                db_sender_id   = responseJsonData[index].sender_id;
                receiver_name = responseJsonData[index].receiver_info.name;
                sender_id     = responseJsonData[index].sender_id;
                sender_name   = responseJsonData[index].sender_info.name;
                timestamp     = responseJsonData[index].created_at;
                message       = responseJsonData[index].message;

                if(db_sender_id == my_id) {
                  sender.find('.direct-chat-name').html(sender_name);
                  sender.find('.direct-chat-timestamp').html(moment(timestamp).format('MMMM D YYYY, h:mm a'));
                  sender.find('.direct-chat-text').html(message);
                  sender.appendTo($('.direct-chat-messages'));
                }else {
                  receiver.find('.direct-chat-name').html(sender_name);
                  receiver.find('.direct-chat-timestamp').html(moment(timestamp).format('MMMM D YYYY, h:mm a'));
                  receiver.find('.direct-chat-text').html(message);
                  receiver.appendTo($('.direct-chat-messages'));
                }
                  $(".direct-chat-messages").scrollTop($(".direct-chat-messages").prop('scrollHeight'));
            });

          }else {
            $('.direct-chat-messages').html(nodatatofetch);
          }

      }
      catch(e) {
        console.log({error : true, description : e});
      }

  });

  $(document).on("click","#chat-list-toggle", function() {
      if($(this).hasClass('active')) {
          $(this).removeClass('active');
          $("#chatModal").css({'right':'10px'});
      }else {
          $("#chatModal").css({'right':'240px'});
        console.log("active");
        $(this).addClass('active');

      }
  });


  $(document).on("click","#chat-send-btn", async function() {
      arr = {};
      arr['sender_id']    = $(this).attr("sender-id");
      arr['receiver_id']  = $(this).attr("receiver-id");
      arr['message']      = $("#chat-input-message").val();
      timestamp           = moment().format('MMMM D YYYY, h:mm a');
      // console.log(arr);
  var socket = io(_HOST);
                  socket.emit('chat',
                    {'chat':true,
                    data:{
                      name        : my_name,
                      sender_id   :$(this).attr("sender-id"),
                      receiver_id : $(this).attr("receiver-id"),
                      message     : $("#chat-input-message").val(),
                      timestamp   : timestamp
                    }
                  });
        var opt = {
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            method : 'POST',
            body : JSON.stringify(arr)
        };

        try {
                let response = await fetch('/chat/store',opt);
                const statusCode = response.status;
                let responseJsonData = await response.json();   
                if(responseJsonData[0].success) {
                var sender = $('<div class="direct-chat-msg right">\
                      <div class="direct-chat-info clearfix">\
                        <span class="direct-chat-name pull-right"></span>\
                        <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>\
                      </div>\
                      <img class="direct-chat-img" src="'+asset+'images/defaultpic.jpg" alt="">\
                      <div class="direct-chat-text">\
                      </div>\
                    </div>');
                  sender.find('.direct-chat-name').html(my_name);
                  sender.find('.direct-chat-timestamp').html(timestamp);
                  sender.find('.direct-chat-text').html($("#chat-input-message").val());
                  sender.appendTo($('.direct-chat-messages'));
                  $("#chat-input-message").val("");
                  $(".direct-chat-messages").scrollTop($(".direct-chat-messages").prop('scrollHeight'));
                }
            }
        catch(e) {
            console.log({error : true, description : e});

        }
  });
var socket = io(_HOST);

socket.on('chat', function(callback){
  var receiver = $('<div class="direct-chat-msg"> \
        <div class="direct-chat-info clearfix">\
          <span class="direct-chat-name pull-left">Alexander Pierce</span>\
          <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>\
        </div>\
        <img class="direct-chat-img" src="'+asset+'images/defaultpic.jpg" alt="">\
        <div class="direct-chat-text">\
        </div>\
      </div>');

  if(callback.data.receiver_id == my_id) {
      console.log("callback r"+ callback.data.receiver_id);
      console.log("receuver id"+ $("#chatModal").attr("receiver-id"));
      console.log("sender id"+ $("#chatModal").attr("sender-id"));
      console.log(" callback s " + callback.data.sender_id)
      
      $('#notifalert').attr('src',asset+"audio/pop.wav");
      document.getElementById('notifalert').play();
      receiver.find('.direct-chat-name').html(callback.data.name);
      receiver.find('.direct-chat-timestamp').html(callback.data.timestamp);
      receiver.find('.direct-chat-text').html(callback.data.message);
      receiver.appendTo($('.direct-chat-messages'));
      $(".direct-chat-messages").scrollTop($(".direct-chat-messages").prop('scrollHeight'));
    if($("#chatModal").hasClass("active") && $("#chatModal").attr("receiver-id") === callback.data.receiver_id && $("#chatModal").attr("sender-id") === callback.data.sender_id ) {

    }

  }

});

})