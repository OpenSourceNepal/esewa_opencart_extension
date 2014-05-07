<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <?php foreach ($languages as $language) { ?>
          
           <tr>
            <td><span class="required">*</span><?php echo $esewa_name; ?></td>
            <td>
            	<input type="text" name="esewa_id" value="<?php echo $esewa_id; ?>" />
            	<?php if (isset($esewar_id)) { ?>
              		<span class="error"><?php echo $esewar_id; ?></span>
              <?php } ?>
            </td>
          </tr>
           <tr>
           		  <td><?php echo $esewa_sandbox; ?></td>
                       <td><select name="esewa_mode">
                <?php if ($esewa_mode) { ?>
                <option value="1" selected="selected"><?php echo $text_live; ?></option>
                <option value="0"><?php echo $text_demo; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_live; ?></option>
                <option value="0" selected="selected"><?php echo $text_demo; ?></option>
                <?php } ?>
              </select></td>
           </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_esewa; ?></td>
            <td><textarea name="esewa_transfer_<?php echo $language['language_id']; ?>" cols="80" rows="10"><?php echo isset(${'esewa_transfer_' . $language['language_id']}) ? ${'esewa_transfer_' . $language['language_id']} : ''; ?></textarea>
              <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
              <?php if (isset(${'error_esewa_' . $language['language_id']})) { ?>
              		<span class="error"><?php echo ${'error_esewa_' . $language['language_id']}; ?></span>
              <?php } ?></td>
          </tr>
          <?php } ?>
          <tr>
            <td><?php echo $entry_total; ?></td>
            <td><input type="text" name="esewa_total" value="<?php echo $esewa_total; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_order_status; ?></td>
            <td><select name="esewa_order_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $esewa_order_status_id) { 
                	echo $order_status['order_status_id'];
                    echo $esewa_order_status_id;
                ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="esewa_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $esewa_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="esewa_status">
                <?php if ($esewa_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="esewa_sort_order" value="<?php echo $esewa_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>