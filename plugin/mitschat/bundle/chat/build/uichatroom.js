/*
* http://www.vidyamantra.com
*
* Depends on jquery.ui.core, jquery.ui.widiget, jquery.ui.effect
*
* Also uses some styles for jquery.ui.dialog
*/

define(['jquery', 'jqueryui', 'bundle/io/build/iolib'], function($, jui, io) {
//define(['jquery', 'jqueryui', 'bundle/io/build/iolib', 'bundle/apiai/build/app'], function($, jui, io, apiai) {
// Display box for chatroom

//(function($){
    $.widget("ui.chatroom", {
        options: {
            id: null, //id for the DOM element
            title: null, // title of the chatbox
            user: null, // can be anything associated with this chatbox
            hidden: false,
            offset: 20, // relative to right edge of the browser window
            width: 250, // width of the chatbox
            messageSent: function(user, msg){
                this.boxManager.addMsg(user.name, msg);
                alert('Message sent');
            },
            boxClosed: function(id) {}, // called when the close icon is clicked
            boxManager: {

                init: function(elem) {
                    this.elem = elem;
                },
                addMsg: function(peer, msg) {
                    var self = this;
                    var box = self.elem.uiChatboxLog;
                    var e = document.createElement('div');
                    box.append(e);

                    var systemMessage = false;

                    if (peer) {
                        var peerName = document.createElement("b");
                        $(peerName).text(peer + ": ");
                        e.appendChild(peerName);
                    } else {
                        systemMessage = true;
                    }

                    var msgElement = document.createElement(systemMessage ? "i" : "span");
                    $(msgElement).text(msg);
                    e.appendChild(msgElement);
                    $(e).addClass("ui-chatbox-msg");
                    $(e).fadeIn();
                    self._scrollToBottom();

                    if (!self.elem.uiChatboxTitlebar.hasClass("ui-state-focus") && !self.highlightLock) {
                        self.highlightLock = true;
                        self.highlightBox();
                    }
                },
                addHTML: function(html) {
                  var self = this;
                  var box = self.elem.uiChatboxLog;
                  var e = document.createElement('div');
                  e.innerHTML = html;
                  box.append(e);
                },
                highlightBox: function() {
                    var self = this;
                    self.elem.uiChatboxTitlebar.addClass("ui-state-highlight");
                    /*self.elem.uiChatboxTitlebar.effect("highlight", {},600, function(){
                        self.highlightLock = false;
                        self._scrollToBottom();
                    });*/
                    self.highlightLock = false;
                    self._scrollToBottom();
                },
                toggleBox: function() {
                   this.elem.uiChatbox.toggle("slide",{direction:"down"},1000);
                },
                _scrollToBottom: function() {
                    var box = this.elem.uiChatboxLog;
                    box.scrollTop(box.get(0).scrollHeight);
                }
            }
        },

        toggleContent: function(event) {
            this.uiChatboxContent.toggle();
            if(this.uiChatboxContent.is(":visible")) {
                this.uiChatboxInputBox.focus();
            }
        },

        widget: function() {
            return this.uiChatbox
        },

        _create: function(){
	        var self = this,
            options = self.options,
            offset = options.offset,
            title = options.title || "Sin titulo",
            // chatbox
            uiChatbox = (self.uiChatbox = $('<div></div>'))
            .appendTo(document.body)
            .addClass('ui-widget ' +
                'ui-corner-top ' +
                'ui-chatroom'
            )
            .prop('id', 'chatrm')
            .prop('outline', 0)
            .focusin(function(){
            	self.uiChatboxTitlebar.removeClass("ui-state-highlight"); // delete highlighting
                // ui-state-highlight is not really helpful here
                self.uiChatboxTitlebar.addClass('ui-state-focus');
            })
            .focusout(function(){
	            self.uiChatboxTitlebar.removeClass('ui-state-focus');
            }),
            // titlebar
            uiChatboxTitlebar = (self.uiChatboxTitlebar = $('<div></div>'))
            .addClass('ui-widget-header ' +
                'ui-corner-top ' +
                'ui-chatroom-titlebar ' +
                'ui-dialog-header' // take advantage of dialog header style
            )
            .click(function(event) {
                //self.toggleContent(event);
                self.uiChatboxTitlebar.removeClass("ui-state-highlight");
            })
            .appendTo(uiChatbox),
            uiChatboxTitle = (self.uiChatboxTitle = $('<span></span>'))
            .html(title)
            .appendTo(uiChatboxTitlebar),

            uiChatboxTitlebarMinimize = (self.uiChatboxTitlebarMinimize = $('<a href="#"></a>'))
            .addClass('ui-corner-all ' +
            'ui-chatbox-icon'
            )
            .prop('role', 'button')
            .hover(function() {uiChatboxTitlebarMinimize.addClass('ui-state-hover');},
                function() {uiChatboxTitlebarMinimize.removeClass('ui-state-hover');})
            .focus(function() {
	            uiChatboxTitlebarMinimize.addClass('ui-state-focus');
            })
            .blur(function() {
	            uiChatboxTitlebarMinimize.removeClass('ui-state-focus');
            })
            .click(function(event) {
	            options.boxManager.toggleBox();
	            sessionStorage.setItem("chatroom_status", "hidden");
		         return false;
            })
            .appendTo(uiChatboxTitlebar),

            //minimize button
            uiChatboxTitlebarMinimizeText = $('<span></span>')
            .addClass('ui-icon ' + 'ui-icon-minusthick')
            .text('minimize')
            .appendTo(uiChatboxTitlebarMinimize),

            // content
            uiChatboxContent = (self.uiChatboxContent = $('<div></div>'))
            .addClass('ui-widget-content ' + 'ui-chatbox-content ')
            .appendTo(uiChatbox),

            uiChatboxLog = (self.uiChatboxLog = self.element)
            .addClass('ui-widget-content ' + 'ui-chatbox-log')
            .appendTo(uiChatboxContent),

            uiChatboxInput = (self.uiChatboxInput = $('<div></div>'))
            .addClass('ui-widget-content ' + 'ui-chatbox-input')
            .click(function(event) {
                // anything?
            })
            .appendTo(uiChatboxContent),
            uiChatboxInputBox = (self.uiChatboxInputBox = $('<textarea></textarea>'))
            .addClass('ui-widget-content ' + 'ui-chatbox-input-box ' + 'ui-corner-all')
            .prop('id', 'ta_chrm')
            .appendTo(uiChatboxInput)
            .keydown(function(event) {
                if(event.keyCode && event.keyCode == $.ui.keyCode.ENTER) {
                    var msg = $.trim($(this).val());
                    self.options.boxManager.addMsg(fname, msg);
                    $(this).val('');
                    $.getJSON("/GPITS/gpitsservice.php?msg=" + msg + "&user=" + id, function(data) {
                      setTimeout(function() {
                        //var contentText = $($.parseXML(xml)).find("html").text();
                        var addcontent = data.respuesta.split("|parse|");
                        for(var i=0; i< addcontent.length; i++) {
                          var chunk = addcontent[i];
                          /*chunk = chunk.replace("<![CDATA[", "");
                          chunk = chunk.replace("]]>", "");*/
                          var stripped = chunk.replace(/(<([^>]+)>)/ig,"");
                          if(stripped == addcontent[i]) {
                            self.options.boxManager.addMsg('MITS', stripped);
                            console.log("Msg added...");
                          } else {
                            self.options.boxManager.addHTML(addcontent[i]);
                            console.log("HTML added...");
                          }
                        }//End for
                        //$(this).val('');
                        console.log('Listo amigo');
                      }, 1000);
                    });
                    //Add msg to chatroom

                }//Fin del enter
            })
            .focusin(function() {
                uiChatboxInputBox.addClass('ui-chatbox-input-focus');
                var box = $(this).parent().prev();
                box.scrollTop(box.get(0).scrollHeight);
            })
            .focusout(function() {
                uiChatboxInputBox.removeClass('ui-chatbox-input-focus');
            });

            // disable selection
            uiChatboxTitlebar.find('*').add(uiChatboxTitlebar).disableSelection();

            // switch focus to input box when whatever clicked
            uiChatboxContent.children().click(function(){
                // click on any children, set focus on input box
                self.uiChatboxInputBox.focus();
            });

            self._setWidth(self.options.width);
            self._position(self.options.offset);

            self.options.boxManager.init(self);

            if (!self.options.hidden) {
                uiChatbox.show();
            }

            if (window.location.href.indexOf("notifyeditingon=1") > -1) {
                //this.toggleBox();
                //alert("Editando el curso. Mandar recomendación");
                //options.boxManager.toggleBox();
                $.getJSON("/mcampos/GPITS/gpitsservice.php?&user=" + id + "&r=1", function (data) {
                    setTimeout(function () {
                        self.options.boxManager.addMsg('MITS', 'Recomendación: ' + data.respuesta);
                        //$(this).val('');
                        console.log('Lista la recomendación');
                    }, 1000);
                });
            }//Fin del if
        },

        _setOption: function(option, value) {
            if (value != null) {
                switch(option) {
                    case "hidden":
                    if (value){
                        this.uiChatbox.hide();
                    }else{
                        this.uiChatbox.show();
                    }

                        break;

                    case "offset":
                        this._position(value);
                        break;

                    case "width":
                        this._setWidth(value);
                        break;
                }
            }

            $.Widget.prototype._setOption.apply(this, arguments);
        },

        _setWidth: function(width) {
	        this.uiChatbox.width(width + "px");
            // this is a hack, but i can live with it so far
            this.uiChatboxInputBox.css("width", (width - 14) + "px");
        },

        _position: function(offset) {
            this.uiChatbox.css("right", offset);
        }
    });
//});
});
