@extends('layouts.app')
@section('style')
<style type="text/css">
    .container{max-width:1170px; margin:auto;}
    img{ max-width:100%;}
    .inbox_people {
      background: #f8f8f8 none repeat scroll 0 0;
      float: left;
      overflow: hidden;
      width: 40%; border-right:1px solid #c4c4c4;
    }
    .inbox_msg {
      border: 1px solid #c4c4c4;
      clear: both;
      overflow: hidden;
    }
    .top_spac{ margin: 20px 0 0;}


    .recent_heading {float: left; width:40%;}
    .srch_bar {
      display: inline-block;
      text-align: right;
      width: 60%;
    }
    .headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

    .recent_heading h4 {
      color: #05728f;
      font-size: 21px;
      margin: auto;
    }
    .srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
    .srch_bar .input-group-addon button {
      background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
      border: medium none;
      padding: 0;
      color: #707070;
      font-size: 18px;
    }
    .srch_bar .input-group-addon { margin: 0 0 0 -27px;}

    .chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
    .chat_ib h5 span{ font-size:13px; float:right;}
    .chat_ib p{ font-size:14px; color:#989898; margin:auto}
    .chat_img {
      float: left;
      width: 11%;
    }
    .chat_ib {
      float: left;
      padding: 0 0 0 15px;
      width: 88%;
    }

    .chat_ib_peopel {
      float: left;
      padding: 0 0 0 15px;
      width: 88%;
      margin-top: -3px;
    }

    .chat_people{ overflow:hidden; clear:both;}
    .chat_list {
      border-bottom: 1px solid #c4c4c4;
      margin: 0;
      padding: 4px 4px 3px;
    }
    .inbox_chat { height: 550px; overflow-y: scroll;}

    .active_chat{ background:#ebebeb;}

    .incoming_msg_img {
      display: inline-block;
      width: 6%;
    }
    .received_msg {
      display: inline-block;
      padding: 0 0 0 10px;
      vertical-align: top;
      width: 88%;
     }
     .received_withd_msg p {
      background: #ebebeb none repeat scroll 0 0;
      border-radius: 3px;
      color: #646464;
      font-size: 14px;
      margin: 0;
      padding: 5px 10px 5px 12px;
      width: 100%;
    }
    .time_date {
      color: #747474;
      display: block;
      font-size: 12px;
      margin: 8px 0 0;
    }
    .received_withd_msg { width: 100%;}
    .mesgs {
      float: left;
      padding: 15px 15px 0 25px;
      width: 60%;
    }

     .sent_msg p {
      background: #05728f none repeat scroll 0 0;
      border-radius: 3px;
      font-size: 14px;
      margin: 0; color:#fff;
      padding: 5px 10px 5px 12px;
      width:100%;
    }
    .outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
    .sent_msg {
      float: right;
      width: 46%;
    }
    .input_msg_write input {
      background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
      border: medium none;
      color: #4c4c4c;
      font-size: 15px;
      min-height: 48px;
      width: 100%;
    }

    .type_msg {border-top: 1px solid #c4c4c4;position: relative;}
    .msg_send_btn {
      background: #05728f none repeat scroll 0 0;
      border: medium none;
      border-radius: 50%;
      color: #fff;
      cursor: pointer;
      font-size: 17px;
      height: 33px;
      position: absolute;
      right: 0;
      top: 11px;
      width: 33px;
    }
    .messaging { padding: 0 0 50px 0;}
    .msg_history {
      height: 516px;
      overflow-y: auto;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class=" text-center">Messaging</h3>
            <div class="messaging">
                <div class="inbox_msg">
                    <div class="inbox_people">
                        <div class="headind_srch">
                            <div class="recent_heading">
                                <h4>Recent</h4>
                            </div>
                            <div class="srch_bar">
                                <div class="stylish-input-group">
                                    <input type="text" class="search-bar"  placeholder="Search" >
                                    <span class="input-group-addon">
                                        <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                                    </span> 
                                </div>
                            </div>
                        </div>
                        <div class="inbox_chat">
                            
                        </div>
                    </div>
                    <div class="mesgs">
                        <div class="msg_history">
                            
                        </div>
                        <div class="type_msg">
                            <div class="input_msg_write">
                                <form id="send_message_form" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="username" value="{{ $user->name }}" />
                                    <input type="hidden" name="useremail" value="{{ $user->email }}" />
                                    <input type="text" name="usermessage" class="write_msg" placeholder="Type a message" />
                                    <button class="msg_send_btn" type="button">
                                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center top_spac"> Design by <a target="_blank" href="">Raju Kathi</a></p>
        </div>
    </div>
</div>

<div id="hidden-incomming-msg-template" class="d-none">
    <div class="chat_list">
        <div class="chat_people">
            <div class="chat_img"> 
                <img src="https://ptetutorials.com/images/user-profile.png" alt="##USERNAME##"> 
            </div>
            <div class="chat_ib">
                <h5>##USERNAME## <span class="chat_date">##DATE##</span></h5>
                <p>##USERMESSAGE##</p>
            </div>
        </div>
    </div>
</div>

<div id="hidden-chat-people-template" class="d-none">
    <div class="chat_list">
        <div class="chat_people">
            <div class="chat_img"> 
                <img src="https://ptetutorials.com/images/user-profile.png" alt="##USERNAME##"> 
            </div>
            <div class="chat_ib_peopel">
                <h5>
                    ##USERNAME## 
                    <span class="chat_date">
                        <button class="btn btn-success" style="float:right;">Active</button>
                    </span>
                </h5>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')

<script>
var echo = '';

function getDateTime() {
    var date = new Date();
    var current_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+ date.getDate();
    var current_time = date.getHours()+":"+date.getMinutes()+":"+ date.getSeconds();

    return current_date + " " + current_time;
}

$(document).on('click', '.msg_send_btn', function(e) {

    e.preventDefault();

    $.ajax({
        url: "{{ route('send-message') }}",
        cache: false,
        method: 'post',
        data: $('#send_message_form').serialize(),
        success: function(html){
            
        }
    });
});

var userArray = [];

window.addEventListener('load',  () =>{
    var channel = Echo.channel("general-channel");
    channel.listen('GeneralNotification', (e) => {

        let data = $.parseJSON( e.message );

        if( data.usermessage.length > 0 ) {

            $htmlTemplate = $("#hidden-incomming-msg-template").html();
            $htmlTemplate = $htmlTemplate.replace(/##USERNAME##/g, data.username);
            $htmlTemplate = $htmlTemplate.replace(/##USERMESSAGE##/g, data.usermessage);
            $htmlTemplate = $htmlTemplate.replace(/##DATE##/g, getDateTime());
            
            $(".msg_history").append($htmlTemplate);
            $(".write_msg").val('');
        }

        $(".inbox_chat").html('');

        $.each(data.users, function(index, event) {
            $htmlTemplate = $("#hidden-chat-people-template").html();
            $htmlTemplate = $htmlTemplate.replace(/##USERNAME##/g, event.username);
            $(".inbox_chat").append($htmlTemplate);
        });

        /*var uniqueUserArray = [];
        $.each(userArray, function(index, event) {
            var events = $.grep(uniqueUserArray, function (e) {
                return event.email === e.email;
            });
            if (events.length === 0) {
                uniqueUserArray.push(event);
            }
        });*/
    });
});

</script>

@endsection