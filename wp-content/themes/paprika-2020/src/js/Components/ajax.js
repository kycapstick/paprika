const ajaxCall = function(data) {
  jQuery.ajax({
    type: "post",
    dataType: "json",
    url: myAjax.ajaxurl,
    data,
    success: function(response) {
      console.log(response);
    }
  })
}

export default ajaxCall;