    <!-- DIRECT CHAT DANGER -->
    <div class="box box-danger direct-chat direct-chat-danger chat-container" id="chatModal" style="width:25%;float:right;position: fixed;bottom:0;right:0;z-index:9999999;display:none;">
      <div class="box-header with-border">
        <h3 class="box-title">Direct Chat</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" onclick="javascript:$('#chatModal').removeClass('active').hide();"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages"></div>
        <!--/.direct-chat-messages-->

        <!-- /.direct-chat-pane -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <form action="#" method="post">
          <div class="input-group">
            <input type="text" name="message" id="chat-input-message" placeholder="Type Message ..." class="form-control">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-danger btn-flat" id="chat-send-btn">Send</button>
                </span>
          </div>
        </form>
      </div>
      <!-- /.box-footer-->
    </div>
    <!--/.direct-chat -->

<aside class="control-sidebar control-sidebar-dark" style="height:100%;overflow: auto;float:right;">
    <!-- Create the tabs -->
    
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Contacts</h3>
        <ul class="control-sidebar-menu" id="contact-list">
          <!-- contact list -->
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>

  <script>
    var asset = "{{asset('/')}}";
    var my_id = "{{Auth::User()->id}}";
    var role = "{{Auth::User()->user_type}}";
    var my_name = "{{Auth::User()->name}}";
    var base_url = "{{URL::to('/')}}";
  </script>