//Mettre le nom

jQuery(document).ready(function($){
  $('.search-box input[type="text"]').focus(function(){
    $('.search-filters').slideToggle();
  });
  $('.search-filters input[type="radio"]').on('click', function(){
    var placeholder_text = $(this).closest('label').text();
    $('.search-input').attr('placeholder', 'search: '+placeholder_text);
    $('.search-filters').slideToggle();
  });
});
