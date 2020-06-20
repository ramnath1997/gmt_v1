$(document).ready(function() {

  updatestatus();  
    scrollalert();  
  var animating = false,
      submitPhase1 = 1100,
      submitPhase2 = 400,
      logoutPhase1 = 800,
      $login = $(".login"),
      $app = $(".app");
  
  function ripple(elem, e) {
    $(".ripple").remove();
    var elTop = elem.offset().top,
        elLeft = elem.offset().left,
        x = e.pageX - elLeft,
        y = e.pageY - elTop;
    var $ripple = $("<div class='ripple'></div>");
    $ripple.css({top: y, left: x});
    elem.append($ripple);
  };
  

  $(document).on("click", ".login__submit", function(e) {
    if (animating) return;
    animating = true;
    var that = this;
    ripple($(that), e);

    $(that).addClass("processing");
    setTimeout(function() {
      $(that).addClass("success");
      setTimeout(function() {
       // document.getElementById("myButton").onclick = function () {
        location.href = "./index.php";
      //};
        //$app.show();
        //$app.css("top");
        //$app.addClass("active");
      }, submitPhase2 - 70);
      setTimeout(function() {
       // $login.hide();
        //$login.addClass("inactive");
        animating = false;
        $(that).removeClass("success processing");
      }, submitPhase2);
    }, submitPhase1);
  });
  
  $(document).on("click", ".app__logout", function(e) {
    if (animating) return;
    $(".ripple").remove();
    animating = true;
    var that = this;
    $(that).addClass("clicked");
    setTimeout(function() {
        location.href = "./logout.php";
      //$app.removeClass("active");
      //$login.show();
      //$login.css("top");
      //$login.removeClass("inactive");
    }, logoutPhase1 - 120);
    setTimeout(function() {
      //$app.hide();
      animating = false;
      $(that).removeClass("clicked");
    }, logoutPhase1);
  });
  
});
 
function updatestatus(){  
    //Show number of loaded items  
    var totalItems=$('#content p').length;  
    $('#status').text('Loaded '+totalItems+' Items');  
}  
function scrollalert(){  
    var scrolltop=$('#scrollbox').attr('scrollTop');  
    var scrollheight=$('#scrollbox').attr('scrollHeight');  
    var windowheight=$('#scrollbox').attr('clientHeight');  
    var scrolloffset=20;  
    if(scrolltop>=(scrollheight-(windowheight+scrolloffset)))  
    {  
        //fetch new items  
        $('#status').text('Loading more items...');  
        $.get('new-items.html', '', function(newitems){  
            $('#content').append(newitems);  
            updatestatus();  
        });  
    }  
    setTimeout('scrollalert();', 1500);  
}  