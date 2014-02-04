$(function () {

    // Accordion
    $("#accordion").accordion({
        header: "h3"
    });

    // Tabs
    $('#tabs2, #tabs').tabs();

    // Buttons
    $('button').button();

    // Anchors, Submit
    $('.button,#sampleButton').button();

    // Buttonset
    $('#radioset').buttonset();
    $("#format").buttonset();

    function validateOpinionTypeID(opinionTypeID){
        if(opinionTypeID == null || opinionTypeID == 0)
            return false;
        return true;
    }
    function validateOpinionTitle(opinionTitle){
        if(opinionTitle == null || opinionTitle == 0)
            return false;
        return true;
    }
    function validateText(text){
        if(text == null || text == 0)
            return false;
        return true;
    }
    function validateOpinionSubCategory(opinionSubCat){
        if(opinionSubCat == null || opinionSubCat == 0)
            return false;
        return true;
    }
    // Dialog
    $('#modal_cnt_add_opinion').dialog({
        autoOpen: false,
        modal:true,
        width: 600,
        open: function(){
            $('.ui-widget-overlay').bind('click',function(){
                $('#modal_cnt_add_opinion').dialog('close');
            })
        },

        buttons: {
            "Submit": function () {
                var opinion_title=$("#opinion_title").val();
                var opinion_text=$("#opinion_text").val();
                var opinion_type=$("#opinion_type").val();
                var opinion_sub_cat=$("#opinion_sub_category").val();
                
                if(!validateOpinionTitle(opinion_title))
                    $("#success").html("Please enter a valid title"); 
                else if(!validateText(opinion_text))
                    $("#success").html("Please enter a valid narration"); 
                else if(!validateOpinionTypeID(opinion_type))
                    $("#success").html("Please select a valid opinion type"); 
                else if(!validateOpinionSubCategory(opinion_sub_cat))
                    $("#success").html("Please select a valid opinion sub category"); 
                else{
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/opinions/index.php/home/add_opinion",
                        dataType: "json",
                        data: "opinion_type="+opinion_type+"&opinion_sub_cat="+opinion_sub_cat+"&opinion_title="+opinion_title+"&opinion_text="+opinion_text,
                        cache:false,
                        success: 
                        function(data){
                       
                            $('#dialog-message').dialog('open');
                            
                            return false;
                            $("#success").html(data.message); 
                         
                        }
                   
                    });
                    $("#opinion_title").val("");
                    $("#opinion_text").val("");
                    
                }
            },
            "Cancel": function () {
                $(this).dialog("close");
            }
           
        }
    });
  

    // Dialog Link
    $('#opinion_category').change(function () {
        var categoryID = $("#opinion_category").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/opinions/index.php/home/get_subcategories",
            dataType: "json",
            data: "categoryID="+categoryID,
            cache:false,
            success: 
            function(data){
                var select = $('#opinion_sub_category');
                var listItems;
                $.each(data.opinionSubCategories, function(i,item){
                    var subCatName = item.subCategoryName;
                    listItems+= "<option value='"+i+"'>"+subCatName+"</option>"
                });
                //var subCats = jQuery.parseJSON(data.opinionSubCategories);
                //alert( subCats.categoryID );
                $("#opinion_sub_category").html(listItems); 
                         
            }
                   
        });
    
    });
    // Dialog Link
    $('#modal_add_opinion').click(function () {
        var LOGGED_IN_STATUS  = "LOGGED_IN";
        var login_status =  $("#login_status").val();
        if(login_status == LOGGED_IN_STATUS){
            $('#modal_cnt_add_opinion').dialog('open');
        }
        else{
            $('#dialog-message-add-opinion-not-logged-in').dialog('open');
        }
        return false;
    });

    // Dialog Link
    $('.button_review').click(function () {
        var opinionIDString = (this.id).split("_");
        var opinionID = opinionIDString[2];
        var opinionTitle = opinionIDString[1];
        $('#modal_opinion_title').html(opinionTitle);
        $('#modal_review_opinion').data('opinionID', opinionID);
        $('#modal_review_opinion').dialog('open');
        return false;
    });
    
    // Dialog
    $('#modal_review_opinion').dialog({
        autoOpen: false,
        modal:true,
        width: 600,
        open: function(){
            $('.ui-widget-overlay').bind('click',function(){
                $('#modal_review_opinion').dialog('close');
            })
        },
        buttons: {
            "Submit": function () {
                var extraString = "&user_type=";
                var new_name_string = "";
                var logged_in_user = "1";
                var not_logged_in_user = "2";
                var logged_in_user_label = "NOT_REQUIRED";
                var opinionID = $("#modal_review_opinion").data('opinionID');
                var comment = $("#comment").val();
                var name =  $("#opinion_reviews_name").val();
                if(!validateText(comment)){
                    $("#comment_status").html("Please enter a valid comment"); 
                    return false;
                }
               
                if(!validateText(name)){                    
                    $("#comment_status").html("Please enter a valid name"); 
                    return false;
                }
                if(name == logged_in_user_label){
                    var user_id =  $("#opinion_reviews_user_id").val();
                    new_name_string = logged_in_user_label;
                    if(user_id == null || user_id == ""){
                        $("#comment_status").html("Error adding review"); 
                        return false;
                    }
                    extraString+=logged_in_user+"&user_id="+user_id;
                }
                else{
                    
                    extraString+=not_logged_in_user+"&name="+name;
                }
                
                $.ajax({
                    type: "POST",
                    url: "http://localhost/opinions/index.php/home/add_opinion_review",
                    dataType: "json",
                    data: "opinion_id="+opinionID+"&opinion_review="+comment+extraString,
                    cache:false,
                    success: 
                    function(data){
                        
                        $('#dialog-message-comment').dialog('open');
                    }
                   
                });
                $("#comment").val("");   
                $("#opinion_reviews_name").val(new_name_string);
            
            }
        }
    });
    
    // Dialog Link
    $('.button_comments').click(function () {
        var opinionIDString = (this.id).split("_");
        var opinionID = opinionIDString[2];
        var opinionTitle = opinionIDString[1];
        //---
        // Dialog Link
        $.ajax({
            type: "POST",
            url: "http://localhost/opinions/index.php/home/get_opinion_reviews",
            dataType: "json",
            data: "opinionID="+opinionID,
            cache:false,
            success: 
            function(data){
                var comments;
                var listItems="";
                var x = 0;
                $.each(data.opinionReviews, function(i,item){
                    var comment = item.opinionReview;
                    listItems+= (++x)+comment+"<br/>"
                });
                if(listItems == ""){
                    $('#modal_no_comments').dialog('open');
                }
                else{
                    $("#opinion_reviews").html(listItems); 
                    $("#opinion_reviews_title").html(opinionTitle); 
                    $('#modal_view_comments').data('opinionTitle', opinionTitle);
                    $('#modal_view_comments').dialog('open');
                }    
            }
                   
        });
        
        //--
        
        
     
        return false;
    });
    
    // Dialog
    $('#modal_view_comments').dialog({
        autoOpen: false,
        modal:true,
        width: 600,
        open: function(){
            $('.ui-widget-overlay').bind('click',function(){
                $('#modal_view_comments').dialog('close');
            })
        },
        buttons: {
            "Close": function () {
                $(this).dialog("close");
            }
        }
    });
    
   
    // Dialog
    $('#modal_no_comments').dialog({
        autoOpen: false,
        modal:true,
        width: 600,
        open: function(){
            $('.ui-widget-overlay').bind('click',function(){
                $('#modal_no_comments').dialog('close');
            })
        },
        buttons: {
            "OK": function () {
                $(this).dialog("close");
            }
        }
    });
    
    $("#dialog-message-add-opinion-not-logged-in").dialog({
        autoOpen: false,
        modal: true,
        open: function(){
            $('.ui-widget-overlay').bind('click',function(){
                $('#dialog-message-vote').dialog('close');
            })
        },
        buttons: {
            "OK": function () {
                $(this).dialog("close");
            }
        }
    });
    
    $("#dialog-message-voting-failure").dialog({
        autoOpen: false,
        modal: true,
        open: function(){
            $('.ui-widget-overlay').bind('click',function(){
                $('#dialog-message-voting-failure').dialog('close');
            })
        },
        buttons: {
            "OK": function () {
                $(this).dialog("close");
            }
        }
    });
    
    $("#dialog-message-already-voted").dialog({
        autoOpen: false,
        modal: true,
        open: function(){
            $('.ui-widget-overlay').bind('click',function(){
                $('#dialog-message-already-voted').dialog('close');
            })
        },
        buttons: {
            "OK": function () {
                $(this).dialog("close");
            }
        }
    });
    
    
    // Dialogs
    $("#dialog-message").dialog({
        autoOpen: false,
        modal: true,
        open: function(){
            $('.ui-widget-overlay').bind('click',function(){
                $('#dialog-message').dialog('close');
            })
        },
        buttons: {
            "Add_Other": function () {
                $(this).dialog("close");
            },
            "Close":function () {
                $('#modal_cnt_add_opinion').dialog('close');
                $(this).dialog("close");
            }
        }
    });
    
    $("#dialog-message-comment").dialog({
        autoOpen: false,
        modal: true,
        open: function(){
            $('.ui-widget-overlay').bind('click',function(){
                $('#dialog-message-comment').dialog('close');
            })
        },
        buttons: {
            "OK": function () {
                $('#modal_review_opinion').dialog('close');
                $(this).dialog("close");
            }
        }
    });
    
    $("#dialog-message-vote").dialog({
        autoOpen: false,
        modal: true,
        open: function(){
            $('.ui-widget-overlay').bind('click',function(){
                $('#dialog-message-vote').dialog('close');
            })
        },
        buttons: {
            "OK": function () {
                $(this).dialog("close");
            }
        }
    });
    
    
    // Modal Link
    $('.agree_vote').click(function () {
        var vote_type = 1;
        var opinionIDString = (this.id).split("_");
        var opinionID = opinionIDString[1];
        $.ajax({
            type: "POST",
            url: "http://localhost/opinions/index.php/home/add_vote",
            dataType: "json",
            data: "opinion_id="+opinionID+"&vote_type="+vote_type,
            cache:false,
            success: 
            function(data){
                if(data.message == "ALREADY_VOTED"){
                    $('#dialog-message-already-voted').dialog('open');
                }
                else if(data.message == "Failure"){
                    $('#dialog-message-voting-failure').dialog('open');
                }
                else{
                    $('#dialog-message-vote').dialog('open');
                }
            }
                   
        });
        
    });
    
// Modal Link
$('.disagree_vote').click(function () {
    var vote_type = 2;
    var opinionIDString = (this.id).split("_");
    var opinionID = opinionIDString[1];
    $.ajax({
        type: "POST",
        url: "http://localhost/opinions/index.php/home/add_vote",
        dataType: "json",
        data: "opinion_id="+opinionID+"&vote_type="+vote_type,
        cache:false,
        success: 
        function(data){
            $('#dialog-message-vote').dialog('open');
        }
                   
    });
        
});
    
// Modal Link
$('.helpful_vote').click(function () {
    var vote_type = 3;
    var opinionIDString = (this.id).split("_");
    var opinionID = opinionIDString[1];
    $.ajax({
        type: "POST",
        url: "http://localhost/opinions/index.php/home/add_vote",
        dataType: "json",
        data: "opinion_id="+opinionID+"&vote_type="+vote_type,
        cache:false,
        success: 
        function(data){
            $('#dialog-message-vote').dialog('open');
        }
                   
    });
        
});
    
// Modal Link
$('.funny_vote').click(function () {
    var vote_type = 4;
    var opinionIDString = (this.id).split("_");
    var opinionID = opinionIDString[1];
    $.ajax({
        type: "POST",
        url: "http://localhost/opinions/index.php/home/add_vote",
        dataType: "json",
        data: "opinion_id="+opinionID+"&vote_type="+vote_type,
        cache:false,
        success: 
        function(data){
            $('#dialog-message-vote').dialog('open');
        }
                   
    });
        
});
// Modal Link
$('#modal_link').click(function () {
    $('#dialog-message').dialog('open');
    return false;
});

// Datepicker
$('#datepicker').datepicker({
    inline: true
});

// Slider
$('#slider').slider({
    range: true,
    values: [17, 67]
});

// Progressbar
$("#progressbar").progressbar({
    value: 20
});

//hover states on the static widgets
$('#dialog_link, #modal_link, ul#icons li').hover(

    function () {
        $(this).addClass('ui-state-hover');
    }, function () {
        $(this).removeClass('ui-state-hover');
    });

// Autocomplete
var availableTags = ["ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme"];

$("#tags").autocomplete({
    source: availableTags
});


// Remove focus from buttons
$('.ui-dialog :button').blur();



    // Vertical slider
    $("#slider-vertical").slider({
        orientation: "vertical",
        range: "min",
        min: 0,
        max: 100,
        value: 60,
        slide: function (event, ui) {
            $("#amount").val(ui.value);
        }
    });
    $("#amount").val($("#slider-vertical").slider("value"));


    // Split button
    $("#rerun").button().click(function () {
        alert("Running the last action");
    }).next().button({
        text: false,
        icons: {
            primary: "ui-icon-triangle-1-s"
        }
    }).click(function () {
        alert("Could display a menu to select an action");
    }).parent().buttonset();


    var $tab_title_input = $("#tab_title"),
    $tab_content_input = $("#tab_content");
    var tab_counter = 2;

    // tabs init with a custom tab template and an "add" callback filling in the content
    var $tabs = $("#tabs2").tabs({
        tabTemplate: "<li><a href='#{href}'>#{label}</a></li>",
        add: function (event, ui) {
            var tab_content = $tab_content_input.val() || "Tab " + tab_counter + " content.";
            $(ui.panel).append("<p>" + tab_content + "</p>");
        }
    });

    // modal dialog init: custom buttons and a "close" callback reseting the form inside
    var $dialog = $("#dialog2").dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            Add: function () {
                addTab();
                $(this).dialog("close");
            },
            Cancel: function () {
                $(this).dialog("close");
            }
        },
        open: function () {
            $tab_title_input.focus();
        },
        close: function () {
            $form[0].reset();
        }
    });

    // addTab form: calls addTab function on submit and closes the dialog
    var $form = $("form", $dialog).submit(function () {
        addTab();
        $dialog.dialog("close");
        return false;
    });

    // actual addTab function: adds new tab using the title input from the form above


    function addTab() {
        var tab_title = $tab_title_input.val() || "Tab " + tab_counter;
        $tabs.tabs("add", "#tabs-" + tab_counter, tab_title);
        tab_counter++;
    }

    // addTab button: just opens the dialog
    $("#add_tab").button().click(function () {
        $dialog.dialog("open");
    });

    // close icon: removing the tab on click
    // note: closable tabs gonna be an option in the future - see http://dev.jqueryui.com/ticket/3924
    $("#tabs span.ui-icon-close").live("click", function () {
        var index = $("li", $tabs).index($(this).parent());
        $tabs.tabs("remove", index);
    });

    // Filament datepicker
    $('#rangeA').daterangepicker();
    $('#rangeBa, #rangeBb').daterangepicker();


    // Dynamic tabs
    var $tab_title_input = $("#tab_title"),
    $tab_content_input = $("#tab_content");
    var tab_counter = 2;

    // tabs init with a custom tab template and an "add" callback filling in the content
    var $tabs = $("#tabs2").tabs({
        tabTemplate: "<li><a href='#{href}'>#{label}</a></li>",
        add: function (event, ui) {
            var tab_content = $tab_content_input.val() || "Tab " + tab_counter + " content.";
            $(ui.panel).append("<p>" + tab_content + "</p>");
        }
    });

    // modal dialog init: custom buttons and a "close" callback reseting the form inside
    var $dialog = $("#dialog2").dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            Add: function () {
                addTab();
                $(this).dialog("close");
            },
            Cancel: function () {
                $(this).dialog("close");
            }
        },
        open: function () {
            $tab_title_input.focus();
        },
        close: function () {
            $form[0].reset();
        }
    });

    // addTab form: calls addTab function on submit and closes the dialog
    var $form = $("form", $dialog).submit(function () {
        addTab();
        $dialog.dialog("close");
        return false;
    });

    // actual addTab function: adds new tab using the title input from the form above

    function addTab() {
        var tab_title = $tab_title_input.val() || "Tab " + tab_counter;
        $tabs.tabs("add", "#tabs-" + tab_counter, tab_title);
        tab_counter++;
    }

    // addTab button: just opens the dialog
    $("#add_tab").button().click(function () {
        $dialog.dialog("open");
    });

    // close icon: removing the tab on click
    // note: closable tabs gonna be an option in the future - see http://dev.jqueryui.com/ticket/3924
    $("#tabs span.ui-icon-close").live("click", function () {
        var index = $("li", $tabs).index($(this).parent());
        $tabs.tabs("remove", index);
    });


    // File input (using http://filamentgroup.com/lab/jquery_custom_file_input_book_designing_with_progressive_enhancement/)
    $('#file').customFileInput({
        button_position : 'right'
    });


    //Wijmo
    $("#menu1").wijmenu({
        trigger: ".wijmo-wijmenu-item", 
        triggerEvent: "click"
    });
    //$(".wijmo-wijmenu-text").parent().bind("click", function () {
    //    $("#menu1").wijmenu("hideAllMenus");
    //});
    //$(".wijmo-wijmenu-link").hover(function () {
    //    $(this).addClass("ui-state-hover");
    //}, function () {
    //    $(this).removeClass("ui-state-hover");
    //});

    //Toolbar
    $("#play, #shuffle").button();
    $("#repeat").buttonset();


    
});
$("body").on("click",".ui-widget-overlay",function() {
    alert("Hello");
    $('#modal_cnt_add_opinion').dialog( "close" );
});