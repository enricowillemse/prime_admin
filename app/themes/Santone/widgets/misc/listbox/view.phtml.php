<div id="widget_<?php echo $widget->id; ?>"  class="<?php echo $parm['width']; ?>" > <?php echo $controls; ?>
<select id="w_<?php echo $widget->id; ?>" style="width:100%" multiple placeholder="<?php echo $parm['title']; ?>">
     <?php foreach ($parm['db'] as $entry) { ?>
      <option value="<?php echo $entry['link_column']; ?>"><?php echo $entry['values']; ?></option>
    <?php } ?>
</select><script>

$("#w_<?php echo $widget->id; ?>").listbox({'searchbar': true});

        $("#w_<?php echo $widget->id; ?>").change(function() {
        
            update_dashboard("<?php echo $parm['target_link']; ?>", $("#w_<?php echo $widget->id; ?>").val(),<?php echo $widget->id; ?>);
  
        });



</script><?php echo $this->getContent(); ?></div>