$(document).ready(function() {
  $('.pagina').click(function() {
  
    $('#section').html(`
      <div
        style="
          position: fixed;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
        "
      >
        <button
          class="btn btn-dark btn-lg"
          type="button"
          disabled
        >
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Loading...
        </button>
      </div>
    `);
    
    var url = $(this).attr('data-link');
    
    var pagina = $(this).attr('data');
    var dataString = 'pagina=' + pagina;
    
    $.ajax({
      type: "GET",
      url: url,
      data: dataString,
      success: function(data) {
        console.log(data)
        $('#section').fadeIn(1000).html(data);
      }
    });

  });
});
  