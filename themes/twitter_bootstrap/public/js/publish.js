$(document).ready(function(){
   $('.btn-get-code').click(function(e){
       e.preventDefault();
       var btn = $(this);
       btn.button('loading');

       $.ajax({
           type: 'post',
           dataType: 'json',
           url: '/publish-ads',
           data: {
               ajax: 'get_sms_code',
               phone: $('input[name="PublishAdsForm[phone]"]').val()
           },

           complete: function(xhr){
               btn.button('reset')
           },
           error: function(xhr){
               $('#PublishAdsForm_smsCode_em_').show().html('Ошибка отправки смс')
           },
           success: function(xhr){
               $('#PublishAdsForm_smsCode_em_').show().html('Введите полученный код')
           }
       });
   })
});