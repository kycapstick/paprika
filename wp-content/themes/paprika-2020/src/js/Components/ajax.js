const ajaxCall = function(data) {
  jQuery.ajax({
    type: "post",
    dataType: "json",
    url: myAjax.ajaxurl,
    data,
    success: function(response) {
      if (response.status === 'success') {
        location.reload();
      }
    }
  })
}

export default ajaxCall;