/* function library*/
define(['jquery', 'bundle/io/build/iolib', 'build/chatboxManager','build/lang.en'], function($, io, chatboxManager, lang) {
//define(['jquery', 'bundle/io/build/iolib', 'src/chatboxManager','build/lang.en'], function($, io, chatboxManager, lang) {
    return {
        counter: 0,
        idList: new Array(),
        chatroombox: null,
        
        memberUpdate: function (e) {
            var userlist = e.message;
            if(typeof wwwroot === 'undefined'){
                var imgpath = "./images/online.png";
            }else{
                var imgpath = wwwroot+"local/mitschat/bundle/chat/images/online.png"; //image folder path
            }
            if(userlist.length > 0){
                var count = userlist.length - 1;
                $("#user_list .inner_bt #usertab_icon").css({'background': 'url(' + imgpath + ')no-repeat top left'});
            }
        
            $("#user_list .inner_bt #usertab_text").text(lang.whos + " (" + count + ")");
            $("#chatroom_bt .inner_bt #chatroom_text").text(lang.chatroom + " (" + count + ")");
            if (userlist.length > 1) {
                if (!document.getElementById('chat_div')) { // prevent creating div on each update
                    var cd = document.createElement('div');
                    cd.id = 'chat_div';
                    document.body.appendChild(cd);
        
                }
        
                $("#chat_div").memberlist({
                    id:"chat_div",
                    user:userlist,
                    offset:'37px',
                    title : lang.online,
                    userSent : function(user) {
                        $("#chat_div").memberlist("option", "boxManager").addUsr(user);
                    }
                });
                $("#chat_div .ui-memblist-usr").remove();
                $.each(userlist, function(key, usr) {
                    if (usr.userid != io.cfg.userid) {
                        $("#chat_div").memberlist("option").userSent(usr);
                    }
                });
            }else{
                /* when there is one user and left the chat
                    remove userlist box
                */
                if($('div#memlist').length){
                    $("div#memlist").remove();
                }
            }
        },
        
        
        
        /*
            Called on new message arival
            update msg list in chatbox
        */
        
        messageUpdate: function(e){
            if($.isPlainObject(e.message)){
                var msg = e.message.msg;
            }else{
                var msg = e.message;
            }
        
            var to = e.toUser;
            var from = e.fromUser;
            var self = io.cfg.userid;
            var time = new Date().getTime();
            //common chat room
            if( e.message.receiver == 'chatroom' && (to == "" || to == undefined)){
                if(self == from.userid){
                    $("#chat_room").chatroom("option").messageSent(from, msg);
                }else{
                    if(this.chatroombox) {
                        $("#chat_room").chatroom("option").messageSent(from, msg);
                    }else{
                       if($("div#chat_room").length == 0){
                            var d = document.createElement('div');
                            d.id = 'chat_room';
                            document.body.appendChild(d);
                            this.chatroombox = $("#chat_room").chatroom({id:"chat_room",
                                                    user : from,
                                                    title : lang.chatroom_header,
                                                    messageSent : function(user, msg) {
                                                        $("#chat_room").chatroom("option", "boxManager").addMsg(user.name,msg);
                                                    }});
                       }
                       $("#chat_room").chatroom("option").messageSent(from, msg);
                       }
                    }
        
                    // store data on browser
                    if(sessionStorage.getItem('chatroom') != null){
                        var chatroom = JSON.parse(sessionStorage.getItem('chatroom'));
                        var temp = { userid:from.userid,name:from.name, msg: msg,time: time}
                        chatroom.push(temp);
                        sessionStorage.setItem('chatroom',JSON.stringify(chatroom));
                    } else {
                        sessionStorage.setItem('chatroom', JSON.stringify([{ userid:from.userid,name:from.name , msg: msg,time: time}]));
                    }
        
            }else if(to != undefined && to != ""){ // private chat
        
                if(self == to.userid && from.userid != self){
                    if($.inArray(from.userid, this.idList) == -1){
                        this.counter++;
                        this.idList.push(from.userid);
                        mitsstorage[from.userid] = [];
                        mitsstorage[from.userid].push({ userid:from.userid, name:from.name + ' ' + from.lname});
                    }
                        chatboxManager.addBox(from.userid,
                                  {dest:"dest" + this.counter, // not used in demo
                                   title:"box" + this.counter,
                                   first_name:from.name,
                                   last_name:from.lname
                                   //you can add your own options too
                                  });
        
                    var did = from.userid;
        
                    chatboxManager.init({
                        user:from,
                        messageSent : function(did,user,msg){
                            $("#" + did).chatbox("option", "boxManager").addMsg(user.name, msg);
                        }});
        
                    $("#" + from.userid).chatbox("option").messageSent(from.userid,from, msg);
                    $("li[aria-controls='tabcb" + from.userid + "']").addClass("ui-state-highlight");
                    //createNotification(from.userid);// tab scrolling notification for hidden tab
                    var k = from.userid;
                }
        
                //send msg to self
                /*if (self == from.userid){
                    $("#" + to.userid).chatbox("option").messageSent(to.userid,from, msg);
                    var k = to.userid;
                }
                // to avoid error of undefined
                var k = to.userid;
                if (typeof(mitsstorage[k]) == 'undefined') {
                    mitsstorage[k] = [];
                }
                console.log('mitsstograge key = ' + k);*/
                mitsstorage[k].push({ userid:from.userid,name:from.name , msg: msg, time: time });
            }
        },
        
        
        // diplay user status(offlin/online)
        statusUpdate:function (from,msg,prop){
            if($("#" + from.userid).length){
              $("#" + from.userid).chatbox("option").messageSent(from.userid,from, msg);
              $("#ta" + from.userid).prop("disabled",prop);
            }
        },
        
        common_chatbox_update: function (from,msg){
            if($("div#chat_room").length){
                $("#chat_room").chatroom("option").messageSent(from, msg);
            }
        },
        
        newStatus: function (e){
            $.each(e.message, function(k, u) {
                if(e.newuser != null && u.userid == e.newuser){
                    this.statusUpdate(u,'Online', false);
                    this.common_chatbox_update(u, 'Online');
                }
            });
        },
        
        /*
            Create tabs
        */
        createTab: function (id,name){
            var myTabs = $('#tabs').tabs();
            var ind = $("div#tabs ul li").length;
        
            tabId = 'tabcb' + id;
            this.addTab(myTabs, tabId, ind, name);
        },
        
        addTab: function (tabs,id,tabCounter,tabTitle) {
            //var tabTitle = $( "#tab_title" ),
            var tabContent = $( "#tab_content" ),
            tabTemplate = "<li id = '" + id + "' class = 'ui-state-default ui-corner-bottom ui-tabs-active ui-state-active' aria-controls = '" + id + "'><a href = '#{href}' class = 'ui-tabs-anchor'>#{label}</a> <a href = '#' role = 'button'class = 'ui-corner-all ui-chatbox-icon'><span class = 'ui-icon ui-icon-close'>close</span></a></li>";
        
            var label = tabTitle || "Tab " + tabCounter,
            id = id,
            li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) ),
            tabContentHtml = tabContent.val() || "Tab " + tabCounter + " content.";
        
            tabs.find( ".ui-tabs-nav" ).append( li );
            //tabs.tabs( "refresh" );
        },
        
        browserSupportsLocalStorage: function (){
            /*if(('localStorage' in window) && (window['localStorage'] != null)){
                if(this.isIosDevices()){
                    try {
                        window.sessionStorage.setItem('sTest', 'test');
                        window.sessionStorage.removeItem('sTest');
                    } catch (e) {
                        if (e.code === DOMException.QUOTA_EXCEEDED_ERR) {
                            this.display_error('Private mode is enable. Browser does not support localStorage.');
                            return;
                        } else {
                            throw e;
                        }
                    }
                }
                return true;
            }*/
            //return false;
            return ('localStorage' in window) && (window['localStorage'] != null);
        },
        
        /*
         preserve public chat on page refersh
        */
        displaycomChatHistory: function (){
            var cthis = this;
            //common room chat data populated on referesh
            if(sessionStorage.length > 0){
                var d = document.createElement('div');
                d.id = 'chat_room';
                document.body.appendChild(d);
                var data = JSON.parse(sessionStorage.getItem('chatroom'));
                $.each(data, function(id, msgobj) {
                    if(id < 1){
                        cthis.chatroombox = $("#chat_room").chatroom({id:"chat_room",
                                                    user : msgobj,
                                                    title : "Common chat",
                                                    messageSent : function(user, msg) {
                                                        $("#chat_room").chatroom("option", "boxManager").addMsg(user.name,msg);
                                                    }});
                    }
                    $("#chat_room").chatroom("option").messageSent(msgobj, msgobj.msg);
                });
            }
             if(sessionStorage.getItem('chatroom_status') == 'hidden'){
                $("#chatrm" ).hide(); //hide box on page refresh
             }
        },
        
        /*
         preserve private chat on page refersh
        */
        displayChatHistory: function(){
            //Private chat data populated on page referesh
            var cthis = this;
            if (localStorage.getItem(sid) != null){
                var data = JSON.parse(localStorage.getItem(sid));
                $.each(data, function(id, msgarr) {
                    cthis.counter++;
                    cthis.idList.push(id);
        
                    $.each(msgarr, function(i, msgobj) {
                        if(i < 1){
                            chatboxManager.addBox(id,
                                          {dest:"dest" + cthis.counter, // not used in demo
                                           title:"box" + cthis.counter,
                                           first_name:msgobj.name
                                          });
        
                            chatboxManager.init({
                                messageSent : function(id,user,msg){
                                    $("#" + id).chatbox("option", "boxManager").addMsg(user.name, msg);
                                }
                            });
                        }else{
                            $("#" + id).chatbox("option").messageSent(id, msgobj, msgobj.msg);
                        }
                    });
                    if(localStorage.getItem(id) == 'hidden'){
                        $("#cb" + id).hide(); //hide box on page refersh
                        $("#tabcb" + id).removeClass('ui-state-active'); //make tab disable on page refersh
                    }
                });
            }
        },
        
        
        /*
            Dialog box to display error messages
        */
        display_error: function(msg){
            $( "<div id = 'dialog' title = 'MITS Chat Error:'></div>" ).prependTo( "#stickybar" );
            $("#dialog").html(msg);
            $('#dialog').dialog();
        },
        
        /*
            Check iOs device
        */    
        isIosDevices: function(){
            var ua = navigator.userAgent;
            var isiPad = /iPad/i.test(ua) || /iPhone OS 3_1_2/i.test(ua) || /iPhone OS 3_2_2/i.test(ua);
            return isiPad;
        }
    }
});