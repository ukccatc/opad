jQuery('input[type="submit"]').click(function() {
  jQuery('.login').addClass('test')
  setTimeout(function() {
    jQuery('.login').addClass('testtwo')
  }, 300);
  setTimeout(function() {
    jQuery(".authent").show().animate({
      right: -320
    }, {
      easing: 'easeOutQuint',
      duration: 600,
      queue: false
    });
    jQuery(".authent").animate({
      opacity: 1
    }, {
      duration: 200,
      queue: false
    }).addClass('visible');
  }, 500);
  setTimeout(function() {
    jQuery(".authent").show().animate({
      right: 90
    }, {
      easing: 'easeOutQuint',
      duration: 600,
      queue: false
    });
    jQuery(".authent").animate({
      opacity: 0
    }, {
      duration: 200,
      queue: false
    }).addClass('visible');
    jQuery('.login').removeClass('testtwo')
  }, 2500);
  setTimeout(function() {
    jQuery('.login').removeClass('test')
    jQuery('.login div').fadeOut(123);
  }, 2800);
  setTimeout(function() {
    jQuery('.success').fadeIn();
  }, 3200);
});


jQuery('input[type="text"],input[type="password"]').focus(function() {
  jQuery(this).prev().animate({
    'opacity': '1'
  }, 200)
});
jQuery('input[type="text"],input[type="password"]').blur(function() {
  jQuery(this).prev().animate({
    'opacity': '.5'
  }, 200)
});

jQuery('input[type="text"],input[type="password"]').keyup(function() {
  if (!jQuery(this).val() == '') {
    jQuery(this).next().animate({
      'opacity': '1',
      'right': '30'
    }, 200)
  } else {
    jQuery(this).next().animate({
      'opacity': '0',
      'right': '20'
    }, 200)
  }
});

var open = 0;
jQuery('.tab').click(function() {
  jQuery(this).fadeOut(200, function() {
    jQuery(this).parent().animate({
      'left': '0'
    })
  });
});