// menu sliding area start

jQuery(document).ready(function(){
    $(".navIcon").click(function(){
        $(".leftPanel").toggleClass("slideclose");
        $(".leftPanel ul li span").toggleClass("spanClass");
        $(".createArea ul li ul").toggleClass("subul");
        $(".headerArea").toggleClass("fullheader");
        $(".rightPanel").toggleClass("fullbody");
        // $(".headerArea").toggleClass("fullHeader");
      });
})
// menu sliding area end

// agendaService crousel start
$(document).ready(function() {
  $('#agendaService').owlCarousel({
    loop: true,
    margin: 0,
    responsiveClass: true,
    // stagePadding: 50,
    nav: false,
    responsive: {
      0: {
        items: 1.5,
      },
      600: {
        items: 1.5,
      },
      991: {
        items: 2.5,
      }
    }
  })
})
// agendaService crousel end

// agendaService crousel start
$(document).ready(function() {
  $('#taskService').owlCarousel({
    loop: true,
    margin: 0,
    responsiveClass: true,
    // stagePadding: 50,
    nav: false,
    responsive: {
      0: {
        items: 1.5,
      },
      600: {
        items: 1.5,
      },
      991: {
        items: 2.5,
      }
    }
  })
})
// agendaService crousel end

// leadService crousel start
$(document).ready(function() {
  $('#leadService').owlCarousel({
    loop: true,
    margin: 0,
    responsiveClass: true,
    // stagePadding: 50,
    nav: false,
    responsive: {
      0: {
        items: 1.5,
      },
      600: {
        items: 1.5,
      },
      991: {
        items: 2.5,
      }
    }
  })
})
// leadService crousel end

// opportunity crousel start
$(document).ready(function() {
  $('#opportunity').owlCarousel({
    loop: true,
    margin: 0,
    responsiveClass: true,
    // stagePadding: 50,
    nav: false,
    responsive: {
      0: {
        items: 1.5,
      },
      600: {
        items: 1.5,
      },
      991: {
        items: 2.5,
      }
    }
  })
})
// opportunity crousel end

// datepicker start
jQuery(document).ready(function () {

  $("#datepicker").datepicker();

});

// datepicker end

// client list action button dropdown start

jQuery(document).ready(function(){
  jQuery(".dotslink").click(function(){
    // alert('ds')
    // jQuery(this.actionbuttonarea).toggleClass('sad');
    // jQuery(".dotslink").closest(".actionbuttonarea").toggleClass("asas")
    $(this).closest("div").toggleClass("openactionbutton")
  });

})

// client list action button dropdown end