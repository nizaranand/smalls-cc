<?php
function evr_admin_payments_edit(){
    
                        $payment_id = $_REQUEST['id'];
                        //$event_id = $_REQUEST['event_id'];
                        (is_numeric($_REQUEST['event_id'])) ? $event_id = $_REQUEST['event_id'] : $event_id = "0";
                        $today = date("Y-m-d");
                        
                       	$sql = "SELECT * FROM " . get_option('evr_payment') . " WHERE id ='$payment_id'";
        				$result = mysql_query ( $sql );
        				while ( $row = mysql_fetch_assoc ( $result ) ) {
        				    
                             $payer_id=$row['payer_id']; 
                             $event_id=$row['event_id']; 
                             $payment_date=$row['payment_date']; 
                             $txn_id=$row['txn_id']; 
                             $first_name=$row['first_name']; 
                             $last_name=$row['last_name']; 
                             $payer_email=$row['payer_email']; 
                             $payer_status=$row['payer_status'];
                             $payment_type=$row['payment_type']; 
                             $memo=$row['memo']; 
                             $item_name=$row['item_name']; 
                             $item_number=$row['item_number'];
                             $quantity=$row['quantity']; 
                             $mc_gross=$row['mc_gross']; 
                             $mc_currency=$row['mc_currency']; 
                             $address_name=$row['address_name'];
                             $address_street=$row['address_street']; 
                             $address_city=$row['address_city']; 
                             $address_state=$row['address_state']; 
                             $address_zip=$row['address_zip'];
                             $address_country=$row['address_country']; 
                             $address_status=$row['address_status']; 
                             $payer_business_name=$row['payer_business_name']; 
                             $payment_status=$row['payment_status'];
                             $pending_reason=$row['pending_reason']; 
                             $reason_code=$row['reason_code']; 
                             $txn_type=$row['txn_type'];
        				    
        				    }
                        
                        
        				$sql = "SELECT * FROM " . get_option('evr_attendee') . " WHERE id ='$payer_id'";
        				$result = mysql_query ( $sql );
        				while ( $row = mysql_fetch_assoc ( $result ) ) {
        					$id = $row ['id'];
                            $attendee_id = $row ['id'];
        					$lname = $row ['lname'];
        					$fname = $row ['fname'];
        					$address = $row ['address'];
        					$city = $row ['city'];
        					$state = $row ['state'];
        					$zip = $row ['zip'];
        					$email = $row ['email'];
        					$phone = $row ['phone'];
        					$event_id = $row ['event_id'];
        				    $num_people = $row['quantity'];
                            $coupon = $row['coupon'];
                            $payment = $row['payment'];
        				}
        				
        			$sql = "SELECT * FROM " . get_option('evr_event') . " WHERE id='$event_id'";
            		$result = mysql_query ( $sql );
            		while ( $row = mysql_fetch_assoc ( $result ) ) {
            			$event_id = $row ['id'];
            			$event_name = $row ['event_name'];
            			$event_desc = $row ['event_desc'];
            			$event_description = $row ['event_desc'];
            			$identifier = $row ['event_identifier'];
            			$coupon_code = $row['coupon_code'];
                        $use_coupon = $row['use_coupon'];
                        $coupon_code_price = $row['coupon_code_price'];
            			$active = $row ['is_active'];
            		}	   
        			
                    
                   
                    	
     				   $sql2= "SELECT SUM(mc_gross) FROM ".get_option('evr_payment')." WHERE payer_id='$attendee_id'";
                                     				$result2 = mysql_query($sql2);
                    	
                    				while($row = mysql_fetch_array($result2)){
                    					$total_paid =  $row['SUM(mc_gross)'];
                                       	}
                                              
                         if ($use_coupon =="Y" && $event_cost > "0" ) {
                                if ($coupon == $coupon_code) {$discount = $coupon_code_price;}
                                else {$discount = "0";}
                            }
                         
                         if ($payment > "0" ){$balance = ($payment-$total_paid);
                         $balance = evr_moneyFormat($balance);}
                         else if ($event_cost ==""){$balance = "Free Event";}
                         else {$balance = "Free Event";}
    
?>    
<div class="wrap">
<h2><a href="http://www.wordpresseventregister.com"><img src="<?php echo EVR_PLUGINFULLURL ?>images/evr_icon.png" alt="Event Registration for Wordpress" /></a></h2>
<h2><?php _e('Payment Management','evr_language');?></h2>
    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
        	<div class='postbox-container' style='width:50%;'>
                <div id='normal-sortables' class='meta-box-sortables'>
                    <div id="dashboard_right_now" class="postbox " >
                         
                        <h3 class='hndle'><span><p><?php _e('Add Payment:','evr_language');?><?php echo "  ".$fname." ".$lname." ".$email."    ";?></p><p><?php _e('Balance Owed:','evr_language'); echo "  ".$balance;?></p></span></h3>
                     
                         <div class="inside">
                         <div class="padding">
                         <ul>
                         <form method="post" action="admin.php?page=payments">
                                        
                
                        				<li><label><?php _e('Payment Received Date','evr_language');?></label>: <input name="payment_date" size="15"	value="<?php echo $payment_date;?>"/></li>
                                        <li><label><?php _e('Amount Paid','evr_language');?></label>: <input name="mc_gross" size="25" value="<?php echo $mc_gross;?>"></li>
                                        <li><label><?php _e('Payment Type','evr_language');?></label>
                                         <select name="payment_type">
                                         <?php 
                                         if ($payment_type =="full"){ ?><option value="full"><?php _e('Full Payment','evr_language');?></option><?php }
                                         if ($payment_type =="partial") {?><option value="partial"><?php _e('Partial Payment','evr_language');?></option><?php }
                                         if ($payment_type =="deposit"){?><option value="deposit"><?php _e('Deposit','evr_language');?></option><?php }
                                         if ($payment_type =="donation"){?><option value="donation"><?php _e('Donation','evr_language');?></option><?php }
                                         if ($payment_type =="modify"){?><option value="modify"><?php _e('Modification','evr_language');?></option><?php }
                                         if ($payment_type =="cancel"){?><option value="cancel"><?php _e('Cancelation','evr_language');?></option><?php }
                                         if ($payment_type =="refund"){?><option value="refund"><?php _e('Refund','evr_language');?></option><?php }
                                         
                                         ?>
                                                                <option value="full"><?php _e('Full Payment','evr_language');?></option>
                                                                  <option value="partial"><?php _e('Partial Payment','evr_language');?></option>
                                                                  <option value="deposit"><?php _e('Deposit','evr_language');?></option>
                                                                  <option value="donation"><?php _e('Donation','evr_language');?></option>
                                                                  <option value="modify"><?php _e('Modification','evr_language');?></option>
                                                                  <option value="cancel"><?php _e('Cancelation','evr_language');?></option>
                                                                  <option value="refund"><?php _e('Refund','evr_language');?></option>  
                                                                </select></li>
                                        
                                        <li><label><?php _e('Payment Method','evr_language');?></label>: <select name="txn_type">
                                        <?php
                                        if ($txn_type =="online"){ ?> <option value="online"><?php _e('Online/Credit Card','evr_language');?></option><?php }
                                        if ($txn_type =="check"){ ?> <option value="check"><?php _e('Check','evr_language');?></option><?php }
                                        if ($txn_type =="cash"){ ?> <option value="cash"><?php _e('Cash','evr_language');?></option><?php }
                                        if ($txn_type =="credit"){ ?> <option value="credit"><?php _e('Event Credit','evr_language');?></option><?php }
                                        ?>
                                                                  <option value="online"><?php _e('Online/Credit Card','evr_language');?></option>
                                                                  <option value="check"><?php _e('Check','evr_language');?></option>
                                                                  <option value="cash"><?php _e('Cash','evr_language');?></option>
                                                                  <option value="credit"><?php _e('Event Credit','evr_language');?></option>
                                                                </select> </li>
                                        <li><label><?php _e('Transaction ID','evr_language');?></label>
                                        : <input name="txn_id" size="45" value="<?php echo $txn_id;?>"/> </li>
                                        
                        <hr />
                        <br />
                        <li><label><?php _e('Do you want to send a revised payment received notice to the payer?','evr_language');?></label>
                        <INPUT TYPE='radio' NAME='send_payment_rec'  VALUE='Y'><?php _e('Yes','evr_language');?> 
                        <INPUT TYPE='radio' NAME='send_payment_rec' VALUE='N' CHECKED><?php _e('No','evr_language');?></li>
                        <br />
                        <hr />
                        <p align="center">
                        <?php
                        				echo "<input type='hidden' name='attendee_id' value='" . $attendee_id . "'>";
                        				echo "<input type='hidden' name='form_action' value='payment'>";
                                        echo "<input type='hidden' name='payment_id' value='".$payment_id."'>";
                                        echo "<input type='hidden' name='first_name' value='".$fname."'>";
                                        echo "<input type='hidden' name='last_name' value='".$lname."'>";
                                        echo "<input type='hidden' name='payer_email' value='".$email."'>";
                                        echo "<input type='hidden' name='address_name' value='".$fname." ".$lname."'>";
                                        echo "<input type='hidden' name='address_street' value='".$address."'>";
                                        echo "<input type='hidden' name='address_city' value='".$city."'>";
                                        echo "<input type='hidden' name='address_state' value='".$state."'>";
                                        echo "<input type='hidden' name='address_zip' value='".$zip."'>";
                                        echo "<input type='hidden' name='address_country' value='".$state."'>";
                                        echo "<input type='hidden' name='address_status' value='VALID'>";  
                                        echo "<input type='hidden' name='item_name' value='Event Payment: ".$event_name." (".$event_id.")'>";   
                                        echo "<input type='hidden' name='item_number' value='".$event_id."'>";  
                                        echo "<input type='hidden' name='quantity' value='1'>";        
                        				echo "<input type='hidden' name='attendee_pay' value='paynow'>";
                        				echo "<input type='hidden' name='event_id' value='" . $event_id . "'>";
                        				echo "<input type='hidden' name='action' value='update_payment'>";
                        				?>
                        </hr><p><input type="submit" name="Submit" value="<?php _e('UPDATE PAYMENT','evr_language');?>"></p>
                        </form>
                        
                        </p></ul>
                            </div>                           
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>
</div> 
<?php    
    
}
?>