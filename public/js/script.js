jQuery(document).ready(function($) {
	$('.dropdown').dropdown();

  $(document).ready(function(){
    $('#smartwizard').smartWizard();
  });

  $(".accordion a").click(function(){
    console.log("helll");
    $(this).toggleClass('active');
    $(this).siblings().toggleClass('active');
  })
});
