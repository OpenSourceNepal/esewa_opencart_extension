<h2><?php echo $text_instruction; ?></h2>
<div class="content">
  <p><?php echo $text_description; ?></p>
  <p><?php //echo $easy; ?></p>
  <p><?php echo $text_payment; ?></p>
</div>
<div class="buttons">
  <div class="right">
   <form action="<?php echo $action_st; ?>" method="post" id="payment">
   			
            <input value="<?php echo floatval($totalamount); ?>" name="amt" type="hidden">
            <input value="0" name="txAmt" type="hidden">
            <input value="0" name="psc" type="hidden">
            <input value="0" name="pdc" type="hidden">
            
            <input value="<?php echo $merchantcode; ?>" name="scd" type="hidden">
            <input value="<?php echo  floatval($totalamount); ?>" name="tAmt" type="hidden">
            <input value="<?php echo $productid; ?>" name="pid" type="hidden">
           
            <input value="http://store.epicmountainbike.com/success,html?q=su" type="hidden" name="su">
            <input value="http://store.epicmountainbike.com/failure.html?q=fu" type="hidden" name="fu">  
    		<input type="submit" value="<?php echo $button_confirm; ?>" id="button-confirm" class="button" />
    </form>
  </div>
</div>

