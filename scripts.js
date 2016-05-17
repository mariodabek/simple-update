jQuery(document).ready( function() {
  jQuery(".wp-editor-area#content").on("change keyup paste", function() {
    source_changed();
  });
  jQuery("#simple_update").on("change keyup paste", 'input.su', function() {
    id = jQuery(this).attr('rel');
    update_source(id);
  });
  source_changed();


  jQuery(".wp-switch-editor.switch-html").click(function() { jQuery('#simple_update').fadeIn(); }); 
  jQuery(".wp-switch-editor.switch-tmce").click(function() { jQuery('#simple_update').fadeOut(); });
})

jQuery(window).load(function(){ jQuery(".wp-switch-editor.switch-html").click(); })

function update_source(id) {
  val = jQuery('.simple_update_temp_vars [rel="'+id+'"]').val();
  id = id.substring(3);
  jQuery('.simple_update_temp_data [rel="'+id+'"]').html(val);
  jQuery(".wp-editor-area#content").val(jQuery('.simple_update_temp_data').html());
}

function source_changed() {
  var currentVal = jQuery('.wp-editor-area#content').val();
  jQuery('.simple_update_temp_data').html(currentVal);
  
  if (jQuery('.simple_update_temp_data .simple_update').length>0) {
    jQuery('.simple_update_temp_vars').html('');
  } else {
    jQuery('.simple_update_temp_vars').text('no simple update variables found');
  }
  jQuery('.simple_update_temp_data .simple_update').each(function() {
      id = jQuery(this).attr('rel');
      rel_id = "su_"+jQuery(this).attr('rel');
      val = jQuery(this).html();
      data = '<li><label>'+id+'</label><input rel="'+rel_id+'" class="su" value="'+val+'"/></li>';
      jQuery('.simple_update_temp_vars').append(data);
  })
}

